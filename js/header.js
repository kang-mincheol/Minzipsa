function sideMenuRemote (action) {
    if (action == "on") {
        $("#hidden_menu_wrap").addClass("on");
    } else {
        $("#hidden_menu_wrap").removeClass("on");
    }
}

function minzipsaAlert (text, action) {
    if (text == undefined) {// off
        $("#minzipsaAlertWrap").removeClass("on");
        $("#minzipsaAlertWrap .contents_box .alert_text").html("");
        $("#minzipsaAlertWrap .alert_box .contents_box .confirm_btn").attr("onclick", "minzipsaAlert();");
    } else {// on
        $("#minzipsaAlertWrap .contents_box .alert_text").html(text);
        $("#minzipsaAlertWrap").addClass("on");
        if (action != undefined) {
            $("#minzipsaAlertWrap .alert_box .contents_box .confirm_btn").attr("onclick", "minzipsaAlert();" + action);
        }

        $("#minzipsaAlertWrap .alert_box .contents_box .confirm_btn").focus();
    }
}

function minzipsaConfirm (text, action) {
    $("#minzipsaConfirmWrap .contents_box .confirm_text").html(text);
    $("#minzipsaConfirmWrap .contents_box .btn_wrap .confirm_btn").attr("onclick", action + "; minzipsaConfirmClose();");

    $("#minzipsaConfirmWrap").addClass("on");
}

function minzipsaConfirmClose () {
    $("#minzipsaConfirmWrap").removeClass("on");
}

function minzipsaLoginWrapRemote (remote) {
    if (remote == 'on') {
        sideMenuRemote();
        $("#minzipsaLoginWrap").addClass("on");
    } else {
        $("#minzipsaLoginWrap").removeClass("on");
    }
}

function minzipsaLogin() {
    var loginID = $("#minzipsaLoginWrap #loginID").val().trim();
    var loginPW = $("#minzipsaLoginWrap #loginPW").val();
    
    if (loginID == "") {
        return minzipsaAlert("이메일(ID)를 입력해주세요", "$('#loginID').focus();");
    } else if (loginPW == "") {
        return minzipsaAlert("비밀번호를 입력해주세요", "$('#loginPW').focus();");
    }
    
    $.ajax({
        type: "POST",
        url: "/api/user/login.php",
        dataType: "json",
        data: JSON.stringify({
            id: loginID,
            password: loginPW,
        }),
        success: function(data) {
            if (data["code"] == "LOGIN_FAIL") {
                minzipsaAlert(data["msg"]);
            } else if (data["code"] == "SUCCESS") {
                minzipsaAlert(data["msg"], "location.href=\""+ window.location.origin + window.location.pathname + "\"");
            }
            console.log(data);
        },
        error: function(error) {
            console.log(error);
        }
    })
}

function loginWrapEnterAction() {
    if (window.event.keyCode == 13) {
        minzipsaLogin();
    }
}

function minzipsaLogout() {
    $.ajax({
        type: "POST",
        url: "/api/user/logout.php",
        dataType: "json",
        success: function(data) {
            console.log(data);
            minzipsaAlert("로그아웃 되었습니다", "location.href=\"/\"");
        },
        error: function(error) {
            console.log(error);
        }
    })
}