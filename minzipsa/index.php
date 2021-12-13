<?
include_once('../common.php');   // 기본파일 로드
include_once('../header.php');   // 헤더파일 로드
?>


<link rel="stylesheet" href="<?=$relative_path?>index.css?ver=<?=getVersion($relative_path.'index.css')?>" />


<div id="container">

    <div id="contents_1">
        <!-- image -->
    </div><!-- contents_1 -->

    <div id="contents_2">
        
        <div class="section_wrap">
            <div class="left_box">
                <p class="box_text">
                    <span class="blue">민집사</span>는 일상의 사소한 불편함으로부터 출발했습니다.</br>
                    대한민국의 베딩문화 기준을<span class="pc_enter"></br></span>
                    높이자는 큰 꿈을 안고 달려가는 중입니다!
                </p>
            </div>
            
            <div class="right_box">
                <img src="/" alt="민집사 Logo"/>
            </div>
        </div>
        
    </div><!-- contents_2 -->

    <div id="contents_3">
        <div class="section_wrap">
            <div class="left_box">
                <p class="box_title">선택하고</p>
            </div>
            
            <div class="right_box">
            
            </div>
        </div>
    </div><!-- contents_3 -->

</div><!-- container -->






<script type="text/javascript" src="<?=$relative_path?>index.js?ver=<?=getVersion($relative_path.'index.js')?>" charset="utf-8"></script>
<script type="text/javascript">
$(function() {
    
});

</script>

<?
include_once('../footer.php');   // 푸터파일 로드

?>