<?
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드


print_r($_FILES);

//exit;


$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다",
	"data"=>array()
);

$group_key = GUID();

$returnArray["data"] = array(
	"group_key"=>$group_key,
	"files"=>array()
);

foreach($_FILES as $file){
	upload_file($file);
}

function upload_file($file){
	global $group_key;
	global $returnArray;
	global $member;

	$guid = GUID();
	$target_dir = "../../../files/";
	$target_file = $target_dir.$guid;
	$extension = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));

	// check login
	if(is_null($member)){
		$returnArray["data"]["files"][] = array(
			"is_success"=>false,
			"reason"=>"first login.",
			"guid"=>"",
			"file_name"=>$file["name"],
			"extension"=>$extension,
			"file_type"=>$file["type"],
			"file_size"=>$file["size"]
		);
		return;
	}

	// Check file size
	if ($file["size"] > 5000000) {
		$returnArray["data"]["files"][] = array(
			"is_success"=>false,
			"reason"=>"file size is too large.",
			"guid"=>"",
			"file_name"=>$file["name"],
			"extension"=>$extension,
			"file_type"=>$file["type"],
			"file_size"=>$file["size"]
		);
		return;
	}

	// Allow certain file formats
	if(array_search($extension, explode("|", ALLOW_FILES)) === false) {
		$returnArray["data"]["files"][] = array(
			"is_success"=>false,
			"reason"=>"this file extension is not allowed.",
			"guid"=>"",
			"file_name"=>$file["name"],
			"extension"=>$extension,
			"file_type"=>$file["type"],
			"file_size"=>$file["size"]
		);
		return;
	}
	
	if (move_uploaded_file($file["tmp_name"], $target_file)) {
		sql_query("
			Insert into Files
			(guid, group_key, file_name, extension, file_type, file_size, create_date, id_users)
			Values
			('{$guid}', '{$group_key}', '{$file["name"]}', '{$extension}', '{$file["type"]}', '{$file["size"]}', now(), {$member["id"]})
		");
		
		$returnArray["data"]["files"][] = array(
			"is_success"=>true,
			"reason"=>"",
			"guid"=>$guid,
			"file_name"=>$file["name"],
			"extension"=>$extension,
			"file_type"=>$file["type"],
			"file_size"=>$file["size"]
		);
	} else {
		$returnArray["data"]["files"][] = array(
			"is_success"=>false,
			"reason"=>"unknown error",
			"guid"=>"",
			"file_name"=>$file["name"],
			"extension"=>$extension,
			"file_type"=>$file["type"],
			"file_size"=>$file["size"]
		);
	}
}

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);

?>