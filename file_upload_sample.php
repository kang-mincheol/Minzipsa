<?
include_once('common.php');   // 기본파일 로드
include_once('header.php');   // 헤더파일 로드

?>

<link rel="stylesheet" href="<?=$relative_path?>index.css?ver=<?=getVersion($relative_path.'index.css')?>" />
<script type="text/javascript" src="<?=$relative_path?>index.js?ver=<?=getVersion($relative_path.'index.js')?>" ></script>
<script type="text/javascript" src="<?=$relative_path?>file_upload_sample.js?ver=<?=getVersion($relative_path.'file_upload_sample.js')?>" ></script>


<br />
<br />
<br />
<br />
<br />
<br />
<input type="file" name="files" multiple />
<input type="button" id="btnUpload" value="전송" />

<progress id="pgfile" value="0" max="100"></progress>
<br />
<br />
<br />
<br />
<a target="blank" href="/api/files/load.php?guid=ABA17CD1-B9F3-45D5-917A-995D453855BA">첨부파일 링크</a>
<br />
<br />
<img src="/api/files/load.php?guid=ABA17CD1-B9F3-45D5-917A-995D453855BA" style="width:500px" />




<?


include_once('footer.php');   // 푸터파일 로드

?>