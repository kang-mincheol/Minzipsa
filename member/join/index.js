//form remote
function formRemote(name) {
    $("#join_wrap .join_step_wrap .step_box").removeClass("on");
    $("#join_wrap .join_form_wrap .join_form").removeClass("on");

    $("#join_wrap .join_step_wrap .step_box[name="+name+"]").addClass("on");
    $("#join_wrap .join_form_wrap .join_form[name="+name+"]").addClass("on");
}

//비밀번호 체크 정규식
function passwordCheck(str) {
    var pattern1 = /[0-9]/; // 숫자
    var pattern2 = /[a-zA-Z]/; // 문자
    var pattern3 = /[~!@#$%^&*()_+|<>?:{}]/; // 특수문자

    if(!pattern1.test(str) || !pattern2.test(str) || !pattern3.test(str) || str.length < 8) {
        return false;
    } else {
        return true;
    }
}

//step_1 유효성 검사
function step_1_form_chk() {
    var serviceTermsVal = $("#join_wrap .join_form_wrap .join_form[name=form_1] #terms_1").prop("checked");
    var privacyTermsVal = $("#join_wrap .join_form_wrap .join_form[name=form_1] #terms_2").prop("checked");
    var marketingTermsVal = $("#join_wrap .join_form_wrap .join_form[name=form_1] #terms_3").prop("checked");

    if (serviceTermsVal == false || privacyTermsVal == false) {
        minzipsaAlert("필수 이용약관에 동의해주세요");
    } else {
        formRemote("form_2");
    }
}

//step_2 유효성 검사
function step_2_form_chk() {
    var userEmail = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_email");
    var userPassword = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_password");
    var userPasswordConfirm = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_password_confirm");
    var userName = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_name");
    var userPhone = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_phone");
    var userBirthYear = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_birth_year");
    var userBirthMonth = $("#join_wrap .join_form_wrap .join_form[name=form_2] .custom_select_box[name=birth_month] .select_btn");
    var userBirthDate = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_birth_date");
    var postCode = $("#join_wrap .join_form_wrap .join_form[name=form_2] #post_code");
    var addr1 = $("#join_wrap .join_form_wrap .join_form[name=form_2] #addr_1");
    var addrDetail = $("#join_wrap .join_form_wrap .join_form[name=form_2] #addr_detail");
    // --------value---------
    var userEmailValue = userEmail.val();
    var userPasswordValue = userPassword.val();
    var userPasswordConfirmValue = userPasswordConfirm.val();
    var userNameValue = userName.val();
    var userPhoneValue = userPhone.val();
    var userBirthYearValue = userBirthYear.val();
    var userBirthMonthValue = userBirthMonth.val();
    var userBirthDateValue = userBirthDate.val();
    var postCodeValue = postCode.val();
    var addr1Value = addr1.val();
    
    //이메일 정규식
    var emailExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
    var today = new Date;
    var todayYear = today.getFullYear();

    if (userEmailValue == "") {
        minzipsaAlert("이메일 주소를 입력해주세요");
    } else if ($.trim(userEmailValue).match(emailExp) == null) {
        minzipsaAlert("이메일 주소를 정확하게 입력해주세요");
    } else if (userPasswordValue == "") {
        minzipsaAlert("비밀번호를 입력해주세요");
    } else if (!passwordCheck(userPasswordValue)) {
        minzipsaAlert("비밀번호는 8자리 이상 문자, 숫자, 특수문자 포함하여 입력해주세요");
    } else if (userPasswordValue != userPasswordConfirmValue) {
        minzipsaAlert("비밀번호가 일치하지 않습니다");
    } else if (userNameValue == "") {
        minzipsaAlert("이름을 입력해주세요");
    } else if (userPhoneValue == "") {
        minzipsaAlert("휴대전화 번호를 입력해주세요");
    } else if (userBirthYearValue == "") {
        minzipsaAlert("생년월일(년)을 입력해주세요");
    } else if (userBirthYearValue > (todayYear - 19)) {
        minzipsaAlert("20세 미만의 경우에는 서비스 가입이 불가능합니다");
    } else if (userBirthMonthValue == "") {
        minzipsaAlert("생년월일(월)을 선택해주세요");
    } else if (userBirthDateValue == "") {
        minzipsaAlert("생년월일(일)을 입력해주세요");
    } else {
        memberJoin();
    }
}

//회원가입 submit
function memberJoin() {
    var userEmail = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_email");
    var userPassword = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_password");
    var userPasswordConfirm = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_password_confirm");
    var userName = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_name");
    var userPhone = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_phone");
    var userBirthYear = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_birth_year");
    var userBirthMonth = $("#join_wrap .join_form_wrap .join_form[name=form_2] .custom_select_box[name=birth_month] .select_btn");
    var userBirthDate = $("#join_wrap .join_form_wrap .join_form[name=form_2] #user_birth_date");
    var postCode = $("#join_wrap .join_form_wrap .join_form[name=form_2] #post_code");
    var addr1 = $("#join_wrap .join_form_wrap .join_form[name=form_2] #addr_1");
    var addrDetail = $("#join_wrap .join_form_wrap .join_form[name=form_2] #addr_detail");
    // --------value---------
    var userEmailValue = userEmail.val().trim();
    var userPasswordValue = userPassword.val();
    var userPasswordConfirmValue = userPasswordConfirm.val();
    var userNameValue = userName.val().trim();
    var userPhoneValue = userPhone.val().trim();
    var userBirthYearValue = userBirthYear.val().trim();
    var userBirthMonthValue = userBirthMonth.val().trim();
    var userBirthDateValue = userBirthDate.val().trim();
    if (userBirthDateValue < 10) {
        userBirthDateValue = parseInt(userBirthDateValue);
        userBirthDateValue = "0" + userBirthDateValue;
    }
    var postCodeValue = postCode.val();
    var addr1Value = addr1.val();
    var addrDetailValue = addrDetail.val();
    var agreementService = $("#terms_1").prop("checked");
    var agreementPrivacy = $("#terms_2").prop("checked");
    var agreementMarketing = $("#terms_3").prop("checked");

    $.ajax({
        url: "/api/user/join.php",
        type: "POST",
        datType: "json",
        data: JSON.stringify({
            email: userEmailValue,
            password: userPasswordValue,
            name: userNameValue,
            phone: userPhoneValue,
            birth: userBirthYearValue+"-"+userBirthMonthValue+"-"+userBirthDateValue,
            post_code: postCodeValue,
            address: addr1Value,
            address_detail: addrDetailValue,
            agreement_service: agreementService,
            agreement_privacy: agreementPrivacy,
            agreement_marketing: agreementMarketing,
        }),
        success: function(data) {
            console.log(data);
            if (data["code"] == "SUCCESS") {
                minzipsaAlert("회원가입 완료!</br>👏가입한 정보로 로그인 해주세요👏", "/");
            } else if (data["code"] == "ERROR") {
                minzipsaAlert("회원가입 실패</br>카카오톡 문의 남겨주시면 빠른시일내에 연락드리겠습니다🙏");
            } else if (data["code"] == "MISSING_PARAMS") {
                minzipsaAlert("입력하지 않은 정보가 있는지 확인해주세요");
            } else if (data["code"] == "EMAIL_OVERRAPING") {
                minzipsaAlert(data["msg"]);
            } else if (data["code"] == "AGE") {
                minzipsaAlert(data["msg"]);
            } else {
                minzipsaAlert(data["msg"]);
            }
        },
        error: function(error) {
            console.log(error);
        }
    })
}

/***** custom select box *****/
function customSelectWrapRemote(remote, name) {
    if (remote == undefined || remote == "") {
        $(".custom_select_box[name="+name+"] .select_btn").removeClass("on");
        $(".custom_select_box[name="+name+"] .select_wrap").removeClass("on");
    } else {
        $(".custom_select_box[name="+name+"] .select_btn").addClass("on");
        $(".custom_select_box[name="+name+"] .select_wrap").addClass("on");
    }
}

function customSelectClickAction (obj, name) {
    var thisValue = $(obj).val();
    var thisText = $(obj).html();

    $(".custom_select_box[name="+name+"] .select_btn").val(thisValue).html(thisText);
    customSelectWrapRemote('', name);
}

$('html').click(function(e) {
    if (!$(e.target).hasClass('select_wrap') && !$(e.target).hasClass('select_btn')) {
        $('.select_wrap').removeClass('on');
        $('.select_btn').removeClass('on');
    }
});
/***** custom select box END *****/


// 숫자, 길이 제한
function numberLengthChk (obj, length) {
    var regexp = /[^0-9]/g;
    var thisValue = $(obj).val();
    var returnValue;

    if (!regexp.test(thisValue)) {
        thisValue = thisValue.replace(regexp, "");
    }

    if (thisValue.length > length) {
        thisValue = thisValue.substring(0, length);
    }
    
    return $(obj).val(thisValue);
}

//회원가입 submit 함수
function joinFinalSubmit() {
    
}

//회원가입 완료후 자동로그인 함수
function joinAfterLogin() {
    
}

//비밀번호 정규식
function validatePassword(character) {
    return /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{6,}$/.test(character)
}