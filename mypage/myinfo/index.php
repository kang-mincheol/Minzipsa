<?
include_once('../../common.php');   // 기본파일 로드
include_once('../../header.php');   // 헤더파일 로드

if(is_null($member)) {?>
<script type="text/javascript">
    minzipsaAlert("로그인 후 접근이 가능합니다.", "/?loginOn=true");
</script>
<? exit; }?>

<link rel="stylesheet" href="<?=$relative_path?>index.css?ver=<?=getVersion($relative_path.'index.css')?>" />


<?

//회원정보 페이지

?>

<div id="container">
    
    <div id="user_info">

        <div class="user_info_title_wrap">
            <p class="title_text">내 정보</p>
        </div>
        
        <div class="contents_wrap">

            <div class="info_row">
                <div class="info_title_box">
                    <p class="info_title">이름</p>
                </div>
                <div class="info_value_box">
                    <input class="info_value_input" type="text" value="" readonly/>
                </div>
            </div>
            
            <div class="info_row">
                <div class="info_title_box">
                    <p class="info_title">이메일</p>
                </div>
                <div class="info_value_box">
                    <input class="info_value_input" type="text" value="" readonly/>
                </div>
            </div>

            <div class="info_row">
                <div class="info_title_box">
                    <p class="info_title">비밀번호</p>
                </div>
                <div class="info_value_box">
                    <button class="pw_change_btn">비밀번호 변경</button>
                </div>
            </div>
            
            <div class="info_row" name="phone">
                <div class="info_title_box">
                    <p class="info_title">휴대전화 번호</p>
                </div>
                <div class="info_value_box">
                    <input class="info_value_input" type="text" name="phone_number"/>
                </div>
            </div>
            
            <div class="info_row" name="birth">
                <div class="info_title_box">
                    <p class="info_title">생년월일</p>
                </div>
                <div class="info_value_box">
                    <input class="info_value_input" type="text" placeholder="년(4자리)"/>
                    <div class="custom_select_box" name="birth_month">
                        <button class="select_btn" value="none" onclick="customSelectWrapRemote('on', 'birth_month')">월(선택)</button>
                        <div class="select_wrap">
                            <button class="option_btn" value="none" onclick="customSelectClickAction(this, 'birth_month')">월(선택)</button>
                            <button class="option_btn" value="01" onclick="customSelectClickAction(this, 'birth_month')">1월</button>
                            <button class="option_btn" value="02" onclick="customSelectClickAction(this, 'birth_month')">2월</button>
                            <button class="option_btn" value="03" onclick="customSelectClickAction(this, 'birth_month')">3월</button>
                            <button class="option_btn" value="04" onclick="customSelectClickAction(this, 'birth_month')">4월</button>
                            <button class="option_btn" value="05" onclick="customSelectClickAction(this, 'birth_month')">5월</button>
                            <button class="option_btn" value="06" onclick="customSelectClickAction(this, 'birth_month')">6월</button>
                            <button class="option_btn" value="07" onclick="customSelectClickAction(this, 'birth_month')">7월</button>
                            <button class="option_btn" value="08" onclick="customSelectClickAction(this, 'birth_month')">8월</button>
                            <button class="option_btn" value="09" onclick="customSelectClickAction(this, 'birth_month')">9월</button>
                            <button class="option_btn" value="10" onclick="customSelectClickAction(this, 'birth_month')">10월</button>
                            <button class="option_btn" value="11" onclick="customSelectClickAction(this, 'birth_month')">11월</button>
                            <button class="option_btn" value="12" onclick="customSelectClickAction(this, 'birth_month')">12월</button>
                        </div>
                    </div>
                    <input class="info_value_input" type="text" placeholder="일(1~31)"/>
                </div>
            </div>
            
            <div class="info_row" name="address">
                <div class="info_title_box">
                    <p class="info_title">주소</p>
                </div>
                <div class="info_value_box">
                    <div class="address_row">
                        <button class="addr_search_btn">우편번호</button>
                        <input class="post_code" type="text" name="post_code" readonly/>
                    </div>
                    <div class="address_row">
                        <input class="address_input" type="text" name="address" readonly/>
                    </div>
                    <div class="address_row">
                        <input class="address_input" type="text" name="address_detail"/>
                    </div>
                </div>
            </div>
        </div><!-- contents_wrap -->
        
        <div class="bottom_btn_wrap">
            <button class="prev_btn" onclick="history.go(-1);">뒤로</button>
            <button class="save_btn" onclick="">저장</button>
        </div>
        
        
    </div><!-- user_info -->
    
</div><!-- container -->

<div id="passwordChangePopWrap">
    
    <div class="contents_wrap">
        <div class="wrap_title_box">
            <p class="wrap_title">비밀번호 변경</p>
        </div>
        <div class="wrap_body">
            <div class="body_row">
                <p class="row_title">기존 비밀번호</p>
                <input type="password" name="password"/>
            </div>
            <div class="body_row">
                <p class="row_title">새 비밀번호</p>
                <input type="password" name="new_password"/>
            </div>
            <div class="body_row">
                <p class="row_title">새 비밀번호 확인</p>
                <input type="password" name="new_password_chk"/>
            </div>
        </div>
    </div>
    
</div>



<script type="text/javascript" src="<?=$relative_path?>index.js?ver=<?=getVersion($relative_path.'index.js')?>" ></script>
<script type="text/javascript">
$(function() {
    
})
</script>
<?
include_once('../../footer.php');   // 푸터파일 로드

?>