<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Forgot Password</title>
</head>

<body>
<?php 
include_once('config.php');
require_once('function.php');
$obj_fun = new functions();
	$useradmin = $obj_fun->getUser('admin');
	$pw = base64_decode($useradmin['password']);
	$email = $useradmin['email'];
	echo '<script>alert("Your Password Send In This Email id : '.$email.'");</script>';
?>
</body>
</html>