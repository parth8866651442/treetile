<!DOCTYPE html>
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<?php ob_start(); ?>

<head>
	<?php 
		require_once('head.php');
		if($obj_fun->getMetaData('catalogue') == 0 and $_SESSION['type'] == 'admin')
			header('location:index.php'); 
			
			$folder = '../uploads/size_logo/';
			if (!file_exists($folder)) {
					@mkdir($folder, 0777, true);
				}
			//Series value
			$series_val  = 0;
			$menu_id     = 0;
			$sql         = "SELECT `series_no_status`,`menu_id` FROM `product_size` order BY id desc limit 1 ";
			$series_valArr = $obj_fun->getLastRecords($sql);
			$series_val  = $series_valArr['series_no_status'];  
			$menu_id     = $series_valArr['menu_id'];  
		
			function randomString($length = 6) 
			{
				$str = "";
				$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
				$max = count($characters) - 1;
				for ($i = 0; $i < $length; $i++) {
					$rand = mt_rand(0, $max);
					$str .= $characters[$rand];
				}
				return $str;
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
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span>
				</li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span>
				</li>
				<li class="active">Product Size Management</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Product Size Management</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php 

									$data = $obj_fun->getProductsize();
									if(isset($_POST['submit']) && $_POST['submit'] == 'create'){ 
									
										if($obj_fun->getMetaData('sizelogo') == 1)
										{	
										 	$path_parts = pathinfo($_FILES['sizelogo']['name']);
											$fileExtension = $path_parts['extension'];
											$a = $folder.randomString(6).'.'.$fileExtension;
											
											move_uploaded_file($_FILES['sizelogo']['tmp_name'],$a);
											
										 	$obj_fun->insertProductSize($_POST,$a);
											
										}
										else
										{
											$obj_fun->insertProductSize($_POST,'');
										}
										echo '<script>success("Product Inserted successfully")</script>';
										echo "<script>urlRefresh('product-size-control.php');</script>";
									}
									if(isset($_POST['submit']) && $_POST['submit'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ 
										 $path = $_POST['file_old'];
										 $psdata = $obj_fun->getproductsizedata($_GET['id']);
										 $removeimg = $psdata['sizelogo'];
										
										 if($_FILES['sizelogo']['name'] != '')
										 {
											 
											unlink($removeimg);
											
											$path_parts = pathinfo($_FILES['sizelogo']['name']);
											$fileExtension = $path_parts['extension'];
											$a = $folder.randomString(6).'.'.$fileExtension;
											 
										 	move_uploaded_file($_FILES['sizelogo']['tmp_name'],$a); 
											$path = $a;
										 }
										 else
										 {
											$path = $path; 
										 }
										  
										$obj_fun->updateProductSize($_POST,$_GET['id'],$path);
										echo '<script>success("Product Updated successfully")</script>';
										echo "<script>urlRefresh('product-size-control.php');</script>";
									}
								?>

								<?php
								if ( isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] == 'update' && isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] != '' ) {
									$psdata = $obj_fun->getproductsizedata( $_GET[ 'id' ] );
								}
								?>
								<form id="myForm" class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
									<?php 
									if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ ?>
									<input type="hidden" name="id" value="<?php $_GET['id'] ?>">
									<?php }	?>
									<div class="control-group">
										<label for="fileInput" class="control-label">Product Size Name</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="size" name="size" value="<?php echo (isset($psdata['size'])) ? $psdata['size'] : '';  ?>" required> </div>
									</div>
									 <div class="control-group">
										<label for="fileInput" class="control-label">Series No Status</label>
										<div class="controls">
											<?php global $con;
												$comming = "SELECT * FROM `product` WHERE size_id = '".$psdata['id']."'";
												$cdata = mysqli_num_rows(mysqli_query($con,$comming));
												if($cdata != 0){ ?>

											<input type="hidden" name="series_no_status" value="<?php echo $psdata['series_no_status']; ?>" required>
											<?php 
												if($psdata['series_no_status'] == 0){
														echo "Series Number";
													}
												else if($psdata['series_no_status'] == 1){
														echo "Series";
													}
												else if($psdata['series_no_status'] == 2){
														echo "Direct Design";
													}
												else if($psdata['series_no_status'] == 3){
														echo "Direct With Series & Description";
													}
												else{
														echo "Something Is Wrong.";
													}
											}else {?>

											<?php 
													$sql = "SELECT * FROM `product_size` order BY id desc limit 1 ";
											  		$res = $obj_fun->getLastRecords($sql);
											  		
											  		if(isset($psdata['series_no_status']))
											  		{
											  			$series_val = $psdata['series_no_status'];
											  		}
											  ?>
											<select id="select" name="series_no_status" required>
												<option value="0" <?php echo ($series_val==0 ) ? ' selected' : '' ?>>Series No</option>
												<option value="1" <?php echo ($series_val==1 ) ? ' selected' : '' ?>>Series</option>
												<option value="2" <?php echo ($series_val==2 ) ? ' selected' : '' ?>>Direct Design</option>
												<option value="3" <?php echo ($series_val==3 ) ? ' selected' : '' ?>>Design With Series & Description</option>
											</select>
											<?php } ?>

										</div>
									</div>  
									<?php 
												$menu = $obj_fun->getmenuname();
											?>
									<div class="control-group">
										<label for="fileInput" class="control-label">Menu</label>
										<div class="controls">
												<select id="select" name="menu_id" required>
													<?php
													if(isset($psdata['menu_id']))
													{
														$menu_id = $psdata['menu_id'];
													}
														foreach($menu as $m){ ?>
															<option value="<?php echo $m['id'] ?>"<?php echo ($menu_id == $m['id']) ? ' selected' : '' ?>><?php echo $m['name'] ?></option>
													<?php } ?>
												</select>
										</div>
									</div>
                                    <?php /*
									<div class="control-group">
										<label for="fileInput" class="control-label">Col View</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="colview" name="col_view" value="<?php echo (isset($psdata['col_view'])) ? $psdata['col_view'] : '';  ?>" required>
											<p>Only Applicable : 2,3,4,5</p>
										</div>
									</div> */ ?>


									<!-- <input type="hidden" id="colview" name="col_view" value="<?php echo (isset($psdata['col_view'])) ? $psdata['col_view'] : '4';  ?>"> -->

									<div class="control-group">
										<label for="fileInput" class="control-label">Packing Size</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="packing_size" name="packing_size" value="<?php echo (isset($psdata['packing_size'])) ? $psdata['packing_size'] : '';  ?>">
											<p>Ex : 200 x 300. Total area calculate from this parameters.</p>
										</div>

									</div>
									<div class="control-group">
										<label for="fileInput" class="control-label">Piece Per Box</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="packing_number" name="packing_number" value="<?php echo (isset($psdata['packing_number'])) ? $psdata['packing_number'] : '';  ?>">
										</div>
									</div> 

									<?php if($obj_fun->getMetaData('sizelogo') == 1){?>
									<div class="control-group">
										<label for="fileInput" class="control-label">Add Logo of Size  </label>
										<div class="controls">

											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span><input type="file" name="sizelogo" id="sizelogo">
													</span>
												</div>
											</div>

											<?php if($psdata['sizelogo'] != '')
												{ ?>
											<img id="img_name" src="<?php echo (isset($psdata['sizelogo']) && $psdata['sizelogo'] !='' ? $psdata['sizelogo'] : '');?>" style="float: right; width: auto; height: 60px;"/>
											<?php } ?>
											
											<input type="hidden" name="file_old"   value="<?php echo $psdata['sizelogo']; ?>" >


										</div>
									</div>

									<?php } ?>

									<?php if($obj_fun->getMetaData('catalog_link') == 1){?>
									<div class="control-group">
										<label for="fileInput" class="control-label">E-Catalogue Link</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="catalog_link" name="catalog_link" value="<?php echo (isset($psdata['catalog_link'])) ? $psdata['catalog_link'] : '';  ?>">
										</div>
									</div>
									<?php } ?>

									<?php if($obj_fun->getMetaData('tkd_size') == 1){ ?>
									<div class="control-group">
										<label class="control-label" for="input">Title</label>
										<div class="controls">
											<input id="input" class="input-xxlarge" type="text" name="title" value="<?php echo (isset($psdata['title'])) ? $psdata['title'] : '';  ?>">
										</div>
									</div>

									<div class="control-group">
										<label for="fileInput" class="control-label">Keyword</label>
										<div class="controls" style="margin-left: 180px;">
											<textarea type="textarea" class="input-xxlarge" id="keyword" name="keyword" rows="5"><?php echo (isset($psdata['keyword'])) ? $psdata['keyword'] : '';  ?></textarea>

										</div>
									</div>

									<div class="control-group">
										<label for="fileInput" class="control-label">Description</label>
										<div class="controls" style="margin-left: 180px;">
											<textarea type="text" class="input-xxlarge" id="description" name="description" rows="5"><?php echo (isset($psdata['description'])) ? $psdata['description'] : '';  ?></textarea>
										</div>
									</div>
									<?php } ?>
									
									<div class="control-group">
										<label for="fileInput" class="control-label">Coverage Area</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="sqlmtrperbox" name="sqlmtrperbox" value="<?php echo (isset($psdata['sqlmtrperbox'])) ? $psdata['sqlmtrperbox'] : '';  ?>"> 
                                        </div>
									</div> 
									<?php /*
									<div class="control-group">
										<label for="fileInput" class="control-label">No. of Boxes per Box</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="noperbox" name="noperbox" value="<?php echo (isset($psdata['noperbox'])) ? $psdata['noperbox'] : '';  ?>"> 
					                    </div>
									</div> */ ?>
									<div class="control-group">
										<label for="fileInput" class="control-label">Thickness</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="thickness" name="thickness" value="<?php echo (isset($psdata['thickness'])) ? $psdata['thickness'] : '';  ?>"> </div>
									</div>
									<?php /*
									<div class="control-group">
										<label for="fileInput" class="control-label">Weight Per Box (Approx)</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="weight" name="weight" value="<?php echo (isset($psdata['weight'])) ? $psdata['weight'] : '';  ?>"> </div>
									</div> */ ?>
									<?php /* 
									<div class="control-group">
										<label for="fileInput" class="control-label">Net Weight per Container (kgs)</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="netweight" name="netweight" value="<?php echo (isset($psdata['netweight'])) ? $psdata['netweight'] : '';  ?>"> </div>
									</div> */ ?>
									
                                    <?php /*
                                    <div class="control-group">
										<label for="fileInput" class="control-label">Add New Tag</label>
										<div class="controls">
											<select id="select" name="new" required>
												<option value="1" <?php echo (isset($psdata[ 'new']) && $psdata[ 'new']==1 ) ? ' selected' : '' ?>>Enable</option>
												<option value="0" <?php echo (isset($psdata[ 'new']) && $psdata[ 'new']==0 ) ? ' selected' : '' ?>>Disable</option>
											</select>
										</div>
									</div>*/ ?>
                                    
									<div class="control-group">
										<label for="fileInput" class="control-label">Status</label>
										<div class="controls">
											<select id="select" name="status" required>
												<option value="1" <?php echo (isset($psdata[ 'status']) && $psdata[ 'status']==1 ) ? ' selected' : '' ?>>Enable</option>
												<option value="0" <?php echo (isset($psdata[ 'status']) && $psdata[ 'status']==0 ) ? ' selected' : '' ?>>Disable</option>
											</select>
										</div>
									</div>
									<div class="form-actions">
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="<?php echo (isset($_GET['action']) && $_GET['action'] == 'update') ? 'update' : 'create'; ?>" style="float: left;"/>
									</div>
								</form>

							</div>
						</section>
					</div>
				</article>
			</div>
			<?php 
		
					if(isset($data) && $data !=''){
				?>
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						<form class="form-gallery" action="#" method="post">

							<header>
								<h2>Product Size</h2>
								<ul class="data-header-actions tabs">
									<li class="demoTabs active"><input type="button" name="delete" id="delete" value="Delete" onClick="return deleteAlertmega();" class="btn btn-alt btn-primary"/>
									</li>
								</ul>
							</header>
							<section>
								<div class="tab-pane" id="dynamic">
									<table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
										<thead>
											<tr>
												<th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;"/>
												</th>
												<th>Name</th>
												<!--<th>Series No Status</th>-->
												<th>Menu</th>
												<!--<th>Col-View</th>-->
												<th>Packing Size</th>
												 <th>Pics Per Box</th>
												 <th>Coverage Area</th>
												 <th>Thickness</th>
												<?php if($obj_fun->getMetaData('sizelogo') == 1){?>
												<th>Logo of Size</th>
												<?php } ?>
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
												</td>
												<td>
													<?php echo $v['size']; ?>
												</td>
												<!--<th>-->
												<!--	<?php echo $v['series_no_status']; ?>-->
												<!--</th>-->
												<th>
													<?php echo $v['name']; ?>
												</th>
												<!--<th>-->
												<!--	<?php echo $v['col_view']; ?>-->
												<!--</th>-->
												<th>
													<?php echo $v['packing_size']; ?>
												</th>
												<th>
													<?php echo $v['packing_number']; ?>
												</th>
												<th>
													<?php echo $v['sqlmtrperbox']; ?>
												</th>
												<th>
													<?php echo $v['thickness']; ?>
												</th>
												<?php if($obj_fun->getMetaData('sizelogo') == 1){?>
												<th>
													<?php if($v['sizelogo'] != '') { ?>
													<img src="<?php echo $v['sizelogo']; ?>" style="width: auto; height: 60px;">
													<a class="btn btn-alt btn-danger" title="Delete View" onClick="return size_view_delete(<?php echo $v['id']; ?>,'../uploads/size_logo/','<?php echo $v['sizelogo']; ?>');" style="float:right;margin-top:15px;"><span class="icon-trash"></span></a>
													<?php } else
	                                                       {?>
													<img src="img/no-image.jpg" style="width: auto; height: 60px;">
													<?php } ?>
												</th>
												<?php } ?>
												<th>
													<?php 
															if($v['status'] == 0){ 
																echo '<span class="fam-cross"></span>';
															}else{
																echo '<span class="fam-tick"></span>';
																}
														?>
												</th>

												<td align="center">
													<a href="product-size-control.php?action=update&id=<?php echo $v['id']; ?>" class="btn btn-alt btn-primary">Edit</a>
													<a class="btn btn-alt btn-danger" onClick="deleteAlert(<?php echo $v['id']; ?>)">Delete</a> </td>
												<td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span>
												</td>
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

		function deleteAlertmega() {
			swal( {
					title: "Are you sure want to delete Checked Product Size?",
					text: "All Data will be remove in this Checked Product Size.",
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
									action: 'productsize_delete',
									id: this.value
								}, function ( result ) {} );
							} );
							swal( {
									title: "Deleted!",
									text: "Product Size Deleted",
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

		function deleteAlert( id ) {
			swal( {
					title: "Are you sure want to delete?",
					text: "All Data will be remove in this Product Size.",
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
							action: 'productsize_delete',
							id: id
						}, function ( result ) {
							swal( "Deleted!", "Product Size Deleted", "success" );
							location.reload();
						} );
					} else {
						swal( "Cancelled", "", "error" );
					}
				} );
		}
	</script>
	<style>
		.row-fluid .span2.gallery {
			margin: 10px;
		}
	</style>

	<script src="progress/jquery_002.js"></script>

	<script type="text/javascript">
		$( document ).ready( function () {
			$( '#selecctall' ).click( function ( event ) { //on click
				if ( this.checked ) { // check select status
					$( '.checkbox1' ).each( function () { //loop through each checkbox
						this.checked = true; //select all checkboxes with class "checkbox1"              
					} );
				} else {
					$( '.checkbox1' ).each( function () { //loop through each checkbox
						this.checked = false; //deselect all checkboxes with class "checkbox1"                      
					} );
				}
			} );

		} );
	</script>
	<style>
		.progress {
			position: relative;
			width: 400px;
			border: 0;
			padding: 1px;
			border-radius: 3px;
		}
		
		.bar {
			background-color: #B4F5B4;
			width: 0%;
			height: 20px;
			border-radius: 3px;
		}
		
		.percent {
			position: absolute;
			display: inline-block;
			top: 3px;
			left: 48%;
		}
	</style>

</body>

</html>
<script type="text/javascript">
	jQuery( document ).ready( function ( $ ) {
		$( '.dynamic-menu #product-size' ).addClass( 'active' );
	} );
</script>
<link rel="stylesheet" href="order/tablednd.css" type="text/css"/>
<script type="text/javascript" src="order/jquery.tablednd.0.7.min.js"></script>
<script type="text/javascript">
	$( document ).ready( function () {
		var order = [];
		$( '#catalogueview' ).tableDnD( {
			onDrop: function ( table, row ) {
				var rows = table.tBodies[ 0 ].rows;

				for ( var i = 0; i < rows.length; i++ ) {
					order[ i ] = rows[ i ].id;
					//alert(rows[i].id);
				}
				$.post( "custom-ajax.php", {
					action: 'productsize_order_change',
					order: order
				}, function ( result ) {
					//console.log(result);
					if ( result > 0 )
						location.reload();
				} );
			},
			dragHandle: ".dragHandle"
		} );
		$( "#catalogueview tr" ).hover( function () {
			$( this.cells[ 0 ] ).addClass( 'showDragHandle' );
		}, function () {
			$( this.cells[ 0 ] ).removeClass( 'showDragHandle' );
		} );
	} );
</script>