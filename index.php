<?php include 'header.php'; ?>
	<link href="assets/css/home.css" type="text/css" rel="stylesheet" />
<link href="assets/vender/slider/slider.css" type="text/css" rel="stylesheet" />
<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
 <section id="slider">
	<div class="row">
		<div class="">
			<section id="main-slider">
				<?php $slider = $obj_fun->getGallery('slider');
                for($i=0;$i<count($slider);$i++){ ?>
                    <div class="items">
					<div class="img-container" data-bg-img="<?php echo SITEURL; ?><?php echo $slider[$i]['image']; ?>"></div>
					<div class="slide-caption">
						<div class="inner-container clearfix">
<!--
							<div class="up-sec">Innovating</div>
							<div class="down-sec">Living Spaces With Personality</div>
-->
						</div>
					</div> 
				</div>
				<?php } ?>
				<?php /*
				<div class="items">
					<div class="img-container" data-bg-img="assets/images/22.jpg"></div>
					<div class="slide-caption">
						<div class="inner-container clearfix">
<!--
							<div class="up-sec">Innovating</div>
							<div class="down-sec">Living Spaces With Personality</div>
-->
						</div>
					</div>
				</div>
				<div class="items">
					<div class="img-container" data-bg-img="assets/images/33.jpg"></div>
					<div class="slide-caption">
						<div class="inner-container clearfix">
<!--
							<div class="up-sec">Inspired</div>
							<div class="down-sec">Symmetry of Soul</div>
-->
						</div>
					</div>
				</div>
                    <div class="items">
					<div class="img-container" data-bg-img="assets/images/44.jpg"></div>
					<div class="slide-caption">
						<div class="inner-container clearfix">
<!--
							<div class="up-sec">Inspired</div>
							<div class="down-sec">Symmetry of Soul</div>
-->
						</div>
					</div>
				</div>
				*/ ?>
			</section>
		</div>
	</div>
	</section>
	<?php /*
    <section id="header_main">
	    <div class="hdr_main bg_patten">
	        <div class="vr_title">
	            <h1>Welcome</h1>
	        </div>
	        <div class="row">
	            <div class="col-md-7">
	                <div class="home_img">
	                    <div class="h_img">
	                        <div class="parallax-image js-rellax parallax2 p2" data-scroll data-scroll-speed="-1">
	                            <style>
	                                .carousel-fade .carousel-inner .item {
	                                    transition-property: opacity;
	                                }
	                                .carousel-fade .carousel-inner .item,
	                                .carousel-fade .carousel-inner .active.left,
	                                .carousel-fade .carousel-inner .active.right {
	                                    opacity: 0;
	                                }
	                                .carousel-fade .carousel-inner .active,
	                                .carousel-fade .carousel-inner .next.left,
	                                .carousel-fade .carousel-inner .prev.right {
	                                    opacity: 1;
	                                }
	                                .carousel-fade .carousel-inner .next,
	                                .carousel-fade .carousel-inner .prev,
	                                .carousel-fade .carousel-inner .active.left,
	                                .carousel-fade .carousel-inner .active.right {
	                                    left: 0;
	                                    -webkit-transform: translate3d(0, 0, 0);
	                                    transform: translate3d(0, 0, 0);
	                                }
	                                .carousel-fade .carousel-control {
	                                    z-index: 2;
	                                }
	                                html,
	                                body,
	                                .carousel,
	                                .carousel-inner,
	                                .carousel-inner .item {
	                                    height: 100%;
	                                }
	                            </style>
	                            <script>
	                                window.console = window.console || function (t) {};
	                            </script>
	                            <script>
	                                if (document.location.search.match(/type=embed/gi)) {
	                                    window.parent.postMessage("resize", "*");
	                                }
	                            </script>

	                            <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
	                                <div class="carousel-inner">
	                                    <div class="item"><img src="assets/images/11.jpg" /></div>
	                                    <div class="item active"><img src="assets/images/33.jpg" /></div>
	                                    <div class="item"><img src="assets/images/44.jpg" /></div>
	                                    <div class="item"><img src="assets/images/22.jpg" /></div>
	                                </div>
	                            </div>
	                            
	                            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.js"></script>
	                            <script id="rendered-js">
	                                $(".carousel").carousel();
	                                //# sourceURL=pen.js
	                            </script>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-5 flex" data-scroll data-scroll-speed="2">
	                <div class="sqs-block-content">
	                    <p class="wel-p">Offering</p>
	                    <p class="wel-p">The Unique</p>
	                    <p class="wel-p bf-line">Decorative Potential</p>

	                    <div class="red-bdr"></div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section> */ ?>
    
    <section id="home-4">
	    <div class="home-ab">		        
	        <div class="at_main parallax2 p2">
	            <div class="row">
	                <div class="col-md-4 objects">
	                    <div class="ab-head heading">
	                        <span>
	                            About<br />
	                            Us
	                        </span>
	                    </div>
	                </div>
	                <div class="col-md-8">
	                    <div class="ab-des">
	                        <p>Are you bored of the old white tiles covering the expanse of your floor space? Are you tired of cooking into a bland and lifeless kitchen?Do you feel like the flooring of you.</p>

	                        <p>
	                            Is the sight of those chipped tiles getting on your nerves? It is now time for you to inject a fresh gush of air into your home with Tree Tiles. Turn your boring and unwelcoming home into a warm and gorgeous space with our range of stunning ceramic tiles.
	                        </p>
	                    </div>
	                    <div>
	                        <a href="ourstory" class="new_btn">Learn More</a>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="mar_main">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="marble_img">
	                        <div class="row">
	                            <div data-scroll data-scroll-speed="-2" class="a-dottop"></div>
	                            <div data-scroll data-scroll-speed="5" class="a-dot"></div>
	                            <div data-scroll data-scroll-speed="10" class="a-dot2"></div>
	                            <div data-scroll data-scroll-speed="10" class="a-dot3"></div>
	                            <div data-scroll data-scroll-speed="30" class="a-dot4"></div>
	                            <div data-scroll data-scroll-speed="1" class="a-dot5"></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

    <section id="competences">
        <div class="">
            <div class="container">
                <div class="row" data-scroll data-scroll-speed="1.5">
                    <div class="col-md-12 objects pt-0">
                        <div class="heading">
                            <span>Our<br>Product Features</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
            
                    <div class="col-12 col-lg-6 lg-padding-ten-right text-center text-lg-left md-padding-15px-right md-margin-50px-bottom sm-margin-40px-bottom wow fadeIn">
                        <div class="row">
                            <!-- start features box item -->
                            <div class="col-xs-6 col-md-3 product__img-grp">
                                <img src="assets/images/durability.svg" alt="icon">
                                <p class="alt-font margin-10px-top mb-0" style="text-align: center;">High <br>Durability</p>
                            </div>
                            <!-- end features box item -->
                            <!-- start features box item -->
                            <div class="col-xs-6 col-md-3 product__img-grp">
                                <img src="assets/images/chemical.svg" alt="icon">
                                <p class="alt-font margin-10px-top mb-0" style="text-align: center;">Chemical <br>Resistance</p>
                            </div>
                            <!-- end features box item -->
                            <!-- start features box item -->
                            <div class="col-xs-6 col-md-3 product__img-grp">
                                <img src="assets/images/stain.svg" alt="icon">
                                <p class="alt-font margin-10px-top mb-0" style="text-align: center;">Stain </br> Resistance</p>
                            </div>
                            <!-- end features box item -->
                            <!-- start features box item -->
                            <div class="col-xs-6 col-md-3 product__img-grp" style="text-align: center;">
                                <img src="assets/images/slip.svg" alt="icon">
                                <p class="alt-font margin-10px-top mb-0">Slip </br> Resistance</p>
                            </div>
            
                            <div class="col-xs-6 col-md-3 product__img-grp" style="text-align: center;">
                                <img src="assets/images/eco.svg" alt="icon">
                                <p class="alt-font margin-10px-top mb-0">Eco </br> Friendly</p>
                            </div>
            
                            <div class="col-xs-6 col-md-3 product__img-grp" style="text-align: center;">
                                <img src="assets/images/maintainance.svg" alt="icon">
                                <p class="alt-font margin-10px-top mb-0">Maintainance</br> Free</p>
                            </div>
            
                            <div class="col-xs-6 col-md-3 product__img-grp" style="text-align: center;">
                                <img src="assets/images/dimension.svg" alt="icon">
                                <p class="alt-font margin-10px-top mb-0">Dimension</br> Stability</p>
                            </div>
            
                            <div class="col-xs-6 col-md-3 product__img-grp" style="text-align: center;">
                                <img src="assets/images/clean.svg" alt="icon">
                                <p class="alt-font margin-10px-top mb-0">Easy to</br> Clean</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 features__box-image">
                        <div class="row">
                            <!-- start features box item -->
                            <div class="col-xs-2 col-md-2 product__img-grp"> </div>
                                <div class="col-xs-10 col-md-10 product__img-grp"> 
                                    <img src="assets/images/tree.gif" style="width:500px;" alt="features" class="img-responsive" />
                                    <?php /* <img src="assets/images/feature.gif" alt="features" class="img-responsive" /> */ ?>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
    	<div class="objects">
		    <div class="container">
		        <div>
		            <div class="heading">
		                <span class="split">Offering unique</span><br>
		                <span class="split">decorative potential</span>
		            </div>
		        </div>
		    </div>

		    <div class="container-full">
		        <div class="flex2">
		            <div class="col">
		                <div class="card">
		                    <div class="img">
		                        <a href="#">
		                            <div class="img-w">
		                                <span style="background: url('assets/images/1200x1800.jpg') no-repeat 50% / cover;"></span>
		                            </div>
		                        </a>
		                    </div>

		                    <div class="flex2">
		                        <a href="<?php echo SITEURL; ?>product/slab-tiles/1200-x-1800-mm"><span data-hover="Slab Tiles">Slab Tiles </span></a>

		                        <a href="<?php echo SITEURL; ?>product/slab-tiles/1200-x-1800-mm"><span data-hover="Explore more">Explore more</span></a>

		                        <a href="<?php echo SITEURL; ?>product/slab-tiles/1200-x-1800-mm">1200 x 1800 MM</a>
		                    </div>
		                </div>

		                <div class="card">
		                    <div class="img">
		                        <a href="#">
		                            <div class="img-w">
		                                <span style="background: url('assets/images/1200x2400.jpg') no-repeat 50% / cover;"></span>
		                            </div>
		                        </a>
		                    </div>

		                    <div class="flex2">
		                        <a href="<?php echo SITEURL; ?>product/slab-tiles/1200-x-2400-mm"><span data-hover="Slab  Tiles">Slab  Tiles </span></a><a href="<?php echo SITEURL; ?>product/slab-tiles/1200-x-2400-mm"><span data-hover="Explore more">Explore more</span></a>

		                        <a href="<?php echo SITEURL; ?>product/slab-tiles/1200-x-2400-mm">1200 x 2400 MM</a>
		                    </div>
		                </div>
		            </div>

		            <div class="col" data-scroll data-scroll-speed="-1">
		                <div class="card">
		                    <div class="img">
		                        <a href="#">
		                            <div class="img-w">
		                                <span style="background: url('assets/images/600x1200.jpg') no-repeat 50% / cover;"></span>
		                            </div>
		                        </a>
		                    </div>

		                    <div class="flex2">
		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/600-x-1200-mm"><span data-hover="Gvt/Pgvt">Gvt/Pgvt</span></a>

		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/600-x-1200-mm"><span data-hover="Explore more">Explore more</span></a>

		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/600-x-1200-mm">600 x 1200 MM</a>
		                    </div>
		                </div>

		                <div class="card">
		                    <div class="img">
		                        <a href="#">
		                            <div class="img-w">
		                                <span style="background: url('assets/images/600x600.jpg') no-repeat 50% / cover;"></span>
		                            </div>
		                        </a>
		                    </div>

		                    <div class="flex2">
		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/600-x-600-mm"><span data-hover="GVT / PGVT">Gvt/Pgvt</span></a>

		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/600-x-600-mm"><span data-hover="Explore more">Explore more</span></a>

		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/600-x-600-mm">600 x 600 MM</a>
		                    </div>
		                </div>
		            </div>

		            <div class="col">
		                <div class="card">
		                    <div class="img">
		                        <a href="#">
		                            <div class="img-w">
		                                <span style="background: url('assets/images/800x1600.jpg') no-repeat 50% / cover;"></span>
		                            </div>
		                        </a>
		                    </div>

		                    <div class="flex2">
		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/800-x-1600-mm">
		                            <span data-hover="Gvt/Pgv">Gvt/Pgvt</span>
		                        </a>

		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/800-x-1600-mm"><span data-hover="Explore more">Explore more</span></a>

		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/800-x-1600-mm">800 x 1600 MM</a>
		                    </div>
		                </div>

		                <div class="card">
		                    <div class="img">
		                        <a href="#">
		                            <div class="img-w">
		                                <span style="background: url('assets/images/200x1200.jpg') no-repeat 50% / cover;"></span>
		                            </div>
		                        </a>
		                    </div>

		                    <div class="flex2">
		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/200-x-1200-mm"><span data-hover="Gvt/Pgvt">Gvt/Pgvt</span></a>

		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/200-x-1200-mm"><span data-hover="Explore more">Explore more</span></a>

		                        <a href="<?php echo SITEURL; ?>product/gvt-pgvt/200-x-1200-mm">200 x 1200 MM</a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>
    </section>   

    <div style="background: #232323; padding-bottom: 90px; padding-top: 90px;margin-top: 90px;">
	    <div class="container">
	        <div class="flex3">
	            <div class="accordion">
	                <div class="accordion__header is-active">
	                    <h2>Manufacturing units</h2>
	                    <span class="accordion__toggle"></span>
	                </div>
	                <div class="accordion__body is-active">
	                    <div class="left">
	                        <p class="ani">
	                            TreeTile is the brand that emerged with TreeTile. The successful business of ceramic tiles and porcelain,floor, wall and sanitaryware etc suppliers. We equip the state of art machinery in manufacturing for flooring and wall tiles, modernized warehouses to incur stock, provide secure packaging and 24 x 7 facilities for loading of the consignment. During our journey from inception, our supply capacity increment is directly proportional to the number of satisfied customers.
	                        </p>
	                    </div>
	                    <div class="right" data-scroll data-scroll-speed="-1"><img src="assets/images/fac.jpg" class="ani" /></div>
	                </div>
	                <div class="accordion__header">
	                    <h2>Display gallery</h2>
	                    <span class="accordion__toggle"></span>
	                </div>
	                <div class="accordion__body">
	                    <div class="left">
	                        <p class="ani">Our Display gallery is the heart of what we do. Find out what we have by visiting our library. If you’re interested in visiting and exploring our collections, we’re here to support you.</p>
	                    </div>
	                    <div class="right" data-scroll data-scroll-speed="-1"><img src="assets/images/mood.jpg" class="ani" /></div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>     

<?php include 'footer.php'; ?>	        