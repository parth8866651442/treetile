<!DOCTYPE html>
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	if($obj_fun->getMetaData('catalogue') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
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
				<li class="active">Video</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Add Video</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
                            <?php 
	
								if(isset($_POST['submit']) && $_POST['submit'] == 'create'){ 
									$message = $obj_fun->insertvideo($_POST);
									echo '<script>success("'.$message.'")</script>';
									echo "<script>urlRefresh('video.php');</script>";
								}
								if(isset($_POST['submit']) && $_POST['submit'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ 
									$message = $obj_fun->updatevideo($_POST,$_GET['id']);
									echo '<script>success("'.$message.'")</script>';
									echo "<script>urlRefresh('video.php');</script>";
								}
								?>

                            <?php
							if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){
									$psdata = $obj_fun->getvideo1($_GET['id']);
								}
							?>
							<form id="myForm" class="form-horizontal" method="post" action="#">
                            	<?php 
								if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ ?>
										<input type="hidden" name="id" value="<?php $_GET['id'] ?>">
								<?php }	?>
                                
									<div class="control-group" >
										<label for="fileInput" class="control-label">Name</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="name" name="name" value="<?php echo (isset($psdata['name'])) ? $psdata['name'] : '';  ?>" required> 
										</div>
									</div>
                                    
                                    <div class="control-group" >
										<label for="fileInput" class="control-label">Youtube Video Url</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="url" name="yturl" value="<?php echo (isset($psdata['yturl'])) ? $psdata['yturl'] : '';  ?>" required> 
										</div>
									</div>
                                    
                                
                                    
                                
									<div class="form-actions">
<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="<?php echo (isset($_GET['action']) && $_GET['action'] == 'update') ? 'update' : 'create'; ?>" style="float: left;" />		
									</div>
								</form>
                  
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php $data = $obj_fun->getvideo();
			
				if(isset($data) && $data !=''){
			?>						
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						<?php
							if(isset($_POST['delete']) && $_POST['delete'] !='')
							{
								if(isset($_POST['cat_delete']) && $_POST['cat_delete'] !='')
								{
									for($i=0; $i < count($_POST['cat_delete']); $i++)
									{
										$obj_fun ->videodelete($_POST['cat_delete'][$i]);
										echo '<script>success("Video Delete successfully.")</script>';
										echo "<script>urlRefresh('video.php');</script>";
									}
								}
								else
								{
									echo "<script>danger('Please Select at least one for delete');</script>";
								}
							}
							?>
							<form class="form-gallery" action="#" method="post">
							
								<header>
									<h2>Product Size</h2>
									<ul class="data-header-actions tabs">
										<input type="button" name="delete" id="delete" value="Delete" onClick="return deleteAlertmega();" class="btn btn-alt btn-primary" />
									</ul>
								</header>
								<section>
									<div class="tab-pane" id="dynamic">
										<table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
											<thead>
												<tr>
													<th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
													<th>No</th>
                                                    <th>Name</th>
													<th>Url</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$i=1;
													foreach($data as $v){
													?>
												<tr class="odd gradeX" id="<?php echo $v['id']; ?>">
													<td><input type="checkbox" value="<?php echo $v['id']; ?>" class="checkbox1" id="cat_delete" name="cat_delete"></td>
												
                                                    <td><?php echo $i++; ?></td>
													<td><?php echo $v['name']; ?></td>
                                                    <th><?php echo $v['yturl']; ?></th>
                                                    
                                                    
													<td align="center">
														<a href="video.php?action=update&id=<?php echo $v['id']; ?>" class="btn btn-alt btn-primary" >Edit</a>										
                                                        <a class="btn btn-alt btn-danger" onClick="deleteAlert(<?php echo $v['id']; ?>)">Delete</a>								</td>
												
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</section>
							</form>
						</div>
					</article>
				</div>
			<?php }?>
		</div>
	</div>
	<?php include_once('script.php');?>
	<script>
	/* function deleteAlert(id){
		x =  confirm("are you sure want to delete!\nAll Data will be remove in this Product Size.");
		if(x){
				$.post("custom-ajax.php",{action:'productsize_delete',id:id },function(result){
				//console.log(result);
					//location.reload();
					
				});
			}
	} */
	
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
					var chkLength = $('input[name="cat_delete"]:checked').length;
					if(chkLength >= 1)
					{
						if (isConfirm) {
							$('input[name="cat_delete"]:checked').each(function() {
							   $.post("custom-ajax.php",{action:'video_delete',id:this.value },function(result){
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
	
	
function deleteAlert(id){	
			swal({
			title: "Are you sure want to delete?",
			text: "All Data will be remove in this Video.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			cancelButtonText: "No, Cancel !",
			closeOnConfirm: false,
			closeOnCancel: false
			},
			function(isConfirm){
					if (isConfirm) {
						$.post("custom-ajax.php",{action:'video_delete',id:id },function(result){
											swal("Deleted!", "Video Deleted", "success");
											location.reload();
												});
					} else {
						swal("Cancelled", "", "error");
					}
			});
}
	</script>
<style>
.row-fluid .span2.gallery{
	margin:10px;
	
}
</style>

<script src="progress/jquery_002.js"></script>

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
<style>
.progress { position:relative; width:400px; border: 0; padding: 1px; border-radius: 3px; }
.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>

</body>
</html>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
	 	$('.dynamic-menu #m-media').addClass('active');
		$('.dynamic-menu #video').addClass('active');
	});
</script>
<link rel="stylesheet" href="order/tablednd.css" type="text/css"/>
<script type="text/javascript" src="order/jquery.tablednd.0.7.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var order = [];
	$('#catalogueview').tableDnD({
		onDrop: function(table, row) {
			var rows = table.tBodies[0].rows;
			
			for (var i=0; i<rows.length; i++) {
				order[i] = rows[i].id;
				//alert(rows[i].id);
			}
			$.post("custom-ajax.php",{action:'productsize_order_change',order:order },function(result){
				//console.log(result);
				if(result>0)
					location.reload();
			});
		},
		dragHandle: ".dragHandle"
	});
	$("#catalogueview tr").hover(function() {
		$(this.cells[0]).addClass('showDragHandle');
	}, function() {
		$(this.cells[0]).removeClass('showDragHandle');
	});
});
</script>