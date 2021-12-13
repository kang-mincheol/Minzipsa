<?
include_once('../../common.php');   // 기본파일 로드
include_once('../../header.php');   // 헤더파일 로드

if (is_null($member)) {?>
<script type="text/javascript">
    minzipsaAlert("로그인 후 접근이 가능합니다.", "/?loginOn=true");
</script>
<?
exit;
}
?>

<link rel="stylesheet" href="/css/jquery-ui.min.css"/>
<link rel="stylesheet" href="<?=$relative_path?>index.css?ver=<?=getVersion($relative_path.'index.css')?>" />


<div id="pageWrapper">


<div id="minzipsa_payment">

    <div class="payment_wrap">
        
        <div class="step_wrap" name="step_1">
            <div class="top_title_box">
                <p class="text_title">STEP 1/2</p>
            </div>

            <div class="product_select_wrap">
                <div class="wrap_title">
                    <p class="title_text">구독할 제품 선택(정기배송)</p>
                </div>
                
                <div class="select_contents">
                    <!-- contents -->
                </div>
            </div><!-- product_select_wrap -->
            
            <div class="add_product_wrap">
                <div class="wrap_title">
                    <p class="title_text">추가구매(판매형)</p>
                </div>

                <div class="select_contents">
                    <!-- contents -->
                </div>

            </div>

            <div class="coupon_select_wrap">
                <div class="wrap_title">
                    <p class="title_text">쿠폰 / 이벤트 선택</p>
                </div>
                
                <div class="contents_wrap">
                    <div class="custom_select_box" name="coupon">
                        <button class="custom_select_btn" value="none" onclick="customSelectRemote('on', 'coupon')">쿠폰</button>
                        <div class="custom_option_wrap">
                            <button class="option_btn" value="none" onclick="customSelectOptionClick(this, 'coupon'); couponBind(this);">쿠폰</button>
<!--                            <button class="option_btn" value="none" onclick="customSelectOptionClick(this, 'coupon');">선택가능한 쿠폰이 없습니다.</button>-->
                        </div>
                    </div>

                    <div class="custom_select_box" name="event">
                        <button class="custom_select_btn" value="none" onclick="customSelectRemote('on', 'event')">이벤트</button>
                        <div class="custom_option_wrap">
                            <button class="option_btn" value="none" onclick="customSelectOptionClick(this, 'event'); eventBind(this);">이벤트</button>
<!-- 
                            <button class="option_btn" value="none" onclick="customSelectOptionClick(this, 'event');">선택가능한 이벤트가 없습니다.</button>
                            
-->
                        </div>
                    </div>
                </div><!-- contents_wrap -->
                
            </div>
            
            <div class="total_price_wrap">
                <div class="wrap_title">
                    <p class="title_text">선택한 제품</p>
                </div>
                
                <div class="detail_wrap">

                    <div class="product_select_list">
                        <p class="select_list_title">선택</p>
                        <div class="product_name_wrap">
<!--
                            <div class="product_row" productNo="1">
                                <div class="product_contents">
                                    <p class="product_title">매트리스 커버</p>
                                    <p class="size_info">사이즈: S</p>
                                    <p class="color_info">컬러: 화이트</p>
                                    <div class="quantity_wrap">
                                        <input class="quantity_input" type="number" name="quantity_input_" value="1"/>
                                        <p class="place_text">개</p>
                                    </div>
                                </div>
                                <div class="delete_box">
                                    <button class="delete_btn" onclick="thisProductDelete('1');">삭제</button>
                                </div>
                            </div>
-->
                        </div>
                    </div><!-- product_select_list -->
                    
                    <div class="plus_select_wrap">
                        <p class="plus_select_title">추가구매(판매형)</p>
                        <div class="product_name_wrap">
                            
<!--
                            <div class="product_row" name="product_6">
                                <p class="product_name">베개 솜</p>
                                <p class="product_price">(10,000원)</p>
                                <div class="quantity_wrap">
                                    <input id="product_6" class="product_quantity_input" type="number" onkeyup="" value="1"/>
                                    <p class="input_value_text">개</p>
                                </div>
                            </div>
