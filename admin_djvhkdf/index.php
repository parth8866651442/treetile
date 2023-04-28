<!DOCTYPE html>
<html class="no-js" lang="en">
<head><?php require_once('head.php'); ?>
 <?php 
	if($obj_fun->getMetaData('analytics') == 1){
		$scr = $obj_fun->addAnalytics();
		$viewId = $scr['viewId'];
		$gsServiceAccount = $scr['gsServiceAccount'];
		$fileNameOfP12 = $scr['fileNameOfP12'];
		require 'gapi.class.php';
		define('ga_profile_id','<?php echo $viewId;?>');
		$ga = new gapi('jyora-472@jyora-ceramics.iam.gserviceaccount.com', $fileNameOfP12);
	}
?>
</head>
<body>
	<div class="container">
		<div class="sidebar"><?php include_once('sidebar.php');?></div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a></li>
				<li><a href="index.php">Admin Panel</a></li>
				<li class="active">Dashboard</li>
			</ul>
            <?php if($obj_fun->getMetaData('analytics') != 1){?>
			<div class="row-fluid">
				<article class="data-block nested rm-bordr">
					<div class="data-container">
						<section class="tab-content ">
							<div class="tab-pane active " id="newUser">
								<div class="well">
										<h1 style="text-align: center; margin-bottom: 0px;">Welcome To <?php echo company;?></h1>
								</div>
							</div>
						</section>
					</div>
				</article>
			</div>
            <?php } else { ?>
            
            <div class="row-fluid">
				<article class="span6 offset3 data-block nested rm-bordr">
					<div class="data-container">
						<section class="tab-content">
							<div class="tab-pane active " id="newUser">
								<div class="well" style="background: #292728;">
										<h1 style="text-align: center; margin-bottom: 0px;color:#fff;">Welcome To <?php echo company;?></h1>
								</div>
							</div>
						</section>
					</div>
				</article>
			</div><?php } ?>
            
			<?php if($obj_fun->getMetaData('analytics') != 1){?>
				<div class="row-fluid">
				<article class="span6 offset3 data-block nested rm-bordr">
					<div class="data-container" style="background: #292728;">
						<section class="tab-content ">
							<div class="tab-pane active" id="newUser">
								<div class="well">
										<div style="margin: 5% auto; width: 100%; text-align: center;">
                                        <?php
												$masteradmin = $obj_fun->getUser('master-admin');
										  ?>
										<img alt="Admin" src="<?php echo $masteradmin['homelogo']; ?>">
										</div>
								</div>
							</div>
						</section>
					</div>
				</article>
			</div>
			<?php }else{?>
			<!-- Grid row -->
				
				<?php
                /* Total Visits */
   
                $ga->requestReportData($viewId,array('browser','browserVersion'),array('pageviews','visits','users'),'-visits');
                $totalVisit = $ga->getVisits();
                 
                /* Today Visits */
                $ga->requestReportData($viewId,array('date'),array('visits'),'-date',null,date("Y-m-d", strtotime("0 day", time())),date("Y-m-d", strtotime("0 day", time())));
                $today = $ga->getVisits();
               
                /* Yeasterday Visits */
                $ga->requestReportData($viewId,array('date'),array('visits'),'-date',null,date("Y-m-d", strtotime("-1 day", time())),date("Y-m-d", strtotime("-1 day", time())));
                $yesterday= $ga->getVisits();
                
                /* last week Visits */
                $ga->requestReportData($viewId,array('date'),array('visits'),'-date',null,date("Y-m-d", strtotime("-7 day", time())),date("Y-m-d", strtotime("0 day", time())));
                $week= $ga->getVisits();
                
                /* last month Visits
                date("Y-m-d", strtotime("first day of previous month"))
                date("Y-m-d", strtotime("last day of previous month")) */
                $ga->requestReportData($viewId,array('month'),array('visits'),'-month',null,date("Y-m-d", strtotime("-31 day", time())),date("Y-m-d", strtotime("0 day", time())));
                $lastMonth= $ga->getVisits();
                
                /* last year Visits */
                $ga->requestReportData($viewId,array('year'),array('visits'),'-year',null,date("Y",strtotime("-1 year"))."-01-01",date("Y",strtotime("-1 year"))."-12-31");
                $lastyear= $ga->getVisits();
                /* echo date("Y-m-d", strtotime("-1 day", time())); */
                 
             ?>
			    <div class="row-fluid">
				    <!-- Data block -->
				    <article class="span3 data-block nested">	
						<div class="data-container">
							<header>
								<h2><span class="awe-signal"></span> Heightlights</h2><br><br><hr>
							</header>
							<ul class="dashboard" style="margin-top:15px;margin-bottom:20px;">
								<li class="dashboard-toolbar">
									<a href="#"><span class="awe-flag"></span> Total Visits</a>
									<span class="badge" style="background-color: red"><?php echo ($totalVisit != NULL) ? $totalVisit : '0'; ?></span>
								</li>
								<li class="dashboard-toolbar">
									<a href="#"><span class="awe-flag"></span>Last 30 Days Visits</a>
									<span class="badge a"><?php echo ($lastMonth != NULL) ? $lastMonth : '0'; ?></span>
								</li>
							</ul>
						</div>
				    </article>
					<!-- Data block -->
					<article class="span9 data-block nested">
						<!-- Data block inner container -->
						<div class="data-container">
							<header>
								<h2><span class="awe-signal"></span> OverView</h2><br><br><hr>
							</header>
							<!-- Data block content -->
							<section>
								<!-- Data block statistics widget -->
								<ul class="stats">
									<li>
										<strong class="stats-count"><?php echo ($totalVisit != NULL) ? $totalVisit : '0'; ?></strong>
										<p>Total Visit</p>
									</li>
									<li>
										<strong class="stats-count"><?php echo ($today != NULL) ? $today : '0'; ?></strong>
										<p>Today Visit</p>
									</li>
									<li>
										<strong class="stats-count"><?php echo ($yesterday != NULL) ? $yesterday : '0'; ?></strong>
										<p>Yesterday Visit</p>
									</li>
									<li>
										<strong class="stats-count"><?php echo ($week != NULL) ? $week : '0'; ?></strong>
										<p>Last Week Visit</p>
									</li>
									<li>
										<strong class="stats-count"><?php echo ($lastMonth != NULL) ? $lastMonth : '0'; ?></strong>
										<p>Last Month Visit</p>
									</li>
									<li>
										<strong class="stats-count"><?php echo ($lastYear != NULL) ? $lastYear : '0'; ?></strong>
										<p>Last Year Visit</p>
									</li>
								</ul>
								<!-- /Data block statistics widget -->
							</section>
						</div>
						<button class="btn btn-info" style="float:right;" onClick="document.location.href = 'analytics.php'">Get More Infomation>></button>
					</article>
				</div>
				<div class="row-fluid">
				    <div id="RealTimeAnalytics"></div>
				</div>
				<?php } ?>
                
                <?php
                if($obj_fun->getMetaData('Whatsapp_display') == 1){
				global $con;
				?>
				<div class="row-fluid">
					<article class="span12 data-block nested">
						<div class="data-container">
							<header>
								<h2><span class="awe-signal"></span> WhatsApp Inquiry</h2>
							</header>
							<section>
								<ul class="stats">
									<li>
										<?php $total_whatapp_counter = mysqli_num_rows(mysqli_query($con,"select * from whatsapp_analytics where 1=1 ")); ?>
										<strong class="stats-count"><?php echo $total_whatapp_counter; ?></strong>
										<p>Total Inquiry</p>
                                    </li>
									<li>
										<?php  $today_whatapp_counter = mysqli_num_rows(mysqli_query($con,"select * from whatsapp_analytics where 1=1 AND adate BETWEEN '".date("Y-m-d", strtotime("0 day", time()))."' AND '".date("Y-m-d", strtotime("0 day", time()))."'"));  ?>
										<strong class="stats-count"><?php echo $today_whatapp_counter; ?></strong>
										<p>Today Inquiry</p>
                                    </li>
									<li>
										<?php  $yesterday_whatapp_counter = mysqli_num_rows(mysqli_query($con,"select * from whatsapp_analytics where 1=1 AND adate BETWEEN '".date("Y-m-d", strtotime("-1 day", time()))."' AND '".date("Y-m-d", strtotime("-1 day", time()))."'"));  ?>
										<strong class="stats-count"><?php echo $yesterday_whatapp_counter; ?></strong>
										<p>Yesterday Inquiry</p>
                                    </li>
									<li>
										<?php  $last_week_whatapp_counter = mysqli_num_rows(mysqli_query($con,"select * from whatsapp_analytics where 1=1 AND adate BETWEEN '".date("Y-m-d", strtotime("-7 day", time()))."' AND '".date("Y-m-d", strtotime("0 day", time()))."'"));  ?>
										<strong class="stats-count"><?php echo $last_week_whatapp_counter; ?></strong>
										<p>Last Week Inquiry</p>
                                    </li>
									<li>
										<?php  $last_month_whatapp_counter = mysqli_num_rows(mysqli_query($con,"select * from whatsapp_analytics where 1=1 AND adate BETWEEN '".date("Y-m-d", strtotime("-31 day", time()))."' AND '".date("Y-m-d", strtotime("0 day", time()))."'"));  ?>
										<strong class="stats-count"><?php echo $last_month_whatapp_counter; ?></strong>
										<p>Last Month Inquiry</p>
                                    </li>
									<li>
										<?php  
										$last_year_whatapp_counter = mysqli_num_rows(mysqli_query($con,"select * from whatsapp_analytics where 1=1 AND adate BETWEEN '".date("Y",strtotime("-1 year"))."-01-01"."' AND '".date("Y",strtotime("-1 year"))."-12-31"."'"));  ?>
										<strong class="stats-count"><?php echo $last_year_whatapp_counter; ?></strong>
										<p>Last Year Inquiry</p>
                                    </li>
								</ul>
							</section>
						</div>
					</article>
				</div>
            <?php } ?>
			
		</div>
	</div>
	<?php include_once('script.php');?>
</body>
</html>
<script>
<?php if($obj_fun->getMetaData('analytics') == 1){?>
	$(document).ready(function(){
		$.ajax({
			type:'POST',
			url:'analyticsRealTime.php',
			success:function(data){
				$("#RealTimeAnalytics").html(data);
			}
		});
	});
	function analytics()
	{
		$.ajax({
			type:'POST',
			url:'analyticsRealTime.php',
			success:function(data){
				$("#RealTimeAnalytics").html(data);
			}
		}); 
	}
	setInterval("analytics()", 3000);
<?php } ?>
</script>

<style>
@media only screen and (max-width: 500px){
	.dashboard li {
		margin: 19px 3px 0px;
	}
}
@media only screen  and (max-width: 1500px) {
    .dashboard li {
        margin-left: 38px;
    }
}
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.dynamic-menu #home').addClass('active');
});
</script>