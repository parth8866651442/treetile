<?php
include_once('config.php');
require_once('function.php');
session_start();
$obj_fun = new functions();

if(!isset($_SESSION['status']))
{
	?>
	<script type="text/javascript">
		window.location = "login.php";
	</script>
	<?php
}
$admin = $obj_fun ->getUser('admin');

//For Sereis Order Change
if($_POST['action'] == 'series_order_change' && $_POST['order'] != '' && $_POST['size'] != '') 
{
	$odr = explode(",",$_POST['order']);
	$sql = "UPDATE series SET `order` = CASE "; 
	foreach($odr as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END WHERE product_size_id=".$_POST['size'];
	
	echo $obj_fun ->update_record($sql);
}

//For Series Delete
if($_POST['action'] == 'series_delete' && $_POST['id'] != '') 
{
	
	$id = $_POST['id'];
	$obj_fun ->deleteSeries($id);
}
if($_POST['action'] == 'series_mul_delete' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	
	for($i=0;$i<count($id);$i++)
	{
		$s_id = $id[$i];
		$obj_fun->deleteSeries($s_id);
	}
}
//For Series No Delete
if($_POST['action'] == 'series_no_delete' && $_POST['id'] != '') 
{
	$obj_fun -> deleteSeriesNo($_POST['id'],$_POST['path']);
}
if($_POST['action'] == 's_no_mul_delete' && $_POST['id'] != '' && $_POST['path'] != '') 
{
	$id = $_POST['id'];
	$path = $_POST['path'];
	
	for($i=0;$i<count($id);$i++)
	{
		$s_path = $path[$i];
		$s_id = $id[$i];
		$obj_fun -> deleteSeriesNo($s_id,$s_path);
	}
}
//For Sereis No Order Change
if($_POST['action'] == 'seriesno_order_change' && $_POST['order'] != '') 
{
	$odr = explode(",",$_POST['order']);
	$sql = "UPDATE series_no SET `order` = CASE "; 
	foreach($odr as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END WHERE series_id = ".$_POST['series'];
	
	echo $obj_fun ->update_record($sql);
}
//For Product Order Change
if($_POST['action'] == 'product_order_change' && $_POST['order'] != '') 
{
	$odr = explode(",",$_POST['order']);
	$sql = "UPDATE product SET `order` = CASE "; 
	foreach($odr as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END WHERE series_no = ".$_POST['seriesno'];
	
	echo $obj_fun ->update_record($sql);
}
//For Products Order Change
if($_POST['action'] == 'products_order_change' && $_POST['order'] != '') 
{
	$odr = explode(",",$_POST['order']);
	$sql = "UPDATE product SET `order` = CASE "; 
	foreach($odr as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END WHERE series_id = ".$_POST['series'];
	
	echo $obj_fun ->update_record($sql);
}
//For Design Order Change
if($_POST['action'] == 'design_order_change' && $_POST['order'] != '') 
{
	$odr = explode(",",$_POST['order']);
	$sql = "UPDATE product SET `order` = CASE "; 
	foreach($odr as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END WHERE size_id = ".$_POST['size'];
	
	echo $obj_fun ->update_record($sql);
}


if($_POST['action'] == 'export_flag_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE export_flag SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END";
	
	echo $obj_fun ->update_record($sql);
}


if($_POST['action'] == 'product_mul_delete') 
{
	$id = $_POST['id'];
	$image = $_POST['image'];
	$view = $_POST['view'];
	$path = $_POST['img_path'];
	for($i=0;$i<count($id);$i++)
	{
		if(is_file('../uploads/'.$path.'/'.$image[$i]))
			unlink('../uploads/'.$path.'/'.$image[$i]);
		if(is_file('../uploads/'.$path.'/thumbnails/'.$image[$i]))
			unlink('../uploads/'.$path.'/thumbnails/'.$image[$i]);
		
		if(is_file('../uploads/'.$path.'/'.$view[$i]))
			unlink('../uploads/'.$path.'/'.$view[$i]);
		if(is_file('../uploads/'.$path.'/thumbnails/'.$view[$i]))
			unlink('../uploads/'.$path.'/thumbnails/'.$view[$i]);
		
		$obj_fun->deleteProduct($id[$i]);
	}

}
if($_POST['action'] == 'Flag_mul_delete') 
{
	$id = $_POST['id'];
	$image = $_POST['image'];
	$path = 'export';
	for($i=0;$i<count($id);$i++)
	{
		if(is_file('../uploads/export/'.$image[$i]))
			unlink('../uploads/export/'.$image[$i]);
		if(is_file('../uploads/export/thumbnails/'.$image[$i]))
			unlink('../uploads/export/thumbnails/'.$image[$i]);
		
		
		$obj_fun->deleteFlag($id[$i]);
	}

}

if($_POST['action'] == 'product_delete' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	$img = $_POST['image'];
	$img_path = $_POST['img_path'];
	if(isset($img))
	{
		unlink('../uploads/'.$img_path.'/'.$img);
		unlink('../uploads/'.$img_path.'/thumbnails/'.$img);

	}	
	$obj_fun ->deleteProduct($id);
}
if($_POST['action'] == 'Export_flag_delete' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	$img = $_POST['image'];
	 
	if(isset($img))
	{
		unlink('../uploads/export/'.$img);
		unlink('../uploads/export/thumbnails/'.$img);

	}	
	$obj_fun ->deleteExportFlag($id);
}
if($_POST['action'] == 'product_view_delete' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	$path = $_POST['path'];
	$view = $_POST['view'];
	if(isset($view))
	{
		unlink($path.'/'.$view);
		unlink($path.'/thumbnails/'.$view);
	}	
	$sql="UPDATE product SET view='' where id =".$id ;
	$obj_fun ->update_record($sql);
}
if($_POST['action'] == 'menu_view_delete' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	$path = $_POST['path'];
	$view = $_POST['view'];
	$view = str_replace("../uploads/menu_logo/","",$view);
	if(isset($view))
	{
		unlink($path.'/'.$view);
	}	
	$sql="UPDATE menu SET prologo='' where id =".$id ;
	$obj_fun ->update_record($sql);
}

if($_POST['action'] == 'size_view_delete' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	$path = $_POST['path'];
	$view = $_POST['view'];
    $view = str_replace("../uploads/size_logo/","",$view);
	if(isset($view))
	{
		unlink($path.'/'.$view);
	}
	$sql="UPDATE product_size SET sizelogo='' where id =".$id ;
	$obj_fun ->update_record($sql);
}

if($_POST['action'] == 'series_view_delete' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	$path = $_POST['path'];
	$view = $_POST['view'];
    $view = str_replace("../uploads/series_logo/","",$view);
	if(isset($view))
	{
		unlink($path.'/'.$view);
	}
	$sql="UPDATE series SET serieslogo='' where id =".$id ;
	$obj_fun ->update_record($sql);
}

if($_POST['action'] == 'selectProductSize' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	echo $s ="SELECT * FROM product_size where status=1 and menu_id = ". $id;
	$product = $obj_fun->getRecords($s);
	if(isset($product) && $product !=''){
		foreach($product as $m){ 
			echo '<option value="'.$m['id'].'">'.$m['size'].'</option>';
		}
	}
	else
		echo '<option>Product Size Not Exiest</option>';
}

//For Catalogue Order Change
if($_POST['action'] == 'catalogue_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE catalogue SET `order` = CASE "; 
	/*echo '<pre>';
	print_r($_POST['order']);
	echo '</pre>';*/
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END";
	
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'productsize_order_change' && $_POST['order'] != '') 
{
	 $sql = "UPDATE product_size SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END";
	
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'slider_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE gallery  SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END where type='slider'";
	
	echo $obj_fun ->update_record($sql);
}

if($_POST['action'] == 'design_with_description_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE `product`  SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END";
	
	echo $obj_fun ->update_record($sql);
}

if($_POST['action'] == 'category_gallery_image_order_change' && $_POST['order'] != '' && $_REQUEST['type'] != '') 
{
	$sql = "UPDATE `catagory_image`  SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	 $sql .= "END where type=".$_REQUEST['type'];
	
	echo $obj_fun ->update_record($sql);
}

if($_POST['action'] == 'infrastructure_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE gallery  SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END where type='infrastructure'";
	
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'advertisement_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE gallery  SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END where type='advertisement'";
	
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'showroom_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE gallery  SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END where type='showroom'";
	
	echo $obj_fun ->update_record($sql);
}

	
if($_POST['action'] == 'group_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE contact_group SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END";
	echo $sql;
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'event_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE news SET `order_news` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= " WHEN `id` = ".$v." THEN ".$k." ";
	}
	$sql .= "END where type='event'";
	
	
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'product_admin_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE product_other_admin_panel SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= " WHEN `id` = ".$v." THEN ".$k." ";
	}
	$sql .= "END";
	
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'menu_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE menu SET `order` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END";
	
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'category_delete' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	$obj_fun ->deleteCategory($id,true);
}

if($_POST['action'] == 'headerimage_delete' && $_POST['menu_id'] != '') 
{
	$id = $_POST['menu_id'];
	if($obj_fun->getMetaData('Admin_Panel_Change') == 1){
		$obj_fun ->deleteHeaderImage($id);
	}
	else{
		$obj_fun ->deleteHeaderImageMainAdmin($id);
	}
}
if($_POST['action'] == 'headerimage_series_delete' && $_POST['id'] != '') 
{
	$id = $_POST['id'];
	$obj_fun ->deleteSeriesHeaderImage($id);
}
if($_POST['action'] == 'deleteallvisitor') 
{
	$obj_fun->deleteAllVisitor();
}
if($_POST['action'] == 'resetallvisitor') 
{
	$obj_fun->resetAllVisitor();
}
if($_POST['action'] == 'setlightboximage') 
{
	$countArray = end(end($_POST));
    for($i=0; $i<$countArray['value'];$i++)
	{
		foreach ($_POST['data'] as $data) {
			if($data['name'] == 'uploader_'.$i.'_tmpname')
			{
				$path = 'uploads/lightboximage';
				$image = $path.'/'.$data['value'];
				$thumb = $path.'/thumbnails/'.$data['value'];

				$res = $obj_fun->insertlightbox('lightbox',$image,$thumb);
			}
		}
	}	
	$sql="UPDATE settings SET data=1 WHERE meta='lightbox'";
	$obj_fun->update_record($sql);
}
if($_POST['action'] == 'delete_lightbox') 
{
	$gallary = $obj_fun->getGallery('lightbox');
	
	foreach ($gallary as  $value) {
		unlink('../'.$value['image']);
		unlink('../'.$value['thumb']);
	}

	$sql = "DELETE FROM `gallery` WHERE `type`='lightbox'";
	$obj_fun->update_record($sql);

	$sql2="UPDATE settings SET data=0 WHERE meta='lightbox'";
	$obj_fun->update_record($sql2);
}

if($_POST['action'] == 'productsize_delete') 
{
	$result = $obj_fun->productsizedelete($_POST['id'] , true);
	echo $result;
}

if($_POST['action'] == 'video_delete') 
{
	$result = $obj_fun->videodelete($_POST['id']);
	echo $result;
}

if($_POST['action'] == 'menu_delete') 
{
	$obj_fun->Menudelete($_POST['id'],true);
	echo $result;
}
if($_POST['action'] == 'frontmenu_delete') 
{
	$obj_fun->singleFrontMenudelete($_POST['id'],true);
	echo $result;
}
if($_POST['action'] == 'slider_delete') 
{
	$obj_fun->deleteGallery($_POST['id'],true);
	echo $result;
}

if($_POST['action'] == 'catagory_image_delete') 
{
	$obj_fun->deletecatagory_image($_POST['id'],true);
	echo $result;
}

if($_POST['action'] == 'frontmenu_contact') 
{
	$obj_fun->singleFrontcontact($_POST['id'],true);
	echo $result;
}


if($_POST['action'] == 'get_series') 
{
	$sql = "SELECT * FROM `series` WHERE product_size_id = '".$_POST['id']."'";
	$data = $obj_fun->getRecords($sql);
	foreach($data as $d){
		echo "<option value=".$d['id'].">".$d['series_name']."</option>";
		}
}

if($_POST['action'] == 'menu_mul_delete') 
{
	$id = $_POST['id'];
	$prologo = $_POST['prologo'];
	
	for($i=0;$i<count($id);$i++)
	{
		$obj_fun->deletemenu($id[$i]);
	}

}

if($_POST['action'] == 'Delete_News_With_Video') 
{
	$obj_fun->Delete_News_With_Video($_POST['id'],true);
	echo $result;
}

if($_POST['action'] == 'video_delete') 
{
	$obj_fun->video_delete($_POST['id'],true);
	echo $result;
}
if($_POST['action'] == 'Delete_News') 
{
	$obj_fun->deleteNews($_POST['id'],true);
	echo $result;
}
if($_POST['action'] == 'Delete_Blog') 
{
	$obj_fun->deleteBlog($_POST['id'],true);
	echo $result;
}
if($_POST['action'] == 'Delete_Event') 
{
	$obj_fun->deleteEvent($_POST['id'],true);
	echo $result;
}
if($_POST['action'] == 'blog_order_change' && $_POST['order'] != '') 
{
	$sql = "UPDATE news SET `order_news` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= " WHEN `id` = ".$v." THEN ".$k." ";
	}
	$sql .= "END where type='blog'";
	
	
	echo $obj_fun ->update_record($sql);
}

if($_POST['action'] == 'our_news' && $_POST['order'] != '') 
{
	$sql = "UPDATE news SET `order_news` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= " WHEN `id` = ".$v." THEN ".$k." ";
	}
	$sql .= "END where type='news-with-one-image-and-detail'";
	
	
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'news_with_video' && $_POST['order'] != '') 
{
	$sql = "UPDATE news SET `order_news` = CASE ";
	foreach($_POST['order'] as $k=> $v){
		$sql .= " WHEN `id` = ".$v." THEN ".$k." ";
	}
	$sql .= "END where type='News-With-Video'";
	
	
	echo $obj_fun ->update_record($sql);
}

if($_POST['action'] == 'Delete_Metadata_Page') 
{
	$obj_fun->Delete_Metadata_Page($_POST['type'],true);
	echo $result;
}

/* ceramic application */
if($_POST['action'] == 'application_delete') 
{
	$obj_fun->ceramicapplicationdelete($_POST['id'],true);
	echo $result;
}

if($_POST['action'] == 'application_order_change' && $_POST['sequence_order'] != '') 
{
	$sql = "UPDATE `application` SET `sequence_order` = CASE ";
	foreach($_POST['sequence_order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END";
	
	echo $obj_fun ->update_record($sql);
}

if($_POST['action'] == 'product_mul_application') 
{

	$id = $_POST['id'];
	$application_id = $_POST['application_id'];
	
	for($i=0;$i<count($id);$i++)
	{	
		$obj_fun->updateProductapplication($id[$i],$application_id);
	}

}

/* ceramic inspiration */
if($_POST['action'] == 'inspiration_delete') 
{
	$obj_fun->ceramicinspirationdelete($_POST['id'],true);
	echo $result;
}

if($_POST['action'] == 'inspiration_order_change' && $_POST['sequence_order'] != '') 
{
	$sql = "UPDATE `inspiration` SET `sequence_order` = CASE ";
	foreach($_POST['sequence_order'] as $k=> $v){
		$sql .= "WHEN id = ".$v." THEN ".$k." ";
	}
	$sql .= "END";
	
	echo $obj_fun ->update_record($sql);
}
if($_POST['action'] == 'product_mul_inspiration') 
{

	$id = $_POST['id'];
	$inspiration_id = $_POST['inspiration_id'];
	
	for($i=0;$i<count($id);$i++)
	{	
		$obj_fun->updateProductinspiration($id[$i],$inspiration_id);
	}

}

/* Tiles color */ 

if($_POST['action'] == 'tilescolor_delete') 
{
	$obj_fun->colordelete($_POST['id'],true);
	echo $result;
}

if($_POST['action'] == 'product_mul_color') 
{

	$id = $_POST['id'];
	$color_id = $_POST['color_id'];
	
	for($i=0;$i<count($id);$i++)
	{	
		$obj_fun->updateProductcolor($id[$i],$color_id);
	}

}

/* News Catagory*/
if($_POST['action'] == 'newscat_delete') 
{
	$obj_fun->catdelete($_POST['id'],true);
	echo $result;
}


?>