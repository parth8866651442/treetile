<?php $metapage = 'download'; ?>
<?php include 'header.php'; ?>

    <section id="header_main">
        <div class="hdr_main">
            <div class="vr_title">
                <h1>Downloads</h1>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="home_img">
                        <div class="h_img">
                            <div class="parallax-image js-rellax" data-scroll data-scroll-speed="-1">
                                <img src="assets/images/download.jpg" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 flex">
                    <div class="sqs-block-content">
                        <p class="header-des">
                            Ceramic Tiles for every style From an essential look to a look more sophisticated, find your tailor-made solution to decorate your house and your work environments. Discover our product collections through our four
                            worlds of reference: floor and wall coverings, decorations and special pieces.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php /*
<section id="download">
    <div class="ceramic-box">
        <div class="wrapper">
            <div class="row">
                <?php   
                             $sql ="SELECT * FROM `catalogue` GROUP BY `size` order BY `size` asc";
                             $res =$obj_fun->getRecords($sql); 
                             if(count($res) > 0 && $res != ''){ 
                             foreach($res as $r)
                             {               
                           ?>
                <div class="col-md-12">
                    <h1 style="text-align: center; background: #dbdfdd; padding: 10px;"><?php echo $r['menu']; ?> - <?php echo $r['size']; ?></h1>
                </div>
                <?php 
                                 $sub ="SELECT * FROM `catalogue` where size='".$r['size']."'";
                                     $subres = $obj_fun->getRecords($sub);
                                     foreach ($subres as $s) {

                                      $file = 'uploads/catalogue/'.$s['pdf'];
                                   
                                   ?>
                <div class="col-sm-4">
                    <div class="cera-box parallax-image">
                        <div class="cera-img">
                            <a href="<?php echo SITEURL.$file; ?>" target="_blank">
                                <img src="<?php echo SITEURL; ?>uploads/catalogue/<?php echo $s['image']; ?>" />
                            </a>
                        </div>
                        <div class="grey-bdr"></div>
                        <div class="d-title">
                            <h3><?php echo $s['name']; ?> - <?php echo $s['size']; ?></h3>
                        </div>
                        <div class="cera-nm">
                            <a href="<?php echo SITEURL; ?>includes/download.php?file=<?php echo base64_encode ('../uploads/catalogue/'.$s['pdf']); ?>" class="new_btn" download>Download</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php } } else { include "includes/coming.php"; } ?>
            </div>
        </div>
    </div>
</section>
*/ ?>
<section id="download">
    <div class="ceramic-box">
        <div class="wrapper">
            <div class="row">
                <div class="faqs-grid">
                    <?php   
                             $sql ="SELECT * FROM `catalogue` GROUP BY `size` order BY `size` asc";
                             $res =$obj_fun->getRecords($sql); 
                             if(count($res) > 0 && $res != ''){ 
                             foreach($res as $r)
                             {               
                           ?>
                    <div class="faqs-item ">
                        <a class="faqs-title" href="#custom">
                            <?php echo $r['menu']; ?> - <?php echo $r['size']; ?>
                        </a>
                        <div class="faqs-content">
                            <div class="faqs-content-inside">
                                <div class="row">
                                    <?php 
                                 $sub ="SELECT * FROM `catalogue` where size='".$r['size']."'";
                                     $subres = $obj_fun->getRecords($sub);
                                     foreach ($subres as $s) {

                                      $file = 'uploads/catalogue/'.$s['pdf'];
                                   
                                   ?>
                                    <div class="col-sm-4">
                                        <div class="cera-box parallax-image">
                                            <div class="cera-img">
                                                <a href="<?php echo SITEURL.$file; ?>" target="_blank">
                                                    <img src="<?php echo SITEURL; ?>uploads/catalogue/<?php echo $s['image']; ?>" />
                                                </a>
                                            </div>
                                            <div class="grey-bdr"></div>
                                            <div class="d-title">
                                                <h3><?php echo $s['name']; ?> - <?php echo $s['size']; ?></h3>
                                            </div>
                                            <div class="cera-nm">
                                                <a href="<?php echo SITEURL; ?>includes/download.php?file=<?php echo base64_encode ('../uploads/catalogue/'.$s['pdf']); ?>" class="new_btn" download>Download</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } else { include "includes/coming.php"; } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var acc = document.getElementsByClassName('faqs-title');
    var i;
    
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener('click', function () {
            this.classList.toggle('active');
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        });
    }
</script>

<style>
    .faqs-item {
    width: 100%;
    margin: 0 0 20px 0;
    padding: 0;
    display: block;
    background-color: rgb(255 255 255);
    border: 1px solid #c3c3c3;
}

.faqs-title {
    display: flex;
    position: relative;
    color: #000000;
    font-size: 2rem;
    font-weight: bold;
    text-decoration: none;
    padding: 20px;
    width: 100%;
    outline: none;
    transition: 0.4s;
    text-decoration: none !important;
}

.faqs-title.active,
.faqs-title:hover, .faqs-title:focus {
    background-color: rgb(35 89 63);
    color: #fff;
}
.faqs-title:after {
    content: '\002B';
    color: #fff;
    font-weight: normal;
    float: right;
    margin-left: auto;
    font-size: 24px;
    line-height: 1;
    padding-left: 20px;
}

.active:after {
    content: "\2212";
}

.faqs-content {
    padding: 0;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}

.faqs-content-inside {
    padding: 20px;
}
#header .header_inner .menu_list .menu_ul .menu_li .active:after {
    display: none;
}
</style>
<?php include 'footer.php'; ?>	        