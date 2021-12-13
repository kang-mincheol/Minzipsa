<?
include_once('common.php');   // 기본파일 로드
include_once('header.php');   // 헤더파일 로드
include_once('menu.php');     // 메뉴파일 로드
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/paygate.lib.php');   // paygate 파일 로드

PayGate::create_repay_virtual_account(14);

?>


<script type="text/javascript">
  $(function(){
    
  });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?=SetTitle("대시보드")?>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
    </div>
  </section>
  <!-- /.content -->
</div>

<?
include_once('footer.php');   // 푸터파일 로드
?>