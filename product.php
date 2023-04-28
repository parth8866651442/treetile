<?php
    $metapage = 'Products';
    $metapageid = 'Products';
?>
<?php include'header.php'; ?>
<?php
    
    $menu = $_REQUEST['menu_id'];
    $size = $_REQUEST['size_id'];
    
    $getmenu = "SELECT * FROM `menu` where slug='".$menu."'";
    $getmenu = $obj_fun->getLastRecords($getmenu);
    
    $getsize = "select * from `product_size` where slug='".$size."' and menu_id='".$getmenu['id']."'";
    $getsize = $obj_fun->getLastRecords($getsize);
    
    if($_REQUEST['series_id'] != '')
    {
        $getseries = "select * from `series` where slug='".$_REQUEST['series_id']."' and product_size_id='".$getsize['id']."' ORDER BY `order` asc ";
        $getseries = $obj_fun->getLastRecords($getseries);
    }
    else
    {
        $getseries = "select * from `series` where product_size_id='".$getsize['id']."' ORDER BY `order` asc";
        $getseries = $obj_fun->getLastRecords($getseries);
    }

    
  $inq = '';
  $inq = $getmenu['name'].' / '.$getsize['size'];
?>

<?php
    
    if($getsize['series_no_status'] == '0') 
   {
      $product ="SELECT * FROM `product` where size_id = '".$getsize['id']."' and series_id='".$getseries['id']."' GROUP BY `series_no` ORDER BY `series_no` asc";
      $product = $obj_fun->getRecords($product);
    
      //$limit = page_limit_level_3;
      $limit = 12;
      $total_pages  = count($product) / $limit; 
    }
    elseif($getsize['series_no_status'] == '1')
    {
        $product ="SELECT * FROM `product` where size_id = '".$getsize['id']."' and series_id='".$getseries['id']."'  ORDER BY `title` asc";
        $product = $obj_fun->getRecords($product);
        
        //$limit = page_limit_level_2;
        $limit = 12;
        $total_pages  = count($product) / $limit; 
    }
    else
    {
         $product ="SELECT * FROM `product` where size_id = '".$getsize['id']."' ORDER BY `title` asc";
         $product = $obj_fun->getRecords($product);
         //$limit = page_limit_level_1;
         $limit = 12;
         $total_pages  = count($product) / $limit; 
    }

    if ($getmenu['slug'] != 'sanitaryware') {
       $sizez='Size';

    }else{
       $sizez='Product';

    } 