-->
                        </div>
                    </div>

                    <div class="coupon_view_wrap">
                        <p class="coupon_view_title">쿠폰</p>
                        <div class="product_name_wrap">
                            <div class="product_row">
                                <div class="product_name">
                                    <div class="name_text"></div>
                                    <button class="close_btn" onclick="couponBind();">삭제</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="event_view_wrap">
                        <p class="event_view_title">이벤트</p>
                        <div class="product_name_wrap">
                            <div class="product_row">
                                <div class="product_name">
                                    <div class="name_text"></div>
                                    <button class="close_btn" onclick="eventBind();">삭제</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- detail_wrap -->
            </div><!-- total_price_wrap -->
            
            <div class="shipping_select_wrap">
                <div class="wrap_title">
                    <p class="title_text">배송정보 입력</p>
                </div>
                
                <div class="default_shipping_box">
                    <button class="default_shipping_btn" onclick="getDefaultAddress()">등록된 주소지 입력</button>
                    <button class="post_search_btn" onclick="openDaumPostCode();">우편번호 찾기</button>
                </div>
                
                <div class="address_wrap">
                    <div class="address_row">
                        <input id="post_code" class="post_code_input" name="post_code" type="text" value="" onclick="postCodeAlert()" placeholder="우편번호" readonly/>
                        <input id="addr_1" class="address_input" name="address" type="text" onclick="postCodeAlert()" placeholder="주소" readonly/>
                        <input id="addr_dong" type="hidden"/>
                    </div>
                    
                    <div class="address_row">
                        <input id="addr_detail" class="address_input" name="address_detail" placeholder="상세주소를 입력해주세요" type="text"/>
                        <input class="address_input" name="shipping_memo" placeholder="배송메모 - 현관문 앞에 놓아주세요 / 배송전 연락 주세요" type="text"/>
                    </div>

                    <p class="info_text">
                        📢주소지가 등록되어 있지 않는 경우 최초주문 주소지로 주소지가 등록됩니다.</br>(주소지는 추후에 마이페이지에서 수정 가능합니다.)
                    </p>
                </div>
            </div><!-- shipping_select_wrap -->
            
            <div class="shipping_date_wrap">
                <div class="wrap_title">
                    <p class="title_text">첫 배송 희망일 선택😊</p>
                </div>
                
                <div class="contents_wrap">
                    <input id="deliveryDate" type="text" value="<?=date("Y.m.d")?>" readonly/>
                </div>
                
            </div>
            
            <div class="bottom_btn_wrap">
                <button class="next_btn" onclick="step1Check()">다음</button>
            </div>

        </div><!-- step_1 -->
        
        <div class="step_wrap" name="step_2">
            
            
        </div>
        
        
    </div><!-- payment_wrap -->

    

</div><!-- minzipsa_payment -->

</div><!-- container -->


<div id="sizeSelectWrap">
    <div class="contents_wrap">
        <button class="close_btn" onclick="sizeSelectRemote('cancel', this);">닫기</button>
        
        <p class="contents_wrap_title"><span class="blue">✔</span>옵션 선택</p>

        <div class="color_box">
            <p class="color_box_title">컬러를 선택해주세요</p>
            <div class="select_box">
                <div class="color_btn_box" name="white">
                    <p class="box_title">화이트</p>
                    <div class="color_select_btn_wrap">
                        <input class="color_select_input" type="radio" name="color_select" value="white"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>
                <div class="color_btn_box" name="grey">
                    <p class="box_title">그레이</p>
                    <div class="color_select_btn_wrap">
                        <input class="color_select_input" type="radio" name="color_select" value="grey"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>
            </div>
        </div><!-- color_box -->
        
        <div class="size_box">
            <p class="size_box_title">사이즈를 선택해주세요</p>
            <div class="select_box">

                <div class="size_btn_box" name="S">
                    <p class="box_title">S</p>
                    <div class="size_select_btn_wrap">
                        <input class="size_select_input" type="radio" name="size_select" value="S"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>
                <div class="size_btn_box" name="Q">
                    <p class="box_title">Q</p>
                    <div class="size_select_btn_wrap">
                        <input class="size_select_input" type="radio" name="size_select" value="Q"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>
                <div class="size_btn_box" name="K">
                    <p class="box_title">K</p>
                    <div class="size_select_btn_wrap">
                        <input class="size_select_input" type="radio" name="size_select" value="K"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>

            </div>
        </div><!-- size_box -->
        
        <div class="btn_wrap">
            <button class="select_btn">선택완료</button>
        </div>


    </div>
</div><!-- sizeSelectWrap -->


