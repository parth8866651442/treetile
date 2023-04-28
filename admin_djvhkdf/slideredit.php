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
				$slider = "select * from gallery where id =".$_GET['id'];
				$catalogue_data = $obj_fun->getLastRecords($slider);
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
				<li>Image Gallery</li>
				<li class="active">Slider</li>
			</ul>
			<div class="row-fluid" id="catalogue_form">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Update Slider Photos ( for better resolution keep Image size <?php echo slider_big_width;?> x <?php echo slider_big_height;?> px )</h2>
							<br>
							<br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<form id="myFormUpdate" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return catalogue_update_validate();" action="slider-progress.php">
									<input type="hidden" name="id" value="<?php echo $catalogue_data['id']; ?>">
					
									<!-- <div class="control-group" >
										<label for="fileInput" class="control-label" >Menu</label>	
										<div class="controls" style="margin-left: 180px;">
											
											<input type="text" class="input-xxlarge" id="menu" name="menu" value="<?php echo $catalogue_data['menu']; ?>">
										</div>
									</div> -->

									
									
									
									<div class="control-group">
										<label for="fileInput" class="control-label">Image</label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span>
													<input type="file" name="image" id="image">
													</span>
												</div>
											</div>
											<?php $img =  str_replace('','',$catalogue_data['image']); ?>
											<img id="img_name" src="../<?php echo $img;?>" style="float: right; width: auto; height: 60px;"/>

										</div>
										<input type="hidden" name="old_image" value="<?php echo $catalogue_data['image']; ?>">
									</div>
									
									
                                     <?php if($obj_fun->getMetaData('slidertext') == 1){ ?>
                                    <div class="control-group">
										<label for="fileInput" class="control-label">Description</label>
										<div class="controls">
											<textarea name="description" cols="4" rows="6" class="input-xlarge" spellcheck="true"><?php echo  $catalogue_data['description']; ?></textarea>			</div>
									</div>
                                    <?php } ?>
                                    <?php if($obj_fun->getMetaData('slider_url') == 1){ ?>
                                    
                                     <div class="control-group" >
                                      <label for="fileInput" class="control-label">Add URL</label>
                                      <div class="controls" style="margin-left: 180px;">
                                        <input type="text" class="input-xxlarge" id="url" name="url" value="<?php echo  $catalogue_data['url']; ?>">
                                      </div>
                                     </div>
                                    <?php } ?>
                                    
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
					
					success( "Slider Updated successfully" )
					urlRefresh( 'slider.php' );
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
<script src="ckeditor/ckeditor.js"></script>
		<script src="ckeditor/adapters/jquery.js"></script>
		<script>
			CKEDITOR.disableAutoInline = true;
			$( document ).ready( function() {
				CKEDITOR.replace( 'description',
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