?>
    <section id="header_main">
        <div class="hdr_main">
            <div class="vr_title">
                <h1>Tree Tile</h1>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="home_img">
                        <div class="h_img">
                            <div class="parallax-image js-rellax" data-scroll data-scroll-speed="-1">
                                <img src="<?php echo SITEURL; ?>assets/img/pheader.jpg" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 flex">
                    <div class="sqs-block-content">
                        <span><?php echo $getsize['size']; ?></span>
	                    <p class="wel-p"><?php echo $getmenu['name']; ?></p>
	                </div>
                </div>
            </div>
        </div>
    </section>

    <section id="home-5" style="padding-top: 10rem;">
	    <div class="container-fluid product_rows">	
	        <div class="row">
	            <div class="col-md-3">
	                <div class="filter">
                        <div class="filter_heading">
                            <h5><img src="<?php echo SITEURL; ?>assets/images/filter.png">FILTER BY</h5>
                        </div>
                        <div class="filter_item">
                            <h5>Category</h5>
                            <div class="filter_box">
                                <?php
                                 $menu ="select * from menu where status='1' order BY `order` asc";
                                 $menu = $obj_fun->getRecords($menu);
                                 foreach($menu as $mn) 
                                    {
                                       
                                       global $con;

                                        $result="SELECT menu_id FROM `product` where menu_id='".$mn['id']."'  ORDER BY `order` asc";
                                        $result = mysqli_query($con,$result);
                                        $rowcount=mysqli_num_rows($result);


                                       $size ="select * from `product_size` where menu_id='".$mn['id']."' order BY `order` asc limit 1";
                                       $size = $obj_fun->getLastRecords($size);

                                       $menuurl ='product/'.$mn['slug'].'/'.$size['slug'];
                                    ?>
                                <a class="filter_link" href="<?php echo SITEURL.$menuurl; ?>"><?php echo $mn['name'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="filter_item">
                            <h5>Size</h5>
                            <div class="filter_box">
                                <?php 
                                        $allsize ="select * from `product_size` where menu_id='".$getmenu['id']."' order BY `order` asc ";
                                       $allsize = $obj_fun->getRecords($allsize);
                                       
                                       if(count($allsize) > 0 && $allsize != '')
                                       {
                                          
                                          foreach($allsize as $s)
                                          { 
                                             
                                             global $con;

                                                $sresult="SELECT size_id FROM `product` where size_id='".$s['id']."'  ORDER BY `order` asc";
                                                $sresult = mysqli_query($con,$sresult);
                                                $srowcount=mysqli_num_rows($sresult);

                                             $sizeurl ='product/'.$getmenu['slug'].'/'.$s['slug'];
                                             ?>
                                <a class="filter_link" href="<?php echo SITEURL.$sizeurl; ?>"><?php echo $s['size']; ?></a>
                            <?php } } ?>
                            </div>
                        </div>
                        <?php  if ($getmenu['slug'] != 'sanitaryware') {
                        $allseries = "select * from `series` where product_size_id='".$getsize['id']."'";
                        $allseries = $obj_fun->getRecords($allseries);
                        if(count($allseries) > 0 && $allseries != ''){
                    ?>
                        <div class="filter_item">
                            <h5>Surface</h5>
                            <div class="filter_box">
                                <a href="javascript:void(0)" data-finishid="0" data-finishname="<?php echo $sr['series_name'];?>" class="finish fns_0">All Finish</a>
                                <?php foreach($allseries as $sr) { 
                                              global $con;

                                              $seresult="SELECT series_id FROM `product` where series_id='".$sr['id']."'  ORDER BY `order` asc";
                                              $seresult = mysqli_query($con,$seresult);
                                              $serowcount=mysqli_num_rows($seresult);

                                               ?>
                                <a href="javascript:void(0)" data-finishid="<?php echo $sr['id'];?>" class="finish fns_<?php echo $sr['id'];?>" data-caption=""><?php echo $sr['series_name']; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
	            </div>
	            <input type="text" value="<?php echo $total_pages; ?>" style="display:none" id="total_pages">
	            <div class="col-md-9" id="ajax_load_data">
                    <?php /*
	                <div class="row">
                        <div class="col-md-12 phead_title">
                            <h2>1001</h2>
                        </div>
                        <div class="col-sm-12 col-sm-6 col-md-4">
                            <div class="product_item">
                                <a href="product_detail.php">
                                    <div>
                                        <img src="<?php echo SITEURL; ?>assets/images/o_1dp4ui81c1hap1idfmnt1u887k327.jpg" class="img-responsive">
                                    </div>
                                    <div class="d_box">
                                        <div>
                                            <h3>1001_HL1</h3>
                                            <p>300 x 450 MM</p>
                                        </div>
                                        <div>
                                            <span class="new_btn">Details</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-sm-6 col-md-4">
                            <div class="product_item">
                                <a href="#">
                                    <div>
                                        <img src="<?php echo SITEURL; ?>assets/images/o_1dp4ui81ceg31arodmgbp8af28.jpg" class="img-responsive">
                                    </div>
                                    <div class="d_box">
                                        <div>
                                            <h3>1001_L</h3>
                                            <p>300 x 450 MM</p>
                                        </div>
                                        <div>
                                            <span class="new_btn">Details</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    
        	        <div class="row">
                        <div class="col-md-12 phead_title">
                            <h2>1004</h2>
                        </div>
                        <div class="col-sm-12 col-sm-6 col-md-4">
                            <div class="product_item">
                                <a href="#">
                                    <div>
                                        <img src="<?php echo SITEURL; ?>assets/images/o_1dp4ui81c11hq35db9g163i1dp329.jpg" class="img-responsive">
                                    </div>
                                    <div class="d_box">
                                        <div>
                                            <h3>1004_D</h3>
                                            <p>300 x 450 MM</p>
                                        </div>
                                        <div>
                                            <span class="new_btn">Details</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-sm-6 col-md-4">
                            <div class="product_item">
                                <a href="#">
                                    <div>
                                        <img src="<?php echo SITEURL; ?>assets/images/o_1dp4ui81c15ovi75ugi19721em22a.jpg" class="img-responsive">
                                    </div>
                                    <div class="d_box">
                                        <div>
                                            <h3>1004_HL1</h3>
                                            <p>300 x 450 MM</p>
                                        </div>
                                        <div>
                                            <span class="new_btn">Details</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-sm-6 col-md-4">
                            <div class="product_item">
                                <a href="#">
                                    <div>
                                        <img src="<?php echo SITEURL; ?>assets/images/o_1dp4ui81cb1vc4a10ds6316lb2b.jpg" class="img-responsive">
                                    </div>
                                    <div class="d_box">
                                        <div>
                                            <h3>1004_L</h3>
                                            <p>300 x 450 MM</p>
                                        </div>
                                        <div>
                                            <span class="new_btn">Details</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div> */ ?>   
	            </div>
                <div class="comingsoon" style="display:none">
                <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12"></div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        
                        <center><p style="font-weight: 600;font-size: 100px;padding-top: 60px;color: #fff;">COMING SOON </p></center>
                    </div> 
    <div class="col-lg-3"></div>
</div>
</div>
                    <div class="row load_more_view" style="margin-top:50px">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                        <div class="load_more">
                          <center>
                             <img src="<?php echo SITEURL; ?>includes/productloadmore.gif" >
                           </center>
                        </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
	        </div>
            
	    </div>
	</section>
	
<?php include 'footer.php'; ?>	 
<script type="text/javascript">

    jQuery('body').on('touchmove', onScroll); // for mobile
    jQuery(window).on('scroll', onScroll); 

    jQuery('body').scrollTop(0); 
    var total_pages = <?php echo ceil($total_pages); ?>;
    var start = 0;
    var limit = <?php echo $limit; ?>;
    var loaddatamore = 1;
   
   
   var menuid = '<?php echo $getmenu['id']; ?>';
   var sizeid = '<?php echo $getsize['id']; ?>';
   //var seriesid = '<?php echo $getseries['id']; ?>';
   
   var series_no_status = '<?php echo $getsize['series_no_status']; ?>'; 
   
   var col_view = '<?php echo $getsize['col_view']; ?>'; 
   
   // name 
   
   var menuname = '<?php echo $getmenu['name']; ?>';
   var sizename = '<?php echo $getsize['size']; ?>';
   //var seriesname = '<?php echo $getseries['series_name']; ?>';
   
   // slug
   
   var menuslug = '<?php echo $getmenu['slug']; ?>';
   var sizeslug = '<?php echo $getsize['slug']; ?>';
   //var seriesslug = '<?php echo $getseries['slug']; ?>';
   
   
   var sorting = 1;
   
  var finish = "";
      jQuery(document).on("click",".finish", function(){
        finish = jQuery(this).data("finishid");
        $(".finish").removeClass('checkmark');
        $(".fns_"+finish).addClass('checkmark');
        start = 0;
      jQuery("#ajax_load_data").empty();
      loadMoreData();
    });

   
   function onScroll()
   { 
      if((jQuery(window).scrollTop() + jQuery(window).innerHeight()) >= jQuery(document).height() - 625)
      {
         loadMoreData();
      }
   }
    
    if(start == 0){ loadMoreData();}
    
    function loadMoreData()
    {
        setTimeout(function(){
            
            
            
                if(start < total_pages){
            
            jQuery('.comingsoon').hide();
            
                var datapost = {'start': start,'limit':limit,'menuid':menuid,'sizeid':sizeid,'menuname':menuname,'sizename':sizename,'menuslug':menuslug,'sizeslug':sizeslug,'finish':finish,'total_pages':total_pages,'sorting':sorting,'series_no_status':series_no_status,'col_view':col_view};
            
            if(loaddatamore!==0)    {
                // alert('hello');
                    jQuery.ajax({
                        url:"<?php echo SITEURL; ?>load_ajax_seriesno_product.php",
                        method:"POST",
                        data:datapost,
                        cache:false,
                        beforeSend: function() {
                            loaddatamore = 0; 
                            jQuery('.load_more_view').show();
                            jQuery('body').scrollTop(0); 
                        },
                        success:function(data)
                        {
                     //jQuery("#ajax_load_data").empty();
                            jQuery("#ajax_load_data").append(data);
                            jQuery('body').scrollTop(0);  
                            jQuery('.load_more_view').hide();
                            start++;
                        },
                        complete: function() {
                            setTimeout(function(){
                                loaddatamore = 1;
                            }, 1000);

                        }
                    });
                
                    if(start >= (total_pages/limit)-1){
                  jQuery('.load_more_view').hide();
                    }
                }else{
                    jQuery('.comingsoon').hide();
                }
            }
            else
            {
            jQuery('.load_more_view').hide();
            if(total_pages == '0') 
            {
               jQuery('.comingsoon').show();
            }
            }
        }, 1000);
        
        if(start < total_pages)
      {
         jQuery('.load_more_view').show();
        }
} 
jQuery(window).trigger('scroll');
</script>  