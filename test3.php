<?

header("Content-Type: text/html; charset=UTF-8");
include_once('common.php');   // 기본파일 로드
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/sms.lib.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/mailer.lib.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/paygate.lib.php');


$returnArray = array(
    "code"=>"SUCCESS",
    "msg"=>"정상적으로 처리되었습니다."
);

$from_guid = "DVFdGr4GP3T5PSMKSwbmLT"; //데일리페이제일차
$to_guid = "Dczi1qo4uU3YV2mNYtbfVS"; //이민우


$returnArray = PayGate::send_money($from_guid, $to_guid, 100, 'PrePay_3');
//$returnArray = PayGate::send_admin_money($to_guid, 9900, 'PrePay_5');



echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);

?>