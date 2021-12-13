<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["product_data"])) {
    $returnArray["code"] = "MISSING_PARAMS";
    $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

$data = cleansingParams($data);

for ($i = 0; $i < count($data["product_data"]); $i++) {
    $product_id = $data["product_data"][$i]["product_id"];
    $product_count = $data["product_data"][$i]["product_count"];
    $product_color = $data["product_data"][$i]["product_color"];
    $product_size = $data["product_data"][$i]["product_size"];

    $updateQuery = sql_query("
        Insert Into Users_Subscribe
        (user_id, product_id, product_count, product_color, product_size, create_date, update_date, is_delete)
        Values
        ('{$member["id"]}', '{$product_id}', '{$product_count}', '{$product_color}', '{$product_size}', Now(), Now(), '0')
        On Duplicate Key Update
        product_count = '{$product_count}',
        product_color = '{$product_color}',
        product_size = '{$product_size}',
        update_date = Now(),
        is_delete = '0'
    ");

    if(!$updateQuery) {
        $returnArray["code"] = "ERROR";
        $returnArray["msg"] = "구독상품 일부 업데이트 실패</br>구독/결제 정보 페이지에서 구독 정보를 확인해주세요";

        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
    }
}

echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;

?>