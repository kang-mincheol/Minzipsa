<?

header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상적으로 로그인 하였습니다."
);


$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["id", "password"])){
	if(IS_LIVE){
		$returnArray["code"] = "MISSING_PARAMS";
        $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";	
        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
	}
	else{
		$data = array(
			"id"=>"aaa6315@gmail.com",
            "password"=>"alscjf5686!",
		);
	}
}

$data = cleansingParams($data);

if(sql_fetch("
    Select  count(*) as cnt
    From    LoginBlock
    Where   block_type = 'email'
    And     block_key = '{$data["id"]}'
")["cnt"] > 0){
    // 차단된 아이디
    $returnArray["code"] = "BLOCK_ID";
    $returnArray["msg"] = "5회 로그인 실패로 인해서 접속이 차단되었습니다. 패스워드 찾기를 통해 인증 바랍니다.";
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

if(sql_fetch("
    Select  count(*) as cnt
    From    LoginBlock
    Where   block_type = 'ip'
    And     block_key = '{$ip_address}'
")["cnt"] > 0){
    // 차단된 아이피
    $returnArray["code"] = "BLOCK_IP";
    $returnArray["msg"] = "동일한 IP로 10회 로그인 실패로 인해서 접속이 차단되었습니다. 패스워드 찾기를 통해 인증 바랍니다.";
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

$user = sql_fetch("
Select  password
From    Users
Where   email = '{$data["id"]}'
");

//$returnArray["test"] = validate_password($data["password"], $user["password"]);


if (password_verify($data["password"], $user["password"])) {
    // 회원아이디 세션 생성
    set_session('user_id', $data["id"]);
    
    // 로그인 성공로그 생성
    sql_query("
        Insert into LoginLog
        (ip_address, user_agent, user_id, is_success, create_date)
        Values
        ('{$ip_address}', '{$user_agent}', '{$data["id"]}', 1, Now())
    ");

} else {
    sql_query("
        Insert into LoginLog
        (ip_address, user_agent, user_id, is_success, create_date)
        Values
        ('{$ip_address}', '{$user_agent}', '{$data["id"]}', 0, Now())
    ");

    $returnArray["code"] = "LOGIN_FAIL";
    $returnArray["msg"] = "입력한 아이디와 비밀번호가 일치하지 않습니다. 아이디 또는 비밀번호를 다시 한번 입력해주세요.";

    if(
        sql_fetch("
            Select	Count(*) as cnt
            From	LoginLog
            Where	is_success = 0
            And		user_id = '{$data["id"]}'
            And		create_date > IfNull((
                SELECT	create_date
                FROM	LoginLog
                Where	is_success = 1
                And		user_id = '{$data["id"]}'
                Order by create_date desc
                Limit 0, 1
            ), '1900-01-01')
        ")["cnt"] >= 5
    ){
        sql_query("
            Insert into LoginBlock
            (block_type, block_key, create_date)
            Values
            ('email', '{$data["id"]}', Now())
        ");
    }

    if(
        sql_fetch("
            Select	Count(*) as cnt
            From	LoginLog
            Where	is_success = 0
            And		ip_address = '{$ip_address}'
            And		create_date > IfNull((
                SELECT	create_date
                FROM	LoginLog
                Where	is_success = 1
                And		ip_address = '{$ip_address}'
                Order by create_date desc
                Limit 0, 1
            ), '1900-01-01')
        ")["cnt"] >= 10
    ){
        sql_query("
            Insert into LoginBlock
            (block_type, block_key, create_date)
            Values
            ('ip', '{$ip_address}', Now())
        ");
    }

}



echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);
?>