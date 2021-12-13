<?
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다",
	"data"=>array()
);

$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["group_key"])){
	if(IS_LIVE){
		$returnArray["code"] = "MISSING_PARAMS";
		$returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";	
		echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
	}
	else{
		$data = array(
			"group_key"=>"49561C25-8C34-4665-8034-25E1C7701167"
		);
	}
}

$data = cleansingParams($data);

if($member["is_admin"]){
    $results = sql_query("
        Select  guid, file_name, extension, file_type, file_size
        From    Files
        Where   group_key = '{$data["group_key"]}'
    ");
}
else{
    $results = sql_query("
        Select  guid, file_name, extension, file_type, file_size
        From    Files
        Where   group_key = '{$data["group_key"]}'
        And     id_users = {$member["id"]}
    ");
}

while($row = sql_fetch_array($results)){
    $returnArray["data"][] = $row;
}


echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);

?>