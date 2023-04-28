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

function randomString($length = 6) 
{
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
}

$pdf='';
$errors=0;
$image = '';
$newwidth= catalogue_th_width;
$sql ='UPDATE gallery SET  menu ="'.$_POST['menu'].'",size ="'.$_POST['size'].'",description ="'.$_POST['description'].'",url ="'.$_POST['url'].'",';

	
if (!empty($_FILES['image']) && $_FILES['image']['name'] !='' && is_uploaded_file($_FILES['image']['tmp_name'])) 
{
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
		
	
		$thumbDir = '../uploads/slider';

		// Create target dir
		if (!file_exists($thumbDir)) {
			@mkdir($thumbDir);
		}
		
		$thumb_width= slider_big_width; // Fix the width of the thumb nail images
		$thumb_height= slider_big_height; // Fix the height of the thumb nail imaage
		
		$path_parts = pathinfo($_FILES['image']['name']);
		$fileExtension = $path_parts['extension'];
		$fileName = randomString(6).'.'.$fileExtension;
		
		$imgpath = $fileName;
		
		$tsrc=$thumbDir . DIRECTORY_SEPARATOR . $imgpath; // Path where thumb nail image will be stored
	
		
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
			$thumbsrc=$thumbDir . DIRECTORY_SEPARATOR .'thumbnails/'. $imgpath; // Path where thumb nail image will be stored
			ImageJpeg($newimage,$thumbsrc);
		}
		
			chmod("$tsrc",0777);
		
			//if(file_exists('../'.$_POST['old_image']))
				unlink('../'.$_POST['old_image']);
				
			$string = '../'.$_POST['old_image'];
			$exp = explode('/',$string);
			$thumbdelete= $exp[0].'/'.$exp[1].'/thumbnails/'.$exp[2];
			unlink($thumbdelete);
									
			$pi = 'uploads/slider/';
			$sql .='image = "'.$pi.$fileName.'", ';
	}
		
}
$sql = rtrim($sql, ", ");
$sql .= " where id = ".$_POST['id'];

$obj_fun->update_records($sql);
header('location:slider.php');
?>