<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
	require_once('head.php'); 
	if($obj_fun->getMetaData('product') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php');
?>
</head>
<?php
$seriesno_id='';
if(isset($_GET['action']) && $_GET['action'] == 'newseriesno' && isset($_GET['size']) && $_GET['size'] !='')
{
	$p_size = $obj_fun->getProductSizeById($_GET['size']);
	$p_series = $obj_fun->getSeries($p_size['id']);
}
elseif($_GET['action'] == 'updateseriesno' && isset($_GET['size']) && $_GET['size'] !='' && isset($_GET['seriesno_id']) && $_GET['seriesno_id'] !='')
{
	$p_size = $obj_fun->getProductSizeById($_GET['size']);
	$p_series = $obj_fun->getSeries($p_size['id']);
	$p_series_details = $obj_fun->getSeriesNoById($_GET['seriesno_id']);	
	
}
else
	header('location:index.php');
?>
<body class="fixed-layout" id="">
	<div class="container">
		<div class="sidebar"><?php include_once('sidebar.php');?></div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
				<li class="active"><?php echo $p_size['size']; ?> Series Number</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2><?php echo (isset($seriesno_id) && $seriesno_id !='' ? 'Update' : 'Add').' ' . $p_size['size']; ?> Series Number</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
									if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Create')
									{
										$slug = $obj_fun->createSlug($_POST['series_no']); 
										$ins = $obj_fun->insertSeriesNo($_POST['series_no'],$slug,$_POST['p_size_id'],$_POST['series_id']);
										
										if($ins =='success')
										{
											echo '<script>success("Serises Number Insert successfully.")</script>';
											echo "<script>urlRefresh('series-no.php?action=newseriesno&size=".$_POST['p_size_id']."');</script>";
										}
										elseif($ins =='exists')
											echo '<script>danger("Serises Number already exists !")</script>';
										elseif($ins =='update')
											echo '<script>success("Serises Number Update SucessFully !")</script>';
										elseif($ins =='series no')
											echo '<script>danger("Insert Serises Number!")</script>';
										else
											echo '<script>danger("Get error while updating Series Number details !")</script>';
									}
									if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update')
									{
										$slug = $obj_fun->createSlug($_POST['series_no']); 
										$s_ins = $obj_fun->updateSeriesNo($_POST['series_id'],$slug,$_POST['series_no'],$_POST['id'],$_POST['size_id']);
										if($s_ins =='success')
										{
											echo '<script>success("Serises Number Update successfully.")</script>';
											echo "<script>urlRefresh('series-no.php?action=newseriesno&size=".$_POST['p_size_id']."');</script>";
										}
										else
											echo '<script>danger("'.$s_ins.'")</script>';
									}
								?>
								<form class="form-horizontal" method="post" enctype="multipart/form-data" onSubmit="return series_no_validate();">
                                <?php if($_GET['action'] == 'updateseriesno'){ ?>
                                
                                 <div class="control-group" >
										<label for="fileInput" class="control-label">Product Size</label>	
										<div class="controls">
                                        <?php
										$sql = "SELECT menu_id FROM `product_size` WHERE id='".$_GET['size']."'";
										$ss = $obj_fun->getLastRecords($sql);
										$sql = "SELECT * FROM `product_size` WHERE menu_id = '".$ss['menu_id']."'";
										$pdata = $obj_fun->getRecords($sql);
										?>
									<select id="size_id_modify" name="size_id" onchange="seriesoptionupdate()" required>
                                                    <?php foreach($pdata as $p){ ?>
<option value="<?php echo $p['id']; ?>"<?php echo ($p['id'] == $_GET['size']) ? ' selected' : ''; ?>><?php echo $p['size']; ?></option>
                                                        <?php } ?>
									</select>
									</div>
									</div>
                                    
                                <?php } ?>
									<div class="control-group">
										<label for="select" class="control-label">Select Series</label>
										<div class="controls">
											<select id="series_id" name="series_id">
												<option value="">Select Series</option>
												<?php foreach($p_series as $value){ ?>
													<option  value="<?php echo $value['id'];?>" <?php echo (isset($p_series_details['series_id']) && $value['id'] == $p_series_details['series_id'] ? 'selected="selected"' : ''); ?> ><?php echo $value['series_name'];?></option>
												
												<?php }?>
											</select>
											<a class="btn" href="series.php?action=newseries&size=<?php echo $_GET['size']; ?>">Add New Series</a>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input">Series No.</label>
										<div class="controls">
											<input id="series_no" name="series_no" class="input-xxlarge" type="text" value="<?php echo (isset($p_series_details) && $p_series_details['series_no_name'] != '' ? $p_series_details['series_no_name'] : ''); ?>" />
											<input id="p_size_id" name="p_size_id" class="input-xxlarge" type="hidden" value="<?php echo $p_size['id']; ?>" />
											<input id="id" name="id" class="input-xxlarge" type="hidden" value="<?php echo (isset($p_series_details) &&  $p_series_details['id'] != '' ? $p_series_details['id'] : ''); ?>" />
										</div>
									</div>
										<div class="form-actions">
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="<?php echo (isset($p_series_details) &&  $p_series_details['id'] != '' ? 'Update' : 'Create'); ?>" />
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php if($_GET['action'] != 'updateseriesno') {?>
			<div class="row-fluid" id="">
				<article class="span12 data-block">
					<?php
						if(isset($_GET['filter']) && $_GET['filter'] !='')
						{
							$drag_drop = $_GET['filter'];
							$p_series_data = $obj_fun->getSeriesById($_GET['filter']);
							$p_s_id = $p_series_data['id'];
							$p_s_name = $p_series_data['series_name'];
							
							$p_series_no = $obj_fun->getSeriesNoBySeriesId($p_s_id);
						}
						else
						{
							$drag_drop = '';
							$p_s_id = $p_series[0]['product_size_id'];
							$p_series_no = $obj_fun->getSeriesNoBySizeId($p_s_id);
						}
					?>
					<div class="data-container">
						<header>
							<h2><?php if(isset($p_s_name)){ echo $p_s_name; } else { echo 'All';}?> Series Number </h2>
							<div class="btn-group pull-right">
								<a class="btn btn-alt btn-primary dropdown-toggle" data-toggle="dropdown" href="#">Series filter <span class="caret"></span></a>
								<ul class="dropdown-menu datatable-controls filter-menu">
									<li onClick="series_filter(<?php echo $_GET['size'];?>,'');"><label for="dt_col_1">All Series</label></li>
									<?php foreach($p_series as $value){ ?>
									<li onClick="series_filter(<?php echo $p_size['id'];?> ,<?php echo $value['id'];?>);"><label for="dt_col_1"><?php echo $value['series_name'];?></label></li>
									<?php }?>
								</ul>
							</div>
						</header>
						<section>
							<div class="tab-pane" id="dynamic">
								<a class="btn btn-alt btn-primary" onClick="return series_no_mul_delete();" style="position: absolute; right: 290px;" >Delete</a>
								<table class="datatable table table-striped table-bordered"  id="example" align="center">
									<thead>
										<tr>
											<th>No.</th>
											<th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
											<th>Series Name</th>
											<th>Series Number</th>
											<th>Action</th>
                                            <?php if($drag_drop !=''){?><th id="drag-drop">Drag & Drop</th><?php }?>
										</tr>
									</thead>
									<tbody>
										<?php 
											$i=1;
											if(isset($p_series_no) && $p_series_no !=''){
											foreach($p_series_no as $s){
											$path = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $p_size['size']) ."/". preg_replace('/[^A-Za-z0-9\-]/', '', $s['series_name'].'-'.$p_size['id']);
											?>
										<tr class="odd gradeX" id="<?php echo $s['id']; ?>">
											<td align="center"><?php echo $i; $i++; ?></td>
											<td align="center">
												<input type="checkbox" value="<?php echo $s['id']; ?>" class="checkbox1" id="s_no_delete_<?php echo $s['id']; ?>" name="s_no_delete[]" />
												<input type="hidden" name="s_no_path_<?php echo $s['id']; ?>" id="s_no_path_<?php echo $s['id']; ?>" value="<?php echo $path; ?>" />
											</td>	
											<td align="center" id="series_id_<?php echo $s['id']; ?>"><?php echo $s['series_name']; ?></td>
											<td align="center" id="series_no_id_<?php echo $s['id']; ?>"><?php echo $s['series_no_name']; ?></td>
											<td align="center">
												<a class="btn btn-alt btn-primary" href="series-no.php?action=updateseriesno&size=<?php echo $p_size['id'];?>&seriesno_id=<?php echo $s['id'];?>"><span class="awe-edit"></span></a>
												<a href="#" class="btn btn-alt btn-primary" onClick="return series_no_delete(<?php echo $s['id']; ?>,'<?php echo $path;?>');"><span class="awe-remove"></span></a>
											</td>
                                            <?php if($drag_drop !=''){?><td class="dragHandle"><span class="awe-move" style="font-size: 25px;"></span></td><?php }?>
										</tr>
										<?php }}?>
									</tbody>
								</table>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php }?>
		</div>
	</div>
	<style>
	.filter-menu li label{
		color:#333333;
	}
	.filter-menu li:hover {
		background-color:#d9d9d9;
	}
	.tbl_btn_update{
		opacity:0;
	}
	.datatable.table input{
		border:none;
		margin:0 10px;
	}
	</style>
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
	function series_no_validate(){
		var valid = true;
		   if(document.getElementById('series_no').value.replace(/^\s+/,'')=='')
           {
                document.getElementById('series_no').style.border="solid 1px #DD0000";
                document.getElementById('series_no').style.borderRadius="4px";
                document.getElementById('series_no').style.boxShadow="0px 0px 10px #BB0000";
                valid = false;
            }
		return valid;
		}
	</script>
