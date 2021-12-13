<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$tttt = sql_query("
    INSERT INTO Users_Subscribe (user_id, product_id, product_count, product_color, product_size, is_delete) VALUES ('asdfasd', '1', '1', '1', '1', '0');
");

if($tttt) {
    $returnArray["code"] = "ERROR";
}

echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;

?>