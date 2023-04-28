<?php include 'header.php'; ?>
<?php

    if(isset($_REQUEST['event_id']) && $_REQUEST['']!='event_id')
    {
        $id = $_REQUEST['event_id'];
    }
    else
    {
        header('location:socialism');
    }

    $sql = "SELECT * FROM news where slug ='".$_REQUEST['event_id']."'";
    $news = $obj_fun->getLastRecords($sql);

    $title = $news['title']; 
    $details = htmlspecialchars_decode($news['details']); 
    $Day = date("d ", strtotime($news['pdate']));
    $Month = date("M ", strtotime($news['pdate']));
    $Year = date("Y", strtotime($news['pdate']));

    $yturl = htmlspecialchars_decode($news['yturl']);
    $yturls = explode(',',$yturl);
    $yt_embed = array();

    if(isset($yturls) && $yturls != ''){
        foreach($yturls as $yt){
                
            $yt_embeded_url = $obj_fun->get_yt_embeded_url($yt);
            $yt_embed[] = $yt_embeded_url;
        
        }
    }

    $sql = "SELECT * FROM images where news_id=".$news['id'];
    $images = $obj_fun->getRecords($sql);

    $sql2 = "SELECT * FROM images where news_id=".$news['id'];
    $images2 = $obj_fun->getLastRecords($sql2);

?>
    <section id="header_main">
        <div class="hdr_main">
            <div class="vr_title">
                <h1>Blog</h1>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="home_img">
                        <div class="h_img">
                            <div class="parallax-image js-rellax" data-scroll data-scroll-speed="-1">
                                <img src="<?php echo SITEURL; ?>assets/images/kenny-eliason-3GZNPBLImWc-unsplash.jpg" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 flex">
                    <div class="sqs-block-content">
	                    <p class="wel-p"><?php echo $title ;?></p>
	                </div>
                </div>
            </div>
        </div>
    </section>

	<section class="blog-1" id="home-5">
	    <div class="container">		        
	        <div class="w-full pb-5">
	            <div class="col-sm-12">
	                <h4><?php echo $title ;?></h4>
                </div>
                <?php if($yturl != ''){ ?>
	            <div class="col-sm-12">
	                <iframe width="100%" height="450" src="<?php echo $yturl; ?>?rel=0&showinfo=0&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	            </div>
            <?php } ?>
	        </div>
	        <div class="row pb-5">
                <div class="col-sm-12">
                    <p><?php echo $details ;?></p>
                </div>
            </div>
	        <div class="w-full">
                <div class="col-sm-12">
                    <h2>Photos</h2>
                </div>
                <?php 
                            $sql3 = "SELECT * FROM images where news_id='".$news['id']."' ";
                                $images3 = $obj_fun->getRecords($sql3);
                                foreach($images3 as $i) {  ?>
                <div class="col-sm-12 col-md-3">
                    <a href="<?php echo SITEURL; ?>uploads/media/<?php echo $i['name'];?>" data-fancybox="gallery">
                        <img src="<?php echo SITEURL; ?>uploads/media/<?php echo $i['name'];?>" alt="<?php echo $title ;?>" class="img-responsive"/>
                    </a>
                </div>
                <?php } ?>
            </div>
	    </div>
	</section>

<?php include 'footer.php'; ?>	  

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>