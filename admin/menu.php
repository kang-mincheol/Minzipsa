<?
if (!defined('NO_ALONE')) exit; // 개별 페이지 접근 불가
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/admin/" class="brand-link">
    <img src="/img/CI-37.png" alt="DailyPay Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">DailyPay Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              마이페이지
              <i class="fas fa-angle-left right"></i>
              <!-- <span class="badge badge-info right">6</span> -->
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/mypage/info_update.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>회원정보변경</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              회원관리
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/admin/users/user_list.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>회원목록</p>
              </a>
            </li>
            <li class="nav-item">
                <a href="/admin/users/join_history.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>회원 유입 경로 분석</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              서비스 신청 관리
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/service/request_list.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>신청목록</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/service/request_confirm.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>심사완료</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/service/request_reject.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>탈락목록</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-hand-holding-usd"></i>
            <p>
              선정산 실행 관리
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/prepay/request_list.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>신청목록</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/prepay/request_confirm.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>지급완료</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/prepay/request_reject.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>지급거절</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-money-check"></i>
            <p>
              상환관리
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  WMP
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>고객별 잔액 관리</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>채권별 상환 관리</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>정산 내역 조회</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  TMON
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>고객별 잔액 관리</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>채권별 상환 관리</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>정산 내역 조회</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              조회
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/search/available_money.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>고객별 이용 가능 금액</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>가상계좌거래내역 조회</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/search/user_total_loan.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>고객별 정산내역조회</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/search/calendar.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>정산 달력</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              리스크 관리
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Menu 1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Menu 2</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              통계
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/report/visit.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>방문자</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-money-bill-alt"></i>
            <p>
              출금
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/withdraw/withdraw.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>출금</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              시스템 설정
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/setup/banner_list.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>배너 관리</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>