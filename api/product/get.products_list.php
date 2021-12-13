<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$productsResults = sql_query("
    Select  *
    From    Products
    Where   isView = '1'
    Order by product_idx Asc
");

while ($row = sql_fetch_array($productsResults)) {
    $returnArray["product"][] = $row;
}

if (count($returnArray["product"]) > 0) {
    
} else {
    $returnArray = array(
        "code"=>"ERROR",
        "msg"=>"구독 상품 데이터 조회 실패",
    );
    
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

$productsSoldResults = sql_query("
    Select  *
    From    ProductsSold
    Where   isView = '1'
    Order by sold_idx Asc
");

while ($row = sql_fetch_array($productsSoldResults)) {
    $returnArray["sold"][] = $row;
}

if (count($returnArray["sold"]) > 0) {
    
} else {
    $returnArray = array(
        "code"=>"ERROR",
        "msg"=>"판매 상품 데이터 조회 실패",
    );

    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;

?>