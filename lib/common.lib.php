<?

include_once($_SERVER['DOCUMENT_ROOT'] . '/plugin/simple_html_dom.php');

// 세션변수 생성
function set_session($session_name, $value)
{
    $$session_name = $_SESSION[$session_name] = $value;
}


// 세션변수값 얻음
function get_session($session_name)
{
    return isset($_SESSION[$session_name]) ? $_SESSION[$session_name] : '';
}

function getVersion($file_path)
{
    return date("YmdHis", filemtime($_SERVER['DOCUMENT_ROOT'] . $file_path));
}

//사용자 반환
function getMember_admin($id)
{
    $member = sql_fetch("
		Select  *
		From	Users
        Where	id = '{$id}'
        And     is_delete = 0
	");

    return $member;
}

//사용자 반환
function getMember($user_id)
{
    $member = sql_fetch("
		Select  *
		From	Users
        Where	email = '{$user_id}'
        And     is_delete = 0
	");

    return $member;
}

//사용자 정보 업데이트
function refreshMember()
{
    global $member;
    $member = getMember($member["company_no"]);
}

// 쿠키변수 생성
function set_cookie($cookie_name, $value, $expire)
{
    setcookie(md5($cookie_name), base64_encode($value), time() + $expire, '/');
}

// 쿠키변수값 얻음
function get_cookie($cookie_name)
{
    $cookie = md5($cookie_name);
    if (array_key_exists($cookie, $_COOKIE))
        return base64_decode($_COOKIE[$cookie]);
    else
        return "";
}
