<?php
 
     $startDate= "";$endDate="" ;
    if(isset($_GET['toDate'])){
          global $startDate;
          $startDate = date('Y-m-d',strtotime(str_replace("/","-",$_GET['toDate'])));
           $startDate;
    }
    
    if(isset($_GET['endDate'])){
          global $endDate;
          $endDate = date('Y-m-d',strtotime(str_replace("/","-",$_GET['endDate'])));
           $endDate;
    }
    else{
         global $endDate, $startDate;
          $endDate = date('Y-m-d');
          $startDate = date("Y-m-d", strtotime("-30 day", time()));
    }
    
    //for type
    if(isset($_GET['ChartType'])){
        global $ChartType;
        $ChartType = $_GET['ChartType'];
    }
    else{global $ChartType;
        $ChartType = "sessions";}
    
    
    
?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
     
    <?php require_once('head.php'); ?>
    
    <!---analytics code-->
    <?php 
    
    $scr = $obj_fun->addAnalytics();
     
	
         $viewId = $scr['viewId'];
    	$gsServiceAccount = $scr['gsServiceAccount'];
    	$fileNameOfP12 = $scr['fileNameOfP12'];
    
        require 'gapi.class.php';
        define('ga_profile_id','<?php echo $viewId;?>');
        
        $ga = new gapi('jyora-472@jyora-ceramics.iam.gserviceaccount.com', $fileNameOfP12);
        
        
        ?>
        <!--analytics finish-->
    
    <style>
        
        .stats li {
        	display: inline-block !important;
        	width: 18% !important;
        }
        #chart1div {
        	width		: 100%;
        	height		: 200px;
        	font-size	: 11px;
        	
        }
        #chart1div text{
            fill : white !important;
        } 
        .details tbody>tr>td {
            border-bottom: 1px solid #404040;
            width: 100%;
        }
        tr.detail_text td{
            padding-top: 18px;
        }
       tr.head_text td{
            padding-top: 7px;
            color: white;
        }
        .det{
            max-height:180px;
            overflow-y:auto;
        }
        
        
        
        </style>
        
       
        <!-- Resources -->
        <script src="js/analytics/amcharts.js"></script>
        <script src="js/analytics/pie.js"></script>
        <script src="js/analytics/serial.js"></script>
        <!-- for download charts-->
        <!--<script src="js/analytics/export.min.js"></script>-->
        <link rel="stylesheet" href="css/analytics/export.css" type="text/css" media="all" />
        <script src="js/analytics/light.js"></script>
        
        <!--date picker-->
           <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
            <script type="text/javascript" src="js/datepicker.js"></script>
            <!--<script type="text/javascript" src="../js/dateRangesWidget.orig.js"></script>-->
            <script type="text/javascript" src="js/datePickerRollback.js"></script>
            <script type="text/javascript" src="js/dateUtils.js"></script>
            <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
            <!--<script type="text/javascript" src="../js/datePicker.min.js"></script>-->
            <link rel="stylesheet" href="css/datepicker.css" />
            <!--<link rel="stylesheet" href="example.css" />-->

            <script type="text/javascript">
              $(document).ready(function() {
        
                var dates = [];
                var days = 7;
                var today = new Date();
                dates[0] = new Date().setDate(today.getDate() - days).valueOf();
                dates[1] = new Date();
                dates[1].setDate(today.getDate() - 1);
                dates[1].setHours(23,59,59,0).valueOf();
        
                var dp = $('#DatePickRange').DateRangesWidget({
                  date: dates,
                  afterSave: function(){
                    console.log("From: "+formatDate('dd/mm/yy', $(this)[0])+" To: "+formatDate('dd/mm/yy', $(this)[3]));
                  },
                  selectableDates: dates,
                  values: {
                    dr1from: "Choose",
                    dr1to: "Date"
                    }
                });
        
                $("#destroy").on('click', function(){
                  dp.detach();
                  $("#DatePick-dropdown").remove();
                });
        
              });
            </script>
        <!--- close date picker-->
        
        <script>
          function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
          }
    </script>

