<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	//if($obj_fun->getMetaData('news-with-multiple-image-and-detail') == 0 and $_SESSION['type'] == 'admin')
		//header('location:index.php'); ?>
</head>
<?php 
	$sql = "select * from product_other_admin_panel ORDER BY `order` ASC";
	$products = $obj_fun->select_all_record($sql);
	
	/*echo '<pre>';
	print_r($news);
	echo '</pre>';*/
?>
<body class="fixed-layout">
	<div class="container">
		<div class="sidebar">
			<?php include_once('sidebar.php');?>
		</div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
				<li class="active">View Product</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>View Product</h2>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="horizontal">
								<?php if(isset($_POST) && isset($_POST['product_delete']) && $_POST['product_delete'] !='')
								{
									foreach($_POST['iq_delete'] as $id)
									{
										
										$nd = $obj_fun ->update_record("DELETE FROM product_other_admin_panel WHERE id = '".$id."'");
										if($nd>0)
										{
											$sql = "select * from images where product_id= ".$id;
											$ne = $obj_fun->select_all_record($sql);
											
											for($i=0; $i < count($ne); $i++)
											{	
												$rs = $obj_fun ->update_record("DELETE FROM images WHERE id = '".$ne[$i]['id']."'");								
												if($rs>0)
												{
													unlink('../uploads/media/thumbnails/'.$ne[$i]['name']);	
													unlink('../uploads/media/'.$ne[$i]['name']);	
												}
											}
										}
									}
									header('location:product_admin_view.php');	
								}
								?>
								<form method="post" action="#">
								<input type="submit" name="product_delete" id="product_delete" value="Delete" class="btn btn-alt btn-primary" style="position: absolute; right: 290px;" />	
								<table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
									<thead>
										<tr>
											
											<th style="width:10%"><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
                                            <th style="width:10%">Category</th>
                                        <?php /*    <th style="width:10%">SubCategory</th>*/ ?>
                                            
											<th style="width:10%">Description</th>
											<th style="width:10%">Date</th>
											<th style="width:10%">View</th>
                                            <th style="width:10%">Drag & Drop</th>										
                                       </tr>
									</thead>
									<tbody>
									<?php
										if(isset($products) && $products !=''){
										foreach($products as $key=>$c)
										{
										
									?>
										<tr class="odd gradeX" id="<?php echo $c['id']; ?>">
											<td><input type="checkbox" value="<?php echo $c['id']; ?>" class="checkbox1" id="iq_delete[]" name="iq_delete[]"></td>
                                            <td><?php echo $c['title']; ?></td>
											<?php /*<td><?php echo $obj_fun->getparentname($c['parentdir']); ?></td>*/ ?>
											<td><?php echo htmlspecialchars_decode( substr($c['details'], 0,150)); ?></td>
											<td><?php echo date("d/m/Y", strtotime($c['date']));  ?></td>	
                                            <td><a href="product_admin.php?action=edit&id=<?php echo $c['id']; ?>" class="btn btn-alt btn-primary">View</a></td>
                                            <td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span></td>	
										</tr>
										<?php } }?>
									</tbody>
								</table>								
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
		</div>
	</div>
	
	<?php include_once('script.php');?>
		
		
	<script type="text/javascript">
		
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
<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #product_admin_other	').addClass('active');
		$('.dynamic-menu #p_a_view').addClass('active');
	});
</script>
<link rel="stylesheet" href="order/tablednd.css" type="text/css"/>
<script type="text/javascript" src="order/jquery.tablednd.0.7.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var order = [];
	$('#catalogueview').tableDnD({
		onDrop: function(table, row) {
			var rows = table.tBodies[0].rows;
			
			for (var i=0; i<rows.length; i++) {
				order[i] = rows[i].id;
				
				 
			}
			$.post("custom-ajax.php",{action:'product_admin_change',order:order },function(result){
				//console.log(result);
				if(result>0)
					location.reload();
			});
		},
		dragHandle: ".dragHandle"
	});
	$("#catalogueview tr").hover(function() {
		$(this.cells[0]).addClass('showDragHandle');
	}, function() {
		$(this.cells[0]).removeClass('showDragHandle');
	});
});
</script>