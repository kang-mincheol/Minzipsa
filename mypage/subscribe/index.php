<?
include_once('../../common.php');   // 기본파일 로드
include_once('../../header.php');   // 헤더파일 로드

if(is_null($member)) {?>
<script type="text/javascript">
    minzipsaAlert("로그인 후 접근이 가능합니다.", "/?loginOn=true");
</script>
<? exit; }?>

<link rel="stylesheet" href="<?=$relative_path?>index.css?ver=<?=getVersion($relative_path.'index.css')?>" />


<div id="pageWrapper">
    
    <div id="payment_info" class="info_box">
        <div class="title_wrap">
            <p class="box_title">결제 수단 정보</p>
            <a href="#" class="more_btn">더 보기</a>
        </div>

        <div class="box_contents_wrap">
            <!-- 결제 수단 없는 경우 -->
<!--
            <div class="no_payments_box">
                <a href="#" class="payments_add_btn">
                    <p class="plus_article"></p>
                    <p class="add_text">결제수단 등록</p>
                </a>
            </div>
-->

            <!-- 결제 수단 등록 되어 있는 경우 -->
            <div class="payments_box">
                
            </div>
        </div>
    </div><!-- payment_info -->

    <div id="subscribe_info" class="info_box">
        <div class="title_wrap">
            <p class="box_title">구독 정보</p>
        </div>

        <div class="box_contents_wrap">
            <div class="subscribe_row">
                <div class="top_box">
                    <p class="product_name">매트리스 커버</p>
                </div>
                <div class="bottom_box">
                    <div class="data_text_box">사이즈 : S</div>
                    <div class="data_text_box">컬러 : 화이트</div>
                    <div class="data_text_box">수량 : 1</div>
                </div>
            </div>
        </div>
    </div><!-- subscribe_info -->
    
</div><!-- pageWrapper -->

<script type="text/javascript" src="<?=$relative_path?>index.js?ver=<?=getVersion($relative_path.'index.js')?>" ></script>
<script type="text/javascript">
$(function() {
    arrTest();
})
</script>
<?
include_once('../../footer.php');   // 푸터파일 로드

?>