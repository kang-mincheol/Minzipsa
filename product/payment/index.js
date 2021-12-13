/********** product get **********/
function getProductData() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "/api/product/get.products_list.php",
        success: function(data) {
            var products = data.product;
            var sellProducts = data.sold;

            if (products.length > 0) {
                for (i = 0; products.length > i; i++) {
                    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .product_select_wrap .select_contents").append(
                        '<div class="check_box">' +
                            '<div class="custom_check_box">' +
                                '<input id="product_'+products[i]['product_idx']+'" class="custom_check_input" type="checkbox" product_id="'+products[i]['product_idx']+'" onchange="sizeSelectRemote(\'on\', this);"/>' +
                                '<p class="checkbox_bg"></p>' +
                            '</div>' +
                            '<label for="product_'+products[i]['product_idx']+'">'+products[i]['product_name']+'</label>' +
                            '<p class="price_label">('+numberWithCommas(products[i]['product_price'])+'원)</p>' +
                        '</div>'
                    );
                }
            }
            
            if (sellProducts.length > 0) {
                for (i = 0; sellProducts.length > i; i++) {
                    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .add_product_wrap .select_contents").append(
                        '<div class="check_box">' +
                            '<div class="custom_check_box">' +
                                '<input id="sell_product_'+sellProducts[i]['sold_idx']+'" class="custom_check_input" type="checkbox" product_id="'+products[i]['product_idx']+'" onchange="sellSizeSelectRemote(\'on\', this);"/>' +
                                '<p class="checkbox_bg"></p>' +
                            '</div>' +
                            '<label for="sell_product_'+sellProducts[i]['sold_idx']+'">'+sellProducts[i]['product_name']+'</label>' +
                            '<p class="price_label">('+numberWithCommas(sellProducts[i]['product_price'])+'원)</p>' +
                        '</div>'
                    );
                }
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}
/********** product END **********/


/********** coupons get **********/
function getCouponsData() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "/api/coupons/get.coupons_list.php",
        success: function(data) {
            if (data["code"] == "SUCCESS") {
                if (data["data"].length > 0) {
                    for (i = 0; data["data"].length > i; i++) {
                        var benefitText = '';
                        
                        if (data["data"][i]["is_percent"] == 1) {
                            benefitText = data["data"][i]["benefit"] + '%';
                        } else if (data["data"][i]["is_won"] == 1) {
                            benefitText = numberWithCommas(data["data"][i]["benefit"]) + '원';
                        }
                        $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .coupon_select_wrap .contents_wrap .custom_select_box[name=coupon] .custom_option_wrap").append(
                            '<button class="option_btn" value="'+data["data"][i]["id"]+'" onclick="customSelectOptionClick(this, \'coupon\'); couponBind(this);">' +
                                data["data"][i]["coupons_name"] +
                                '&nbsp;' + data["data"][i]["benefit_month"] + '개월 ' + benefitText + '&nbsp;' + ' 할인' +
                            '</button>'
                        );
                    }
                } else {
                    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .coupon_select_wrap .contents_wrap .custom_select_box[name=coupon] .custom_option_wrap").append(
                        '<button class="option_btn" value="none" onclick="customSelectOptionClick(this, \'coupon\'); couponBind(this);">선택가능한 쿠폰이 없습니다.</button>'
                    );
                }
            } else if (data["code"] == "ERROR") {
                minzipsaAlert("쿠폰 데이터 불러오기 실패<br>관리자에게 문의하세요");
            } else {
                minzipsaAlert("쿠폰 데이터 불러오기 에러<br>관리자에게 문의하세요");
            }
        },
        error: function(error) {
            console.log(error);
        }
    })
}
/********** coupons get END **********/


/********** events get **********/
function getEventsData() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "/api/events/get.events_list.php",
        success: function(data) {
            if (data["code"] == "SUCCESS") {
                if (data["data"].length > 0) {
                    for (i = 0; data["data"].length > i; i++) {
                        var benefitText = '';
                        if (data["data"][i]["is_percent"] == 1) {
                            benefitText = data["data"][i]["benefit"] + '%';
                        } else if (data["data"][i]["is_won"] == 1) {
                            benefitText = numberWithCommas(data["data"][i]["benefit"]) + '원';
                        }
                        $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .coupon_select_wrap .contents_wrap .custom_select_box[name=event] .custom_option_wrap").append(
                            '<button class="option_btn" value="'+data["data"][i]["id"]+'" onclick="customSelectOptionClick(this, \'event\'); eventBind(this);">' +
                                data["data"][i]["events_name"] +
                                '&nbsp;' + data["data"][i]["benefit_month"] + '개월 ' + benefitText + '&nbsp;' + ' 할인' +
                            '</button>'
                        );
                    }
                } else {
                    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .coupon_select_wrap .contents_wrap .custom_select_box[name=event] .custom_option_wrap").append(
                        '<button class="option_btn" value="none" onclick="customSelectOptionClick(this, \'event\'); eventBind(this);">선택가능한 이벤트가 없습니다.</button>'
                    );
                }
            } else if (data["code"] == "ERROR") {
                minzipsaAlert("이벤트 데이터 불러오기 실패<br>관리자에게 문의하세요");
            } else {
                minzipsaAlert("이벤트 데이터 불러오기 에러<br>관리자에게 문의하세요");
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}
/********** events get END **********/


