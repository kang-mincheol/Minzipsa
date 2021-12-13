<?
include_once('common.php');   // 기본파일 로드
include_once('header.php');   // 헤더파일 로드
include_once('menu.php');     // 메뉴파일 로드

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/google.lib.php');

$result = sql_fetch("

");


?>


<script type="text/javascript">
  $(function() {

  });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?= SetTitle("대시보드") ?>
  <!-- /.content-header -->
  <section class="content">
    <div class="col-12">
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Page 1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Page 2</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
              <section class="content">
                <div class="container-fluid">
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3><?= $new_request ?></h3>
                          <p>신규 서비스 신청 수</p>
                        </div>
                        <a href="/admin/service/request_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3><?= $new_joiner ?></h3>
                          <p>오늘 신규 회원가입 수 (<?= date("Y-m-d") ?>)</p>
                        </div>
                        <a href="/admin/users/user_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($available_total_money_confirm_1) ?></h3>
                          <p>데일리제일차 신청가능금액</p>
                        </div>
                        <a href="/admin/search/available_money.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($available_total_money_confirm_2) ?></h3>
                          <p>데일리제이차 신청가능금액</p>
                        </div>
                        <a href="/admin/search/available_money.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3><?= number_format($request_money_1) ?></h3>
                          <p>데일리제일차 신청금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3><?= number_format($request_money_2) ?></h3>
                          <p>데일리제이차 신청금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3><?= number_format($give_money_1) ?></h3>
                          <p>데일리제일차 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3><?= number_format($give_money_2) ?></h3>
                          <p>데일리제이차 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($balance_1->data->moneyPair->amount) ?></h3>
                          <p>데일리제일차 계좌잔액</p>
                          <p><?= $user_1["v_account_bank_name"] . " " . $user_1["v_account_number"] ?></p>
                        </div>
                        <a href="javascript:alert('준비중입니다.')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($balance_2->data->moneyPair->amount) ?></h3>
                          <p>데일리제이차 계좌잔액</p>
                          <p><?= $user_2["v_account_bank_name"] . " " . $user_2["v_account_number"] ?></p>
                        </div>
                        <a href="javascript:alert('준비중입니다.')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
              <section class="content">
                <div class="container-fluid">
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3><?= $user_total ?></h3>
                          <p>전체 회원 수</p>
                        </div>
                        <a href="/admin/users/user_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3><?= $today_user_total ?></h3>
                          <p>오늘 회원가입 수</p>
                        </div>
                        <a href="/admin/users/user_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3><?= $visit_count ?></h3>
                          <p>오늘 방문자 수</p>
                        </div>
                        <a href="/admin/report/visit.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3><?= number_format($accum_give_money) ?></h3>
                          <p>누적 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3><?= number_format($month_give_money) ?></h3>
                          <p><?= date("m") ?>월 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3><?= number_format($today_give_money) ?></h3>
                          <p>오늘 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($accum_give_money_1) ?></h3>
                          <p>누적 위메프 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($month_give_money_1) ?></h3>
                          <p><?= date("m") ?>월 위메프 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($today_give_money_1) ?></h3>
                          <p>오늘 위메프 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($accum_give_money_2) ?></h3>
                          <p>누적 티몬 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($month_give_money_2) ?></h3>
                          <p><?= date("m") ?>월 티몬 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?= number_format($today_give_money_2) ?></h3>
                          <p>오늘 티몬 실행금액</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3><?= number_format($accum_fee) ?></h3>
                          <p>&nbsp;</p>
                          <p>누적 합계 이용료</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3><?= number_format($month_fee) ?></h3>
                          <p>&nbsp;</p>
                          <p><?= date("m") ?>월 합계 이용료</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3><?= number_format($today_fee) ?></h3>
                          <p>&nbsp;</p>
                          <p>오늘 발생 이용료</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
</div>

<?
include_once('footer.php');   // 푸터파일 로드
?>