</body>
</html>
<?php $xy =  $obj_fun ->getMenuTitleBySizeId($_GET['size']);?>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
	 	$('.dynamic-menu #product-size').addClass('active');
		$('.dynamic-menu #level_1_<?php echo preg_replace('/[^A-Za-z0-9\-]/', '', $xy['name']);?>').addClass('active');
		$('.dynamic-menu #level_2_<?php echo $_GET['size'];?>').addClass('active');
		$('.dynamic-menu #seriesno_<?php echo $_GET['size'];?>').addClass('active');
	});
</script>
<?php if(isset($drag_drop) && $drag_drop !=''){?>
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
			console.log(order);
			var x = document.createElement("INPUT");
			x.setAttribute("type", "button");
			x.setAttribute("value", "UPDATE ORDER");
			x.setAttribute("id", "update-order");
			x.setAttribute("class", "btn btn-alt btn-primary");
			x.setAttribute("onClick", "return update_seriesno_order('"+order+"');");
			var parent = document.getElementById("drag-drop");
			parent.innerHTML = '';
			parent.appendChild(x);
			
		},
		dragHandle: ".dragHandle"
	});
	$("#example tr").hover(function() {
		$(this.cells[0]).addClass('showDragHandle');
	}, function() {
		$(this.cells[0]).removeClass('showDragHandle');
	});
});
function update_seriesno_order(order){
	var series= <?php echo $drag_drop;?>;
	console.log(order);
	$.post("custom-ajax.php",{action:'seriesno_order_change',order:order,series:series },function(result){
		if(result>0)
			location.reload();
	});
	return false;
}

</script>
<?php }?>
<?php if($_GET['action'] == 'updateseriesno'){ ?>
<script>
function seriesoptionupdate(){
	 var x = document.getElementById("size_id_modify").value;
	 $.post("custom-ajax.php",{action:'get_series',id:x },function(result){
		
			$('#series_id').html(result);
		
	});
	
	}
</script>
<?php }?>