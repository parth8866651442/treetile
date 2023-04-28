<?php
$cookie_name = "sitename";
$cookie_value = "company";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 

include_once('../db.php');
require_once('../'.admin_folder.'/function.php');
$obj_fun = new functions();

$file = base64_decode($_GET['file']);

$word = "https://api.whatsapp.com";
$mystring = $file;
 
// Test if string contains the word 
if(strpos($mystring, $word) !== false){
   
} else{
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
            $link = "https"; 
        else
            $link = "http"; 
        
        $link .= "://"; 
        
        $link .= $_SERVER['HTTP_HOST']; 
        
        echo '<script>window.location.href = "'.$link.'";</script>';
}

global $con;  
$getIP = getIP();
if($getIP){
	$sql = mysqli_query($con,"SELECT * FROM `whatsapp_analytics` WHERE `ip` = '".$getIP."' AND adate='".date("Y-m-d")."'");
	if(mysqli_num_rows($sql) > 0){
		$al_res = mysqli_fetch_assoc($sql);
		$update = mysqli_query($con,"UPDATE whatsapp_analytics SET visitCount='".($al_res["visitCount"] + 1)."' WHERE id='".$al_res["id"]."'");
		if($update){
			echo '<script>window.location.href = "'.$file.'";</script>';
		}else{
			echo '<script>window.location.href = "'.$file.'";</script>';
		}
	}else{
		$insert = mysqli_query($con,"INSERT INTO `whatsapp_analytics`(`ip`, `visitCount`, `adate`) VALUES ('".$getIP."','1','".date("Y-m-d")."')");
		if($insert){
			echo '<script>window.location.href = "'.$file.'";</script>';
		}else{
			echo '<script>window.location.href = "'.$file.'";</script>';
		}
	}
}else{
	echo '<script>window.location.href = "'.$file.'";</script>';
}

function getIP(){
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	  
	return $ipaddress;
}

?>