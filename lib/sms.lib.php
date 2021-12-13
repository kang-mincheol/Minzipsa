<?

function sms_send($from_hp, $to_hp, $send_msg) {
	$sms_url = "https://apis.aligo.in/send/"; // 전송요청 URL
//	$sms['user_id'] = "dailyfunding"; // SMS 아이디
//	$sms['key'] = "hqtwj5g82kjbnu7gyiqxup9vlsv0vep4";//인증키
//	$sms['msg'] = stripslashes($send_msg);   //메세지
//	$sms['receiver'] = $to_hp;	 //수신자 번호
//	$sms['sender'] = $from_hp;
//	$sms['title'] = '데일리페이';
//	$host_info = explode("/", $sms_url);
//	$port = $host_info[0] == 'https:' ? 443 : 80;

	$oCurl = curl_init();
	curl_setopt($oCurl, CURLOPT_PORT, $port);
	curl_setopt($oCurl, CURLOPT_URL, $sms_url);
	curl_setopt($oCurl, CURLOPT_POST, 1);
	curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
	curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
	$ret = curl_exec($oCurl);
	curl_close($oCurl);

	return json_decode($ret); // 결과배열
}

?>