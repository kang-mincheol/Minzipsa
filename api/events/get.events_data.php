<?php
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

$data = json_decode(file_get_contents('php://input'), true);

if (is_null($data) || !checkParams($data, ["eventId"])) {
    $returnArray["code"] = "MISSION_PARAMS";
    $returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}

$eventData = sql_fetch("
    Select  *
    From    Events
    Where   id = '{$data["eventId"]}'
");

if ($eventData) {
    if (date("Y-m-d", strtotime($eventData["end_date"])) < date("Y-m-d")) {
        $returnArray["code"] = "ERROR";
        $returnArray["msg"] = "종료된 이벤트입니다.";
        echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
    } else {
        $returnArray["data"] = $eventData;
    }
} else {
    $returnArray["code"] = "ERROR";
    $returnArray["msg"] = "이벤트 정보가 존재하지 않습니다";
    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
?>