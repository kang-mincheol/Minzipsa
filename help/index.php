<?php
include_once('../common.php');   // 기본파일 로드
include_once('../header.php');   // 헤더파일 로드
include_once('../menu.php');     // 메뉴파일 로드
?>

<link href="<?=$relative_path?>css/index.css?ver=<?=getVersion($relative_path.'css/index.css')?>" rel="stylesheet" type="text/css"/>

<div id="container">

<div id="help_wrapper">
    
    <div class="page_title">
        <p class="title_text">고객센터</p>
    </div>

    <div class="help_remote_wrap">
        <button class="remote_btn" name="notice" onclick="helpWrapRemote(this.name)">공지사항</button>
        <button class="remote_btn" name="faq" onclick="helpWrapRemote(this.name)">FAQ</button>
    </div>

    <div class="contents_wrap">

        <div class="help_wrap" name="notice">

            <div class="notice_wrap">
                <div class="notice_row">
                    <a class="notice_title" href="#">공지사항1</a>
                    <p class="notice_date">2020. 10. 08</p>
                </div>
                <div class="notice_row">
                    <a class="notice_title" href="#">공지사항1</a>
                    <p class="notice_date">2020. 10. 08</p>
                </div>
                <div class="notice_row">
                    <a class="notice_title" href="#">공지사항1</a>
                    <p class="notice_date">2020. 10. 08</p>
                </div>
                <div class="notice_row">
                    <a class="notice_title" href="#">공지사항1</a>
                    <p class="notice_date">2020. 10. 08</p>
                </div>
            </div>

            <div class="btn_wrap">
                <button class="more_btn">더 보기</button>
            </div>

        </div><!-- notice -->

        <div class="help_wrap" name="faq">
            
            <div class="faq_wrap">
                
                <div class="faq_row" name="1">
                    <div class="title_box">
                        <a class="faq_title" href="#" name="1" onclick="faqViewRemote(this)">민집사가 뭐에오??</a>
                        <button class="arrow_btn" name="1" onclick="faqViewRemote(this)">
                            <img src="/img/icon/arrow_1_down.png" alt="화살표"/>
                        </button>
                    </div>
                    <div class="contents_box">
                        test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 텍스트 test텍스트 test텍스트 test텍스트 텍스트 test텍스트 test텍스트 test텍스트 텍스트 test텍스트 test텍스트 test텍스트 텍스트 test텍스트 test텍스트 test텍스트
                    </div>
                </div>

                <div class="faq_row" name="2">
                    <div class="title_box">
                        <a class="faq_title" href="#" name="2" onclick="faqViewRemote(this)">민집사가 뭐에오??</a>
                        <button class="arrow_btn" name="2" onclick="faqViewRemote(this)">
                            <img src="/img/icon/arrow_1_down.png" alt="화살표"/>
                        </button>
                    </div>
                    <div class="contents_box">
                        test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트
                    </div>
                </div>

                <div class="faq_row" name="3">
                    <div class="title_box">
                        <a class="faq_title" href="#" name="3" onclick="faqViewRemote(this)">민집사가 뭐에오??</a>
                        <button class="arrow_btn" name="3" onclick="faqViewRemote(this)">
                            <img src="/img/icon/arrow_1_down.png" alt="화살표"/>
                        </button>
                    </div>
                    <div class="contents_box">
                        test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트 test텍스트
                    </div>
                </div>
                
            </div>
            
        </div>

    </div><!-- contents_wrap -->

</div>

</div><!-- container -->

<script type="text/javascript" src="<?=$relative_path?>js/index.js?ver=<?=getVersion($relative_path.'js/index.js')?>"></script>
<script type="text/javascript">
helpWrapRemote('notice');



</script>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>