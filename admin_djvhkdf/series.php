<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php'); 
	if($obj_fun->getMetaData('product') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php');
		$folder = '../uploads/series_logo/';
		if (!file_exists($folder)) {
				@mkdir($folder, 0777, true);
			}
	function randomString($length = 6) 
	{
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
	
?>
</head>
<?php
if(isset($_GET['action']) && $_GET['action'] == 'newseries' && isset($_GET['size']) && $_GET['size'] !=''){
	$p_size = $obj_fun->getProductSizeById($_GET['size']);
}
elseif($_GET['action'] == 'updateseries' && isset($_GET['size']) && $_GET['size'] !='' && isset($_GET['series_id']) && $_GET['series_id'] !=''){
	$p_size = $obj_fun->getProductSizeById($_GET['size']);
	$series_details = $obj_fun->getSeriesById($_GET['series_id'],true);
}
else{
	header('location:index.php');
}?>
<body class="fixed-layout">
	<div class="container">
		<div class="sidebar">
			<?php include_once('sidebar.php');?>
		</div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
				<li class="active"><?php echo $p_size['size']; ?> Series</li>
			</ul>
			<div class="row-fluid">
				<article class="data-block nested">
					<div class="data-container">
						<header>
							<h2><?php echo (isset($series_details['id']) && $series_details['id'] !=''? 'Update' : 'Add') .' ' .$p_size['size']; ?> Series</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
									if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Create')
									{
										
										if($obj_fun->getMetaData('serieslogo') == 1){
											$path_parts = pathinfo($_FILES['serieslogo']['name']);
											$fileExtension = $path_parts['extension'];
											$a = $folder.randomString(6).'.'.$fileExtension;
								
											move_uploaded_file($_FILES['serieslogo']['tmp_name'],$a); 
									
										$s_ins = $obj_fun->insertSeries($_POST['name'],$_POST['p_size_id'],$_POST['menu_id'],$_POST['view_id'],$_POST['status'],$a,$_POST['title'],$_POST['keyword'],$_POST['description']);
									}else
									{
											$a ='';
											$s_ins = $obj_fun->insertSeries($_POST['name'],$_POST['p_size_id'],$_POST['menu_id'],$_POST['view_id'],$_POST['status'],$a,$_POST['title'],$_POST['keyword'],$_POST['description']);}
									
										if($s_ins =='success')
										{
											echo '<script>success("Serises Insert successfuly.")</script>';
											echo "<script>urlRefresh('series.php?action=newseries&size=".$_POST['p_size_id']."');</script>";
										}
										elseif($s_ins =='exists')
											echo '<script>danger("Serises already exists !")</script>';
										else
											echo '<script>danger("Get error while updating Series details !")</script>';
									}
									if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update')
									{	
										
									$path = $_POST['file_old'];
										 
									 $removeimg = $series_details['serieslogo'];
									
									 if($_FILES['serieslogo']['name'] != '')
									 {
										 
										unlink($removeimg);
									
										$path_parts = pathinfo($_FILES['serieslogo']['name']);
										$fileExtension = $path_parts['extension'];
										$a = $folder.randomString(6).'.'.$fileExtension;
								
										 move_uploaded_file($_FILES['serieslogo']['tmp_name'],$a); 
										$path = $a;
									 }
									 else
									 {
										$path = $path; 
									 }
									 	$s_ins =  $obj_fun->updateSeries($_POST['name'],$_POST['p_size_id'],$_POST['series_id'],$_POST['status'],$path,$_POST['title'],$_POST['keyword'],$_POST['description']);
										if($s_ins =='success')
										{
											echo '<script>success("Series Update successfuly.")</script>';
											echo "<script>urlRefresh('series.php?action=newseries&size=".$_POST['p_size_id']."');</script>";
										}
										else
											echo '<script>danger("'.$s_ins.'")</script>';
									}
								?>
								 <?php
			                      //echo $sql= $_GET['size'];
			                        $menu_sql="select * from `product_size` where id=". $p_size['id'];
			                        $menu_sql=$obj_fun->getLastRecords($menu_sql);
			                        $mid=$menu_sql['menu_id'];
			                     ?>
								<form class="form-search  series_form" method="post" enctype="multipart/form-data" onSubmit="return series_validate();">
									<?php if($p_size['series_no_status'] == 0){ ?>
										<input id="view_id" name="view_id" class="input-xxlarge" type="hidden" value="1" />
									<?php }else{?>
										<input id="view_id" name="view_id" class="input-xxlarge" type="hidden" value="" />
									<?php }?>
									<input id="menu_id" name="menu_id" class="input-xxlarge" type="hidden" value="<?php echo $mid; ?>" />
									<br>
									<div class="control-group">
										<div class="controls">
											<label>Add Series</label>
												<input id="name" name="name" class="input-xxlarge" type="text" placeholder="Add Series" value="<?php echo (isset($series_details['series_name']) && $series_details['series_name'] !='' ? $series_details['series_name'] : '') ;?>" />
											<input id="p_size_id" name="p_size_id" class="input-xxlarge" type="hidden" value="<?php echo $p_size['id']; ?>" />
											<input id="series_id" name="series_id" class="input-xxlarge" type="hidden" value="<?php echo (isset($series_details['id'])? $series_details['id'] : ''); ?>" />
											
										</div>

									</div>

									

									<div class="control-group">
										<div class="controls">
												<label>Status</label>
												<select id="select" name="status" required>
													<option value="1"<?php echo (isset($series_details['status']) && $series_details['status'] == 1) ? ' selected' : '' ?>>Enable</option>
													<option value="0"<?php echo (isset($series_details['status']) && $series_details['status'] == 0) ? ' selected' : '' ?>>Disable</option>
												</select>
										</div>

									</div>


                                    <?php if($obj_fun->getMetaData('serieslogo') == 1){?>
                                    
                                        <div class="control-group" style="height: 60px">
										<label for="fileInput" class="control-label" style="float: left;">Add Logo of Series</label>
										<div class="controls">
										
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span><input type="file" name="serieslogo" id="serieslogo"></span>
												</div>
											</div>
                                            
                                            
                                           	<?php if($series_details['serieslogo'] != '')
											{ ?>
											<img id="img_name" src="<?php echo $series_details['serieslogo'];?>" style="float: right; width: auto; height:50px;" />
											<?php } ?>
                                            
											<input type="hidden" name="file_old"   value="<?php echo $series_details['serieslogo']; ?>" >
											
											
										</div><br/>
									</div>	<?php } ?>
                                    
									<?php if($obj_fun->getMetaData('tkd_series') == 1){ ?>
								
                                    
								
									<div class="control-group" style="display: flex;" >
										<label for="fileInput" class="control-label">Title</label>	
										<div class="controls">
											<input type="text" class="input-xxlarge" id="title" name="title" value="<?php echo (isset($series_details['title'])) ? $series_details['title'] : '';  ?>">
										</div>
									</div>
								
									
								
									<div class="control-group" style="display: flex;">
										<label for="fileInput" class="control-label">Keyword</label>	
										<div class="controls">
											<textarea type="textarea" class="input-xxlarge" id="keyword" name="keyword" rows="5" 
											><?php echo (isset($series_details['keyword'])) ? $series_details['keyword'] : '';  ?></textarea>
											
										</div>
									</div>
									<div class="control-group" style="display: flex;">
										<label for="fileInput" class="control-label">Description</label>	
										<div class="controls">
											<textarea type="text" class="input-xxlarge" id="description" name="description" rows="5"><?php echo (isset($series_details['description'])) ? $series_details['description'] : '';  ?></textarea>
										</div>
									</div>
									<?php } ?>
                                    <!-- ADD BY VISHAL 18-12-19 OVER -->

                                    <div class="form-actions">
                                    <input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="<?php echo (isset($series_details['id']) && $series_details['id'] !='' ? 'Update' : 'Create'); ?>" />											                                    </div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php if($_GET['action'] != 'updateseries') {?>
			<?php $series = $obj_fun->getSeries($p_size['id']);
			?>
			<?php if(isset($series) && $series !=''){ ?>
			<div class="row-fluid">
				<article class="data-block">
					<div class="data-container">
						<header>
							<h2>All <?php echo $p_size['size']; ?> Series</h2>
						</header>
						<section>
							<div class="tab-pane" id="dynamic drag_drop_result">
								<a class="btn btn-alt btn-primary" onClick="return series_mul_delete();" style="position: absolute; right: 290px;" >Delete</a>
								<table class="datatable table table-striped table-bordered" id="example" align="center">
									<thead>
										<tr>
											<th>No.</th>
											<th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
											<th>Category</th>
											<th>Enable/Disable</th>
                                            <?php if($obj_fun->getMetaData('serieslogo') == 1){?>
                                    
                                            <th>Series Logo</th>
                                            <?php } ?>
											<?php if($obj_fun->getMetaData('tkd_series') == 1){ ?>
											<th>Title</th>
											<th>Keyword</th>
											<th>Description</th>
											<?php } ?>
												
											<th>Action</th>
											<th id="drag-drop">Drag & Drop</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$i=1;
											foreach($series as $s){ ?>
										<tr class="odd gradeX" id="<?php echo $s['id']; ?>">
											<td align="center"><?php echo $i; $i++; ?></td>
											<td align="center">
												<input type="checkbox" value="<?php echo $s['id']; ?>" class="checkbox1" id="series_delete_<?php echo $s['id']; ?>" name="series_delete[]" />
											</td>	
											
											
											<td align="center" id="series_id_<?php echo $s['id']; ?>"><?php echo $s['series_name']; ?></td>
											<td>
												<?php 
													if($s['status'] == 0){ 
														echo '<span class="fam-cross"></span>';
													}else{
														echo '<span class="fam-tick"></span>';
														}
												?>
											</td>
                                            <?php if($obj_fun->getMetaData('serieslogo') == 1){?>
                                            <td>
											  <?php if($s['serieslogo'] != '') { ?>
                                                       <img src="<?php echo $s['serieslogo']; ?>" style="width: auto; height: 60px;">
                                                       <a class="btn btn btn-danger" title="Delete View" onClick="return series_view_delete(<?php echo $s['id']; ?>,'../uploads/series_logo/','<?php echo $s['serieslogo']; ?>');">&nbsp;<span class="icon-trash"></span></a>
													   <?php } else
                                                       { ?>
                                                       	<img src="img/no-image.jpg" style="width: auto; height: 60px;">
                                                       <?php } ?>
                                             
                                            </td><?php } ?>
                                            <?php if($obj_fun->getMetaData('tkd_series') == 1){ ?>
											<td><?php echo $s['title']; ?></td>
											<td><?php echo $s['keyword']; ?></td>
											<td><?php echo $s['description']; ?></td>
											<?php } ?>
											<td align="center">
												<a class="btn btn-alt btn-primary" href="series.php?action=updateseries&size=<?php echo $p_size['id'];?>&series_id=<?php echo $s['id'];?>"><span class="awe-edit"></span></a>
												<a class="btn btn-alt btn-primary" onClick="return series_delete(<?php echo $s['id']; ?>);"><span class="awe-remove"></span></a>
											</td>
											<td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span></td>
										</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php } }?>
		</div>
	</div>
	<?php include_once('script.php');?>
	<script>
	$(document).ready(function() {
			$('#selecctall').click(function(event) {  //on click
				if(this.checked) { // check select status
					$('.checkbox1').each(function() { //loop through each checkbox
						this.checked = true;  //select all checkboxes with class "checkbox1"              
					});
				}else{
					$('.checkbox1').each(function() { //loop through each checkbox
						this.checked = false; //deselect all checkboxes with class "checkbox1"                      
					});        
				}
			});
		   
		});
	</script>
</body>
</html>
<?php $xy =  $obj_fun ->getMenuTitleBySizeId($_GET['size']);?>

<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #product-size').addClass('active');
		$('.dynamic-menu #level_1_<?php echo preg_replace('/[^A-Za-z0-9\-]/', '', $xy['name']);?>').addClass('active');
		$('.dynamic-menu #level_2_<?php echo $_GET['size'];?>').addClass('active');
		$('.dynamic-menu #series_<?php echo $_GET['size'];?>').addClass('active');
	});
</script>
<link rel="stylesheet" href="order/tablednd.css" type="text/css"/>
<script type="text/javascript" src="order/jquery.tablednd.0.7.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var order = [];
	$('#example').tableDnD({
		onDrop: function(table, row) {
			var rows = table.tBodies[0].rows;
			for (var i=0; i<rows.length; i++) {
				order[i] = rows[i].id;
			}
			//console.log(order);
			var x = document.createElement("INPUT");
			x.setAttribute("type", "button");
			x.setAttribute("value", "UPDATE ORDER");
			x.setAttribute("id", "update-order");
			x.setAttribute("class", "btn btn-alt btn-primary");
			x.setAttribute("onClick", "return update_series_order('"+order+"');");
			var parent = document.getElementById("drag-drop");
			parent.innerHTML = '';
			parent.appendChild(x);
			
			/*$.post("custom-ajax.php",{action:'series_order_change',order:order,size:size },function(result){
				if(result>0)
					location.reload();
			});*/
		},
		dragHandle: ".dragHandle"
	});
	$("#example tr").hover(function() {
		$(this.cells[0]).addClass('showDragHandle');
	}, function() {
		$(this.cells[0]).removeClass('showDragHandle');
	});
});
function update_series_order(order){
	var size = <?php echo $_GET['size'];?>;
	console.log(order);
	$.post("custom-ajax.php",{action:'series_order_change',order:order,size:size },function(result){
		if(result>0)
			location.reload();
	});
	return false;
}
</script>