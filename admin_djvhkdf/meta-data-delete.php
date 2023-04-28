<?php ob_start(); ?>	
<?php 
	include "../db.php";
	$type=$_GET['type'];
	global $con;
	$sql = "delete FROM `settings` WHERE `type` = '$type'";
	$res  = mysqli_query($con,$sql);
	if($res)
	{
		echo '<script>alert("Metadata Deleted Successfully");window.location.href = "meta-data.php";</script>';
	}
?>
	