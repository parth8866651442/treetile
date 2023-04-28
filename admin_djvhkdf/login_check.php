<?php session_start();
	include_once('config.php');
	require_once('function.php');
	$obj_fun = new functions();

    if($_POST['action'] == 'login_user')
    {
    	$userid = $_POST['userid'];

    	$sql = "select * from admin where id='".$userid."'";
		$res= mysqli_query($con,$sql);
		$row = mysqli_fetch_array($res); 

		$_SESSION['status']="logged_in";
		$_SESSION['email']=$row['email'];
		$_SESSION['type']=$row['type'];
		//for accesslog
		$_SESSION['id']=$row['id'];
		
		$inser_arg = array(
			'user_id' 	 => $userid, 
			'login'		 => date("Y-m-d h:i:s"),
			'ipaddress'  => $obj_fun->get_client_ip_server(),
			"access"     => date("Y-m-d h:i:s"),
			"access_url" => 'index.php',
		);

		$obj_fun->insertRecords('accesslog',$inser_arg);
	}
    else
    {
		$text = mysqli_real_escape_string($con, $_POST["text"]);
		$password = mysqli_real_escape_string($con, $_POST["password"]);
		$phoneNo  = '';
		
		$num_rows = $obj_fun->login($text,$password);
	    header('Content-Type:application/json');
		if($num_rows>0){
			$phoneNo = $obj_fun->getMetaData('sms_mobileno');
			$obj =  array("status"=>"success","phoneno"=>$phoneNo,'id'=>$num_rows['id']);

			echo json_encode($obj);
		}
		else
		{
			$obj =  array("status"=>"false","phoneno"=>$phoneNo);

		 	echo json_encode($obj);
		}
	}
?>