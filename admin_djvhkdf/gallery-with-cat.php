<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	if($obj_fun->getMetaData('gallery') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
	
	if(isset($_GET['type']) && $_GET['type'] != '')
		$type =  $_GET['type'] ;
	else
		header('location:index.php'); 
?>
</head>
<body class="fixed-layout">
	<div class="container">
		<div class="sidebar"><?php include_once('sidebar.php');?></div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
				<li class="active"><?php echo $type;?></li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Add <?php echo $type;?> ( for better resolution keep Image size <?php echo gallery_big_width;?> x <?php echo gallery_big_height;?> px )</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
							<?php
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Create')
								{
									for($i=0; $i<$_POST['uploader_count'];$i++)
									{
										if($_POST['uploader_'.$i.'_status'] == 'done');
										{	
											$image = $_POST['img_path'].'/'.$_POST['uploader_'.$i.'_tmpname'];
											$thumb = $_POST['img_path'].'/thumbnails/'.$_POST['uploader_'.$i.'_tmpname'];
											$res = $obj_fun->insertGallery($type,$image,$thumb);
											
											header('location:gallery.php?type='.$type);
										}
									}
								}
							?>
								<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="#">
									<input type="hidden" name="img_path" id="img_path" value="uploads/<?php echo $type;?>" />
									<div class="control-group">
										<div id="uploader"></div>
									</div>
									<div class="form-actions" style="padding-left:15px;">
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Create" />
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php 
				$gallery = $obj_fun->getGallery($type);
					if(isset($gallery) && $gallery !=''){
			?>				
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						<?php
						if(isset($_POST['delete']) && $_POST['delete'] !='')
						{
							if(isset($_POST['img_delete']) && $_POST['img_delete'] !='')
							{
								for($i=0; $i < count($_POST['img_delete']); $i++)
								{
									$obj_fun ->deleteGallery($_POST['img_delete'][$i]);
								}
								header('location:gallery.php?type='.$type);
							}
							else
							{
								echo "<script>danger('Please Select image for delete');</script>";
							}
						}
						?>
						<form class="form-gallery" action="#" method="post">
						
							<header>
								<h2><?php echo $type;?> Photos</h2>
								<ul class="data-header-actions tabs">
									<li class="demoTabs active">
										<input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" />
										<a href="#">Check All</a>
									</li>
									<li class="demoTabs"><input type="submit" name="delete" id="delete" value="Delete" class="btn btn-alt btn-primary" /></li>
								</ul>
								<!--<ul class="data-header-actions ">
									<li class=""><div class="span1">1</div><input type="checkbox" value="Check All" id="selecctall" name="selecctall" class="btn btn-alt btn-primary" /></li>
									<li class=""><input type="submit" name="delete" id="delete" value="Delete" class="btn btn-alt btn-primary" /></li>
								</ul>-->
							</header>
							<section>
							<ul class="thumbnails">
							<?php
								foreach($gallery as $v){
							?>
								<li id="1" class="span2 gallery">
									<input type="hidden" value="<?php echo $v['image']; ?>" id="old_img_<?php echo $v['id']; ?>" name="old_img_<?php echo $v['id']; ?>" />
									<input type="hidden" value="<?php echo $v['thumb']; ?>" id="old_thumb_<?php echo $v['id']; ?>" name="old_thumb_<?php echo $v['id']; ?>" />
										
									<input type="checkbox" value="<?php echo $v['id']; ?>" class="checkbox1" id="img_delete[]" name="img_delete[]">
									<a title="Gallry Image" href="#" class="thumbnail"><img id="img_name" src="../<?php echo $v['thumb']; ?>" alt="Gallery Image"></a>
								</li>
								<?php }?>
							</ul>
							</section>
						</form>
					</div>
				</article>
			</div>
			<?php }?>
		</div>
	</div>
	<?php include_once('script.php');?>
	<script type="text/javascript">
	// Initialize the widget when the DOM is ready
	$(function() {
		$("#uploader").plupload({
			// General settings
			runtimes : 'html5,flash,silverlight,html4',
			url : 'plupload/upload.php?folder=../../uploads/<?php echo $type;?>&tw=<?php echo gallery_th_width;?>&th=<?php echo gallery_th_height;?>',
	
			// User can upload no more then 20 files in one go (sets multiple_queues to false)
			max_file_count: 20,
			
			chunk_size: '1mb',
			unique_names : true,
			// Resize images on clientside if we can
			resize : {
				width : <?php echo gallery_big_width;?>, 
				height : <?php echo gallery_big_height;?>,
				quality : 90,
				crop: false	  // crop to exact dimensions
			},
			
			filters : {
				// Maximum file size
				max_file_size : '1000mb',
				// Specify what files to browse for
				mime_types: [
					{title : "Image files", extensions : "jpg,jpeg"},
					{title : "Zip files", extensions : "zip"}
				]
			},
	
			// Rename files by clicking on their titles
			rename: true,
			
			// Sort files
			sortable: true,
	
			// Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
			dragdrop: true,
	
			// Views to activate
			views: {
				list: true,
				thumbs: true, // Show thumbs
				active: 'thumbs'
			},
	
			// Flash settings
			flash_swf_url : 'plupload/js/Moxie.swf',
	
			// Silverlight settings
			silverlight_xap_url : 'plupload/js/Moxie.xap'
		});
	
	
		// Handle the case when form was submitted before uploading has finished
		$('#form').submit(function(e) {
			// Files in queue upload them first
			if ($('#uploader').plupload('getFiles').length > 0) {
	
				// When all files are uploaded submit form
				$('#uploader').on('complete', function() {
					$('#form')[0].submit();
				});
	
				$('#uploader').plupload('start');
			} else {
				alert("You must have at least one file in the queue.");
			}
			return false; // Keep the form from submitting
		});
	});
	
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
	.row-fluid .span2.gallery{
		margin:10px;
	}
	</style>
</body>
</html>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #gallery').addClass('active');
		$('.dynamic-menu #<?php echo str_replace(' ', '', $type);?>').addClass('active');
	});
</script>