<?php include_once('pages.php'); ?>
<?php
        $masteradmin = $obj_fun->getUser('master-admin');
?>

<figure class="user-profile"> <img alt="Admin" src="<?php echo $masteradmin['icon']; ?>">
  <figcaption> <a href="#">Admin</a> <em><?php echo company;?></em> </figcaption>
</figure>
<ul class="sidebar-actionbar navigations">
  <li><a href="setting.php" onMouseOver="active(this)" onMouseOut="inactive(this)">Settings</a></li>
  <li><a href="logout.php" onMouseOver="active(this)" onMouseOut="inactive(this)">Log out</a></li>
</ul>
<nav class="main-navigation navigations" role="navigation">
  <ul class="dynamic-menu" id="megaUber">
    <li id="home" > <a href="index.php" class="no-submenu"><span class="fam-house"></span>Dashboard</a> </li>
    <?php if($obj_fun->getMetaData('frontmenu') == 1){?>
    <li id="frontmenu" > <a href="menu.php" class="no-submenu"> <span class="awe-tasks"> </span> &nbsp;Main Menu</a></li>
    <?php } ?>
    
    <!-- - - - - -  - - - - - - - - - - - 
    -  - ADD BY VISHAL 17-12-19 START - 
    - - - - - - - - - - - - - - - - - -->
    <li id="inquiry"> <a href="#"><span class="fam-world-edit"></span>All Inquiry</a>
      <ul>
        <?php if($obj_fun->getMetaData('register_inquiry') == 1){?>
        <li id="register"><a href="register.php" class="no-submenu"><span class="fam-report-picture"></span>Register Inquiry</a></li>
        <?php } ?>
        <?php if($obj_fun->getMetaData('contact') == 1){?>
        <li id="contact"><a href="contact.php" class="no-submenu"><span class="awe-phone"></span>Contact Inquiry </a></li>
        <?php if($obj_fun->getMetaData('product-inquiry') == 1){?>
        <li id="pcontact"><a href="product-inquiry.php" class="no-submenu"><span class="awe-truck"></span>Product Inquiry </a></li>
        <?php } ?>
        <?php if($obj_fun->getMetaData('career') == 1){?>
        <li id="cinquiry"><a href="career_inquiry.php" class="no-submenu"><span class="icon-user"></span>Career Inquiry </a></li>
        <?php } ?>
        <!-- <li id="pcontact"><a href="blog.php" class="no-submenu"><span class="awe-phone"></span>Blog Inquiry </a></li> -->
      </ul>
    </li>
    
    <li id="newgallery" > <a href="#"><span class="fam-pictures"></span>Image Gallery</a>
      <ul>
        <?php if($obj_fun->getMetaData('slider') == 1){?>
        <li id="slider" ><a href="slider.php"><span class="awe-picture"></span>Slider</a></li>
        <?php } ?>
        <?php if($obj_fun->getMetaData('infrastructure') == 1 ){?>
        <li id="infrastructure" ><a href="infrastructure-gallary.php"><span class="awe-picture"></span>Infrastructure</a></li>
        <?php } ?>
        <?php if($obj_fun->getMetaData('advertisement') == 1){?>
        <li id="advertisement" ><a href="advertisement.php" class="no-submenu"><span class="awe-picture"></span>Advertisement</a></li>
        <?php } ?>
        <?php if($obj_fun->getMetaData('showroom') == 1){?>
        <li id="showroom" ><a href="showroom.php" class="no-submenu"><span class="awe-picture"></span>Live Photos</a></li>
        <?php } ?>
        <?php if($obj_fun->getMetaData('gallery') == 1){?>
        <li id="gallery"><a href="#"><span class="awe-picture"></span>Application</a>
          <ul style="display: none;" class="dynamic-menu" >
            <li id="new"><a class="no-submenu" href="gallery-category.php"><span class="fam-sitemap"></span>Category</a></li>
            <?php $category = $obj_fun->getCategory();
                            if(isset($category) && $category !=''){ 
                                foreach($category as $s){?>
            <li id="<?php echo $s['id']; ?>"> <a class="no-submenu" href="gallery.php?type=<?php echo $s['id']; ?>"><span class="fam-arrow-right"></span><?php echo $s['name']; ?></a> </li>
            <?php }}?>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </li>
    <!-- ADD BY VISHAL 17-12-19 OVER -->
    
    <?php if($obj_fun->getMetaData('frontcontact') == 1){?>
    <li id="ManagedContact"> <a href="javascript:void(0)"><span class="fam-report-picture"></span>Managed Contact Details</a>
      <ul style="display: none;" class="dynamic-menu" >
        <li id="Domesticcontact"><a class="no-submenu" href="domesticcontact.php"><span class="fam-book-open"></span>Domestic Contact</a></li><?php /*
      <li id="Exportcontact"><a class="no-submenu" href="internationalcontact.php"><span class="fam-book-open"></span>Export Contact</a></li> */ ?>
      </ul>
    </li>
    <?php } ?>
    
    <!--Admin_Panel_Change == Other Admin Panel <br>(product,websit-etext)-->
    <?php if($obj_fun->getMetaData('product')  == 1){?>
    <?php if($obj_fun->getMetaData('ceramic_application')  == 1){ ?>
    <li id="ceramic_application" ><a href="ceramic_application.php"><span class="fa fa-bed" style="margin-right:15px"></span>Ceramic Application</a></li>
    <?php } ?>
    <?php if($obj_fun->getMetaData('product_inspiration')  == 1){ ?>
    <li id="product_inspiration" ><a href="ceramic_inspiration.php"><span class="fa fa-lightbulb-o" style="margin-right:15px"></span> Ceramic Inspiration</a></li>
    <?php } ?>
    <?php if($obj_fun->getMetaData('tiles_color')  == 1){ ?>
    <li id="Tiles_Color"><a href="color.php"><span class="fam-color-swatch"></span>Tiles Color</a></li>
    <?php } ?>
    <li id="menu-size" ><a href="menu-control.php"><span class="fam-wrench"></span>Add Ceramic Product</a></li>
    <li id="product-size" ><a href="product-size-control.php"><span class="fam-wrench"></span>Product Size Management</a>
      <ul style="display: none;" class="dynamic-menu" >
        <?php if($obj_fun->getMetaData('product') == 1 ){?>
        <?php 
            $sidebar = $obj_fun->getMenu();
            if($sidebar['menu_status'] == 'three_level_menu') {
                unset($sidebar['menu_status']);
                foreach($sidebar as $menu){
                    echo '<li id="level_1_'.preg_replace('/[^A-Za-z0-9\-]/', '', $menu['name']).'" ><a href="#"><span class="awe-folder-open"></span>'.$menu['name'].'</a>';
                    if(isset($menu['size']) && $menu['size'] !=''){
                        echo '<ul>';
                        foreach($menu['size'] as $size){
                            if($size['series_no_status'] == 2){
                                echo '<li id="product_'.$size['id'].'"><a href="design.php?size='.$size['id'].'"><span class="fam-arrow-right"></span>'.$size['size'].'</a></li>';
                            }
                            else{
                                echo '<li id="level_2_'.$size['id'].'"><a href="#" ><span class="fam-chart-organisation"></span>'.$size['size'].'</a>';
                                echo '<ul>';
                                    echo '<li id="series_'. $size['id'].'"><a href="series.php?action=newseries&size='. $size['id'].'"><span class="fam-sitemap"></span>Manage Series</a></li>';
                                    if(isset($size['series']) && $size['series'] !=''){
                                        if($size['series_no_status'] == 0)
                                            echo '<li id="seriesno_'.$size['id'].'"><a href="series-no.php?action=newseriesno&size='.$size['id'].'"><span class="fam-sitemap"></span>Manage Series Number</a></li>';
                                        
                                        foreach($size['series'] as $series){
                                            if($size['series_no_status'] == 1)
                                                echo '<li id="product_'.$series['id'].'" ><a href="products.php?size='.$size['id'].'&series='.$series['id'].'"><span class="fam-arrow-right"></span>'.$series['series_name'].'</a></li>';
                                            else {
                                                if($size['series_no_status'] == 3)
                                                    echo '<li id="product_'.$series['id'].'"><a href="design-series-description.php?size='.$size['id'].'&series='.$series['id'].'"><span class="fam-arrow-right"></span>'.$series['series_name'].'</a></li>';
                                                else
                                                    echo '<li id="product_'.$series['id'].'"><a href="product.php?size='.$size['id'].'&series='.$series['id'].'"><span class="fam-arrow-right"></span>'.$series['series_name'].'</a></li>';
                                            }   
                                        }
                                    }
                                echo '</ul>';
                            }
                        }
                        echo '</ul>';
                    }       
                    echo '</li>';
                }           
                                
            }
        
        } ?>
      </ul>
    </li>
    <?php } ?>
    <?php if($obj_fun->getMetaData('Admin_Panel_Change') == 1 ){            
    ?>
    <li id="product_admin_other"><a href="#"><span class="fam-folder-page"></span>Products</a>
      <ul style="display: none;" class="dynamic-menu" >
        <li id="p_a_new"><a class="no-submenu" href="product_admin.php"><span class="fam-chart-organisation"></span>Add Products</a></li>
        <li id="p_a_view"><a class="no-submenu" href="product_admin_view.php"><span class="fam-chart-organisation"></span>View Products</a></li>
      </ul>
    </li>
    <?php  } ?>
    <?php if($obj_fun->getMetaData('catalogue') == 1){?>
    <li id="catalogue"><a href="catalogue.php" class="no-submenu"><span class="fam-report-picture"></span>E-catalogue</a></li>
    <?php } ?>
    <?php /*
    <li id="catalogue"><a href="certificate.php" class="no-submenu"><span class="fam-report-picture"></span>Certificate</a></li> */ ?>
    
    <?php if($obj_fun->getMetaData('headerimage') == 1 ){?>
    <li id="header_image"><a href="header_image.php" class="no-submenu"><span class="fam-picture"></span>Header Image</a></li>
    <?php } ?>
    <li id="m-media"><a href="#"><span class="icon-facetime-video"></span> &nbsp; Managed Media</a>
        <ul style="display: none;" class="dynamic-menu" >
            <?php if($obj_fun->getMetaData('event')  == 1 ){?>
            <li id="media"><a href="#"><span class="fam-chart-organisation"></span>Exhibition & Event</a>
              <ul style="display: none;" class="dynamic-menu" >
                

                <li id="m_new"><a class="no-submenu" href="media1.php"><span class="fam-report-picture"></span>Add Event</a></li>
                <li id="m_view"><a class="no-submenu" href="media-view1.php"><span class="fam-report-picture"></span>View Events</a></li>
              </ul>
            </li>
            <?php } ?>

            <?php if($obj_fun->getMetaData('blog')  == 1){?>
            <li id="blog"><a href="#"><span class="fam-chart-organisation"></span>Our Blog</a>
              <ul style="display: none;" class="dynamic-menu" >
                <li id="b_new"><a class="no-submenu" href="addblog.php"><span class="fam-report-picture"></span>Add Blog</a></li>
                <li id="b_view"><a class="no-submenu" href="viewblog.php"><span class="fam-report-picture"></span>View Blog</a></li>
              </ul>
            </li>
            <?php } ?>
            <?php if($obj_fun->getMetaData('news-with-one-image-and-detail') == 1){?>
            <li id="onews"><a href="#"><span class="fam-chart-organisation"></span>Our News</a>
              <ul style="display: none;" class="dynamic-menu" >
                <li id="onew"><a class="no-submenu" href="news.php"><span class="fam-report-picture"></span>Add News</a></li>
                <li id="oview"><a class="no-submenu" href="news-view.php"><span class="fam-report-picture"></span>View News</a></li>
              </ul>
            </li>
            <?php } ?>
            <?php if($obj_fun->getMetaData('news_video')  == 1){?>
                <li id="news"><a href="#"><span class="fam-chart-organisation"></span>News With Video</a>
                  <ul style="display: none;" class="dynamic-menu" >
                    <li id="enews"><a class="no-submenu" href="media.php"><span class="fam-chart-organisation"></span>Add News With Video</a></li>
                    <li id="vnews"><a class="no-submenu" href="media-view.php"><span class="fam-chart-organisation"></span>View News With Video</a></li>
                  </ul>
                </li>
            <?php } ?>
            <?php if($obj_fun->getMetaData('video') == 1 ){?>
                <li id="video" ><a href="video.php"><span class="icon-facetime-video"></span>Video</a></li> 
            <?php } ?>
        </ul>

    </li>
    <?php 
    if($obj_fun->getMetaData('product')  == 1){ ?>
    <li id="string"><a href="#"><span class="fam-information"></span>Information</a>
      <ul style="display: none;" class="dynamic-menu">
        <?php foreach($totalsection as $sec){ ?>
        <li id="<?php echo $sec['key'] ?>"><a class="no-submenu" href="string.php?type=<?php echo $sec['key']; ?>"><span class="fam-report-picture"></span><?php echo $sec['name'] ?></a></li>
        <?php } ?>
      </ul>
    </li>
    <?php } ?>
    <?php } ?>
    
    <!--  <?php if($obj_fun->getMetaData('register_user') == 1){?>
    
    <li id="register_user"><a href="register.php" class="no-submenu"><span class="fam-report-picture"></span>Register User</a></li>
    <?php } ?> -->
    
    <?php /*if($obj_fun->getMetaData('Admin_Panel_Change') == 0 ){ ?>
    <?php if($obj_fun->getMetaData('packing') == 1){?>
    <li id="packing" ><a href="packing-details.php"><span class="fam-pictures"></span>Packing Details</a></li>
    <?php }} */ ?>
    <?php if($obj_fun->getMetaData('exportFlag') == 1){?>
    <li id="exportFlag" ><a href="export_flag.php"><span class="fam-flag-blue"></span>Export Flags</a></li>
    <?php } ?>
    <?php if($obj_fun->getMetaData('metadata') == 1){?>
    <li id="matadata"><a href="meta-data.php" class="no-submenu"><span class="fam-tag-blue"></span>Meta Data</a></li>
    <?php } ?>
    <?php if($obj_fun->getMetaData('analytics') == 1 and $_SESSION['type'] == 'master-admin'){?>
    <li id="add_analytics"><a href="addAnalytics.php" class="no-submenu"><span class="fam-report-picture"></span>Add Analytics</a></li>
    <?php } ?>
    <?php if($obj_fun->getMetaData('web_visitor') == 1){?>
    <li id="analytics"><a href="analytics.php" class="no-submenu"><span class="fam-report-picture"></span>Web Visitor</a></li>
    <?php } ?>
    <?php if($_SESSION['type'] == 'master-admin'){?>
    <li id="accesslog"> <a class="no-submenu" href="accesslog.php" ><span class="fam-book"></span>Accesslog</a> </li>
    <?php } ?>
    <?php if($obj_fun->getMetaData('live_view') == 1){?>
    <li> <a class="no-submenu" href="../"  target="_blank" ><span class="fam-rosette"></span>View Live</a> </li>
    <?php } ?>
  </ul>
</nav>