<!DOCTYPE html>
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
	if($obj_fun->getMetaData('catalogue') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
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
				<li class="active">Add Submenu</li>
			</ul>
<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Product Size Management</h2>
							<br><br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
                            <?php 
	
								if(isset($_POST['submit']) && $_POST['submit'] == 'create'){ 
									$message = $obj_fun->insertProductSize($_POST);
									echo '<script>success("'.$message.'")</script>';
									echo "<script>urlRefresh('product-size-control.php');</script>";
								}
								if(isset($_POST['submit']) && $_POST['submit'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ 
									$message = $obj_fun->updateProductSize($_POST,$_GET['id']);
									echo '<script>success("'.$message.'")</script>';
									echo "<script>urlRefresh('product-size-control.php');</script>";
								}
								?>

                            <?php
							if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){
									$psdata = $obj_fun->getproductsizedata($_GET['id']);
								}
							?>
							<form id="myForm" class="form-horizontal" method="post" action="#">
                            	<?php 
								if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ ?>
										<input type="hidden" name="id" value="<?php $_GET['id'] ?>">
								<?php }	?>
									<div class="control-group" >
										<label for="fileInput" class="control-label">Product Size Name</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="size" name="size" value="<?php echo (isset($psdata['size'])) ? $psdata['size'] : '';  ?>" required>
										</div>
									</div>
                                    <div class="control-group" >
										<label for="fileInput" class="control-label">Series No Status</label>	
										<div class="controls">
                                        <?php if(isset($_GET['action']) && $_GET['action'] == 'create'){ ?>
										<input type="hidden" name="series_no_status" value="<?php echo $psdata['series_no_status']; ?>">
                                        	<?php 
											if($psdata['series_no_status'] == 0){
													echo "Series Number";
												}
											else if($psdata['series_no_status'] == 1){
													echo "Series";
												}
											else if($psdata['series_no_status'] == 2){
													echo "Direct Design";
												}
											else if($psdata['series_no_status'] == 3){
													echo "Direct With Series & Description";
												}
											else{
													echo "Something Is Wrong.";
												}
											?>
                                          <?php }else{ ?>
                                          
                                              	<select id="select" name="series_no_status" required>
				<option value="0"<?php echo (isset($psdata['series_no_status']) && $psdata['series_no_status'] == 0) ? ' selected' : '' ?>>Series No</option>
														<option value="1"<?php echo (isset($psdata['series_no_status']) && $psdata['series_no_status'] == 1) ? ' selected' : '' ?>>Series</option>
														<option value="2"<?php echo (isset($psdata['series_no_status']) && $psdata['series_no_status'] == 2) ? ' selected' : '' ?>>Direct Design</option>
														<option value="3"<?php echo (isset($psdata['series_no_status']) && $psdata['series_no_status'] == 3) ? ' selected' : '' ?>>Design With Series & Description</option>
													</select>
                                                    
										<?php  } ?>
												</div>
									</div>
                                       <?php 
											$menu = $obj_fun->getmenuname();
										?>
                                 <div class="control-group" >
										<label for="fileInput" class="control-label">Menu</label>	
										<div class="controls">
													<select id="select" name="menu_id" required>
														<?php
															foreach($menu as $m){ ?>
																<option value="<?php echo $m['id'] ?>"<?php echo (isset($psdata['menu_id']) && $psdata['menu_id'] == $m['id']) ? ' selected' : '' ?>><?php echo $m['name'] ?></option>
														<?php } ?>
													</select>
												</div>
									</div> 
                                    <!--
									<div class="control-group" >
										<label for="fileInput" class="control-label">Col View</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="colview" name="col_view" value="<?php echo (isset($psdata['col_view'])) ? $psdata['col_view'] : '';  ?>">
                                            <p>Only Applicable : 2,3,4,6</p>
										</div>
									</div>
                                    -->
                                    
                                    <input type="hidden" id="colview" name="col_view" value="<?php echo (isset($psdata['col_view'])) ? $psdata['col_view'] : '4';  ?>">
                                    
                                    <div class="control-group" >
										<label for="fileInput" class="control-label">Packing Size</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="packing_size" name="packing_size" value="<?php echo (isset($psdata['packing_size'])) ? $psdata['packing_size'] : '';  ?>">
                                            <p>Ex : 200 x 300. Total area calculate from this parameters.</p>
										</div>
                                        
									</div>
                                    <div class="control-group" >
										<label for="fileInput" class="control-label">Pics Per Box</label>	
										<div class="controls" style="margin-left: 180px;">
											<input type="text" class="input-xxlarge" id="packing_number" name="packing_number" value="<?php echo (isset($psdata['packing_number'])) ? $psdata['packing_number'] : '';  ?>">
										</div>
									</div>
									 <div class="control-group" >
										<label for="fileInput" class="control-label">Status</label>	
										<div class="controls">
													<select id="select" name="status" required>
														<option value="1"<?php echo (isset($psdata['status']) && $psdata['status'] == 1) ? ' selected' : '' ?>>Enable</option>
														<option value="0"<?php echo (isset($psdata['status']) && $psdata['status'] == 0) ? ' selected' : '' ?>>Disable</option>
													</select>
												</div>
									</div>
									<div class="form-actions">
<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="<?php echo (isset($_GET['action']) && $_GET['action'] == 'create') ? 'update' : 'create'; ?>" style="float: left;" />		
									</div>
								</form>
	
							</div>
						</section>
					</div>
				</article>
			</div>
</body>
</html>