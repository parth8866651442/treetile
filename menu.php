 <?php

    $fb = '';
    
    if($obj_fun->getMetaData('facebook') != '' && $obj_fun->getMetaData('facebook') != '#' )
    {
        $fb = $obj_fun->getMetaData('facebook');
        $fbtar = 'target="_blank"';
    } 
    else
    {
        $fb = 'javascript:void(0);';
        $fbtar = '';
    }

    $twitter = '';
    if($obj_fun->getMetaData('twitter') != '' && $obj_fun->getMetaData('twitter') != '#' )
    {
        $twitter = $obj_fun->getMetaData('twitter');
        $twittertar = 'target="_blank"';
    }
    else
    {
        $twitter = 'javascript:void(0);';
        $twittertar = '';
    }

    $instagram = '';
    if($obj_fun->getMetaData('instagram') != '' && $obj_fun->getMetaData('instagram') != '#')
    {
        $instagram = $obj_fun->getMetaData('instagram');
        $instagramtar = 'target="_blank"';
    }
    else
    {
        $instagram = 'javascript:void(0);';
        $instagramtar = '';
    }

    $pinterest = '';
    if($obj_fun->getMetaData('pinterest') != '' && $obj_fun->getMetaData('pinterest') != '#')
    {
        $pinterest = $obj_fun->getMetaData('pinterest');
        $pinteresttar = 'target="_blank"';
    }
    else
    {
        $pinterest = 'javascript:void(0);';
        $pinteresttar = '';
    }

    $linkedin = '';
    if($obj_fun->getMetaData('linkedin') != '' && $obj_fun->getMetaData('linkedin') != '#')
    {
        $linkedin = $obj_fun->getMetaData('linkedin');
        $linkedintar = 'target="_blank"';
    }
    else
    {
        $linkedin = 'javascript:void(0);';
        $linkedintar = '';
    }

?>
<?php 
    $fc = "SELECT * FROM `contact` WHERE type='Domestic'";
    $fc = $obj_fun->getLastRecords($fc); 
    $mobile = explode(',',$fc['mobile']);
    $email = explode(',',$fc['email']);
    
    $address = htmlspecialchars_decode($fc['address']);
    $address = str_replace('<p>','',$address);
    $address = str_replace('</p>','',$address);
