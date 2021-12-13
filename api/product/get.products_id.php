<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

error_reporting(E_ALL);
ini_set("display_errors", 1);

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["id"])){
	if(IS_LIVE){
		$returnArray["code"] = "MISSING_PARAMS";
		$returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";	
		echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
	} else {
		$data = array(
			"id"=>"1"
		);
	}
}

$data = cleansingParams($data);

$select = sql_fetch("
    Select  *
    From    Products
    Where   product_idx = '{$data["id"]}'
");

if ($select) {
    if ($select["isView"] == 0) {
        $returnArray["code"] = "ERROR";
        $returnArray["msg"] = "현재 판매중인 상품이 아닙니다";
    } else {
        $returnArray["data"] = $select;
    }
} else {
    $returnArray["code"] = "ERROR";
    $returnArray["msg"] = "상품 데이터 불러오기 실패</br>관리자에게 문의하세요";

    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
?>