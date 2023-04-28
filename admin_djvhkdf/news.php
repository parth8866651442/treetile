<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	if($obj_fun->getMetaData('news-with-one-image-and-detail') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
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
	$image = $news['image']; 
}
else
{
	$id = ''; 
	$title = ''; 
	$details = '';
	$image = ''; 
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
				<li class="active">News</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>News - ( for better resolution keep Image size <?php echo news_big_width;?> x <?php echo news_big_height;?> px )</h2>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
							<?php
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Save')
								{
									@extract($_POST);
									$errors=0;
									$rand = rand(5, 15);
									if (is_uploaded_file($_FILES['image']['tmp_name'])) 
									{
										$rand = rand(5, 15);
										$filename = stripslashes($_FILES['image']['name']);
										$i = strrpos($filename,".");
										$l = strlen($filename) - $i;
										$extension = substr($filename,$i+1,$l);
										$extension = strtolower($extension);
										if (($extension != "jpg") && ($extension != "jpeg")) 
										{
											echo "<p>Unknown Image extension.</p>";
											$errors=1;
										}
										else
										{
											
										
											$thumbDir = '../uploads/news';
									
											// Create target dir
											if (!file_exists($thumbDir)) {
												@mkdir($thumbDir);
											}
											
											$thumb_width=850; // Fix the width of the thumb nail images
											$thumb_height=405; // Fix the height of the thumb nail imaage
											
											$fileName = $rand.'_'.$_FILES["image"]["name"];
											$tsrc=$thumbDir . DIRECTORY_SEPARATOR . $fileName;; // Path where thumb nail image will be stored
											//echo $tsrc;
											
											$size=getimagesize($_FILES["image"]["tmp_name"]);
											$width=$size[0]; // Original picture width is stored
											$height=$size[1]; // Original picture height is stored
											
											$original_aspect = $width / $height;
											$thumb_aspect = $thumb_width / $thumb_height;
											 
											if ( $original_aspect >= $thumb_aspect )
											{
											// If image is wider than thumbnail (in aspect ratio sense)
											$new_height = $thumb_height;
											$new_width = $width / ($height / $thumb_height);
											}
											else
											{
											// If the thumbnail is wider than the image
											$new_width = $thumb_width;
											$new_height = $height / ($width / $thumb_width);
											}
											
											$newimage=imagecreatetruecolor($thumb_width,$thumb_height);
											
											if($_FILES['image']['type']=="image/jpeg" || $_FILES['image']['type']=="image/jpg"){
												$image = imagecreatefromjpeg($_FILES["image"]["tmp_name"]);
												
												imageCopyResized($newimage,$image,(0 - ($new_width - $thumb_width) / 2),(0 - ($new_height - $thumb_height) / 2),0,0,$thumb_width,$new_height,$width,$height);
												ImageJpeg($newimage,$tsrc);
											}
											/*if($_FILES['image']['type']=="image/png"){
												$image = imagecreatefrompng($_FILES["image"]["tmp_name"]);
												
												imageCopyResized($newimage,$image,(0 - ($new_width - $thumb_width) / 2),(0 - ($new_height - $thumb_height) / 2),0,0,$thumb_width,$new_height,$width,$height);
												ImagePng($newimage,$tsrc);
											}*/
												chmod("$tsrc",0777);
										}
											
									}
									if($errors ==0)
									{
										$arg['title'] = $title;
										$arg['type'] = "news-with-one-image-and-detail";
										$arg['details'] = htmlspecialchars($details);
										$arg['image'] = $rand.'_'.$_FILES['image']['name'];
										$s_ins =  $obj_fun->insertRecords('news', $arg);
										
										if($s_ins =='success')
										{
											echo '<script>success("New Insert successfully.")</script>';
											echo "<script>urlRefresh('news-view.php', 3000);</script>";
										}
										else
											echo '<script>danger("Get error while Insert news !")</script>';
									}
									else
										echo '<script>danger("Only JPEG Image Allowed !")</script>';
										
								}
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update')
								{
									@extract($_POST);
									$errors=0;
									if (is_uploaded_file($_FILES['image']['tmp_name'])) 
									{
										$rand = rand(5, 15);
										$filename = stripslashes($_FILES['image']['name']);
										$i = strrpos($filename,".");
										$l = strlen($filename) - $i;
										$extension = substr($filename,$i+1,$l);
										$extension = strtolower($extension);
										if (($extension != "jpg") && ($extension != "jpeg")) 
										{
											echo "<p>Unknown Image extension.</p>";
											$errors=1;
										}
										else
										{
											$thumbDir = '../uploads/news';
									
											// Create target dir
											if (!file_exists($thumbDir)) {
												@mkdir($thumbDir);
											}
											
											$thumb_width= news_big_width; // Fix the width of the thumb nail images
											$thumb_height= news_big_height; // Fix the height of the thumb nail imaage
											
											$fileName = $rand.'_'.$_FILES["image"]["name"];
											$tsrc=$thumbDir . DIRECTORY_SEPARATOR . $fileName;; // Path where thumb nail image will be stored
											//echo $tsrc;
											
											$size=getimagesize($_FILES["image"]["tmp_name"]);
											$width=$size[0]; // Original picture width is stored
											$height=$size[1]; // Original picture height is stored
											
											$original_aspect = $width / $height;
											$thumb_aspect = $thumb_width / $thumb_height;
											 
											if ( $original_aspect >= $thumb_aspect )
											{
											// If image is wider than thumbnail (in aspect ratio sense)
											$new_height = $thumb_height;
											$new_width = $width / ($height / $thumb_height);
											}
											else
											{
											// If the thumbnail is wider than the image
											$new_width = $thumb_width;
											$new_height = $height / ($width / $thumb_width);
											}
											
											$newimage=imagecreatetruecolor($thumb_width,$thumb_height);
											
											if($_FILES['image']['type']=="image/jpeg" || $_FILES['image']['type']=="image/jpg"){
												$image = imagecreatefromjpeg($_FILES["image"]["tmp_name"]);
												
												imageCopyResized($newimage,$image,(0 - ($new_width - $thumb_width) / 2),(0 - ($new_height - $thumb_height) / 2),0,0,$thumb_width,$new_height,$width,$height);
												ImageJpeg($newimage,$tsrc);
											}
											/*if($_FILES['image']['type']=="image/png"){
												$image = imagecreatefrompng($_FILES["image"]["tmp_name"]);
												
												imageCopyResized($newimage,$image,(0 - ($new_width - $thumb_width) / 2),(0 - ($new_height - $thumb_height) / 2),0,0,$thumb_width,$new_height,$width,$height);
												ImagePng($newimage,$tsrc);
											}*/
												chmod("$tsrc",0777);
										}
										
										$arg['image'] = $rand.'_'.$_FILES['image']['name'];	
										
										if(isset($old_img) && $old_img !='')
											unlink('../uploads/news/'.$old_img);
									}
									else
									{
										$arg['image'] = $old_img;
									}
									if($errors ==0)
									{
										//print_r($_POST);
										$arg['type'] = "news-with-one-image-and-detail";
										$arg['title'] = $title;
										$arg['details'] = htmlspecialchars($details);
										
										$cond['id'] = $n_id;
										$s_ins =  $obj_fun->updateRecord('news', $arg, $cond);
										
										if($s_ins =='success')
										{
											echo '<script>success("News Update successfully.")</script>';
											echo "<script>urlRefresh('news-view.php', 3000);</script>";
										}
										else
											echo '<script>danger("Get error while updating Series details !")</script>';
									}
									else
										echo '<script>danger("Only JPEG Image Allowed !")</script>';
										
								}
							?>
								<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return news_validate();" action="#">
									<div class="control-group">
										<label class="control-label" for="input" style="width: 80px; text-align: left;">News Title :</label>
										<div class="controls">
											<input id="model_no" name="title" class="input-xxlarge" type="text" value="<?php echo $title; ?>" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">News Images :</label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span><input type="file" name="image" id="image"></span>
												</div>
											</div>
										</div>
										<?php if( $image !=''){?>
										<img src="../uploads/news/<?php echo $image; ?>" style="float: right; width: 150px;" />
										<?php }?>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">News Details :</label>
										<div class="controls">
											<textarea id="details" class="" rows="8" name="details"><?php echo $details; ?></textarea>
										</div>
									</div>
									<div class="form-actions" style="padding: 15px 0px 0px;">
										<?php if( isset($_GET['action']) && $_GET['action'] == 'edit'){?>
										<input id="n_id" name="n_id" class="input-xxlarge" type="hidden" value="<?php echo $id; ?>" />
										<input id="old_img" name="old_img" class="input-xxlarge" type="hidden" value="<?php echo $image; ?>" />
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
					header: 'Please Insert News Title',
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
			$('.dynamic-menu #onews').addClass('active');
			$('.dynamic-menu #onew').addClass('active');
		});
	</script>
	
</body>
</html>
