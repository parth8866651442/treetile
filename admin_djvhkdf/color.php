<!DOCTYPE html>
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
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
				<li class="active">Add Tiles Color</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Tiles Color</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
                        
                            <?php 
								if(isset($_POST['submit']) && $_POST['submit'] == 'create'){ 
									$obj_fun->insertcolor($_POST);
									echo '<script>success("Tiles Color Insert successfully.")</script>';
									echo "<script>urlRefresh('color.php');</script>";
								}
								if(isset($_POST['submit']) && $_POST['submit'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ 
								
								 $psdata = $obj_fun->getcolordata($_GET['id']);
									 
									 
									 $obj_fun->updatecolor($_POST,$_GET['id']);
									echo '<script>success("Tiles Color Update successfully.")</script>';
									echo "<script>urlRefresh('color.php');</script>";
								}
								?>

                            <?php
							if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){
									$psdata = $obj_fun->getcolordata($_GET['id']);
								}
							?>
							<form id="myForm" class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
                            	<?php 
								if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ ?>
										<input type="hidden" name="id" value="<?php $_GET['id'] ?>">
								<?php }	?>
                                
									<div class="control-group" >
										<label for="fileInput" class="control-label">Color Name</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="name" name="name" value="<?php echo (isset($psdata['name'])) ? $psdata['name'] : '';  ?>" required>
										</div>
									</div>
								
									<div class="control-group" >
										<label for="fileInput" class="control-label">Color Hexacode</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="hexacode" name="hexacode" value="<?php echo (isset($psdata['hexacode'])) ? $psdata['hexacode'] : '';  ?>" required>
										</div>
									</div>
                                   
								   <div class="control-group" >
										<label for="fileInput" class="control-label">Status</label>	
										<div class="controls">
													<select id="select" name="status" required>
														<option value="1"<?php echo (isset($psdata['status']) && $psdata['status'] == 1) ? ' selected' : '' ?>>Enable</option>
														<option value="0"<?php echo (isset($psdata['status']) && $psdata['status'] == 0) ? ' selected' : '' ?>>Disable</option>
													</select>
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
			<?php $data = $obj_fun->getcolorname();
				if(isset($data) && $data !=''){
			?>						
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						
							<form class="form-gallery" action="#" method="post">
							
								<header>
									<h2>Color</h2>
									<ul class="data-header-actions tabs">
									<li class="demoTabs active"><input type="button" name="delete" id="delete" value="Delete" onClick="return deleteAlertmega();" class="btn btn-alt btn-primary"/>
									</li>
								</ul>
								 </header>
                                
								<section class="data-block">
									<div class="tab-pane" id="dynamic">
						
										<table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
											<thead>
												<tr>
													<th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;"/>
													<th>Name</th>
													<th>Hexa Code</th>
                                                    <th>Status</th>
													<th>Action</th>
													<th>Drag & Drop</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$i=1;
													
													foreach($data as $v){
													?>
												<tr class="odd gradeX" id="<?php echo $v['id']; ?>">
													<td><input type="checkbox" value="<?php echo $v['id']; ?>" class="checkbox1" name="cat_delete">
													<td><?php echo $v['name']; ?></td>
													<center>
														<td><div style="margin:auto;width: 50px;height: 50px;border-radius: 50px;background-color: <?php echo $v['hexacode']; ?>;"></div> </td>
													</center>														
                                                    <th>
                                                    <?php 
														if($v['status'] == 0){ 
															echo '<span class="fam-cross"></span>';
														}else{
															echo '<span class="fam-tick"></span>';
															}
													?>
                                                  
                                                       
													<td align="center">
														<a href="color.php
																 ?action=update&id=<?php echo $v['id']; ?>" class="btn btn-alt btn-primary" >Edit</a>										
                                                        <a class="btn btn-alt btn-danger" onClick="deleteAlert(<?php echo $v['id']; ?>)">Delete</a>	
                                                    </td>
													<td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span></td>
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
		function deleteAlert( id ) {
			swal( {
					title: "Are you sure want to delete?",
					text: "All Data will be remove in this Tiles Color.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Delete!",
					cancelButtonText: "No, Cancel !",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function ( isConfirm ) {
					if ( isConfirm ) {
						$.post( "custom-ajax.php", {
							action: 'tilescolor_delete',
							id: id
						}, function ( result ) {
							swal( "Deleted!", "Tiles Color", "success" );
							location.reload();
						} );
					} else {
						swal( "Cancelled", "", "error" );
					}
				} );
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
		$('.dynamic-menu #Tiles_Color').addClass('active');
	});
</script>

<script>
function deleteAlertmega() {
			swal( {
					title: "Are you sure want to delete Checked Tiles Color?",
					text: "All Data will be remove in this Checked Tiles Color.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Delete!",
					cancelButtonText: "No, Cancel !",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function ( isConfirm ) {
					var chkLength = $( 'input[name="cat_delete"]:checked' ).length;
					if ( chkLength >= 1 ) {
						if ( isConfirm ) {
							$( 'input[name="cat_delete"]:checked' ).each( function () {
								$.post( "custom-ajax.php", {
									action: 'tilescolor_delete',
									id: this.value
								}, function ( result ) {} );
							} );
							swal( {
									title: "Deleted!",
									text: "Tiles Color Deleted",
									type: "success"
								},
								function () {
									location.reload();
								}
							);
						} else {
							swal( "Cancelled", "", "error" );
							return false;
						}
					} else {
						swal( "Cancelled", "Please Select at least one for delete", "error" );
						return false;
					}
				} );
		}

		$( '.confirm' ).click( function () {
			if ( $( this ).text() == "OK" ) {
				location.reload();
			}
		} );
</script>
	 