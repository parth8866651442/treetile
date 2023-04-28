<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<?php ob_start(); ?>

<head>
	<?php 
	require_once('head.php'); 
		$folder = '../uploads/appicon/';
		if (!file_exists($folder)) {
				@mkdir($folder, 0777, true);
			}
	
	 $appicon = $obj_fun->getMetaData('appicon');
	
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
				<li><a href="#">Application</a><span class="divider"></span>
				</li>
				<li class="active">Category</li>
			</ul>
			<div class="row-fluid">
				<article class="data-block nested">
					<div class="data-container">
						<header>
							<h2>
								<?php echo (isset($series_details['id']) && $series_details['id'] !=''? 'Update' : 'Add'); ?> Category</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
								if ( isset( $_POST[ 'submit' ] ) && $_POST[ 'submit' ] == 'create' ) {

									if ( $appicon == 1 ) { 
									
										$path_parts = pathinfo($_FILES['icon']['name']);
										$fileExtension = $path_parts['extension'];
										$a = $folder.randomString(6).'.'.$fileExtension;
										
										move_uploaded_file( $_FILES[ 'icon' ][ 'tmp_name' ], $a );
										
										$s_ins = $obj_fun->insertCategory( $_POST[ 'name' ], $a );
										
									} else {
										$s_ins = $obj_fun->insertCategory( $_POST[ 'name' ] );
									}
									if ( $s_ins == 'success' ) {
										echo '<script>success("Category Insert successfully.")</script>';
										echo "<script>urlRefresh('gallery-category.php');</script>";
									} elseif ( $s_ins == 'exists' )
										echo '<script>danger("Category already exists !")</script>';
									else
										echo '<script>danger("Get error while updating Category!")</script>';
								}

								if ( isset( $_POST[ 'submit' ] ) && $_POST[ 'submit' ] == 'update' && isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] != '' ) {
									$path = $_POST[ 'file_old' ];
									$psdata = $obj_fun->getcategoryup( $_GET[ 'id' ] );

									$removeimg = $psdata[ 'icon' ];

									if ( $_FILES[ 'icon' ][ 'name' ] != '' ) {

										unlink( $removeimg );
									
										$path_parts = pathinfo($_FILES['icon']['name']);
										$fileExtension = $path_parts['extension'];
										$a = $folder.randomString(6).'.'.$fileExtension;
										
										move_uploaded_file( $_FILES[ 'icon' ][ 'tmp_name' ], $a );
										
										$path = $a;
										
									} else {
										$path = $path;
									}
									$obj_fun->categoryup( $_POST, $_GET[ 'id' ], $path );
									echo '<script>success("Categoty Update successfully.")</script>';
									echo "<script>urlRefresh('gallery-category.php');</script>";
								}





								?>

								<form id="myForm" class="form-horizontal" method="post" action="#" enctype="multipart/form-data" onSubmit="return category_validate();">
									<?php 
								if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ 
								$psdata = $obj_fun->getcategoryup($_GET['id']);
								?>
									<input type="hidden" name="id" value="<?php $_GET['id'] ?>">
									<?php }	?>


									<div class="control-group">
										<label for="fileInput" class="control-label">Add Category </label>
										<div class="controls">
											<input type="text" class="input-xxlarge" id="name" name="name" value="<?php echo (isset($psdata['name'])) ? $psdata['name'] : '';  ?>" >
										</div>
									</div>
									<?php if($appicon == 1) { ?>
									<div class="control-group">
										<label for="fileInput" class="control-label">Add Category Icon  </label>
										<div class="controls">

											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span><input type="file" name="icon" id="icon">
													</span>
												</div>
											</div>

											<?php if($psdata['icon'] != '')
											{ ?>
											<img id="img_name" src="<?php echo $psdata['icon']; ?>" style="float: right; width: auto; height: 60px;"/>
											<?php } ?>


											<input type="hidden" name="file_old" value="<?php echo $psdata['icon']; ?>">


										</div>
									</div>
									<?php } ?>





									<div class="form-actions">
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="<?php echo (isset($_GET['action']) && $_GET['action'] == 'update') ? 'update' : 'create'; ?>" style="float: left;"/>
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php $category = $obj_fun->getCategory();?>
			<?php if(isset($category) && $category !=''){ ?>
			<div class="row-fluid">
				<article class="data-block">
					<div class="data-container">
						<header>
							<h2>All Category</h2>
						</header>
						<section>
							<div class="tab-pane" id="dynamic drag_drop_result">
								<table class="datatable table table-striped table-bordered" id="example" align="center">
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th>Category</th>
											<?php if($appicon == 1) { ?>
											<th>Icon</th>
											<?php } ?>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$i=1;
											foreach($category as $s) { ?>
										<tr class="odd gradeX" id="<?php echo $s['id']; ?>">
											<td>
												<?php echo $i; ?>
											</td>
											<td id="category_id_<?php echo $s['id']; ?>">
												<?php echo $s['name']; ?>
											</td>
											<?php if($appicon == 1) { ?>
											<td><img src="<?php echo $s['icon']; ?>" style="width:60px;">
											</td>
											<?php } ?>
											<td>
												<a href="gallery-category.php?action=update&id=<?php echo $s['id']; ?>" class="btn btn-alt btn-primary">Edit</a>
												<a class="btn btn-alt btn-danger" onClick="return category_delete('<?php echo $s['id']; ?>');">Delete</a>
											</td>
										</tr>
										<?php $i++; } ?>
									</tbody>
								</table>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php }?>
		</div>
	</div>
	<?php include_once('script.php');?>
	<script>
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
		<?php if($_GET['action'] == 'update') {}else{ ?>
		function category_validate()
		{	
			var valid = true;
			if(document.getElementById('name').value.replace(/^\s+/,'')=='')
			{
				document.getElementById('name').style.border="solid 1px #DD0000";
				document.getElementById('name').style.borderRadius="4px";
				document.getElementById('name').style.boxShadow="0px 0px 10px #BB0000";
				danger('Please fill the Category name field.');
				return false;
			}
			<?php if ( $appicon == 1 ) { ?>
			if(document.getElementById('icon').value.replace(/^\s+/,'')=='')
			{
				danger('Please Select the icon field.');
				return false;
			}
			else
			{
				var fup = document.getElementById('icon');
				var fileName = fup.value;
				 var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
				if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG")
				{
					//valid =  true;
					if(fup.files[0].size >3145728)   // 3MB = 1024*1024*3
					{
						danger("Image File too large. File must be less than 3MB.");
						return false;
					}

				}        
				else
				{
					danger("Upload JPG images only");
					return false;
				}

			} <?php } ?>
			
		} <?php } ?>
	</script>
</body>
<script type="text/javascript">
	jQuery( document ).ready( function ( $ ) {
		$( '.dynamic-menu #newgallery' ).addClass( 'active' );
		$( '.dynamic-menu #gallery' ).addClass( 'active' );
		$( '.dynamic-menu #new' ).addClass( 'active' );
	} );
</script>

</html>