<?php
	 session_start();
	 date_default_timezone_set('Asia/Kolkata');
	 require_once("config.php");
	 require_once("function.php");
	 $obj_fun = new functions();
		
	 $accesslog = $obj_fun->getRecords('SELECT * FROM accesslog where user_id = '.$_SESSION['id'].' and  logout = "0000-00-00 00:00:00" ORDER BY id desc limit 1');	
	
	 if(count($accesslog) >= 1){
		$update_data = array(
            		        "access"        => date("Y-m-d h:i:s"),
            		        "access_url"    => $_REQUEST['url'],
            		        "ipaddress"     => $obj_fun->get_client_ip_server()
            		    );
						
        $res_accesslog = $obj_fun->updateRecord('accesslog',$update_data,array('id' =>  $accesslog[0]['id']));
		
		echo $res_accesslog;
	 }	
?>