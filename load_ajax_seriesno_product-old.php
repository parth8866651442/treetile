<style>
.clearnewrow
{ 
    clear:both !important;
}
.slabsize{
    height: 600px !important;
    object-fit: cover;
}

</style>
<?php
  include_once('db.php');
  require_once(admin_folder.'/function.php');
  $obj_fun = new functions();

  $orderManage = '';
  
  $series_no_status = $_REQUEST['series_no_status'];

  $col_view = $_REQUEST['col_view'];
  
  if($col_view == '2')
  {
    $col_view = 'col-md-6 col-sm-12';
  }
  elseif($col_view == '3')
  {
    $col_view = 'col-md-4 col-sm-12';
  }
  elseif($col_view == '4')
  {
    $col_view = 'col-md-3 col-sm-12';
  }
   elseif($col_view == '6')
  {
    $col_view = 'col-md-2 col-sm-12';
  }
  else{
    $col_view = 'col-md-4 col-sm-12';
  }
  
  if($_POST['sorting'] == 1)
  {
    $orderManage = " ORDER BY `title` ASC ";
  }

  $cls='';
    if($_REQUEST['menuslug'] == 'floor-tiles')
    {
      $cls = 'floor';
    }
    elseif($_REQUEST['menuslug'] == 'big-slab-tiles')
    {
      $cls = 'slab';
    }
    else
    {
      $cls = '';
    } 
  
  
  
  $finish='';
    
    if($_POST['finish'] != '' && $_POST['finish'] != '0')
    {
        $finish = " and series_id = '".$_POST['finish']."' ";
    }
    else
    {
        $finish='';     
    }
  
  $slsize='';
  if($_REQUEST['sizeslug'] == '1000-x-3000-mm')
  {
      $slsize='slabsize';
  }
  
  
  if($series_no_status == '0') 
  { 
    $psql_1 ="SELECT count(id) FROM `product` where size_id = '".$_REQUEST['sizeid']."' ".$finish."  ". $orderManage;
    $psql_1 = $obj_fun->getRecords($psql_1);
      $TotalPages = $psql_1['id'] / page_limit_level_3;

    $psql ="SELECT * FROM `product` where size_id = '".$_REQUEST['sizeid']."' ".$finish."  GROUP BY `series_no` ". $orderManage ." limit  ".$_REQUEST['start']*$_REQUEST['limit'].",".$_REQUEST['limit']."";
    $psql = $obj_fun->getRecords($psql);
    
    if(isset($psql) && count($psql) > 0 && $psql != '') {  ?>
       
      <?php 
     

    foreach($psql as $p ) 
    {
        
                                  
      $getseriesno = "SELECT * FROM `series_no` where id=".$p['series_no'];
            $getseriesno = $obj_fun->getLastRecords($getseriesno);
            
            $getproductbyseriesno = "SELECT * FROM `product` where series_no='".$getseriesno['id']."'";
            $getproductbyseriesno = $obj_fun->getRecords($getproductbyseriesno);
    ?>

                    <div class="row">
                        <div class="col-md-12 phead_title">
                            <h2><?php echo $getseriesno['series_no_name']; ?></h2>
                        </div>
    <?php 
              $data = $obj_fun->swapvalue($getproductbyseriesno);
    
            foreach($data as $gp) 
                {
                
              
          /*$printinspiration = "SELECT * FROM `inspiration` where id=".$gp['inspiration_id'];
          $printinspiration = $obj_fun->getLastRecords($printinspiration);*/

          $menu = "SELECT * FROM `menu` where id='".$gp['menu_id']."'";
                $menu = $obj_fun->getlastRecords($menu);

                $size = "SELECT * FROM `product_size` where id='".$gp['size_id']."'";
                $size = $obj_fun->getlastRecords($size);
            
                $series = "SELECT * FROM `series` where id='".$gp['series_id']."'";
                $series = $obj_fun->getlastRecords($series);

        
          $path ='uploads/'.$obj_fun->getImageByProductId($gp['id']);
          $img = SITEURL.$path.'/'.$gp['image'];
          $views = SITEURL.$path.'/'.$gp['view'];

          $databasedate = $gp['time'];
                    $add3days = date('Y-m-d', strtotime($databasedate. ' + 5 days'));

                    if($add3days >= date("Y-m-d"))
                    {
                        $ne = '<span class="product-badge red">New</span>';
                    }
                    else
                    {
                        $ne = 
                        '<span class="product-badge red" style="display: none;">New</span>' ;
                    }
          
          $url ='product-details'.'/'.$menu['slug'].'/'.$size['slug'].'/'.$series['slug'].'/'.$gp['slug'];
          
         ?>
                        <div class="col-sm-12 col-sm-6 col-md-4">
                            <div class="product_item">
                                <a href="<?php echo SITEURL.$url; ?>">
                                    <div>
                                        <img src="<?php echo $img; ?>" alt="<?php echo $gp['title']; ?>" class="img-responsive">
                                    </div>
                                    <div class="d_box">
                                        <div>
                                            <h3><?php echo $gp['title']; ?></h3>
                                            <p><?php echo $size['size']; ?></p>
                                            <p><?php echo $series['series_name']; ?></p>
                                        </div>
                                        <div>
                                            <span class="new_btn">Details</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>


                            <?php /*
   <div class="<?php echo $col_view ;?> "> 
      <div class="item item-0">
         <a class="a-item" href="<?php echo SITEURL.$url; ?>">
            <span class="bg-img">
               <picture data-alt="" data-default-src="<?php echo $img; ?>">
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 480px)" />
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 768px)" />
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1200px)" />
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1320px)" />
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1420px)" />
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" />
                  <img alt="" src="<?php echo $img; ?>" />
               </picture>
            </span>
            <span class="img">
               <picture data-alt="" data-default-src="<?php echo $img; ?>">
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 480px)" />
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1200px)" />
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1320px)" />
                  <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" />
                  <img alt="" src="<?php echo $img; ?>" />
               </picture>
            </span>
            <span class="info">
               <h3><?php echo $gp['title']; ?></h3>
               <p>
                  <?php echo $menu['name']; ?> |
                  <?php echo $size['size']; ?> |
                  <?php echo $series['series_name']; ?>                     
               </p>
            </span>
            <span class="more"><span></span></span>
            <span class="clearfix"></span>
         </a>
      </div>
   </div> */ ?>

       <?php  } ?>
  </div>
  <?php  } ?>  
<?php } 
    else
    {
    if($_REQUEST['start'] <= $TotalPages){ 
      include "includes/coming.php";
    }
    }
  }
  elseif($series_no_status == '1')
  {
    $psql_1 ="SELECT count(id) FROM `product` where size_id = '".$_REQUEST['sizeid']."' ".$finish." ". $orderManage;
    $psql_1 = $obj_fun->getLastRecords($psql_1);
    
    $TotalPages = $psql_1['count(id)'] / page_limit_level_2;

    $psql ="SELECT * FROM `product` where size_id = '".$_REQUEST['sizeid']."' ".$finish." ". $orderManage ." limit  ".$_REQUEST['start']*$_REQUEST['limit'].",".$_REQUEST['limit']."";
    
    $psql = $obj_fun->getRecords($psql);
    
    if(isset($psql) && count($psql) > 0 && $psql != '') { ?>
     <div class="row">
    <?php 
     $i = 0;
    
        $clear = '';
        
        foreach($psql as $p)  
    {
        if($i%$_REQUEST['col_view'] == 0)
              {
                $clear = 'clearnewrow';
              }
              else
              {
                $clear = '';
              }
                                  
      $menu = "SELECT * FROM `menu` where id='".$p['menu_id']."'";
        $menu = $obj_fun->getlastRecords($menu);

        $size = "SELECT * FROM `product_size` where id='".$p['size_id']."'";
            $size = $obj_fun->getlastRecords($size);
        
            $series = "SELECT * FROM `series` where id='".$p['series_id']."'";
            $series = $obj_fun->getlastRecords($series);

      $path ='uploads/'.$obj_fun->getImageByProductId($p['id']);
      $img = SITEURL.$path.'/'.$p['image'];

      $views = SITEURL.$path.'/'.$p['view'];

      $url ='product-details'.'/'.$menu['slug'].'/'.$size['slug'].'/'.$series['slug'].'/'.$p['slug'];

      $databasedate = $p['time'];
                    $add3days = date('Y-m-d', strtotime($databasedate. ' + 5 days'));

                    if($add3days >= date("Y-m-d"))
                    {
                        $ne = '<span class="product-badge red">New</span>';
                    }
                    else
                    {
                        $ne = 
                        '<span class="product-badge red" style="display: none;">New</span>' ;
                    }
  ?>
                        <div class="col-sm-12 col-sm-6 col-md-4">
                            <div class="product_item">
                                <a href="<?php echo SITEURL.$url; ?>">
                                    <div>
                                        <img src="<?php echo $img; ?>" alt="<?php echo $p['title']; ?>" class="img-responsive">
                                    </div>
                                    <div class="d_box">
                                        <div>
                                            <h3><?php echo $p['title']; ?></h3>
                                            <p><?php echo $size['size']; ?></p>
                                            <p><?php echo $series['series_name']; ?></p>
                                        </div>
                                        <div>
                                            <span class="new_btn">Details</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                            
      <?php /* 
      <div class="<?php echo $col_view ;?> <?php echo $clear ;?> ">
        <div class="item item-0">
           <a class="a-item" href="<?php echo SITEURL.$url; ?>">
              <span class="bg-img">
                 <picture data-alt="" data-default-src="<?php echo $img; ?>">
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 480px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 768px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1200px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1320px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1420px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" />
                    <img alt="" src="<?php echo $img; ?>" class="<?php echo $slsize; ?>"/>
                 </picture>
              </span>
              <span class="img">
                 <picture data-alt="" data-default-src="<?php echo $img; ?>">
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 480px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1200px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1320px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" />
                    <img alt="" src="<?php echo $img; ?>" />
                 </picture>
              </span>
              <span class="info">
                 <h3><?php echo $p['title']; ?></h3>
                 <p>
                    <?php echo $menu['name']; ?> |
                    <?php echo $size['size']; ?> |
                    <?php echo $series['series_name']; ?>                     
                 </p>
              </span>
              <span class="more"><span></span></span>
              <span class="clearfix"></span>
           </a>
        </div>
     </div> */ ?>

  <?php $i++;  } ?>
</div>
  <?php } 
    else
    {
    if($_REQUEST['start'] <= $TotalPages){ 
      include "includes/coming.php";
    }
    }
    
  }
  else
  {
    $psql_1 ="SELECT count(id) FROM `product` where size_id = '".$_REQUEST['sizeid']."' ". $orderManage;
    $psql_1 = $obj_fun->getLastRecords($psql_1);
    
    $TotalPages = $psql_1['count(id)'] / page_limit_level_1;

    $psql ="SELECT * FROM `product` where size_id = '".$_REQUEST['sizeid']."'  ". $orderManage ." limit  ".$_REQUEST['start']*$_REQUEST['limit'].",".$_REQUEST['limit']."";
    
    $psql = $obj_fun->getRecords($psql);

    if(isset($psql) && count($psql) > 0 && $psql != '') { 
    ?>
        <div class="row">
        
          <?php 
          $i = 0;
    
        $clear = '';
            foreach($psql as $p)  
            {
                if($i%$_REQUEST['col_view'] == 0)
                {
                    $clear = 'clearnewrow';
                }
                else
                {
                    $clear = '';
                }
              
              $menu = "SELECT * FROM `menu` where id='".$p['menu_id']."'";
          $menu = $obj_fun->getlastRecords($menu);

          $size = "SELECT * FROM `product_size` where id='".$p['size_id']."'";
              $size = $obj_fun->getlastRecords($size);
          
              $series = "SELECT * FROM `series` where id='".$p['series_id']."'";
              $series = $obj_fun->getlastRecords($series);

        
        $path ='uploads/'.$obj_fun->getImageByProductId($p['id']);
        $img = SITEURL.$path.'/'.$p['image'];
        $views = SITEURL.$path.'/'.$p['view'];

        $url ='product-details'.'/'.$menu['slug'].'/'.$_POST['sizeslug'].'/'.$p['slug'];
        
        $databasedate = $p['time'];
                    $add3days = date('Y-m-d', strtotime($databasedate. ' + 5 days'));

                    if($add3days >= date("Y-m-d"))
                    {
                        $ne = '<span class="product-badge red">New</span>';
                    }
                    else
                    {
                        $ne = 
                        '<span class="product-badge red" style="display: none;">New</span>' ;
                    }

          ?>
                        <div class="col-sm-12 col-sm-6 col-md-4">
                            <div class="product_item">
                                <a href="<?php echo SITEURL.$url; ?>">
                                    <div>
                                        <img src="<?php echo $img; ?>" alt="<?php echo $p['title']; ?>" class="img-responsive">
                                    </div>
                                    <div class="d_box">
                                        <div>
                                            <h3><?php echo $p['title']; ?></h3>
                                            <p><?php echo $size['size']; ?></p>
                                        </div>
                                        <div>
                                            <span class="new_btn">Details</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
       
                            
           <?php /*
          <div class="<?php echo $col_view ;?> <?php echo $clear ;?>">
        <div class="item item-0">
           <a class="a-item" href="<?php echo SITEURL.$url; ?>">
              <span class="bg-img">
                 <picture data-alt="" data-default-src="<?php echo $img; ?>">
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 480px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 768px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1200px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1320px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1420px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" />
                    <img alt="" src="<?php echo $img; ?>" />
                 </picture>
              </span>
              <?php if($menu['slug'] != 'sanitaryware'){ ?>
              <span class="img">
                 <picture data-alt="" data-default-src="<?php echo $img; ?>">
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 480px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1200px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" media="(max-width: 1320px)" />
                    <source srcset="<?php echo $img; ?> 1x, <?php echo $img; ?> 2x" />
                    <img alt="" src="<?php echo $img; ?>" />
                 </picture>
              </span>
          <?php } ?>
              <span class="info">
                 <h3><?php echo $p['title']; ?></h3>
                 <p>
                    <?php echo $menu['name']; ?> |
                    <?php echo $size['size']; ?> 
                 </p>
              </span>
              <span class="more"><span></span></span>
              <span class="clearfix"></span>
           </a>
        </div>
     </div> */ ?>
          <?php $i++;  } ?>
        </div>
  <?php } 
          else
          {
            if($_REQUEST['start'] <= $TotalPages){ 
                include "includes/coming.php";
            }
          }
          
        }
        
    ?>