</head>
<body>
	<div class="container">
		<div class="sidebar"><?php include_once('sidebar.php');?></div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a></li>
				<li><a href="index.php">Admin Panel</a></li>
				<li class="active">Audience Overview Of Web Visitor</li>
			</ul>
			<!-- Grid row -->
		    <div class="row-fluid">
					
			    <!-- Data block -->
				<article class="span6 data-block nested">
					
					<!-- Data block inner container -->
						<div class="data-container">
						
						<!-- Data block header-->
							<header>
								<h2>Select Date </h2><br><br>
							<hr>
								
							</header>
							<section>
							    <div id="DatePickRange"></div>
							</section>
						</div>
				</article>
				<!-- Data block -->
				<article class="span6 data-block nested">
					
					<!-- Data block inner container -->
						<div class="data-container">
						
						<!-- Data block header-->
							<header>
								<h2>Selected Date:</h2><br><br>
							<hr>
							</header>
							<section>
							    <?php if(isset($startDate)){
							            $start = date('d/m/Y',strtotime($startDate));
							            $end = date('d/m/Y',strtotime($endDate));
							            echo '['.$start.'] To ['.$end.']';
							          }else{
							               echo '[StartDate] To [Present]';
							          }?>
							</section>
						</div>
				</article>
			</div>
			<div class="row-fluid">
        		<!-- Data block -->
        		<article class="span12 data-block nested">
        		
        			<!-- Data block inner container -->
        			<div class="data-container">
        			        <header>
        			           <h2><span id="type">Session</span> Vs. Time</h2>
        			           <br><br><hr>
        			        </header>
        			        <section>
        			            
        			            <select id="a">
        			                 <option  value="sessions" <?php echo $ChartType == "sessions"?"selected":"";?>>Sessions</option>
        			                <option vlaue="bounceRate" <?php echo $ChartType == "BounceRate"?"selected":"";?>>BounceRate</option>
        			                <option value="pageViews" <?php echo $ChartType == "pageViews"?"selected":"";?>>PageViews</option>
        			                <option value="users" <?php echo ($ChartType== "users")?"selected":"";?>>Users</option>
        			               
        			            </select><br><br>
                    	        	<div id="RealTimeGraph"></div>
                    	        
                    	   </setion>
                    </div>
                </article>
            </div>
	    
		      
			
			
			
		    	<!-- Grid row -->
			    <div class="row-fluid">
					
					<!-- Data block -->
					<article class="span4 data-block nested">
					
						<!-- Data block inner container -->
						<div class="data-container">
						
							<!-- Data block header-->
							<header>
								<h2><span class="awe-reorder"></span> Audience Overview's Total</h2><br><br>
							<hr>
							
							</header>
							 <!--/Data block header -->
							
							<!-- Data block content -->
							<section>
                         		
							    <ul class="dashboard">
							         <?php
							             if(isset($startDate)){
                					        $ga->requestReportData($viewId,array('country','userType'),array('users','sessions','pageViews','bounceRate','bounceRate'),'-sessions',null,$startDate,$endDate);
							             }
							             else{
							                $ga->requestReportData($viewId,array('country'),array('users','sessions','pageViews','bounceRate','bounceRate'));
					
							             }
                					   ?>
							       <li class="dashboard-disc dashboard-toolbar">
                					<a href="#"><span class="awe-globe"></span> Sessions</a>
                					   
                						<span class="badge badge-info" ><?php 
                						
                						
                						echo $ga->getSessions() ?></span>
                					</li>
                					<li class="dashboard-disc dashboard-toolbar">
                					<a href="#"><span class="awe-globe"></span> Users</a>
                					 
                						<span class="badge badge-info" ><?php echo $ga->getUsers() ?></span>
                					</li>
                					<li class="dashboard-disc dashboard-toolbar">
                					<a href="#"><span class="awe-globe"></span> Page Views</a>
                					 
                						<span class="badge badge-info"><?php echo $ga->getPageviews() ?></span>
                					</li>
                					<li class="dashboard-disc dashboard-toolbar">
						               <a href="#"><span class="awe-globe"></span>Bounce Rate </a><span class="badge badge-info"><?php echo round($ga->getBounceRate(),2) ?></span>
					                </li>
					                
                				</ul>
                		
							</section>
					    </div>
					</article>
					<article class="span4 data-block nested">
					
						<!-- Data block inner container -->
						<div class="data-container">
						
							<!-- Data block header -->
							<header>
								<h2><span class="awe-reorder"></span> Visitor</h2><br><br>
							<hr>
								
								
							</header>
							<!-- /Data block header -->
							
							<!-- Data block content -->
							<section>
							    <div id="chart1div" style="color: white"></div>
							</section
					    ></div>
					</article>
                    
                    <article class="span4 data-block nested">
						<div class="data-container">
							<header>
								<h2><span class="awe-reorder"></span> Audience Overview Details </h2><br><br><hr>
								
							</header>
							
							<section class="tab-content">
							
							    	
								<!-- Tab #two -->
								<div class="tab-pane active">
								
									<!-- Second level tabs -->
									<div class="tabbable tabs-left">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#tab1" data-toggle="tab">Country</a></li>
											<li><a href="#tab2" data-toggle="tab">State</a></li>
											<li><a href="#tab3" data-toggle="tab">City</a></li>
											<li><a href="#tab4" data-toggle="tab">Browser</a></li>
											<li><a href="#tab5" data-toggle="tab">Page Title</a></li>
										</ul>
									
									<div class="tab-content">
									
										<div class="tab-pane active det" id="tab1">
												<!--<h3>Second tab No&deg;1</h3>-->
												<?php 
											 if(isset($startDate)){
    										    $ga->requestReportData($viewId,array('country'),array('sessions'),'-country',null,$startDate,$endDate);
											 }
											 else{									    $ga->requestReportData($viewId,array('country'),array('sessions'));
											 }
											 
									echo '<table class="details">
									            <tr class="head_text">
									                <td><b>Country</b></td>
									                <td><b>Session</b></td>
									            </tr>';
											 
                                                foreach($ga->getResults() as $result){
                                                 
                                                echo '<tr class="detail_text"><td>'.$result->getCountry()."</td><td>".$result->getSessions().''.'</td> </tr>';
                                             }
                                             
                                            echo '</table class="details">';
                                             ?>
											</div>
											<div class="tab-pane det" id="tab2">
												<?php 
        											
        										if(isset($startDate)){
        										    $ga->requestReportData($viewId,array('region'),array('sessions'),'-region',null,$startDate,$endDate);
    											 }
    											 else{									    $ga->requestReportData($viewId,array('region'),array('sessions'));
    											 }
    											
    											echo '<table class="details">
									            <tr class="head_text">
									                <td><b>State</b></td>
									                <td><b>Session</b></td>
									            </tr>';
                                                 foreach($ga->getResults() as $result){
                                                    echo '<tr class="detail_text"><td>'. $result->getRegion()."</td><td>". $result->getSessions().'</td></tr>';
                                                 }
                                                echo '</table>';
                                                 
                                                 ?>
											</div>
											<div class="tab-pane det" id="tab3">
												<?php 
    										
        										if(isset($startDate)){
        										    $ga->requestReportData($viewId,array('city'),array('sessions'),'-city',null,$startDate,$endDate);
    											 }
    											 else{									    $ga->requestReportData($viewId,array('city'),array('sessions'));
    											 }
        										
        										 echo '<table class="details">
									            <tr class="head_text">
									                <td><b>City</b></td>
									                <td><b>Session</b></td>
									            </tr>';
                                                 foreach($ga->getResults() as $result){
                                                   echo '<tr class="detail_text"><td>'.$result->getCity()."</td><td>".  $result->getSessions().'</td</tr>';        
                                             }
                                                echo '</table>';
                                             ?>
											</div>
											<div class="tab-pane det" id="tab4">
												<?php 
    											
    										if(isset($startDate)){
    										    $ga->requestReportData($viewId,array('browser'),array('sessions'),'-browser',null,$startDate,$endDate);
											 }
											 else{									    $ga->requestReportData($viewId,array('browser'),array('sessions'));
											 }
    										
    										 echo '<table class="details">
									            <tr class="head_text">
									                <td><b>Browser</b></td>
									                <td><b>Session</b></td>
									            </tr>';	
                                             foreach($ga->getResults() as $result){
                                               echo '<tr class="detail_text"><td>'.$result->getBrowser()."</td><td>". $result->getSessions().'</td></tr>';
                                             }
                                             echo '</table>';
                                             
                                             ?>
											</div>
											<div class="tab-pane det" id="tab5">
												<?php 
    											
    										if(isset($startDate)){
    										    $ga->requestReportData($viewId,array('pageTitle'),array('sessions'),'-pageTitle',null,$startDate,$endDate);
											 }
											 else{									    $ga->requestReportData($viewId,array('pageTitle'),array('sessions'));
											 }
											 
											  echo '<table class="details">
									            <tr class="head_text">
									                <td><b>Page Title</b></td>
									                <td><b>Session</b></td>
									            </tr>';	
                                             foreach($ga->getResults() as $result){
                                               echo '<tr class="detail_text"><td>'.$result->getPageTitle()."</td><td>". $result->getSessions().'</td></tr>';     
                                             }
                                             echo '</table>';
                                             
                                             
                                             ?>
											</div>
										</div>
									</div>
									<!-- Second level tabs -->
										
								</div>
								<!-- /Tab #two -->
									
							</section>
						</div>
					</article>
				</div>
			
					
						
		</div>
	</div>
    
	<?php include_once('script.php');?>
	
	
	

