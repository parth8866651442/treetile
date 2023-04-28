<!DOCTYPE html>
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	if($obj_fun->getMetaData('catalogue') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
		$folder = '../uploads/menu_logo/';
		if (!file_exists($folder)) {
				@mkdir($folder, 0777, true);
			}
	
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
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
				<li class="active">Add Product Details</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Menu Management</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
                           
                            <?php 
								if(isset($_POST['submit']) && $_POST['submit'] == 'create'){ 
									if($obj_fun->getMetaData('menulogo') == 1){
								
									$path_parts = pathinfo($_FILES['prologo']['name']);
									$fileExtension = $path_parts['extension'];
									$a = $folder.randomString(6).'.'.$fileExtension;
										
									move_uploaded_file($_FILES['prologo']['tmp_name'],$a); 
									
									$obj_fun->insertMenuItem($_POST,$a);
										
									}else
									{$obj_fun->insertMenuItem($_POST,'');}
									echo '<script>success("Menu Insert successfully.")</script>';
									echo "<script>urlRefresh('menu-control.php');</script>";
								}
								if(isset($_POST['submit']) && $_POST['submit'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ 
								 $path = $_POST['file_old'];
								 $psdata = $obj_fun->getMenudata($_GET['id']);
									 
									 $removeimg = $psdata['prologo'];
									
									 if($_FILES['prologo']['name'] != '')
									 {
										unlink($removeimg);
										
										$path_parts = pathinfo($_FILES['prologo']['name']);
										$fileExtension = $path_parts['extension'];
										$a = $folder.randomString(6).'.'.$fileExtension;
										 
									 	move_uploaded_file($_FILES['prologo']['tmp_name'],$a); 
										$path = $a;
									 }
									 else
									 {
										$path = $path; 
									 }
									 $obj_fun->updateMenuItem($_POST,$_GET['id'],$path);
									echo '<script>success("Menu Update successfully.")</script>';
									echo "<script>urlRefresh('menu-control.php');</script>";
								}
								?>

                            <?php
							if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){
									$psdata = $obj_fun->getMenudata($_GET['id']);
								}
							?>
							<form id="myForm" class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
                            	<?php 
								if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ ?>
										<input type="hidden" name="id" value="<?php $_GET['id'] ?>">
								<?php }	?>
                                
									<div class="control-group" >
										<label for="fileInput" class="control-label">Menu Name</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="name" name="name" value="<?php echo (isset($psdata['name'])) ? $psdata['name'] : '';  ?>" required>
										</div>
									</div>
                                    
                                     <?php if($obj_fun->getMetaData('menulogo') == 1){?>
                                     <div class="control-group">
										<label for="fileInput" class="control-label">Add Logo of Menu  </label>
										<div class="controls">
										
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span><input type="file" name="prologo" id="prologo"></span>
												</div>
											</div>
                                            
                                           	<?php if($psdata['prologo'] != '')
											{ ?>
											<img id="img_name" src="<?php echo $psdata['prologo']; ?>" style="float: right; width: auto; height: 60px;" />
											<?php } ?>
                                            
                                       
                                            <input type="hidden" name="file_old"   value="<?php echo $psdata['prologo']; ?>" >
											
											
										</div>
									</div>
                                    <?php } ?>

                                    <!-- ADD BY VISHAL 18-12-19 START -->
								<?php if($obj_fun->getMetaData('tkd_menu') == 1){ ?>
								
                                    
								
									<div class="control-group" >
										<label for="fileInput" class="control-label">Title</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="title" name="title" value="<?php echo (isset($psdata['title'])) ? $psdata['title'] : '';  ?>">
										</div>
									</div>
								
									
								
									<div class="control-group">
										<label for="fileInput" class="control-label">Keyword</label>	
										<div class="controls" style="margin-left: 180px;">
											<textarea type="textarea" class="input-xxlarge" id="keyword" name="keyword" rows="5" 
											><?php echo (isset($psdata['keyword'])) ? $psdata['keyword'] : '';  ?></textarea>
											
										</div>
									</div>
									<div class="control-group">
										<label for="fileInput" class="control-label">Description</label>	
										<div class="controls" style="margin-left: 180px;">
											<textarea type="text" class="input-xxlarge" id="description" name="description" rows="5"><?php echo (isset($psdata['description'])) ? $psdata['description'] : '';  ?></textarea>
										</div>
									</div>
									<?php } ?>
                                    <!-- ADD BY VISHAL 18-12-19 OVER -->

									<?php /*<div class="control-group">
										<label class="control-label" for="packing_details">Packing Details :</label>
										<div class="controls">
											<textarea id="packing_details" rows="8" name="packing_details"><?php echo (isset($psdata['packing_details'])) ? $psdata['packing_details'] : '';  ?></textarea>
										</div>
									</div>*/?>

									<div class="control-group">
										<label for="fileInput" class="control-label">Details</label>	
										<div class="controls" style="margin-left: 180px;">
											<textarea id="details" name="details" rows="5"><?php echo (isset($psdata['details'])) ? $psdata['details'] : '';  ?></textarea>
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
			<?php $data = $obj_fun->getmenuname();
				if(isset($data) && $data !=''){
			?>						
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						<?php /*
							if(isset($_POST['delete']) && $_POST['delete'] !='')
							{
								if(isset($_POST['cat_delete']) && $_POST['cat_delete'] !='')
								{
									for($i=0; $i < count($_POST['cat_delete']); $i++)
									{
										$obj_fun->Menudelete($_POST['cat_delete'][$i],true);
										echo '<script>success("Menu Delete successfully.")</script>';
										echo "<script>urlRefresh('menu-control.php');</script>";
									}
								}
								else
								{
									echo "<script>danger('Please Select at least one for delete');</script>";
								}
							} */
							?>
							<form class="form-gallery" action="#" method="post">
							
								<header>
									<h2>Menu</h2>
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
                                                    <th>Status</th>
													<?php if($obj_fun->getMetaData('tkd_menu') == 1){ ?>
                                                    <!-- Add Vishal 21-12-19 -->
                                                    <th>Title</th>
                                                    <th>Keyword</th>
                                                    <th>Description</th>
													<?php } ?>
                                                    <?php if($obj_fun->getMetaData('menulogo') == 1){?>
                                                    <th>Menu Logo</th>
                                                    <?php } ?>
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
                                                    <th>
                                                    <?php 
														if($v['status'] == 0){ 
															echo '<span class="fam-cross"></span>';
														}else{
															echo '<span class="fam-tick"></span>';
															}
													?>
                                                    </th>
													<?php if($obj_fun->getMetaData('tkd_menu') == 1){ ?>
                                                    <!-- Add Vishal 21-12-19 -->
                                                    <td><?php echo $v['title']; ?></td>
                                                    <td><?php echo $v['keyword']; ?></td>
                                                    <td><?php echo $v['description']; ?></td>
													<?php } ?>
                                                      <?php if($obj_fun->getMetaData('menulogo') == 1){?>
                                                     <th>
                                                       <?php if($v['prologo'] != '') { ?>
                                                       <img src="<?php echo $v['prologo']; ?>" style="width: auto; height: 60px;" id="prologo">											<p style="float:right;padding-top:20px;">
                                                       	<a class="btn btn-alt btn-danger" title="Delete View" onClick="return menu_view_delete(<?php echo $v['id']; ?>,'../uploads/menu_logo/','<?php echo $v['prologo']; ?>');"><span class="icon-trash"></span></a>
                                                       </p>
                                                       <?php } else
                                                       {?>
                                                       	<img src="img/no-image.jpg" style="width: auto; height: 60px;">
                                                       <?php } ?>
                                                       </th>
                                                       <?php } ?>
                                                       
													<td align="center">
														<a href="menu-control.php?action=update&id=<?php echo $v['id']; ?>" class="btn btn-alt btn-primary" >Edit</a>										
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
					text: "All Data will be remove in this Menu.",
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
							action: 'menu_delete',
							id: id
						}, function ( result ) {
							swal( "Deleted!", "Menu Deleted", "success" );
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
		$('.dynamic-menu #menu-size').addClass('active');
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
			}
			$.post("custom-ajax.php",{action:'menu_order_change',order:order },function(result){
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
<script>
function deleteAlertmega() {
			swal( {
					title: "Are you sure want to delete Checked Menu?",
					text: "All Data will be remove in this Checked Menu.",
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
									action: 'menu_delete',
									id: this.value
								}, function ( result ) {} );
							} );
							swal( {
									title: "Deleted!",
									text: "Menu Deleted",
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

<script src="ckeditor/ckeditor.js"></script>
		<script src="ckeditor/adapters/jquery.js"></script>
		<script>
			CKEDITOR.disableAutoInline = true;
			

			$( document ).ready( function() {
				CKEDITOR.replace( 'details',
				{
					toolbar: [
{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
'/',
{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
'/',
{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'Fontyturl' ] },
{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
{ name: 'others', items: [ '-' ] },
{ name: 'about', items: [ 'About' ] }
]
				});
			});
		</script>
        	 