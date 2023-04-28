<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<html class="no-js" lang="en">
<?php ob_start(); ?>

<head>
	<?php 
	require_once('head.php'); 
	if(isset($_GET['id']) && $_GET['id'] !='')
	{
		$sql = "select * from certificate where id =".$_GET['id'];
		$catalogue_data = $obj_fun->getLastRecords($sql);
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
				<li class="active">Certificate</li>
			</ul>
			<div class="row-fluid" id="catalogue_form">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Update Certificate Pdf ( for better resolution keep Image size <?php echo certificate_th_width;?> x <?php echo certificate_th_height;?> px )</h2>
							<br>
							<br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<form id="myFormUpdate" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return catalogue_update_validate();" action="cprogress-update.php">
									<input type="hidden" name="id" value="<?php echo $catalogue_data['id']; ?>">

									<?php /*<div class="control-group">
										<label for="fileInput" class="control-label">Name</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="name" name="name" value="<?php echo (isset($catalogue_data['name']) && $catalogue_data['name'] !='' ? $catalogue_data['name'] : '');?>">
										</div>
									</div> */ ?>

									<?php /*<div class="control-group">
										<label for="fileInput" class="control-label">Menu</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="menu" name="menu" value="<?php echo (isset($catalogue_data['menu']) && $catalogue_data['menu'] !='' ? $catalogue_data['menu'] : '');?>">
										</div>
									</div>

									<div class="control-group">
										<label for="fileInput" class="control-label">Size</label>
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="size" name="size" value="<?php echo (isset($catalogue_data['size']) && $catalogue_data['size'] !='' ? $catalogue_data['size'] : '');?>">
										</div>
									</div> */ ?>


									
									<div class="control-group">
										<label for="fileInput" class="control-label">Image</label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span>
													<input type="file" name="image" id="image" required="">
													</span>
												</div>
											</div>
											<?php if(isset($catalogue_data) && $catalogue_data !=''){ ?>
											<img id="img_name" src="<?php echo (isset($catalogue_data['image']) && $catalogue_data['image'] !='' ? '../uploads/certificate/'.$catalogue_data['image'] : '');?>" style="float: right; width: auto; height: 60px;"/>
											<?php }?>
										</div>
										<input type="hidden" name="old_image" value="<?php echo  $catalogue_data['image']; ?>">
									</div>
									
									<!-- <div class="control-group">
										<label for="fileInput" class="control-label">Pdf</label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-alt btn-file"><span class="fileupload-new">Select PDF</span><span class="fileupload-exists">Change</span>
													<input type="file" name="pdf" id="pdf">
													</span>
												</div>
											</div>
											<label style="float: right; width: auto; height: 60px;"/>
											<?php echo (isset($catalogue_data['pdf']) && $catalogue_data['pdf'] !='' ? $catalogue_data['pdf'] : '');?>
											</label>
										</div>
									</div> -->
                                    
                                    	<div class="control-group">
										<label for="fileInput" class="control-label">Status</label>
										<div class="controls">
											<select id="select" name="status" required>
												<option value="1"<?php echo (isset($catalogue_data['status']) && $catalogue_data['status'] == 1) ? ' selected' : '' ?>>Enable</option>
														<option value="0"<?php echo (isset($catalogue_data['status']) && $catalogue_data['status'] == 0) ? ' selected' : '' ?>>Disable</option>
											</select>
										</div>
									</div>
                                    
									<input type="hidden" name="old_pdf" value="<?php  echo $catalogue_data['pdf']; ?>">
									<div class="form-actions">
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Update" style="float: left;"/>
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
		</div>
	</div>
	<?php include_once('script.php');?>
	<script>
		function catalogue_update_validate() {
			var valid = true;
			if ( document.getElementById( 'name' ).value.replace( /^\s+/, '' ) == '' ) {
				document.getElementById( 'name' ).style.border = "solid 1px #DD0000";
				document.getElementById( 'name' ).style.borderRadius = "4px";
				document.getElementById( 'name' ).style.boxShadow = "0px 0px 10px #BB0000";
				danger( 'Please fill the name field.' );
				valid = false;
			}
			if(document.getElementById( 'image' )){
				if ( document.getElementById( 'image' ).value.replace( /^\s+/, '' ) != '' ) {
					var fup = document.getElementById( 'image' );
					var fileName = fup.value;
					var ext = fileName.substring( fileName.lastIndexOf( '.' ) + 1 );
					if ( ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" ) {

					} else {
						danger( "Upload JPG images only" );
						valid = false;;
					}
				}
			}
			if(document.getElementById( 'pdf' )){
				if ( document.getElementById( 'pdf' ).value.replace( /^\s+/, '' ) != '' ) {
					var fup = document.getElementById( 'pdf' );
					var fileName = fup.value;
					var ext = fileName.substring( fileName.lastIndexOf( '.' ) + 1 );
					if ( ext == "PDF" || ext == "pdf" ) {

					} else {
						danger( "Upload PDF File only" );
						valid = false;;
					}
				}
			}

		}
	</script>
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

			$( '#myFormUpdate' ).ajaxForm( {
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
					success( "Certificate Updated successfully" )
					urlRefresh( 'certificate.php' );
				}
			} );

		} )();
	</script>
	<style>
		.progress {
			position: relative;
			width: 400px;
			border: 0;
			padding: 1px;
			border-radius: 3px;
			background-color: transparent;
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