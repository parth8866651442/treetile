<?php session_start();
include_once('config.php');
require_once('function.php');
 date_default_timezone_set('Asia/Kolkata');
$obj_fun = new functions();
if(isset($_SESSION['status'])){header('location:index.php');?><script type="text/javascript">window.location = "index.php";</script><?php }?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Admin | Login</title>
    <noscript>
        <meta http-equiv="refresh" content="0; url=no-js.html" />
    </noscript>
	<meta name="description" content="">
	<meta name="author" content="Antique Touch | www.antiquetouch.in">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Style -->
	<link rel="stylesheet" href="css/organon-green.css">
	<!-- jQuery jGrowl Styles -->
	<link rel='stylesheet' type='text/css' href='css/plugins/jquery.jgrowl.css'>
	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- JS Libs -->
	<script src="../../ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/libs/jquery.js"><\/script>')</script>
	<script src="js/libs/modernizr.js"></script>
	<script src="js/libs/selectivizr.js"></script>
	<!-- jQuery jGrowl -->
	<script type="text/javascript" src="js/plugins/jGrowl/jquery.jgrowl.js"></script>
	<script>
		$(document).ready(function(){

			var w_height = $(window).height();
			w_height = ((w_height - 50)/2);
			document.admin_login.style.marginTop = w_height+'px';
			document.admin_login.style.height = "30px";
			document.admin_login.style.width = "300px";

		});
		function success(msg){
			$.jGrowl("", {
				header: msg,
				sticky: true,
				theme: 'success'
			});
		}
		function danger(msg){
			$.jGrowl("", {
				header: msg,
				sticky: true,
				theme: 'danger'
			});
		}
		
		function validate () {
			var valid = true;
			if ( document.admin_login.text.value == "" ) {
				if (valid)
					document.admin_login.text.focus();
				document.admin_login.text.style.border="solid 1px #DD0000";
				document.admin_login.text.style.boxShadow="0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 10px rgba(210, 0, 0, 0.75)";
				danger("You need to fill in your user name !")
				valid = false;
			}
			if ( document.admin_login.password.value == "" ) {
				if (valid)
					document.admin_login.password.focus();
				document.admin_login.password.style.border="solid 1px #DD0000";
				document.admin_login.password.style.boxShadow="0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 10px rgba(210, 0, 0, 0.75)";
				danger("You need to fill in your password !")
				valid = false;
			}
			return valid;
		}
	</script>
</head>
<body class="fixed-layout" style="background-image:url(img/assets/bg_login.jpg)">
<?php
	if(isset($_REQUEST["login"]) && $_REQUEST["login"] =="Log in"){
	    
	    $text = mysqli_real_escape_string($con, $_REQUEST["text"]);
	    $password = mysqli_real_escape_string($con, $_REQUEST["password"]);
		

		
	    $num_rows = $obj_fun->login($text,$password);
 
		
	    if($num_rows>0){
			$_SESSION['status']="logged_in";
			$_SESSION['email']=$num_rows['email'];
			$_SESSION['type']=$num_rows['type'];
			//for accesslog
			$_SESSION['id']=$num_rows['id'];
			
			$inser_arg = array(
				'user_id' 	 => $num_rows['id'], 
				'login'		 => date("Y-m-d h:i:s"),
				'ipaddress'  => $obj_fun->get_client_ip_server(),
				"access"     => date("Y-m-d h:i:s"),
				"access_url" => 'index.php',
			);
			$obj_fun->insertRecords('accesslog',$inser_arg);
			
			echo '<script type="text/javascript">window.location = "index.php"</script>';
		}
		else
			echo '<script>danger("User name or password is incorrect !")</script>';
	}
