<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	if($obj_fun->getMetaData('catalogue') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
		/*echo '<script>alert("update");</script>';*/
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
				<li class="active">E-catalogue</li>
			</ul>
			<?php
			if(isset($_GET['id']) && $_GET['id'] !='')
			{
				$sql = "select * from catalogue where id =".$_GET['id'];
				$catalogue_data = $obj_fun->getLastRecords($sql);
			}
			?>
			<div class="row-fluid" id="catalogue_form">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							
							<h2>Update Catalogue </h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
							<form id="myFormUpdate" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return catalogue_update_validate();" action="progress-update.php">
                            		<input type="hidden" name="id" value="<?php echo $catalogue_data['id']; ?>">
									<div class="control-group" >
										<label for="fileInput" class="control-label" >Name</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="name" name="name" value="<?php echo (isset($catalogue_data['name']) && $catalogue_data['name'] !='' ? $catalogue_data['name'] : '');?>">										</div>
										
                                            </div>
                                                <?php if($obj_fun->getMetaData('catalogue_product') == 1){?>     
                                            <?php 
									$sql ="SELECT * FROM `menu`";
									$p_menu = $obj_fun->getRecords($sql);
									
									if(isset($p_menu) && $p_menu !=''){  ?>
									<div class="control-group" >
										<label for="fileInput" class="control-label" >Size</label>	
										<div class="controls">
											<select id="size" name="size">
											<?php foreach($p_menu as $k => $p){ 
													if($catalogue_data['size'] == $p['name']){
											?>
                                            <option value="<?php echo $p['name'] ?>"  selected><?php echo $p['name']; ?></option>
                                            <?php }else{?>
                                            <option value="<?php echo $p['name'] ?>" ><?php echo $p['name']; ?></option>
                                            <?php }?>
											
											<?php }?>
											</select>
										</div>
									
									<?php } ?>
									
                                  
											<input type="hidden" class="input-xxlarge" id="cat_id" name="cat_id" value="<?php echo $catalogue_data['id'];?>">
                                            
											<?php /*<input type="hidden" class="input-xxlarge" id="old_image" name="old_image" value="<?php echo (isset($catalogue_data['image']) && $catalogue_data['image'] !='' ? $catalogue_data['image'] : '');?>">*/ ?>
											<input type="hidden" class="input-xxlarge" id="old_pdf" name="old_pdf" value="<?php echo (isset($catalogue_data['pdf']) && $catalogue_data['pdf'] !='' ? $catalogue_data['pdf'] : '');?>">
										</div>
									
							<?php } ?>
                            		<?php /*
									<div class="control-group">
										<label for="fileInput" class="control-label">Image</label>
										<div class="controls">
										
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span><input type="file" name="image" id="image"></span>
												</div>
											</div>
											<?php if(isset($catalogue_data) && $catalogue_data !=''){ ?>
											<img id="img_name" src="<?php echo (isset($catalogue_data['image']) && $catalogue_data['image'] !='' ? '../uploads/catalogue/'.$catalogue_data['image'] : '');?>" style="float: right; width: auto; height: 60px;" />
											<?php }?>
										</div>
                                        <input type="hidden" name="old_image" value="<?php echo  $catalogue_data['image']; ?>">
                                        
										
									</div>*/?>
									<div class="control-group">
										<label for="fileInput" class="control-label">Pdf</label>
										<div class="controls">
										
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select PDF</span><span class="fileupload-exists">Change</span><input type="file" name="pdf" id="pdf"></span>
												</div>
											</div>
											<label style="float: right; width: auto; height: 60px;" /><?php echo (isset($catalogue_data['pdf']) && $catalogue_data['pdf'] !='' ? $catalogue_data['pdf'] : '');?></label>
                                              
                                        
										</div>
									</div>
                                    <input type="hidden" name="old_pdf" value="<?php  echo $catalogue_data['pdf']; ?>">
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
		var valid = true;
		if(document.getElementById('name').value.replace(/^\s+/,'')=='')
		{
			document.getElementById('name').style.border="solid 1px #DD0000";
			document.getElementById('name').style.borderRadius="4px";
			document.getElementById('name').style.boxShadow="0px 0px 10px #BB0000";
			danger('Please fill the name field.');
			valid = false;
		}
		/*if(document.getElementById('image').value.replace(/^\s+/,'')!='')
		{
			var fup = document.getElementById('image');
		 	var fileName = fup.value;
			 var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG")
			{
				//valid =  true;
			}        
			else
			{
				danger("Upload JPG images only");
				valid =  false;;
		   	}
		}*/
		if(document.getElementById('pdf').value.replace(/^\s+/,'')!='')
		{
			var fup = document.getElementById('pdf');
		 	var fileName = fup.value;
			 var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(ext == "PDF" || ext == "pdf")
			{
				//valid =  true;
			}        
			else
			{
				danger("Upload PDF File only");
				valid =  false;;
		   	}
		}
		//return valid;
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
		success("Catalogue Updated successfully")
		urlRefresh('catalogue.php');
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
		$('.dynamic-menu #catalogue').addClass('active');
	});
</script>