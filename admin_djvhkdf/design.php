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
	if($obj_fun->getMetaData('product') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php');
	
?>
</head>
<?php
$drag_drop = '';
if(isset($_GET['size']) && $_GET['size'] !='')
{
	$drag_drop = $_GET['size'];
	if(isset($_GET['action']) && $_GET['action'] =='updateproduct' && isset($_GET['product']) && $_GET['product'] !=''){
		$size = $_GET['size'];
		$product_details = $obj_fun->getProductById($_GET['product']);
		//echo $product_details['size_id'];
		
		$path =$obj_fun->getImageByProductId($product_details['id']);
		$p_size = $obj_fun->getProductSizeById($_GET['size']);
	
	}
	else{
		$size = $_GET['size'];
		$p_size = $obj_fun->getProductSizeById($_GET['size']);
	}
}
else
	header('location:index.php');
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
      <li class="active"><?php echo $p_size['size']; ?></li>
    </ul>
    <?php
                  //echo $sql= $_GET['size'];
      $menu_sql="select * from `product_size` where id=". $_GET['size'];
      $menu_sql=$obj_fun->getLastRecords($menu_sql);
      $mid=$menu_sql['menu_id'];
       $sizeslug=$menu_sql['slug'];                    
   ?>

    <?php if(isset($product_details) && $product_details !=''){?>
    <div class="row-fluid">
      <article class="span12 data-block nested">
        <div class="data-container">
          <header>
            <h2>Update <?php echo $product_details['title'];?> Product</h2>
            <br>
            <br>
            <hr>
          </header>
          <section class="tab-content">
            <div id="newUser" class="tab-pane active">
              <?php 
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update'){
									$p_result = $obj_fun->updateProductDesign($_POST,$_FILES );
									if($p_result =='success')
									{
										echo '<script>success("Product Update successfully.")</script>';
										echo "<script>urlRefresh('design.php?size=".$_POST['size']."');</script>";
									}
									else
										echo '<script>danger("'.$p_result.'")</script>';
								}
								?>

              <form onSubmit="return product_validate();" enctype="multipart/form-data" action="#" method="post" class="form-horizontal">
                <input type="hidden" value="<?php echo $product_details['id'];?>" class="input-xxlarge" name="id" id="id">
                <input type="hidden" value="<?php echo $product_details['size_id'];?>" class="input-xxlarge" name="size" id="size">
                <input type="hidden" value="<?php echo (isset($product_details['image']) && $product_details['image'] !='' ? $product_details['image'] : '');?>" class="input-xxlarge" name="img_old" id="img_old">
                <input type="hidden" value="<?php echo (isset($product_details['view']) && $product_details['view'] !='' ? $product_details['view'] : '');?>" class="input-xxlarge" name="view_old" id="view_old">
                <input id="menu" name="menu" class="input-xxlarge" type="hidden" value="<?php echo $mid; ?>" />


                <div class="control-group">
                  <label for="input" class="control-label">Name</label>
                  <div class="controls">
                    <input type="text" value="<?php echo $product_details['title'];?>" class="input-xxlarge" name="title" id="title">
                  </div>
                </div>
                <div class="control-group">
                  <label for="fileInput" class="control-label">Design</label>
                  <div class="controls">
                    <div data-provides="fileupload" class="fileupload fileupload-new">
                      <div class="input-append">
                        <div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                        <span class="btn btn-alt btn-file"><span class="fileupload-new">Select Design</span><span class="fileupload-exists">Change</span>
                        <input type="file" name="image" id="image" onChange="return jpgImage(this.value);">
                        </span> </div>
                    </div>
                    <?php if(isset($product_details['image']) && $product_details['image'] !=''){ ?>
                    <img id="img_name" src="<?php echo (isset($product_details['image']) && $product_details['image'] !='' ? '../uploads/'.$path . '/thumbnails/'. $product_details['image'] : '');?>" style="float: right; width: auto; height: 60px;" />
                    <?php }?>
                  </div>
                </div>
                <?php $product_view = ($obj_fun->getMetaData('product-view') == 1 ? 1 : 0);
									if($product_view == 1){?>
                <div class="control-group">
                  <label for="fileInput" class="control-label">View</label>
                  <div class="controls">
                    <div data-provides="fileupload" class="fileupload fileupload-new">
                      <div class="input-append">
                        <div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                        <span class="btn btn-alt btn-file"><span class="fileupload-new">Select View</span><span class="fileupload-exists">Change</span>
                        <input type="file" name="view" id="view" onChange="return jpgImage(this.value);">
                        </span> </div>
                    </div>
                    <?php 
											if(isset($product_details['view']) && $product_details['view'] !=''){ ?>
                    <img id="img_name" src="<?php echo (isset($product_details['view']) && $product_details['view'] !='' ? '../uploads/'.$path . '/thumbnails/'. $product_details['view'] : '');?>" style="float: right; width: auto; height: 60px;" />
                    <?php }?>
                  </div>
                </div>
                <?php }?>
                <?php $product_register = ($obj_fun->getMetaData('product-register') == 1 ? 1: 0); 
									if($product_register == 1){ ?>
                <div class="control-group">
                  <label for="input" class="control-label">Visible</label>
                  <div class="controls">
                    <label class="radio radio1 ">
                      <input type="radio" <?php echo ($product_details['visible'] == 0 ?'checked="checked"' : '')?> name="visible" id="yes" value="0">
                      Registered </label>
                    <label class="radio">
                      <input type="radio" <?php echo ($product_details['visible'] == 1 ?'checked="checked"' : '')?> name="visible" id="no" value="1">
                      Unregistered </label>
                  </div>
                </div>
                <?php }else{?>
                <input id="visible" name="visible" class="input-xxlarge" type="hidden" value="" />
                <?php }?>
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
            <h2>Add Designs For <?php echo $p_size['size']; ?> Size - ( for better resolution keep Image size <?php echo product_big_width;?> x <?php echo product_big_height;?> px )</h2>
            <br>
            <br>
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
											$title = $obj_fun->strbefore($_POST['uploader_'.$i.'_name'], '.');
											$slug = $obj_fun->createSlug($title);
											$image = $_POST['uploader_'.$i.'_tmpname'];
											$exiest = $obj_fun->recordCount("SELECT * FROM product WHERE  title='".$title."' and size_id='".$_POST['size']."'");
											if($exiest ==0)
											{
												$res = $obj_fun->insertDesign($title,$slug,$image,$_POST['size'],$sizeslug,$_POST['menu']);
											}
											else
											{
												if(file_exists('../uploads/'.$_POST['path'].'/'.$_POST['uploader_'.$i.'_tmpname']))
													unlink('../uploads/'.$_POST['path'].'/'.$_POST['uploader_'.$i.'_tmpname']);
												if(file_exists('../uploads/'.$_POST['path'].'/thumbnails/'.$_POST['uploader_'.$i.'_tmpname']))
													unlink('../uploads/'.$_POST['path'].'/thumbnails/'.$_POST['uploader_'.$i.'_tmpname']);
													
												echo '<script>danger("'.$title.' Product Image already exists !")</script>';
											}
										}
									}
									echo '<script>urlRefreshFiveSec("design.php?size='.$_POST['size'].'");</script>';
								}
							?>
              
              <form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="#">
                 <input id="menu" name="menu" class="input-xxlarge" type="hidden" value="<?php echo $mid; ?>" />
                <input id="size" name="size" class="input-xxlarge" type="hidden" value="<?php echo $p_size['id']; ?>" />
                <?php $mm = $obj_fun->menupath($p_size['id']); ?>
                <input id="path" name="path" class="input-xxlarge" type="hidden" value="<?php echo preg_replace('/[^A-Za-z0-9\-]/', '', $mm)."/".preg_replace('/[^A-Za-z0-9\-]/', '', $p_size['size']); ?>" />
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
    <?php $product = $obj_fun->getProductBySizeId($p_size['id']); 
			if(isset($product) && $product !=''){ ?>
    <div class="row-fluid">
      <article class="span12 data-block">
        <div class="data-container">
          <?php
				//$application = $obj_fun->getceramicapplicationname();
				// $inspiration = $obj_fun->getceramicinspirationname();
				//$color = $obj_fun->getcolorname();
		  ?>
          
          <!-- application -->
          <!--<div class="form-inline" id="application">-->
          <!--  <fieldset>-->
          <!--    <div class="control-group">-->
          <!--      <div class="form-controls">-->
          <!--        <select class="span2 applicationselect" name="application_id" id="application_id">-->
          <!--          <?php foreach($application as $app) { ?>-->
          <!--          <option value="<?php echo $app['id'];?>" class=""> <?php echo $app['name'];?> </option>-->
          <!--          <?php } ?>-->
          <!--        </select>-->
          <!--        <a class="btn btn-alt btn-primary addtoapplication" onClick="return product_mul_application();">Add to Application</a> </div>-->
          <!--    </div>-->
          <!--  </fieldset>-->
          <!--</div>-->
          
          <!-- inspiration -->
          <!-- <div class="form-inline" id="inspiration">
            <fieldset>
              <div class="control-group">
                <div class="form-controls">
                  <select class="span2 inspirationselect" name="inspiration_id" id="inspiration_id">
                    <?php foreach($inspiration as $inp) { ?>
                    <option value="<?php echo $inp['id'];?>" class=""> <?php echo $inp['name'];?> </option>
                    <?php } ?>
                  </select>
                  <a class="btn btn-alt btn-primary addtoinspiration" onClick="return product_mul_inspiration();">Add to Inspiration</a> </div>
              </div>
            </fieldset>
          </div> -->
          
          <!-- color -->
          <!--<div class="form-inline" id="color">-->
          <!--  <fieldset>-->
          <!--    <div class="control-group">-->
          <!--      <div class="form-controls"> -->
                  <!-- Color -->
          <!--        <select class="span2 colorselect" name="color_id" id="color_id">-->
          <!--          <?php foreach($color as $clr) { ?>-->
          <!--          <option value="<?php echo $clr['id'];?>"> <?php echo $clr['name'];?> </option>-->
          <!--          <?php } ?>-->
          <!--        </select>-->
          <!--        <a class="btn btn-alt btn-primary addtocolor" onClick="return product_mul_color();">Add Color To Tiles</a> </div>-->
          <!--    </div>-->
          <!--  </fieldset>-->
          <!--</div>-->
          <section>
            <div class="tab-pane" id="dynamic"> <a class="btn btn-alt btn-primary" onClick="return product_mul_delete();" style="position: absolute; right: 290px;" >Delete</a>
              <?php 
									$product_view = ($obj_fun->getMetaData('product-view') == 1 ? 1 : 0);
									$product_register = ($obj_fun->getMetaData('product-register') == 1 ? 1: 0);
								?>
              <table class="datatable table table-striped table-bordered" id="example" align="center">
                <thead>
                  <tr>
                    <th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
                    <th>Design</th>
                    <th>Image</th>
                    <?php if($product_view == 1){?>
                    <th>View</th>
                    <?php }?>
                    <?php if($product_register == 1){?>
                    <th>Visible</th>
                    <?php } ?>
                    <?php if($obj_fun->getMetaData('ceramic_application')  == 1){ ?>
                    <th>Application</th>
                    <?php } ?>
                    <?php if($obj_fun->getMetaData('product_inspiration')  == 1){ ?>
                    <th>Inspiration</th>
                    <?php } ?>
                    <?php if($obj_fun->getMetaData('Tiles_Color')  == 1){ ?>
                    <th>Tiles Color</th>
                    <?php } ?>
                    <th>Action</th>
                    <?php if($drag_drop !=''){?>
                    <th id="drag-drop">Drag & Drop</th>
                    <?php }?>
                  </tr>
                </thead>
                <tbody>
                  <?php 
										foreach($product as $p){ 
											$mp = $obj_fun->menupath($p_size['id']); 
											$path = preg_replace('/[^A-Za-z0-9\-]/', '', $mp)."/".preg_replace('/[^A-Za-z0-9\-]/', '', $p['size']);
											?>
                  <tr class="odd gradeX" id="<?php echo $p['id']; ?>">
                    <td align="center"><input type="checkbox" value="<?php echo $p['id']; ?>" class="checkbox1" id="img_delete_<?php echo $p['id']; ?>" name="img_delete[]"></td>
                    <input type="hidden" name="old_img_<?php echo $p['id']; ?>" id="old_img_<?php echo $p['id']; ?>" value="<?php echo $p['image']; ?>" />
                    <input type="hidden" name="old_view_<?php echo $p['id']; ?>" id="old_view_<?php echo $p['id']; ?>" value="<?php echo $p['view']; ?>" />
                    <input type="hidden" name="img_path" id="img_path" value="<?php echo $path; ?>" />
                    <td align="center" id="p_title_<?php echo $p['id']; ?>"><?php echo $p['title']; ?></td>
                    <td align="center" id="series_no_id2_<?php echo $p['id']; ?>" ><img src="<?php echo '../uploads/'.$path .'/thumbnails/'.$p['image']; ?>" id="product_image_<?php echo $p['id']; ?>"style="width: 150px; height: auto;" /></td>
                    <?php if($product_view == 1){ ?>
                    <td align="center" id=""><?php
														$view_thumb = '../uploads/'. $path .'/thumbnails/'.$p['view'];
														$view_thumb = ($p['view'] !='' && file_exists($view_thumb)? $view_thumb : 'img/no-image.jpg' );
														?>
                      <img src="<?php echo $view_thumb; ?>" id="product_view_img_<?php echo $p['id']; ?>" style="width: 150px; height: auto;" />
                      <?php if($p['view'] !=''){ ?>
                      <ul class="thumbnail-actions-view">
                        <li><a title="Delete View" onClick="return product_view_delete(<?php echo $p['id']; ?>,'../uploads/<?php echo $path; ?>','<?php echo $p['view']; ?>');" ><span class="icon-trash"></span></a></li>
                      </ul>
                      <?php } ?></td>
                    <?php } ?>
                    <?php 
						if($obj_fun->getMetaData('ceramic_application')  == 1){ 
							$appname = "SELECT * FROM `application` where id=".$p['application_id'];
							$appname = $obj_fun->getLastRecords($appname);
					?>
                    <td align="center"><?php echo $appname['name']; ?></td>
                    <?php } ?>
                    <?php 
						if($obj_fun->getMetaData('product_inspiration')  == 1){ 
							$inpname = "SELECT * FROM `inspiration` where id=".$p['inspiration_id'];
							$inpname = $obj_fun->getLastRecords($inpname);
					?>
                    <td align="center"><?php echo $inpname['name']; ?></td>
                    <?php } ?>
                    <?php 
						if($obj_fun->getMetaData('Tiles_Color')  == 1) { 
							$colorname = "SELECT * FROM `color` where id=".$p['color_id'];
							$colorname = $obj_fun->getLastRecords($colorname);
					?>
                    <td><?php echo $colorname['name']; ?></td>
                    <?php } ?>
                    <?php if($product_register == 1){ ?>
                    <td align="center" id="series_visible_id_<?php echo $p['id']; ?>"><!--<a class="btn btn-alt btn-primary full-width">--> 
                      <?php echo (isset($p['visible']) && $p['visible'] == 0 ? '<span class="awe-eye-open"></span> Registered' : '<span class="awe-eye-close"></span> Unregistered' )?> 
                      <!--</a>--></td>
                    <?php } ?>
                    <td align="center"><a class="btn btn-alt btn-primary" href="design.php?action=updateproduct&size=<?php echo $p_size['id'];?>&product=<?php echo $p['id']; ?>"><span class="awe-edit"></span></a> <a class="btn btn-alt btn-primary" onClick="return product_delete(<?php echo $p['id']; ?>);"><span class="awe-remove"></span></a></td>
                    <?php if($drag_drop !=''){ ?>
                    <td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span></td>
                    <?php } ?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </article>
    </div>
    <?php }?>
    <?php }?>
  </div>
