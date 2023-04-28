<?php
    $metapage = 'Products';
    $metapageid = 'Products';
?>
<?php include('header.php'); ?>
<?php
     $size = "SELECT * FROM `product_size` where slug='".$_REQUEST['size_id']."'";
        $size = $obj_fun->getLastRecords($size);
        
    $product = "select * from product where slug='".$_REQUEST['product_id']."' && size_id='".$size['id']."'";
   
    $product = $obj_fun->getLastRecords($product);
    
   
        
    $seriesno = "SELECT * FROM `series_no` where id=".$product['series_no'];
    $seriesno = $obj_fun->getLastRecords($seriesno);
    
    $series = "SELECT * FROM `series` where id=".$product['series_id'];
    $series = $obj_fun->getLastRecords($series);

    $color = "SELECT * FROM `color` where id=".$product['color_id'];
    $color = $obj_fun->getLastRecords($color);


    // if($seriesno['series_no_name'] != '')
    // {
    //     $size = "SELECT * FROM `product_size` where id=".$series['product_size_id'];
    //     $size = $obj_fun->getLastRecords($size);
    // }
    // else
    // {
    //     $size = "SELECT * FROM `product_size` where id=".$product['size_id'];
    //     $size = $obj_fun->getLastRecords($size);
    // }

   $menu = "SELECT * FROM `menu` where id=".$size['menu_id'];
    $menu = $obj_fun->getLastRecords($menu);
    

   
   $backurl ='product/'.$menu['slug'].'/'.$_REQUEST['size_id']; 
   
      $getproductbyseriesno = "select * from product where series_no='".$product['series_no']."' and id !='".$product['id']."'";
      $getproductbyseriesno = $obj_fun->getRecords($getproductbyseriesno);

    $similar = "SELECT * FROM `design_image` where product_id='".$product['id']."'";
    $similar = $obj_fun->getRecords($similar);

    $relatedproduct = "select * from product where size_id='".$product['size_id']."' and id != '".$product['id']."'";
    $relatedproduct = $obj_fun->getRecords($relatedproduct);
    

    $path ='uploads/'.$obj_fun->getImageByProductId($product['id']);
    $img = SITEURL.$path.'/thumbnails/'.$product['image'];
    $mainimg = SITEURL.$path.'/'.$product['image'];
    $preview = $path.'/'.$product['view'];

    if($product['view'] != ''){
      $previ= $preview;
    }
    else
    {
      $previ= 'assets/img/pheader.jpg';

    }
    
    $inq = '';
    $inq = $menu['name'].' / '.$size['size'].' / '.$series['series_name'].' / '.$product['title'];

    
