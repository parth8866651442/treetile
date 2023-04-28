<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]> <!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	if($obj_fun->getMetaData('analytics') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
?>
</head>
<?php 
if(isset($_GET['id']) && isset($_GET['action']) && $_GET['id']!='') 
{
    $arg['id'] = $_GET['id'];
	$addAnalytics = $obj_fun->getRecord('addAnalytics',$arg);
	
	$fileName = $addAnalytics['fileNameOfP12'];
	$id = $addAnalytics['id']; 
	$viewId = $addAnalytics['viewId']; 
	$gsServiceAccount = $addAnalytics['gsServiceAccount']; 
	$footerScript = $addAnalytics['footerScript'];
}
else
{
	$viewId = ''; 
	$gsServiceAccount = ''; 
	$footerScript = '';
	$fileName = "";
}
?>
<body class="fixed-layout">
	<div class="container">
		<div class="sidebar">
			<?php include_once('sidebar.php');?>
		</div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
				<li class="active">Add Analytics</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Add Analytics Details</h2>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
							<?php
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Save')
								{
								    move_uploaded_file($_FILES['p12']['tmp_name'], ''.$_FILES['p12']['name']);
								    $arg['fileNameOfP12'] = $_FILES['p12']['name'];
								    @extract($_POST);
									$arg['viewId'] = $viewId;
									$arg['gsServiceAccount'] = $gsServiceAccount;
									$arg['footerScript'] = base64_encode($footerScript);
									$a_ins =  $obj_fun->insertRecords('addanalytics', $arg);
									if(isset($a_ins)){
										echo '<script>success("Analytics Details insert successfully.")</script>';
										echo "<script>urlRefresh('addAnalytics.php', 3000);</script>";
									}
								}
								
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update')
								{
								    move_uploaded_file($_FILES['p12']['tmp_name'], ''.$_FILES['p12']['name']);
								    $arg['fileNameOfP12'] = $_FILES['p12']['name'];
								    if($arg['fileNameOfP12'] == ""){
								        $arg['fileNameOfP12'] = $fileName;
								    }
								    
									@extract($_POST);
									
									$arg['viewId'] = $viewId;
									$arg['gsServiceAccount'] = $gsServiceAccount;
									echo $arg['footerScript'] =  base64_encode($footerScript);
									
									$cond['id'] = $id;
									$a_update =  $obj_fun->updateRecord('addanalytics', $arg, $cond);
									if(isset($a_update)){
										echo '<script>success("Analytics Details Update successfully.")</script>';
										echo "<script>urlRefresh('addAnalytics.php', 3000);</script>";
									}
									
								}
							?>
								<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return news_validate();" action="#">
									<div class="control-group">
										<label class="control-label" for="input" style="width: 80px; text-align: left;">View Id :</label>
										<div class="controls">
											<input id="model_no" name="viewId" class="input-xxlarge" type="text" value="<?php echo $viewId; ?>" />
										</div>
									</div>
                                    
                                    <div class="control-group">
										<label class="control-label" for="input" style=" text-align: left;">Gs Service Account :</label>
										<div class="controls">
											<input  name="gsServiceAccount" class="input-xxlarge" type="text" value="<?php echo $gsServiceAccount; ?>" />
										</div>
									</div>
                                    
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">File Upload:</label>
										<?php if(isset($_GET['id']) && isset($_GET['action']) && $_GET['id']!=''){ ?>
											<div class="controls">
												<?php echo "You Have Uploaded '$fileName' File Previuos Time"; ?>
											</div>
										<?php } ?>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
													<span class="btn btn-alt btn-file">
														<span class="fileupload-new">Select .p12 file</span>
														<span class="fileupload-exists">Change</span>
														<input type="file" name="p12" id="p12">
													</span>
												</div>
											</div>
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Footer Script :</label>
										<div class="controls">
										    <p style="color: green;"><b>Warning:!</b>You Must Have Double Quotes in your code. Please change from here -> <a href="http://www.unit-conversion.info/texttools/replace-text/" target="_blank">link</a></p>
											<textarea rows="8" cols= "50" name="footerScript"><?php echo base64_decode($footerScript); ?></textarea>
										</div>
									</div>
									
									<div class="form-actions" style="padding: 15px 0px 0px;">
										<?php if( isset($_GET['action']) && $_GET['action'] == 'edit'){ ?>
											<input id="n_id" name="n_id" class="input-xxlarge" type="hidden" value="<?php echo $id; ?>" />
											<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Update" />
										<?php }else{ ?>
											<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Save" />
										<?php } ?>
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						<header>
							<h2>View Analytics Details</h2>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="horizontal">
								<?php if(isset($_POST) && isset($_POST['ad_delete']) && $_POST['ad_delete'] !='')
								{
									foreach($_POST['ad_delete'] as $id)
									{
										$obj_fun->deleteRecordById('addAnalytics',$id);
									}
									header('location:addAnalytics.php');	
								}
								?>
								<form method="post" action="#">
								<input type="submit" name="ad_delete" id="ad_delete" value="Delete" class="btn btn-alt btn-primary" style="position: absolute; right: 290px;" />
								<table class="datatable table table-striped table-bordered viewblogclass" id="example">
									<thead>
										<tr>
											<th style="width:2%">
												<input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left:-16px;top:16px;" />
											</th>
											<th style="width:10%">Id</th>
											<th style="width:10%">view Id</th>
                                            <th style="width:10%">Gs Service Account</th>
                                            <th style="width:10%">File Name</th>
											<th style="width:10%">View</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$sql = "select * from addanalytics";
										$AnalyticsDetils = $obj_fun->getRecords($sql);
										$i=1;
										if(isset($AnalyticsDetils) && $AnalyticsDetils !=''){
											foreach($AnalyticsDetils as $ad)
											{
											?>
											<tr class="gradeX">
												<td><input type="checkbox" value="<?php echo $ad['id']; ?>" class="checkbox1" id="ad_delete[]" name="ad_delete[]"></td>
												<td><?php echo $ad['id']; ?></td>
												<td><?php echo $ad['viewId']; ?></td>
												<td><?php echo $ad['gsServiceAccount']; ?></td>
												<td><?php echo $ad['fileNameOfP12']; ?></td>
											  <td><a href="addAnalytics.php?action=edit&id=<?php echo $ad['id']; ?>" class="btn btn-alt btn-primary">View</a></td>
											</tr>
											<?php $i++; 
											}
										}
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
	</script>	
	
	<script type="text/javascript">
		$(function() {
			// Handle the case when form was submitted before uploading has finished
			$('#form').submit(function(e) {
				// Files in queue upload them first
				if ($('#uploader').plupload('getFiles').length > 0) {
		
					// When all files are uploaded submit form
					$('#uploader').on('complete', function() {
						$('#form')[0].submit();
					});
		
					$('#uploader').plupload('start');
				} else {
					//alert("You must have at least one file in the queue.");
					$('#form')[0].submit();
				}
				return false; // Keep the form from submitting
			});
		});
		function news_validate()
		{
			var valid = true;
			if(document.getElementById('model_no').value.replace(/^\s+/,'')=='')
			{
				document.getElementById('model_no').style.border="solid 1px #DD0000";
				document.getElementById('model_no').style.borderRadius="4px";
				document.getElementById('model_no').style.boxShadow="0px 0px 10px #BB0000";
				$.jGrowl("", {
					header: 'Please Insert Product Title',
					sticky: true,
					theme: 'danger'
				});
				valid = false;
			}
			return valid;
		}
	</script>
</body>
</html>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('#add_analytics').addClass('active');
	
	});
</script>