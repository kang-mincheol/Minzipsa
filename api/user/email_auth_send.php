<?
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/mailer.lib.php');

//이메일 인증을 위한 인증코드 생성 및 발송을 위한 API 입니다

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상적으로 메일이 발송되었습니다. 메일로 발송된 인증코드를 확인하여 입력해주세요."
);


$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["email"])){
	if(IS_LIVE){
		$returnArray["code"] = "MISSING_PARAMS";
        $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";	
        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
	}
	else{
		$data = array(
			"email"=>"a184696@naver.com"
		);
	}
}

$data = cleansingParams($data);

//이미 존재하는 이메일 주소인지 확인한다.
$user = sql_fetch("
    Select  count(*) as cnt
    From    Users
    Where   email = '{$data["email"]}'
    And     is_delete = 0
");

if($user["cnt"] > 0){
    $returnArray["code"] = "ALREADY_EXISTS";
    $returnArray["msg"] = "이미 존재하는 이메일 계정 입니다.";	
}
else{
    //현재 Session ID 를 가지고 온다
    $ss_id = session_id();
    $email = $data["email"];

    //동일 세션으로 10분 안에 10회 이상 요청한 이력이 있는지 체크 한다
    $row = sql_fetch("
        Select  Count(*) as cnt
        From    EmailAuth
        Where   session_id = '{$ss_id}'
        And     email = '{$email}'
        And     is_auth = 0
        And     is_delete = 0
        And     expire_date >= '".date("Y-m-d H:i:s")."'
    ");

    if($row["cnt"] > 10){
        $returnArray["code"] = "TO_MUCH_REQUEST";
        $returnArray["msg"] = "동일한 email로 너무 많이 요청하셨습니다. 약 10분정도 후에 다시 요청해 주시기 바랍니다. 혹시 이메일을 받지 못하셨다면, 스팸메일함을 확인해 주시기 바랍니다.";
        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
    }

    
    $expire_date = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")) + (60 * 10)); //현재 기준으로 10분 이후
    $create_date = date("Y-m-d H:i:s");
    $auth_code = mt_rand(100000, 999999);

    sql_query("
        Insert into EmailAuth
        (session_id, email, auth_code, expire_date, is_auth, is_delete, create_date, update_date)
        Values
        ('{$ss_id}', '{$email}', '{$auth_code}', '{$expire_date}', 0, 0, '{$create_date}', '{$create_date}')
    ");
    
    //이메일 발송
    //메일 바디 디자인 수정 필요.
    $subject = "[데일리페이] 회원가입을 위한 이메일 인증";
    $content = "인증코드 : ".$auth_code;

    $result = mailer(FROM_MAIL_NAME, FROM_MAIL, $email, $subject, $content, 1);

    if(!$result){
        $returnArray["code"] = "EMAIL_ERROR";
		$returnArray["msg"] = "메일발송에 실패하였습니다. 올바른 메일 주소 인지 확인해주세요.";	
    }

}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);

?>