/********** 특정 product get **********/
function getProductId(num) {
    var returnData = "";
    $.ajax({
        type: "POST",
        async: false,
        url: "/api/product/get.products_id.php",
        data: JSON.stringify({
            id: num,
        }),
        success: function(data) {
            if (data["code"] == "SUCCESS") {
                returnData = data;
            } else {
                return minzipsaAlert(data["msg"]);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });

    return returnData;
}
/********** 특정 product get END **********/


/********** 특정 판매제품 product get **********/
function getProductSellId(num) {
    var returnData = "";
    $.ajax({
        type: "POST",
        async: false,
        url: "/api/product/get.products_sell_id.php",
        data: JSON.stringify({
            id: num,
        }),
        success: function(data) {
            if (data["code"] == "SUCCESS") {
                returnData = data;
            } else {
                return minzipsaAlert(data["msg"]);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });

    return returnData;
}
/********** 특정 판매제품 product get END **********/


/********** 구독 제품 선택 event **********/
function sizeSelectRemote(remote, obj) {
    if (remote == "" || remote == undefined) {
        // off
        // 컬러 선택 박스 / 값 초기화
        $("#sizeSelectWrap .contents_wrap .color_box").removeClass("on");
        $("#sizeSelectWrap .contents_wrap .color_box .color_select_input[name=color_select]:checked").prop("checked", false);

        // 사이즈 선택 박스 / 값 초기화
        $("#sizeSelectWrap .contents_wrap .size_box").removeClass("on");
        $("#sizeSelectWrap .contents_wrap .size_box .size_select_input[name=size_select]:checked").prop("checked", false);

        // 선택완료 버튼 값 초기화
        $("#sizeSelectWrap .btn_wrap .select_btn").attr("onclick", "");
        $("#sizeSelectWrap .contents_wrap").attr({"productNo": "", "productName": ""});

        $("#sizeSelectWrap").removeClass("on");
    } else if (remote == "cancel") {
        // cancel 팝업창 x 버튼
        var productNo = $(obj).parent(".contents_wrap").attr("productNo");
        // 컬러 선택 박스 / 값 초기화
        $("#sizeSelectWrap .contents_wrap .color_box").removeClass("on");
        $("#sizeSelectWrap .contents_wrap .color_box .color_select_input[name=color_select]:checked").prop("checked", false);

        // 사이즈 선택 박스 / 값 초기화
        $("#sizeSelectWrap .contents_wrap .size_box").removeClass("on");
        $("#sizeSelectWrap .contents_wrap .size_box .size_select_input[name=size_select]:checked").prop("checked", false);

        // 선택완료 버튼 값 초기화
        $("#sizeSelectWrap .btn_wrap .select_btn").attr("onclick", "");

        
        $("#sizeSelectWrap .contents_wrap").attr({"productNo": "", "productName": ""});
        $("#sizeSelectWrap").removeClass("on");
        
        $("#product_"+productNo).prop("checked", false);
    } else {
        // on
        var checked = $(obj).prop('checked');
        var product_id = $(obj).attr("product_id");
        
        if (checked == true) {
            // 상품선택
            var productData = getProductId(product_id);
            if (productData["code"] == "SUCCESS") {

                if (productData["data"]["isSize"] == 0 && productData["data"]["isColor"] == 0) {
                    // 컬러 / 사이즈 선택 필요없는 경우
                } else {
                    if (productData["data"]["isColor"] == 1) {
                        $("#sizeSelectWrap .contents_wrap .color_box").addClass("on");
                    }

                    if (productData["data"]["isSize"] == 1) {
                        $("#sizeSelectWrap .contents_wrap .size_box").addClass("on");
                    }

                    $("#sizeSelectWrap .contents_wrap").attr({"productNo": product_id, "productName": productData["data"]["product_name"]});
                    $("#sizeSelectWrap .btn_wrap .select_btn").attr("onclick", "sizeSelectConfirm('"+product_id+"', this)");
                    $("#sizeSelectWrap").addClass("on");
                }

                
            } else {
                $(obj).prop("checked", false);
            }
        } else {
            // 상품선택취소
            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_name_wrap .product_row[productno="+product_id+"]").remove();
        }
    }
}
/********** 구독 제품 선택 event END **********/



/********** 구독 제품 사이즈 / 컬러 선택 완료 event **********/
function sizeSelectConfirm(num, obj) {
    if ($("#sizeSelectWrap .contents_wrap .color_box").hasClass("on")) {// 컬러 선택이 필수인지 체크
        if ($("#sizeSelectWrap .contents_wrap .color_box .select_box .color_btn_box .color_select_btn_wrap .color_select_input[name=color_select]:checked").val() == undefined) {
            // 선택 안했을 경우
            return minzipsaAlert("컬러를 선택해주세요");
        }
        
        var color = $("#sizeSelectWrap .contents_wrap .color_box .select_box .color_btn_box .color_select_btn_wrap .color_select_input[name=color_select]:checked").parent(".color_select_btn_wrap").siblings(".box_title").html();
    }

    if ($("#sizeSelectWrap .contents_wrap .size_box").hasClass("on")) {// 사이즈 선택이 필수인지 체크
        if ($("#sizeSelectWrap .contents_wrap .size_box .select_box .size_btn_box .size_select_btn_wrap > input[name=size_select]:checked").val() == undefined) {
            // 선택 안했을 경우
            return minzipsaAlert("사이즈를 선택해주세요");
        }
        
        var size = $("#sizeSelectWrap .contents_wrap .size_box .select_box .size_btn_box .size_select_btn_wrap > input[name=size_select]:checked").val();
    }

    var name = $(obj).parent(".btn_wrap").parent(".contents_wrap").attr("productname");
    
    

    productsAddBasket(num, name, color, size);
    
    //옵션 선택 박스 초기화
    sizeSelectRemote();
}
/********** 구독 제품 사이즈 / 컬러 선택 완료 event END **********/



/********** 구독 제품 선택 완료 후 상품 추가 event **********/
function productsAddBasket(num, name, color, size) {
    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap").append(
        '<div class="product_row" productNo="'+num+'">' +
            '<div class="product_contents">' +
                '<p class="product_title">'+name+'</p>' +
                (size == undefined ? '' : '<p class="size_info">사이즈 : <span class="value">'+size+'</span></p>') +
                (color == undefined ? '' : '<p class="color_info">컬러 : <span class="value">'+color+'</span></p>') +
                '<div class="quantity_wrap">' +
                    '<input class="quantity_input" type="number" name="quantity_input_'+num+'" value="1"/>' +
                    '<p class="place_text">개</p>' +
                '</div>' +
            '</div>' +
            '<div class="delete_box">' +
                '<button class="delete_btn" onclick="thisProductDelete('+num+');">삭제</button>' +
            '</div>' +
        '</div>'
    );
}
/********** 구독 제품 선택 완료 후 상품 추가 event END **********/



/********** 구독 제품 선택 상품 삭제 event **********/
function thisProductDelete(num) {
    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap .product_row[productno="+num+"]").remove();
    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .product_select_wrap .select_contents .check_box .custom_check_box .custom_check_input[product_id="+num+"]").prop("checked", false);
}
/********** 구독 제품 선택 상품 삭제 event END **********/



/********** 판매 제품 선택 event **********/
function sellSizeSelectRemote(remote, obj) {
    if (remote == "" || remote == undefined) {
        // off
        // 컬러 선택 박스 / 값 초기화
        $("#sellSizeSelectWrap .contents_wrap .color_box").removeClass("on");
        $("#sellSizeSelectWrap .contents_wrap .color_box .color_select_input[name=color_select]:checked").prop("checked", false);

        // 사이즈 선택 박스 / 값 초기화
        $("#sellSizeSelectWrap .contents_wrap .size_box").removeClass("on");
        $("#sellSizeSelectWrap .contents_wrap .size_box .size_select_input[name=size_select]:checked").prop("checked", false);

        // 선택완료 버튼 값 초기화
        $("#sellSizeSelectWrap .btn_wrap .select_btn").attr("onclick", "");
        $("#sellSizeSelectWrap .contents_wrap").attr({"productNo": "", "productName": ""});

        $("#sellSizeSelectWrap").removeClass("on");
    } else if (remote == "cancel") {
        // cancel 팝업창 x 버튼
        var productNo = $(obj).parent(".contents_wrap").attr("productNo");
        // 컬러 선택 박스 / 값 초기화
        $("#sellSizeSelectWrap .contents_wrap .color_box").removeClass("on");
        $("#sellSizeSelectWrap .contents_wrap .color_box .color_select_input[name=color_select]:checked").prop("checked", false);

        // 사이즈 선택 박스 / 값 초기화
        $("#sellSizeSelectWrap .contents_wrap .size_box").removeClass("on");
        $("#sellSizeSelectWrap .contents_wrap .size_box .size_select_input[name=size_select]:checked").prop("checked", false);

        // 선택완료 버튼 값 초기화
        $("#sellSizeSelectWrap .btn_wrap .select_btn").attr("onclick", "");

        
        $("#sellSizeSelectWrap .contents_wrap").attr({"productNo": "", "productName": ""});
        $("#sellSizeSelectWrap").removeClass("on");
        
        $("#sell_product_"+productNo).prop("checked", false);
    } else {
        // on
        var checked = $(obj).prop('checked');
        var product_id = $(obj).attr("product_id");
        
        if (checked == true) {
            // 상품선택
            var productData = getProductSellId(product_id);
            if (productData["code"] == "SUCCESS") {

                if (productData["data"]["isSize"] == 0 && productData["data"]["isColor"] == 0) {
                    // 컬러 / 사이즈 선택 필요없는 경우
                } else {
                    if (productData["data"]["isColor"] == 1) {
                        $("#sellSizeSelectWrap .contents_wrap .color_box").addClass("on");
                    }

                    if (productData["data"]["isSize"] == 1) {
                        $("#sellSizeSelectWrap .contents_wrap .size_box").addClass("on");
                    }

                    $("#sellSizeSelectWrap .contents_wrap").attr({"productNo": product_id, "productName": productData["data"]["product_name"]});
                    $("#sellSizeSelectWrap .btn_wrap .select_btn").attr("onclick", "sellSizeSelectConfirm('"+product_id+"', this)");
                    $("#sellSizeSelectWrap").addClass("on");
                }

                
            } else {
                $(obj).prop("checked", false);
            }
        } else {
            // 상품선택취소
//            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_name_wrap .product_row[productno="+product_id+"]").remove();
        }
    }
}
/********** 판매 제품 선택 event END **********/



/********** 판매 제품 사이즈 / 컬러 선택 완료 event **********/
function sellSizeSelectConfirm(num, obj) {
    if ($("#sellSizeSelectWrap .contents_wrap .color_box").hasClass("on")) {// 컬러 선택이 필수인지 체크
        if ($("#sellSizeSelectWrap .contents_wrap .color_box .select_box .color_btn_box .color_select_btn_wrap .color_select_input[name=color_select]:checked").val() == undefined) {
            // 선택 안했을 경우
            return minzipsaAlert("컬러를 선택해주세요");
        }
        
        var color = $("#sellSizeSelectWrap .contents_wrap .color_box .select_box .color_btn_box .color_select_btn_wrap .color_select_input[name=color_select]:checked").parent(".color_select_btn_wrap").siblings(".box_title").html();
    }

    if ($("#sellSizeSelectWrap .contents_wrap .size_box").hasClass("on")) {// 사이즈 선택이 필수인지 체크
        if ($("#sellSizeSelectWrap .contents_wrap .size_box .select_box .size_btn_box .size_select_btn_wrap > input[name=size_select]:checked").val() == undefined) {
            // 선택 안했을 경우
            return minzipsaAlert("사이즈를 선택해주세요");
        }
        
        var size = $("#sellSizeSelectWrap .contents_wrap .size_box .select_box .size_btn_box .size_select_btn_wrap > input[name=size_select]:checked").val();
    }

    var name = $(obj).parent(".btn_wrap").parent(".contents_wrap").attr("productname");
    
    

    productsAddSellBasket(num, name, color, size);
    
    //옵션 선택 박스 초기화
    sellSizeSelectRemote();
}
/********** 판매 제품 사이즈 / 컬러 선택 완료 event END **********/



/********** 판매 제품 선택 완료 후 상품 추가 event **********/
function productsAddSellBasket(num, name, color, size) {
    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap .product_name_wrap").append(
        '<div class="product_row" productNo="'+num+'">' +
            '<div class="product_contents">' +
                '<p class="product_title">'+name+'</p>' +
                (size == undefined ? '' : '<p class="size_info">사이즈 : <span class="value">'+size+'</span></p>') +
                (color == undefined ? '' : '<p class="color_info">컬러 : <span class="value">'+color+'</span></p>') +
                '<div class="quantity_wrap">' +
                    '<input class="quantity_input" type="number" name="quantity_input_'+num+'" value="1"/>' +
                    '<p class="place_text">개</p>' +
                '</div>' +
            '</div>' +
            '<div class="delete_box">' +
                '<button class="delete_btn" onclick="thisSellProductDelete('+num+');">삭제</button>' +
            '</div>' +
        '</div>'
    );

    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap").addClass("on");
}
/********** 판매 제품 선택 완료 후 상품 추가 event END **********/



/********** 판매 제품 선택 상품 삭제 event **********/
function thisSellProductDelete(num) {
    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap .product_name_wrap .product_row[productno="+num+"]").remove();
    $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .add_product_wrap .select_contents .check_box .custom_check_box .custom_check_input[product_id="+num+"]").prop("checked", false);
}
/********** 판매 제품 선택 상품 삭제 event END **********/



/********** coupon 선택 event **********/
function couponBind(obj) {
    if (obj == undefined) {
        $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .coupon_view_wrap .product_name_wrap .product_row .product_name .name_text").html("");

        $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .coupon_view_wrap").removeClass("on");

        $("#minzipsa_payment .payment_wrap .step_wrap .custom_select_box[name=coupon] .custom_select_btn").html("쿠폰").attr("value", "none");
    } else {
        var value = $(obj).attr("value");

        if (value == "none") {
            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .coupon_view_wrap .product_name_wrap .product_row .product_name .name_text").html("");

            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .coupon_view_wrap").removeClass("on");
        } else {
            var couponName = $(obj).html();

            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .coupon_view_wrap .product_name_wrap .product_row .product_name .name_text").html(couponName);

            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .coupon_view_wrap").addClass("on");
        }
    }
}
/********** coupon 선택 event END **********/



/********** event 선택 event **********/
function eventBind(obj) {
    if (obj == undefined) {
        $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .event_view_wrap .product_name_wrap .product_row .product_name .name_text").html("");

        $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .event_view_wrap").removeClass("on");

        $("#minzipsa_payment .payment_wrap .step_wrap .custom_select_box[name=event] .custom_select_btn").html("이벤트").attr("value", "none");
    } else {
        var value = $(obj).attr("value");

        if (value == "none") {
            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .event_view_wrap .product_name_wrap .product_row .product_name .name_text").html("");

            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .event_view_wrap").removeClass("on");
        } else {
            var couponName = $(obj).html();

            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .event_view_wrap .product_name_wrap .product_row .product_name .name_text").html(couponName);

            $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .event_view_wrap").addClass("on");
        }
    }
}
/********** event 선택 event END **********/



// 결제 단계 remote
function infoStepRemote(name) {
    $("#minzipsa_payment .payment_wrap .step_wrap").removeClass("on");

    $("#minzipsa_payment .payment_wrap .step_wrap[name="+name+"]").addClass("on");
}



/********** 등록된 주소지 입력 action **********/
function getDefaultAddress() {
    var postCode = $("#post_code").val();
    var address = $("#addr_1").val();
    
    if (postCode != "" && address != "") {
        minzipsaConfirm("이미 주소지를 입력하셨습니다</br>등록된 주소지를 입력하시겠습니까?", "getDefaultAddressApi()");
    } else {
        getDefaultAddressApi();
    }
}
/********** 등록된 주소지 입력 action END **********/



/********** 등록죈 주소지 api 호출 **********/
function getDefaultAddressApi() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/api/user_data/get.user_address.php",
        success: function(data) {

            if (data["code"] == "MEMBER_ONLY") {
                minzipsaAlert(data["msg"]);
            } else if (data["code"] == "ADDRESS_NULL") {
                minzipsaAlert(data["msg"]);
            } else if (data["code"] == "SUCCESS") {
                $("#post_code").val(data["data"]["post_code"]);
                $("#addr_1").val(data["data"]["address"]);
                $("#addr_detail").val(data["data"]["address_detail"]);
            } else {
                minzipsaAlert("등록된 주소지 불러오기 중 에러발생</br>관리자에게 문의하세요");
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}
/********** 등록죈 주소지 api 호출 END **********/



/********** step 1 유효성 검사 **********/
function step1Check() {
    // 결제정보 팝업 초기화
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents").removeClass("on");
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=subscribe] .contents_box").empty();
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=sold] .contents_box").empty();

    // 결제정보 팝업 쿠폰값 초기화
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon] .detail_text_box .detail_text").html("");
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon] .detail_text_box .detail_value").html("");

    // 결제정보 팝업 이벤트값 초기화
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event] .detail_text_box .detail_text").html("");
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event] .detail_text_box .detail_value").html("");

    // 결제정보 최종 결제금액 값 초기화
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=price_result] .detail_text_box.sub_box").removeClass("on");
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=price_result] .detail_text_box.sub_box .detail_text").html("");
    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=price_result] .detail_text_box.sub_box .detail_value").html("");

    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=price_result] .detail_text_box.main_box .detail_value").html("");

    // 전체금액 계산용 지역함수
    var totalPrice = 0;

    // 선택한 구독제품
    var selectTotalPrice = 0;
    var productSelectArr = [];

    var count = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .product_select_wrap .select_contents .check_box").length;
    
    for (var i = 0; count > i; i++) {

        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=subscribe]").addClass("on");

        var productId = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .product_select_wrap .select_contents .check_box:nth-child("+(i + 1)+") .custom_check_box input").attr("product_id");
        var selectStatus = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .product_select_wrap .select_contents .check_box:nth-child("+(i + 1)+") .custom_check_box input").prop("checked");
        var hasSize = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap .product_row[productno="+productId+"] .product_contents .size_info").length;
        var hasColor = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap .product_row[productno="+productId+"] .product_contents .color_info").length;
        var selectSize = "";
        var selectColor = "";
        
        if (selectStatus == true) {
            var thisProductData = getProductId(productId);

            if (thisProductData["code"] == "SUCCESS") {

                totalPrice += parseInt(thisProductData["data"]["product_price"]);
                selectTotalPrice += parseInt(thisProductData["data"]["product_price"]);

                if (hasSize && hasColor) {
                    selectSize = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap .product_row[productno="+productId+"] .product_contents .size_info .value").html();
                    selectColor = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap .product_row[productno="+productId+"] .product_contents .color_info .value").html();

                    productSelectArr.push({
                        productId: productId,
                        productPrice: thisProductData["data"]["product_price"],
                        selectStatus: selectStatus,
                        selectSize: selectSize,
                        selectColor: selectColor
                    });
                } else if (hasSize) {
                    selectSize = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap .product_row[productno="+productId+"] .product_contents .size_info .value").html();

                    productSelectArr.push({
                        productId: productId,
                        productPrice: thisProductData["data"]["product_price"],
                        selectStatus: selectStatus,
                        selectSize: selectSize
                    });
                } else if (hasColor) {
                    selectColor = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap .product_row[productno="+productId+"] .product_contents .color_info .value").html();

                    productSelectArr.push({
                        productId: productId,
                        productPrice: thisProductData["data"]["product_price"],
                        selectStatus: selectStatus,
                        selectColor: selectColor
                    });
                } else {
                    productSelectArr.push({
                        productId: productId,
                        productPrice: thisProductData["data"]["product_price"],
                        selectStatus: selectStatus,
                    });
                }
            }
        }
    }

    if (productSelectArr.length == 0) {
        return minzipsaAlert("구독할 제품을 1개이상 선택해 주세요");
    }


    // 선택한 판매제품
    var selllSelectTotalPrice = 0;
    var sellProductSelectArr = [];

    var count = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .add_product_wrap .select_contents .check_box").length;
    
    for (var i = 0; count > i; i++) {

        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=sold]").addClass("on");

        var productId = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .add_product_wrap .select_contents .check_box:nth-child("+(i + 1)+") .custom_check_box input").attr("product_id");
        var selectStatus = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .add_product_wrap .select_contents .check_box:nth-child("+(i + 1)+") .custom_check_box input").prop("checked");
        var hasSize = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap .product_name_wrap .product_row[productno="+productId+"] .product_contents .size_info").length;
        var hasColor = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap .product_name_wrap .product_row[productno="+productId+"] .product_contents .color_info").length;
        var selectSize = "";
        var selectColor = "";
        
        if (selectStatus == true) {

            var thisSellProductData = getProductSellId(productId);

            if (thisSellProductData["code"] == "SUCCESS") {

                totalPrice += parseInt(thisSellProductData["data"]["product_price"]);
                selllSelectTotalPrice += parseInt(thisSellProductData["data"]["product_price"]);
                
                if (hasSize && hasColor) {
                    selectSize = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap .product_name_wrap .product_row[productno="+productId+"] .product_contents .size_info .value").html();
                    selectColor = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap .product_name_wrap .product_row[productno="+productId+"] .product_contents .color_info .value").html();

                    sellProductSelectArr.push({
                        productId: productId,
                        selectStatus: selectStatus,
                        selectSize: selectSize,
                        selectColor: selectColor
                    });
                } else if (hasSize) {
                    selectSize = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap .product_name_wrap .product_row[productno="+productId+"] .product_contents .size_info .value").html();

                    sellProductSelectArr.push({
                        productId: productId,
                        selectStatus: selectStatus,
                        selectSize: selectSize
                    });
                } else if (hasColor) {
                    selectColor = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap .product_name_wrap .product_row[productno="+productId+"] .product_contents .color_info .value").html();

                    sellProductSelectArr.push({
                        productId: productId,
                        selectStatus: selectStatus,
                        selectColor: selectColor
                    });
                } else {
                    sellProductSelectArr.push({
                        productId: productId,
                        selectStatus: selectStatus,
                    });
                }
            }
        }
    }


    // 선택한 쿠폰
    var selectCoupon = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .coupon_select_wrap .contents_wrap .custom_select_box[name=coupon] .custom_select_btn").attr("value");

    if (selectCoupon != "none") {
        var couponData = getCouponData(selectCoupon);
        console.log(couponData);

        if (couponData["code"] == "ERROR") {
            return minzipsaAlert(couponData["msg"]);
        } else {
            
            if (couponData["code"] == "SUCCESS") {
                $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon]").addClass("on");

                var couponName = "";
                couponName = couponData["data"]["coupons_name"] + "&nbsp;" + couponData["data"]["benefit_month"] + "개월";

                var couponPrice = 0;
                if (couponData["data"]["is_percent"] == 1) {
                    couponName = couponName + "&nbsp;" + couponData["data"]["benefit"] + "% 할인";
                    couponPrice = numberWithCommas(((totalPrice) * parseInt(couponData["data"]["benefit"])) / 100);
                } else if (couponData["data"]["is_won"] == 1) {
                    couponName = couponName + "&nbsp;" + numberWithCommas(couponData["data"]["benefit"]) + "원 할인";
                    couponPrice = numberWithCommas((totalPrice) - parseInt(couponData["data"]["benefit"]));
                }

                $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon] .detail_text_box .detail_text").html('📌'+couponName);

                $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon] .detail_text_box .detail_value").html('➖'+couponPrice+'원');

            } else if (couponData["code"] == "ERROR") {
                return minzipsaAlert(couponData["msg"]);
            }

        }
    }

    // 선택한 이벤트
    var selectEvent = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .coupon_select_wrap .contents_wrap .custom_select_box[name=event] .custom_select_btn").attr("value");

    if (selectEvent != "none") {
        var eventData = getEventData(selectEvent);
        console.log(eventData);

        if (eventData["code"] == "ERROR") {
            return minzipsaAlert(eventData["msg"]);
        } else {
            
            if (eventData["code"] == "SUCCESS") {
                $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event]").addClass("on");

                var eventName = "";
                eventName = eventData["data"]["events_name"] + "&nbsp;" + eventData["data"]["benefit_month"] + "개월";

                var eventPrice = 0;
                if (eventData["data"]["is_percent"] == 1) {
                    eventName = eventName + "&nbsp;" + eventData["data"]["benefit"] + "% 할인";
                    eventPrice = numberWithCommas(((totalPrice) * parseInt(eventData["data"]["benefit"])) / 100);
                } else if (eventData["data"]["is_won"] == 1) {
                    eventName = eventName + "&nbsp;" + numberWithCommas(parseInt(eventData["data"]["benefit"])) + "원 할인";
                    eventPrice = numberWithCommas((totalPrice) - parseInt(eventData["data"]["benefit"]));
                }

                $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event] .detail_text_box .detail_text").html('📌'+eventName);

                $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event] .detail_text_box .detail_value").html('➖'+eventPrice+'원');

            } else if (eventData["code"] == "ERROR") {
                return minzipsaAlert(eventData["msg"]);
            }
            
        }
    }

    // 배송지
    var addr_1 = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .shipping_select_wrap .address_wrap .address_row input[name=address]").val();
    var post_code = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .shipping_select_wrap .address_wrap .address_row input[name=post_code]").val();
    var addr_detail = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .shipping_select_wrap .address_wrap .address_row input[name=address_detail]").val();
    var shipping_memo = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .shipping_select_wrap .address_wrap .address_row input[name=shipping_memo]").val();

    if (addr_1 == "" || post_code == "" || addr_detail == "") {
        return minzipsaAlert("주소지를 입력해주세요");
    }

    // 첫배송희망일
    var delivery_date = $("#deliveryDate").val();
    var relative_date = new Date();
    relative_date.setDate(relative_date.getDate() + 3);
    relative_date = getFormatDate(relative_date);
    
    if (delivery_date == "") {
        return minzipsaAlert("첫 배송 희망일을 입력해주세요");
    } else if (delivery_date < relative_date) {
        return minzipsaAlert("첫 배송일은 주문일 기준 +3일 이후로 선택가능합니다");
    }

    step1PopupRemote('on');
