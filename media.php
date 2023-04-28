<?php include 'header.php'; ?>
<?php

$limit = 10;    
$page=1;//Default page
$start=0; //starts displaying records from 0
if(isset($_GET['id']) && $_GET['id']!='')
{
  $page=$_GET['id'];
}
$start=($page-1)*$limit;
$comming=false;

$sql = "SELECT news.*, images.name as image FROM news join images on news.id = images.news_id where type='event' group by news.id order by news.id ASC";
$rows = $obj_fun->recordCount($sql);

$sql = "SELECT news.*, images.name as image FROM news join images on news.id = images.news_id where type='event' group by news.id order by news.id ASC LIMIT $start, $limit";
$news = $obj_fun->getRecords($sql);
    
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
                                <img src="assets/images/kenny-eliason-3GZNPBLImWc-unsplash.jpg" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 flex">
                    <div class="sqs-block-content">
	                    <p class="wel-p">Socialism</p>
	                </div>
                </div>
            </div>
        </div>
    </section>

	<section class="blog-1" id="home-5">
	    <div class="container">	
                <?php

                         if(isset($news) && $news !=''){ 
                              foreach($news as $n){

                                  $Day = date("d ", strtotime($n['pdate']));
                                  $Month = date("M ", strtotime($n['pdate']));
                                  $Year = date("Y ", strtotime($n['pdate']));

                                  $yturl = htmlspecialchars_decode($n['yturl']);
                                  $yturls = explode(',',$yturl);
                                  $n['yturl'] = (isset($yturls[0]) && $yturls[0] != '') ? $yturls[0] : '';
                                  
                                  $yt_embeded_url = $obj_fun->get_yt_embeded_url($n['yturl']);
                                  $yid = $obj_fun->get_yt_id($n['yturl']);
                              
                                          $image_url = "uploads/media/".$n['image'];                      
                                      

                            ?>

            <div class="row pb-5">
                <div class="col-sm-12 col-md-6">
                    <img src="<?php echo SITEURL.$image_url; ?>" class="img-responsive" />
                </div>
                <div class="col-sm-12 col-md-5 col-md-offset-1">
                    <div class="ab-head heading">
                        <h2>
                            <?php echo $n['title']; ?>
                        </h2>
                    </div>
                    <?php
                                          $string = strip_tags($n['details']);
                                          if (strlen($string) > 100) {
                                            $stringCut = substr($string, 0, 100);
                                            $endPoint = strrpos($stringCut, ' ');
                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '...';
                                        }
                                    ?>
                    <p><?php echo htmlspecialchars_decode($string); ?></p>
                    <a href="<?php echo SITEURL; ?>events-details/<?php echo $n['slug']; ?>" class="new_btn">Read More</a>
                </div>
            </div>
                <?php } } ?>

            
	    </div>
	</section>

<?php include 'footer.php'; ?>	        