</div>
<?php include_once('script.php');?>
<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(function() {
	$("#uploader").plupload({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',<?php $mp2 = $obj_fun->menupath($p_size['id']); ?>
		url : 'plupload/upload.php?folder=<?php echo preg_replace('/[^A-Za-z0-9\-]/', '', $mp2)."/".preg_replace('/[^A-Za-z0-9\-]/', '', $p_size['size']);?>&tw=<?php echo product_th_width; ?>&th=<?php echo product_th_height; ?>',

		// User can upload no more then 20 files in one go (sets multiple_queues to false)
		max_file_count: 200,
		
		chunk_size: '1mb',
		unique_names : true,
		// Resize images on clientside if we can
		resize : {
			width : <?php echo product_big_width;?>, 
			height : <?php echo product_big_height;?>,
			quality : 95,
			crop: false  // crop to exact dimensions
		},
		
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

				$( document ).ready( function () {
				$( '#selecctall' ).click( function ( event ) { //on click
					if ( this.checked ) { // check select status
						$( '.checkbox1' ).each( function () { //loop through each checkbox
							this.checked = true; //select all checkboxes with class "checkbox1"
							$('#color').show();
							$('#inspiration').show();
							$('#application').show();
						} );
					} else {
						$( '.checkbox1' ).each( function () { //loop through each checkbox
							this.checked = false; //deselect all checkboxes with class "checkbox1"                      
							$('#color').hide();
							$('#inspiration').hide();
							$('#application').hide();
						} );
					}
				} );

			} );

			$( 'input[type="checkbox"]' ).click( function () {
				var ischecked = $( this ).is( ':checked' );
				if ( ischecked ) {
					$( '#color' ).show();
					$( '#inspiration' ).show();
					$( '#application' ).show();
				} else {
					$( '#color' ).hide();
					$( '#inspiration' ).hide();
					$( '#application' ).hide();
				}
			} );



			$( ".applicationselect" ).click( function () {
				
				$('#application').show();
				$('#inspiration').hide();
				$('#color').hide();
				$('.addtoapplication').show();
				$('.addtoinspiration').hide();
				$('.addtocolor').hide();
				
			} );
			$( ".inspirationselect" ).click( function () {
				
				$('#application').hide();
				$('#inspiration').show();
				$('#color').hide();
				$('.addtoapplication').hide();
				$('.addtoinspiration').show();
				$('.addtocolor').hide();

			} );
			$( ".colorselect" ).click( function () {
				
				$('#application').hide();
				$('#inspiration').hide();
				$('#color').show();
				$('.addtoapplication').hide();
				$('.addtoinspiration').hide();
				$('.addtocolor').show();
			} );
			
			// hide div 
			$( '#color' ).hide();
			$( '#inspiration' ).hide();
			$( '#application' ).hide();
			
			// hide Buttons 
			
			$('.addtoapplication').hide();
			$('.addtoinspiration').hide();
			$('.addtocolor').hide();
</script>
<style>
.row-fluid .span2.gallery{
	margin:10px;
	
}
</style>
</body>
</html>
<?php $xy =  $obj_fun ->getMenuTitleBySizeId($_GET['size']);?>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
	 	$('.dynamic-menu #product-size').addClass('active');
		$('.dynamic-menu #level_1_<?php echo preg_replace('/[^A-Za-z0-9\-]/', '', $xy['name']);?>').addClass('active');
		$('.dynamic-menu #product_<?php echo $_GET['size'];?>').addClass('active');
	});
</script>
<?php if($drag_drop !=''){?>
<link rel="stylesheet" href="order/tablednd.css" type="text/css"/>
<script type="text/javascript" src="order/jquery.tablednd.0.7.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var order = [];
	$('#example').tableDnD({
		onDrop: function(table, row) {
			var rows = table.tBodies[0].rows;
			for (var i=0; i<rows.length; i++) {
				order[i] = rows[i].id;
			}
			console.log(order);
			var x = document.createElement("INPUT");
			x.setAttribute("type", "button");
			x.setAttribute("value", "UPDATE ORDER");
			x.setAttribute("id", "update-order");
			x.setAttribute("class", "btn btn-alt btn-primary");
			x.setAttribute("onClick", "return update_seriesno_order('"+order+"');");
			var parent = document.getElementById("drag-drop");
			parent.innerHTML = '';
			parent.appendChild(x);
			
		},
		dragHandle: ".dragHandle"
	});
	$('#example').on('draw.dt', function() {
		$('#example').tableDnD({
			onDrop: function(table, row) {
				var rows = table.tBodies[0].rows;
				for (var i=0; i<rows.length; i++) {
					order[i] = rows[i].id;
				}
				console.log(order);
				var x = document.createElement("INPUT");
				x.setAttribute("type", "button");
				x.setAttribute("value", "UPDATE ORDER");
				x.setAttribute("id", "update-order");
				x.setAttribute("class", "btn btn-alt btn-primary");
				x.setAttribute("onClick", "return update_seriesno_order('"+order+"');");
				var parent = document.getElementById("drag-drop");
				parent.innerHTML = '';
				parent.appendChild(x);
			},
			dragHandle: ".dragHandle"
		});
	});	
	
	$("#example tr").hover(function() {
		$(this.cells[0]).addClass('showDragHandle');
	}, function() {
		$(this.cells[0]).removeClass('showDragHandle');
	});
});
function update_seriesno_order(order){
	var size= <?php echo $drag_drop;?>;
	console.log(order);
	$.post("custom-ajax.php",{action:'design_order_change',order:order,size:size },function(result){
		if(result>0)
			location.reload();
	});
	return false;
}
</script>
<?php } ?>
