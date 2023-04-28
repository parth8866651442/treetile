<?php ob_start();
 date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<?php 
	require_once('head.php');
	if($obj_fun->getMetaData('contact') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
	
	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
		$remove = $obj_fun->deleteRecordById("accesslog",$id);
		if($remove){
				
		}
		header('location:accesslog.php');	
	}
?>
<style>
.costum_filter {
    width: 16%;
    margin-bottom: 15px;
    padding-right: 0px;
    display: inline-block;
}

.costum_filter label {
    display: block;
}

.costum_filter select {
    /*width: 50%;*/
}
</style>
</head>
<body class="fixed-layout">
<div class="container">
  <div class="sidebar">
    <?php include_once('sidebar.php');?>
    <?php $notification = $obj_fun->updateFormNotification('contact'); ?>
  </div>
  <div class="content-block" role="main">
    <ul class="breadcrumb">
      <li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
      <li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
      <li class="active">View Accesslog</li>
    </ul>
    <div class="row-fluid">
      <article class="span12 data-block">
        <div class="data-container">
          <header>
            <h2>View Accesslog</h2>
          </header>
          <section class="tab-content">
            <div class="tab-pane active " id="newUser">
              <?php $user_filter_con = '';
			  $user = ''; $time = '';
			  if(isset($_POST['filter'])){
				  
				  $user = $_POST['user'];
				  $time = $_POST['time'];
				  
				  $user_filter_con='';
			  }?>
              <form class="form-inline well" action="#" method="post">
              <div class="costum_filter">
                <label class="control-label" for="appendedInput">User</label>
                <select id="user" name="user" class="span12"> 
                  <option value="">All</option>
                  <?php 
                    $check = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" .  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
                    if(strpos($check,'/web/') !== false){
                		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'].'/web';
                	}
                    $user_data = include_once "accesslog_api.php";
                    // print_r($user_data);die;
				    // 	$sql = "select * from admin ";
				    // 	$user_data = $obj_fun->getRecords($sql);
					if(isset($user_data) && !empty($user_data)){
						foreach($user_data as $ud){
						    if($ud->type == "master-admin"){
						        $madmin = $ud->id;   
						    }else{
						       $admin = $ud->id; 
						    }
				  ?>                  
		                  <option value="<?php echo $ud->id;?>" <?php if($user == $ud->id){ echo "SELECTED"; } ?>><?php echo $ud->type;?></option>
                  		<?php }?>
                  <?php }?>
                </select>
              </div>
              <div class="costum_filter">
                <label class="control-label" for="appendedInput">Time</label>
                <select id="time" name="time" class="span12">
                  <option value="">All</option>
                  <option value="1" <?php if($time == 1){ echo "SELECTED"; } ?>>Today</option>
                  <option value="2" <?php if($time == 2){ echo "SELECTED"; } ?>>Yesterday</option>
                  <option value="3" <?php if($time == 3){ echo "SELECTED"; } ?>>Last Week</option>
                  <option value="4" <?php if($time == 4){ echo "SELECTED"; } ?>>Last Month</option>
                </select>
              </div>
                <button class="btn btn-alt btn-primary" type="submit" name="filter">Filter</button>
                <button class="btn btn-alt btn-danger" type="submit" onClick="reset_function()">Reset</button>
              </form>
            </div>
          </section>
          <section class="tab-content">
            <div class="tab-pane active" id="horizontal">
              <?php if(isset($_POST) && isset($_POST['accesslog_delete']) && $_POST['accesslog_delete'] !='')
								{
									
									foreach($_POST['iq_delete'] as $id)
									{
										$obj_fun->deleteRecordById('accesslog',$id);
									}
									header('location:accesslog.php');	
								}
								?>
              <form method="post" action="#">
                <input type="submit" name="accesslog_delete" id="accesslog_delete" value="Delete" class="btn btn-alt btn-primary" style="position: absolute; right: 290px;" onClick="return confirm('Are You Sure You Want To Delete?');"/>
                <!-- <input type="submit" name="accesslog_delete" id="accesslog_delete" value="ClearLog" class="btn btn-alt btn-danger" style="position: absolute; right: 375px;" onClick="return confirm('Are You Sure You Want To Delete?');"/> -->
                <table class="datatable table table-striped table-bordered viewblogclass" id="example">
                  <thead>
                    <tr>
                      <th style="width:10%"><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
                      <th style="width:10%">No.</th>
                      <th style="width:10%">User</th>
                      <th style="width:10%">Login</th>
                      <th style="width:10%">Last Access</th>
                      <th style="width:10%">Last Access-page</th>
                      <th style="width:25%">Logout</th>
                      <th style="width:10%">Ip Address</th>
                      <th style="width:10%">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
							$where = ' where 1=1 ';
							if($user != ''){
								$where .= ' and a.user_id ='.$user;								
							}
							if($time != ''){
								 if($time == 1){
									$where .= " and ((a.login BETWEEN '".date('Y-m-d 00:00:00')."' AND '".date('Y-m-d H:i:s')."') or ( a.access BETWEEN '".date('Y-m-d 00:00:00')."' AND '".date('Y-m-d H:i:s')."' ) or ( a.logout BETWEEN '".date('Y-m-d 00:00:00')."' AND '".date('Y-m-d H:i:s')."' )) ";
								}
								else if($time == 2){
									$where .= " and ((a.login BETWEEN '".date('Y-m-d 00:00:00',strtotime('-1 days'))."' AND '".date('Y-m-d 23:59:59',strtotime('-1 days'))."') or ( a.access BETWEEN '".date('Y-m-d 00:00:00',strtotime('-1 days'))."' AND '".date('Y-m-d 23:59:59',strtotime('-1 days'))."' ) or ( a.logout BETWEEN '".date('Y-m-d 00:00:00',strtotime('-1 days'))."' AND '".date('Y-m-d 23:59:59',strtotime('-1 days'))."' )) ";
								}else if($time == 3){
									$where .= " and ((a.login BETWEEN '".date('Y-m-d 00:00:00',strtotime('-7 days'))."' AND '".date('Y-m-d H:i:s')."') or ( a.access BETWEEN '".date('Y-m-d 00:00:00',strtotime('-7 days'))."' AND '".date('Y-m-d H:i:s')."' ) or ( a.logout BETWEEN '".date('Y-m-d 00:00:00',strtotime('-7 days'))."' AND '".date('Y-m-d H:i:s')."' )) ";
								}else if($time == 4){
								   $where .= " and ((a.login BETWEEN '".date('Y-m-d 00:00:00',strtotime('-30 days'))."'AND '".date('Y-m-d H:i:s')."') or ( a.access BETWEEN '".date('Y-m-d 00:00:00',strtotime('-30 days'))."' AND '".date('Y-m-d H:i:s')."' ) or ( a.logout BETWEEN '".date('Y-m-d 00:00:00',strtotime('-30 days'))."' AND '".date('Y-m-d H:i:s')."' )) ";
								}
							}
							
							$sql = "select * from accesslog as a ".$where." order by id desc";
							$contact = $obj_fun->getRecords($sql);
							//echo "<pre>";print_r($contact);
							$i=1;
							if(isset($contact) && $contact !=''){
							$i = 1;
							$check = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" .  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
                            if(strpos($check,'/web/') !== false){
                        		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'].'/web';
                        	}
							foreach($contact as $c)
							{
							 //   $type = $c['user_id'];
							 //   $ut = include "accesslog_type.php";
						?>
                    <tr class="gradeX">
                      <td><input type="checkbox" value="<?php echo $c['id']; ?>" class="checkbox1" id="iq_delete[]" name="iq_delete[]"></td>
                      <td><?php echo $i; ?></td>
                      <?php 
                      if($c['user_id'] === $madmin){
                          $type = 'master-admin';
                      }else if($c['user_id'] === $admin){
                          $type = 'admin';
                      }
                      ?>
                      <td><?php echo $type; ?></td>
                      <td><?php echo $c['login']; ?></td>
                      <td><?php echo $c['access']; ?></td>
                      <td><?php echo $c['access_url']; ?></td>
                      <td><?php echo $c['logout'];  ?></td>
                      <td><?php echo $c['ipaddress'];  ?></td>
                      <td><a class="btn btn-alt btn-danger" href="accesslog.php?id=<?php echo $c['id']; ?>" onClick="return confirm('Are you sure want to delete?')">Delete</a></td>
                    </tr>
                    <?php $i++; } }
										
										?>
                  </tbody>
                </table>
              </form>
            </div>
          </section>
        </div>
      </article>
      <!-- /Data block --> 
    </div>
  </div>
</div>

<?php include_once('script.php');?>
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
   
});

function reset_function(){
	$('#user').val('');
	$('#time').val('');
}
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.dynamic-menu #accesslog').addClass('active');
});
</script>
</body>
</html>
