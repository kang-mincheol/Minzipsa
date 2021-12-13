<?
include_once('common.php');   // 기본파일 로드
include_once('header.php');   // 헤더파일 로드
?>


<link rel="stylesheet" href="<?=$relative_path?>css/index.css?ver=<?=getVersion($relative_path.'css/index.css')?>" />

<div id="container">

<div id="main_wrap">
    
    <div id="section_1">
        <div class="section_wrap">
            <div class="main_text_wrap">
                부피도 크고<span class="mobile_enter"></br></span> 시간도 오래걸리는</br>
                이불빨래 어떻게 하시나요?</br>
                집? 코인세탁소?</br>
                이제 저희 <span class="hit">집사</span>들이<span class="mobile_enter"></br></span> 하겠습니다!
            </div>
        </div>
    </div><!-- section_1 -->

    <div id="section_2">
        <div class="section_wrap">
            <div class="contents_box box_1">
                <div class="cover_img">
                    <img src="/img/index/section_2_1.png" alt="cover_1"/>
                </div>
                <p class="box_title">정기배송이 필요한</br>침구류 선택하고</p>
                <p class="box_text">
                    
                </p>
            </div>

            <div class="contents_box box_2">
                <div class="cover_img">
                    <img src="/img/index/section_2_2.png" alt="cover_2"/>
                </div>
                <p class="box_title">결제하고</p>
            </div>

            <div class="contents_box box_3">
                <div class="cover_img">
                    <img src="/img/index/section_2_3.png" alt="cover_3"/>
                </div>
                <p class="box_title">원하는 날짜에 배송</p>
            </div>

        </div>
    </div><!-- section_2 -->

    <div id="section_3">
        <div class="bg_layer">
            <div class="section_wrap">
                <p class="box_title">
                    한번하려면 마음 먹고 해야하는 이불빨래</br>
                    빨래 1시간 꿉꿉하지 않게 건조 1시간에</br>
                    큰 부피에 세탁소비용까지 <span class="imoji">🤦‍♂️</span></br>
                    민집사로 해결
                </p>
                <a class="link_btn" href="/minzipsa">이용방법 바로가기</a>
            </div>
        </div>
    </div><!-- section_3 -->

    <div id="section_4">
        <div class="section_wrap">
        </div>
    </div><!-- section_4 -->
    
    <div id="section_5">
        <div class="section_wrap">
        
            <p class="box_title">민집사에 대해 궁금하다면?</p>
            
            <a class="link_btn" href="/help">고객센터 바로가기</a>
        
        </div>
    </div><!-- section_5 -->
    
    
</div>
    
    
    
</div><!-- container -->








<script type="text/javascript" src="<?=$relative_path?>js/index.js?ver=<?=getVersion($relative_path.'js/index.js')?>" ></script>
<script type="text/javascript">

    
$(function() {

});

</script>
<?


include_once('footer.php');   // 푸터파일 로드

?>