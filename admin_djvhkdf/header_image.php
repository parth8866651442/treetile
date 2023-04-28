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
    <div class="row-fluid"  style="margin-bottom:0px !important;">
      <div class="data-container">
        <h2>Add Header Image ( for better resolution keep Image size <?php echo headerimage_th_width; ?> x <?php echo headerimage_th_height; ?> px )</h2>
      </div>
    </div>
    <?php $cat = $obj_fun->getHeaderImage();
	
				if(isset($cat) && $cat !=''){
			?>
    <div class="row-fluid">
      <article class="span12 data-block">
        <div class="data-container">
          <?php
							if(isset($_POST['delete']) && $_POST['delete'] !='')
							{
								if(isset($_POST['cat_delete']) && $_POST['cat_delete'] !='')
								{
									for($i=0; $i < count($_POST['cat_delete']); $i++)
									{
										$obj_fun ->deleteHeaderImage($_POST['cat_delete'][$i]);
										header('location:heade_image.php');
									}
								}
								else
								{
									echo "<script>danger('Please Select image for delete');</script>";
								}
							}
							?>
          <form class="form-gallery" action="#" method="post">
            <header>
              <h2>Header Image Category</h2>
            </header>
            <section>
              <div class="tab-pane" id="dynamic">
                <table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
                  <thead>
                    <tr>
                      <th>No.</th>
					  <th>Menu Name</th>
                      <th>Category Name</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
													$i=1;
													
													foreach($cat as $v){
													?>
                    <tr class="odd gradeX" id="<?php echo $v['id']; ?>">
                      <td><?php echo $i; ?></td>
					  <td>
						  <?php 
								$mname = "SELECT * FROM `menu` where id=".$v['menu_id'];
								$resmname =$obj_fun->getLastRecords($mname);
								echo $resmname['name']; 
						  ?>
					  </td>
                      <td><?php echo $v['size']; ?></td>
					  <td>
						  <?php
								$img ='';
								if($v['header_image'] != '')
								{
									$img ='../uploads/headerimage/'.$v['header_image']; 
								}
								else
								{
									$img ='img/no-image.jpg';
								}
						  ?>
						  <img src="<?php echo $img; ?>" alt="No Image Found." style="width: 100px;" /></td>
                      <td align="center"><a href="headerimage-update.php?id=<?php echo $v['id']; ?>" class="btn btn-alt btn-primary" ><span class="awe-edit"></span></a>
                        <?php if($v['header_image'] != ''){ ?>
                        <a href="#" class="btn btn-alt btn-danger" onClick="return deleteHeaderImage(<?php echo $v['id']; ?>);"> <span class="awe-remove"></span></a>
                        <?php } ?></td>
                    </tr>
                    <?php $i++; }?>
                  </tbody>
                </table>
              </div>
            </section>
          </form>
          <?php          
                        $totalseries = $obj_fun->getSeries();
						$loopcount = (isset($totalseries)) ? count($totalseries) : 0;
                         ?>
          <form class="form-gallery" action="#" method="post">
            <header>
              <h2>Header Image Series</h2>
            </header>
            <section>
              <div class="tab-pane" id="dynamic">
                <table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
                  <thead>
                    <tr>
                      <th>No.</th>
					  <th>Menu Name</th>
                      <th>Category Name</th>
                      <th>Series Name</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
													
													for($i=0;$i<$loopcount;$i++){
													?>
                    <tr class="odd gradeX" id="<?php echo $v['id']; ?>">
                      <td><?php echo ($i+1); ?></td>
						<td>
					   <?php 
								$catt = $obj_fun->getCategoryBySizeId($totalseries[$i]['product_size_id']);  
								$mname = "SELECT * FROM `menu` where id=".$catt[0]['menu_id'];
								$resmname =$obj_fun->getLastRecords($mname);
								echo $resmname['name']; 
						  ?>
					</td>
                      <td><?php $catt = $obj_fun->getCategoryBySizeId($totalseries[$i]['product_size_id']);  echo $catt[0]['size'] ?></td>
                      <td><?php echo $totalseries[$i]['series_name']; ?></td>
                      <td>
						  <?php
								$img ='';
								if($totalseries[$i]['header_image'] != '')
								{
									$img ='../uploads/headerimage/'.$totalseries[$i]['header_image']; 
								}
								else
								{
									$img ='img/no-image.jpg';
								}
						 ?>
						  <img src="<?php echo $img;?>" alt="No Image Found." style="width: 100px;" /></td>
                      <td align="center"><a href="headerimage-series-update.php?id=<?php echo $totalseries[$i]['id']; ?>" class="btn btn-alt btn-primary" ><span class="awe-edit"></span></a>
                        <?php if($totalseries[$i]['header_image'] != ''){ ?>
                        <a href="#" class="btn btn-alt btn-danger" onClick="return deleteHeaderSeriesImage(<?php echo $totalseries[$i]['id']; ?>);"> <span class="awe-remove"></span></a>
                        <?php } ?></td>
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
	function deleteHeaderImage(id){
		 x =  confirm("are you sure want to delete!");
		
		if(x){
			
			$.post("custom-ajax.php",{action:'headerimage_delete',menu_id:id },function(result){
				//console.log(result);
				if(result)
					location.reload();
			});
			
			}
	}
	function deleteHeaderSeriesImage(id){
		 x =  confirm("are you sure want to delete!");
		
		if(x){
			
			$.post("custom-ajax.php",{action:'headerimage_series_delete',id:id },function(result){
				//console.log(result);
				if(result)
					location.reload();
			});
			
			}
	}
	function catalogue_validate()
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
	
		if(document.getElementById('image').value.replace(/^\s+/,'')=='')
		{
			danger('Please Select the image field.');
			valid = false;
		}
		else
		{
			var fup = document.getElementById('image');
		 	var fileName = fup.value;
			 var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG")
			{
				//valid =  true;
				if(fup.files[0].size >3145728)   // 3MB = 1024*1024*3
				{
					danger("Image File too large. File must be less than 3MB.");
					valid =  false;;
				}
					
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
   
$('#myForm').ajaxForm({
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
		pageRelode();
	}
}); 

})();       
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
	</script>
<style>
.progress { position:relative; width:400px; border: 0; padding: 1px; border-radius: 3px; }
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
<link rel="stylesheet" href="order/tablednd.css" type="text/css"/>
<script type="text/javascript" src="order/jquery.tablednd.0.7.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var order = [];
	$('#catalogueview').tableDnD({
		onDrop: function(table, row) {
			var rows = table.tBodies[0].rows;
			for (var i=0; i<rows.length; i++) {
				order[i] = rows[i].id;
			}
			$.post("custom-ajax.php",{action:'catalogue_order_change',order:order },function(result){
				//console.log(result);
				if(result>0)
					location.reload();
			});
		},
		dragHandle: ".dragHandle"
	});
	$("#catalogueview tr").hover(function() {
		$(this.cells[0]).addClass('showDragHandle');
	}, function() {
		$(this.cells[0]).removeClass('showDragHandle');
	});
});
</script>