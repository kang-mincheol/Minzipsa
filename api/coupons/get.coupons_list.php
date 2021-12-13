<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$couponsResults = sql_query("
    Select	*
    From	Users_Coupons US
    Inner Join Coupons CS
    On		US.coupons_id = CS.id
    Where	US.users_no = '{$member["id"]}'
    And		CS.start_date < '".date('Y-m-d h:i:s')."'
    And		CS.end_date > '".date('Y-m-d h:i:s')."'
    And     US.coupon_use = '0'
");

while ($row = sql_fetch_array($couponsResults)) {
    $returnArray["data"][] = $row;
}

if (count($returnArray["data"]) > 0) {
    $returnArray["code"] = "SUCCESS";
    $returnArray["msg"] = "정상처리되었습니다";
} else if (count($returnArray["data"]) == 0) {
    $returnArray["code"] = "SUCCESS";
    $returnArray["msg"] = "정상처리되었습니다";
    $returnArray["data"] = "";
} else {
    $returnArray = array(
        "code"=>"ERROR",
        "msg"=>"데이터 조회 실패",
    );
}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;

?>