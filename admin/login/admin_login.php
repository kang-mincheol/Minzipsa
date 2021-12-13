<?
include_once('../common.php');   // 기본파일 로드
include_once('../header.php');   // 헤더파일 로드
include_once('../menu.php');     // 메뉴파일 로드


$id = $_GET["id"];

$data = getMember_admin($id);
$_SESSION['user_id'] = $data["email"];


?>
<script type="text/javascript">
    location.href = "/";
</script>


<?
include_once('../footer.php');   // 푸터파일 로드
?>