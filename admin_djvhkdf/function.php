<?php
include("smtpinclude.php");
class functions {
	function login($user, $pass)
	{
	    
		global $con;
		$sql = "select * from admin where username='".$user."' and password='".base64_encode($pass)."'";
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res);
	}
	function getUser($type)
	{
	    global $con; 
		$sql = "select * from admin where type='".$type."'";
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res); 
	}
	function updateAdmin($user,$email,$pass,$id,$homelogo,$icon,$favicon)
	{
			global $con; 
			$sql="UPDATE admin SET username='".$user."', email='".$email."', password='".base64_encode($pass)."' , homelogo='".$homelogo."' , icon='".$icon."' , favicon='".$favicon."'  WHERE id=".$id;
			if (!mysqli_query($con,$sql))
			{
				echo '<script>danger("Get error while updating login details !")</	>';
				return 0;
			}
			else
			{
				/*echo '<script>success("Login details updated successfully.")</script>';*/
				return 1;
			}
	}
	
	// For Settings
	function add_MetaData($type,$data)
	{	
		global $con;  
		$status=0;
		foreach($data as $key =>$value)
		{
			$res = $this->check_MetaData($type, $key);
			if($res>0)
			{
				$sql = "update settings set data ='".$value."' where type ='".$type."' and meta = '".$key ."'";				
				mysqli_query($con,$sql);
			}
			else
			{
				$sql = "insert into settings set type ='".$type."', meta = '".$key ."', data ='".$value."'";
				mysqli_query($con,$sql);
			}
			$status = 1;
		}
		return $status; 
	}
	function check_MetaData($type, $key)
	{
		global $con;  
		$sql ="select * from settings where type = '".$type."' and meta = '".$key ."'";
		return mysqli_num_rows(mysqli_query($con,$sql));
	}
	function getMetaData($meta)
	{	
		global $con;  
		$sql ="select data from settings where meta = '".$meta ."'";
		$q = mysqli_query($con,$sql);
		 	
		if(mysqli_num_rows($q)>0)
		{
			$row =  mysqli_fetch_array($q);
			return $row[0];
		}
		
	}
	//For Not Workig Product Size
	function getMenu()
	{
		global $con; 
		$results=array();
		
		$r = mysqli_query($con,"SELECT * FROM `menu` WHERE status = 1 order by `order` ASC");
		if(mysqli_num_rows($r) >0)
		{
			$j = 0;
			$results['menu_status'] = 'three_level_menu';
			while($rr = mysqli_fetch_array($r))
			{
				$results[$j] = $rr;
					
				$sql = "select * from product_size where status=1 and menu_id = ".$rr['id'] ." order by `order` ASC";
				$res= mysqli_query($con,$sql);
				$i=0;
				while($row = mysqli_fetch_array($res))
				{
					$res1= mysqli_query($con,"select * from product_size where status=1 and id=".$row['id']);
					$row1 = mysqli_fetch_array($res1);
					$results[$j]['size'][] = $row1;
					
					
					$sql2 = "select * from series where product_size_id = ".$row1['id']." and status=1 order by `order` ASC";
					$res2= mysqli_query($con,$sql2);
					if(mysqli_num_rows($res2) >0)
					{
						while($row2 = mysqli_fetch_array($res2))
						{
							$results[$j]['size'][$i]['series'][] = $row2;
							
						}
					}
					$i++;
				} 
				$j++;
			}
		}
		else
		{
		
			$sql = "select * from product_size where status=1";
			$res= mysqli_query($con,$sql);
			$i=0;
			$results['menu_status'] = 'two_level_menu';
			while($row = mysqli_fetch_array($res))
			{
				$res1= mysqli_query($con,"select * from product_size where status=1 and id=".$row['id']);
				$row1 = mysqli_fetch_array($res1);
				$results[$i] = $row1;	
				
				$sql1 = "select * from series where product_size_id = ".$row['id']." and status=1 order by `order` ASC";
				$res1= mysqli_query($con,$sql1);
				while($row1 = mysqli_fetch_array($res1))
				{
					$results[$i]['series'][] = $row1;
				}
				$i++;
			}
		}
		return $results;
	}


