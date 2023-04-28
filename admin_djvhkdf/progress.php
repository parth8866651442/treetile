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
$image = '';
$errors=0;
$newwidth= catalogue_th_width;

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



if (is_uploaded_file($_FILES['image']['tmp_name'])) 
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
		
	
		$thumbDir = '../uploads/catalogue';

		// Create target dir
		if (!file_exists($thumbDir)) {
			@mkdir($thumbDir);
		}
		
		$thumb_width= catalogue_th_width; // Fix the width of the thumb nail images
		$thumb_height= catalogue_th_height; // Fix the height of the thumb nail imaage
		

		
		$path_parts = pathinfo($_FILES['image']['name']);
		$fileExtension = $path_parts['extension'];
		$fileName = randomString(6).'.'.$fileExtension;

		
		$tsrc=$thumbDir . DIRECTORY_SEPARATOR . $fileName; // Path where thumb nail image will be stored
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
	
		chmod("$tsrc",0777);
	}
		
}

if (is_uploaded_file($_FILES['pdf']['tmp_name'])) 
{
	if ($_FILES['pdf']['type'] != "application/pdf") 
	{
		echo "<p>Class notes must be uploaded in PDF format.</p>";
	} 
	else 
	{
		$pdf = str_replace(' ','_',$_FILES['pdf']['name']);
		$pdf = rand(1111,9999).'_'.$pdf;
		$mpdf = '../uploads/catalogue/'.$pdf;
		move_uploaded_file($_FILES['pdf']['tmp_name'],$mpdf); 
	}
} 

 if($errors == 0)
 {
	$obj_fun -> insertCatalogue($_POST['name'],$_POST['menu'],$_POST['size'],$fileName,$pdf,$_POST['status']); 
	header('location:catalogue.php');
 }
 else
 {
	echo 'Date Insert Error';
 }
?>