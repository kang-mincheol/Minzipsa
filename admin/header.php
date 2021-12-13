<?
if (!defined('NO_ALONE')) exit; // 개별 페이지 접근 불가
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>데일리페이 관리자</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/admin/plugins/jsgrid/jsgrid.min.css">
    <link rel="stylesheet" href="/admin/plugins/jsgrid/jsgrid-theme.min.css">

    <link rel="stylesheet" href="/admin/plugins/fullcalendar/main.min.css">
    <link rel="stylesheet" href="/admin/plugins/fullcalendar-daygrid/main.min.css">
    <link rel="stylesheet" href="/admin/plugins/fullcalendar-timegrid/main.min.css">
    <link rel="stylesheet" href="/admin/plugins/fullcalendar-bootstrap/main.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    <!-- jQuery -->
    <script src="/admin/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/admin/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="/admin/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/admin/plugins/moment/moment.min.js"></script>
    <script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <!-- fullCalendar 2.2.5 -->
    <script src="/admin/plugins/fullcalendar/main.min.js"></script>
    <script src="/admin/plugins/fullcalendar-daygrid/main.min.js"></script>
    <script src="/admin/plugins/fullcalendar-timegrid/main.min.js"></script>
    <script src="/admin/plugins/fullcalendar-interaction/main.min.js"></script>
    <script src="/admin/plugins/fullcalendar-bootstrap/main.min.js"></script>

    <script src="/admin/dist/js/adminlte.js"></script>
    <script src="/admin/plugins/jsgrid/jsgrid.min.js"></script>
    <script src="/js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="/admin/js/common.js?ver=<?= getVersion('/admin/js/common.js') ?>"></script>
    <script type="text/javascript">
        $.blockUI.defaults = {
            // message displayed when blocking (use null for no message) 
            message: '<img style="width:80px" src=\"/img/loading.gif\" alt=\"loading\"/>',

            title: null, // title string; only used when theme == true 
            draggable: true, // only used when theme == true (requires jquery-ui.js to be loaded) 

            theme: false, // set to true to use with jQuery UI themes 

            // styles for the message when blocking; if you wish to disable 
            // these and use an external stylesheet then do this in your code: 
            // $.blockUI.defaults.css = {}; 
            css: {
                padding: 0,
                margin: 0,
                top: '50%',
                left: '50%',
                transform: 'translate(-50%, -50%)'
            },

            // styles for the overlay 
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.6,
                cursor: 'wait'
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
            fadeIn: 200,

            // fadeOut time in millis; set to 0 to disable fadeOut on unblock 
            fadeOut: 400,

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
    <link rel="shortcut icon" href="/favicon.ico">
    <style type="text/css">
        .jsgrid-header-sort:before {
            margin-top: 8px;
        }
    </style>

    <script type="text/javascript">
        function logout() {
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                url: "/api/user/logout.php",
                success: function(data) {
                    console.log(data);
                    location.href = "/";
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" style="margin-top:5px;"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="/">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item dropdown">

                    <a class="nav-link" href="#" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i>
                        Log out
                    </a>
                </li>
            </ul>
        </nav>


        <!-- modal-wrap -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Default Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                        <!--                        <button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- modal-wrap END -->