<?
//error_reporting(E_ALL);
//ini_set("memory_limit" , -1);
include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');   // 설정 파일 로드
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/common.lib.php');   // library 파일 로드




//Session 설정
session_save_path(SESSION_PATH);
@session_start();

//member 전역 변수
$member;

//로그인 설정
if ($_SESSION['user_id']) { // 로그인중이라면
    $member = getMember($_SESSION['user_id']);
}
else{
    if(!empty(get_cookie("keep_login"))){
        //로그인 유지중
        $auth_token = get_cookie("keep_login");
        $row = sql_fetch("
            Select  id_users, user_agent, expire_date, U.company_no
            From    AutoLogin AL
            Inner Join Users U
            On      AL.id_users = U.id
            Where   auth_token = '{$auth_token}'
        ");
    
        if(count($row) >0 && $_SERVER['HTTP_USER_AGENT'] == $row["user_agent"] && date("Y-m-d H:i:s") <= $row["expire_date"]){
            // 현재 해당 쿠키를 가지고 있는 브라우저와 요청한 브라우저가 동일해야 한다.
            // 회원아이디 세션 생성
            set_session('user_id', $row["company_no"]);
            $member = getMember($row["company_no"]);
        }
        else{
            // 만약 다른 브라우저에서 해당 토큰으로 로그인을 시도 했다면, 해킹시도로 판단 하고 토큰을 삭제 한다.
            $row = sql_fetch("
                Delete
                From    AutoLogin
                Where   auth_token = '{$auth_token}'
            ");

            set_cookie('keep_login', $auth_token, -3600);
        }
    }
}

//관리자가 아닐 경우 차단 처리
if(is_null($member) || !$member["is_admin"]){
    echo "<script type='text/javascript'>alert('관리자만 접근 가능합니다.'); location.href = '/';</script>";
    exit;
}


include_once($_SERVER['DOCUMENT_ROOT'].'/log.php');   // 접속 로그 기록

include_once($_SERVER['DOCUMENT_ROOT'].'/admin/menu.php');   // Menu 파일 로드

$relative_path = preg_replace("`\/[^/]*\.php$`i", "/", $_SERVER['PHP_SELF']);

$config = sql_fetch("
    Select  *
    From    Config
");


function SetTitle($title){
    return "
    <div class=\"content-header\">
        <div class=\"container-fluid\">
        <div class=\"row mb-2\">
            <div class=\"col-sm-6\">
            <h1 class=\"m-0 text-dark\">{$title}</h1>
            </div><!-- /.col -->
            <div class=\"col-sm-6\">
            
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    ";
}

?>