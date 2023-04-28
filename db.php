<?php
error_reporting(0);
define('host','localhost');
define('user','treetile_treeuser');
define('password','OK*8(*xuyG8P');
define('database','treetile_treedb'); 
$con = mysqli_connect(host,user,password,database) or die('Could not connect: ' . mysqli_connect_error());
define('admin_folder','admin_djvhkdf');

require_once(admin_folder.'/function.php');
$obj_fun = new functions();


define('SITEURL', 'https://treetile.in/');

define('company', $obj_fun->getMetaData('company'));
define('title', $obj_fun->getMetaData('title'));
define('web_link',$obj_fun->getMetaData('web_link'));  // For Web Mail Link 
define('cmail',$obj_fun->getMetaData('email'));  // Client Mail id 
define('career_email',$obj_fun->getMetaData('email'));  // Career Client Mail id 
define('sms_statue', $obj_fun->getMetaData('sms_statue'));
define('sms_mobileno', $obj_fun->getMetaData('sms_mobileno'));
define('sms_reply_mo_no', $obj_fun->getMetaData('sms_mobileno'));
define('sms_reply_statue', $obj_fun->getMetaData('sms_replay'));
define('page_limit_search',$obj_fun->getMetaData('page_limit_for_search')); 	   		// For Search
define('page_limit_gallery',$obj_fun->getMetaData('page_limit_for_gallery')); 	   	// For Gallery
define('page_limit_level_1',$obj_fun->getMetaData('page_limit_for_product_direct_design'));       	//For Direct Design
define('page_limit_level_2',$obj_fun->getMetaData('page_limit_for_product_design_series_or_series_with_description'));      //For Design with series or Series with Description
define('page_limit_level_3',$obj_fun->getMetaData('page_limit_for_product_series_with_no'));       //For Design with series no
define('page_limit_concept',$obj_fun->getMetaData('page_limit_for_concept'));       //For Concept

?>