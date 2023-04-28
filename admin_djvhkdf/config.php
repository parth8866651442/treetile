<?php
include_once('../db.php');

/* For Image With and Height */
//For Slider
define('slider_th_width',450);
define('slider_th_height',300);
define('slider_big_width',1920);
define('slider_big_height',1080);

//For Gallery
define('gallery_th_width',600);
define('gallery_th_height',600);
define('gallery_big_width',1920);
define('gallery_big_height',1080);

//For Gallery
define('advertisement_th_width',525);
define('advertisement_th_height',350);
define('advertisement_big_width',1200);
define('advertisement_big_height',800);

//For Gallery
define('showroom_th_width',525);
define('showroom_th_height',350);
define('showroom_big_width',1200);
define('showroom_big_height',800);

//For Infrastructure

define('infrastructure_th_width',525);
define('infrastructure_th_height',350);
define('infrastructure_big_width',1200);
define('infrastructure_big_height',800);

//For Product
define('product_th_width',560);
define('product_th_height',400);
define('product_big_width',1200);
define('product_big_height',800);

//For Catalogue
define('catalogue_th_width',1500);
define('catalogue_th_height',2000);

//For Certificate
define('certificate_th_width',2457);
define('certificate_th_height',3467);



//For header Image
define('headerimage_th_width',1920);
define('headerimage_th_height',1080);

//For News or Media
define('news_th_width',400);
define('news_th_height',400);
define('news_big_width',800);
define('news_big_height',800);

$con = mysqli_connect(host,user,password,database) or die('Could not connect: ' . mysqli_connect_error());

?> 