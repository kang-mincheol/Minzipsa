<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["product_id"])) {
    $returnArray["code"] = "MISSING_PARAMS";
    $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

$data = cleansingParams($data);

$subscribeProductDelete = sql_query("
    UPDATE  Users_Subscribe
    SET     update_date = NOW(), is_delete = '1'
    WHERE   (product_id = '{$data["product_id"]}') and (user_id = '{$member["id"]}');
");

if (!$subscribeProductDelete) {
    $returnArray["code"] = "ERROR";
    $returnArray["msg"] = "구독 제품 삭제에 실패했습니다</br>관리자에게 문의해 주세요";
}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;

?>