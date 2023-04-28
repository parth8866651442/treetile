<?php
ob_start();
$from = '';
$to = '';
if ( isset( $_POST[ 'filter' ] ) ) {

	$from = $_POST[ 'from' ];
	$to = $_POST[ 'to' ];

}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
	<?php 
	require_once('head.php');
	
?>
	<style>
		.costum_filter {
			width: 16%;
			margin-bottom: 15px;
			padding-right: 0px;
			display: inline-block;
		}
		
		.costum_filter label {
			display: block;
		}
	</style>
	<meta charset="utf-8">
</head>

<body class="fixed-layout">
	<div class="container">
		<div class="sidebar">
			<?php include_once('sidebar.php');?>

		</div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span>
				</li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span>
				</li>
				<li>All Inquiry </li>
				<li class="active">Register Inquiry</li>
			</ul>
			<div class="row-fluid">
				<article class="span12 data-block">
					<div class="data-container">
						<header>
							<h2>Register Inquiry</h2>
							<div style="float:right;">
								<h2>Export</h2>
								<a style="padding:15px; position:relative; top:5px; margin-top:5px;" href="excel/registerinquiry.php" id="exportToExcel">
									<img src="excel-icon.png" alt="Download Excel">
								</a>
							</div>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<form class="form-inline well" action="#" method="post">
									<div class="costum_filter">
										<label for="from" class="control-label">From</label>
										<input type="text" id="from" name="from" autocomplete="off">
									</div>
									<div class="costum_filter">
										<label for="from" class="control-label">To</label>
										<input type="text" id="to" name="to" autocomplete="off">
									</div>

									<button class="btn btn-alt btn-primary" type="submit" name="filter">Filter</button>
									<button class="btn btn-alt btn-danger" type="submit" onClick="reset_function()">Reset</button>
								</form>
							</div>
						</section>
						<section class="tab-content">
							<div class="tab-pane active" id="horizontal">
								<?php if(isset($_POST) && isset($_POST['Register_delete']) && $_POST['Register_delete'] !='')
								{
									
									foreach($_POST['iq_delete'] as $id)
									{
										$obj_fun->deleteRecordById('register_inquiry',$id);
									}
									header('location:register.php');	
								}
								?>
								<form method="post" action="#">
									<input type="submit" name="Register_delete" id="Register_delete" value="Delete" class="btn btn-alt btn-primary" style="position: absolute; right: 290px;" onClick="return confirm('Are You Sure You Want To Delete?');"/>
									<table class="datatable table table-striped table-bordered viewblogclass" id="example">
										<thead>
											<tr>
												<th style="width:10%"><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;"/>
												</th>
												<th>Type</th>
												<th>Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Message</th>
												<th>IP</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											<?php

											$where = 'where 1=1';
											if ( $from != ''
												and $to != '' ) {
												$from = date( "Y-m-d", strtotime( $from . ' -1 day' ) );
												$to = date( "Y-m-d", strtotime( $to . ' 1 day' ) );
												$where = "where time BETWEEN CAST('" . $from . "' AS date) AND CAST('" . $to . "' AS date)";
											}
											$sql = "SELECT * FROM `register_inquiry` " . $where . " ORDER BY `id` desc";
											$contact = $obj_fun->getRecords( $sql );
											$i = 1;
											if ( isset( $contact ) && $contact != '' ) {
												foreach ( $contact as $c ) {

													?>
											<tr class="gradeX">
												<td><input type="checkbox" value="<?php echo $c['id']; ?>" class="checkbox1" id="iq_delete[]" name="iq_delete[]">
												</td>
												<td>
													<?php echo $c['type']; ?>
												</td>
												<td>
													<?php echo $c['c_name']; ?>
												</td>
												<td>
													<?php echo $c['c_email']; ?>
												</td>
												<td>
													<?php echo $c['c_phone']; ?>
												</td>
												<td>
													<?php echo $c['c_message']; ?>
												</td>
												<td>
													<?php echo $c['ip']; ?>
												</td>
												<td>
													<?php echo date("d/m/Y", strtotime($c['time']));  ?>
												</td>
											</tr>
											<?php $i++; } }?>

										</tbody>
									</table>
								</form>
							</div>
						</section>
					</div>
				</article>
				<!-- /Data block -->
			</div>
		</div>
	</div>
</body>
<?php include_once('script.php');?>
<script type="text/javascript">
	$( document ).ready( function () {
		$( '#selecctall' ).click( function ( event ) { //on click
			if ( this.checked ) { // check select status
				$( '.checkbox1' ).each( function () { //loop through each checkbox
					this.checked = true; //select all checkboxes with class "checkbox1"              
				} );
			} else {
				$( '.checkbox1' ).each( function () { //loop through each checkbox
					this.checked = false; //deselect all checkboxes with class "checkbox1"                      
				} );
			}
		} );

	} );
</script>
<script type="text/javascript">
	jQuery( document ).ready( function ( $ ) {
		$( '.dynamic-menu #inquiry' ).addClass( 'active' );
		$( '.dynamic-menu #register' ).addClass( 'active' );
	} );
</script>

<script>
	$( function () {
		var dateFormat = "mm/dd/yy",
		from = $( "#from" )
			.datepicker( {
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1,
				maxDate :0		
				
			} )
			.on( "change", function () {
				
				to.datepicker( "option", "minDate", getDate( this ) );
				from.datepicker( "option", "dateFormat", "dd-mm-yy" );
				
			} ),
			to = $( "#to" ).datepicker( {
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1,
				maxDate :-1	
			} )
			.on( "change", function () {
				from.datepicker( "option", "maxDate", getDate( this ) );
				to.datepicker( "option", "dateFormat", "dd-mm-yy" );
			} );

		function getDate( element ) {
			var date;
			try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			} catch ( error ) {
				date = null;
			}

			return date;
		}
	} );

	function reset_function() {
		$( '#from' ).val( '' );
		$( '#to' ).val( '' );
	}
</script>

</html>