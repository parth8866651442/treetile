<?php
error_reporting(0);
include('../db.php');

if($_POST['action'] == 'getRecords'){
	
	//echo $_POST['sql'];
	
	 $data = $obj_fun->getRecords($_POST['sql']);
	echo json_encode($data);
	
	}
	
if($_POST['action'] == 'getLastRecords'){
	
	 $data = $obj_fun->getLastRecords($_POST['sql']);
	 echo json_encode($data);
	
	}
	
if($_POST['action'] == 'getImageByProductId'){
	
	 $data = $obj_fun->getImageByProductId($_POST['id']);
	 echo json_encode($data);
	
	}

?>