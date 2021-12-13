<?
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다",
	"data"=>array()
);

$data = array();
parse_str($_SERVER['QUERY_STRING'], $data); 

if(is_null($data) || !checkParams($data, ["guid"])){
	if(IS_LIVE){
		$returnArray["code"] = "MISSING_PARAMS";
		$returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";	
		echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
	}
	else{
		$data = array(
			"guid"=>"23CB80D2-3807-4EA3-8C53-2AFC3704C1F6"
		);
	}
}

$data = cleansingParams($data);


if($member["is_admin"]){
    $result = sql_query("
        Select  guid, file_name, extension, file_type, file_size
        From    Files
        Where   guid = '{$data["guid"]}'
    ");
}
else{
    $result = sql_query("
        Select  guid, file_name, extension, file_type, file_size
        From    Files
        Where   guid = '{$data["guid"]}'
        And     id_users = {$member["id"]}
    ");
}

if($result->num_rows > 0){
    while($row = sql_fetch_array($result)){
        header("Content-Type: {$row["file_type"]}; charset=UTF-8");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:{$row["file_size"]}");
        header("Content-Disposition: inline; filename=\"{$row["file_name"]}\"");
        readfile("../../../files/{$data["guid"]}");
    }
}
else{
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 File not found</h1>";
}


?>