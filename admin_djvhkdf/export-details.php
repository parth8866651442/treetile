<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
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
				<li class="active">Export Details</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Export Details</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
								if(isset($_POST['submit_export_details']))
								{
									unset($_POST['submit_export_details']);
									
									$resss = $obj_fun->add_MetaData('export', $_POST);
									if($resss>0)
										echo "<script>window.location.href = 'export-details.php'</script>";
								}?>
								<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="#">
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Details Table:</label>
										<div class="controls">
											<textarea id="export_packing" class="" rows="8" name="export_packing"><?php echo $obj_fun->getMetaData('export_packing'); ?></textarea>
										</div>
									</div>
									<div class="controls form-actions" style="padding: 15px 0px 0px;">
										<input name="submit_export_details" id="submit_export_details" class="btn btn-alt btn-large btn-primary" type="submit" value="Update Export Details" />
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
	<script type="text/javascript">
		 	jQuery(document).ready(function($) {
		 	$('.dynamic-menu #export').addClass('active');
		});
	</script>
		<script src="ckeditor/ckeditor.js"></script>
		<script src="ckeditor/adapters/jquery.js"></script>
		<script>
			CKEDITOR.disableAutoInline = true;
			$( document ).ready( function() {
				CKEDITOR.replace( 'export_packing',
				{
					toolbar: [
						{ name: 'document', items: [ 'Source' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
						{ name: 'basicstyles', items: [ 'Bold', 'Italic','Strike' ] },
						{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
						{ name: 'links', items: [ 'Link', 'Unlink' ] },
						{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule' ] },
						{ name: 'styles', items: [ 'Styles', 'Format'] }
					]
				});
			});
		</script>
</body>
</html>
<style>
.res-table table{
	width:100%;
}
.table-100 table
{
	width:100%;
}
</style>