<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<?php ob_start(); ?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
	require_once('head.php'); 
	if($obj_fun->getMetaData('product') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php');
?>
</head>
<?php
$drag_drop = '';
if ( isset( $_GET[ 'size' ] ) && $_GET[ 'size' ] != '' && isset( $_GET[ 'series' ] ) && $_GET[ 'series' ] != '' ) {
	$drag_drop = $_GET[ 'series' ];
	$img_path = $obj_fun->getImageBySeriesId( $_GET[ 'series' ] );
	if ( isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] == 'updateproduct' && isset( $_GET[ 'product' ] ) && $_GET[ 'product' ] != '' ) {
		$product_details = $obj_fun->getProductById( $_GET[ 'product' ] );
		$path = $obj_fun->getImageByProductId( $product_details[ 'id' ] );


		$p_size = $obj_fun->getProductSizeById( $_GET[ 'size' ] );
		$p_series = $obj_fun->getSeriesById( $_GET[ 'series' ] );
	} else {
		$p_size = $obj_fun->getProductSizeById( $_GET[ 'size' ] );
		$p_series = $obj_fun->getSeriesById( $_GET[ 'series' ] );
	}
} else
	header( 'location:index.php' );
?>

<body class="fixed-layout">
<div class="container">
  <div class="sidebar">
    <?php include_once('sidebar.php');?>
  </div>
  <div class="content-block" role="main">
    <ul class="breadcrumb">
      <li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span> </li>
      <li><a href="index.php">Admin Panel</a><span class="divider"></span> </li>
      <li class="active"> <?php echo $p_series['series_name']; ?> Series</li>
    </ul>
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
					$p_result = $obj_fun->updateProductSeries($_POST,$_FILES );
					if($p_result =='success')
					{
						echo '<script>success("Product Update successfully.")</script>';
						echo "<script>urlRefresh('design-series-description.php?size=".$_POST['size']."&series=".$_POST['series']."');</script>";
					}
					else
						echo '<script>danger("'.$p_result.'")</script>';
				}
				?>
              <form onSubmit="return product_validate();" enctype="multipart/form-data" action="#" method="post" class="form-horizontal">
                <input type="hidden" value="<?php echo $product_details['id'];?>" class="input-xxlarge" name="id" id="id">
                <input type="hidden" value="<?php echo $product_details['size_id'];?>" class="input-xxlarge" name="size" id="size">
                <input type="hidden" value="<?php echo $product_details['series_id'];?>" class="input-xxlarge" name="series" id="series">
                <input type="hidden" value="<?php echo (isset($product_details['image']) && $product_details['image'] !='' ? $product_details['image'] : '');?>" class="input-xxlarge" name="img_old" id="img_old">
                <input type="hidden" value="<?php echo (isset($product_details['view']) && $product_details['view'] !='' ? $product_details['view'] : '');?>" class="input-xxlarge" name="view_old" id="view_old">
                <input type="hidden" value="<?php echo (isset($product_details['dimension']) && $product_details['dimension'] !='' ? $product_details['dimension'] : '');?>" class="input-xxlarge" name="dimension_old" id="dimension_old">
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
                        <div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span> </div>
                        <span class="btn btn-alt btn-file"><span class="fileupload-new">Select Design</span><span class="fileupload-exists">Change</span>
                        <input type="file" name="image" id="image" onChange="return jpgImage(this.value);">
                        </span> </div>
                    </div>
                    <?php if(isset($product_details['image']) && $product_details['image'] !=''){ ?>
                    <img id="img_name" src="<?php echo (isset($product_details['image']) && $product_details['image'] !='' ? '../uploads/'.$path . '/thumbnails/'. $product_details['image'] : '');?>" style="float: right; width: auto; height: 60px;"/>
                    <?php }?>
                  </div>
                </div>
                <?php $product_view = ($obj_fun->getMetaData('product-view') == 1 ? 1 : 0);
									if($product_view == 1) { ?>
                <div class="control-group">
                  <label for="fileInput" class="control-label">View</label>
                  <div class="controls">
                    <div data-provides="fileupload" class="fileupload fileupload-new">
                      <div class="input-append">
                        <div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span> </div>
                        <span class="btn btn-alt btn-file"><span class="fileupload-new">Select View</span><span class="fileupload-exists">Change</span>
                        <input type="file" name="view" id="view" onChange="return jpgImage(this.value);">
                        </span> </div>
                    </div>
                    <?php
											if ( isset( $product_details[ 'view' ] ) && $product_details[ 'view' ] != '' ) {
												?>
                    <img id="img_name" src="<?php echo (isset($product_details['view']) && $product_details['view'] !='' ? '../uploads/'.$path . '/thumbnails/'. $product_details['view'] : '');?>" style="float: right; width: auto; height: 60px;"/>
                    <?php }?>
                  </div>
                </div>
                
                <?php } ?>
                <?php /*
                <div class="control-group">
                  <label for="fileInput" class="control-label">Dimension</label>
                  <div class="controls">
                    <div data-provides="fileupload" class="fileupload fileupload-new">
                      <div class="input-append">
                        <div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span> </div>
                        <span class="btn btn-alt btn-file"><span class="fileupload-new">Select Dimension</span><span class="fileupload-exists">Change</span>
                        <input type="file" name="dimension" id="dimension" onChange="return jpgImage(this.value);">
                        </span> </div>
                    </div>
                    <?php if ( isset( $product_details[ 'dimension' ] ) && $product_details[ 'dimension' ] != '' ) { ?>
                    <img id="img_name" src="<?php echo (isset($product_details['dimension']) && $product_details['dimension'] !='' ? '../uploads/'.$path . '/thumbnails/'. $product_details['dimension'] : '');?>" style="float: right; width: auto; height: 60px;"/>
                    <?php }?>
                  </div>
                </div>
                <div class="control-group">
					<label class="control-label" for="input" style="text-align: left;">Model Details :</label>
					<div class="controls">
						<textarea id="details" class="" rows="8" name="details">
							<?php echo (isset($product_details['details']) && $product_details['details'] !='' ? $product_details['details'] : '');?>
						</textarea>
					</div>
				</div>
				*/?>
				
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
                <input id="visible" name="visible" class="input-xxlarge" type="hidden" value=""/>
                <?php }?>
                <div class="form-actions">
                  <input type="submit" value="Update" class="btn btn-alt btn-large btn-primary" name="submit">
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
            <h2>Add Designs For <?php echo $p_series['series_name']; ?> Series of Size <?php echo $p_size['size']; ?> - ( for better resolution keep Image size <?php echo product_big_width;?> x <?php echo product_big_height;?> px )</h2>
            <br>
            <br>
            <hr>
          </header>
          <section class="tab-content">
            <div class="tab-pane active" id="newUser">
            	<?php
                  //echo $sql= $_GET['size'];
                    $menu_sql="select * from `product_size` where id=". $_GET['size'];
                    $menu_sql=$obj_fun->getLastRecords($menu_sql);
                    $mid=$menu_sql['menu_id'];
                    $sizeslug=$menu_sql['slug'];

                  	$series_sql="select * from `series` where id=". $_GET['series'];
                    $series_sql=$obj_fun->getLastRecords($series_sql);
                   	$sslug=$series_sql['slug'];

                    
                 ?>

              <?php
				if ( isset( $_POST[ 'submit' ] ) && $_POST[ 'submit' ] != '' && $_POST[ 'submit' ] == 'Create' ) {
					for ( $i = 0; $i < $_POST[ 'uploader_count' ]; $i++ ) {
						if ( $_POST[ 'uploader_' . $i . '_status' ] == 'done' ); {
							$title = $obj_fun->strbefore( $_POST[ 'uploader_' . $i . '_name' ], '.' );
							$slug = $obj_fun->createSlug( $title );
							$image = $_POST[ 'uploader_' . $i . '_tmpname' ];
							$exiest = $obj_fun->checkProductsExists( $title, $_POST[ 'series' ] );
							if ( $exiest == 0 ) {
								$res = $obj_fun->insertProducts( $title, $slug, $image, $_POST[ 'size' ],$_POST[ 'series' ],$sslug,$_POST['menu'] );
							} else {
								if ( file_exists( '../uploads/' . $_POST[ 'path' ] . '/' . $_POST[ 'uploader_' . $i . '_tmpname' ] ) )
									unlink( '../uploads/' . $_POST[ 'path' ] . '/' . $_POST[ 'uploader_' . $i . '_tmpname' ] );
								if ( file_exists( '../uploads/' . $_POST[ 'path' ] . '/thumbnails/' . $_POST[ 'uploader_' . $i . '_tmpname' ] ) )
									unlink( '../uploads/' . $_POST[ 'path' ] . '/thumbnails/' . $_POST[ 'uploader_' . $i . '_tmpname' ] );

								echo '<script>danger("' . $title . ' Product already exists !")</script>';
							}
						}
					}
					echo '<script>urlRefreshFiveSec("design-series-description.php?size=' . $_POST[ 'size' ] . '&series=' . $_POST[ 'series' ] . '");</script>';
				}
				?>
              <form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="" action="#">
              	<input id="menu" name="menu" class="input-xxlarge" type="hidden" value="<?php echo $mid; ?>" />
                <input id="size" name="size" class="input-xxlarge" type="hidden" value="<?php echo $_GET['size']; ?>"/>
                <input id="series" name="series" class="input-xxlarge" type="hidden" value="<?php echo $_GET['series']; ?>"/>
                <input id="path" name="path" class="input-xxlarge" type="hidden" value="<?php echo $img_path ; ?>"/>
                <div class="">
                  <div class="">
                    <div id="uploader"></div>
                  </div>
                </div>
                <div class="form-actions" style="padding-left:0;">
                  <input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Create"/>
                </div>
              </form>
            </div>
          </section>
        </div>
      </article>
    </div>
    <?php $product = $obj_fun->getProductsBySeriesId($_GET['series']);?>
    <?php if(isset($product) && $product !=''){ ?>
    <div class="row-fluid" id=""> 
      <!-- Data block -->
      <article class="span12 data-block">
        <div class="data-container"> 
          
        	<?php
				// $application = $obj_fun->getceramicapplicationname();
				// $inspiration = $obj_fun->getceramicinspirationname();
				$color = $obj_fun->getcolorname(); 
		  ?>
		  <?php if($obj_fun->getMetaData('Tiles_color')  == 1){ ?>
          <!-- color -->
         
          <div class="form-inline" id="color">
            <fieldset>
              <div class="control-group">
                <div class="form-controls"> 
                  <!-- Color -->
                  <select class="span2 colorselect" name="color_id" id="color_id">
                    <?php foreach($color as $clr) { ?>
                    <option value="<?php echo $clr['id'];?>"> <?php echo $clr['name'];?> </option>
                    <?php } ?>
                  </select>
                  <a class="btn btn-alt btn-primary addtocolor" onClick="return product_mul_color();">Add Color To Tiles</a> </div>
              </div>
            </fieldset>
          </div>
          <?php } ?>
          
          
          <section>
            <div class="tab-pane" id="dynamic"> <a class="btn btn-alt btn-primary" onClick="return product_mul_delete();" style="position: absolute; right: 290px;">Delete</a>
              <?php 
					$product_view = ($obj_fun->getMetaData('product-view') == 1 ? 1 : 0);
					$product_register = ($obj_fun->getMetaData('product-register') == 1 ? 1: 0);
				?>
              <table class="datatable table table-striped table-bordered" id="example" align="center">
                <thead>
                  <tr>
                    <th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;"/>
                    </th>
                    <th>Design</th>
                    <th>Image</th>
                    <?php if($product_view == 1){?>
                    <th>View</th>
                    <?php }?>
                    <!-- <th>Dimension</th>
                    <th>Details</th> -->
                    <?php if($product_register == 1){?>
                    <th>Visible</th>
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
						$i=1;
						foreach($product as $p){ 
						$path = $obj_fun->getImageByProductId($p['id']);
				  ?>
                  <tr class="odd gradeX" id="<?php echo $p['id']; ?>">
                    <td align="center"><input type="checkbox" value="<?php echo $p['id']; ?>" class="checkbox1" id="img_delete_<?php echo $p['id']; ?>" name="img_delete[]"></td>
                    <input type="hidden" name="img_del_<?php echo $p['id']; ?>" id="img_del_<?php echo $p['id']; ?>" value="<?php echo $p['image']; ?>"/>
                    <input type="hidden" name="old_img_<?php echo $p['id']; ?>" id="old_img_<?php echo $p['id']; ?>" value="<?php echo $p['image']; ?>"/>
                    <input type="hidden" name="old_view_<?php echo $p['id']; ?>" id="old_view_<?php echo $p['id']; ?>" value="<?php echo $p['view']; ?>"/>
                    <input type="hidden" name="img_path" id="img_path" value="<?php echo $path; ?>"/>
                    <td align="center" id="p_title_<?php echo $p['id']; ?>"><?php echo $p['title']; ?></td>
                    <td align="center" id="series_no_id2_<?php echo $p['id']; ?>"><img src="../uploads/<?php echo $path .'/thumbnails/'.$p['image']; ?>" id="product_image_<?php echo $p['id']; ?>" style="width: 150px; height: auto;"/></td>
                    <?php if($product_view == 1){?>
                    <td align="center" id=""><?php 
												$view_thumb = '../uploads/'. $path .'/thumbnails/'.$p['view'];
												$view_thumb = ($p['view'] !='' && file_exists($view_thumb)? $view_thumb : 'img/no-image.jpg' );
												?>
                      <img src="<?php echo $view_thumb;?>" id="product_view_img_<?php echo $p['id']; ?>" style="width: 150px; height: auto;"/>
                      <?php if($p['view'] !=''){?>
                      <ul class="thumbnail-actions-view">
                        <li><a title="Delete View" onClick="return product_view_delete(<?php echo $p['id']; ?>,'../uploads/<?php echo $path; ?>','<?php echo $p['view']; ?>');"><span class="icon-trash"></span></a> </li>
                      </ul>
                      <?php }?></td>
                    <?php }?>
                    
                    <?php /*<td id="old_dime_<?php echo $p['id']; ?>">
                        	<?php 
                        	if($p['dimension'] !='')
                        	{
							$dimension_thumb = '../uploads/'. $path .'/thumbnails/'.$p['dimension'];
                        	}else{
							$dimension_thumb = ($p['dimension'] !='' && file_exists($dimension_thumb)? $dimension_thumb : 'img/no-image.jpg' );
                        	}
							?>
							
                        <img src="<?php echo $dimension_thumb ?>" id="old_dimension_<?php echo $p['id']; ?>" style="width: 150px; height: auto;">
                        
                    </td>
                      
                    <td align="center" id="p_details_<?php echo $p['id']; ?>"><?php echo htmlspecialchars_decode($p['details']); ?></td> */ ?>
                    <?php 
						if($obj_fun->getMetaData('Tiles_Color')  == 1){ 
							$colorname = "SELECT * FROM `color` where id=".$p['color_id'];
							$colorname = $obj_fun->getLastRecords($colorname);
					?>
                    <td><?php echo $colorname['name']; ?></td>
                    <?php } ?>
                    
                    <td align="center"><a class="btn btn-alt btn-primary" href="design-series-description.php?action=updateproduct&size=<?php echo $p_size['id']; ?>&series=<?php echo $p['s_id']; ?>&product=<?php echo $p['id']; ?>"><span class="awe-edit"></span></a> <a class="btn btn-alt btn-primary" onClick="return product_delete(<?php echo $p['id']; ?>);"><span class="awe-remove"></span></a></td>
                    <?php if($drag_drop !=''){?>
                    <td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span></td>
                    <?php }?>
                  </tr>
                  <?php }?>
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
			$( function () {
				$( "#uploader" ).plupload( {
					// General settings
					runtimes: 'html5,flash,silverlight,html4',
					url: 'plupload/upload.php?folder=<?php echo $img_path ;?>&tw=<?php echo product_th_width; ?>&th=<?php echo product_th_height; ?>',

					// User can upload no more then 20 files in one go (sets multiple_queues to false)
					max_file_count: 200,

					chunk_size: '1mb',
					unique_names: true,
					// Resize images on clientside if we can
					resize: {
						width: <?php echo product_big_width;?>,
						height: <?php echo product_big_height;?>,
						quality: 95,
						crop: false // crop to exact dimensions
					},

					filters: {
						// Maximum file size
						max_file_size: '3mb',
						// Specify what files to browse for
						mime_types: [ {
								title: "Image files",
								extensions: "jpg,jpeg"
							} //,
							/*{title : "Zip files", extensions : "zip"}*/
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
					flash_swf_url: 'plupload/js/Moxie.swf',

					// Silverlight settings
					silverlight_xap_url: 'plupload/js/Moxie.xap'
				} );


				// Handle the case when form was submitted before uploading has finished
				$( '#form' ).submit( function ( e ) {
					// Files in queue upload them first
					if ( $( '#uploader' ).plupload( 'getFiles' ).length > 0 ) {

						// When all files are uploaded submit form
						$( '#uploader' ).on( 'complete', function () {
							$( '#form' )[ 0 ].submit();
						} );

						$( '#uploader' ).plupload( 'start' );
					} else {
						alert( "You must have at least one file in the queue." );
					}
					return false; // Keep the form from submitting
				} );
			} );



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
		
</body>
</html>
<?php $xy =  $obj_fun ->getMenuTitleBySizeId($_GET['size']);?>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #product-size').addClass('active');
		$('.dynamic-menu #level_1_<?php echo preg_replace('/[^A-Za-z0-9\-]/', '', $xy['name']);?>').addClass('active');
		$('.dynamic-menu #level_2_<?php echo $_GET['size'];?>').addClass('active');
		$('.dynamic-menu #product_<?php echo $_GET['series'];?>').addClass('active');
	});
</script>
<?php if($drag_drop !=''){?>
<link rel="stylesheet" href="order/tablednd.css" type="text/css"/>
<script type="text/javascript" src="order/jquery.tablednd.0.7.min.js"></script>
<script type="text/javascript">
	$( document ).ready( function () {
		var order = [];
		$( '#example' ).tableDnD( {
			onDrop: function ( table, row ) {
				var rows = table.tBodies[ 0 ].rows;
				for ( var i = 0; i < rows.length; i++ ) {
					order[ i ] = rows[ i ].id;
				}
				console.log( order );
				var x = document.createElement( "INPUT" );
				x.setAttribute( "type", "button" );
				x.setAttribute( "value", "UPDATE ORDER" );
				x.setAttribute( "id", "update-order" );
				x.setAttribute( "class", "btn btn-alt btn-primary" );
				x.setAttribute( "onClick", "return update_seriesno_order('" + order + "');" );
				var parent = document.getElementById( "drag-drop" );
				parent.innerHTML = '';
				parent.appendChild( x );

			},
			dragHandle: ".dragHandle"
		} );
		$( '#example' ).on( 'draw.dt', function () {
			$( '#example' ).tableDnD( {
				onDrop: function ( table, row ) {
					var rows = table.tBodies[ 0 ].rows;
					for ( var i = 0; i < rows.length; i++ ) {
						order[ i ] = rows[ i ].id;
					}
					console.log( order );
					var x = document.createElement( "INPUT" );
					x.setAttribute( "type", "button" );
					x.setAttribute( "value", "UPDATE ORDER" );
					x.setAttribute( "id", "update-order" );
					x.setAttribute( "class", "btn btn-alt btn-primary" );
					x.setAttribute( "onClick", "return update_seriesno_order('" + order + "');" );
					var parent = document.getElementById( "drag-drop" );
					parent.innerHTML = '';
					parent.appendChild( x );
				},
				dragHandle: ".dragHandle"
			} );
		} );
		$( "#example tr" ).hover( function () {
			$( this.cells[ 0 ] ).addClass( 'showDragHandle' );
		}, function () {
			$( this.cells[ 0 ] ).removeClass( 'showDragHandle' );
		} );
	} );

	function update_seriesno_order( order ) {
		var series = <?php echo $drag_drop;?>;
		console.log( order );
		$.post( "custom-ajax.php", {
			action: 'products_order_change',
			order: order,
			series: series
		}, function ( result ) {
			if ( result > 0 )
				location.reload();
		} );
		return false;
	}
</script>
<?php }?>

<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<script>
	CKEDITOR.disableAutoInline = true;
	$( document ).ready( function () {
		CKEDITOR.replace( 'details', {
			toolbar: [ {
					name: 'document',
					items: [ 'Source' ]
				}, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				{
					name: 'basicstyles',
					items: [ 'Bold', 'Italic', 'Strike' ]
				}, {
					name: 'paragraph',
					groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ],
					items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ]
				}, {
					name: 'links',
					items: [ 'Link', 'Unlink' ]
				}, {
					name: 'insert',
					items: [ 'Image', 'Table', 'HorizontalRule' ]
				}, {
					name: 'styles',
					items: [ 'Styles', 'Format' ]
				}
			]
		} );
	} );
</script>
