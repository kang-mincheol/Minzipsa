<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$userSubscribeQuery = sql_query("
    Select  US.id, PD.product_name, PD.isSize, US.product_count, PC.color_name, PS.size_text, US.create_date
    From    Users_Subscribe US
    Inner Join Products PD
    On		US.product_id = PD.product_idx
    Inner Join ProductsColor PC
    On      US.product_color = PC.color_id
    Inner Join ProductsSize PS
    On      US.product_size = PS.size_id
    Where   US.user_id = '{$member["id"]}'
    And     US.is_delete = '0'
    Order by PD.product_idx Asc
");

$userSubscribeData = array();

while ($row = sql_fetch_array($userSubscribeQuery)) {
    $userSubscribeData[] = $row;
}

if (count($userSubscribeData) > 0) {
    $returnArray["data"] = $userSubscribeData;
} else {
    $returnArray["code"] = "NULL_DATA";
    $returnArray["msg"] = "구독정보가 없습니다.";
}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;

?>