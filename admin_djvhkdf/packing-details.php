<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php'); 
	if($obj_fun->getMetaData('packing') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php');
	
	if(isset($_GET['action']) && $_GET['action'] == 'edit' && $_GET['menu'] !='' && $_GET['size'] !='') 
	{
		$action = $_GET['action'];
		$m_id = $_GET['menu'];
		$p_s_id = $_GET['size'];
		
		$sql ="SELECT menu.name as m_name,product_size.id as p_s_id,product_size.size as p_size,product_size.packing as p_packing FROM menu join product_size on menu.id = product_size.menu_id WHERE menu.id = ".$m_id." and product_size.id = ".$p_s_id." and product_size.status = 1 and menu.status = 1 order by menu.id ASC";
		$packing_detail = $obj_fun->select_one_record($sql);
			
	}
	else
		$action ='';
?>
</head>
<body class="fixed-layout">
	<div class="container">
		<div class="sidebar">
			<?php include_once('sidebar.php');?>
		</div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
				<li class="active">Packing Details</li>
			</ul>
			<?php if($action != '' && $packing_detail !=''){?>
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Packing Details</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
							<?php 
								if(isset($_POST['submit']) && $_POST['submit'] !='' && $_POST['submit'] =='Update Packing Details')
								{
										$query = "UPDATE `product_size` SET packing='".htmlspecialchars($_POST['packing'])."' where id =".$_POST['p_s_id'];
										$res = $obj_fun->update_records($query);
										if($res>0)
											echo '<script>success("Packing Details update successfully."); urlRefreshFiveSec("packing-details.php"); </script>';
										else
											echo '<script>danger("Packing Details Update Error!")</script>';
								}
							?>
								<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="#">
								<input type="hidden" name="p_s_id" id="p_s_id" value="<?php echo $packing_detail['p_s_id'];?>" />
									<div class="control-group">
										<label class="control-label" for="input" style="width: 100px; text-align: left;">Menu :</label>
										<div class="controls">
											<input type="text" disabled="" value="<?php echo $packing_detail['m_name'];?>" class="disabled" id="disabledInput">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input" style="width: 100px; text-align: left;">Size :</label>
										<div class="controls">
											<input type="text" disabled="" value='<?php echo $packing_detail['p_size'];?>' class="disabled" id="disabledInput">
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="input" style="text-align: left;">Model Details:</label>
										<div class="controls">
											<textarea id="details" class="" rows="8" name="packing"><?php echo (isset($packing_detail['p_packing']) && $packing_detail['p_packing'] !='' ? $packing_detail['p_packing'] : '');?></textarea>
										</div>
									</div>
									<div class="controls form-actions" style="padding: 15px 0px 0px;">
										<input name="submit" id="submit-frm" class="btn btn-alt btn-large btn-primary" type="submit" value="Update Packing Details" />
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php }?>
			<?php if($action == ''){?>
			<?php 
			$sql ="SELECT menu.id as m_id, menu.name as m_name,product_size.id as p_s_id,product_size.size as p_size,product_size.packing as p_packing FROM menu join product_size on menu.id = product_size.menu_id WHERE product_size.status = 1 and menu.status = 1 order by menu.id ASC";
			$p_menu = $obj_fun->getRecords($sql);
			if(isset($p_menu) && $p_menu !=''){ ?>
			<div class="row-fluid" id="">
				<article class="span12 data-block">
					<div class="data-container">
						<header>
							<h2>All Size</h2>
						</header>
						<section>
							<div class="tab-pane" id="dynamic">
								<table class="datatable table table-striped table-bordered" id="filter-view" align="center">
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th>Type</th>
											<th>Size</th>
											<th>Packing Details</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($p_menu as $k => $p){ ?>
										<tr class="odd gradeX">
											<td align="center"><?php echo $k+1; ?></td>
											<td align="center"><?php echo $p['m_name']; ?></td>
											<td align="center"><?php echo $p['p_size']; ?></td>
											<td align="center" class="table-100"><?php echo htmlspecialchars_decode($p['p_packing']); ?></td>
											<td align="center">
												<a class="btn btn-alt btn-primary" href="packing-details.php?menu=<?php echo $p['m_id']; ?>&size=<?php echo $p['p_s_id']; ?>&action=edit"><!--<span class="awe-edit"></span>-->Edit</a>
											</td>
										</tr>
										<?php }?>
									</tbody>
								</table>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php }?>
			<?php }?>
		</div>
	</div>
	
	<?php include_once('script.php');?>
	<script type="text/javascript">
		 	jQuery(document).ready(function($) {
		 	$('.dynamic-menu #packing').addClass('active');
		});
	</script>
		<script type="text/javascript">
			 jQuery(document).ready(function($) {
				/*$('.dynamic-menu').addClass('dis_bloc');
				$('.dynamic-menu #product-<?php echo $p_cat_id;?>').addClass('active');*/
			});
		</script>
		<script src="ckeditor/ckeditor.js"></script>
		<script src="ckeditor/adapters/jquery.js"></script>
		<script>
			CKEDITOR.disableAutoInline = true;
			$( document ).ready( function() {
				CKEDITOR.replace( 'details',
				{
					toolbar: [
{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
'/',
{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
'/',
{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'Fontyturl' ] },
{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
{ name: 'others', items: [ '-' ] },
{ name: 'about', items: [ 'About' ] }
]
				});
			});
		</script>
</body>
</html>
<style>
.res-table table{
	width:100%;
}
.table-100 table
{
	width:100%;
}
</style>