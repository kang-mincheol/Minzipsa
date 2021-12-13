<?
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/mailer.lib.php');

//비밀번호를 찾기 위한 메일을 발송 합니다.

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상적으로 비밀번호가 변경되었습니다. 변경된 비밀번호로 로그인 해주세요."
);


$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["auth_token", "password"])){
	if(IS_LIVE){
		$returnArray["code"] = "MISSING_PARAMS";
        $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";	
        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
	}
	else{
		$data = array(
            "auth_token"=>"13962429505ddb2d2c3a4d7094767839",
            "password"=>"12qwas@!"
		);
	}
}

$data = cleansingParams($data);

//$ss_id = session_id();

//유효한 인증 토큰인지 확인한다.
$user = sql_fetch("
    Select  email
    From    FindPassword
    Where   auth_token = '{$data["auth_token"]}'
    #And     session_id = '{$ss_id}' #모바일의 경우 메일 앱에서 링크를 클릭할 수 있기 때문에 Session유지가 어려움
    And     is_used = 0
    And     expire_date >= '".date("Y-m-d H:i:s")."'
    Order by create_date Desc
    Limit 0, 1
");

if(is_null($user["email"])){
    $returnArray["code"] = "INVALID_TOKEN";
    $returnArray["msg"] = "인증시간이 지났거나, 잘못된 인증방법 입니다. 비밀번호 찾기를 다시 시도해 주세요.";	
}
else{
    //현재 Session ID 를 가지고 온다
    $email = $user["email"];
    $password = password_hash($data["password"], PASSWORD_BCRYPT);
 
    //기 발급된 인증토큰은 사용 처리 한다.
    sql_query("
        Update  FindPassword
        Set     is_used = 1,
                update_date = '".date("Y-m-d H:i:s")."'
        Where   auth_token = '{$data["auth_token"]}'
        And     is_used = 0
        And     email = '{$email}'
    ");

    sql_query("
        Update  Users
        Set     password = '{$password}',
                update_date = '".date("Y-m-d H:i:s")."'
        Where   email = '{$email}'
        And     is_delete = 0
    ");

    //Login Block 아이디 해제
    sql_query("
        Delete
        From    LoginBlock
        Where   block_type = 'email'
        And     block_key = '{$email}'
    ");

    //Login Block 아이피 해제
    sql_query("
        Delete
        From    LoginBlock
        Where   block_type = 'ip'
        And     block_key = '{$ip_address}'
    ");

    $_SESSION = array();
}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);

?>