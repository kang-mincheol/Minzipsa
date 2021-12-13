<?
include_once('../common.php');   // 기본파일 로드
include_once('../header.php');   // 헤더파일 로드

?>

<style type="text/css">
.bootstrap-switch .bootstrap-switch-handle-off,
.bootstrap-switch .bootstrap-switch-handle-on,
.bootstrap-switch .bootstrap-switch-label {
    padding: 0.5rem .5rem;
}

.custom-file-label::after {
    content: '파일 선택';
}

#previewImg {
    display:block;
    width:100%;
}
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?= SetTitle("시스템 설정 > 배너 관리") ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">배너 등록</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="bannerSubject">배너 제목</label>
                                    <input type="text" id="bannerSubject" class="form-control" placeholder="배너 상단에 들어갈 텍스트 입력"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="bannerLink">연결 링크</label>
                                    <input type="text" id="bannerLink" class="form-control" placeholder="배너 클릭시 이동할 URL 입력"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="bannerOrder">노출 페이지</label>
                                    <select id="bannerType" class="form-control" onchange="selectType(this)" value="main">
                                        <option value="main">메인페이지</option>
                                        <option value="mypage">마이페이지</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="bannerOrder">우선 순위</label>
                                    <input type="number" id="bannerOrder" class="form-control" placeholder="1 이 제일 상단에 노출"/>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="bannerDisableDays">? 일간 보지않음</label>
                                    <input type="number" id="bannerDisableDays" class="form-control" placeholder="숫자만 입력"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9 col-sm-12">
                                <div class="form-group">
                                    <label for="bannerDate">배너 시작시간 / 종료시간</label>
                                    <input type="text" id="bannerDate" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label for="bannerIsDelete">노출 상태</label><br>
                                    <input type="checkbox" name="my-checkbox" checked="true" data-bootstrap-switch>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bannerImg">이미지 등록 (이미지 파일만 첨부해주세요)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="bannerImg" class="custom-file-input"/>
                                            <label for="bannerImg" class="custom-file-label">파일 선택</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="previewImg">이미지 미리보기</label>
                                    <div class="img_wrap">
                                        <img id="previewImg"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="javascript:void(0);" id="bannerSubmitBtn" class="btn btn-primary" onclick="bannerInfoInsert()">배너 등록</a>
                                <a href="javascript:void(0);" class="btn btn-default" onclick="location.href='/admin/setup/banner_list.php'">취소</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

<!-- Bootstrap Switch -->
<script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- page script -->
<script type="text/javascript">
$(function() {

    //팝업이미지 미리보기
    $("#bannerImg").on("change", handleImgFileSelect);

    //custom file input
    bsCustomFileInput.init();

    //부트스트랩 datepicker 호출
    $("#bannerDate").daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss'
        }
    });

    //쿼리스트링 체크후 데이터 호출
    var queryStringVal = searchParam("bannerNo");
    console.log(queryStringVal);
    if (queryStringVal == null) {

    } else {
        bannerInfoLoad(queryStringVal);
    }

    //부트스트랩 switch 호출
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
});

//이미지 선택시 미리보기
var sel_file;
function handleImgFileSelect(e) {
    $.blockUI();
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);

    filesArr.forEach(function(f) {
        sel_file = f;

        var reader = new FileReader();
        reader.onload = function(e) {
            $("#previewImg").attr("src", e.target.result);
        }
        reader.readAsDataURL(f);
    });
    $.unblockUI();
}

//쿼리스트링 체크 함수
function searchParam(key) {
    return new URLSearchParams(location.search).get(key);
};

//노출페이지 select onchange 함수
function selectType(obj) {
    var thisVal = $(obj).children('option:selected').attr('value');
    $(obj).attr('value', thisVal);
}

