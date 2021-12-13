// help wrap remote
function helpWrapRemote(name) {
    $("#help_wrapper .help_remote_wrap .remote_btn").removeClass("on");
    $("#help_wrapper .help_remote_wrap .remote_btn[name="+name+"]").addClass("on");

    $("#help_wrapper .contents_wrap .help_wrap").removeClass("on");
    $("#help_wrapper .contents_wrap .help_wrap[name="+name+"]").addClass("on");
}

var faqActiveNumber;
// faq visible remote
function faqViewRemote (obj) {
    var number = $(obj).attr("name");

    $("#help_wrapper .contents_wrap .help_wrap[name=faq] .faq_wrap .faq_row").removeClass("on");
    $("#help_wrapper .contents_wrap .help_wrap[name=faq] .faq_wrap .faq_row .title_box .faq_title").removeClass("on");
    $("#help_wrapper .contents_wrap .help_wrap[name=faq] .faq_wrap .faq_row .title_box .arrow_btn").removeClass("on");
    $("#help_wrapper .contents_wrap .help_wrap[name=faq] .faq_wrap .faq_row .contents_box").slideUp();

    if (faqActiveNumber != number) {
        $("#help_wrapper .contents_wrap .help_wrap[name=faq] .faq_wrap .faq_row[name="+number+"]").addClass("on");
        $("#help_wrapper .contents_wrap .help_wrap[name=faq] .faq_wrap .faq_row .title_box .faq_title[name="+number+"]").addClass("on");
        $("#help_wrapper .contents_wrap .help_wrap[name=faq] .faq_wrap .faq_row .title_box .arrow_btn[name="+number+"]").addClass("on");
        $("#help_wrapper .contents_wrap .help_wrap[name=faq] .faq_wrap .faq_row[name="+number+"] .contents_box").slideDown();
    } else {
        return faqActiveNumber = 0;
    }
    
    faqActiveNumber = number;
}