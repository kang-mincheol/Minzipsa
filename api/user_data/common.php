<?
include_once($_SERVER['DOCUMENT_ROOT'].'/api/common.php');   // 기본파일 로드

if (is_null($member)) {
    $returnArray["code"] = "MEMBER_ONLY";
    $returnArray["msg"] = "로그인한 회원만 사용 가능합니다";

    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}
?>