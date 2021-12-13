<?
header("Content-Type: application/json; charset=UTF-8");
include_once($_SERVER['DOCUMENT_ROOT'].'/common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);


$data = json_decode(file_get_contents('php://input'), true);



$join_sql = sql_query("
    Insert Into Users (email, password, name, birth, phone_number, post_code, address, address_detail, agreement_service, agreement_privacy, agreement_marketing, create_date, update_date)
    Values ('test', 'test1', 'test2', '1994-10-08', '01024995686', '12345', 'test4', 'test5', '1', '1', '1', Now(), Now());
");
echo $join_sql;
if ($join_sql) {
    $returnArray = array(
        "code"=>"SUCCESS",
        "msg"=>"정상처리되었습니다",
    );
} else {
    $returnArray = array(
        "code"=>"ERROR",
        "msg"=>"회원가입 실패 카카오톡 문의 남겨주세요",
        "test"=>date("Y-m-d H:i:s"),
    );
}



echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);
?>