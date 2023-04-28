    <?php
    // type of chart
     if(isset($_POST['typeOfChart'])){
          $type = $_POST['typeOfChart'];
     }
     else{
         $type = "sessions" ;
     }
     
     // start date
     if(isset($_POST['startDate'])){
         $startDate = $_POST['startDate'];
     }
     else{
        $startDate = date("Y-m-d", strtotime("-30 day", time()));
     }
     
     //end date
     if(isset($_POST['endDate'])){
         $endDate = $_POST['endDate'];
     }
     else{
        $endDate = date('Y-m-d'); 
     }
   
	 include_once('config.php');
	 require_once('function.php');
	 $obj_fun = new functions();
	 $scr= $obj_fun->addAnalytics();
	 
    require 'gapi.class.php';
    define('ga_profile_id','<?php echo $scr["viewId"];?>');
        
    $ga = new gapi("jyora-472@jyora-ceramics.iam.gserviceaccount.com", $scr["fileNameOfP12"]);
    ?>
       
    <style>
        #chartdiv {
                	width	: 100%;
                	height	: 500px;
                	background: white;
                }
    </style>
			    
       
 
   
    <div id="chartdiv" ></div>
      	        
            	   
    <script>
        var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight": 40,
    "marginLeft": 40,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled":true,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left",
        "ignoreAxisWidth":true
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "graphs": [{
        "id": "g1",
        "balloon":{
          "drop":true,
          "adjustBorderColor":false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "bulletSize": 5,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "value",
        "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
    }],
    "chartScrollbar": {
        "graph": "g1",
        "oppositeAxis":false,
        "offset":30,
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount":true,
        "color":"#AAAAAA"
    },
    "chartCursor": {
        "pan": true,
        "valueLineEnabled": true,
        "valueLineBalloonEnabled": true,
        "cursorAlpha":1,
        "cursorColor":"#258cbb",
        "limitToGraph":"g1",
        "valueLineAlpha":0.2,
        "valueZoomable":true
    },
    "valueScrollbar":{
      "oppositeAxis":false,
      "offset":50,
      "scrollbarHeight":10
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
    },
    "dataProvider": [
        <?php
           
            $ga->requestReportData($scr["viewId"],array('date'),array($type),'-date',null,$startDate,$endDate);
            
            $i;
            
            //echo $type;
            foreach($ga->getResults() as $res):
               global $i; 
                if($type == "sessions"){
                    $i[] = date('Y-m-d',strtotime($res->getDate()))."&".$res->getSessions();
                }
                elseif($type=="users"){
                    $i[] = date('Y-m-d',strtotime($res->getDate()))."&".$res->getUsers();
                    
                }
                elseif($type=="pageViews"){
                    
                    $i[] = date('Y-m-d',strtotime($res->getDate()))."&".$res->getPageViews();
                    
                }
                elseif($type =="BounceRate"){
                     $i[] = date('Y-m-d',strtotime($res->getDate()))."&".$res->getBounceRate();
                    
                }
                else{
                    $i[] = date('Y-m-d',strtotime($res->getDate()))."&".$res->getSessions();
                    
                }
                
               
            endforeach;
            
             krsort($i);
             
            foreach($i as $r):
                $date = strstr($r,'&',true);
                $val = strstr($r,'&');
                 if($type =="BounceRate"){
                    $value = round(str_replace("&","",$val),2);
                 }
                 else{
                     $value = str_replace("&","",$val);
                 }?>
                {
                    "date": <?php echo '"'.$date.'"'?>,
                    "value": <?=$value?>
                 },
                 <?php
                   
            endforeach;
        ?>
        ]
    });

    chart.addListener("rendered", zoomChart);

    zoomChart();

    function zoomChart() {
        chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
    }
    </script>