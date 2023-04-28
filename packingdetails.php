<?php include 'header.php'; ?>

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
                                <img src="assets/images/prew1.jpeg" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 flex">
                    <div class="sqs-block-content">
	                    <p class="wel-p">Packing Details</p>
	                </div>
                </div>
            </div>
        </div>
    </section>

    <section id="home-4">
	    <div class="home-ab">		        
	        <div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">

            <?php echo $obj_fun->getMetaData('packing-details'); ?>
            </div>
    </div>
</div>
</div>
	    </div>
	</section>
	


<?php include 'footer.php'; ?>	        