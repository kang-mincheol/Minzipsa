<?
include_once('../../common.php');   // 기본파일 로드
include_once('../../header.php');   // 헤더파일 로드
?>

<link rel="stylesheet" href="<?=$relative_path?>index.css?ver=<?=getVersion($relative_path.'index.css')?>" />

<?
//회원가입페이지


?>

<div id="container">
    <!-- 회원가입 폼 레이어 -->
    <div id="join_wrap">
        <div class="join_wrap_title">
            <p class="title_text">회원가입</p>
        </div>

        <div class="join_step_wrap">
            <p class="step_box" name="form_1">1</p>
            <p class="step_box" name="form_2">2</p>
        </div>
        
        <div class="join_form_wrap">
            
            <div class="join_form" name="form_1">
                <div class="form_top_title">
                    안녕하세요!</br>
                    <span class="hit">민집사</span>가 고객님을</br>
                    환영합니다!
                </div>
                
                <div class="terms_wrap">
                    <div class="terms_row">
                        <div class="left_box">
                            <div class="check_box">
                                <input type="checkbox" id="terms_1" name="terms_1"/>
                                <p class="chk_box_bg"></p>
                            </div>
                            <label for="terms_1">민집사 이용약관 동의 <span class="notice_text">(필수)</span></label>
                        </div>
                        <div class="right_box">
                            <button class="view_btn">보기</button>
                        </div>
                    </div>
                
                    <div class="terms_row">
                        <div class="left_box">
                            <div class="check_box">
                                <input type="checkbox" id="terms_2" name="terms_2"/>
                                <p class="chk_box_bg"></p>
                            </div>
                            <label for="terms_2">개인정보 수집 및 이용 동의 <span class="notice_text">(필수)</span></label>
                        </div>
                        <div class="right_box">
                            <button class="view_btn">보기</button>
                        </div>
                    </div>

                    <div class="terms_row">
                        <div class="left_box">
                            <div class="check_box">
                                <input type="checkbox" id="terms_3" name="terms_3"/>
                                <p class="chk_box_bg"></p>
                            </div>
                            <label for="terms_3">마케팅 정보 수신 동의 <span class="info_text">(선택)</span></label>
                        </div>
                        <div class="right_box">
                            <button class="view_btn">보기</button>
                        </div>
                    </div>
                </div><!-- terms_wrap -->

                <div class="step_btn_wrap">
                    <button class="cancel_btn" onclick="history.back()">취소</button>
                    <button class="step_btn" onclick="step_1_form_chk()">다음</button>
                </div>
            </div><!-- step_1 -->
            
            <div class="join_form" name="form_2">
                
                <div class="data_wrap">
                    <div class="input_row">
                        <label for="user_email">이메일 주소(아이디)<span class="label_sub_text_blue">(필수)</span></label>
                        <input type="text" id="user_email" name="user_email" autocomplete="off" placeholder="minzipsa@gmail.com"/>
                    </div>
                    
                    <div class="input_row">
                        <label for="user_password">비밀번호<span class="label_sub_text_blue">(필수)</span></label>
                        <input type="password" id="user_password" name="user_password" autocomplete="off" placeholder="8자리 이상 문자, 숫자, 특수문자 포함"/>
                    </div>
                    
                    <div class="input_row">
                        <label for="user_password_confirm">비밀번호 확인</label>
                        <input type="password" id="user_password_confirm" name="user_password_confirm" autocomplete="off" placeholder="8자리 이상 문자, 숫자, 특수문자 포함"/>
                    </div>
                    
                    <div class="input_row">
                        <label for="user_name">이름<span class="label_sub_text_blue">(필수)</span></label>
                        <input type="text" id="user_name" name="user_name" autocomplete="off"/>
                    </div>
                    
                    <div class="input_row">
                        <label for="user_phone">휴대전화 번호<span class="label_sub_text_blue">(필수)</span></label>
                        <input type="text" id="user_phone" name="user_phone" autocomplete="off" onkeyup="numberLengthChk(this, 12);" placeholder="'-' 없이 입력해주세요"/>
                    </div>
                    
                    <div class="input_row">
                        <label for="user_birth_year">생년월일<span class="label_sub_text_blue">(필수)</span></label>
                        <div class="birth_box">
                            <input type="number" id="user_birth_year" name="user_birth_year" autocomplete="off" onkeyup="numberLengthChk(this, 4);" placeholder="년(4자리)"/>
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
                            <input type="number" id="user_birth_date" name="user_birth_date" onkeyup="numberLengthChk(this, 2)" placeholder="일(1~31)"/>
                        </div>
                    </div>
                    
                    <div class="input_row">
                        <label>우편번호<span class="label_sub_text">(선택)</span></label>
                        <div class="input_box_2">
                            <input type="number" id="post_code" name="post_code" readonly onclick="minzipsaAlert('주소찾기 버튼을 클릭해주세요.')"/>
                            <button class="search_btn" onclick="openDaumPostCode()">주소찾기</button>
                        </div>
                    </div>
                    
                    <div class="input_row">
                        <label for="addr_1">주소<span class="label_sub_text">(선택)</span></label>
                        <input type="text" id="addr_1" name="addr_1" readonly autocomplete="off"/>
                    </div>

                    <div class="input_row">
                        <label for="addr_detail">상세주소<span class="label_sub_text">(선택)</span></label>
                        <input type="text" id="addr_detail" name="addr_detail" autocomplete="off"/>
                    </div>
                    <input type="hidden" id="addr_dong"/>
                </div><!-- data_wrap -->
                
                <div class="btn_wrap">
                    <button class="prev_btn" onclick="formRemote('form_1')">이전</button>
                    <button class="submit_btn" onclick="step_2_form_chk()">회원가입</button>
                </div>
                
                <div id="postCodeWrap">
                    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" onclick="foldDaumPostcode()" alt="접기 버튼">
                </div>
            </div><!-- step_2 -->
            
        </div>
        
        
    </div>
    <!-- 회원가입 폼 레이어 END -->
    
    
</div>


<!-- 카카오 주소 api load -->
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript" src="<?=$relative_path?>index.js?ver=<?=getVersion($relative_path.'index.js')?>" charset="utf-8"></script>
<script type="text/javascript">

    $(function() {
        formRemote("form_1");
    });

    // 다음 지도 api
    var element_wrap = document.getElementById('postCodeWrap');

    function foldDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_wrap.style.display = 'none';
    }

    function openDaumPostCode() {
        // 현재 scroll 위치를 저장해놓는다.
        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    document.getElementById("addr_dong").value = extraAddr;
                
                } else {
                    document.getElementById("addr_dong").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('post_code').value = data.zonecode;
                document.getElementById("addr_1").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("addr_detail").focus();

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_wrap.style.display = 'none';

                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                document.body.scrollTop = currentScroll;
            },
            // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
            onresize : function(size) {
                element_wrap.style.height = size.height+4+'px';
            },
            width : '100%',
            height : '100%'
        }).embed(element_wrap);

        // iframe을 넣은 element를 보이게 한다.
        element_wrap.style.display = 'block';
    }
    
</script>
<?
include_once('../../footer.php');   // 푸터파일 로드

?>