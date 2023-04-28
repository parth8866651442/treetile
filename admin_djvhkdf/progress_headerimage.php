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


$errors=0;
$newwidth= headerimage_th_width;
//$image = $obj_fun->img_resize($_FILES['image']['tmp_name'], 460, '../uploads/catalogue/', $_FILES['image']['name']);
if (is_uploaded_file($_FILES['image']['tmp_name'])) 
{
	$rand = rand(5, 15);
	$filename = stripslashes($_FILES['image']['name']);
	$i = strrpos($filename,".");
	$l = strlen($filename) - $i;
	$extension = substr($filename,$i+1,$l);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg")) 
	{
		echo "<p>Unknown Image extension.</p>";
		$errors=1;
	}
	else
	{
		
	
		$thumbDir = '../uploads/headerimage';

		// Create target dir
		if (!file_exists($thumbDir)) {
			@mkdir($thumbDir);
		}
		
		$thumb_width= headerimage_th_width; // Fix the width of the thumb nail images
		$thumb_height= headerimage_th_height; // Fix the height of the thumb nail imaage
		
		$fileName = $rand.'_'.$_FILES["image"]["name"];
		$tsrc=$thumbDir . DIRECTORY_SEPARATOR . $fileName;; // Path where thumb nail image will be stored
		//echo $tsrc;
		
		$size=getimagesize($_FILES["image"]["tmp_name"]);
		$width=$size[0]; // Original picture width is stored
		$height=$size[1]; // Original picture height is stored
		
		$original_aspect = $width / $height;
		$thumb_aspect = $thumb_width / $thumb_height;
		 
		if ( $original_aspect >= $thumb_aspect )
		{
		// If image is wider than thumbnail (in aspect ratio sense)
		$new_height = $thumb_height;
		$new_width = $width / ($height / $thumb_height);
		}
		else
		{
		// If the thumbnail is wider than the image
		$new_width = $thumb_width;
		$new_height = $height / ($width / $thumb_width);
		}
		
		$newimage=imagecreatetruecolor($thumb_width,$thumb_height);
		
		if($_FILES['image']['type']=="image/jpeg" || $_FILES['image']['type']=="image/jpg"){
			$image = imagecreatefromjpeg($_FILES["image"]["tmp_name"]);
			
			imageCopyResized($newimage,$image,(0 - ($new_width - $thumb_width) / 2),(0 - ($new_height - $thumb_height) / 2),0,0,$thumb_width,$new_height,$width,$height);
			ImageJpeg($newimage,$tsrc);
		}
		/*if($_FILES['image']['type']=="image/png"){
			$image = imagecreatefrompng($_FILES["image"]["tmp_name"]);
			
			imageCopyResized($newimage,$image,(0 - ($new_width - $thumb_width) / 2),(0 - ($new_height - $thumb_height) / 2),0,0,$thumb_width,$new_height,$width,$height);
			ImagePng($newimage,$tsrc);
		}*/
			chmod("$tsrc",0777);
	}
		
}

 if($errors == 0)
 {
	$obj_fun -> insertHeaderImage($_POST['id'],$rand.'_'.$_FILES['image']['name'],'product_size');
	header('location:header_image.php');
	
 }
 else
 {
	echo 'Date Insert Error';
 }
?>