//    step1PriceCheck();
}
/********** step 1 유효성 검사 END **********/



/********** step 1 결제정보 popup remote **********/
function step1PopupRemote(remote) {
    if (remote == "on") {
        $("#priceCalculateWrap").addClass("on");
    } else {
        // 결제정보 팝업 초기화
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents").removeClass("on");
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=subscribe] .contents_box").empty();
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=sold] .contents_box").empty();

        // 결제정보 팝업 쿠폰값 초기화
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon] .detail_text_box .detail_text").html("");
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon] .detail_text_box .detail_value").html("");

        // 결제정보 팝업 이벤트값 초기화
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event] .detail_text_box .detail_text").html("");
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event] .detail_text_box .detail_value").html("");

        // 결제정보 최종 결제금액 값 초기화
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=price_result] .detail_text_box.sub_box").removeClass("on");
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=price_result] .detail_text_box.sub_box .detail_text").html("");
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=price_result] .detail_text_box.sub_box .detail_value").html("");
        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=price_result] .detail_text_box.main_box .detail_value").html("");

        $("#priceCalculateWrap").removeClass("on");
    }
}
/********** step 1 결제정보 popup remote END **********/



/********** step 1 결제 정보 확인 **********/
function step1PriceCheck() {
//    // 선택한 구독제품
//    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=subscribe] .contents_box").empty();
//    var productSelectArr = [];
//    var count = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap .product_row").length;
//    var totalPrice = 0;
//    
//    for (var i = 0; count > i; i++) {
//        var targetElement = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_name_wrap .product_row:nth-child("+(i + 1)+")");
//        var productId = targetElement.attr("productno");
//        var selectCount = targetElement.children(".product_contents").children(".quantity_wrap").children(".quantity_input").val();
//
//        if (isNaN(selectCount)) {
//            return minzipsaAlert("선택한 제품의 수량을 정확하게 입력해주세요");
//        }
//
//        productSelectArr.push({
//            productId: productId
//        });
//    }
//
//    // 선택한 판매제품
//    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=sold] .contents_box").empty();
//    var saleProductSelectArr = [];
//    var count = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .add_product_wrap .select_contents .check_box").length;
//    var selectTotalPrice = 0;
//    
//    for (var i = 0; count > i; i++) {
//        var targetElement = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .product_select_list .product_name_wrap .product_row:nth-child("+(i + 1)+")");
//
//        var saleId = targetElement.attr("productno");
//        var saleSize = targetElement.attr("product_name");
//        var salePrice = targetElement.attr("price");
//        var selectCount = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .total_price_wrap .detail_wrap .plus_select_wrap .product_name_wrap .product_row[number="+saleId+"] .quantity_wrap .product_quantity_input").val();
//        if (isNaN(selectCount)) {
//            return minzipsaAlert("선택한 제품의 수량을 정확하게 입력해주세요");
//        }
//
//        saleProductSelectArr.push({
//            saleId: saleId,
//            saleName: saleName,
//            salePrice: salePrice,
//        });
//
//        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=sold]").addClass("on");
//        $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=sold] .contents_box").append(
//            '<div class="contents_row">' +
//                '<div class="product_box">' +
//                    '<p class="product_name">'+saleName+'&nbsp;X&nbsp;</p>' +
//                    '<p class="product_count">'+selectCount+'</p>' +
//                '</div>' +
//                '<div class="price_box">' +
//                    '<p class="price_value">🛒&nbsp;'+numberWithCommas((salePrice * selectCount))+'원</p>' +
//                '</div>' +
//            '</div>'
//        );
//
//        selectTotalPrice += salePrice * selectCount;
//
//    }

    // 선택한 쿠폰
    
//    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon] .detail_text_box").empty();
//    var selectCoupon = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .coupon_select_wrap .contents_wrap .custom_select_box[name=coupon] .custom_select_btn").attr("value");
//    var couponData = getCouponData(selectCoupon);
//    
//    if (couponData == "none") {
//
//    } else {
//        if (couponData["code"] == "SUCCESS") {
//            $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon]").addClass("on");
//            
//            var couponName = "";
//            couponName = couponData["data"]["coupons_name"] + "&nbsp;" + couponData["data"]["benefit_month"] + "개월";
//
//            var couponPrice = 0;
//            if (couponData["data"]["is_percent"] == 1) {
//                couponName = couponName + "&nbsp;" + couponData["data"]["benefit"] + "% 할인";
//                couponPrice = numberWithCommas(((totalPrice + selectTotalPrice) * couponData["data"]["benefit"]) / 100);
//            } else if (couponData["data"]["is_won"] == 1) {
//                couponName = couponName + "&nbsp;" + numberWithCommas(couponData["data"]["benefit"]) + "원 할인";
//                couponPrice = numberWithCommas((totalPrice + selectTotalPrice) - couponData["data"]["benefit"]);
//            }
//            
//            $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon] .detail_text_box").append(
//                '<p class="detail_text">📌'+couponName+'</p>'
//            );
//
//            $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=coupon] .detail_text_box").append(
//                '<p class="detail_value">➖'+couponPrice+'원</p>');
//
//        } else if (couponData["code"] == "ERROR") {
//            return minzipsaAlert(couponData["msg"]);
//        }
//    }
    
    // 선택한 이벤트
//    $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event] .detail_text_box").empty();
//    var selectEvent = $("#minzipsa_payment .payment_wrap .step_wrap[name=step_1] .coupon_select_wrap .contents_wrap .custom_select_box[name=event] .custom_select_btn").attr("value");
//    var eventData = getEventData(selectEvent);
//    
//    if (eventData == "none") {
//        
//    } else {
//        if (eventData["code"] == "SUCCESS") {
//            $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event]").addClass("on");
//            
//            var eventName = "";
//            eventName = eventData["data"]["events_name"] + "&nbsp;" + eventData["data"]["benefit_month"] + "개월";
//
//            var eventPrice = 0;
//            if (eventData["data"]["is_percent"] == 1) {
//                eventName = eventName + "&nbsp;" + eventData["data"]["benefit"] + "% 할인";
//                eventPrice = numberWithCommas(((totalPrice + selectTotalPrice) * eventData["data"]["benefit"]) / 100);
//            } else if (eventData["data"]["is_won"] == 1) {
//                eventName = eventName + "&nbsp;" + numberWithCommas(eventData["data"]["benefit"]) + "원 할인";
//                eventPrice = numberWithCommas(eventData["data"]["benefit"]);
//            }
//            
//            $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event] .detail_text_box").append(
//                '<p class="detail_text">📌'+eventName+'</p>'
//            );
//
//            $("#priceCalculateWrap .contents_wrap .calculate_box .box_contents[name=event] .detail_text_box").append(
//                '<p class="detail_value">➖'+eventPrice+'원</p>');
//        } else if (eventData["code"] == "ERROR") {
//            return minzipsaAlert(eventData["msg"]);
//        }
//    }
    
    step1PopupRemote('on');
}
/********** step 1 결제 정보 확인 END **********/



