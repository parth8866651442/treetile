<?php
include_once('../db.php');

if($_REQUEST["id"] != ""){
	global $con;
	$s_size = mysqli_query($con,"SELECT * FROM `product_size` where menu_id='".$_REQUEST["id"]."' AND status = '1'");
	if(mysqli_num_rows($s_size) > 0){ 
		while($res = mysqli_fetch_assoc($s_size)){
			echo '<option value="'. $res['id'] .'">'. $res['size'] .'</option>';
		}
	}else{
		echo "0";
		die;
	}
}else{
	echo "0";
	die;
}
?>