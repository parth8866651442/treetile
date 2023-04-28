<?php  
$file='export';
if(isset($_GET['file']) && $_GET['file']!='')
	$file=$_GET['file'];
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=".$file.".xls");
header("Content-Transfer-Encoding: binary ");

echo strip_tags($_POST['tableData'],'<table><th><tr><td>');  
?>
