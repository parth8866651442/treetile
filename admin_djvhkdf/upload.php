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

if(isset($_POST) && isset($_POST['id']) && $_POST['id'] != '')
{
	//echo $_POST['page'];
	if(isset($_POST['page']) && $_POST['page'] =='design')
	{
		$p_id = $_POST['id'];
		$size = $_POST['size'];
		$file = $_FILES['product_file_'.$p_id];
		$path = $_POST['img_path'];
		$img = $_POST['old_img_'.$p_id];
		
		if(isset($img)&& $img != '')
		{
			unlink('../uploads/'.$path.'/'.$img);
			unlink('../uploads/'.$path.'/thumbnails/'.$img);
		}
		
		/*if($file['type']=="image/jpeg" || $file['type']=="image/jpg"){
			$image = $file["tmp_name"];
			$src = imagecreatefromjpeg($image);
		}*/
		/*if($file['type']=="image/png"){
			$image = $file["tmp_name"];
			$src = imagecreatefrompng($image);
		}*/
		/*$size=getimagesize($file["tmp_name"]);
		$width=$size[0]; // Original picture width is stored
		$height=$size[1]; */// Original picture height is stored
		
		/*if($width/$height > 1)
		{
			$newwidth=  th_width;
			$newheight=($height/$width)*$newwidth;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
		}
		else
		{
			$newheight= th_height;
			$newwidth=($height/$width)*$newheight;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
		}*/
		
		/*$ratio1= ($width/th_width);
		$ratio2=($height/th_height);
		if($ratio1>$ratio2) {
			$newwidth=th_width;
			$newheight=$height/$ratio1;
		}
		else {
			$newheight=th_height;;
			$newwidth=$width/$ratio2;
		}
		$tmp=ImageCreateTrueColor($newwidth,$newheight);
	
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		echo $src = '../uploads/'.$path.'/thumbnails/'. $file['name'];
		imagejpeg($tmp,$src,100);
		imagedestroy($src);
		imagedestroy($tmp);*/
		
		//$img_thumb = $obj_fun->img_resize($tmp_name, th_width, $thumbDir, $file_name, th_height);
		$img_thumb = $obj_fun->img_resize($file['tmp_name'], product_th_width, '../uploads/'.$_POST['img_path'].'/thumbnails/', $file['name'], product_th_height);
		$image = $obj_fun->img_resize($file['tmp_name'], product_big_width, '../uploads/'.$_POST['img_path'].'/', $file['name'], product_big_height);
		if($image>0)
		{
			$obj_fun -> updateProductImage($file['name'], $p_id);
			
			header('location:design.php?size='.$_POST['size']);
		}
	}
	else
	{
		$series='';
		$p_id = $_POST['id'];
		$size = $_POST['size'];
		$series = $_POST['series'];
		$file = $_FILES['product_file_'.$p_id];
		$path = $_POST['img_path'];
		$img = $_POST['old_img_'.$p_id];
		if(isset($img)&& $img != '')
		{
			unlink('../uploads/'.$path.'/'.$img);
			unlink('../uploads/'.$path.'/thumbnails/'.$img);
		}
			
		$image = $obj_fun->img_resize($file['tmp_name'], product_big_width, '../uploads/'.$_POST['img_path'].'/', $file['name'], product_big_height);
		$image_thumb = $obj_fun->img_resize($file['tmp_name'], product_th_width, '../uploads/'.$_POST['img_path'].'/thumbnails/', $file['name'],product_th_height);
		if($image>0 && $image_thumb>0)
		{
			$obj_fun -> updateProductImage($file['name'], $p_id);
			
			header('location:'.$_POST['page'].'.php?size='.$size.'&series='.$series);
		}
	}
}
?>