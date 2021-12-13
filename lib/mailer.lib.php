<?php
if (!defined('NO_ALONE')) exit;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT']."/plugin/PHPMailer/src/PHPMailer.php";
require $_SERVER['DOCUMENT_ROOT']."/plugin/PHPMailer/src/SMTP.php";
require $_SERVER['DOCUMENT_ROOT']."/plugin/PHPMailer/src/Exception.php";


// 메일 보내기 (파일 여러개 첨부 가능)
// type : text=0, html=1, text+html=2
function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
{

    $mail = new PHPMailer(true);

    try {
    // 서버세팅
    //디버깅 설정을 0 으로 하면 아무런 메시지가 출력되지 않습니다 2로 하면 디버깅이 가능 합니다.

    $mail -> SMTPDebug = 0; // 디버깅 설정
    $mail -> isSMTP(); // SMTP 사용 설정

    // 지메일일 경우 smtp.gmail.com, 네이버일 경우 smtp.naver.com
    $mail -> Host = SMTP;               // 네이버의 smtp 서버
    $mail -> SMTPAuth = true;                         // SMTP 인증을 사용함
    $mail -> Username = MAIL_ID;    // 메일 계정 (지메일일경우 지메일 계정)
    $mail -> Password = MAIL_PASSWOD;                  // 메일 비밀번호
    $mail -> SMTPSecure = "ssl";                       // SSL을 사용함
    $mail -> Port = SMTP_PORT;                                  // email 보낼때 사용할 포트를 지정
    $mail -> CharSet = "utf-8"; // 문자셋 인코딩

    // 보내는 메일
    $mail -> setFrom($fmail, $fname);

    // 받는 메일
    $mail -> addAddress($to);
    if ($cc)
        $mail->addCC($cc);
    if ($bcc)
        $mail->addBCC($bcc);

    // 메일 내용
    $mail -> isHTML(true); // HTML 태그 사용 여부
    $mail -> Subject = $subject;  // 메일 제목
    $mail -> Body = $content;     // 메일 내용

    // Gmail로 메일을 발송하기 위해서는 CA인증이 필요하다.
    // CA 인증을 받지 못한 경우에는 아래 설정하여 인증체크를 해지하여야 한다.
    $mail -> SMTPOptions = array(
        "ssl" => array(
            "verify_peer" => false
            , "verify_peer_name" => false
            , "allow_self_signed" => true
        )
    );

    // 메일 전송
    return $mail -> send();

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error : ", $mail -> ErrorInfo;
    }
}

?>