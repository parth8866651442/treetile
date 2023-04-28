<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php'); 
	if($obj_fun->getMetaData('slider') == 0 and $_SESSION['type'] == 'admin')
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
				<li>Image Gallery</li>
				<li class="active">Slider</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Add Slider Photos ( for better resolution keep Image size <?php echo slider_big_width;?> x <?php echo slider_big_height;?> px )</h2>
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
											$res = $obj_fun->insertslider('slider',$image,$thumb,$_POST['menu'],$_POST['size'],$_POST['description'],$_POST['url']);
											echo "<script>urlRefresh('slider.php');</script>";
										}
									}
								}
								?>
								<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="#">	
									<?php if($obj_fun->getMetaData('slidermenu') == 1){ ?>
                                	<div class="control-group" >
										<label for="fileInput" class="control-label" >Menu</label>	
										<div class="controls" style="margin-left: 180px;">
											
											<input type="text" class="input-xxlarge" id="menu" name="menu">
										</div>
									</div>

                                    <?php } ?>
                                    
                                    
                                    <?php if($obj_fun->getMetaData('slider_url') == 1){ ?>
                                    
                                     <div class="control-group" >
                                      <label for="fileInput" class="control-label">Add URL</label>
                                      <div class="controls" style="margin-left: 180px;">
                                        <input type="text" class="input-xxlarge" id="url" name="url">
                                      </div>
                                     </div>
                                    <?php } ?>
									<input type="hidden" name="img_path" id="img_path" value="uploads/slider" />

									<div class="control-group">
										<label for="fileInput" class="control-label">Add Slider</label>
                                      	<div class="controls" style="margin-left: 180px;">
											<div id="uploader"></div>
										</div>
									</div>

									<?php if($obj_fun->getMetaData('slidertext') == 1){ ?>
	                                    <div class="control-group">
											<label for="fileInput" class="control-label">Description</label>
											<div class="controls" >
												<textarea name="description" id="description" rows="6" class="input-xxlarge" spellcheck="true"></textarea>			
											</div>
										</div>
                                    <?php } ?>

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
			$gallery = $obj_fun->getGallery('slider');
				if(isset($gallery) && $gallery !=''){
			?>				
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
							<form class="form-gallery" action="#" method="post">
								<header>
									<h2>Slider Photos</h2>
									 <ul class="data-header-actions tabs">
						                <li class="demoTabs active">
						                  <input type="button" name="delete" id="delete" value="Delete" onClick="return deleteAlertmega();" class="btn btn-alt btn-primary" />
						                </li>
              						</ul>
								</header>
								<section>
								  <table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
								   <thead>
										<tr>
											<th width="5%"><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
											<th width="20%">Image</th>
                                            <?php if($obj_fun->getMetaData('slidermenu') == 1){ ?>
                                            <th width="10%">Menu Name</th>
                                            
                                            <?php } ?>
                                            <?php if($obj_fun->getMetaData('slidertext') == 1){ ?>
                                            <th width="30%">Description </th>
                                            <?php } ?>
                                            <?php if($obj_fun->getMetaData('slider_url') == 1){ ?>
                                            <th width="10%">Redirect URL</th>
                                            <?php } ?>
											<th width="5%">Action</th>
                                            <th width="5%">Drag & Drop</th>
                                            
										</tr>
									</thead>
									<tbody>
										
										<?php foreach($gallery as $v){?>
										<tr class="odd gradeX" id="<?php echo $v['id']; ?>">
											<td><input type="checkbox" value="<?php echo $v['id']; ?>" class="checkbox1" id="img_delete" name="img_delete"></td>
											<td>
										
												<input type="hidden" value="<?php echo $v['image']; ?>" id="old_img_<?php echo $v['id']; ?>" name="old_img_<?php echo $v['id']; ?>" />
												<input type="hidden" value="<?php echo $v['thumb']; ?>" id="old_thumb_<?php echo $v['id']; ?>" name="old_thumb_<?php echo $v['id']; ?>" />

												
												<a title="Gallry Image" href="#" class="dragHandle thumbnail" style="border: none"><img id="img_name" src="../<?php echo $v['image']; ?>" alt="Gallery Image" ></a>
												
											
										</td>
                                         
                                        	<!-- <td><?php echo $v['menu']; ?></td> --> 
                                            
                                        
                                         <?php if($obj_fun->getMetaData('slidertext') == 1){ ?>
                                            <td><?php echo $v['description']; ?></td>
                                            <?php } ?>
                                            
                                           <!--  <td><?php echo $v['url']; ?></td> -->
                                                     
                                            <td><a href="slideredit.php?id=<?php echo $v['id']; ?>" class="btn btn-alt btn-primary"><span class="awe-edit"></span></a></td>
										<td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span></td>	
										<?php }?>
									</tbody>
								  </table>
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
	$(function() {
		$("#uploader").plupload({
			runtimes : 'html5,flash,silverlight,html4',
			url : 'plupload/upload.php?folder=slider&tw=<?php echo slider_th_width;?>&th=<?php echo slider_th_height;?>',
			max_file_count: 20,
			chunk_size: '1mb',
			unique_names : true,
			resize : {
				width : <?php echo slider_big_width;?>, 
				height : <?php echo slider_big_height;?>, 
				quality : 95,
				crop: true  // crop to exact dimensions
			},
			filters : {
				max_file_size : '1000mb',
				mime_types: [
					{title : "Image files", extensions : "jpg,jpeg"},
					{title : "Zip files", extensions : "zip"}
				]
			},
			rename: true,
			sortable: true,
			dragdrop: true,
			views: {
				list: true,
				thumbs: true, // Show thumbs
				active: 'thumbs'
			},
			flash_swf_url : 'plupload/js/Moxie.swf',
			silverlight_xap_url : 'plupload/js/Moxie.xap'
		});
		$('#form').submit(function(e) {
			if ($('#uploader').plupload('getFiles').length > 0) {
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

<script type="text/javascript">
	 jQuery(document).ready(function($) {
	 	$('.dynamic-menu #newgallery').addClass('active');
		$('.dynamic-menu #slider').addClass('active');
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
				//alert(rows[i].id);
			}
			$.post("custom-ajax.php",{action:'slider_order_change',order:order },function(result){
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
	
function deleteAlertmega(){
			swal({
					title: "Are you sure want to delete?",
					text: "All Selected data will be remove.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Delete!",
					cancelButtonText: "No, Cancel !",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					var chkLength = $('input[name="img_delete"]:checked').length;
					if(chkLength >= 1)
					{
						if (isConfirm) {
							$('input[name="img_delete"]:checked').each(function() {
							   $.post("custom-ajax.php",{action:'slider_delete',id:this.value },function(result){
							   });
							});
							swal({title: "Deleted!", text: "Deleted", type: "success"},
							   function(){ 
							       location.reload();
							   }
							);
						} else {
							swal("Cancelled", "", "error");
							return false;
						}
					}
					else
					{
						swal("Cancelled", "Please Select at least one for delete", "error");
						return false;
					}
				});
		}

		$('.confirm').click(function() {
			if($(this).text()=="OK")
			{
				location.reload();
			}
		});
	
</script>

<?php if($obj_fun->getMetaData('cataloguemenu') == 1){ ?>
<script>
	function getSize( id ) {
		if ( id != "" ) {
			$.ajax( {
				url: "ajax_get_size.php",
				type: 'post',
				data: "ajax:true&id=" + id,
				success: function ( data ) {
					if ( data == 0 ) {
						alert( "something went wrong." );
					} else {
						$( ".size-dropdown" ).empty();
						$( ".size-dropdown" ).html( data );
					}
				}
			} );
		} else {
			alert( "something went wrong." );
		}
	}
</script>
<?php } ?>


<script src="ckeditor/ckeditor.js"></script>
		<script src="ckeditor/adapters/jquery.js"></script>
		<script>
			CKEDITOR.disableAutoInline = true;
			$( document ).ready( function() {
				CKEDITOR.replace( 'description',
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


</body>
</html>