</body>
</html>

<script>

var chart = AmCharts.makeChart( "chart1div", {
  "type": "pie",
  "theme": "light",
  "dataProvider": [ 
      <?php
        if(isset($startDate)){
            $ga->requestReportData($viewId,array('userType'),array('sessions'),'-sessions',null,$startDate,$endDate);
        }
        else{
            $ga->requestReportData($viewId,array('userType'),array('sessions'));
        }
        foreach($ga->getResults() as $result):
        if( $result->getUserType() == 'New Visitor'){
            $newUser = $result->getSessions();
        }
        else{
            $ReturnUser = $result->getSessions();
        }
        
        endforeach
      ?>{
    "title": "New Visitor",
    "value": <?php echo $newUser;?>
  }, {
    "title": "Returning Visitor",
    "value": <?php echo $ReturnUser;?>
  } ],
  "titleField": "title",
  "valueField": "value",
  "labelRadius": 5,

  "radius": "35%",
  "innerRadius": "45%",
  "labelText": "[[title]]",
  "export": {
    "enabled": true
  }
} );
    </script>
   
<script>
$(document).ready(function(){
    var startDate = "<?php echo $startDate; ?>";
	var endDate = "<?php echo $endDate; ?>";
	var chartType = "<?php echo $ChartType?>";
     $.ajax({
		type:'POST',
		data:{typeOfChart: chartType, startDate : startDate, endDate : endDate },
		url:'analyticsGraph.php',
		success:function(data){
			$("#RealTimeGraph").html(data);
			$("#type").html(chartType);
		}
	}); 
	$('select').on('change', function() {
	    var startDate = "<?php echo $startDate; ?>";
	    var endDate = "<?php echo $endDate; ?>";
	    var chartType = this.value;
        $.ajax({
		type:'POST',
		data:{typeOfChart : this.value, startDate : startDate, endDate : endDate },
		url:'analyticsGraph.php',
		success:function(data){
			$("#RealTimeGraph").html(data);
			$("#type").html(chartType);
		}
    	}); 
      
    });
});
</script>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #analytics').addClass('active');
	});
</script>
<style>
    
    @media only screen  and (max-width: 1500px) {
    .dashboard li {
        margin: 19px 10px 0px;
    }
}
</style>
