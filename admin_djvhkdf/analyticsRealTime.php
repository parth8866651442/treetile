    <?php
        include_once('config.php');
    	require_once('function.php');
    	$obj_fun = new functions();
    	$scr= $obj_fun->addAnalytics();
    	 
        
        require 'gapi.class.php';
        define('ga_profile_id','<?php echo $scr["viewId"];?>');
        
        $ga = new gapi("jyora-472@jyora-ceramics.iam.gserviceaccount.com",$scr["fileNameOfP12"]);
    ?>   
                <article class="span3 data-block nested">
						<div class="data-container">
							<header>
								<h2><span class="awe-reorder"></span>   Total Active Users</h2><br><br><hr>
							</header>
							<section style="text-align: center;">
				                <h1>
									    <?php 
									         $ga->realTimeReportData($scr["viewId"],null,array('activeUsers'));
									         //echo "test";
									         foreach($ga->getResults() as $result):
									             static $i = 0,$j= 0;
									             $m[] = $result->getMetrics();
									             $j += $m[$i]['rt:activeUsers'];
									             echo $j;
									             
									             $i++;
									         endforeach;
									         if(isset($m) != true){echo 0; }
				                        ?>
				                </h1>
				            </section>
				        </div>
				    </article>
					<!-- Data block -->
					<article class="span9 data-block nested">
						<div class="data-container">
							<header>
								<h2><span class="awe-reorder"></span>  Real-Time Analytics</h2><br><br><hr>
							</header>
							<section>
								<table class="table">
									<thead>
										<tr>
											<th>Active Users</th>
											<th>PageView</th>
											<th>Page Title</th>
										</tr>
									</thead>
									<tbody>
									    <?php
                                       $ga->realTimeReportData($scr["viewId"],array('pagePath','pageTitle'),array('activeUsers'));
									    foreach($ga->getResults() as $result):
		                                    
		                                 
									      $m_[] = $result->getMetrics();
									       
									      $d[] = $result->getDimensions();
									    
									      static $k=0; 
									    ?>
										<tr>
											<td><?php echo $m_[$k]['rt:activeUsers'];?></td>
											<td><?php echo $d[$k]['rt:pagePath'];?></td>
											<td><?php echo $d[$k]['rt:pageTitle']; ?></td>
										</tr>
										<?php $k++; endforeach;
										
										//if no-active 
										if(isset($m) != true){?>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        <?php }
										?>
									</tbody>
								</table>
							</section>
						</div>
					</article>
					<!-- /Data block -->