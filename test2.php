<?
header("Content-Type: application/json; charset=UTF-8");
//header("Content-Type: text/html; charset=UTF-8");
include_once('common.php');   // 기본파일 로드
include_once($_SERVER['DOCUMENT_ROOT'].'/plugin/simple_html_dom.php');

$curl = curl_init("https://api.honestnow.co.kr/homeTax/companyInfo/4918100689");

curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array(
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "Accept-Encoding: deflate",
            "Accept-Language: ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7",
            "Connection: keep-alive",
            "Sec-Fetch-Mode: navigate",
            "Sec-Fetch-Site: none",
            "upgrade-insecure-requests: 1"
        ));
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36");
curl_setopt($curl, CURLOPT_POST, false);

$response = curl_exec($curl);
$resinfo = curl_getinfo($curl);

curl_close($curl);

$response = json_decode(substr($response, $resinfo["header_size"]), true);

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>