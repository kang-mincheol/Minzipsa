<?
if (!defined('NO_ALONE')) exit; // 개별 페이지 접근 불가
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<!--
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="title" content="데일리페이 선정산 서비스">
<meta name="subject" content="데일리페이">
<meta name="description" content="업계 최초 최저 수수료 하루 0.03%, 기다림 없이 빠른 정산. 온라인 셀러를 위한 24시간 이용가능한 편리한 선정산 서비스입니다.">
<meta name="keywords" content="선정산서비스,위메프정산,티몬정산,위메프입점,티몬입점,데일리펀딩,비타페이,얼리페이,프리페이,미리페이,공급망금융,쿠팡정산,온라인셀러,선정산">
<meta name="writer" content="데일리페이">
<meta name="author" content="데일리페이">
<meta name="copyright" content="데일리페이">
<meta name="robots" content="ALL">

<meta property="og:type" content="website">
<meta property="og:title" content="데일리페이 선정산 서비스">
<meta property="og:description" content="업계 최초 최저 수수료 하루 0.03%, 기다림 없이 빠른 정산. 온라인 셀러를 위한 24시간 이용 가능한 편리한 선정산 서비스입니다.	">
-->
<!--
<meta property="og:image" content="https://www.daily-pay.co.kr/img/2896453-317500.png">
<meta property="og:url" content="https://www.daily-pay.co.kr">
-->


<!-- safari 앵커태그 방지 -->
<meta name="format-detection" content="telephone=no" />
<title>민집사</title>
<link rel="shortcut icon" href="/favicon.ico">
<!--[if lte IE 8]>
<script src="https://www.daily-funding.com:443/js/html5.js"></script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="/css/main.css?version=<?=getVersion('/css/main.css')?>" />
<link rel="stylesheet" type="text/css" href="/fonts/fonts.css?version=<?=getVersion('/fonts/fonts.css')?>" />
<link rel="stylesheet" type="text/css" href="/css/all.min.css"/>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/common.js?ver=<?=getVersion('/js/common.js')?>" ></script>

<!-- jQuery Block UI -->
<script src="/js/jquery.blockUI.js"></script>
<script type="text/javascript">
    $.blockUI.defaults = { 
        // message displayed when blocking (use null for no message) 
        message:  '<img src=\"/img/index/loading.gif\" alt=\"loading\"/>', 

        title: null,        // title string; only used when theme == true 
        draggable: true,    // only used when theme == true (requires jquery-ui.js to be loaded) 

        theme: false, // set to true to use with jQuery UI themes 

        // styles for the message when blocking; if you wish to disable 
        // these and use an external stylesheet then do this in your code: 
        // $.blockUI.defaults.css = {}; 
        css: { 
            padding:        0, 
            margin:         0, 
            width:          '100px', 
            top:            '50%', 
            left:           '50%', 
            transform:      'translate(-50%, -50%)'
        },

        // styles for the overlay 
        overlayCSS:  { 
            backgroundColor: '#000', 
            opacity:         0.3, 
            cursor:          'wait' 
        }, 

        // style to replace wait cursor before unblocking to correct issue 
        // of lingering wait cursor 
        cursorReset: 'default', 

        

        // IE issues: 'about:blank' fails on HTTPS and javascript:false is s-l-o-w 
        // (hat tip to Jorge H. N. de Vasconcelos) 
        iframeSrc: /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank', 

        // force usage of iframe in non-IE browsers (handy for blocking applets) 
        forceIframe: false, 

        // z-index for the blocking overlay 
        baseZ: 2000, 

        // set these to true to have the message automatically centered 
        centerX: true, // <-- only effects element blocking (page block controlled via css above) 
        centerY: true, 

        // allow body element to be stetched in ie6; this makes blocking look better 
        // on "short" pages.  disable if you wish to prevent changes to the body height 
        allowBodyStretch: true, 

        // enable if you want key and mouse events to be disabled for content that is blocked 
        bindEvents: true, 

        // be default blockUI will supress tab navigation from leaving blocking content 
        // (if bindEvents is true) 
        constrainTabKey: true, 

        // fadeIn time in millis; set to 0 to disable fadeIn on block 
        fadeIn:  200, 

        // fadeOut time in millis; set to 0 to disable fadeOut on unblock 
        fadeOut:  400, 

        // time in millis to wait before auto-unblocking; set to 0 to disable auto-unblock 
        timeout: 0, 

        // disable if you don't want to show the overlay 
        showOverlay: true, 

        // if true, focus will be placed in the first available input field when 
        // page blocking 
        focusInput: true, 

        // suppresses the use of overlay styles on FF/Linux (due to performance issues with opacity) 
        // no longer needed in 2012 
        // applyPlatformOpacityRules: true, 

        // callback method invoked when fadeIn has completed and blocking message is visible 
        onBlock: null, 

        // callback method invoked when unblocking has completed; the callback is 
        // passed the element that has been unblocked (which is the window object for page 
        // blocks) and the options that were passed to the unblock call: 
        //   onUnblock(element, options) 
        onUnblock: null, 

        // don't ask; if you really must know: http://groups.google.com/group/jquery-en/browse_thread/thread/36640a8730503595/2f6a79a77a78e493#2f6a79a77a78e493 
        quirksmodeOffsetHack: 4, 

        // class name of the message block 
        blockMsgClass: 'blockMsg', 

        // if it is already blocked, then ignore it (don't unblock and reblock) 
        ignoreIfBlocked: false 
    }; 
