$(function() {
    InitControls();
    InitEvents();
});

function InitControls() {

}

function InitEvents() {

}

function login(id, password) {
    $.ajax({
        async: true,
        type: 'post',
        dataType: 'json',
        url: BACK_URL + "api/user/login.php",
        data: JSON.stringify({
            id: id,
            password: password
        }),
        success: function(data) {
            console.log(data);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function logout() {
    $.ajax({
        async: true,
        type: 'post',
        dataType: 'json',
        url: "/api/logout.php",
        success: function(data) {
            console.log(data);
            location.href = "/";
        },
        error: function(error) {
            console.log(error);
        }
    });
}

//3자리마다 콤마
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//메인페이지 이용료 계산기
function chargeValue(obj) {
    var shareVal = $(obj).val();
    var comparisonTxt = '.';

    var value = (String)((shareVal * 10000) * 0.0021); //7일 기준으로 계산

    if (value.indexOf(comparisonTxt) != -1) { //계산값이 소수점이 나올경우
        value = value.split('.');
        value = value[0];
    } else {
        value = value;
    }

    value = numberWithCommas(value);

    $('#section_4_calculator .calculator_bot .calculator_value').val(value + '원');
}

//메인페이지 많이 하시는 질문 slide up<->down
function faqShowRemote(obj) {
    $('#section_6 .question_row .question_txt').slideUp();
    $('#section_6 .contents_wrap .question_row .question_tit .tit_arrow_btn').removeClass('on');
    if ($(obj).parents('.question_tit').siblings('.question_txt').hasClass('on')) {
        $(obj).parents('.question_tit').siblings('.question_txt').removeClass('on');
        $(obj).parents('.question_tit').children('.tit_arrow_btn').removeClass('on');
        $(obj).parents('.question_tit').siblings('.question_txt').slideUp();
    } else {
        $('#section_6 .question_row .question_txt').removeClass('on');
        $(obj).parents('.question_tit').siblings('.question_txt').addClass('on');
        $(obj).parents('.question_tit').children('.tit_arrow_btn').addClass('on');
        $(obj).parents('.question_tit').siblings('.question_txt').slideDown();
    }
}

//많이 하시는 질문 list
function mainFaqList() {

    $.ajax({
        async: false,
        type: 'post',
        dataType: 'json',
        url: BACK_URL + 'api/faq/main_list.php',
        success: function(data) {
            $(data.data).each(function() {
                $('#section_6 .section_wrap .contents_wrap').append(
                    '<div class="question_row">' +
                    '<div class="question_tit">' +
                    '<a href="javascript:void(0);" class="tit_txt_btn" onclick="faqShowRemote(this)">Q.' + this.subject +
                    '</a>' +
                    '<a href="javascript:void(0);" class="tit_arrow_btn" onclick="faqShowRemote(this)">더 보기</a>' +
                    '</div>' +
                    '<div class="question_txt">' +
                    '<div style="display:inline-block">' +
                    this.content +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );
            });
        },
        error: function(error) {
            console.log(error);
        }
    })
}

function mainPageBusinessNumChk() {
    var thisBusinessNum = $('#section_7 #business_number_box #businessNumberValue').val();

    if (thisBusinessNum == '') {
        var alertTxt = '사업자 등록번호를 입력해주세요.';
        return headerAlertRemote(alertTxt);
    } else {
        var thisReplaceNum = thisBusinessNum.replace(/-/gi, ''); //하이픈제거
        console.log(thisReplaceNum);
        $.ajax({
            async: false,
            type: 'post',
            dataType: 'json',
            url: BACK_URL + 'api/user/company_num_check.php',
            data: JSON.stringify({
                company_num: thisReplaceNum
            }),
            success: function(data) {
                console.log(data);
                if (data.data.status == "정상") {
                    if (data.data.ceo_name != '') {
                        //대표이름 맞습니까?
                        $('#section_7_ModalWrap .contents_wrap .contents_tit .ceo_name').html(data.data.ceo_name);
                        $('#section_7_ModalWrap').addClass('on');
                    } else {
                        $('#section_7_Form').submit();
                    }
                } else if (data.code == "MISSING_PARAMS") {
                    var alertTxt = '사업자 등록번호를 입력해주세요.';
                    return headerAlertRemote(alertTxt);
                } else if (data.code == "NOT_FOUND") {
                    var alertTxt = data.msg;
                    return headerAlertRemote(alertTxt);
                }
            },
            error: function(error) {
                console.log(error);
            }
        })

    }
}

//section7 정산가능금액확인 form submit
function section7FormSubmit() {
    if ($('#section_7 #businessNumberValue').val().length < 12) {
        var alertTxt = '사업자 등록번호를 입력해주세요.';
        return headerAlertRemote(alertTxt);
    } else if ($('#section_7 #businessNumberValue').val().length == 12) {
        $('#section_7 #section_7_Form').submit();
    }
}