<div id="sellSizeSelectWrap">
    <div class="contents_wrap">
        <button class="close_btn" onclick="sellSizeSelectRemote('cancel', this);">닫기</button>
        
        <p class="contents_wrap_title"><span class="blue">✔</span>옵션 선택</p>

        <div class="color_box">
            <p class="color_box_title">컬러를 선택해주세요</p>
            <div class="select_box">
                <div class="color_btn_box" name="white">
                    <p class="box_title">화이트</p>
                    <div class="color_select_btn_wrap">
                        <input class="color_select_input" type="radio" name="color_select" value="white"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>
                <div class="color_btn_box" name="grey">
                    <p class="box_title">그레이</p>
                    <div class="color_select_btn_wrap">
                        <input class="color_select_input" type="radio" name="color_select" value="grey"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>
            </div>
        </div><!-- color_box -->
        
        <div class="size_box">
            <p class="size_box_title">사이즈를 선택해주세요</p>
            <div class="select_box">

                <div class="size_btn_box" name="S">
                    <p class="box_title">S</p>
                    <div class="size_select_btn_wrap">
                        <input class="size_select_input" type="radio" name="size_select" value="S"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>
                <div class="size_btn_box" name="Q">
                    <p class="box_title">Q</p>
                    <div class="size_select_btn_wrap">
                        <input class="size_select_input" type="radio" name="size_select" value="Q"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>
                <div class="size_btn_box" name="K">
                    <p class="box_title">K</p>
                    <div class="size_select_btn_wrap">
                        <input class="size_select_input" type="radio" name="size_select" value="K"/>
                        <p class="checked_text">✔</p>
                    </div>
                </div>

            </div>
        </div><!-- size_box -->
        
        <div class="btn_wrap">
            <button class="select_btn">선택완료</button>
        </div>


    </div>
</div><!-- sellSizeSelectWrap -->



<div id="priceCalculateWrap" class="">
    <div class="contents_wrap">

        <button class="close_btn" onclick="step1PopupRemote();">닫기</button>

        <p class="contents_wrap_title">🧾결제 정보</p>
        
        <div class="calculate_box">
            
            <div class="box_contents" name="subscribe">
                <p class="box_title">구독제품</p>
                <div class="contents_box">
<!--
                    <div class="contents_row">
                        <div class="product_box">
                            <p class="product_name">매트리스 커버&nbsp;X&nbsp;</p>
                            <p class="product_count">2</p>
                        </div>
                        <div class="price_box">
                            <p class="price_value">🛒&nbsp;20,000원</p>
                        </div>
                    </div>
-->
                </div>
            </div><!-- box_contents -->
            
            <div class="box_contents" name="sold">
                <p class="box_title">추가구매</p>
                <div class="contents_box">
<!--
                    <div class="contents_row">
                        <div class="product_box">
                            <p class="product_name">베개 솜&nbsp;X&nbsp;</p>
                            <p class="product_count">2</p>
                        </div>
                        <div class="price_box">
                            <p class="price_value">🛒&nbsp;20,000원</p>
                        </div>
                    </div>
-->
                </div>
            </div><!-- box_contents -->
            
            <div class="box_contents" name="coupon">
                <p class="box_title">쿠폰</p>
                <div class="detail_text_box">
                    <p class="detail_text"></p>
                    <p class="detail_value"></p>
                </div>
            </div><!-- box_contents -->

            <div class="box_contents" name="event">
                <p class="box_title">이벤트</p>
                <div class="detail_text_box">
                    <p class="detail_text"></p>
                    <p class="detail_value"></p>
                </div>
            </div><!-- box_contents -->
            
            <div class="box_contents" name="price_result">
                <p class="box_title">결제 확인</p>
                <div class="detail_text_box sub_box">
                    <p class="detail_text"><!-- 쿠폰/이벤트 혜택으로 1개월 동안 결제금액 --></p>
                    <p class="detail_value"><!-- 36,000원 --></p>
                </div>
                <div class="detail_text_box main_box">
                    <p class="detail_text">매월 결제금액</p>
                    <p class="detail_value"><!--40,000원--></p>
                </div>
            </div><!-- box_contents -->

        </div><!-- calculate_box -->
        
        <div class="btn_wrap">
            <button class="next_btn" onclick="step1Submit()">결제</button>
        </div>
        
        
    </div><!-- contents_wrap -->
</div><!-- priceCalculateWrap -->






<div id="postCodeWrap">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" onclick="foldDaumPostcode()" alt="접기 버튼">
</div>



<!-- 카카오 주소 api load -->
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$relative_path?>index.js?ver=<?=getVersion($relative_path.'index.js')?>" charset="utf-8"></script>
<script type="text/javascript">

$(function() {
    getProductData();
    getCouponsData();
    getEventsData();
    dataPickerLoad();
    
    infoStepRemote('step_1');
    
    
//    $("#sizeSelectWrap").addClass("on");
});
</script>

<?
include_once('../footer.php');   // 푸터파일 로드

?>