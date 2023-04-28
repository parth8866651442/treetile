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
	$folder = '../uploads/exportpdf/';
	if (!file_exists($folder)) {
			@mkdir($folder, 0777, true);
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
				<li class="active">Export</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Add Export Pdf</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<form id="myForm" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return catalogue_validate();" action="eprogress.php">
									<?php /*<div class="control-group">
										<label for="fileInput" class="control-label">Name</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="name" name="name">
										</div>
									</div>

									
                                    
                                   	<div class="control-group">
										<label for="fileInput" class="control-label">Menu</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="menu" name="menu">
										</div>
									</div>

									<div class="control-group">
										<label for="fileInput" class="control-label">Size</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="size" name="size">
										</div>
									</div>
                                    

									
									
									<?php if($obj_fun->getMetaData('catalogueimg') == 1){ ?>
									<div class="control-group">
										<label for="fileInput" class="control-label">Image</label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span><input type="file" name="image" id="image">
													</span>
												</div>
											</div>
										</div>
									</div>
									<?php } */?>

									<div class="control-group">
										<label for="fileInput" class="control-label">Pdf</label>
										<div class="controls">

											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select PDF</span><span class="fileupload-exists">Change</span><input type="file" name="pdf" id="pdf">
													</span>
												</div>
											</div>

										</div>
									</div>
									<div class="control-group">
										<label for="fileInput" class="control-label">Status</label>
										<div class="controls">
											<select id="select" name="status" required>
												<option value="1">Enable</option>
												<option value="0">Disable</option>
											</select>
										</div>
									</div>

									<div class="form-actions">
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Create" style="float: left;"/>
										<div style="margin: 7px 85px;">
											<div class="progress">
												<div class="bar"></div>
												<div class="percent"></div>
											</div>
											<div id="status"></div>
										</div>
									</div>
								</form>

							</div>
						</section>
					</div>
				</article>
			</div>
			<?php $cat = $obj_fun->getExportPdf();
				if(isset($cat) && $cat !=''){
			?>
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						<?php
						if ( isset( $_POST[ 'delete' ] ) && $_POST[ 'delete' ] != '' ) {
							if ( isset( $_POST[ 'cat_delete' ] ) && $_POST[ 'cat_delete' ] != '' ) {
								for ( $i = 0; $i < count( $_POST[ 'cat_delete' ] ); $i++ ) {
									$obj_fun->deleteCatalogue( $_POST[ 'cat_delete' ][ $i ] );
									header( 'location:catalogue.php' );
								}
							} else {
								echo "<script>danger('Please Select image for delete');</script>";
							}
						}
						?>
						<form class="form-gallery" action="#" method="post">

							<header>
								<h2>Export</h2>
								<ul class="data-header-actions tabs">
									<li class="demoTabs active"><input type="submit" name="delete" id="delete" value="Delete" onClick="return deleteAlert();" class="btn btn-alt btn-primary"/>
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
												<?php /*<th>Name</th>
												<th>Menu</th>
												<th>Size</th>
												<?php if($obj_fun->getMetaData('catalogueimg') == 1){ ?>
												<th>Image</th>
												<?php } */?>
												<th>PDF</th>
												<th>Status</th>
												<th>Counter</th>
												<th>Action</th>
												<th>Drag & Drop</th>
											</tr>
										</thead>
										<tbody>
											<?php 
													$i=1;
													foreach($cat as $v)
													{
														$menuname = "select * from menu where id=".$v['menu'];
														$menuname = $obj_fun->getLastRecords($menuname);
														
													?>
											<tr class="odd gradeX" id="<?php echo $v['id']; ?>">
												<td><input type="checkbox" value="<?php echo $v['id']; ?>" class="checkbox1" id="cat_delete" name="cat_delete[]">
												</td>
												<?php /*<td>
													<?php echo $v['name']; ?>
												</td>
												<td><?php echo $v['menu']; ?></td>
												<td><?php echo $v['size']; ?></td>
                                                <?php if($obj_fun->getMetaData('catalogueimg') == 1){ ?>
												<td><img src="../uploads/catalogue/<?php echo $v['image']; ?>" style="width: 170px;"/>
												</td>
												<?php } */?>
												<td align="center">
													<a href="../uploads/exportpdf/<?php echo $v['pdf']; ?>" target="_blank" class="btn btn-alt btn-primary">View</a>
												</td>
												<td>
													<?php 
														if($v['status'] == 0){ 
															echo '<span class="fam-cross"></span>';
														}else{
															echo '<span class="fam-tick"></span>';
															}
													?>
												</td>
												<td>
													<?php echo $v['counter']; ?>
												</td>
												<td align="center">
													<a href="exportpdf-update.php?id=<?php echo $v['id']; ?>" class="btn btn-alt btn-primary">Edit</a>
												</td>
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
		function deleteAlert() {
			return x = confirm( "Are you sure want to delete!" );
		}

		function catalogue_validate() {
			var valid = true;
			if ( document.getElementById( 'name' ).value.replace( /^\s+/, '' ) == '' ) {
				document.getElementById( 'name' ).style.border = "solid 1px #DD0000";
				document.getElementById( 'name' ).style.borderRadius = "4px";
				document.getElementById( 'name' ).style.boxShadow = "0px 0px 10px #BB0000";
				danger( 'Please fill the name field.' );
				valid = false;
			}
			
			if(document.getElementById( 'menu' )){
				if ( document.getElementById( 'menu' ).value.replace( /^\s+/, '' ) == '' ) {
					danger( 'Please select Menu field.' );
					valid = false;
				}	
			}
			
			if(document.getElementById( 'size' )){
				if ( document.getElementById( 'size' ).value.replace( /^\s+/, '' ) == '' ) {
					danger( 'Please select Size field.' );
					valid = false;
				}
			}

			if(document.getElementById( 'image' )){
				if ( document.getElementById( 'image' ).value.replace( /^\s+/, '' ) == '' ) {
					danger( 'Please Select the image field.' );
					valid = false;
				} else {
					var fup = document.getElementById( 'image' );
					var fileName = fup.value;
					var ext = fileName.substring( fileName.lastIndexOf( '.' ) + 1 );
					if ( ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" ) {
						//valid =  true;
						if ( fup.files[ 0 ].size > 3145728 ) // 3MB = 1024*1024*3
						{
							danger( "Image File too large. File must be less than 3MB." );
							valid = false;
						}

					} else {
						danger( "Upload JPG images only" );
						valid = false;
					}

				}
			}

			if ( document.getElementById( 'pdf' ).value.replace( /^\s+/, '' ) == '' ) {
				danger( 'Please select pdf field.' );
				valid = false;
			} else {
				var fup = document.getElementById( 'pdf' );
				var fileName = fup.value;
				var ext = fileName.substring( fileName.lastIndexOf( '.' ) + 1 );
				if ( ext == "PDF" || ext == "pdf" ) {
					
				} else {
					danger( "Upload PDF File only" );
					valid = false;
				}

			}
			return valid;
		}
	</script>
	<style>
		.row-fluid .span2.gallery {
			margin: 10px;
		}
	</style>

	<script src="progress/jquery_002.js"></script>
	<script>
		( function () {

			var bar = $( '.bar' );
			var percent = $( '.percent' );
			var status = $( '#status' );

			$( '#myForm' ).ajaxForm( {
				beforeSend: function () {
					status.empty();
					var percentVal = '0%';
					bar.width( percentVal )
					percent.html( percentVal );
				},
				uploadProgress: function ( event, position, total, percentComplete ) {
					var percentVal = percentComplete + '%';
					bar.width( percentVal )
					percent.html( percentVal );
				},
				success: function () {
					var percentVal = '100%';
					bar.width( percentVal )
					percent.html( percentVal );
				},
				complete: function ( xhr ) {
					//status.html(xhr.responseText);
					success( "Catalogue Insert successfully" )
					pageRelode();
				}
			} );

		} )();
	</script>
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
		$( '.dynamic-menu #catalogue' ).addClass( 'active' );
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
				}
				$.post( "custom-ajax.php", {
					action: 'catalogue_order_change',
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
<?php if($obj_fun->getMetaData('cataloguemenu') == 1){ ?>
<script>
	function getSize( id ) {
		if ( id != "" ) {
			$.ajax( {
				url: "ajax_get_size.php",
				type: 'post',
				data: "ajax:true&id=" + id,
				success: function ( data ) {
					if ( data == 0 ) {
						alert( "something went wrong." );
					} else {
						$( ".size-dropdown" ).empty();
						$( ".size-dropdown" ).html( data );
					}
				}
			} );
		} else {
			alert( "something went wrong." );
		}
	}
</script>
<?php } ?>