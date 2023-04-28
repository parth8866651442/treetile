<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	if($obj_fun->getMetaData('headerimage') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
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
				<li class="active">Header Image</li>
			</ul>
			<?php
			if(isset($_GET['id']) && $_GET['id'] !='')
			{
				$sql = "select * from series where id =".$_GET['id'];
				$header_image_data = $obj_fun->getLastRecords($sql);
			}
			?>
			<div class="row-fluid" id="catalogue_form">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							
							<h2>Update Header Image ( for better resolution keep Image size <?php echo headerimage_th_width;?> x <?php echo headerimage_th_height;?> px )</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
							<form id="myFormUpdate" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return catalogue_update_validate();" action="progress_series-headerimage-update.php">
									<div class="control-group" >
										<label for="fileInput" class="control-label" >Category Name</label>	
										<div class="controls">
											<p style="margin-top:5px;"><?php $catt = $obj_fun->getCategoryBySizeId($header_image_data['product_size_id']);  echo $catt[0]['size']; ?></p>
											<input type="hidden" class="input-xxlarge" id="cat_id" name="id" value="<?php echo $header_image_data['id'];?>">
											<input type="hidden" class="input-xxlarge" id="old_image" name="old_image" value="<?php echo (isset($header_image_data['header_image']) && $header_image_data['header_image'] !='' ? $header_image_data['header_image'] : '');?>">
											
										</div>
									</div>
                                    
                                    <div class="control-group" >
										<label for="fileInput" class="control-label" >Series Name</label>	
										<div class="controls">
											<p style="margin-top:5px;"><?php echo (isset($header_image_data['series_name']) && $header_image_data['series_name'] !='' ? $header_image_data['series_name'] : '');?></p>	
										</div>
									</div>
                                    
									<div class="control-group">
										<label for="fileInput" class="control-label">Image</label>
										<div class="controls">
										
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span><input type="file" name="image" id="image"></span>
												</div>
											</div>
											<?php if($header_image_data['header_image'] != ''){ ?>
											<img id="img_name" alt="No Image Found" src="<?php echo (isset($header_image_data['header_image']) && $header_image_data['header_image'] !='' ? '../uploads/headerimage/'.$header_image_data['header_image'] : '');?>" style="float: right; width: auto; height: 60px;" />
											<?php } else { ?>
											
											<img src="img/no-image.jpg" style="float: right; width: auto; height: 60px;"> <?php } ?>
										</div>
										
									</div>
									<div class="form-actions">
									
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Update" style="float: left;" />
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
	function catalogue_update_validate()
	{

		var valid = false;
		if(document.getElementById('image').value.length < 5)
		{
			alert("Select The Image First.");
		}
		if(document.getElementById('image').value.replace(/^\s+/,'')!='')
		{	
			
			var fup = document.getElementById('image');
		 	var fileName = fup.value;
			 var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG")
			{
				valid =  true;
			}        
			else
			{
				danger("Upload JPG images only");
				valid =  false;;
		   	}
		}
		return valid;
	}
	</script>
	<script>
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

<script src="progress/jquery_002.js"></script>
<script>
(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
   
$('#myFormUpdate').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function() {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
	complete: function(xhr) {
		//status.html(xhr.responseText);
		success("Header Image Insert successfully")
		urlRefresh('header_image.php');
	}
}); 

})();       
</script>
<style>
.progress { position:relative; width:400px; border: 0; padding: 1px; border-radius: 3px;background-color: transparent; }
.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>

</body>
</html>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #header_image').addClass('active');
	});
</script>