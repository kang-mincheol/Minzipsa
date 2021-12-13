<?
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드
error_reporting(E_ALL);
ini_set("display_errors", 1);

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);


$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["email", "password", "name", "phone", "birth", "agreement_service", "agreement_privacy", "agreement_marketing"])){
    $returnArray["code"] = "MISSING_PARAMS";
    $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

$data = cleansingParams($data);

$email = trim($data["email"]);

$mailOverlapChk = sql_fetch("
    Select  count(*) as cnt
    From    Users
    Where   email = '{$email}'
")['cnt'];

if ($mailOverlapChk > 0) {
    $returnArray["code"] = "EMAIL_OVERRAPING";
    $returnArray["msg"] = "이미 등록되어있는 이메일입니다";

    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

if (strlen($data["password"]) < 8) {
    $returnArray = array(
        "code"=>"PASSWORD",
        "msg"=>"비밀번호는 8자리 이상 문자, 숫자, 특수문자 포함하여 입력해주세요"
    );

    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);
}

$password = password_hash($data["password"], PASSWORD_BCRYPT);


$relativeYear = date("YYYY", strtotime("-19 year"));
$dataYear = date("YYYY", strtotime($data["birth"]));

$birthday = date("Ymd", strtotime($data["birth"]));
$nowDate = date("Ymd");
$age = floor(($nowDate - $birthday) / 10000);

if ($age < 19) {
    $returnArray["code"] = "AGE";
    $returnArray["msg"] = "만 19세 미만의 경우에는 서비스 가입이 불가합니다";

    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

if ($data["agreement_service"] == true) {
    $data["agreement_service"] = 1;
} else {
    $data["agreement_service"] = 0;
}

if ($data["agreement_privacy"] == true) {
    $data["agreement_privacy"] = 1;
} else {
    $data["agreement_privacy"] = 0;
}

if ($data["agreement_marketing"] == true) {
    $data["agreement_marketing"] = 1;
} else {
    $data["agreement_marketing"] = 0;
}

$join_sql = sql_query("
    Insert Into Users (email, password, name, birth, phone_number, post_code, address, address_detail, agreement_service, agreement_privacy, agreement_marketing, create_date, update_date)
    Values ('{$email}', '{$password}', '{$data["name"]}', '1994-10-08', '{$data["phone"]}', '{$data["post_code"]}', '{$data["address"]}', '{$data["address_detail"]}', '{$data["agreement_service"]}', '{$data["agreement_privacy"]}', '{$data["agreement_marketing"]}', Now(), Now())
");

if ($join_sql) {
    $returnArray = array(
        "code"=>"SUCCESS",
        "msg"=>"정상처리되었습니다",
    );
} else {
    $returnArray = array(
        "code"=>"ERROR",
        "msg"=>"회원가입 실패 카카오톡 문의 남겨주세요",
        "data"=>$data["agreement_marketing"],
    );
}



echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);
?>