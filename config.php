<?php

// 이 상수가 정의되지 않으면 각각의 개별 페이지는 별도로 실행될 수 없음
define('NO_ALONE', true);

//define('SERVER_IP', "192.168.219.106");
define('SERVER_IP', "");

//운영서버여부
define('IS_LIVE' , gethostbyname($_SERVER["HTTP_HOST"]) == SERVER_IP); 

//로컬여부
define('IS_LOCAL' , strpos($_SERVER["HTTP_HOST"], "localhost") !== false); 

//테스트 여부
define('IS_TEST' , false); 

define('MYSQL_HOST', IS_LIVE && IS_LOCAL ? '' : 'localhost');
define('MYSQL_USER', 'minzipsa');
define('MYSQL_PASSWORD', 'alswlqtk2020!');
define('MYSQL_DB', 'minzipsa'); 

define('SESSION_PATH', "/var/lib/php/sessions");


define('FROM_MAIL', '');
define('FROM_MAIL_NAME', '민집사');

define('SITE_URL', (IS_LIVE ? "https" : "http").'://'.$_SERVER["HTTP_HOST"]);

define('SAVE_DATA', true);

define('ALLOW_FILES', "jpg|png|jpeg|gif|pdf|hwp|xls|xlsx|doc|docx|mp4");

//define('BACK_URL', "http://192.168.0.80:81/");
define('BACK_URL', "http://localhost:80/");

$con = sql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

sql_query("use minzipsa");
sql_query("set names utf8");


// DB 연결
function sql_connect($host, $user, $pass, $db)
{
	if(function_exists('mysqli_connect')) {
        $link = mysqli_connect($host, $user, $pass, $db, "3360");

        // 연결 오류 발생 시 스크립트 종료
        if (mysqli_connect_errno()) {
            die('Connect Error: '.mysqli_connect_error());
        }
    } 
    // else {
    //     $link = mysql_connect($host, $user, $pass);
    // }

    return $link;
}

// 쿼리를 실행한 후 결과값에서 한행을 얻는다.
function sql_fetch($sql)
{
    global $con;
    $result = sql_query($sql);
    $row = sql_fetch_array($result);
    return $row;
}

function sql_query($sql)
{
    global $con;
    
    $sql = trim($sql);
    // union의 사용을 허락하지 않습니다.
    //$sql = preg_replace("#^select.*from.*union.*#i", "select 1", $sql);
    $sql = preg_replace("#^select.*from.*[\s\(]+union[\s\)]+.*#i ", "select 1", $sql);
    // `information_schema` DB로의 접근을 허락하지 않습니다.
    $sql = preg_replace("#^select.*from.*where.*`?information_schema`?.*#i", "select 1", $sql);

    if(function_exists('mysqli_query')) {
        $result = @mysqli_query($con, $sql);
    } 
    // else {
    //     $result = @mysql_query($sql, $con);
    // }
    
    return $result;
}

function sql_query_identity($sql)
{
    global $con;
    
    $sql = trim($sql);
    // union의 사용을 허락하지 않습니다.
    //$sql = preg_replace("#^select.*from.*union.*#i", "select 1", $sql);
    $sql = preg_replace("#^select.*from.*[\s\(]+union[\s\)]+.*#i ", "select 1", $sql);
    // `information_schema` DB로의 접근을 허락하지 않습니다.
    $sql = preg_replace("#^select.*from.*where.*`?information_schema`?.*#i", "select 1", $sql);

    if(function_exists('mysqli_query')) {
        $result = @mysqli_query($con, $sql);
    } 
    // else {
    //     $result = @mysql_query($sql, $con);
    // }
    
    return $con->insert_id;
}

// 결과값에서 한행 연관배열(이름으로)로 얻는다.
function sql_fetch_array($result)
{
    if(function_exists('mysqli_fetch_assoc'))
        $row = @mysqli_fetch_assoc($result);
    // else
    //     $row = @mysql_fetch_assoc($result);

    return $row;
}




?>