<link rel="stylesheet" href="<?php echo admin_folder ?>/lightbox/colorbox.css" />
<script type="text/javascript" src="<?php echo admin_folder ?>/lightbox/jquery.colorbox-min.js"></script>

<?php 
	$gallary = $obj_fun->getGallery('lightbox');
	$video_url = $obj_fun->getMetaData('youtube_video_lightbox');
	 
	function getYouTubeIdFromURL($url)
	{
	  $url_string = parse_url($url, PHP_URL_QUERY);
	  parse_str($url_string, $args);
	  return isset($args['v']) ? $args['v'] : false;
	}
	  
	$youtube_id = getYouTubeIdFromURL($video_url);
	
	if($youtube_id == ''){
	foreach($gallary as $g){ 
 ?>
	<a class="group4"  href="<?php echo $g['image']; ?>"></a>
	<?php } ?>
	<script>
		$(document).ready(function(){
			$(".group4").colorbox({rel:'group4', slideshow:true,height:"90%"});
			setTimeout(function() {
				$('.group4')[0].click(); 
			}, 1500);
		})
	</script>
	<?php } else { ?>
	<a class='youtube' href="http://www.youtube.com/embed/<?php echo $youtube_id;?>?rel=0&amp;wmode=transparent"></a>
	<script>
		$(document).ready(function(){
			$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
			setTimeout(function() {
				$('.youtube')[0].click(); 
			}, 1500);
		})
	</script>
	<?php } ?>
		