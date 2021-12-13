function lnbWrapRemote(name) {
    $("#product_info .page_navigation .lnb_btn").removeClass("on");
    $("#product_info .page_navigation .lnb_btn[name="+name+"]").addClass("on");
}