<?
error_reporting(E_ERROR);
include_once($_SERVER['DOCUMENT_ROOT'].'/common.php');   // 기본파일 로드

//post 방식의 요청이 아닌 경우
if($_SERVER["REQUEST_METHOD"] != "POST"){
    //exit;
}

//PHPSESSID 쿠키 존재 유무 확인
if(is_null($_COOKIE) || is_null($_COOKIE["PHPSESSID"])){
    //exit;
}

function checkParams($params, $keys){
    //$keys = ["ci", "prod_cd"];
    foreach ($keys as $key) {
        if(!array_key_exists($key, $params)){
            return false;
        }
    }

    return true;
}

function cleansingParams($params){
    global $con;
    foreach ($params as $param => $value) {
        if(is_array($value)){
            cleansingParams($value);
        }
        else{
            //$value = str_replace("==", "#%$@%#%", $value); 
            if(gettype($value) == "string"){
                $value = mysqli_real_escape_string($con, $value);
                $value = rawurldecode($value);
            }
            //$value = str_replace("#%$@%#%", "==", $value);
            $params[$param] = $value;
        }
        
    }
    return $params;
}

?>