?>
            <section id="header">
	            <div class="wrapper menu_wrap">
	                <div class="header_inner">
	                    <div class="row">
	                        <div class="col-md-2 col-sm-2 col-xs-8">
	                            <div class="logo">
	                                <a href="<?php echo SITEURL; ?>">
	                                    <img src="<?php echo SITEURL; ?>assets/images/logo.svg" />
	                                </a>
	                            </div>
	                        </div>
	                        <div class="col-md-10 col-sm-10 col-xs-4">
	                            <div class="menu_list">
	                                <nav class="rgdev">
	                                    <ul class="rgdev-list mobile-sub menu_ul">
	                                        <li class="rgdev-item menu_li">
	                                            <a href="#" class="menu_a">Corporate</a>
	                                            <ul class="rgdev-submenu">
	                                                <li class="rgdev-submenu-item">
	                                                    <a href="<?php echo SITEURL; ?>ourstory">Our Story</a>
	                                                    <a href="<?php echo SITEURL; ?>quality">Certified Quality</a>
	                                                </li>
	                                            </ul>
	                                        </li>
	                                        <li class="rgdev-item menu_li">
	                                            <a class="menu_a" href="product">Collection</a>
	                                            <ul class="product-menu rgdev-submenu">
                                                    <li>
                                                        <div class="row">
                                                        	<?php
                                 $menu ="select * from menu where status='1' order BY `order` asc";
                                 $menu = $obj_fun->getRecords($menu);
                                 $i = 0;
                                 foreach($menu as $mn) 
                                    {
                                        $size ="select * from `product_size` where menu_id='".$mn['id']."' order BY `order` asc ";
                                        $size = $obj_fun->getRecords($size);

                                        $clearmenu='';
                  if($i%4==0){
                    $clearmenu='clearmenu';
                  }
                                       
                                    ?>
                                                            <div class="col-md-4 <?php echo $clearmenu; ?>">
                                                                <h4><b><?php echo $mn['name'] ?></b></h4>

                                                                <?php
                                        foreach($size as $s){
                                        $size_url='product/'.$mn['slug'].'/'.$s['slug'];
                                                ?>
                                                              	<a href="<?php echo SITEURL.$size_url; ?>" class="font-dif"><?php echo $s['size'] ?></a><?php } ?>
                                                            </div>
                                                            <?php $i++; } ?>
                                                            <?php /*
                                                            <div class="col-md-4">
                                                                <h4><b>DOUBLE CHARGED VITRIFIED TILES</b></h4>
                                                
                                                                <a href="#" class="font-dif">600 x 600 MM</a>
                                                              	<a href="#" class="font-dif">600 x 1200 MM</a>
                                                              	<a href="#" class="font-dif">800 x 800 mm</a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4><b>POLISHED GLAZED VITRIFIED TLES</b></h4>
                                                
                                                                <a href="#" class="font-dif">600 x 600 MM</a>
                                                              	<a href="#" class="font-dif">600 x 1200 MM</a>
                                                              	<a href="#" class="font-dif">800 x 800 mm</a>
                                                                <a href="#" class="font-dif">800 x 1600 MM</a>
                                                              	<a href="#" class="font-dif">1200 x 1200 MM</a>
                                                              	<a href="#" class="font-dif">1200 x 2400 MM</a>
                                                            </div>
                                                            <div class="col-md-4 clearmenu">
                                                                <h4><b>NANO SOLUBLE SALT VITRIFIED TILES</b></h4>
                                                
                                                                <a href="#" class="font-dif">600 x 600 MM</a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4><b>FULL BODY SMART MARBLE</b></h4>
                                                
                                                                <a href="#" class="font-dif">800 x 2400 MM</a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4><b>FLOOR TILES</b></h4>
                                                
                                                                <a href="#" class="font-dif">300 x 300 MM</a>
                                                              	<a href="#" class="font-dif">400 x 400 MM</a>
                                                            </div>
                                                            <div class="col-md-4 clearmenu">
                                                                <h4><b>PORCLEIN TILES</b></h4>
                                                
                                                                <a href="#" class="font-dif">600 x 600 MM</a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4><b>WOODEN STRIPS</b></h4>
                                                
                                                                <a href="#" class="font-dif">200 x 1200 MM</a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4><b>PARKING TILES</b></h4>
                                                
                                                                <a href="#" class="font-dif">300 x 300 MM</a>
                                                              	<a href="#" class="font-dif">400 x 400 MM</a>
                                                            </div> */ ?>
                                                        </div>
                                                    </li>
                                                </ul>
	                                        </li>
	                                        <li class="rgdev-item menu_li">
	                                            <a class="menu_a" href="<?php echo SITEURL; ?>worldwide">World Wide</a>
	                                        </li>
	                                        <li class="rgdev-item menu_li">
	                                            <a class="menu_a" href="<?php echo SITEURL; ?>downloads">Downloads</a>
	                                        </li>
	                                        <li class="rgdev-item menu_li">
	                                            <a class="menu_a" href="<?php echo SITEURL; ?>socialism">Socialism</a>
	                                        </li>
	                                        <li class="rgdev-item menu_li">
	                                            <a href="#" class="menu_a">Resources</a>
	                                            <ul class="rgdev-submenu">
	                                                <li class="rgdev-submenu-item">
	                                                    <a href="<?php echo SITEURL; ?>packing">Packing Details</a>
	                                                    <a href="<?php echo SITEURL; ?>tilescalculator">Tiles Calculator</a>
	                                                    <a href="https://webapplication.tilesdisplay.in/frontend/login-with/api-key/eyJpdiI6ImZVdE9UWTdZZTNvbkNFUGhlNDFGM1E9PSIsInZhbHVlIjoiYitiVkpBbDMwVDJ2NUV4b0lzNGJcL3c9PSIsIm1hYyI6Ijg4ZDk3ZTJjZmIyN2VhZmRkZjM5N2NiZDg4OWQzNDhmODU0ZWJlMGZjZWMzMDNjYjY5MGQ4NDNjOThhMTU4N2UifQ==">Tile Visualizer</a>
	                                                </li>
	                                            </ul>
	                                        </li>
	                                        <li class="rgdev-item menu_li">
	                                            <a class="menu_a" href="<?php echo SITEURL; ?>contact">Contact Us</a>
	                                        </li>
	                                    </ul>
	                                </nav>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </section>
	        
	        <style type="text/css">
	            .cnt223 a {
	                text-decoration: none;
	            }
	            .closes {
	                position: absolute;
	                top: 0;
	                right: 0;
	            }
	            .closes img {
	                width: 24px;
	                height: auto;
	                padding: 5px;
	            }
	            .popup {
	                width: 100%;
	                margin: 0 auto;
	                display: none;
	                position: fixed;
	                z-index: 101;
	            }
	            .cnt223 {
	                min-width: 600px;
	                width: 600px;
	                min-height: 150px;
	                margin: 40px auto;
	                background: #f3f3f3;
	                position: relative;
	                z-index: 103;
	                padding: 15px 15px;
	                border-radius: 5px;
	                box-shadow: 0 2px 5px #000;
	            }
	            .cnt223 p {
	                clear: both;
	                color: #555555;
	                text-align: justify;
	                font-size: 20px;
	                font-family: sans-serif;
	            }

	            .cnt223 {
	                text-align: center;
	            }
	            .cnt223 .p_img {
	                max-width: 80%;
	            }
	            .cnt223 iframe {
	                width: 100%;
	                height: 400px;
	            }
	            .cnt223 .x {
	                float: right;
	                height: 35px;
	                left: 22px;
	                position: relative;
	                top: -25px;
	                width: 34px;
	            }
	            .cnt223 .x:hover {
	                cursor: pointer;
	            }
	        </style>