function infoStepRemote(name) {
    $("#minzipsa_info .info_wrap .step_wrap").removeClass("on");

    $("#minzipsa_info .info_wrap .step_wrap[name="+name+"]").addClass("on");
}