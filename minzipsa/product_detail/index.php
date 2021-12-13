<?
include_once('../../common.php');   // 기본파일 로드
include_once('../../header.php');   // 헤더파일 로드

echo $_GET["product_id"];
?>

<link rel="stylesheet" href="<?=$relative_path?>index.css?ver=<?=getVersion($relative_path.'index.css')?>" />


<div id="page_wrap">

    



</div><!-- page_wrap -->


<script type="text/javascript" src="<?=$relative_path?>index.js?ver=<?=getVersion($relative_path.'index.js')?>" charset="utf-8"></script>
<script type="text/javascript">


</script>
<?
include_once('../../footer.php');   // 푸터파일 로드

?>