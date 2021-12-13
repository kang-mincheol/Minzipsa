<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$userAddress = sql_fetch("
    Select  post_code, address, address_detail
    From    Users
    Where   id = '{$member["id"]}'
");

if ($userAddress["post_code"] == NULL || $userAddress["post_code"] == "") {
    $returnArray["code"] = "ADDRESS_NULL";
    $returnArray["msg"] = "등록된 주소지가 없습니다";

    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
} else {
    $returnArray["data"] = $userAddress;
}

echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;

?>