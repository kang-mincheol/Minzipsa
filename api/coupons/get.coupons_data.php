<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$data = json_decode(file_get_contents('php://input'), true);

if (is_null($data) || !checkParams($data, ["couponId"])) {
    $returnArray["code"] = "MISSION_PARAMS";
    $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

$couponData = sql_fetch("
    Select  *
    From    Coupons
    Where   id = '{$data["couponId"]}'
");

if ($couponData) {
    if (date("Y-m-d", strtotime($couponData["end_date"])) < date("Y-m-d")) {
        $returnArray["code"] = "ERROR";
        $returnArray["msg"] = "사용기한이 지난 쿠폰입니다";
        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
    } else {
        $returnArray["data"] = $couponData;
    }
} else {
    $returnArray["code"] = "ERROR";
    $returnArray["msg"] = "쿠폰 정보가 존재하지 않습니다";
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
?>