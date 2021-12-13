<?

include_once('common.php');   // 기본파일 로드

function generateRandomString($length = 6) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function generateCaptchaImage($text = 'good'){
    // Set the content-type
    header('Content-Type: image/png');
    $width  = 104;
    $height = 41;
    // Create the image
    $im = imagecreatetruecolor($width, $height);

    // Create some colors
    $white  = imagecolorallocate($im, 255, 255, 255);
    $grey   = imagecolorallocate($im, 128, 128, 128);
    $darkgrey   = imagecolorallocate($im, 62, 62, 62);
    $black  = imagecolorallocate($im, 0, 0, 0);
    imagefilledrectangle($im, 0, 0, $width, $height, $white);

    //ADD NOISE - DRAW ELLIPSES
    $ellipse_count = 25;
    for ($i = 0; $i < $ellipse_count; $i++) {
      $cx = (int)rand(-1*($width/2), $width + ($width/2));
      $cy = (int)rand(-1*($height/2), $height + ($height/2));
      $h  = (int)rand($height/2, 2*$height);
      $w  = (int)rand($width/2, 2*$width);
      imageellipse($im, $cx, $cy, $w, $h, $darkgrey);
    }

    // Replace path by your own font path
    $font = './SpoqaHanSansBold.ttf';

    // Add some shadow to the text
    imagettftext($im, 20, 0, 6, 31, $grey, $font, $text);

    // Add the text
    imagettftext($im, 20, 0, 5, 30, $black, $font, $text);

    // Using imagepng() results in clearer text compared with imagejpeg()
    imagepng($im);
    imagedestroy($im);
}

//echo session_id(); "sgjcig1h3u4t7evb095grqh411"

$randomString = generateRandomString();

sql_query("
    Insert into RandomImage
    (session_id, image_text, create_date, update_date)
    Values
    ('".session_id()."', '".$randomString."', now(), now())
    On Duplicate Key Update
    image_text = '".$randomString."',
    update_date = now()
");


generateCaptchaImage($randomString);

?>