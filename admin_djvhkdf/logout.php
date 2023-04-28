<?php session_start();
	  date_default_timezone_set('Asia/Kolkata');
	  require_once("config.php");
	  require_once("function.php");
	  
	  
if(isset($_SESSION['status']) || isset($_SESSION['email']) || isset($_SESSION['type']) || isset($_SESSION['id'])){
	
	//---> start insert accesslog (logout)
			
		 $accesslog = $obj_fun->getRecords('SELECT * FROM accesslog where user_id = '.$_SESSION['id'].' and  logout = "0000-00-00 00:00:00" ORDER BY id desc limit 1');	

	 if(count($accesslog) >= 1){
		$update_data = array(
            		        "logout"     => date("Y-m-d h:i:s")
            		    );
						
        $res_accesslog = $obj_fun->updateRecord('accesslog',$update_data,array('id' =>  $accesslog[0]['id']));
	 }
	//<--- finish insert accesslog (logout)
	
	unset($_SESSION['status']);
	unset($_SESSION['email']);
	unset($_SESSION['type']);
	unset($_SESSION['id']);
}
?>
<script type="text/javascript">window.location = "index.php";</script>