</script>

</head>
<body>

<link href="/css/header.css?ver=<?=getVersion('/css/header.css')?>" rel="stylesheet" type="text/css"/>

<!-- header -->

<div id="header">
    
    <div class="header_wrap">
        <div class="logo_wrap">
            <a class="logo_btn" href="/">
                <img src="/img/config/logo.png" alt="logo"/>
            </a>
        </div>

        <div class="menu_wrap">
        <?
            //var_dump($mainMenuArr);
            for ($i = 0; count($mainMenuArr) > $i; $i++) {
        ?>
            <a class="menu_btn<?=$_SERVER['REQUEST_URI'] == $mainMenuArr[$i]["url"] ? " active" : ""?>" href="<?=$mainMenuArr[$i]["url"]?>">
                <?=$mainMenuArr[$i]["name"]?>
            </a>
        <?
            }
        ?>
        </div><!-- menu_wrap END -->

        <div class="hamburger_wrap">

            <button class="hamburger_btn" onclick="sideMenuRemote('on')"><i class="fa fa-bars" aria-hidden="true"></i></button>

        </div>
    </div><!-- header_wrap -->
</div>
<!-- header END -->


<div id="hidden_menu_wrap" class="hidden_menu_wrap_header">
    <div class="close_btn_wrap">
        <button class="close_btn" onclick="sideMenuRemote()">
            <img src="/img/icon/close@3x.png" alt="닫기" />
        </button>
    </div><?=$kangmincheol?>

    <? if (is_null($member)) { ?>
    
    <div class="user_info_wrap">
        <p class="info_btn_wrap"><a class="info_btn" href="javascript:void(0);" onclick="minzipsaLoginWrapRemote('on');">로그인</a></p>
        <p class="info_btn_wrap"><a class="info_btn" href="/member/join">회원가입</a></p>
    </div>
    
    <? } else { ?>
    
    <div class="user_info_wrap">
        <p class="info_btn_wrap"><a class="info_btn" href="javascript:void(0);" onclick="minzipsaLogout();">로그아웃</a></p>
        <p class="info_btn_wrap"><a class="info_btn" href="/mypage/myinfo/">내 정보</a></p>
        <p class="info_btn_wrap"><a class="info_btn" href="/mypage/subscribe">구독/결제 정보</a></p>
        <p class="info_btn_wrap"><a class="info_btn" href="">결제 내역</a></p>
    </div>
    
    <? } ?>
    

    <div class="m_menu_list_wrap">
        <!-- 모바일 메뉴 -->
    </div>
    
    <div class="cs_menu_wrap">
        <p><a class="cs_menu_btn" href="/help">고객센터</a></p>
    </div>
</div><!-- hidden_menu_wrap -->


<div id="minzipsaLoginWrap">
    <div class="contents_wrap">
        <div class="login_info_wrap">
            <p class="top_title_text">로그인<button class="close_btn" onclick="minzipsaLoginWrapRemote()">닫기</button></p>

            <div class="login_box">

                <div class="input_row">
                    <label for="loginID">이메일(ID)</label>
                    <input type="text" id="loginID" class="custom_input" onkeyup="loginWrapEnterAction()"/>
                </div>

                <div class="input_row">
                    <label for="loginPW">비밀번호</label>
                    <input type="password" id="loginPW" class="custom_input" placeholder="8자리 이상 문자, 숫자, 특수문자 포함" onkeyup="loginWrapEnterAction()"/>
                </div>
                
                <button class="login_btn" onclick="minzipsaLogin();">로그인</button>
                
                <div class="bottom_btn_wrap">
                    <a class="bottom_btn" href="/member/join/">회원가입</a>
                    <a class="bottom_btn" href="/member/join/">ID/PW 찾기</a>
                </div>
                
            </div><!-- login_box -->
            
        </div>
    </div>
</div><!-- minzipsaLoginWrap -->



<div id="minzipsaAlertWrap">
    <div class="alert_box">
        <div class="title_box">알림</div>
        <div class="contents_box">
            <div class="alert_text"></div>
            <button class="confirm_btn" onclick="minzipsaAlert()">확인</button>
        </div>
    </div>
</div><!-- minzipsaAlertWrap -->


<div id="minzipsaConfirmWrap">
    <div class="alert_box">
        <div class="title_box">✔ 확인</div>
        <div class="contents_box">
            <div class="confirm_text"></div>
            <div class="btn_wrap">
                <button class="confirm_btn">확인</button>
                <button class="false_btn" onclick="minzipsaConfirmClose();">취소</button>
            </div>
        </div>
    </div>
</div><!-- minzipsaConfirmWrap -->



<script type="text/javascript" src="/js/header.js?ver=<?=getVersion('/js/header.js')?>"></script>
<script type="text/javascript">
<? if ($_GET["loginOn"] == true) {?>
    minzipsaLoginWrapRemote('on');
<? } ?>



</script>


<div id="container">