//배너정보 API Load
function bannerInfoLoad(num) {
    $.blockUI();
    $.ajax({
        async: false,
        type: 'post',
        dataType: 'json',
        url: '/api/admin/banner/banner_load.php',
        data: JSON.stringify({
            bannerNo: num
        }),
        success: function(data) {
            console.log(data.data);
            var checkResult = false;
            $("#bannerSubject").val(data.data.subject);
            $("#bannerLink").val(data.data.subject);
            $("#bannerType").attr('value', data.data.type);
            $("#bannerOrder").val(data.data.sort_order);
            $("#bannerDisableDays").val(data.data.disable_days);
            $("#bannerDate").val(data.data.from_date + " - " + data.data.to_date);
            if (data.data.is_delete == '0') {
                checkResult = true;
            } else if (data.data.is_delete == '1') {
                checkResult = false;
            }
            $("input[name=my-checkbox]").prop('checked', checkResult);
            $(".card-title").html("배너 수정");
            $("#bannerSubmitBtn").html("배너 수정").attr('onclick', 'bannerInfoUpdate('+ num +')');

            $.unblockUI();
        },
        error: function(error) {
            console.log(error);
            $.unblockUI();
        }
        
    })
}

//배너 수정 API
function bannerInfoUpdate(num) {

    var dateVal = $("#bannerDate").val();
    dateVal = dateVal.split(' - ');
    var fromDate = dateVal[0];
    var toDate = dateVal[1];
    var deleteVal = $("input[name=my-checkbox]").prop('checked');
    if (deleteVal == true) {
        deleteVal = false;
    } else if (deleteVal == false) {
        deleteVal = true;
    }
    $.ajax({
        async: false,
        type: 'post',
        dataType: 'json',
        url:'/api/admin/banner/banner_update.php',
        data: JSON.stringify({
            id: num,
            type: $("#bannerType").attr("value"),
            subject: $("#bannerSubject").val(),
            content: '',
            link: $("#bannerLink").val(),
            disable_days: $("#bannerDisableDays").val(),
            sort_order: $("#bannerOrder").val(),
            from_date: fromDate,
            to_date: toDate,
            is_delete: deleteVal
        }),
        success: function(data) {
            console.log(data);
            
            alert('배너 수정 완료');
            location.href='/admin/setup/banner_list.php';
        },
        error: function(error) {
            console.log(error);
        }
    })
}

//배너 신규등록 API
function bannerInfoInsert() {
    $.blockUI();

    var dateVal = $("#bannerDate").val();
    dateVal = dateVal.split(' - ');
    var fromDate = dateVal[0];
    var toDate = dateVal[1];
    var deleteVal = $("input[name=my-checkbox]").prop('checked');
    if (deleteVal == true) {
        deleteVal = false;
    } else if (deleteVal == false) {
        deleteVal = true;
    }
    //파일업로드 후 guid return
    var formData = new FormData();
    i = 0;
    formData.append("files_0", $("#bannerImg")[0].files[0]);
    var imgUploadResult;
    $.ajax({
        async: false,
        url:'/api/files/upload.php',
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            console.log(data);
            console.log('업로드 성공');
        },
        error: function(request, status, error) {
            imgUploadResult = false;
//            console.log(data.responseText);
            $.unblockUI();
            alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
        }
    })
    if (imgUploadResult == false) {
        return alert('이미지 업로드 실패');
    }
    
    //쿼리문
    $.ajax({
        async: false,
        type: 'post',
        dataType: 'json',
        url: '/api/admin/banner/banner_insert.php',
        data: JSON.stringify({
            type: $("#bannerType").attr("value"),
            subject: $("#bannerSubject").val(),
            content: '',
            link: $("#bannerLink").val(),
            disable_days: $("#bannerDisableDays").val(),
            sort_order: $("#bannerOrder").val(),
            from_date: fromDate,
            to_date: toDate,
            is_delete: deleteVal
        }),
        success: function(data) {
            console.log(data);
            if(data.code == "SUCCESS") {
                $.unblockUI();
                //확인창
                console.log('업로드완료');
                alert('배너 등록 완료');
                location.href='/admin/setup/banner_list.php';
            } else {
                $.unblockUI();
            }
        },
        error: function(error) {
            console.log(error);
            $.unblockUI();
        }
    })
}
</script>

<?
include_once('../footer.php');   // 푸터파일 로드
?>