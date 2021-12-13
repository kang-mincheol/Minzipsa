<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$eventsResults = sql_query("
    Select  *
    From    Events
    Where   start_date < '".date('Y-m-d h:i:s')."'
    And		end_date > '".date('Y-m-d h:i:s')."'
");

while ($row = sql_fetch_array($eventsResults)) {
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