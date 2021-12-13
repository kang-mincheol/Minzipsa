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