<?
include_once('../../common.php');   // 기본파일 로드
include_once('../../header.php');   // 헤더파일 로드
?>

<link rel="stylesheet" href="<?=$relative_path?>index.css?ver=<?=getVersion($relative_path.'index.css')?>" />

<div id="container">


<div id="minzipsa_info">

    <div class="info_wrap">

        <div class="step_wrap" name="step_1">
            <div class="logo_wrap">
                <img src="" alt="logo"/>
            </div>
            <div class="step_title_box">
                <p class="step_title_text">STEP. <span class="bold">1</span></p>
            </div>
            <div class="step_contents_wrap">
                <p class="top_text">
                고객님에게 필요한 제품이 무엇인지 선택하세요.
                </p>
            </div>
            <div class="step_btn_wrap">
                <button class="info_btn">제품 소개 바로가기</button>
                <button class="step_btn" onclick="infoStepRemote('step_2')">다음</button>
            </div>
        </div><!-- step_1 -->

        <div class="step_wrap" name="step_2">
            <div class="logo_wrap">
                <img src="" alt="logo"/>
            </div>
            <div class="step_title_box">
                <p class="step_title_text">STEP. <span class="bold">2</span></p>
            </div>
        </div><!-- step_2 -->

    </div><!-- info_wrap -->

</div><!-- minzipsa_info -->


</div><!-- container -->





<script type="text/javascript" src="<?=$relative_path?>index.js?ver=<?=getVersion($relative_path.'index.js')?>" charset="utf-8"></script>
<script type="text/javascript">
$(function() {
    infoStepRemote('step_1');
});

</script>

<?
include_once('../../footer.php');   // 푸터파일 로드

?>