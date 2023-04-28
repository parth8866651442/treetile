<?php 
include_once('config.php');
require_once('function.php');
session_start();
$obj_fun = new functions();

if(!isset($_SESSION['status']))
{
	?>
	<script type="text/javascript">
		window.location = "login.php"
	</script>
	<?php
}
$admin = $obj_fun ->getUser('admin');
$pdf='';
$errors=0;
$rand = rand(1111,9999);

if (is_uploaded_file($_FILES['pdf']['tmp_name'])) 
{
	if ($_FILES['pdf']['type'] != "application/pdf") 
	{
		echo "<p>Class notes must be uploaded in PDF format.</p>";
	} 
	else 
	{
		 $pdf = move_uploaded_file($_FILES['pdf']['tmp_name'], '../uploads/catalogue/'.$rand.'_'.$_FILES['pdf']['name']);
		 
	}
}
 if($errors ==0 && $pdf>0)
 {
	$obj_fun -> insertCatalogue($_POST['name'],$_POST['size'],$rand.'_'.$_FILES['pdf']['name']);
	header('location:catalogue.php');
	
 }
 else
 {
	echo 'Date Insert Error';
 }
?>