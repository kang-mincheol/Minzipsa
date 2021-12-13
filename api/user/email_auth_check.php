<?
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드


//이메일 인증을 위한 인증코드 확인을 위한 API 입니다.
$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"인증에 성공 하였습니다."
);


$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["email", "auth_code"])){
	if(IS_LIVE){
		$returnArray["code"] = "MISSING_PARAMS";
        $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";	
        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
	}
	else{
		$data = array(
            "email"=>"a184696@naver.com",
            "auth_code"=>"610915"
		);
	}
}

$data = cleansingParams($data);


//현재 Session ID 를 가지고 온다
$ss_id = session_id();
$email = $data["email"];
$auth_code = $data["auth_code"];

$row = sql_fetch("
    Select  Count(*) as cnt
    From    EmailAuth
    Where   session_id = '{$ss_id}'
    And     email = '{$email}'
    And     auth_code = '{$auth_code}'
    And     is_auth = 0
    And     is_delete = 0
    And     expire_date >= '".date("Y-m-d H:i:s")."'
");

if($row["cnt"] > 0){
    sql_query("
        Update  EmailAuth
        Set     is_auth = 1
        Where   session_id = '{$ss_id}'
        And     email = '{$email}'
        And     auth_code = '{$auth_code}'
        And     is_auth = 0
        And     is_delete = 0
        And     expire_date >= '".date("Y-m-d H:i:s")."'
    ");
}
else{
    $returnArray["code"] = "AUTH_FAIL";
    $returnArray["msg"] = "인증에 실패하였습니다.";	
}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);

?>