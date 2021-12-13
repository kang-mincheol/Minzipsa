<?
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/sms.lib.php');

//비밀번호를 찾기 위한 메일을 발송 합니다.

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상적으로 처리되었습니다."
);


$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["company_no", "ceo_name", "ceo_phone", "image_text"])){
	if(IS_LIVE){
		$returnArray["code"] = "MISSING_PARAMS";
        $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";	
        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
	}
	else{
		$data = array(
            "company_no"=>"3151701816",
            "ceo_name"=>"강민철",
            "ceo_phone"=>"01024995686",
            "image_text"=>"817808"
		);
	}
}

$data = cleansingParams($data);

$ss_id = session_id();

//해당 세션으로 이미지 텍스트가 정상적으로 입력되었는지 확인한다.
$image_text = sql_fetch("
    Select  count(*) as cnt
    From    RandomImage
    Where   session_id = '".$ss_id."'
    And     image_text = '".$data["image_text"]."'
");

if($image_text["cnt"] == 0){
    $returnArray["code"] = "INCORRECT_IMAGE_TEXT";
    $returnArray["msg"] = "로봇 방지용 문자를 잘못 입력 하셨습니다.";	
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

//이미 존재하는 이메일 주소인지 확인한다.
$user = sql_fetch("
    Select  count(*) as cnt
    From    Users
    Where   company_no = '{$data["company_no"]}'
    ANd     ceo_name = '{$data["ceo_name"]}'
    ANd     ceo_phone = '".preg_replace("/[^0-9]*/u", "", $data["ceo_phone"])."'
    And     is_delete = 0
");

if($user["cnt"] == 0){
    $returnArray["code"] = "NOT_EXISTS";
    $returnArray["msg"] = "등록된 계정이 없습니다.";	
}
else{
    //현재 Session ID 를 가지고 온다
    $ss_id = session_id();

    $new_password = generateRandomString(8);
    $password_enc = password_hash($new_password, PASSWORD_BCRYPT);
    $result = sms_send("02-514-9666", $data["ceo_phone"], "[데일리페이] 고객님의 요청으로 비밀번호가 [{$new_password}]으로 변경되었습니다. 만약 본인이 요청한 것이 아니라면, 고객센터로 연락 바랍니다.");

    if($result->result_code == "1"){
        sql_query("
            Update  Users
            Set     password = '{$password_enc}'
            Where   company_no = '{$data["company_no"]}'
            And     ceo_name = '{$data["ceo_name"]}'
            And     ceo_phone= '".preg_replace("/[^0-9]*/u", "", $data["ceo_phone"])."'
        ");

        //차단 데이터를 삭제 한다.
        sql_query("
            Delete
            From	LoginBlock
            Where	block_type = 'company_no'
            And		block_key = '{$data["company_no"]}'
        ");
        //차단 데이터를 삭제 한다.
        sql_query("
            Delete
            From	LoginBlock
            Where	block_type = 'ip'
            And		block_key = '{$ip_address}'
        ");
        
    }
    else{
        $returnArray["code"] = "SMS_ERROR";
        $returnArray["msg"] = "SMS 발송에 실패 하였습니다. 고객센터에 문의 바랍니다.";	
        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
    }

}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);

function generateRandomString($length = 8) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

?>