function getMainMenu(){
		
		 global $con; 
		$data = $this->getMenu();
		$results = array();
		if($data['menu_status'] == 'three_level_menu'){
				unset($data['menu_status']);
				
			foreach($data as $menu){
				
					$m = array();
					$m['name'] = $menu['name'];
					$m['url'] = '#';
						
					if(isset($menu['size'][0]['series_no_status'])){
						
						foreach($menu['size'] as $size){
							
							$c = array();
							$c['name'] = $size['size'];
							$c['url'] = '#';
						if($size['series_no_status'] == '2'){
							
							
							$c['url'] = 'product-size-'.$size['id'].'.html';
								
							}else{
								
								
								
								if(isset($size['series']) && $size['series'] !=''){
									
								if($size['series_no_status'] == '2'){
										$c['url'] = 'product-series-'.$size['series'][0]['id'].'.html';
										
										foreach($size['series'] as $series){
											
												$s = array();
												$s['name'] = $series['series_name'];
												$s['url'] = 'product-series-'.$series['id'].'.html';
												$c['next'][] = $s;
											}
										
										
								}else{
								
								if($size['series_no_status'] == '3'){
										$c['url'] = 'product-series-'.$size['series'][0]['id'].'.html';	
										
											foreach($size['series'] as $series){
											
												$s = array();
												$s['name'] = $series['series_name'];
												$s['url'] = 'product-series-'.$series['id'].'.html';
												$c['next'][] = $s;
											}
											
										
								}else{
									
									if(isset($size['series'][0]['design_view']) && $size['series'][0]['design_view'] ==0){
												$c['url'] = 'product-series-'.$size['series'][0]['id'].'.html';
												
											foreach($size['series'] as $series){
											
												$s = array();
												$s['name'] = $series['series_name'];
												$s['url'] = 'product-series-'.$series['id'].'.html';
												$c['next'][] = $s;
											}
										
										}else{
												$c['url'] = 'product-seriesno-'.$size['series'][0]['id'].'.html';
												
												
											foreach($size['series'] as $series){
											
												$s = array();
												$s['name'] = $series['series_name'];
												$s['url'] = 'product-seriesno-'.$series['id'].'.html';
												$c['next'][] = $s;
											}
											
											
											}
										
									
									}
								
								
								}
								}
								
								}
						
						$m['next'][] = $c;
						
					
					
					}
					}
					$results[] = $m;
				}
			
			}
		return $results;
		}



	
	function getMenuTitleBySizeId($id)
	{
		global $con; 
		$sql = "SELECT menu.name FROM product_size join menu on product_size.menu_id = menu.id WHERE product_size.id = ".$id;
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res);
	}
	function getmenuimg()
	{
		global $con; 
		$sql = "SELECT prologo from menu";
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res);
	}
	
	
	function getsizeimg($imgtitle)
	{
		global $con; 
		$sql = "SELECT sizelogo from product_size where id = ".$imgtitle;;
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res);
	}
	
	function getseriesimg($seriesimgtitle)
	{
		global $con; 
		$sql = "SELECT serieslogo from series where id = ".$seriesimgtitle;
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res);
	}
	
	function getGalleryMenu()
	{
		  
		$results=array();
		
		
		$sql = "select * from product_size where menu_id = 0 and status=1";
		$res= mysqli_query($con,$sql);
		$i=0;
		$results['menu_status'] = 'two_level_menu';
		while($row = mysqli_fetch_array($res))
		{
			$res1= mysqli_query($con,"select * from product_size where status=1 and id=".$row['id']);
			$row1 = mysqli_fetch_array($res1);
			$results[$i] = $row1;	
			
			$sql1 = "select * from series where product_size_id = ".$row['id']." and status=1  order by `order` ASC";
			$res1= mysqli_query($con,$sql1);
			while($row1 = mysqli_fetch_array($res1))
			{
				$results[$i]['series'][] = $row1;
			}
			$i++;
		}
		return $results;
	}
	function getSingleMenuBySeriesId($id)
	{
		 global $con; 
		//$sql = "SELECT product_size.id,product_size.size, series.series_name FROM product JOIN product_size ON product.size_id = product_size.id JOIN series ON product.series_id = series.id where product.series_id = ".$id;
		$sql = "SELECT product_size.id,product_size.size,product_size.col_view,product_size.series_no_status, series.series_name FROM series JOIN product_size ON series.product_size_id = product_size.id where series.id = ".$id;
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res);
	}
	function getAllProductSize()
	{
		global $con; 
		$sql = "select * from product_size where status=1";
		$res= mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function getLatestProduct($limit)
	{
		global $con;  
		$results=array();
		$sql = "SELECT product.*,product_size.id as s_id,product_size.size FROM product join product_size on product.size_id = product_size.id order by product.id DESC limit ".$limit;
		$res= mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function getProductSizeById($id)
	{
		global $con; 
		$sql = "select * from product_size where id= ".$id." and status=1";
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res); 
	}
    function getRegisterNotification()
	{
		global $con; 
		$sql ="select * from register where status = 0";
		return mysqli_num_rows(mysqli_query($con,$sql));
	}
    function updateRegisterNotification()
	{
		global $con;  
		$sql = "update register set status ='1'";
		return mysqli_query($con,$sql);
	}
	//For Series
	function insertSeries($name,$p_size_id,$menu_id,$view,$status,$serieslogo,$title,$keyword,$description)
	{
		 global $con; 
		/*$msg='';
		$chkName = mysqli_query($con,"SELECT * FROM series WHERE  series_name='".$name."' and product_size_id = ".$p_size_id);
		$num_rows = mysqli_num_rows($chkName);
		
		if($num_rows !=0)
			$msg = 'exists';
		else
		{
			$sql="INSERT INTO series (series_name,product_size_id) VALUES ('".ucfirst(mysqli_real_escape_string($con,$name))."', '".$p_size_id."')";
			//$sql="INSERT INTO series (series_name,product_size_id,design_view) VALUES ('".ucfirst($name)."', '".$p_size_id."', '".$view."')";
			if (!mysqli_query($con,$sql))
				$msg = 'error';
			else
				$msg = 'success';
		}
		return $msg ;*/
		$msg='';
		$name= rtrim($name,',');
		$arr= explode(',',$name);
		for($i=0;$i<count($arr);$i++)
		{
			if($arr[$i]!='')
			{
				$chkName = mysqli_query($con,"SELECT * FROM series WHERE  series_name='".$arr[$i]."' and product_size_id = ".$p_size_id);
				$num_rows = mysqli_num_rows($chkName);
				if($num_rows !=0)
					$msg = 'exists';
				else
				{
					$slug = $this->createSlug(ucfirst(mysqli_real_escape_string($con,$arr[$i])));
					$sql="INSERT INTO series (series_name,slug,product_size_id,menu_id,status,serieslogo,title,keyword,description) VALUES ('".ucfirst(mysqli_real_escape_string($con,$arr[$i]))."','".$slug."', '".$p_size_id."','".$menu_id."', '".$status."','".$serieslogo."','".$title."','".$keyword."','".$description."')";
					
					
					if (!mysqli_query($con,$sql))
						$msg = 'error';
					else
						$msg = 'success';
				}
			}
			else
				$msg='series no';
		}
		
		return $msg ;
	}
	function updateSeries($name,$p_size_id,$series_id,$status,$serieslogo,$title,$keyword,$description)
	{
		global $con;  
		$err ='';
		/* $chkName = mysqli_query($con,"SELECT * FROM series WHERE  series_name='".$name."' and product_size_id = ".$p_size_id);
		$num_rows = mysqli_num_rows($chkName);
		if($num_rows !=0)
		{
			$err = "Serises already exists !";
			$menupath = $this->menupath($path['id']);
			$p ="select product_size.id,product_size.size,series.series_name from product_size join series on product_size.id = series.product_size_id where product_size.id= ".$p_size_id." and series.id= ".$series_id." and series.status=1";
			$path = mysqli_fetch_array(mysqli_query($con,$p));
			$old_dir = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $path['size'])."/".preg_replace('/[^A-Za-z0-9\-]/', '', $path['series_name'].'-'.$path['id']);
			$new_dir = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $path['size'])."/".preg_replace('/[^A-Za-z0-9\-]/', '', $name.'-'.$path['id']);
			rename($old_dir ,$new_dir);
			
		}
		else
		{ */

			$p ="select product_size.id,product_size.size,series.series_name from product_size join series on product_size.id = series.product_size_id where product_size.id= ".$p_size_id." and series.id= ".$series_id." and series.status=1";
			$path = mysqli_fetch_array(mysqli_query($con,$p));
			
			$slug = $this->createSlug(ucfirst(mysqli_real_escape_string($con,$name)));
		
			 $sql="UPDATE series SET series_name='".ucfirst(mysqli_real_escape_string($con,$name))."', slug='".$slug."',status='".$status."' ,serieslogo = '".$serieslogo."' , title = '".$title."',keyword = '".$keyword."',description= '".$description."' WHERE product_size_id =".$p_size_id ." and id=".$series_id; 
			
			if (!mysqli_query($con,$sql))
			{
				$err ="Get error while updating Series !";
			}
			else
			{
				$menupath = $this->menupath($path['id']);
				$old_dir = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $path['size'])."/".preg_replace('/[^A-Za-z0-9\-]/', '', $path['series_name']);
				$new_dir = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $path['size'])."/".preg_replace('/[^A-Za-z0-9\-]/', '', $name);
				if (is_dir($old_dir))
				{
					$re_res = rename($old_dir ,$new_dir);
					if($re_res == true)
					{
						$err = 0;
					}
					else
						$err = "Error Directory Rename !";
				}
				else
					@mkdir($new_dir , 0777, true);
				
				$err = "success";
			}
		/* }*/
		return $err;
	}
	function deleteSeries($series_id)
	{   
		global $con;  
		$s = "select product_size.id,product_size.size,series.series_name from product_size join series on product_size.id = series.product_size_id where series.id= ".$series_id." and series.status=1";
		$path = mysqli_fetch_array(mysqli_query($con,$s));
		
		
		$s_ = "SELECT * FROM `series` Where id = ".$series_id;
		$path_ = mysqli_fetch_array(mysqli_query($con,$s_));
		//$removeimg = "../uploads/series_logo/".$path_['serieslogo']; 
		unlink($path_['serieslogo']);
		
									
		mysqli_query($con,"DELETE FROM series_no where series_id = ".$series_id);
		mysqli_query($con,"DELETE FROM product where series_id = ".$series_id);
		$res = mysqli_query($con,"DELETE FROM series where id = ".$series_id);
		if($res>0)
		{	
			$menupath = $this->menupath($path['id']);
			$this->rrmdir("../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $path['size'])."/".preg_replace('/[^A-Za-z0-9\-]/', '', $path['series_name']));
		}
		echo '<script>success("Serises Delete successfully.")</script>';
	}
	function rrmdir($dir) 
	{
		global $con;  
		foreach(scandir($dir) as $file) {
			if ('.' === $file || '..' === $file) continue;
			if (is_dir("$dir/$file")) $this->rrmdir("$dir/$file");
			else unlink("$dir/$file");
		}
		rmdir($dir);
		return true;
		
	}
	function getSeries($id = NULL)
	{
		global $con;  
		if($id != NULL){
		$sql = "select * from series where product_size_id = ".$id." order by `order` ASC";
		}else{
		$sql = "select * from series where status=1 order by `order` ASC";
			}
		$res= mysqli_query($con,$sql);
		
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function getSeriesById($id,$status=false)
	{
		global $con; 
		if($status == true){
			$sql = "select * from series where id= ".$id." order by `order` ASC";
		}else{
			$sql = "select * from series where id= ".$id." and status=1 order by `order` ASC";
		}
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res); 
	}
	function getAllSeriesById($id)
	{
		global $con;  
		$sql = "select * from series where id= ".$id." and status=1 order by `order` ASC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function getCategoryBySizeId($id)
	{
		global $con;  
		$sql = "select * from product_size where id= ".$id." and status=1 order by `order` ASC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
		
		}
	
	//For Series No.
	function insertSeriesNo($name,$slug,$p_size_id,$series_no)
	{
		 global $con; 
		$msg='';
		$name= rtrim($name,',');
		
		if (strpos($name,'~') !== false) 
		{
			$arr= explode('~',$name);
			for($i=$arr[0];$i<=$arr[1];$i++)
			{
				if($i!='')
				{
					$chkName = mysqli_query($con,"SELECT * FROM series_no WHERE  series_no_name='".$i."' and series_id='".$series_no."'");
					$num_rows = mysqli_num_rows($chkName);
					if($num_rows !=0){
						$msg = 'exists';
					}
					else
					{
						$sql="INSERT INTO series_no (series_no_name,slug,size_id,series_id) VALUES ('".ucfirst(mysqli_real_escape_string($con,$i))."',".$slug."',".$p_size_id."', '".$series_no."')";
						if (!mysqli_query($con,$sql))
							$msg = 'error';
						else
							$msg = 'success';
					}
				}
				else
					$msg='series no';
			}
		}
		else
		{

			$arr= explode(',',$name);
			for($i=0;$i<count($arr);$i++)
			{
				if($arr[$i]!='')
				{
					$chkName = mysqli_query($con,"SELECT * FROM series_no WHERE  series_no_name='".$arr[$i]."' and series_id='".$series_no."'");
					$num_rows = mysqli_num_rows($chkName);
					if($num_rows !=0)
						$msg = 'exists';
					else
					{
						$sql="INSERT INTO series_no (series_no_name,slug,size_id,series_id) VALUES ('".ucfirst(mysqli_real_escape_string($con,$arr[$i]))."', '".$slug."','".$p_size_id."', '".$series_no."')";
						if (!mysqli_query($con,$sql))
							$msg = 'error';
						else
							$msg = 'success';
					}
				}
				else
					$msg='series no';
			}
		}
		return $msg ;
	}
	
	function updateSeriesNo($series_id,$slug,$series_no_name,$id,$new_size_id)
	{
		 global $con; 
		$err = '';
		$chkName = mysqli_query($con,"SELECT * FROM series_no WHERE  id='".$id."'");
		$num_rows = mysqli_num_rows($chkName);
		if($num_rows !=0){
			 $slug = $this->createSlug($series_no_name);
			 
			 $err = $this->UpdateSeriesNoEntry($id,$series_no_name,$slug,$series_id,$new_size_id);
			// $err = 'success';
		}
			//$err = "Serises Number already exists !";
		//else
	//	{
		//	$sql="UPDATE series_no SET series_id='".$series_id."',series_no_name='".ucfirst(mysqli_real_escape_string($con,$series_no_name))."' WHERE id=".$id;
		//	if (!mysqli_query($con,$sql))
			//	$err ="Get error while updating Series Number Name !";
		//	else
		//	{
		//		$err = 'success';
		//	}
		//}
		return $err;
	}
	
	function UpdateSeriesNoEntry($id,$series_no_name,$slug,$new_series_id,$new_size_id){
		
		 global $con; 
		$sql = "SELECT * FROM `series_no` WHERE id = '".$id."'";
		$oldsndata = $this->getLastRecords($sql);
		$sizesql = "SELECT size FROM `product_size` WHERE id = '".$oldsndata['size_id']."'";
		$sizedata = $this->getLastRecords($sizesql);
		$seriessql = "SELECT * FROM `series` WHERE id = '".$oldsndata['series_id']."'";
		$seriesdata = $this->getLastRecords($seriessql);
		
		$nsizesql = "SELECT size FROM `product_size` WHERE id = '".$new_size_id."'";
		$nsizedata = $this->getLastRecords($nsizesql);
		$nseriessql = "SELECT * FROM `series` WHERE id = '".$new_series_id."'";
		$nseriesdata = $this->getLastRecords($nseriessql);
		
		
		if(is_array($oldsndata) && count($oldsndata) > 0 && $oldsndata != ''){
				
				$omenupath = $this->menupath($seriesdata['product_size_id']);
				$nmenupath = $this->menupath($nseriesdata['product_size_id']);
				
				$oldpath = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $omenupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $sizedata['size'])."/".preg_replace('/[^A-Za-z0-9\-]/', '', $seriesdata['series_name']);
				$newpath = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $nmenupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $nsizedata['size'])."/".preg_replace('/[^A-Za-z0-9\-]/', '', $nseriesdata['series_name']);
				
				if(!file_exists($newpath)){
						mkdir($newpath);
					}
				if(!file_exists($newpath.'/thumbnails')){
						mkdir($newpath.'/thumbnails');
					}
				
				$productsql = "SELECT * FROM `product` WHERE series_no = '".$id."'";
				$productdata = $this->getRecords($productsql);
				
				//return $oldpath."<br>".$newpath;
				
				foreach($productdata as $product){
				
					if(file_exists($oldpath.'/'.$product['image'])){
						$p = $this->movefile($oldpath.'/'.$product['image'],$newpath.'/'.$product['image']);
					}
					if(file_exists($oldpath.'/thumbnails/'.$product['image'])){
						$pt = $this->movefile($oldpath.'/thumbnails/'.$product['image'],$newpath.'/thumbnails/'.$product['image']);
					}
					if($product['view'] != '' && file_exists($oldpath.'/'.$product['view'])){
						$v = $this->movefile($oldpath.'/'.$product['view'],$newpath.'/'.$product['view']);
						}
			
					$updateproductsql = "UPDATE product SET size_id = '".$new_size_id."',series_id = '".$new_series_id."' WHERE id = '".$product['id']."';";
					$this->insert_record($updateproductsql);
						
				}
						//return $oldsndata['series_no_name']."-".$series_no_name;
					    $sql = "UPDATE `series_no` SET `series_id` = '".$new_series_id."',`size_id` = '".$new_size_id."',series_no_name = '".$series_no_name."' ,slug = '".$slug."'  WHERE `id` = '".$id."';";
					
						$this->insert_record($sql);
						//$sql2 = "UPDATE `series` SET `product_size_id` = '".$new_size_id."' WHERE `id` = '".$seriesdata['id']."';";
						//$this->insert_record($sql2);
						//return $oldpath.'<br>'.$newpath;
						return 'success';
			}
	
	}
	
	function movefile($oldfilepath,$newfilepath){
		global $con;  
		if(copy($oldfilepath, $newfilepath)) {
            $delete[] = $oldfilepath;
        }
		if(isset($delete) && count($delete) > 0){
		foreach ($delete as $file ) {
       		 unlink( $file );
		}
		}
		}
	
	function getSeriesNoById($id)
	{
		global $con;  
		$sql = "select * from series_no where id = ".$id;
		$res= mysqli_query($con,$sql);
		return $row = mysqli_fetch_array($res); 
	}
	function getSeriesNoBySizeId($id)
	{
		 global $con; 
		//$sql = "select * from series_no where size_id = ".$id." and status=1";
		$sql = "select series_no.*,series.id as series_id,series.series_name as series_name from series_no join series on series_no.size_id = series.product_size_id where series_no.series_id = series.id and series_no.size_id = ".$id." and series_no.status= 1 order by series_no.order ASC";
		
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function getSeriesNoBySeriesId($id)
	{
		 global $con; 
		//$sql = "select * from series_no where series_id = ".$id." and status=1";
		 $sql = "select series_no.*,series.id as series_id,series.series_name as series_name from series_no join series on series_no.size_id = series.product_size_id where series_no.series_id = series.id and series_no.series_id = ".$id." and series_no.status= 1 order by series_no.series_no_name  ASC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	
	function deleteSeriesNo($id,$path)
	{
		global $con;  
		$r = mysqli_query($con,'select * from product where series_no = '.$id);
		while($row = mysqli_fetch_array($r))
		{
			if($row['image'] !='')
			{
				echo unlink($path.'/'.$row['image']);
				echo unlink($path.'/thumbnails/'.$row['image']);
				mysqli_query($con,"DELETE FROM product WHERE series_no = '".$id."'");
			}	
		}
		$sql = "DELETE FROM series_no WHERE id = '".$id."'";
		return $res = mysqli_query($con,$sql);
	}
	// For deleteFlag
	function deleteFlag($id)
	{
		global $con;  
		$sql = "DELETE FROM export_flag WHERE id = '".$id."'";
		return $res = mysqli_query($con,$sql);
	}
	
	// For Product
	function deleteProduct($id)
	{
		global $con;  
		$sql = "DELETE FROM product WHERE id = '".$id."'";
		return $res = mysqli_query($con,$sql);
	}
	// For Export Flag
	function deleteExportFlag($id)
	{
		global $con;  
		$sql = "DELETE FROM export_flag WHERE id = '".$id."'";
		return $res = mysqli_query($con,$sql);
	}
	function strbefore($string, $substring) 
	{
		global $con;  
	  $pos = strpos($string, $substring);
	  if ($pos === false)
	   return $string;
	  else 
	   return(substr($string, 0, $pos));
	}
	//For Product with series no
	function checkProductsExists($title,$series_id)
	{
		 global $con; 
		$chkName = mysqli_query($con,"SELECT * FROM product WHERE  title='".$title."' and series_id='".$series_id."'");
		return $num_rows = mysqli_num_rows($chkName);
		
	}
	function insertProduct($series_no,$title,$slug,$image,$size_id,$series_id,$sslug,$menu_id)
	{
		global $con;  
		$num_rows = $this->checkProductExists($title, $series_id,$series_no);
		if($num_rows !=0)
			echo '<script>danger("'.$title.' Product already exists !")</script>';
		else
		{
			$sql="INSERT INTO product (series_no,title,slug,image,size_id,series_id,series_slug,menu_id) VALUES ('".$series_no."', '".ucfirst($title)."','".$slug."', '".$image."', '".$size_id."', '".$series_id."','".$sslug."', '".$menu_id."')"; 
			if (!mysqli_query($con,$sql))
				echo '<script>danger("Get error while updating login details !")</script>';
			else
				echo '<script>success("'.ucfirst($title).'" Product Insert successfully.")</script>';
		}
		
	}
	function updateProductSeriesNo($post,$file)
	{
		global $con;  
		$err='';
		@extract($post);
		$path = $this->getImageByProductId($id);
		$slug = $this->createSlug($title);
		$sql="UPDATE product SET series_no='".$series_no."',title = '".$title."',slug = '".$slug."',visible = '".$visible."'" ;
		
		if(isset($file['image']) && $file['image'] !='' && $file['image']['error'] ==0){
			$name = uniqid("file_").'.jpg';
			if($file['image']['size'] < 3145728)   // 3MB = 1024*1024*3
			{   
				$img_thumb = $this->img_resize($file['image']['tmp_name'], product_th_width, '../uploads/'.$path.'/thumbnails/', $name, product_th_height);
				$image = $this->img_resize($file['image']['tmp_name'], product_big_width, '../uploads/'.$path.'/', $name, product_big_height);
				if($image>0 && $img_thumb >0){
					$sql .=",image = '".$name."'";
					
					if(isset($img_old)&& $img_old != ''){
						unlink('../uploads/'.$path.'/'.$img_old);
						unlink('../uploads/'.$path.'/thumbnails/'.$img_old);
					}
				}
			}
			else
				$err = 'File too large. File must be less than 3MB.';
		}
		
		if(isset($file['view']) && $file['view'] !='' && $file['view']['error'] ==0){
			$name = uniqid("file_").'.jpg';
			if($file['view']['size'] < 3145728)   // 3MB = 1024*1024*3
			{
				$view_thumb = $this->img_resize($file['view']['tmp_name'], product_th_width, '../uploads/'.$path.'/thumbnails/', $name, product_th_height);
				$view = $this->img_resize($file['view']['tmp_name'], product_big_width, '../uploads/'.$path.'/', $name, product_big_height);
				if($view>0 && $view_thumb >0){
					$sql .=",view = '".$name."'";
					
					if(isset($view_old)&& $view_old != ''){
						unlink('../uploads/'.$path.'/'.$view_old);
						unlink('../uploads/'.$path.'/thumbnails/'.$view_old);
					}
				}
			}
			else
				$err = 'File too large. File must be less than 3MB.';
		}
		$sql .= " WHERE id=".$id;
		if($err ==''){
			if (!mysqli_query($con,$sql))
				$err = 'Get error while updating login details !';
			else
				$err = 'success';
		}
		
		return $err;
	}
	//For Product with series
	function checkProductExists($title,$series_id,$series_no)
	{
		 global $con; 
		$chkName = mysqli_query($con,"SELECT * FROM product WHERE  title='".$title."' and series_id='".$series_id."' and series_no='".$series_no."'");
	  	return $num_rows = mysqli_num_rows($chkName);
	}
	function insertProducts($title,$slug,$image,$size_id,$series_id,$sslug,$menu_id)
	{
		 global $con; 
		$num_rows = $this->checkProductsExists($title, $series_id);
		if($num_rows !=0)
			echo '<script>danger("Product already exists !")</script>';
		else
		{
			 $sql="INSERT INTO product (title,slug,image,size_id,series_id,series_slug,menu_id) VALUES ('".ucfirst($title)."', '".$slug."','".$image."', '".$size_id."','".$series_id."','".$sslug."','".$menu_id."')"; 
			if (!mysqli_query($con,$sql))
				echo '<script>danger("Get error while updating login details !")</script>';
			else
				echo '<script>success("'.ucfirst($title).'" Product Insert successfully.")</script>';
		}
		
	}
	function updateProductSeries($post,$file)
	{
		  global $con;
		$err='';
		@extract($post);
		$path = $this->getImageByProductId($id);
		$slug = $this->createSlug($title);
		
		$sql="UPDATE product SET  title = '".$title."',slug= '".$slug."', visible = '".$visible."'" ; 
		if(isset($file['image']) && $file['image'] !='' && $file['image']['error'] ==0){
			$name = uniqid("file_").'.jpg';
			if($file['image']['size'] < 3145728)   // 3MB = 1024*1024*3
			{
				$img_thumb = $this->img_resize($file['image']['tmp_name'], product_th_width, '../uploads/'.$path.'/thumbnails/', $name, product_th_height);
				$image = $this->img_resize($file['image']['tmp_name'], product_big_width, '../uploads/'.$path.'/', $name, product_big_height);
				if($image>0 && $img_thumb >0){
					$sql .=",image = '".$name."'";
					
					if(isset($img_old)&& $img_old != ''){
						unlink('../uploads/'.$path.'/'.$img_old);
						unlink('../uploads/'.$path.'/thumbnails/'.$img_old);
					}
				}
			}
			else
				$err = 'File too large. File must be less than 3MB.';	
		}
		if(isset($file['view']) && $file['view'] !='' && $file['view']['error'] ==0){
			  
			$name = uniqid("file_").'.jpg';
			if($file['view']['size'] < 3145728)   // 3MB = 1024*1024*3
			{
				$view_thumb = $this->img_resize($file['view']['tmp_name'], product_th_width, '../uploads/'.$path.'/thumbnails/', $name, product_th_height);
				$view = $this->img_resize($file['view']['tmp_name'], product_big_width, '../uploads/'.$path.'/', $name, product_big_height);
				if($view>0 && $view_thumb >0){
					$sql .=",view = '".$name."'";
					
					if(isset($view_old)&& $view_old != ''){
						unlink('../uploads/'.$path.'/'.$view_old);
						unlink('../uploads/'.$path.'/thumbnails/'.$view_old);
					}
				}
			}
			else
				$err = 'File too large. File must be less than 3MB.';		
		}
		$sql .= " WHERE id=".$id;
		
		if($err ==''){
			if (!mysqli_query($con,$sql))
				$err = 'Get error while updating login details !';
			else
				$err = 'success';
		}
		
		return $err;
	}
	//For Design only
	function insertDesign($title,$slug,$image,$size_id,$sizeslug,$menu_id)
	{
		global $con;  
		$chkName = mysqli_query($con,"SELECT * FROM product WHERE  title='".$title."' and size_id='".$size_id."'");
		$num_rows = mysqli_num_rows($chkName);
		if($num_rows !=0)
			echo '<script>danger("'.ucfirst($title).'" Product Image already exists !")</script>';
		else
		{
			$sql="INSERT INTO product (title,slug,image,size_id,size_slug,menu_id) VALUES ('".ucfirst($title)."', '".$slug."','".$image."', '".$size_id."','".$sizeslug."','".$menu_id."')";
			
			if (!mysqli_query($con,$sql))
				echo '<script>danger("Get error while updating product details !")</script>';
			else
				echo '<script>success("'.ucfirst($title).'" Product Image Insert successfully.")</script>';
		}
	}
	
	//For Export only
	function insertExportFlag($title,$image)
	{
		global $con;  
		$chkName = mysqli_query($con,"SELECT * FROM export_flag WHERE  flagName='".$title."'");
		$num_rows = mysqli_num_rows($chkName);
		if($num_rows !=0)
			echo '<script>danger("'.ucfirst($title).'" Product Image already exists !")</script>';
		else
		{
			$sql="INSERT INTO export_flag (flagName,flagImage) VALUES ('".ucfirst($title)."', '".$image."')";
			if (!mysqli_query($con,$sql))
				echo '<script>danger("Get error while updating export_flag details !")</script>';
			else
				echo '<script>success("'.ucfirst($title).'" Export Image Insert successfully.")</script>';
		}
	}
	
	function updateProductDesign($post,$file)
	{
		 global $con; 
		$err='';
		
		@extract($post);
		$path = $this->getImageByProductId($id);
		$slug = $this->createSlug($title);
		$sql="UPDATE product SET title = '".$title."',slug = '".$slug."',visible = '".$visible."'" ;
		if(isset($file['image']) && $file['image'] !='' && $file['image']['error'] ==0){
			$name = uniqid("file_").'.jpg';
			if($file['image']['size'] < 3145728)   // 3MB = 1024*1024*3
			{
				$img_thumb = $this->img_resize($file['image']['tmp_name'], product_th_width, '../uploads/'.$path.'/thumbnails/', $name, product_th_height);
				$image = $this->img_resize($file['image']['tmp_name'], product_big_width, '../uploads/'.$path.'/', $name, product_big_height);
				if($image>0 && $img_thumb >0){
					$sql .=",image = '".$name."'";
					
					if(isset($img_old)&& $img_old != ''){
						unlink('../uploads/'.$path.'/'.$img_old);
						unlink('../uploads/'.$path.'/thumbnails/'.$img_old);
					}
				}
			}
			else
				$err = 'File too large. File must be less than 3MB.';		
		}
		
		if(isset($file['view']) && $file['view'] !='' && $file['view']['error'] ==0){
			  
			$name = uniqid("file_").'.jpg';
			if($file['view']['size'] < 3145728)   // 3MB = 1024*1024*3
			{
				$view_thumb = $this->img_resize($file['view']['tmp_name'], product_th_width, '../uploads/'.$path.'/thumbnails/', $name, product_th_height);
				$view = $this->img_resize($file['view']['tmp_name'], product_big_width, '../uploads/'.$path.'/', $name, product_big_height);
				if($view>0 && $view_thumb >0){
					$sql .=",view = '".$name."'";
					
					if(isset($view_old)&& $view_old != ''){
						unlink('../uploads/'.$path.'/'.$view_old);
						unlink('../uploads/'.$path.'/thumbnails/'.$view_old);
					}
				}
			}
			else
				$err = 'File too large. File must be less than 3MB.';		
		}
		
		$sql .= " WHERE id=".$id;
		
		if($err ==''){
			if (!mysqli_query($con,$sql))
				$err = 'Get error while updating login details !';
			else
				$err = 'success';
		}
		
		return $err;
	}

	//for export flag update
	function updateExportFlag($post,$file)
	{
		global $con; 
		$err='';
		
		@extract($post);
		
		$sql="UPDATE export_flag SET flagName = '".$flagName."',visibility = '".$visibility."'" ;
		
		if(isset($file['flagImageNew']) && $file['flagImageNew'] !='' ){
			
			$name = uniqid("file_").'.jpg';
			
			if($file['flagImageNew']['size'] < 3145728)   // 3MB = 1024*1024*3
			{	
				
				$img_thumb = $this->img_resize($file['flagImageNew']['tmp_name'], product_th_width, '../uploads/export/thumbnails/', $name, product_th_height);
				$image = $this->img_resize($file['flagImageNew']['tmp_name'], product_big_width, '../uploads/export/', $name, product_big_height);
				if($image>0 && $img_thumb >0){

					$sql .=",flagImage = '".$name."'";
					
					if(isset($img_old)&& $img_old != ''){
						unlink('../uploads/export/'.$img_old);
						unlink('../uploads/export/thumbnails/'.$img_old);
					}
				}
			}
			else
				$err = 'File too large. File must be less than 3MB.';		
		}
		
		
		$sql .= " WHERE id=".$id;
		
		if($err ==''){
			if (!mysqli_query($con,$sql))
				$err = 'Get error while updating login details !';
			else
				$err = 'success';
		}
		
		return $err;
	}
	
	function getProductById($id)
	{
		global $con;
		$sql = "SELECT * FROM product WHERE  id=".$id;
		$query=mysqli_query($con,$sql);
		$res = mysqli_fetch_array($query);
		return $res;
	}
	function getExportFlagById($id)
	{
		global $con;
		$sql = "SELECT * FROM export_flag WHERE  id=".$id;
		$query=mysqli_query($con,$sql);
		$res = mysqli_fetch_array($query);
		return $res;
	}
	function getProductBySizeId($id)
	{
		global $con;  
		$sql ="SELECT product.id,product.title,product.application_id,product.inspiration_id,product.color_id,product.image,product.view as view,product.details as details,product.size_id,product.visible as visible,product_size.size FROM  product join product_size on product.size_id = product_size.id where product.size_id = ".$id." and product.status=1 order by product.order ASC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res)){
			$results[] = $row;
		} 
		return $results;
	}
	function getExportImage()
	{
		global $con;  

		$sql ="select * from export_flag ORDER BY `order` ASC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res)){
			$results[] = $row;
		} 
		return $results;
	}
	function getProductsBySeriesId($id)
	{
		global $con;  
		$sql ="SELECT product.id as id,product.title as title,product.image as image,product.application_id as application_id,product.inspiration_id as inspiration_id,product.color_id as color_id,product.view as view,product.details as details,product.visible as visible,product.size_id as size_id,product.series_id as series_id,series.id as s_id,series.series_name as s_name FROM product join series on product.series_id = series.id WHERE product.status = 1 and product.series_id = ".$id ." order by product.order ASC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res)){
			$results[] = $row;
		} 
		return $results;
	}
	function getProductBySeriesId($id)
	{
		global $con; 
		$sql ="SELECT product.id as id,product.title as title,product.image as image,product.application_id as application_id,product.inspiration_id as inspiration_id,product.color_id as color_id,product.view as view,product.details as details,product.visible as visible,series_no.id as s_n_id,series_no.series_no_name as s_n_name,series.id as s_id,series.series_name as s_name ,product.menu_id as m_menu_id,menu.name as m_name FROM product join menu on product.menu_id= menu.id  join series_no on product.series_no = series_no.id join series on product.series_id = series.id WHERE product.status = 1 and product.series_id = ".$id ." order by product.order ASC"; 
		$res= mysqli_query($con,$sql); 
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function getProductBySeriesNoId($id)
	{
		 global $con;
		
		$sql ="SELECT product.id as id,product.title as title,product.application_id as application_id,product.inspiration_id as inspiration_id , product.color_id as color_id , product.image as image,product.view as view,product.details as details,product.visible as visible,series_no.id as s_n_id,series_no.series_no_name as s_n_name,series.id as s_id,series.series_name as s_name,product.menu_id as m_menu_id,menu.name as m_name  FROM product join menu on product.menu_id = menu.id join series_no on product.series_no = series_no.id join series on product.series_id = series.id WHERE product.status = 1 and product.series_no = ".$id ." order by product.order ASC";
		$res= mysqli_query($con,$sql);
		//echo $sql; 
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function getImageBySeriesId($id)
	{
		global $con; 
		$sql ="SELECT product_size.id,product_size.size, series.series_name FROM series JOIN product_size ON series.product_size_id = product_size.id WHERE series.id = ".$id;
		$res= mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$row = mysqli_fetch_array($res);
			$menupath = $this->menupath($row['id']);
			$path = preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $row['size']).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $row['series_name']);
		}
		return $path;
	}
	function menupath($series_table_size_id){
		  
		//for getting menu path for admin upload section updates.
		$sql = "SELECT name FROM menu Where id = (SELECT menu_id FROM `product_size` WHERE id = '".$series_table_size_id."')";
		$data = $this->getLastRecords($sql);
		return $data['name'];
		}

	function getImageByProductId($id)
	{
		  global $con;
		$sql ="SELECT product_size.id,product_size.size, series.series_name FROM product JOIN product_size ON product.size_id = product_size.id JOIN series ON product.series_id = series.id WHERE product.id = ".$id;
		$res= mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$row = mysqli_fetch_array($res);
			$menupath = $this->menupath($row['id']);
			$path = preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $row['size']).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $row['series_name']);
		}
		else
		{
			$sql = "SELECT product.id,product_size.id as s_id,product_size.size FROM product join product_size on product.size_id = product_size.id WHERE product.id = ".$id;
			$res= mysqli_query($con,$sql);
			$row = mysqli_fetch_array($res);
			$menupath = $this->menupath($row['s_id']);
			$path =  preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $row['size']);
		}
		return $path;
	}

	
	
	// For Catalogue
	function insertCatalogue($name,$menu,$size,$image='',$pdf,$status)
	{
		 global $con; 
		$sql="INSERT INTO `catalogue` ( `name`,`menu`,`size`,`image`,`pdf`,status) values ('".$name."','".$menu."','".$size."', '".$image."', '".$pdf."','".$status."');";  
		 return mysqli_query($con,$sql);
		 header('location:catalogue.php');
	}
	function getCatalogue()
	{
		global $con;
		$sql ="select * from catalogue order by `order` ASC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function deleteCatalogue($id)
	{
		global $con;
		$sql = "select * from catalogue WHERE id = '".$id."'";
		$res= mysqli_query($con,$sql);
		$row = mysqli_fetch_array($res);
		
		$sql1 = "DELETE FROM catalogue WHERE id = '".$id."'";
		$res1 = mysqli_query($con,$sql1);
		if($res1>0)
		{
			unlink('../uploads/catalogue/'.$row['image']); 
			unlink('../uploads/catalogue/'.$row['pdf']); 
		}
	}
	
	// For Certificate
	function insertCertificate($name,$image='',$pdf,$status)
	{
		 global $con; 
		 $sql="INSERT INTO `certificate` ( `name`,`image`,`pdf`,status) values ('".$name."', '".$image."', '".$pdf."','".$status."');";
		 return mysqli_query($con,$sql);
		 header('location:certificate.php');
	}
	function getCertificate()
	{
		global $con;
		$sql ="select * from certificate order by `order` ASC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}

	function deleteCertificate($id)
	{
		global $con;
		$sql = "select * from certificate WHERE id = '".$id."'";
		$res= mysqli_query($con,$sql);
		$row = mysqli_fetch_array($res);
		
		$sql1 = "DELETE FROM certificate WHERE id = '".$id."'";
		$res1 = mysqli_query($con,$sql1);
		if($res1>0)
		{
			//unlink('../uploads/certificate/'.$row['image']); 
			unlink('../uploads/certificate/'.$row['pdf']); 
		}
	}
	
		// For Header Image
	function insertHeaderImage($id,$img,$table_name)
	{
		global $con;
		$sql="UPDATE `".$table_name."` SET `header_image` = '".$img."' WHERE `id` = '".$id."';";
		return mysqli_query($con,$sql);
		
	}
function getHeaderImage($id = NULL)
	{
		global $con;  
		if($id != NULL){
		$sql ="select * from product_size where id = '".$id."'";
		}else{
		$sql ="select * from product_size";	
			}
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	//for main admin panel header image in product size
	function getHeaderImageMainAdmin($id = NULL)
	{
		global $con;  
		if($id != NULL){
		$sql ="select * from product_size where id = '".$id."'";
		}else{
		$sql ="select * from product_size";	
			}
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	//for main admin panel header image in product size
	function deleteHeaderImage($id)
	{
		global $con;  
		$sql = "select * from product_other_admin_panel WHERE id = '".$id."'";
		$res= mysqli_query($con,$sql);
		$row = mysqli_fetch_array($res);

			if(isset($row['header_image']) && $row['header_image'] !='')
			{
					unlink('../uploads/headerimage/'.$row['header_image']);
					mysqli_query($con,"UPDATE product_other_admin_panel SET `header_image` = '' WHERE `id` ='".$id."';");
				
			}	
	}
	function deleteHeaderImageMainAdmin($id)
	{
		global $con;  
		$sql = "select * from product_size WHERE id = '".$id."'";
		$res= mysqli_query($con,$sql);
		$row = mysqli_fetch_array($res);

			if(isset($row['header_image']) && $row['header_image'] !='')
			{
					unlink('../uploads/headerimage/'.$row['header_image']);
					mysqli_query($con,"UPDATE product_size SET `header_image` = '' WHERE `id` ='".$id."';");
				
			}	
	}
	function deleteSeriesHeaderImage($id){
		 global $con; 
		$sql = "select * from series WHERE id = '".$id."'";
		$res= mysqli_query($con,$sql);
		$row = mysqli_fetch_array($res);

			if(isset($row['header_image']) && $row['header_image'] !='')
			{
					unlink('../uploads/headerimage/'.$row['header_image']);
					mysqli_query($con,"UPDATE `series` SET `header_image` = '' WHERE `id` ='".$id."';");
				
			}	
		}
	
	//For Gallery
	function insertCategory($name,$a='')
	{
		global $con;  
		$msg='';
		$name= rtrim($name,',');
		$arr= explode(',',$name);
		for($i=0;$i<count($arr);$i++)
		{
			if($arr[$i]!='')
			{
				$chkName = mysqli_query($con,"SELECT * FROM category WHERE  name='".$arr[$i]."'");
				$num_rows = mysqli_num_rows($chkName);
				if($num_rows !=0)
					$msg = 'exists';
				else
				{
					if($a != ''){
						$sql="INSERT INTO category (name,icon) VALUES ('".ucfirst(mysqli_real_escape_string($con,$arr[$i]))."' , '".$a."')";
					}else
					{
						$sql="INSERT INTO category (name) VALUES ('".ucfirst(mysqli_real_escape_string($con,$arr[$i]))."')";
					}
				
					if (!mysqli_query($con,$sql))
						$msg = 'error';
					else
						$msg = 'success';
				}
			}
			else
				$msg='series no';
		}
		return $msg ;
	}
	function getCategory()
	{
		global $con;  
		$sql = "select * from category where status=1 order by id ASC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	

	
	function deleteCategory($id,$icon = false)
	{
		global $con;  
			$osql = "SELECT * FROM category WHERE id='".$id."'";
			$oldata = $this->getLastRecords($osql);
			
		
		
			if($icon == true)
			{
				unlink($oldata['icon']);
			}
		mysqli_query($con,"DELETE FROM category where id = '".$id."'");
		
		$sql = "select * from catagory_image WHERE type = '".$id."'";
		
		$res= mysqli_query($con,$sql);
	
		while($row = mysqli_fetch_array($res))
		{
			$sql1 = "DELETE FROM catagory_image WHERE type = ".$id;
			$res1 = mysqli_query($con,$sql1);
			if($res1>0)
			{
				$thumb = '../uploads/'.$oldata['id'].'/thumbnails/'.$row['thumb'];
				$image = '../uploads/'.$oldata['id'].'/'.$row['image'];
				
				if(isset($thumb) && $thumb !='')
				{
					unlink($thumb);
				}
				if(isset($image) && $row['image'] !='')
				{
					unlink($image);
		    	}
//				unlink('../uploads/'.$oldata['id']);	
			} 
		}
		
		echo '<script>success("Category Delete successfully.")</script>';
	}
		
	function insertGallery($type,$image,$thumb,$gtype)
	{
		global $con;
		$sql="INSERT INTO `gallery` (`type`,`image`,`thumb`,`gtype`) VALUES ('".$type."','".$image."','".$thumb."','".$gtype."');";
		return mysqli_query($con,$sql);
	}
	function getGallery($type)
	{
		global $con;  
		$sql ="select * from gallery where type='".$type."' ORDER BY `order` ASC";
		
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function getappGallery($type)
	{
		global $con;  
	   $sql ="select * from gallery where gtype='".$type."' ORDER BY `order` ASC";
		
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	
	function deleteGallery($id)
	{
		global $con; 
		$sql = "select * from gallery WHERE id = '".$id."'";
		$res= mysqli_query($con,$sql);
		$row = mysqli_fetch_array($res);
		
		$sql1 = "DELETE FROM gallery WHERE id = '".$id."'";
		$res1 = mysqli_query($con,$sql1);
		if($res1>0)
		{
			if(isset($row['image']) && $row['image'] !='')
				unlink('../'.$row['image']);
			if(isset($row['thumb']) && $row['thumb'] !='')
				unlink('../'.$row['thumb']);
		}
	}
	
	
	
	//For News
	function deleteNews($id)
	{
		 global $con; 
		$news = $this->	select_one_record("select * from news where id = ".$id);
		
		$sql = "delete from news where id = ".$news['id'];
		$res = $this->update_record($sql);
		if($res>0)
		{
			unlink('../uploads/news/'.$news['image']);
		}
	}
	//For Register
	function insertRegister($post)
	{
		global $con;  
		@extract($post);
		
		$sql="INSERT INTO register (name,email, phone) VALUES ('".$name."', '".$email."', '".$phone."');";
		return mysqli_query($con,$sql);
		
	}
	
	function insertRating($post)
	{
		global $con; 
		@extract($post);
		
		$sql="INSERT INTO rating (name,rating,message,time) VALUES ('".$name."', '".$rating."', '".$message."',now());";
		return mysqli_query($con,$sql);
		
	}


	function getActiveRegister()
	{
		global $con; 
		$sql = "select * from register where status=1 order by id DESC";
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	function userLogin($username,$password)
	{
		global $con; 
		$msg='';
		
		//$sql = "select * from register where username='".$username."' and password='".$password."' and `deactivate_time`>=now() and status=1";
		$sql = "select * from register where username='".$username."' and password='".$password."' and status=1";
		$res= mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$msg = mysqli_fetch_array($res);
		}
		else
		{
			$msg = 'not found';
		}
		
		return $msg;
	}
	function getRemaingTime($deactivate_time)
	{
		global $con;  
		date_default_timezone_set("Asia/Kolkata"); 
												
		$time_remain = (strtotime($deactivate_time) - strtotime("now"));
												
		if($time_remain >0)
			$remain_t = floor($time_remain / (60 * 60 )) .' hour'; // convert to days
		else
			$remain_t = 'deactive key';
		return $remain_t;
	}
	function checkEmailExiest($email)
	{
		global $con;  
		$sql = "select * from register WHERE email = '".$email."'";
		$res= mysqli_query($con,$sql);
		return mysqli_num_rows($res);
	}
	function activeRegisterMember($link)
	{
		global $con;  
		$arr = explode("_",$link);
		$sql = "UPDATE `register` SET `status` = 1 WHERE md5( email ) = '".$arr[0]."' and md5( password ) = '".$arr[1]."'";
		return mysqli_query($con,$sql);
	}
	function emailSendForActivation($email, $password, $admin_email)
	{
		global $con;  
		$link = web_link .'login.html?link='. md5($email).'_'.md5($password);
							
		$to = $email;
		$subject = 'Contact from '.company;
		$msg="This Mail is coming from ".web_link." For Registration Activation \n Please Click on Link ".$link." \n Thank's For Registration";
		$from = $admin_email;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From:" . $from;
		
	//	return	$res = mail($to,$subject,$msg,$headers);
	
		return	$res = $this->mail_smtp($to,$subject,$msg,$headers);
	}
	function memberLogin($email, $pass)
	{
		global $con;  
		$msg='';
		$sql = "select * from register where email='".$email."' and password = '".$pass."'";
		$res = $this->select_one_record($sql);
		if($res>0)
		{
			if($res['status'] == 0)
			{
				$msg = 'not activate';
				$this->emailSendForActivation($res['email'], $res['password'], $res['email']);
			}
			else
				$msg = $res;
		}
		else
			$msg = 'not found';
		
		return $msg;	
	}

	function insertBlogInquiry_jp($post,$email_to)
	{
		$msg ='';
		@extract($post);
		$details = urldecode($details);
		/*if(sms_statue == 1)
		{
			$sms = $this->sendSMS(sms_mobileno,$_POST);
			if(isset($sms) && $sms != '')
				$sms_details = $sms;
			else
				$sms_details = 'error';
		}
		else
			$sms_details = 'sms inactive'; */
		
		$to = $email_to;
		$subject = 'Contact from '.company;
		$msg= "This Contact mail is coming from ".web_link." \n Name:" . $name. "\nEmail:" . $email. "\nPhone:" . $phone . "\nMessage:" .$message ;
		$from = $email;
		$headers = "From:" . $from;
		
		$company = web_link;
		
		
		$ip = $this->getUserIpAddr();
		$sql="INSERT INTO `blog_inquiry`( `name`, `email`, `company`,`message`, `sms_status`, `ip`) values ( '".$name."', '".$email."','".$company1."', '".nl2br($message)."', '".$sms_details."','".$ip."')";
		global $con;
		$res = mysqli_query($con,$sql);
		
		if($res>0)
		{
			$msg = $this->blogmail_smtp($to,$subject,$headers,$mailcontent,$company);
			/*if(sms_statue == 1)
			{
				$r_arr['company'] = company;
				$r_arr['number'] = sms_reply_mo_no;
				$sms = $this->sendReplay($phone,$r_arr);
				if(isset($sms) && $sms != '')
					$sms_details = $sms;
				else
					$sms_details = 'error';
			}
			else
				$sms_details = 'sms inactive'; */
				
		}
		else
		{
		  $msg = 'error';
		}
		return $msg;
	
	}
	

	
	function insertDContact_jp($post,$email_to)
	{
		global $con; 
		$msg ='';
		@extract($post);
		if(sms_statue == 1)
		{
			$sms = $this->sendDSMS(sms_mobileno,$_POST);
			if(isset($sms) && $sms != '')
				$sms_details = $sms;
			else
				$sms_details = 'error';
		}
		else
			$sms_details = 'sms inactive';

		$ip = $_SERVER['REMOTE_ADDR'];
		$to = $email_to;
		$subject = 'Contact from '.company;
		$company = web_link;
		$msg= "This Contact mail is coming from ".web_link." \nContact:" . $contatto."\n Name:" . $name. "\nEmail:" . $email. "\nPhone:" . $phone . "\nCountry:" .$country. "\nMessage:" .$message  ;
		
		$from = $email;
		$headers = "From:" . $from;
		$sql="INSERT INTO `form` (`type`, `name`, `surname`, `email`, `phone`,  `message`,  `city`, `country`, `contactto`,`sms_status`, `ip`) values ('".$type."', '".$name."', '".$surname."','".$email."', '".$phone."' , '".nl2br($message)."','".$city."','".$country."', '".$contatto."', '".$sms_details."' ,'".$ip."');";

		

		
	    $res = mysqli_query($con,$sql);
	
		if($res>0)
		{
			$msg = $this->downloadmail_smtp($to,$subject,$headers,$mailcontent,$company);
	
			/*if(sms_statue == 1)
			{
				$r_arr['company'] = company;
				$r_arr['number'] = sms_reply_mo_no;
				$sms = $this->sendReplay($phone,$r_arr);
				if(isset($sms) && $sms != '')
					$sms_details = $sms;
				else
					$sms_details = 'error';
			}
			else
				$sms_details = 'sms inactive'; */
		}
		else
		{
		  $msg = 'error';
		}
		return $msg;
	}
	
	function getFormNotification($type)
	{
		global $con; 
		$sql ="select * from form where type = '".$type."' and notification = 0";
		return mysqli_num_rows(mysqli_query($con,$sql));
	}
	function updateFormNotification($type)
	{
		global $con; 
		$sql = "update form set notification ='1' where type ='".$type."'";
		return mysqli_query($con,$sql);
	}
	
	function insertInquiry($post,$email_to)
	{
		global $con;  
		$msg ='';
		@extract($post);
		if(sms_statue == 1)
		{
			$sms = $this->sendSMS(sms_mobileno,$_POST);
			if(isset($sms) && $sms != '')
				$sms_details = $sms;
			else
				$sms_details = 'error';
		}
		else
			$sms_details = 'sms inactive';
		
		$to = $email_to;
		$subject = 'Contact from '.company;
	$msg= "This Contact mail is coming from ".web_link." \n Email:" . $email." \n Name:" . $name." \n phone:" . $phone." \n Message:" . $message;
			$from = $email;
		$headers = "From:" . $from;
		
			return	$res = $this->mail_smtp($to,$subject,$msg,$headers);
			
	//	$res = mail($to,$subject,$msg,$headers);
		if($res>0)
		{
			$sql="INSERT INTO `form` (`type`, `name`, `email`, `phone`,`message`,`sms_status`) values ('".$type."', '".$name."', '".$email."','".$phone."','".$message."', '".$sms_details."');"; 
		    $msg = mysqli_query($con,$sql);
			
		}
		else
		{
		  $msg = 'error';
		}
		return $msg;
		
	}
	function insertFullInquiry($post)
	{
		global $con; 
		@extract($post);
		$sql="INSERT INTO `inquiry` (`product`, `quantity`, `name`, `company`, `emial`, `phone`, `address`, `pincode`, `city`, `state`, `country`, `comment`) VALUES ('".$product_name."', '".$quantity."', '".$name."', '".$company."', '".$emial."', '".$phone."', '".$address."', '".$pincode."', '".$city."', '".$state."', '".$country."', '".$comment."');";
		return mysqli_query($con,$sql);
		
	}
	

	
	function insertProductInquiry($post,$email_to)
	{
		global $con;  
		$msg ='';
		@extract($post);
		$details = urldecode($details);
		$company = web_link;
		if(sms_statue == 1)
		{
			$sms = $this->sendSMS(sms_mobileno,$_POST);
			if(isset($sms) && $sms != '')
				$sms_details = $sms;
			else
				$sms_details = 'error';
		}
		else
			$sms_details = 'sms inactive';
		$ip = $_SERVER['REMOTE_ADDR'];
		$to = $email_to;
		$subject = 'Contact from '.company;
		$msg= "This Contact mail is coming from ".web_link." \n Name:" . $name. "\nEmail:" . $email. "\nPhone:" . $phone . "\nMessage:" .$message . "\n Product Inquiry Details:".$details ;
		$from = $email;
		$headers = "From:" . $from;
		
		
		
		$sql="INSERT INTO `form` (`type`, `name`, `email`, `phone`, `message`, `details`,`sms_status` ,`ip`) values ('".$type."', '".$name."', '".$email."', '".$phone."' , '".nl2br($message)."', '".$details."', '".$sms_details."' ,'".$ip."');";
		$res = mysqli_query($con,$sql);
		if($res>0)
		{
				//return	$msg = $this->mail_smtp($to,$subject,$msg,$headers,$company);
					$msg = $this->mail_smtp($to,$subject,$headers,$mailcontent,$company);
	
			//$msg = mail($to,$subject,$msg,$headers);
			if(sms_statue == 1)
			{
				$r_arr['company'] = company;
				$r_arr['number'] = sms_reply_mo_no;
				$sms = $this->sendReplay($phone,$r_arr);
				if(isset($sms) && $sms != '')
					$sms_details = $sms;
				else
					$sms_details = 'error';
			}
			else
				$sms_details = 'sms inactive';
		}
		else
		{
		  $msg = 'error';
		}
		return $msg;
	
	}
	function deleteRecordById($table,$id)
	{
		global $con; 
		$sql = "delete from ".$table." WHERE id = '".$id."'";
		return $res= mysqli_query($con,$sql);
	}
	
	//For SMS API
	
	
	
	

	
	
	
	function Image_Upload($file)
	{
		global $con;  
		$error = "";
		if (isset($file)) 
		{
			//$allowedExts = array("gif", "jpeg", "jpg", "png");
			$allowedExts = array("jpeg", "jpg");
			$temp = explode(".", $file["name"]);
			$extension = end($temp);
		
			if ($file["error"] > 0) 
			{
				$error = 0;//"Error Uploading the file<br />";
			}
			if ( $file["type"] != "image/gif" &&
				$file["type"] != "image/gif" &&
				$file["type"] != "image/jpeg" &&
				$file["type"] != "image/jpg" &&
				$file["type"] != "image/png") 
			{	
					
				$error = 1 ;//"Upload Valid Image<br />";
			}
			if (!in_array($extension, $allowedExts)) 
			{
				$error .= "Extension not allowed<br />";
			}
			if ($file["size"] > 1050000) 
			{
				$error = 2; //"File size shoud be less than 1 mB<br />";
			}
	
			if ($error == "") 
			{
				move_uploaded_file($file['tmp_name'], '../uploads/product/'.$file['name']);
				return $file['name'];
			} 
			else 
			{
				return $error ;
			}
		}	
		
	}
	function img_resize( $tmpname, $size, $save_dir, $save_name, $maxisheight = 0 )
	{
		global $con;  
		$save_dir .= ( substr($save_dir,-1) != "/") ? "/" : "";
		$gis = getimagesize($tmpname);
		$type = $gis[2];
		
		switch($type)
		{
			case "1": $imorig = imagecreatefromgif($tmpname); break;
			case "2": $imorig = imagecreatefromjpeg($tmpname);break;
			case "3": $imorig = imagecreatefrompng($tmpname); break;
			default:  $imorig = imagecreatefromjpeg($tmpname);
		}
		
		$x = imagesx($imorig);
		$y = imagesy($imorig);
		
		
		if($maxisheight != 0)
		{
			$ratio1= ($x/$size);
			$ratio2=($y/$maxisheight);
			if($ratio1>$ratio2) {
				$aw=$size;
				$ah=$y/$ratio1;
			}
			else {
				$ah=$maxisheight;
				$aw=$x/$ratio2;
			}
		}
		else
		{
			$woh = (!$maxisheight)? $gis[0] : $gis[1] ;
			if($woh <= $size)
			{
				$aw = $x;
				$ah = $y;
			}
			else
			{
				if(!$maxisheight)
				{
					$aw = $size;
					$ah = $size * $y / $x;
				}
				else
				{
					$aw = $size * $x / $y;
					$ah = $size;
				
				}
			}
		}
		
		$im = imagecreatetruecolor($aw,$ah);
		
		if (imagecopyresampled($im,$imorig , 0,0,0,0,$aw,$ah,$x,$y))
		
		if (imagejpeg($im, $save_dir.$save_name,100))
			return true;
		else
			return false;
	
	}
	
	//Pagination Function
	
	function pagination($per_page = 10, $page = 1, $url = '', $total){  
  
		global $con;  
        $adjacents = "2";
 
        $page = ($page == 0 ? 1 : $page); 
        $start = ($page - 1) * $per_page;                              
         
        $prev = $page - 1;                         
        $next = $page + 1;
        $lastpage = ceil($total/$per_page);
        $lpm1 = $lastpage - 1;
         
        $pagination = "";
        if($lastpage > 1)
        {  
            $pagination .= "<div class='pages'>";
                  // $pagination .= "<li class='single'><a>Page $page of $lastpage</a></li>";
			if ($page > 1){
				//$pagination.= "<li><a href='{$url}1'>First</a></li>";
                //$pagination.= "<li><a href='{$url}$prev'>Prev</a></li>";
            }elseif($page == 1){
				//$pagination.= "<li><a class='current'>First</a></li>";
               // $pagination.= "<li><a class='current'>Prev</a></li>";
            }
            if ($lastpage < 7 + ($adjacents * 2))
            {  
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<a class='active'>$counter</a>";
                    else
                        $pagination.= "<a href='{$url}$counter' >$counter</a>";                   
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2))
            {
                if($page < 1 + ($adjacents * 2))    
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<a class='active'>$counter</a>";
                        else
                            $pagination.= "<a href='{$url}$counter'>$counter</a>";                   
                    }
                    $pagination.= "<a>...</a>";
                    $pagination.= "<a href='{$url}$lpm1'>$lpm1</a>";
                    $pagination.= "<a href='{$url}$lastpage'>$lastpage</a>";     
                }
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $pagination.= "<a href='{$url}1'>1</a>";
                    $pagination.= "<a href='{$url}2'>2</a>";
                    $pagination.= "<a>...</a>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<a class='active'>$counter</a>";
                        else
                            $pagination.= "<a href='{$url}$counter'>$counter</a>";                   
                    }
                    $pagination.= "<a>..</a>";
                    $pagination.= "<a href='{$url}$lpm1'>$lpm1</a>";
                    $pagination.= "<a href='{$url}$lastpage'>$lastpage</a>";     
                }
                else
                {
                    $pagination.= "<a href='{$url}1'>1</a>";
                    $pagination.= "<a href='{$url}2'>2</a>";
                    $pagination.= "<a>..</a>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<a class='active'>$counter</a>";
                        else
                            $pagination.= "<a href='{$url}$counter'>$counter</a>";                   
                    }
                }
            }
             
            if ($page < $counter - 1){
				 $pagination.= "<a href='{$url}$next' class=''>>></a>";
                //$pagination.= "<li><a href='{$url}$lastpage'>Last</a></li>";
            }else{
				$pagination.= "<a class='active'>>></a>";
                //$pagination.= "<li><a class='current'>Last</a></li>";
            }
            $pagination.= "</div>\n";     
        }          
        return $pagination;
    }
		
	function recordCount($sql)
	{
		global $con;  
		$query=mysqli_query($con,$sql);
		$rows=mysqli_num_rows($query);
		if($rows>0)
			return $rows;
		else
			return 0;
	}
	function getRecords($sql)
	{
		global $con;  
		$res = array();
		$query=mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($query))
		{
			$res[] = $row;
		}
		
		return $res;
	}
	function getLastRecords($sql)
	{
		global $con;  
		$query=mysqli_query($con,$sql);
		$res = mysqli_fetch_array($query);
		return $res;
	}
	function update_records($sql)
	{	global $con;
		$query=mysqli_query($con,$sql);
		return $query;  
	}
	function insertRecords($table,$arg)
	{
		global $con;  
		$sql = 'insert into '.$table.' set ';
		foreach ($arg as $key => $value)
		{
			$sql .= $key ."='".$value."' ,";
		}
		$sql = rtrim($sql," ,");
		
		return $this->insert_record($sql);
	}
	function getRecord($table,$arg)
	{
		global $con; 
		$sql ='select * from '.$table.' where ';
		foreach ($arg as $key => $value)
		{
			$sql .= $key ."='".$value."' and ";
		}
		$sql = rtrim($sql," and ");
		
		return $this->select_one_record($sql);
	
	}
	function select_one_record($sql)
	{
		global $con;  
		$res= mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$row = mysqli_fetch_array($res);
			return $row;
		}
		else
		{
			return 0;
		}
	}
	function updateRecord($table,$arg,$condition)
	{
		global $con;  
		$sql = 'update '.$table.' set ';
		foreach ($arg as $key => $value)
		{
			$sql .= $key ."='".$value."' ,";
		}
		$sql = rtrim($sql," ,");
		
		if($condition !='')
		{
			$sql .= ' where ';
			foreach ($condition as $key => $value)
			{
				$sql .= $key ."='".$value."' and ";
			}
		}
		$sql = rtrim($sql," and ");
		return $this->update_record($sql);
	}
	function insert_record($sql)
	{
		global $con;  
		$res= mysqli_query($con,$sql);
		return $res;
	}
	function update_record($sql)
	{
		global $con; 
		$res= mysqli_query($con,$sql);
		return $res;
	}
	function select_all_record($sql)
	{
		global $con;  
		$res= mysqli_query($con,$sql);
		$col = mysqli_num_rows($res);
		if($col>0)
		{
			while($row = mysqli_fetch_array($res))
			{
				$result[] = $row;
			}
			return $result;
		}
	}
	
	//meta-tag functions
	
	function getMetaDataByType($type,$meta)
	{	
		global $con;  
		$sql ="select data from settings where type = '".$type."' and meta = '".$meta ."'";
		$q = mysqli_query($con,$sql);
		if(mysqli_num_rows($q)>0)
		{
			$row =  mysqli_fetch_array($q);
			return $row[0];
		}
		
	}
	
	//analytic code
	function get_client_ip_server()
	{
		global $con;  
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
			
		if(!preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/',$ipaddress)){
				$ipaddress = "150.129.149.228";
			}	
			
		return $ipaddress;
	}
	function get_client_browser()
	{
		global $con;  
		$browser = '';
		$msie = strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') ? true : false;
		$firefox = strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? true : false;
		$safari = strpos($_SERVER["HTTP_USER_AGENT"], 'Safari') ? true : false;
		$chrome = strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') ? true : false;
		if ($firefox) {
			$browser = 'firefox';
		}
		if ($safari || $chrome) {
			$browser = 'webkit';
		}
		if ($msie) {
			$browser = 'msie';
		}
		return $browser;
}
	function get_location_details($ip)
	{
		global $con;  
		$locationurl = file_get_contents('http://ipinfo.io/'.$ip.'/json');
		if($location = json_decode($locationurl,true)){
			return $location;
		}else{
			return NULL;
		}
	}
	function addAnalyticsEntry($ip,$browser,$datedata,$locationdata,$atime)
	{
		global $con;  
		$city = (isset($locationdata['city'])) ? $locationdata['city'] : '-';
		$region = (isset($locationdata['region'])) ? $locationdata['region'] : '-';
		$country = (isset($locationdata['country'])) ? $locationdata['country'] : '-';
		$loc = (isset($locationdata['loc'])) ? $locationdata['loc'] : '-';
		$postal = (isset($locationdata['postal'])) ? $locationdata['postal'] : '-';
		
		$datedata = explode('/',$datedata);
		$date = $datedata[0];
		$month = $datedata[1];
		$year = $datedata[2];
		
		$sql = "INSERT INTO `analytics` (`id`, `ip`, `browser`, `date`, `month`, `year`, `time`, `city`, `region`, `country`, `loc`, `postal`) VALUES (NULL, '".$ip."', '".$browser."', '".$date."','".$month."','".$year."','".$atime."', '".$city."', '".$region."', '".$country."', '".$loc."', '".$postal."');";
		mysqli_query($con,$sql);
		$sql = "UPDATE settings SET data = data + 1  WHERE meta = 'totalvisitor' and type = 'visitor'";
		mysqli_query($con,$sql);
		if($browser != ''){
			$sql = "UPDATE settings SET data = data + 1  WHERE meta = '".$browser."_totalvisitor' and type = 'visitor'";
			mysqli_query($con,$sql);
			}

			if($this->check_MetaData('visitor','totalvisit_date_'.$date.'_'.$month.'_'.$year) == 0){
				$mdata = array(
					'totalvisit_date_'.$date.'_'.$month.'_'.$year.'' => '0'
				);
				$this->add_MetaData('visitor',$mdata);
				}
				$sql = "UPDATE settings SET data = data + 1  WHERE meta = 'totalvisit_date_".$date."_".$month."_".$year."' and type = 'visitor'";
				mysqli_query($con,$sql);
					
			if($this->check_MetaData('visitor','totalvisit_month_'.$month.'_'.$year) == 0){
				$mdata = array(
					'totalvisit_month_'.$month.'_'.$year.'' => '0'
				);
				$this->add_MetaData('visitor',$mdata);
				}
				$sql = "UPDATE settings SET data = data + 1  WHERE meta = 'totalvisit_month_".$month."_".$year."' and type = 'visitor'";
				mysqli_query($con,$sql);
				
			if($this->check_MetaData('visitor','totalvisit_year_'.$year) == 0){
				$mdata = array(
					'totalvisit_year_'.$year.'' => '0'
				);
				$this->add_MetaData('visitor',$mdata);
				}
			
				$sql = "UPDATE settings SET data = data + 1  WHERE meta = 'totalvisit_year_".$year."' and type = 'visitor'";
				mysqli_query($con,$sql);
					
		}
		
	function deleteAllVisitor()
	{
		global $con;  
		$sql = "TRUNCATE TABLE  analytics;";
		return mysqli_query($con,$sql);
		}
		
	function resetAllVisitor(){
		global $con;  
		$this->deleteAllVisitor();
		$sql = "DELETE FROM settings WHERE type = 'visitor'";
		$this->update_records($sql);
		$mdata = array(
					'totalvisitor' => '0'
				);
		$this->add_MetaData('visitor',$mdata);
	}
		
	function getProductsize(){
			global $con;  
			//$sql = "SELECT * FROM `product_size` ORDER BY `order` ASC";
			$sql = "SELECT a.*,b.name FROM product_size a,menu b WHERE a.menu_id = b.id ORDER BY a.order ASC";
			$data = $this->getRecords($sql);
			return $data;
		}
	
	function getmenuname(){
			 global $con; 
			$sql = "SELECT * FROM `menu` ORDER BY `order` ASC";
			$data = $this->getRecords($sql);
			return $data;
		}
	
    
    function insertProductSize($data,$sizelogo){
			global $con;  
			$slug = $this->createSlug($data['size']);
			$sql = "INSERT INTO `product_size` (`id`, `size`,`slug`, `status`, `series_no_status`, `menu_id`, `col_view`, `packing_number`, `packing_size` , `sizelogo` ,`catalog_link` , `title` ,`keyword` ,`description`,`thickness`,`weight`,`sqlmtrperbox`) VALUES (NULL, '".$data['size']."','".$slug."', '".$data['status']."', '".$data['series_no_status']."', '".$data['menu_id']."', '".$data['col_view']."', '".$data['packing_number']."', '".$data['packing_size']."','".$sizelogo."' ,'".$data['catalog_link']."' ,'".$data['title']."', '".$data['keyword']."', '".$data['description']."','".$data['thickness']."','".$data['weight']."','".$data['sqlmtrperbox']."');";

		
			$data = $this->insert_record($sql); 
			return "Product Size Insert successfully";
		}
		
		function insertvideo($data){
			global $con;  
			$sql = "INSERT INTO `video` ( `name`, `yturl`) VALUES ('".$data['name']."', '".$data['yturl']."');";
			$data = $this->insert_record($sql);
			return "Video Insert successfully";
		}
		
		
		  function updatevideo($data,$id){
			global $con;  
			$osql = "SELECT * FROM `video` WHERE id='".$id."'";
			$oldata = $this->getRecords($osql);		
			$sql = "UPDATE `video` SET `name`='".$data['name']."',`yturl`='".$data['yturl']."' WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
			
			return "Video Update successfully";
			
		}
		
			function getvideo(){
			global $con;  
			$sql = "SELECT * FROM `video`";
			$data = $this->getRecords($sql);
			return $data;
		}
		
		
		function getvideo1($id){
			global $con;  
			$sql = "SELECT * FROM `video` WHERE id='".$id."'";
			$data = $this->getLastRecords($sql);
			return $data;
		}
		
		
	function getproductsizedata($id){
			global $con;  
			$sql = "SELECT * FROM `product_size` WHERE id='".$id."'";
			$data = $this->getLastRecords($sql);
			return $data;
		}
		
		
		
	
	function getMenudata($id){
			 global $con; 
			$sql = "SELECT * FROM `menu` WHERE id='".$id."'";
			$data = $this->getLastRecords($sql);
			return $data;
		}
    
    function updateProductSize($data,$id,$sizelogo){
			global $con;  
			$osql = "SELECT size FROM `product_size` WHERE id='".$id."'";
			$oldata = $this->getLastRecords($osql);		
			
			$omenupath = $this->menupath($id);
			$slug = $this->createSlug($data['size']);
			
			$sql = "UPDATE `product_size` SET `size`='".$data['size']."',`slug`='".$slug."',`series_no_status`='".$data['series_no_status']."',`menu_id`='".$data['menu_id']."',`col_view`='".$data['col_view']."',`status`='".$data['status']."',`packing_number`='".$data['packing_number']."', `packing_size`='".$data['packing_size']."' , `sizelogo`='".$sizelogo."' , `catalog_link`='".$data['catalog_link']."', `title`='".$data['title']."', `keyword`='".$data['keyword']."' ,`description`='".$data['description']."' ,`thickness`='".$data['thickness']."',`weight`='".$data['weight']."',`sqlmtrperbox`='".$data['sqlmtrperbox']."'  WHERE `id`='".$id."'";
			
			$this->insert_record($sql);	
			
			$nmenupath = $this->menupath($id);
			
			$oldpath = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $omenupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $oldata['size'])."";
			$newpath = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $nmenupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $data['size'])."";
			chmod($oldpath, 0777);
			rename($oldpath,$newpath);	
			return "Product Size Update successfully";
		
		}
		
	function insertMenuItem($data,$prologo){
			global $con; 
			 $slug = $this->createSlug($data['name']);
			
			 $sql = "INSERT INTO `menu` (`name`,`title`,`keyword`,`description`, `prologo`,`status`,`slug`,`packing_details`,`details`) VALUES ('".$data['name']."', '".$data['title']."','".$data['keyword']."','".$data['description']."', '".$prologo."','".$data['status']."','".$slug."','".$data['packing_details']."','".$data['details']."')";
			
			 $data = $this->insert_record($sql);
		}
	
	function updateMenuItem($data,$id,$prologo){
			global $con; 
			$osql = "SELECT * FROM menu WHERE id='".$id."'";
			$oldata = $this->getLastRecords($osql);
			
			
			$oldpath = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $oldata['name'])."";
			$newpath = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $data['name'])."";
			chmod($oldpath, 0777);
			rename($oldpath,$newpath);
			
			$slug = $this->createSlug($data['name']);
			 $sql = "UPDATE `menu` SET `name`='".$data['name']."',`status`='".$data['status']."' , `prologo` = '".$prologo."' ,`title`='".$data['title']."',`keyword`='".$data['keyword']."',`description`='".$data['description']."',`slug`='".$slug."' , `packing_details`='".$data['packing_details']."',`details`='".$data['details']."' WHERE `id`='".$id."'";
	
			$data = $this->insert_record($sql);
		}
	
	function Menudelete($id,$prologo = false){
			global $con; 
			
			$osql = "SELECT * FROM menu WHERE id='".$id."'";
			$oldata = $this->getLastRecords($osql);
			
			$pdata = mysqli_query($con,"SELECT * FROM `product_size` WHERE menu_id='".$id."'");
			
			if(mysqli_num_rows($pdata) > 0){
				while($pres = mysqli_fetch_assoc($pdata)){
					$this->productsizedelete($pres['id']);
				}
			}
			
			//$this->rmdir_recursive("../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $oldata['name'])."");
			
			$mname = preg_replace('/[^A-Za-z0-9\-]/', '',$oldata['name']);
			
			$this->deleteAll("../uploads/".$mname);
			
			if($prologo == true)
			{
				unlink($oldata['prologo']);
			}
		
			$sql = "DELETE FROM `menu` WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
		}
	function getparentname($id)
	{
		$str='';
		if($id==0)
		{
			$str='-';
		} 
		else
		{
			$sql = "SELECT id,title FROM `product_other_admin_panel` where id='".$id."'";
			$sqldata = $this->getLastRecords($sql);
			
			$str=$sqldata['title'];
			
		}
		
		return $str;
	}
	function productsizedelete($id,$sizelogo = false){
			global $con;
		
			$sql = "SELECT * FROM `series` WHERE `product_size_id` = '".$id."'";
			$series = $this->getRecords($sql);
				if(count($series) > 0 && $series != ''){
					foreach($series as $ser){
						$this->deleteSeries($ser['id']);
						}
					}

			$prosql = "DELETE FROM `product` WHERE `size_id` = '".$id."'";
			$prodelete = $this->insert_record($prosql);
		
		
			$dsql = "SELECT * FROM `product_size` WHERE id='".$id."'";
			$dsqldata = $this->getLastRecords($dsql);
			
			

			
			if($sizelogo == true)
			{
				unlink($dsqldata['sizelogo']);
			}
			
			$menupath = $this->menupath($id);
			
			$this->rmdir_recursive("../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $dsqldata['size'])."");

			$sql = "DELETE FROM `product_size` WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
		}
		
		function videodelete($id){
			global $con;
			

			$sql = "DELETE FROM `video` WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
		}
		
		
	function rmdir_recursive($dir) {
			global $con;  
    		foreach(scandir($dir) as $file) {
      			  if ('.' === $file || '..' === $file) continue;
       				 if (is_dir("$dir/$file")) $this->rmdir_recursive("$dir/$file");
       				 else unlink("$dir/$file");
   				 }
    		rmdir($dir);
	}
	
	function get_infrastructure(){
			global $con;  
			$sql = "SELECT * FROM `news`";
			$data = $this->getRecords($sql);
				
			$finaldata = array();	
				
			foreach($data as $d){
				
				$isql = "SELECT * FROM `images` WHERE news_id = '".$d['id']."'";
				$imagedata = $this->getRecords($isql);
					
				if(count($imagedata) > 0 && $imagedata != ''){
					
					foreach($imagedata as $img){
						
						$image = array();
						$image['image'] = 'uploads/media/'.$img['name'];
						$image['thumb'] = 'uploads/media/thumbnails/'.$img['name'];
						$d['image'][] = $image;
						
						}
					
					}else{
						$d['image'] = '';
						}
						
				$d['title'] = ucwords($d['title']);		
				$finaldata[] = $d;
				}
				
				return $finaldata;
			}

	//for email contact group
	function insertContactGroup($name){
		global $con;

		$sql = "INSERT INTO contact_group (group_name) VALUES ('".$name."')";
		

			if(!mysqli_query($con,$sql)){
				echo "error";
			}
			else{
				return "Groups Insert successfully..!";
			}

	}

	function getGroups()
	{
		global $con;  
		$sql ="select * from contact_group ORDER BY `order` ASC";
		
		$res= mysqli_query($con,$sql);
		$results = '';
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}

	function deleteGroup($id)
	{
		global $con;
		
		$sql = "DELETE FROM contact_group WHERE id = '".$id."'";
		if(!mysqli_query($con,$sql)){
				echo "error";
			}
			else{
				return "Groups Insert successfully..!";
			}
	}

      function get_calc_info_data(){
				global $con;  
			
				$sql = "select product_size.*,menu.name From product_size join menu on menu.id=product_size.menu_id where product_size.status = '1' and  product_size.packing_size != '' and  product_size.packing_size != '' and  product_size.packing_size != '0'";
				$data = $this->getRecords($sql);
				return $data;
		}

	
		
function get_yt_embeded_url($yturl){
			
			$ytid = $this->get_yt_id($yturl);
			
			if(isset($ytid) && $ytid != '' && strlen($ytid) == 11){
				
				$em_str = 'https://www.youtube.com/embed/'.$ytid;
				return $em_str;
			
				}else{
					
				return '';	
					
			}
			
			
			
		}

	
		
	function get_yt_id($url){
			global $con;  
		
			parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
			//return (isset($my_array_of_vars['v']) ? $my_array_of_vars['v'] : '';
			if(isset($my_array_of_vars['v']) && $my_array_of_vars['v'] != ''){
					return $my_array_of_vars['v'];
			}else{
					return false;
				}
		
		}
		
		function mail_smtp($to,$subject,$headers,$mailcontent,$company)
		{
			$fromname = "Inquiry From Website";
			$fromemail = 'info@solostone.in';

			if(SMTPMailSend($to,$subject,$fromname,$fromemail,$mailcontent,$company))
			{
				return true;	
			}
			else
			{
				return false;
			}
		}

		function blogmail_smtp($to,$subject,$headers,$mailcontent,$company)
		{
			$fromname = "Inquiry From Website";
			$fromemail = 'info@solostone.in';

			if(BlogSMTPMailSend($to,$subject,$fromname,$fromemail,$mailcontent,$company))
			{
				return true;	
			}
			else
			{
				return false;
			}
		}


		function contactmail_smtp($to,$subject,$headers,$mailcontent,$company)
		{
			$fromname = "Inquiry From Website";
			$fromemail = 'info@solostone.in';

			if(ContactSMTPMailSend($to,$subject,$fromname,$fromemail,$mailcontent,$company))
			{
				return true;	
			}
			else
			{
				return false;
			}
		}
		function downloadmail_smtp($to,$subject,$headers,$mailcontent,$company)
		{
			$fromname = "Inquiry From Website";
			$fromemail = 'info@solostone.in';

			if(DownloadSMTPMailSend($to,$subject,$fromname,$fromemail,$mailcontent,$company))
			{
				return true;	
			}
			else
			{
				return false;
			}
		}
		
		
			
			function insertcartinq($post,$email_to)
	{
		global $con;  
		$msg ='';
		@extract($post);
		$details = urldecode($details);
		if(sms_statue == 1)
		{
			$sms = $this->sendSMS(sms_mobileno,$_POST);
			if(isset($sms) && $sms != '')
				$sms_details = $sms;
			else
				$sms_details = 'error';
		}
		else
			$sms_details = 'sms inactive';
		
		$to = $email_to;
		$subject = 'Contact from '.company;
		$msg= "This Contact mail is coming from ".web_link." \n Name:" . $name. "\nEmail:" . $email. "\nPhone:" . $phone . "\nMessage:" .$message . "\n Product Inquiry Details:".$details ;
		$from = $email;
		$headers = "From:" . $from;
		
		
		
		$sql="INSERT INTO `form` (`type`, `name`, `email`, `phone`, `message`, `details`,`sms_status`) values ('".$type."', '".$name."', '".$email."', '".$phone."' , '".nl2br($message)."', '".$details."', '".$sms_details."');";
		$res = mysqli_query($con,$sql);
		if($res>0)
		{
				return	$msg = $this->mail_smtp($to,$subject,$msg,$headers);
		
			if(sms_statue == 1)
			{
				$r_arr['company'] = company;
				$r_arr['number'] = sms_reply_mo_no;
				$sms = $this->sendReplay($phone,$r_arr);
				if(isset($sms) && $sms != '')
					$sms_details = $sms;
				else
					$sms_details = 'error';
			}
			else
				$sms_details = 'sms inactive';
		}
		else
		{
		  $msg = 'error';
		}
		return $msg;
	
	}
	
	  function insertcareer($post,$email_to)
 {
	    global $con;
	 	$msg ='';
	 	 @extract($post);
	  
	  	  if(sms_statue == 1)
			  {
			   $sms = $this->sendSMS(sms_mobileno,$_POST);
			   if(isset($sms) && $sms != '')
				$sms_details = $sms;
			   else
				$sms_details = 'error';
			  }
			  else
			   $sms_details = 'sms inactive';
			   
		$to = $email_to;
		$subject = 'Contact from '.company;
		$company = web_link;
		$msg= "This Contact mail is coming from ".web_link." \n Name:" . $name. "\nEmail:" . $email. "\nPhone:" . $phone . "\nMessage:" .$message ;
		$from = $email;
		$headers = "From:" . $from;
	  
	 	 $rand = rand(000,999);
		 $targetfile='uploads/career/'.$rand.'_'.$_FILES['cv_file']['name'];
	
	if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
	{
		
		$imageFileType = strtolower(pathinfo($targetfile,PATHINFO_EXTENSION));
		
		if($imageFileType == "pdf" || $imageFileType == "doc" || $imageFileType == "docx")
		{
			 $pdf = move_uploaded_file($_FILES['cv_file']['tmp_name'],$targetfile);
			$sql="INSERT INTO `career` (`name`,`email`, `phone`,`Post_Apply`,`dept`,`cv_file`,`message`,`date`) values ('".$name."','".$email."','".$phone."','".$Post_Apply."','".$dept."', ,'".$targetfile."','".$message."',now());";
			 $res = mysqli_query($con,$sql);
			  if($res>0)
			  {
				  
				
				  $msg = $this->mail_smtp($to,$subject,$headers,$mailcontent,$company);
				}
		}	
	   else 
		{
			echo "<script>alert('Only pdf,doc & docx files are  allowed')</script>";
		}
	}
		  
	  return $msg;
 
	}
	
	
 function addAnalyticsScript(){
      global $con;
      $sql = "select footerScript from addanalytics";
      $res = mysqli_query($con,$sql);
      return $row = mysqli_fetch_array($res); 
      
  }
  function addAnalytics(){
      global $con;
      $sql = "select viewId,gsServiceAccount,fileNameOfP12 from addanalytics"; 
      $res = mysqli_query($con,$sql);
      return $row = mysqli_fetch_array($res); 
      
  }
  
  function flag(){
      global $con;
      $sql = "SELECT * FROM `export_flag` "; 
      $res = mysqli_query($con,$sql);
      return $row = mysqli_fetch_array($res); 
      
  }
  
  function getproview($id)
	{
		 global $con;
		$sql = "select * from product where id='".$id."'";
		$data = $this->getLastRecords($sql);
		return $data;
	}
	
	
	function get_product_name_list($number = 8){
		
		$data = $this->getMenu();
		$results = '';
		if($data['menu_status'] == 'three_level_menu'){
				unset($data['menu_status']);
				
			foreach($data as $menu){
				
					$m = array();
					$m['name'] = $menu['name'];
					$m['url'] = '#';
						
					if(isset($menu['size'][0]['series_no_status'])){
						
						foreach($menu['size'] as $size){
							
							$c = array();
							$c['name'] = $size['size'];
							$c['url'] = '#';
						if($size['series_no_status'] == '2'){
							
							$m['url'] = $c['url'] = 'product-size-'.$size['id'].'.html';
							
							}else{
								if(isset($size['series']) && $size['series'] !=''){
									
								if($size['series_no_status'] == '2'){
										$m['url'] = $c['url'] = 'product-series-'.$size['series'][0]['id'].'.html';
										
										foreach($size['series'] as $series){
											
												$s = array();
												$s['name'] = $series['series_name'];
												$m['url'] = $s['url'] = 'product-series-'.$series['id'].'.html';
												$c['next'][] = $s;
											}
										
								}else{
								
								if($size['series_no_status'] == '3'){
										$c['url'] = 'product-series-'.$size['series'][0]['id'].'.html';	
										
											foreach($size['series'] as $series){
											
												$s = array();
												$s['name'] = $series['series_name'];
												$m['url'] = $s['url'] = 'product-series-'.$series['id'].'.html';
												$c['next'][] = $s;
											}

								}else{
									
									if(isset($size['series'][0]['design_view']) && $size['series'][0]['design_view'] ==0){
												$c['url'] = 'product-series-'.$size['series'][0]['id'].'.html';
												
											foreach($size['series'] as $series){
											
												$s = array();
												$s['name'] = $series['series_name'];
												$s['url'] = 'product-series-'.$series['id'].'.html';
												$c['next'][] = $s;
											}
										
										}else{
												$m['url'] = $c['url'] = 'product-seriesno-'.$size['series'][0]['id'].'.html';
												
											foreach($size['series'] as $series){
											
												$s = array();
												$s['name'] = $series['series_name'];
												$m['url'] = $s['url'] = 'product-seriesno-'.$series['id'].'.html';
												$c['next'][] = $s;
											}

											}
										}

									}
								}
							}
						$m['next'][] = $c;
						}
					}
					$results[] = $m;
				}
			}
		
		$out = array();
		
		foreach($results as $r){
			if(isset($r['next']) && $r['next'] != ''){
				foreach($r['next'] as $s){
					
					if(isset($s['next']) && $s['next'] != ''){
						
						foreach($s['next'] as $t){
						
					$o = array();
					$o['name'] = $t['name'];
					$o['size_name'] = $s['name'];
					$o['url'] = $t['url'];
					$out[] = $o;
				
						}
					}
				}
			}
		}
		
		while(count($out) < $number){
			$out = array_merge($out,$out);
		}
		
		$out = array_slice($out,0,$number);
		
		return $out;
		
	}
	
	function getCatalogueBySize()
	{
		 global $con; 
		$i=0;
		$results = array();
		$sql ="SELECT name FROM menu WHERE status = 1";
		$res= mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($res))
		{
			
		
			$sql ="select * from catalogue where size ='".$row['name']."' order by `order` ASC";
			$ress= mysqli_query($con,$sql);
			$no_re = mysqli_num_rows($ress);
			
			if($no_re > 0)
				$results[$i] = $row;
				
			while($rows = mysqli_fetch_array($ress))
			{
				//print_r($rows);
				$results[$i]['catlague'][] = $rows;
			}
			if($no_re > 0)
				$i++;
		}
		
		return $results;
	}
	
	function getfrontmenu($subname)
	{	
		global $con;  
		$sql ="select subname from frontendmenu where subname = '".$subname ."'";
		$q = mysqli_query($con,$sql);
		 	
		if(mysqli_num_rows($q)>0)
		{
			$row =  mysqli_fetch_array($q);
			return $row[0];
		}
		
	}
	
	function getfrontmainmenu($name)
	{	
		global $con;  
		$sql ="select name from frontendmenu where name = '".$name ."'";
		$q = mysqli_query($con,$sql);
			
		if(mysqli_num_rows($q)>0)
		{
			$row =  mysqli_fetch_array($q);
			return $row[0];
		}
	}
	function getallfrontmenuname(){
		 global $con; 
		$sql = "SELECT * FROM `frontendmenu` ORDER BY `id` ASC";
		$data = $this->getRecords($sql);
		return $data;
	}	
	
	function getfrontmenudata($id){
			 global $con; 
			$sql = "SELECT * FROM `frontendmenu` WHERE id='".$id."'";
			$data = $this->getLastRecords($sql);
			return $data;
		}
	
	function updatefrontendmenuitem($data,$id){
			global $con; 
		   $sql = "UPDATE `frontendmenu` SET `name`='".$data['name']."',`status`='".$data['status']."' , `subname` = '".$data['subname']."' ,`url`='".$data['url']."' WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
		}
	
	function FrontMenudelete($id)
	{
			global $con; 
			$sql = "DELETE FROM `frontendmenu` WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
	}
	
	function singleFrontMenudelete($id){
			global $con; 
			$sql = "DELETE FROM `frontendmenu` WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
		}
		
		
	function insertfrontMenuItem($data)
	{
			global $con; 
			$sql = "INSERT INTO `frontendmenu` (`name`, `subname` , `status`,`url`) VALUES ('".$data['name']."', '".$data['subname']."', '".$data['status']."','".$data['url']."')";		$data = $this->insert_record($sql);
	}	
	
	function insertfrontcontact($data)
	{
			global $con; 
			$map = base64_encode($data['map']);
			 $sql = "INSERT INTO `contact` (`type`,`address`, `mobile` ,`email`, `map`) VALUES ('".$data['type']."','".$data['address']."', '".$data['mobile']."', '".$data['email']."' ,  '".$map."')";		
			
			$data = $this->insert_record($sql);
	}			
	
	function getallfrontcontact($type){
		global $con; 
		$sql = "SELECT * FROM `contact` where type='".$type."' ORDER BY `id` ASC";
		$data = $this->getRecords($sql);
		return $data;
	}	
	
	function getfrontcontact($id)
	{
			global $con; 
			$sql = "SELECT * FROM `contact` WHERE id=".$id;
			$data = $this->getLastRecords($sql);
			return $data;
	}

	function singleFrontcontact($id){
			global $con; 
			$sql = "DELETE FROM `contact` WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
		}
	function updatefrontcontact($data,$id){
			global $con; 
			$map = base64_encode($data['map']);
		   $sql = "UPDATE `contact` SET `type`='".$data['type']."',`address`='".$data['address']."',`mobile`='".$data['mobile']."' , `email` = '".$data['email']."' , `map`='".$map."'  WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
		}
			
	function Frontcontactdelete($id)
	{
			global $con; 
			$sql = "DELETE FROM `contact` WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
	}
	
	function getcategoryup($id){
			 global $con; 
			$sql = "SELECT * FROM `category` WHERE id='".$id."'";
			$data = $this->getLastRecords($sql);
			return $data;
		}
		
		function categoryup($data,$id,$icon){
			global $con; 
			$osql = "SELECT * FROM category WHERE id='".$id."'";
			$oldata = $this->getLastRecords($osql);
			
			
			$oldpath = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $oldata['name'])."";
			$newpath = "../uploads/".preg_replace('/[^A-Za-z0-9\-]/', '', $data['name'])."";
			chmod($oldpath, 0777);
			rename($oldpath,$newpath);
			
			$csql = "UPDATE `catagory_image` SET `type`='".str_replace(' ','_',$data['name'])."'  WHERE `type`='".$oldata['name']."'";
			
			$cdata = $this->insert_record($csql);
			
			$sql = "UPDATE `category` SET `name`='".$data['name']."' , `icon` = '".$icon."' WHERE `id`='".$id."'";
			$data = $this->insert_record($sql);
		}
	
		function GenPDF($data)
		{
			include_once 'pdf/vendor/autoload.php';
			$message = $data['message'];
			$pdf_name = $data['title'].".pdf";
			$mpdf = new mPDF('utf-8', 'A4');
			$mpdf->WriteHTML(utf8_encode($message));
			$mpdf->SetDisplayMode('fullwidth');
			global $con;
			$csql = "SELECT * FROM `contact`";
			$cres  = mysqli_query($con,$csql);
			$fetchc = mysqli_fetch_array($cres);
			$m = $fetchc['mobile'];
			$e = $fetchc['email'];
			$mpdf->SetHTMLFooter('
			<p style="text-align:center;border-top:solid 1px #000;padding-top:10px;">WANT TO GET IN TOUCH WITH US?<p/><p style="text-align:center;border-bottom:solid 1px #000;padding-bottom:10px;">Phone: '.$m.'  | Email:'.$e.'</p>
		
<table width="100%">
    <tr>
    
		<td width="50%" align="left">'.company.'</td>
        <td width="50%" align="right">{PAGENO}</td>
       
    </tr>
</table>');
		$pdfpath = 'genpdf/'.$pdf_name;
		$mpdf->Output($pdfpath,'F'); 
		}
		
		
		
		function get_records_assoc($sql)
		{
			global $con;  
			$res = array();
			$query=mysqli_query($con,$sql);
			while($row = mysqli_fetch_assoc($query))
			{
				$res[] = $row;
			}
		return $res;
		}
		
		
		function getUserIpAddr(){
			$ipaddress = '';
			if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
			else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
			else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
			else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
			else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
			else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
			else
			$ipaddress = 'UNKNOWN';

			return $ipaddress;
			}



		function sendSMS($mobile, $post)
		{
			global $con;  
			@extract($post);
			$url = "http://antiquetouch.in/smsgateway/do-sms.php?mobile=".$mobile."&message=".urlencode(substr("Inquiry From ".web_link." Name:".$name.", Email:".$email.", Phone:".$phone.", Message:".$message, 0, 600));
			
			$ch = curl_init();								// create a new cURL resource
			curl_setopt($ch, CURLOPT_URL,$url);				// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 	// grab URL and pass it to the browser
			curl_setopt($ch, CURLOPT_HEADER,0);  			// DO NOT RETURN HTTP HEADERS 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  	// RETURN THE CONTENTS OF THE CALL
			$result = curl_exec($ch);
			//curl_exec($ch);
			curl_close($ch); 								// close cURL resource, and free up system resources
			
			return $result;		
		}
		
		function sendPSMS($mobile, $post)
		{
			global $con;  
			@extract($post);
			$url = "http://antiquetouch.in/smsgateway/do-sms.php?mobile=".$mobile."&message=".urlencode(substr("Inquiry From ".web_link." Product:" .$details.", Name:".$name.", Email:".$email.", Phone:".$phone.", Message:".$message, 0, 600));
			
			$ch = curl_init();								// create a new cURL resource
			curl_setopt($ch, CURLOPT_URL,$url);				// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 	// grab URL and pass it to the browser
			curl_setopt($ch, CURLOPT_HEADER,0);  			// DO NOT RETURN HTTP HEADERS 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  	// RETURN THE CONTENTS OF THE CALL
			$result = curl_exec($ch);
			//curl_exec($ch);
			curl_close($ch); 								// close cURL resource, and free up system resources
			
			return $result;		
		}
		function sendDSMS($mobile, $post)
		{
			global $con;  
			@extract($post);
			$url = "http://antiquetouch.in/smsgateway/do-sms.php?mobile=".$mobile."&message=".urlencode(substr("Inquiry From ".web_link." Contact:" .$contatto.", Name:".$name.", Email:".$email.", Phone:".$phone.", Country:" .$country.", Message:".$message, 0, 600));
			
			$ch = curl_init();								// create a new cURL resource
			curl_setopt($ch, CURLOPT_URL,$url);				// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 	// grab URL and pass it to the browser
			curl_setopt($ch, CURLOPT_HEADER,0);  			// DO NOT RETURN HTTP HEADERS 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  	// RETURN THE CONTENTS OF THE CALL
			$result = curl_exec($ch);
			//curl_exec($ch);
			curl_close($ch); 								// close cURL resource, and free up system resources
			
			return $result;		
		}
			
		function insertContact_jp($post,$email_to)
	    {
			$msg ='';
		@extract($post);
		
		if(sms_statue == 1)
		{
			$sms = $this->sendSMS(sms_mobileno,$_POST);
			if(isset($sms) && $sms != '')
				$sms_details = $sms;
			else
				$sms_details = 'error';
		}
		else
			$sms_details = 'sms inactive'; 
		
		$to = $email_to;
		$subject = 'Contact from '.company;
		$msg= "This Contact mail is coming from ".web_link." \n Name:" . $name. "\nEmail:" . $email. "\nPhone:" . $phone . "\nMessage:" .$message  ;
		$from = $email;
		$headers = "From:" . $from;
		
		$company = web_link;
		
		$ip = $this->getUserIpAddr();

		$sql="INSERT INTO `contact_inquiry` ( `type`,`c_name`, `c_email`, `c_phone`, `c_message`,`sms_status`,ip) values ( 'contact','".$name."', '".$email."', '".$phone."' , '".nl2br($message)."', '".$sms_details."','".$ip."')"; 

		global $con;
	    $res = mysqli_query($con,$sql);
		if($res>0)
		{

	    $msg = $this->contactmail_smtp($to,$subject,$headers,$mailcontent,$company); 
			/*if(sms_statue == 1)
			{
				$r_arr['company'] = company;
				$r_arr['number'] = sms_reply_mo_no;
				$sms = $this->sendReplay($phone,$r_arr);
				if(isset($sms) && $sms != '')
					$sms_details = $sms;
				else
					$sms_details = 'error';
			}
			else
				$sms_details = 'sms inactive'; */
		}
		else
		{
		  $msg = 'error';
		}
		return $msg;
	}
	
	function insertProductInquiry_jp($post,$email_to)
	{
		$msg ='';
		@extract($post);
		$details = urldecode($details);
		if(sms_statue == 1)
		{
			$sms = $this->sendPSMS(sms_mobileno,$_POST);
			if(isset($sms) && $sms != '')
				$sms_details = $sms;
			else
				$sms_details = 'error';
		}
		else
			$sms_details = 'sms inactive'; 
		
		$to = $email_to;
		$subject = 'Contact from '.company;
		$msg= "This Contact mail is coming from ".web_link." \n Name:" . $name. "\nEmail:" . $email. "\nPhone:" . $phone . "\nMessage:" .$message . "\n Product Inquiry Details:".$details ;
		$from = $email;
		$headers = "From:" . $from;
		
		$company = web_link;
		
		
		$ip = $this->getUserIpAddr();
		 $sql="INSERT INTO `product_inquiry` (`c_name`, `c_email`, `c_phone`, `c_message`, `details`,`sms_status` ,`ip`) values ('".$name."', '".$email."', '".$phone."' , '".nl2br($message)."', '".$details."', '".$sms_details."' ,'".$ip."' );"; 
		global $con;
		$res = mysqli_query($con,$sql);
		
		if($res>0)
		{
			$msg = $this->mail_smtp($to,$subject,$headers,$mailcontent,$company);
			/*if(sms_statue == 1)
			{
				$r_arr['company'] = company;
				$r_arr['number'] = sms_reply_mo_no;
				$sms = $this->sendReplay($phone,$r_arr);
				if(isset($sms) && $sms != '')
					$sms_details = $sms;
				else
					$sms_details = 'error';
			}
			else
				$sms_details = 'sms inactive'; */
				
		}
		else
		{
		  $msg = 'error';
		}
		return $msg;
	
	}
	
	function getImageByProductId1($id)
	{
		  global $con;
		 $sql ="SELECT product_size.id,product_size.size, series.series_name FROM product JOIN product_size ON product.size_id = product_size.id JOIN series ON product.series_id = series.id WHERE product.series_id = ".$id;
		$res= mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$row = mysqli_fetch_array($res);
			$menupath = $this->menupath($row['id']);
			$path = preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $row['size']).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $row['series_name']);
		}
		else
		{
			$sql = "SELECT product.id,product_size.id as s_id,product_size.size FROM product join product_size on product.size_id = product_size.id WHERE product.series_id = ".$id;
			$res= mysqli_query($con,$sql);
			$row = mysqli_fetch_array($res);
			$menupath = $this->menupath($row['s_id']);
			$path =  preg_replace('/[^A-Za-z0-9\-]/', '', $menupath).'/'.preg_replace('/[^A-Za-z0-9\-]/', '', $row['size']);
		}
		return $path;
	}
	
	function insertcatagory_image($image,$thumb,$type)
	{
		global $con;
		$sql="INSERT INTO `catagory_image` (`type`,`image`,`thumb`) VALUES ('".$type."','".$image."','".$thumb."');";
		return mysqli_query($con,$sql);
	}
	
	function getcatagory_image($type)
	{
		global $con;  
	   $sql ="select * from `catagory_image` where type='".$type."' ORDER BY `order` ASC";
		
		$res= mysqli_query($con,$sql);
		$results = array();
		while($row = mysqli_fetch_array($res))
		{
			$results[] = $row;
		} 
		return $results;
	}
	
	function deletecatagory_image($id)
	{
		global $con; 
		$sql = "select * from `catagory_image` WHERE id = '".$id."'";
		$res= mysqli_query($con,$sql);
		$row = mysqli_fetch_array($res);
		
		$thumbpath = str_replace(' ','_',$row['type']).'/thumbnails/'.$row['thumb'];
	
		$imagepath = str_replace(' ','_',$row['type']).'/'.$row['image'];
		
		$sql1 = "DELETE FROM `catagory_image` WHERE id = '".$id."'";
		$res1 = mysqli_query($con,$sql1);
		if($res1>0)
		{
			if(isset($thumbpath) && $thumbpath !='')
				unlink('../uploads/'.$thumbpath);
			if(isset($imagepath) && $imagepath !='')
				unlink('../uploads/'.$imagepath);
		}
	}
	
	function Delete_News_With_Video($id)
	{
		global $con; 
		$sql1 = "DELETE FROM `news` WHERE id = '".$id."'";
		$res1 = mysqli_query($con,$sql1);
	}
	
	function video_delete($id)
	{
		global $con; 
		$sql1 = "DELETE FROM `video` WHERE id = '".$id."'";
		$res1 = mysqli_query($con,$sql1);
	}
	
	function deleteBlog($id)
	{
		global $con; 
		$news = $this->	select_one_record("select * from news where id = ".$id);
			
		$sql = "delete from news where id = ".$news['id'];
		$nd = $this->update_record($sql);
	
		if($nd>0)
		{
			$sql = "select * from images where news_id= ".$id;
			$ne = $this->select_all_record($sql);

			for($i=0; $i < count($ne); $i++)
			{	
				$rs = $this ->update_record("DELETE FROM images WHERE id = '".$ne[$i]['id']."'");
				if($rs>0)
				{
					unlink('../uploads/media/thumbnails/'.$ne[$i]['name']);	
					unlink('../uploads/media/'.$ne[$i]['name']);	
				}
			}
		}
	}
	
	function deleteEvent($id)
	{
		global $con; 
		$news = $this->	select_one_record("select * from news where id = ".$id);
			
		$sql = "delete from news where id = ".$news['id'];
		$nd = $this->update_record($sql);
	
		if($nd>0)
		{
			$sql = "select * from images where news_id= ".$id;
			$ne = $this->select_all_record($sql);

			for($i=0; $i < count($ne); $i++)
			{	
				$rs = $this ->update_record("DELETE FROM images WHERE id = '".$ne[$i]['id']."'");
				if($rs>0)
				{
					unlink('../uploads/media/thumbnails/'.$ne[$i]['name']);	
					unlink('../uploads/media/'.$ne[$i]['name']);	
				}
			}
		}
	}
	
	function Delete_Metadata_Page($type)
	{
		global $con; 
		$sql = "delete FROM `settings` WHERE `type` = '$type'";
		$res  = mysqli_query($con,$sql);
	}
	
	function insertlightbox($type,$image,$thumb)
	{	
		global $con;
		$sql="INSERT INTO `gallery` (`type`,`image`,`thumb`) VALUES ('".$type."','".$image."','".$thumb."');";
		
		if (!mysqli_query($con,$sql))
			echo '<script>danger("Get error while updating images!")</script>';
		else
			echo '<script>success("Image Insert successfuly.")</script>';
	}
	
	function deleteAll($str) {
		//It it's a file.
		if (is_file($str)) {
			//Attempt to delete it.
			return unlink($str);
		}
		//If it's a directory.
		elseif (is_dir($str)) {
			//Get a list of the files in this directory.
			$scan = glob(rtrim($str,'/').'/*');
			//Loop through the list of files.
			foreach($scan as $index=>$path) {
				//Call our recursive function.
				deleteAll($path);
			}
			//Remove the directory itself.
			return @rmdir($str);
		}
	}
	
	function createSlug($string) 
    {
    	$slug = strtolower(trim(preg_replace('/-{2,}/','-',preg_replace('/[^a-zA-Z0-9-.]/', '-', $string)),"-"));
		return $slug;
    }
	
	/* --------- Start Ceramic Application 4-2-20 --------- */
	
	function insertceramicapplication($data,$a='')
	{
		global $con; 
		$slug = $this->createSlug($data['name']);
		$sql = "INSERT INTO `application` (`name`,`app_img`,`status`,`slug`) VALUES ('".$data['name']."','".$a."','".$data['status']."','".$slug."')"; 
		$data = $this->insert_record($sql);
	}
	
	function updateceramicapplication($data,$a='',$id)
	{
		global $con; 
		$slug = $this->createSlug($data['name']);
		$sql = "UPDATE `application` SET `name`='".$data['name']."',`app_img`='".$a."',`status`='".$data['status']."' ,`slug`='".$slug."' WHERE `id`='".$id."'"; 
		$data = $this->insert_record($sql);
	}
	function getceramicapplicationdata($id)
	{
		global $con; 
		$sql = "SELECT * FROM `application` WHERE id='".$id."'";
		$data = $this->getLastRecords($sql);
		return $data;
	}
	function getceramicapplicationname()
	{
		global $con; 
		$sql = "SELECT * FROM `application` ORDER BY `sequence_order` ASC";
		$data = $this->getRecords($sql);
		return $data;
	}
	
	function ceramicapplicationdelete($id)
	{
		global $con; 
		$sql = "DELETE FROM `application` WHERE `id`='".$id."'";
		$data = $this->insert_record($sql);
	}
	
	function updateProductapplication($id,$application_id)
	{
		global $con;  
		$sql = "UPDATE `product` SET `application_id`='".$application_id."' where id=".$id;
		return $res = mysqli_query($con,$sql);
	}
	
	/* --------- Start Ceramic Inspiration 4-2-20 --------- */
	
	function insertceramicinspiration($data)
	{
		global $con; 
		$slug = $this->createSlug($data['name']);
		$sql = "INSERT INTO `inspiration` (`name`,`status`,`slug`) VALUES ('".$data['name']."','".$data['status']."','".$slug."')";
		$data = $this->insert_record($sql);
	}
	
	function updateceramicinspiration($data,$id)
	{
		global $con; 
		$slug = $this->createSlug($data['name']);
		$sql = "UPDATE `inspiration` SET `name`='".$data['name']."',`status`='".$data['status']."' ,`slug`='".$slug."' WHERE `id`='".$id."'";
		$data = $this->insert_record($sql);
	}
	function getceramicinspirationdata($id)
	{
		global $con; 
		$sql = "SELECT * FROM `inspiration` WHERE id='".$id."'";
		$data = $this->getLastRecords($sql);
		return $data;
	}
	function getceramicinspirationname()
	{
		global $con; 
		$sql = "SELECT * FROM `inspiration` ORDER BY `sequence_order` ASC";
		$data = $this->getRecords($sql);
		return $data;
	}
	function ceramicinspirationdelete($id)
	{
		global $con; 
		$sql = "DELETE FROM `inspiration` WHERE `id`='".$id."'";
		$data = $this->insert_record($sql);
	}
	
	function updateProductinspiration($id,$inspiration_id)
	{
		global $con;  
		$sql = "UPDATE `product` SET `inspiration_id`='".$inspiration_id."' where id=".$id;
		return $res = mysqli_query($con,$sql);
	}

	/* Tiles Color code */ 
	
	function insertcolor($data)
	{
		global $con; 
		$slug = $this->createSlug($data['name']);
		$sql = "INSERT INTO `color` (`name`,`hexacode`,`status`,`slug`) VALUES ('".$data['name']."','".$data['hexacode']."','".$data['status']."','".$slug."')";
		$data = $this->insert_record($sql);
	}
	
	function updatecolor($data,$a='',$id)
	{
		global $con; 
		$slug = $this->createSlug($data['name']);
		$sql = "UPDATE `color` SET `name`='".$data['name']."',`hexacode`='".$data['hexacode']."',`image`='".$a."',`status`='".$data['status']."' ,`slug`='".$slug."' WHERE `id`='".$id."'";
		$data = $this->insert_record($sql);
	}
	function getcolordata($id)
	{
		global $con; 
		$sql = "SELECT * FROM `color` WHERE id='".$id."'";
		$data = $this->getLastRecords($sql);
		return $data;
	}
	function getcolorname()
	{
		global $con; 
		$sql = "SELECT * FROM `color` ORDER BY `id` ASC";
		$data = $this->getRecords($sql);
		return $data;
	}
	function colordelete($id)
	{
		global $con; 
		$sql = "DELETE FROM `color` WHERE `id`='".$id."'";
		$data = $this->insert_record($sql);
	}
	
	function updateProductcolor($id,$color_id)
	{
		global $con;  
		$sql = "UPDATE `product` SET `color_id`='".$color_id."' where id=".$id;
		return $res = mysqli_query($con,$sql);
	}
	
	function insertslider($type,$image,$thumb,$menu,$size,$description,$url)
	{
		global $con;
		$sql="INSERT INTO `gallery` (`type`,`image`,`thumb`,`menu`,`size`,`description`,`url`) VALUES ('".$type."','".$image."','".$thumb."','".$menu."','".$size."','".$description."','".$url."');";
		
		return mysqli_query($con,$sql);
	}
	
	function swapvalue($array)
	{
		$last = end($array);
		$first = reset($array); 
		$array['0'] = $last;
		$array[count($array) - 1] = $first;
		return $array;
	}
	function randomString($length = 6) 
	{
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
}
?>