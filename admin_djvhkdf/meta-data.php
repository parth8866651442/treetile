<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php'); 

	if(isset($_GET['action']) && $_GET['action'] == 'edit' && $_GET['type'] !='') 
	{
		$action = $_GET['action'];
		$type = $_GET['type'];
		$p_title = $obj_fun->getMetaDataByType($type,'title');
		$p_keyword = $obj_fun->getMetaDataByType($type,'keyword');
		$p_description = $obj_fun->getMetaDataByType($type,'description');
	}
	else
	{
		$meta_page = $obj_fun->get_records_assoc('SELECT type FROM `settings` WHERE type not in ("Export1","functionality","packing","paging","settings","Sms","Social") GROUP BY type order by type asc');
	}
		
?>
</head>
<body class="fixed-layout">
	<div class="container">
		<div class="sidebar">
			<?php include_once('sidebar.php');?>
		</div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
				<li class="active">Meta Data</li>
			</ul>
		
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2><?php echo ucwords($type);?> Meta Details</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
							<?php 
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update Meta Data')
								{
									
									$arr1['title'] = htmlspecialchars($_POST['title']);
									$ress = $obj_fun->add_MetaData($_POST['type'], $arr1);
									
									$arr2['keyword'] = htmlspecialchars($_POST['keyword']);
									$ress = $obj_fun->add_MetaData($_POST['type'], $arr2);
									
									$arr3['description'] = htmlspecialchars($_POST['description']);
									$ress = $obj_fun->add_MetaData($_POST['type'], $arr3);
									
									echo "<script>window.location.href = 'meta-data.php'</script>";
								}
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Save Meta Data')
								{	
									
									
									$arr1['title'] = htmlspecialchars($_POST['title']);
									$ress = $obj_fun->add_MetaData($_POST['type'], $arr1);
									
									$arr2['keyword'] = htmlspecialchars($_POST['keyword']);
									$ress = $obj_fun->add_MetaData($_POST['type'], $arr2);
									
									$arr3['description'] = htmlspecialchars($_POST['description']);
									$ress = $obj_fun->add_MetaData($_POST['type'], $arr3);
									
									echo "<script>window.location.href = 'meta-data.php'</script>";
								}
							?>
								<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="#">
									<input type="hidden" name="type" id="type" value="<?php echo $type;?>" />
                                    <?php if($action == ''){?>
                                    <div class="control-group">
										<label class="control-label" for="input" style="width: 100px; text-align: left;">Page :</label>
										<div class="controls">
											<input type="text" value="" name="type" id="type" class="span10" required>
										</div>
									</div>
                                    <?php }?>
									<div class="control-group">
										<label class="control-label" for="input" style="width: 100px; text-align: left;">Title :</label>
										<div class="controls">
											<input type="text" value="<?php echo $obj_fun->getMetaDataByType($type,'title'); ?>" name="title" id="title" class="span10">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Keywords:</label>
										<div class="controls"><textarea id="keyword" class="span10" rows="4" name="keyword"><?php echo $obj_fun->getMetaDataByType($type,'keyword'); ?></textarea></div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Description:</label>
										<div class="controls"><textarea id="description" rows="8" name="description" class="span10"><?php echo $obj_fun->getMetaDataByType($type,'description'); ?></textarea></div>
									</div>
                                     <?php if($action == ''){ $save_button = 'Save '; }else{ $save_button = 'Update '; }?>
									<div class="controls form-actions" style="padding: 15px 0px 0px 15px;">
										<input name="submit" id="submit-frm" class="btn btn-alt btn-large btn-primary" type="submit" value="<?php echo $save_button;?>Meta Data" />
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			
			<?php if($action == ''){?>
			<div class="row-fluid" id="">
				<article class="span12 data-block">
					<div class="data-container">
						<header>
							<h2>All Pages</h2>
							 <ul class="data-header-actions tabs">
                <li class="demoTabs active">
                  <input type="button" name="delete" id="delete" value="Delete" onClick="return deleteAlertmega();" class="btn btn-alt btn-primary" />
                </li>
              </ul>
						</header>
						<section>
							<div class="tab-pane" id="dynamic">
								<form method="post" action="#">
								<table class="datatable table table-striped table-bordered" id="filter-view" align="center">
									<thead>
										<tr>
											<th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
											<th>Page</th>
											<th>Title</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($meta_page as $k => $p){ ?>
										<tr class="odd gradeX">
											<td><input type="checkbox" value="<?php echo $p['type']; ?>" class="checkbox1" id="img_delete" name="img_delete"></td>
											
											<td align="center"><?php echo ucwords($p['type']); ?></td>
											<td align="center"><?php echo $obj_fun->getMetaDataByType($p['type'],'title'); ?></td>
											<td align="center">
                                            <a class="btn btn-alt btn-primary" href="meta-data.php?type=<?php echo $p['type']; ?>&action=edit">Edit</a>
											<?php /*
                                            <a class="btn btn-alt btn-primary" href="meta-data-delete.php?type=<?php echo $p['type']; ?>">Delete</a>*/ ?>
											</td>
										</tr>
										<?php }?>
									</tbody>
								</table>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php }?>
		</div>
	</div>
	
	<?php include_once('script.php');?>
	<script type="text/javascript">
		 	jQuery(document).ready(function($) {
		 	$('.dynamic-menu #matadata').addClass('active');
		});
	</script>
	
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
		
		function deleteAlertmega(){
			swal({
					title: "Are you sure want to delete?",
					text: "All Selected data will be remove.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Delete!",
					cancelButtonText: "No, Cancel !",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					var chkLength = $('input[name="img_delete"]:checked').length;
					if(chkLength >= 1)
					{
						if (isConfirm) {
							$('input[name="img_delete"]:checked').each(function() {
							   $.post("custom-ajax.php",{action:'Delete_Metadata_Page',type:this.value },function(result){
							   });
							});
							swal({title: "Deleted!", text: "Deleted", type: "success"},
							   function(){ 
							       location.reload();
							   }
							);
						} else {
							swal("Cancelled", "", "error");
							return false;
						}
					}
					else
					{
						swal("Cancelled", "Please Select at least one for delete", "error");
						return false;
					}
				});
		}

		$('.confirm').click(function() {
			if($(this).text()=="OK")
			{
				location.reload();
			}
		});
		
	</script>
	
</body>
</html>
