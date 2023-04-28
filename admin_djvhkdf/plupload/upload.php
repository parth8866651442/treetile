<?php
/**
 * upload.php
 *
 * Copyright 2013, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

#!! IMPORTANT: 
#!! this file is just an example, it doesn't incorporate any security checks and 
#!! is not recommended to be used in production environment as it is. Be sure to 
#!! revise it and customize to your needs.


// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once('../function.php');

$obj_fun = new functions();
/* 
// Support CORS
header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	exit; // finish preflight CORS requests here
}
*/

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
if(isset($_GET['folder']))
	$path = $_GET['folder'];
else
	$path = 'uploads';

//$targetDir = $path;
$targetDir = '../../uploads/'.$path;

$cleanupTargetDir = false; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds

// Create target dir
if (!file_exists($targetDir)) {
	@mkdir($targetDir , 0777, true);
}
// Get a file name
if (isset($_REQUEST["name"])) {
	$fileName = $_REQUEST["name"];
} elseif (!empty($_FILES)) {
	$fileName = $_FILES["file"]["name"];
} else {
	$fileName = uniqid("file_");
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;




// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


// Remove old temp files	
if ($cleanupTargetDir) {
	if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	}

	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

		// If temp file is current file proceed to the next
		if ($tmpfilePath == "{$filePath}.part") {
			continue;
		}

		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
			@unlink($tmpfilePath);
		}
	}
	closedir($dir);
}	


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
	die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

if (!empty($_FILES)) {
	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
	}

	// Read binary input stream and append it to temp file
	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
} else {	
	if (!$in = @fopen("php://input", "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
}

while ($buff = fread($in, 4096)) {
	fwrite($out, $buff);
}

@fclose($out);
@fclose($in);


	$thumbDir = $targetDir . '/thumbnails';
	
	// Create target dir
	if (!file_exists($thumbDir)) {
		@mkdir($thumbDir);
	}
	
/*******************************************************************************/
//For Thumb
if(isset($_GET['thumb']) && $_GET['thumb'] =='crop' && isset($_GET['tw']) && $_GET['tw'] !='' && isset($_GET['th']) && $_GET['th'] !='')
{
	
	
	$thumb_width=$_GET['tw']; // Fix the width of the thumb nail images
	$thumb_height=$_GET['th']; // Fix the height of the thumb nail imaage
	
	$tsrc=$thumbDir . DIRECTORY_SEPARATOR . $fileName;; // Path where thumb nail image will be stored
	//echo $tsrc;
	
	$size=getimagesize($_FILES["file"]["tmp_name"]);
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
	
	if($_FILES['file']['type']=="image/jpeg" || $_FILES['file']['type']=="image/jpg"){
		$image = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
		
		imageCopyResized($newimage,$image,(0 - ($new_width - $thumb_width) / 2),(0 - ($new_height - $thumb_height) / 2),0,0,$thumb_width,$new_height,$width,$height);
		ImageJpeg($newimage,$tsrc);
	}
	/*if($_FILES['file']['type']=="image/png"){
		$image = imagecreatefrompng($_FILES["file"]["tmp_name"]);
		
		imageCopyResized($newimage,$image,(0 - ($new_width - $thumb_width) / 2),(0 - ($new_height - $thumb_height) / 2),0,0,$thumb_width,$new_height,$width,$height);
		ImagePng($newimage,$tsrc);
	}*/
		chmod("$tsrc",0777);
	
}
else
{
	$img_thumb = $obj_fun->img_resize($_FILES["file"]["tmp_name"], $_GET['tw'], $thumbDir, $fileName, $_GET['th']);
	/*if($_FILES['file']['type']=="image/jpeg" || $_FILES['file']['type']=="image/jpg"){
		$image = $_FILES["file"]["tmp_name"];
		$src = imagecreatefromjpeg($image);
	}
	//if($_FILES['file']['type']=="image/png"){
//		$image = $_FILES["file"]["tmp_name"];
//		$src = imagecreatefrompng($image);
//	}
	$size=getimagesize($_FILES["file"]["tmp_name"]);
	$width=$size[0]; // Original picture width is stored
	$height=$size[1]; // Original picture height is stored
	
	
	$ratio1= ($width/$_GET['tw']);
	$ratio2=($height/$_GET['th']);
	if($ratio1>$ratio2) {
		$newwidth=$_GET['tw'];
		$newheight=$height/$ratio1;
	}
	else {
		$newheight=$_GET['th'];
		$newwidth=$width/$ratio2;
	}
	$tmp=ImageCreateTrueColor($newwidth,$newheight);
	
	
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	echo $src = $thumbDir .'/'. $fileName;
	imagejpeg($tmp,$src,100);
	imagedestroy($src);
	imagedestroy($tmp);
	
	chmod("$tsrc",0777);*/
	
}
/*******************************************************************************/

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off 
	rename("{$filePath}.part", $filePath);
}

// Return Success JSON-RPC response
die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
