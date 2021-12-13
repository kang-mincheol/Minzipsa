<?
header("Content-Type: application/json; charset=UTF-8");
include_once('common.php');   // 기본파일 로드
include_once($_SERVER['DOCUMENT_ROOT'].'/plugin/simple_html_dom.php');

$returnArray = array(
	"code"=>"SUCCESS",
	"msg"=>"정상처리되었습니다",
	"data"=>array()
);


$data = json_decode(file_get_contents('php://input'), true);

if(is_null($data) || !checkParams($data, ["company_num"])){
	if(IS_LIVE){
		$returnArray["code"] = "MISSING_PARAMS";
		$returnArray["msg"] = "필수 파라미터가 존재하지 않습니다.";	
		echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
	}
	else{
		$data = array(
			"company_num"=>"112-23-34455"
		);
	}
}

$data = cleansingParams($data);

$company_no = preg_replace("/[^0-9]*/u", "", $data["company_num"]);

//기 가입된 회원인지 판단한다
$result = sql_fetch("
	SELECT	*
	FROM	daily_prepay.Users
	Where	company_no = '{$company_no}'
	And		is_delete = 0
");

if(count($result) > 0){
	$returnArray["code"] = "ALREADY_EXISTS";
	$returnArray["msg"] = "기 가입된 회원 입니다.";	
	echo json_encode($returnArray, JSON_UNESCAPED_UNICODE); exit;
}


$curl = curl_init("http://www.kreport.co.kr/ctcssr_a30s.do");
$content = "cmQueryOption=00&cmTotalRowCount=&cmPageNo=1&cmSortField=ENP_SCD&cmSortOption=0&cmRowCountPerPage=10&enpScdNormalYn=Y&cmQuery=".$company_no;

curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array(
			"Content-type: application/x-www-form-urlencoded",
			"Content-Length: ".strlen($content),
			"Connection: keep-alive",
			"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
			"Accept-Encoding: gzip, deflate",
			"Accept-Language: ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7"
		));
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36");
curl_setopt($curl, CURLOPT_REFERER, "http://www.kreport.co.kr/ctcssr_a30s.do");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$response = curl_exec($curl);

$html = str_get_html($response);

if($html->find('li.bizname', 0)->innertext == "조회된 내용이 없습니다."){
	//국세청 홈텍스에서 다시 조회 한다

	$curl = curl_init("https://teht.hometax.go.kr/wqAction.do?actionId=ATTABZAA001R08&screenId=UTEABAAA13&popupYn=false&realScreenId=");
	$content = "<map id=\"ATTABZAA001R08\"><pubcUserNo/><mobYn>N</mobYn><inqrTrgtClCd>1</inqrTrgtClCd><txprDscmNo>".$company_no."</txprDscmNo><dongCode>17</dongCode><psbSearch>Y</psbSearch><map id=\"userReqInfoVO\"/></map>";

	curl_setopt($curl, CURLOPT_HEADER, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
			array(
				"Accept: application/xml; charset=UTF-8",
				"Accept-Encoding: gzip, deflate, br",
				"Accept-Language: ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7",
				"Content-Type: application/xml; charset=UTF-8",
				"Content-Length: ".strlen($content),
				"Host: teht.hometax.go.kr",
				"Origin: https://teht.hometax.go.kr"
			));
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36");
	curl_setopt($curl, CURLOPT_REFERER, "https://teht.hometax.go.kr/websquare/websquare.html?w2xPath=/ui/ab/a/a/UTEABAAA13.xml");
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

	$response = curl_exec($curl);
	$html = str_get_html($response);

	if($html->find('trtCntn', 0)->plaintext == "사업을 하지 않고 있습니다."){
		$returnArray["code"] = "NOT_FOUND";
		$returnArray["msg"] = "조회된 내용이 없습니다.";
		set_session('ss_company_no', NULL);
	}
	else{
		//홈텍스를 통해 조회할 경우 정상/비정상 여부만 판단할 수 있다.
		$returnArray["data"]["company_name"] = "";
		$returnArray["data"]["ceo_name"] = "";
		$returnArray["data"]["status"] = "정상";

		//정상의 경우 사업자 번호를 Session에 저장해둔다.
		set_session('ss_company_no', $company_no);
		set_session('ss_company_name', "");
		set_session('ss_company_ceo', "");
	}
}
else{
	preg_match("\"\/ctcssr_b10g.do[?]iKEDCD=([0-9]{10})\"", $html->find('li.bizname', 0)->innertext, $out);
	$iKEDCD = $out[1];

	preg_match("/<a href=\"\/ctcssr_b10g.do[?]iKEDCD=[0-9]{10}\">[ ]*\t*(.*)[ ]*\t*<\/a>/u", $html->find('li.bizname', 0)->innertext, $out);
	$company_name = $out[1];
	
	$returnArray["data"]["company_name"] = $company_name;

	preg_match("/\(대표자:(.*)\)/u", $html->find('li.bizname', 0)->innertext, $out);
	$ceo_name = $out[1];

	$returnArray["data"]["ceo_name"] = $ceo_name;
	$returnArray["data"]["status"] = $html->find('li.bizname', 0)->find('img', 0)->getAttribute('alt');
	//$returnArray["data"]["address"] = trim(preg_replace('/\s+/', ' ', preg_replace("/[^0-9가-힗a-zA-Z ()]*/u", "", $html->find('li.add', 0)->innertext)));

	//정상의 경우 사업자 번호를 Session에 저장해둔다.
	set_session('ss_company_no', $company_no);
	set_session('ss_company_name', $company_name);
	set_session('ss_company_ceo', $ceo_name);
}

echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);

?>