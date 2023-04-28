<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php'); 

	if(isset($_GET['action']) && $_GET['action'] =='updateFlag' && $_GET['id'] !=''){
		$id = $_GET['id'];
		$export_flag_details = $obj_fun->getExportFlagById($_GET['id']);
		
	}
	
	$template_gallary_type = "exportFlag";
	
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
				<li class="active">Flag</li>
			</ul>
			<?php if(isset($export_flag_details) && $export_flag_details !=''){?>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Update <?php echo $export_flag_details['flagName'];?> Export Flag</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div id="newUser" class="tab-pane active">
								<?php 
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update'){
									$p_result = $obj_fun->updateExportFlag($_POST,$_FILES );
									if($p_result =='success')
									{
										echo '<script>success("Export Flag Update successfully.")</script>';
										echo "<script>urlRefresh('export_flag.php');</script>";
									}
									else
										echo '<script>danger("'.$p_result.'")</script>';
								}
								?>
								<form onSubmit="return product_validate();" enctype="multipart/form-data" action="#" method="post" class="form-horizontal">
									<input type="hidden" value="<?php echo $export_flag_details['id'];?>" class="input-xxlarge" name="id" id="id">
									<input type="hidden" value="<?php echo (isset($export_flag_details['flagImage']) && $export_flag_details['flagImage'] !='' ? $export_flag_details['flagImage'] : '');?>" class="input-xxlarge" name="img_old" id="img_old">
									<div class="control-group">
										<label for="input" class="control-label">Name</label>
										<div class="controls">
											<input type="text" value="<?php echo $export_flag_details['flagName'];?>" class="input-xxlarge" name="flagName" id="title">
										</div>
									</div>
									<div class="control-group">
										<label for="fileInput" class="control-label">Flag Image</label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select Design</span><span class="fileupload-exists">Change</span><input type="file" name="flagImageNew" id="image" onChange="return jpgImage(this.value);"></span>
												</div>
											</div>
											<?php if(isset($export_flag_details['flagImage']) && $export_flag_details['flagImage'] !=''){ ?>
											<img id="img_name" src="<?php echo (isset($export_flag_details['flagImage']) && $export_flag_details['flagImage'] !='' ? '../uploads/export/thumbnails/'. $export_flag_details['flagImage'] : '');?>" style="float: right; width: auto; height: 60px;" />
											<?php }?>
										</div>
										
									</div>
									
							
								
                                    
                                     <div class="control-group" >
										<label for="fileInput" class="control-label">Visible</label>	
										<div class="controls">
													<select id="select" name="visibility">
														<option value="1"<?php echo (isset($export_flag_details['visibility']) && $export_flag_details['visibility'] == 1) ? ' selected' : '' ?>>Enable</option>
														<option value="0"<?php echo (isset($export_flag_details['visibility']) && $export_flag_details['visibility'] == 0) ? ' selected' : '' ?>>Disable</option>
													</select>
												</div>
									</div>
                                    
									
									<div class="form-actions">
										<input id="submit" type="submit" value="Update" class="btn btn-alt btn-large btn-primary" name="submit">
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php }else{?>
            <div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Add Export Flags</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div id="newUser" class="tab-pane active">
                            	<?php
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Create')

								{
									for($i=0; $i<$_POST['uploader_count'];$i++)
									{
										
								
											$title = $obj_fun->strbefore($_POST['uploader_'.$i.'_name'], '.');
											$image = $_POST['uploader_'.$i.'_tmpname'];
											$exiest = $obj_fun->recordCount("SELECT * FROM export_flag WHERE  flagName='".$title."'");
											if($exiest ==0)
											{
												$res = $obj_fun->insertExportFlag($title,$image);
											}
											else
											{	
												if(file_exists('../uploads/export/'.$_POST['uploader_'.$i.'_tmpname']))
													unlink('../uploads/export/'.$_POST['uploader_'.$i.'_tmpname']);
												if(file_exists('../uploads/export/thumbnails/'.$_POST['uploader_'.$i.'_tmpname']))
													unlink('../uploads/export/thumbnails/'.$_POST['uploader_'.$i.'_tmpname']);
													
												echo '<script>danger("'.$title.' export flag Image already exists !")</script>';
											}
										
									}
									echo '<script>urlRefreshFiveSec("export_flag.php");</script>';
								}
							?>
							  <form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="#">
									<div class="">
										<div id="uploader"></div>
									</div>
									<div class="form-actions" style="padding-left:0px;">
										<input id="submit" name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Create" />
									</div>
								</form>
                            </div>
                        </section>
                    </div>
                </article>
            </div>  
			
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						<header>
							<h2>View Export Flag</h2>
						</header>
						<section>
							<div class="tab-pane" id="dynamic">
								<a class="btn btn-alt btn-primary" onClick="return Flag_mul_delete();" style="position: absolute; right: 290px;" >Delete</a>
								<table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
									<thead>
										<tr>
											<th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>				<th>Flag Name</th>
											<th>Flag Image</th>
											<th>Visibility</th>
											<th>Action</th>
											<th>Drag & Drop</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$ExportFlag = $obj_fun->getExportImage(); 
											if($ExportFlag!=""){ 
										?>

										<?php 
											foreach($ExportFlag as $ef){ 
											
										?>
										<tr class="odd gradeX" id="<?php echo $ef['id']; ?>">
											<td align="center"><input type="checkbox" value="<?php echo $ef['id']; ?>" class="checkbox1" id="img_delete_<?php echo $ef['id']; ?>" name="img_delete[]"></td>
											
											<input type="hidden" name="old_img_<?php echo $ef['id']; ?>" id="old_img_<?php echo $ef['id']; ?>" value="<?php echo $ef['flagImage']; ?>" />
											
											<td align="center" id="p_title_<?php echo $ef['id']; ?>"><?php echo $ef['flagName']; ?></td>

											<td align="center" id="series_no_id2_<?php echo $ef['id']; ?>" >
												<img src="<?php echo '../uploads/export/thumbnails/'.$ef['flagImage']; ?>" id="export_flag_image_<?php echo $ef['id']; ?>"style="width: 150px; height: auto;" />
											</td>
											
											<td align="center">
											
											<?php 
														if($ef['visibility'] == 0){ 
															echo '<span class="fam-cross"></span>';
														}else{
															echo '<span class="fam-tick"></span>';
															}
													?></td>
										
											<td align="center">
												<a class="btn btn-alt btn-primary" href="export_flag.php?action=updateFlag&id=<?php echo $ef['id'];?>"><span class="awe-edit"></span></a>

												<a class="btn btn-alt btn-primary" onClick="return Export_flag_delete(<?php echo $ef['id']; ?>);"><span class="awe-remove"></span></a>
											</td>                                           
											<td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span></td>												 

										</tr>
										<?php }?>
										<?php }?>
									</tbody>
								</table>
								
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php }?>
		</div>
	</div>
</body> 	
</html>
<?php include_once('script.php');?>
	<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(function() {
	$("#uploader").plupload({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : 'plupload/upload.php?folder=../../uploads/export.&tw=<?php echo product_th_width; ?>&th=<?php echo product_th_height; ?>',

		// User can upload no more then 20 files in one go (sets multiple_queues to false)
		max_file_count: 50,
		
		chunk_size: '1mb',
		unique_names : true,
		

		
		filters : {
			// Maximum file size
			max_file_size : '3mb',
			// Specify what files to browse for
			mime_types: [
				{title : "Image files", extensions : "jpg,jpeg"},
				{title : "Zip files", extensions : "zip"}
			]
		},

		// Rename files by clicking on their titles
		rename: false,
		
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
		silverlight_xap_url : 'plupload/js/Moxie.xap',
		init : {
					UploadComplete: function(up, files) {
               			 // Called when all files are either uploaded or failed
               				console.log('file uploaded');
							$('#submit').click();
            			}
					}
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
		$('.dynamic-menu #<?php echo $template_gallary_type; ?>').addClass('active');
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
			$.post("custom-ajax.php",{action:'export_flag_order_change',order:order },function(result){
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