?>

    <section id="header_main">
        <div class="hdr_main">
            <div class="vr_title">
                <h1>TreeTile</h1>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="home_img">
                        <div class="h_img">
                            <div class="parallax-image js-rellax" data-scroll data-scroll-speed="-1">
                                <img src="<?php echo SITEURL.$previ; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 flex">
                    <div class="sqs-block-content">
                        <span><?php echo $menu['name'];?> - <?php echo $size['size'];?> - <?php if($menu['slug'] != 'sanitaryware' && $product['series_slug'] != ''){ ?><?php echo $series['series_name'];?><?php } ?></span>
	                    <p class="wel-p"><?php echo $product['title']; ?></p>
	                </div>
                </div>
            </div>
        </div>
    </section>

    <section id="home-5" style="padding-top: 10rem;">
	    <div class="container product_rows p_boxx">		        
	        <div class="w-full">
	            <div class="col-md-4">
	                <div class="w-full">
	                    <a href="<?php echo $mainimg; ?>" data-fancybox="gallery">
                            <img src="<?php echo $img; ?>" alt="<?php echo $product['title']; ?>" class="img-responsive">
                        </a>
	                </div>
	                <div class="dflex pt-2">
                        <?php if($size['series_no_status'] == '0') {
            if(count($getproductbyseriesno) > 0 && $getproductbyseriesno != '') { ?>
                <?php  
                                  foreach($getproductbyseriesno as $sp) 
                                  { 
                                      $path ='uploads/'.$obj_fun->getImageByProductId($sp['id']);
                                      $img = SITEURL.$path.'/thumbnails/'.$sp['image'];
                                      $mimg = SITEURL.$path.'/'.$sp['image'];
                              ?>
                        <div class="grid_items">
                            <div class="product_item">
                                <a href="<?php echo $mimg; ?>" data-fancybox="gallery">
                                    <img src="<?php echo $img; ?>" alt="<?php echo $sp['title']; ?>" class="img-responsive">
                                    <div class="d_box justify-center">
                                        <h5><?php echo $sp['title']; ?></h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                                <?php } } else {
            if(count($similar) > 0 && $similar != '') {  ?>
                <?php  
                                   foreach ($similar as $value) {
                                        $similarimg = SITEURL.'uploads/product/'.$value['image'];
                              ?>
                        <div class="grid_items">
                            <div class="product_item">
                                <a href="<?php echo $similarimg ?>" data-fancybox="gallery">
                                    <img src="<?php echo $similarimg ?>" alt="<?php echo $value['name']; ?>" class="img-responsive">
                                    <div class="d_box justify-center">
                                        <h5><?php echo $value['name']; ?></h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                                <?php } } ?>
                    </div>
	            </div>
	            <div class="col-md-7 col-md-offset-1">
                    <div class="w-full" id="home-5">
                        <div class="w-full">
                            <h3><?php echo $product['title']; ?></h3>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                	<tbody>
                                		<tr>
                                			<th>Tiles Size</th>
                                			<td><?php echo $size['size'];?></td>
                                		</tr>
                                		
                                		<tr>
                                			<th>No. of Tiles Per Box</th>
                                			<td><?php echo $size['packing_number'];?></td>
                                		</tr>
                                		
                                		<tr>
                                			<th>Sq. Mtr.Per Box</th>
                                			<td><?php echo $size['sqlmtrperbox'];?></td>
                                		</tr>
                                		<tr>
                                			<th>Tile Thickness (Approx) </th>
                                			<td><?php echo $size['thickness'];?></td>
                                		</tr>
                                		
                                	</tbody>
                                </table>
                            </div>
                            <div class="dflex justify-start">
                                <a href="#" class="btns inquiry_btn" onclick="propopup();">Product Inquiry</a>
                                <a href="<?php echo SITEURL; ?>downloads" class="btns download_btn">Download Brochure</a>
                            </div>
                        </div>
                    </div>
	            </div>
            </div>
            <div class="w-full p_icons">
                <div class="dflex">
                    <div class="col-md-2 text-center">
                        <img src="<?php echo SITEURL; ?>assets/images/waterproof.png">
                        <strong>WaterProof Surface</strong>
                    </div>
                    <div class="col-md-2 text-center">
                        <img src="<?php echo SITEURL; ?>assets/images/chemical.png">
                        <strong>Chemical Resistance</strong>
                    </div>
                    <div class="col-md-2 text-center">
                        <img src="<?php echo SITEURL; ?>assets/images/frost.png">
                        <strong>Frost Resistance</strong>
                    </div>
                    <div class="col-md-2 text-center">
                        <img src="<?php echo SITEURL; ?>assets/images/lightweight.png">
                        <strong>Lightweight</strong>
                    </div>
                </div>
            </div>
	    </div>
	</section>
	<?php if(count($relatedproduct) > 0 && $relatedproduct != '') { ?>
	<section id="home-5" class="related">
	    <div class="container product_rows">
            
	        <div class="row">
                <div class="col-md-12 phead_title">
                    <h2>Related Products</h2>
                </div>
                <?php   
                                 foreach($relatedproduct as $rp){
                                         
                                 $path ='uploads/'.$obj_fun->getImageByProductId($rp['id']);
                                 $image = $path.'/thumbnails/'.$rp['image'];

                                 $rseries = "SELECT * FROM `series` where id='".$rp['series_id']."'";
                                 $rseries = $obj_fun->getlastRecords($rseries);

                                  $prourl = 'product-details/'.$menu['slug'].'/'.$size['slug'].'/'.$rseries['slug'].'/'.$rp['slug'];
                              ?>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="product_item">
                        <a href="<?php echo SITEURL.$prourl; ?>">
                            <div>
                                <img src="<?php echo SITEURL.$image; ?>" alt="<?php echo $rp['title']; ?>" class="img-responsive">
                            </div>
                            <div class="d_box">
                                <div>
                                    <h3><?php echo $rp['title']; ?></h3>
                                </div><?php /*
                                <div>
                                    <span class="new_btn">Details</span>
                                </div> */ ?>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
            
	    </div>
	</section>
	<?php } ?>
	<style>
	    .product_item img {
            height: auto;
        }
	</style>
	
	<div class="myModal-overlay" id="myModal">
        <div class="myModal" id="mPopup">
            <div class="myModal-header">
                <h3>Product Inquiry For <?php echo $product['title']; ?></h3>
                <i class="fa fa-times" onclick="Xclose();">X</i>
            </div>
            <div class="myModal-body">
                <form method="post" action="<?php echo SITEURL; ?>code.php" class="contact-form">
                    <input type="hidden" name="details" class="form-control" value="<?php echo $inq; ?>">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="text" name="name" id="name" placeholder="Name" >
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" name="phone" id="phone" placeholder="Phone">
                            <span id="phone_error" class="error"></span>
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <input type="email" name="email" id="email" placeholder="Email" >
                            <span id="email_error" class="error"></span>
                        </div>
    
                        <div class="col-md-12 form-group">
                            <textarea name="message" id="message" placeholder="Message" rows="2" style="height: auto;"></textarea>
                        </div>
                        <div class="col-md-12 form-group-two">
                            <button class="new_btn" type="submit" name="send" value="send"><span>SEND MESSAGE</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>        
    </div>
	
<?php include 'footer.php'; ?>	   

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<script type="text/javascript">
    function propopup (){
        document.getElementById("myModal").style.display = 'flex';
        // document.getElementById("myModal").style.opacity = '1';
    }
    function Xclose (){
        document.getElementById("myModal").style.display = 'none';
    }
    window.onclick = function(event) {
      if (event.target == myModal) {
        myModal.style.display = "none";
      }
    }
</script>
