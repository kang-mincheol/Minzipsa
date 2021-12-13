<?
include_once('../../common.php');   // 기본파일 로드
include_once('../../header.php');   // 헤더파일 로드
?>

<link rel="stylesheet" href="<?=$relative_path?>index.css?ver=<?=getVersion($relative_path.'index.css')?>" />


<div id="pageWrapper">

    <p class="box_title">구독상품</p>
    <div class="product_wrap" name="subscribe_product">
        
        <div class="product_row">
            <div class="product_box">
                <a class="product_link" href="/minzipsa/product_detail/?product_id=1" target="_self">
                    <div class="bg_layer">
                        <p class="product_title">매트리스 커버</p>
                        <p class="product_price">월 10,000원</p>

                        <div class="hover_box">제품 보기</div>
                    </div>
                </a>
            </div><!-- product_box -->

            <div class="product_box">
                <a class="product_link" href="/minzipsa/product_detail/?product_id=1" target="_self">
                    <div class="bg_layer">
                        <p class="product_title">매트리스 커버</p>

                        <div class="hover_box">제품 보기</div>
                    </div>
                </a>
            </div><!-- product_box -->

            <div class="product_box">
                <a class="product_link" href="/minzipsa/product_detail/?product_id=1" target="_self">
                    <div class="bg_layer">
                        <p class="product_title">매트리스 커버</p>

                        <div class="hover_box">제품 보기</div>
                    </div>
                </a>
            </div><!-- product_box -->

            <div class="product_box">
                <a class="product_link" href="/minzipsa/product_detail/?product_id=1" target="_self">
                    <div class="bg_layer">
                        <p class="product_title">매트리스 커버</p>

                        <div class="hover_box">제품 보기</div>
                    </div>
                </a>
            </div><!-- product_box -->
        </div><!-- product_row -->
        
        <div class="product_row">
            <div class="product_box">
                <a class="product_link" href="/minzipsa/product_detail/?product_id=1" target="_self">
                    <div class="bg_layer">
                        <p class="product_title">매트리스 커버</p>

                        <div class="hover_box">제품 보기</div>
                    </div>
                </a>
            </div><!-- product_box -->
        </div><!-- product_row -->

    </div><!-- subscribe_product -->



</div><!-- pageWrapper -->


<script type="text/javascript" src="<?=$relative_path?>index.js?ver=<?=getVersion($relative_path.'index.js')?>" charset="utf-8"></script>
<script type="text/javascript">


</script>
<?
include_once('../../footer.php');   // 푸터파일 로드

?>