<?
if (!defined('NO_ALONE')) exit; // 개별 페이지 접근 불가

$menuArr = array();

//로그인 전 메뉴를 추가 합니다.
if(is_null($member)) {
    array_push(
        $menuArr, array(
            "name"=>"로그인",
            "url"=>"javascript:void(0);",
            "event"=>"onclick=\"loginRemote('on');\" "
        ),array(
            "name"=>"회원가입",
            "url"=>"/member/join/"
        )
    );
}

//로그인한 회원에게만 보여줄 메뉴를 추가 합니다.
if(!is_null($member)){
    array_push(
        $menuArr, array(
            "name"=>"내 정보",
            "url"=>"/mypage/mypage/"
        ), array(
            "name"=>"결제 내역",
            "url"=>"/mypage/payment/"
        ), array(
            "name"=>"로그아웃",
            "url"=>"javascript:void(0);",
            "event"=>"onclick=\"logoutRemote();\""
        )
    );
}

//관리자에게만 보여줄 메뉴를 추가 합니다.
if(!is_null($member) && $member["is_admin"]){
    array_push(
        $menuArr, array(
            "name"=>"관리자",
            "url"=>"/admin/"
        )
    );
}

$mainMenuArr = array();

array_push(
    $mainMenuArr, array(
        "name"=>"민집사 소개",
        "url"=>"/minzipsa/"
    ), array(
        "name"=>"이용방법",
        "url"=>"/minzipsa/howto/",
    ), array (
        "name"=>"제품선택",
        "url"=>"/minzipsa/product/"
    ), array (
        "name"=>"민집사 결제",
        "url"=>"/product/payment/"
    )
)

?>