?>
	<center>
		<form class="form-inline well" name="admin_login" id="admin_login" onSubmit="return validate()" method="post">
        	<input name="text" type="text" class="input-small" placeholder="User Name">
          	<input name="password" type="password" class="input-small" placeholder="Password">
          	<?php if(login_otp =='1') {  ?>
           		<input class="btn" type="button" name="login1" value="Log in" id="login1">
            <?php } else { ?>
          		<input class="btn disabled" type="submit" name="login" value="Log in">
           <?php } ?>
		</form><br/>
        <button class="btn btn-success" id="hideshow">Forgot Password</button>

         <section class="tab-content" id="otp_div" style="max-width:300px;margin-top:50px;border:solid 1px rgba(251,251,251,0.5);padding:20px;display:none;">
        	<p class="text text-muted">Please checked google captcha.So,we send OTP in this mobile no.</p>
			<div class="tab-pane active" id="horizontal">
                <form class="form-horizontal" method="post" action="#">
                    <fieldset>
                    	<div class="control-group">
                       		<input type="text" id="phone_no" placeholder="enter verification" value="<?php echo '+91'.sms_mobileno ?>" disabled required>
                        </div>
                        <div class="control-group verify_div" style="display:none">
                       		<input type="text" id="verificationcode" placeholder="enter verification" required>
                        </div>
                      	<div id="recaptcha-container" ></div>
                        <div class="control-group verify_div" style="display:none">
                        	 <button class="btn btn-sm btn-primary" type="button"  name="otp_verify" value="otp_verify" onclick="myFunction()">Verify</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </section>

    <section class="tab-content" id="content" style="max-width:300px;margin-top:50px;border:solid 1px rgba(251,251,251,0.5);padding:20px;display:none;">
							
								
                <div class="tab-pane active" id="horizontal">
                
                    <form class="form-horizontal" method="post" action="#">
                        <fieldset>
                                                                    
                            
                            <div class="control-group">
                                <label class="control-label" for="optionsRadios">Get Password Via :</label>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="password" id="Email" value="Email" checked>
                                        EMAIL                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="password" id="SMS" value="SMS">
                                        SMS
                                    </label>
                                    
                              </div>
                          </div>
                            <div class="control-group">
                           	  <input type="email" name="value" id="value" placeholder="Please Enter Email" required>
                            </div>
                          <div class="form-actions" style="padding-left:0px !important;">
                                <button class="btn btn-alt btn-large btn-primary" type="submit"  name="submit" value="Send Password">Send Password</button>
                            </div>
                            </fieldset></form></div></section></center>

<p style="position: fixed; bottom: 15px; right: 5%;">Developed by - <a target="_blank" href="https://antiquetouch.in">Antique Touch</a></p>

<!------------------------------Firebase otp js----------------------------->
<input type="hidden" id="loginUserId">
<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
<script type="text/javascript" src="js/firebase_otp.js"></script>
<!-------------------------------------------------------------------------->

<?php
function obfuscate_email($email)
{
    $em   = explode("@",$email);
	$name = implode(array_slice($em, 0, count($em)-1), '@');
	$len  = floor(strlen($name)/2);
	return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}
function maskPhoneNumber($number){
    
    $mask_number =  str_repeat("*", strlen($number)-5) . substr($number, - 3);
    $first_no  = substr($number,0,2);
    return $first_no.$mask_number;
}
?>

<?php 
if(isset($_POST['submit']) && $_POST['submit'] == 'Send Password')
{
	
	$useradmin = $obj_fun->getUser('admin');
	$pw = base64_decode($useradmin['password']);
	$user = $useradmin['username'];
	$emails = $useradmin['email'];
	$rpw = $_POST['password'];
	
	$permission = 0;
	if(isset($_POST['password']) and $_POST['password'] == "Email" and isset($_POST['value'])){
		if($_POST['value'] == $emails){
			$permission = 1;
		}
	}
	
	if(isset($_POST['password']) and $_POST['password'] == "SMS" and isset($_POST['value'])){
		if($_POST['value'] == sms_mobileno){
			$permission = 1;
		}
	}

	if($permission == 1){
		if($rpw == 'Email')
		{
			$to = $emails;
			$subject = 'Forgot Admin Password';
			$msg= 'Your '.company.' Admin Panel Password is : '.$pw;
			$resu = mail($emails,$subject,$msg);
			if($resu)
			{
				$to = obfuscate_email($to);
				echo '<script>alert("Your Password Send In '. $to .' Email id");window.location.href = "login.php";</script>';
			}
		}
		else
		{
			$sms = $obj_fun->sendForgotSMS(sms_mobileno,$pw);
			if($sms)
			{
				$mno = maskPhoneNumber(sms_mobileno);
				echo '<script>alert("Your Password Send In Your Register Mobile no is : '.$mno.'");window.location.href = "login.php";</script>';
			}
		
		}
	}else{
		if(isset($_POST['password']) and $_POST['password'] == "Email"){
			echo '<script>danger("Email does not match...!")</script>';
		}
		if(isset($_POST['password']) and $_POST['password'] == "SMS"){
			echo '<script>danger("Mobile-no does not match...!")</script>';
		}
	}
}
?>

<script>
$(document).ready(function(){
	 $('#content').hide();
    $('#hideshow').click(function(){
         $('#content').show();
    });
	
	$('input[type=radio]').change(function() {
		$('#value').val('');
		var id = $('input[name=password]:checked').attr('id');
		if(id == 'SMS'){
			$('#value').prop('type','text');
			$('#value').attr('minlength','10');
			$('#value').attr('maxlength','10');
			$('#value').attr('placeholder','Please Enter Mobile-No');
		}
		if(id == 'Email'){
			$('#value').prop('type','email');
			$('#value').attr('placeholder','Please Enter Email');
			$('#value').attr('minlength','');
			$('#value').attr('maxlength','');
		}
	});
	
	$('#value').keypress(function(evt){
		var id = $('input[name=password]:checked').attr('id');
		if(id == 'SMS'){
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57)){
				$('#value').val('');
			}
			return true;	

		}
	});
	
});
</script>
<script src="js/script.js"></script>

</body>
</html>