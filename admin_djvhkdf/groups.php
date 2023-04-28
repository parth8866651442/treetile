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
	$template_gallary_type = 'Groups';
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
      <li class="active"><?php echo ucwords($template_gallary_type); ?></li>
    </ul>
    <div class="row-fluid">
      <article class="span12 data-block nested">
        <div class="data-container">
          <header>
            <h2>Add Group</h2>
            <br>
            <br>
            <hr>
          </header>
          <section class="tab-content">
            <div class="tab-pane active" id="newUser">
			  <?php
				if(isset($_POST['submit']) and $_POST['submit']=="save")
				{
					$Name = $_POST['name'];
					
					echo $anjali = $obj_fun->insertContactGroup($Name);
				}
			  ?>
              <form id="form" class="form-horizontal" method="post" action="#"> 
                <div class="control-group">		
					<label for="fileInput" >Group Name:</label>
					<input type="text" class="input-xxlarge" id="name" name="name">
                </div>
                <div class="form-actions" style="padding-left:15px;">
                  <input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="save" />
                </div>
              </form>
            </div>
          </section>
        </div>
      </article>
    </div>
    <?php 
		$Groups = $obj_fun->getGroups();
		if(isset($Groups) && $Groups !=''){
			
			?>
    <div class="row-fluid">
      <article class="span12 data-block">
        <div class="data-container">
          <?php
						if(isset($_POST['delete']) && $_POST['delete'] !='')
						{
							
							for($i=0; $i < count($_POST['group_delete']); $i++)
							{
								$obj_fun ->deleteGroup($_POST['group_delete'][$i]);
							}
							header('location: groups.php');
							
							
						}
						
						?>
          <form class="form-gallery" action="#" method="post">
            <header>
              <h2>All Groups</h2>
              <ul class="data-header-actions tabs">
               
                <li class="demoTabs">
                  <input type="submit" name="delete" id="delete" value="Delete" class="btn btn-alt btn-primary" />
                </li>
              </ul>
               
            </header>
            <section>
				<table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
				   <thead>
						<tr>
							<th> <input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
							<th>Gaoups Name</th>
							<th>Drag & Drop</th>
						</tr>
					</thead>
					<tbody>
                <?php
					foreach($Groups as $g){
				?>
				<tr class="odd gradeX" id="<?php echo $g['id']; ?>">
					<td><input type="checkbox" value="<?php echo $g['id']; ?>" class="checkbox1" id="group_delete[]" name="group_delete[]"></td>
					<td>					  
					  <a title="Groups Name" href="#" class="thumbnail" style="border: none"><!--<img id="img_name" src="../<?php echo $g['thumb']; ?>" alt="Gallery Image">--><?=$g['group_name'];?></a> 
					</td>
					<td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span></td>	
				</tr>
                <?php }?>
              
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
			url : 'plupload/upload.php?folder=../../uploads/<?php echo $template_gallary_type; ?>&tw=<?php echo $template_image_size['th_width']; ?>&th=<?php echo $template_image_size['th_height']; ?>',
	
			// User can upload no more then 20 files in one go (sets multiple_queues to false)
			max_file_count: 20,
			
			chunk_size: '1mb',
			unique_names : true,
			// Resize images on clientside if we can
			resize : {
				width : <?php echo $template_image_size['big_width']; ?>, 
				height : <?php echo $template_image_size['big_height']; ?>,
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
		$('#selecctall').click(function(event) { 
			//on click
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
		$('.dynamic-menu #Email_Contact').addClass('active');
		$('.dynamic-menu #new_g').addClass('active');
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
			$.post("custom-ajax.php",{action:'group_order_change',order:order },function(result){
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