// step 1 결제 진행 클릭 event
function step1Submit() {
    infoStepRemote('step_2');
    step1PopupRemote();
}



/********** coupon 정보 get **********/
function getCouponData(id) {
    if (id == "none") {
        return "none";
    } else {
        var returnData = "";
        $.ajax({
            async: false,
            type: "POST",
            data: JSON.stringify({
                couponId: id,
            }),
            url: "/api/coupons/get.coupons_data.php",
            success: function(data) {
                returnData = data;
            },
            error: function(error) {
                returnData = error;
            }
        });

        return returnData;
    }
}
/********** coupon 정보 get END **********/



/********** event 정보 get **********/
function getEventData(id) {
    if (id == "none") {
        return "none";
    } else {
        var returnData = "";
        $.ajax({
            async: false,
            type: "POST",
            data: JSON.stringify({
                eventId: id,
            }),
            url: "/api/events/get.events_data.php",
            success: function(data) {
                returnData = data;
            },
            error: function(error) {
                returnData = error;
            }
        });
        
        return returnData;
    }
}
/********** event 정보 get END **********/



/********** custom selectbox **********/
function customSelectRemote(remote, name) {
    if (remote == 'on') {
        $("#minzipsa_payment .payment_wrap .step_wrap .custom_select_box .custom_option_wrap").removeClass("on");
        $("#minzipsa_payment .payment_wrap .step_wrap .custom_select_box[name="+name+"] .custom_option_wrap").addClass("on");
    } else {
        $("#minzipsa_payment .payment_wrap .step_wrap .custom_select_box .custom_option_wrap").removeClass("on");
    }
}

