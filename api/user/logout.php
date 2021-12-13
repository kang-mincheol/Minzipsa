<?
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드


$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다"
);

session_unset();

if(!empty(get_cookie("keep_login"))){
	//로그인 유지중
	$auth_token = get_cookie("keep_login");
	$row = sql_fetch("
		Delete
		From    AutoLogin
		Where   auth_token = '{$auth_token}'
	");

	set_cookie('keep_login', $auth_token, -3600);
}



echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);
?>