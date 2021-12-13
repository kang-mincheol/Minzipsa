<?
include_once('../common.php');   // 기본파일 로드
include_once('../header.php');   // 헤더파일 로드

?>

<!-- page CSS -->
<style type="text/css">
.card-primary .card-header .banner_write_btn {
    color:#444!important;
    position:absolute;
    top:50%;
    right:1.25rem;
    transform:translate(0, -50%);
    -webkit-transform:translate(0, -50%);
}

.jsgrid-table .jsgrid-cell > img {
    display:block;
    width:100%;
}

.jsgrid-header-row > .jsgrid-header-cell,
.jsgrid-table .jsgrid-cell {
        text-align:center;
}
</style>
<!-- page CSS END -->

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
                        <h3 class="card-title">배너 목록</h3>
                        <a href="./banner_write.php" class="btn bt-block btn-default banner_write_btn">배너 등록</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="jsGrid1"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>


<!-- page script -->
<script type="text/javascript">
$(function() {
    bannerListLoad();
});
function bannerListLoad() {
    $.blockUI();

    $.ajax({
        async: true,
        type: 'post',
        dataType: 'json',
        url: '/api/admin/banner/list.php',
        success: function(data) {
            console.log(data);
            $(data.data).each(function() {
                if (this.type == "main") {
                    this.type = "메인페이지";
                } else if (this.type == "mypage") {
                    this.type = "마이페이지";
                }
                
                if (this.is_delete == "1") {
                    this.is_delete = "X";
                } else if (this.is_delete == "0") {
                    this.is_delete = "O";
                }
            })
            returnData = data.data;
            bindData(returnData);
            $.unblockUI();
        },
        error: function(error) {
            console.log(error);
            $.unblockUI();
        }
    })
}
function bindData(data) {
    $("#jsGrid1").jsGrid({
        width: "100%",

        sorting: true,
        paging: true,
        pageIndex: 1,
        pageSize: 10,
        data: data,

        fields: [{
                name: "id",
                type: "text",
                width: 30,
                title: "No"
            },
            {
                name: "content",
                type: "image",
                width: 100,
                title: "이미지"
            },
            {
                name: "type",
                type: "text",
                width: 100,
                title: "뷰페이지"
            },
            {
                name: "subject",
                type: "text",
                width: 100,
                title: "배너제목"
            },
            {
                name: "sort_order",
                type: "text",
                width: 50,
                title: "우선순위"
            },
            {
                name: "link",
                type: "text",
                width: 100,
                title: "링크 URL"
            },
            {
                name: "from_date",
                type: "text",
                width: 100,
                title: "시작일"
            },
            {
                name: "to_date",
                type: "text",
                width: 100,
                title: "종료일"
            },
            {
                name: "is_delete",
                type: "text",
                width: 50,
                title: "노출상태"
            }
        ],
        rowClick: function(args) {
            console.log(args);
            var bannerId = args.item.id;
            location.href = "/admin/setup/banner_write.php?bannerNo=" + bannerId;
        }
    });
}
</script>

<?
include_once('../footer.php');   // 푸터파일 로드
?>