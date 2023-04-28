<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php ob_start(); ?>	
<head>
<?php 
	require_once('head.php');
?>
</head>
<?php 
	$sql = "select * from news where type='blog' ORDER BY `order_news` ASC";
	$news = $obj_fun->select_all_record($sql);
	
	
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
				<li class="active">View Blog</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						<header>
							<h2>View Blog</h2>
							 <ul class="data-header-actions tabs">
                <li class="demoTabs active">
                  <input type="button" name="delete" id="delete" value="Delete" onClick="return deleteAlertmega();" class="btn btn-alt btn-primary" />
                </li>
              </ul>
						</header>
					
						<section class="tab-content">
							<div class="tab-pane active" id="horizontal">
								<form method="post" action="#">
								
								<table class="datatable table table-striped table-bordered" id="catalogueview" align="center">
									<thead>
										<tr>
											
											<th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
                                            <th>Title</th>
											<th>Description</th>
											<th>Date</th>
											<th>View</th>
											<th>Drag & Drop</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(isset($news) && $news !=''){
										foreach($news as $key=>$c)
										{
										
									?>
										<tr class="odd gradeX" id="<?php echo $c['id']; ?>">
											<td><input type="checkbox" value="<?php echo $c['id']; ?>" class="checkbox1" id="img_delete" name="img_delete"></td>
                                            <td><?php echo $c['title']; ?></td>
											<td><?php echo htmlspecialchars_decode( substr($c['details'], 0,150)); ?></td>
											<td><?php echo date("d/m/Y", strtotime($c['date']));  ?></td>
											<td><a href="addblog.php?action=edit&id=<?php echo $c['id']; ?>" class="btn btn-alt btn-primary">View</a></td>
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
	<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #m-media').addClass('active');
		$('.dynamic-menu #blog').addClass('active');
		$('.dynamic-menu #b_view').addClass('active');
	});
</script>
	
	<link rel="stylesheet" href="order/tablednd.css" type="text/css"/>
	<script type="text/javascript" src="order/jquery.tablednd.0.7.min.js"></script>
	<script>
	$(document).ready(function() {
		var order = [];
		$('#catalogueview').tableDnD({
			onDrop: function(table, row) {
				var rows = table.tBodies[0].rows;

				for (var i=0; i<rows.length; i++) {
					order[i] = rows[i].id;				 
				}
				$.post("custom-ajax.php",{action:'blog_order_change',order:order },function(result){
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
		
		  
	function deleteAlertmega(){
			swal({
					title: "Are you sure want to delete?",
					text: "All Selected data will be remove.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Delete!",
					cancelButtonText: "No, Cancel !",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					var chkLength = $('input[name="img_delete"]:checked').length;
					if(chkLength >= 1)
					{
						if (isConfirm) {
							$('input[name="img_delete"]:checked').each(function() {
							   $.post("custom-ajax.php",{action:'Delete_Blog',id:this.value },function(result){
							   });
							});
							swal({title: "Deleted!", text: "Deleted", type: "success"},
							   function(){ 
							       location.reload();
							   }
							);
						} else {
							swal("Cancelled", "", "error");
							return false;
						}
					}
					else
					{
						swal("Cancelled", "Please Select at least one for delete", "error");
						return false;
					}
				});
		}

		$('.confirm').click(function() {
			if($(this).text()=="OK")
			{
				location.reload();
			}
		});
	
</script>
</body>
</html>
