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
<?php 
if(isset($_GET['id']) && isset($_GET['action']) && $_GET['id']!='') 
{
	$arg['id'] = $_GET['id'];
	$news = $obj_fun->getRecord('news',$arg);
	
	$id = $news['id']; 
	$title = $news['title']; 
	$details = $news['details'];
	$yturl = $news['yturl'];
	$type = $news['type'];
}
else
{
	$id = ''; 
	$title = ''; 
	$details = '';
	$image = ''; 
	$yturl = '';
	$type = '';
	
}
?>
<body class="fixed-layout">
	<div class="container">
		<div class="sidebar">
			<?php include_once('sidebar.php');?>
		</div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
				<li class="active">News With Video</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>News With Video - ( for better resolution keep Image size <?php echo news_big_width;?> x <?php echo news_big_height;?> px )</h2>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
							<?php
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Save')
								{
									@extract($_POST);
									$arg['type'] = $type;
									$arg['title'] = $title;
									$arg['details'] =  htmlspecialchars($details);
									$arg['yturl'] = $yturl;
									
									$s_ins =  $obj_fun->insertRecords('news', $arg);
									if($s_ins > 0)
									{
										$arg_img['news_id'] = mysqli_insert_id();
										for($i=0; $i<$_POST['uploader_count'];$i++)
										{
											if($_POST['uploader_'.$i.'_status'] == 'done');
											{	
												$arg_img['name'] = $_POST['uploader_'.$i.'_tmpname'];
												$img =  $obj_fun->insertRecords('images', $arg_img);
												
											}
										}
										if($s_ins>0)
										{
											echo '<script>success("Vidio And It\'s Details Insert successfully.")</script>';
											echo "<script>urlRefresh('media-view.php', 3000);</script>";
										}
										else
											echo '<script>danger("Get error while updating Vidio And It\'s Detail  !")</script>';
									}
								}
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update')
								{
									@extract($_POST);
										$arg['type'] = $type;
									$arg['title'] = $title;
									$arg['details'] =  htmlspecialchars($details);
									$arg['yturl'] = $yturl;
									$cond['id'] = $n_id;
									$arg['date'] = $date;

									$s_ins =  $obj_fun->updateRecord('news', $arg, $cond);
									
									if($s_ins > 0)
									{
										$arg_img['news_id'] = $news['id'];
										for($i=0; $i<$_POST['uploader_count'];$i++)
										{
											if($_POST['uploader_'.$i.'_status'] == 'done');
											{	
												$arg_img['name'] = $_POST['uploader_'.$i.'_tmpname'];
												$img =  $obj_fun->insertRecords('images', $arg_img);
												
											}
										}
										if($s_ins>0)
										{
											echo '<script>success("Vidio And It\'s Detail Updated successfully")</script>';
											echo "<script>urlRefresh('media.php?action=edit&id=".$n_id."', 3000);</script>";
										}
										else
											echo '<script>danger("Get error while updating Vidio And It\'s Detail  !")</script>';
									}
								}
							?>
								<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return news_validate();" action="#">
									
									<input id="model_no" name="type" class="input-xxlarge" type="hidden" value="News-With-Video"/>
								
                                    <div class="control-group">
										<label class="control-label" for="input" style="width: 80px; text-align: left;">Title :</label>
										<div class="controls">
											<input id="model_no" name="title" class="input-xxlarge" type="text" value="<?php echo $title; ?>" />
										</div>
									</div>
                                    
									<!--<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Images :</label>
										<div class="controls">
											<div id="uploader"></div>
										</div>
									</div>-->
									
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Details :</label>
										<div class="controls">
											<textarea id="details" class="" rows="8" name="details"><?php echo $details; ?></textarea>
											<input id="date" name="date"  type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" />
										</div>
									</div>
                                    
                                    <div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Youtube Video Embedded Url</label>
										<div class="controls">
                                            <textarea id="yturl" name="yturl" class="input-xxlarge" type="text" rows="6" /><?php echo $yturl; ?></textarea>
                                            <p>Ex url pattern : https://www.youtube.com/watch?v=DubI8F5nlfQ </p>
										</div>
									</div>
                                    
									<div class="form-actions" style="padding: 15px 0px 0px;">
										<?php if( isset($_GET['action']) && $_GET['action'] == 'edit'){?>
										<input id="n_id" name="n_id" class="input-xxlarge" type="hidden" value="<?php echo $id; ?>" />
										
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Update" />
										<?php }else{?>
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Save" />
										<?php }?>
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			
			<?php 
			if(isset($news['id']) && $news['id'] !='')
			{
				$sql = "select * from images where news_id = ".$news['id']." order by id DESC";
				$gallery = $obj_fun->select_all_record($sql);
			}	
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
										$img = $obj_fun ->getLastRecords("select * FROM images WHERE id = '".$_POST['img_delete'][$i]."'");
										$rs = $obj_fun ->update_record("DELETE FROM images WHERE id = '".$_POST['img_delete'][$i]."'");
										if($rs>0)
										{
											if(isset($img['name']) && $img['name'] !='')
											{
												unlink('../uploads/media/thumbnails/'.$img['name']);	
												unlink('../uploads/media/'.$img['name']);	
											}
										}
									}
									header('location:media1.php?action=edit&id='.$_GET['id']);
								}
								else
								{
									echo "<script>danger('Please Select image for delete');</script>";
								}
							}
							?>
							<form class="form-gallery" action="#" method="post">
							
								<header>
									<h2>Infrastructure Photos</h2>
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
										<input type="checkbox" value="<?php echo $v['id']; ?>" class="checkbox1" id="img_delete[]" name="img_delete[]">
										<a title="Gallry Image" href="#" class="thumbnail"><img id="img_name" src="../uploads/media/thumbnails/<?php echo $v['name']; ?>" alt="Gallery Image"></a>
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
	<script type="text/javascript">
		$(function() {
			$("#uploader").plupload({
				// General settings
				runtimes : 'html5,flash,silverlight,html4',
				url : 'plupload/upload.php?folder=../../uploads/media&tw=<?php echo news_th_width; ?>&th=<?php echo news_th_height; ?>',
				// User can upload no more then 20 files in one go (sets multiple_queues to false)
				max_file_count: 2000,
				chunk_size: '1mb',
				unique_names : true,
				// Resize images on clientside if we can
				resize : {
					width : <?php echo news_big_width;?>, 
					height : <?php echo news_big_height;?>,
					quality : 95,
					crop: false // crop to exact dimensions
				},
				filters : {
					// Maximum file size
					max_file_size : '1000mb',
					// Specify what files to browse for
					mime_types: [
						{title : "Image files", extensions : "jpg,jpeg"}//,
						//{title : "Zip files", extensions : "zip"}
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
					//alert("You must have at least one file in the queue.");
					$('#form')[0].submit();
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
		function news_validate()
		{
			var valid = true;
			if(document.getElementById('model_no').value.replace(/^\s+/,'')=='')
			{
				document.getElementById('model_no').style.border="solid 1px #DD0000";
				document.getElementById('model_no').style.borderRadius="4px";
				document.getElementById('model_no').style.boxShadow="0px 0px 10px #BB0000";
				$.jGrowl("", {
					header: 'Please Insert Product Title',
					sticky: true,
					theme: 'danger'
				});
				valid = false;
			}
			return valid;
		}
	</script>
	<script type="text/javascript">
	 jQuery(document).ready(function($) {
	 	$('.dynamic-menu #m-media').addClass('active');
		$('.dynamic-menu #news').addClass('active');
		$('.dynamic-menu #enews').addClass('active');
	});
	</script>
</body>
</html>
