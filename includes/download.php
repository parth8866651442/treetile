<?php ob_start();
	include_once('../db.php');
	require_once('../'.admin_folder.'/function.php');
	$obj_fun = new functions();
?>
<?php
	$file = base64_decode($_GET['file']);
	$sql ="UPDATE `catalogue` SET counter = counter+1 WHERE pdf = '".basename($file)."'";
	$update = $obj_fun->update_record($sql);
	
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	
	if($ext == 'pdf')
	{
		download_file($file);
	}
	else
	{
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
            $link = "https"; 
        else
            $link = "http"; 
        
        $link .= "://"; 
        
        $link .= $_SERVER['HTTP_HOST']; 
        
        echo '<script>window.location.href = "'.$link.'";</script>';
	}

	function download_file( $fullPath )
	{

	  if( headers_sent() )
		die('Headers Sent');

	  if(ini_get('zlib.output_compression'))
		ini_set('zlib.output_compression', 'Off');

	  if( file_exists($fullPath) )
	  {
		$fsize = filesize($fullPath);
		$path_parts = pathinfo($fullPath);
		$ext = strtolower($path_parts["extension"]);

		switch ($ext) {
		  case "pdf": $ctype="application/pdf"; break;
		}
	
		header("Pragma: public"); // required
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false); // required for certain browsers
		header("Content-Type: $ctype");
		header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" );
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".$fsize);
		ob_clean();
		flush();
		readfile( $fullPath );
	
	  }
	  else
	  {
		die('File Not Found');
	  }
	}
?>