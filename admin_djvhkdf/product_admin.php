<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	/*if($obj_fun->getMetaData('news-with-multiple-image-and-detail') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); */
?>
</head>
<?php 
if(isset($_GET['id']) && isset($_GET['action']) && $_GET['id']!='') 
{
	$arg['id'] = $_GET['id'];
	$products = $obj_fun->getRecord('product_other_admin_panel',$arg);
	
	$id = $products['id']; 
	$title = $products['title']; 
	$details = $products['details'];
	$parentdir =$products['parentdir'];
}
else
{
	$id = ''; 
	$title = ''; 
	$details = '';
	$image = ''; 
	$parentdir = '0';
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
				<li class="active">Product</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Product - ( for better resolution keep Image size <?php echo news_big_width;?> x <?php echo news_big_height;?> px )</h2>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
							<?php
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Save')
								{
									@extract($_POST);
									
									$arg['title'] = $title;
									$arg['parentdir'] = $parentdir;
									$arg['details'] =  $details;
									
									$s_ins =  $obj_fun->insertRecords('product_other_admin_panel', $arg);
									if($s_ins > 0)
									{
										 $selectProductId = "SELECT id FROM product_other_admin_panel order by id DESC limit 1";
										$productId[] = $obj_fun->getRecords($selectProductId);

										$arg_img['product_id'] = $productId[0][0][0];
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
											echo '<script>success("Product Insert successfully.")</script>';
											echo "<script>urlRefresh('product_admin.php', 3000);</script>";
										}
										else
											echo '<script>danger("Get error while updating Series details !")</script>';
									}
								}
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update')
								{
									@extract($_POST);
									
									$arg['title'] = $title;
									
									$arg['parentdir'] = $parentdir;
									$arg['details'] =  $details;
									
									$cond['id'] = $n_id;
									$s_ins =  $obj_fun->updateRecord('product_other_admin_panel', $arg, $cond);
									
									
									if($s_ins > 0)
									{
										$arg_img['product_id'] = $products['id'];
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
											echo '<script>success("Product Update successfully.")</script>';
											echo "<script>urlRefresh('product_admin.php?action=edit&id=".$n_id."', 3000);</script>";
										}
										else
											echo '<script>danger("Get error while updating Series details !")</script>';
									}
								}
							?>
								<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return products_validate();" action="#">
									<div class="control-group">
										<label class="control-label" for="input" style="width: 80px; text-align: left;">Title :</label>
										<div class="controls">
											<input id="model_no" name="title" class="input-xxlarge" type="text" value="<?php echo $title; ?>" />
										</div>
									</div>
                                    
                                   
                                    
                                    <div class="control-group">
										<label class="control-label" for="input" style="width: 80px; text-align: left;">Select Main Category</label>
										<div class="controls">
                                        
										<select class="form-control" name="parentdir">
                                        <option value="0">Main Category</option>
											<?php
											$sql = "SELECT id,title FROM `product_other_admin_panel` WHERE status = '1' and parentdir = '0' ";
											$product = $obj_fun->getRecords($sql);
											?>
												<?php if(count($product) > 0 && $product != ''){ 
												foreach($product as $p){ ?>
													<option value="<?php echo $p['id']; ?>" <?php echo ($p['id'] == $parentdir) ? 'selected' : ''; ?> ><?php echo $p['title']; ?></option>
													
												<?php } ?>
											<?php } ?>
                                        </select>
                                		</div>
									</div>
                                    
                                    
                                    
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Images :</label>
										<div class="controls">
											<div id="uploader"></div>
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Details :</label>
										<div class="controls">
											<textarea id="details" class="" rows="8" name="details"><?php echo $details; ?></textarea>
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
			if(isset($products['id']) && $products['id'] !='')
			{
				$sql = "select * from images where product_id = ".$products['id']." order by id DESC";
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
									header('location:product_admin.php?action=edit&id='.$_GET['id']);
								}
								else
								{
									echo "<script>danger('Please Select image for delete');</script>";
								}
							}
							?>
							<form class="form-gallery" action="#" method="post">
							
								<header>
									<h2>Product Photos</h2>
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
						{ name: 'document', items: [ 'Source' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
						{ name: 'basicstyles', items: [ 'Bold', 'Italic','Strike','Subscript','Superscript' ] },
						{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
						{ name: 'links', items: [ 'Link', 'Unlink' ] },
						{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule' ] },
						{ name: 'styles', items: [ 'Styles', 'Format'] }
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
				max_file_count: 20,
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
		function products_validate()
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
</body>
</html>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #product_admin_other').addClass('active');
		$('.dynamic-menu #p_a_new').addClass('active');
	});
</script>