function customSelectOptionClick(obj, name) {
    var html = $(obj).html();
    var value = $(obj).attr("value");

    $("#minzipsa_payment .payment_wrap .step_wrap .custom_select_box[name="+name+"] .custom_select_btn").html(html).attr("value", value);
    customSelectRemote();
}

$('html').click(function(e) {
    if (!$(e.target).hasClass('custom_select_btn') && !$(e.target).hasClass('custom_select_box')) {
        $('.custom_option_wrap').removeClass('on');
    }
});
/********** custom selectbox END **********/



/********** 다음 지도 api **********/
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
/********** 다음 지도 api END **********/



// date format 변환
function getFormatDate(date){
    var year = date.getFullYear();              //yyyy
    var month = (1 + date.getMonth());          //M
    month = month >= 10 ? month : '0' + month;  //month 두자리로 저장
    var day = date.getDate();                   //d
    day = day >= 10 ? day : '0' + day;          //day 두자리로 저장
    return  year + '.' + month + '.' + day;       //'-' 추가하여 yyyy-mm-dd 형태 생성 가능
}


// 3자리마다 콤마
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function postCodeAlert() {
    minzipsaAlert("우편번호 찾기를 클릭해주세요");
}


function dataPickerLoad() {
    $("#deliveryDate").datepicker({ defaultDate : new Date() });
    
    $('#ui-datepicker-div').wrap('<div id="deliveryDatepickerWrap"/>');

    $.datepicker.setDefaults({
        dateFormat: 'yy.mm.dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년',
        beforeShow: function(input) {
            setTimeout(function() {
                $('#ui-datepicker-div').css({'position': '', 'top': '', 'left': '', 'transform': '' });
                $('#deliveryDatepickerWrap').addClass('on');
            })
        },
        onClose: function() {
            setTimeout(function() {
                $('#deliveryDatepickerWrap').removeClass('on');
            })
        },
        showButtonPanel: true,
        closeText: '닫기'
    });
}