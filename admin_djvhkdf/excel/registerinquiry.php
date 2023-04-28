<?php
include('../../db.php');
/* Include PHPExcel */
require_once("Classes/PHPExcel.php");

$table = 'register_inquiry';

//Create a PHPExcel object
$objPHPExcel = new PHPExcel();

//Set document properties
$objPHPExcel->getProperties()->setCreator(company)
							 ->setLastModifiedBy(company)
							 ->setTitle($table)
							 ->setSubject($table)
							 ->setDescription("Get All ".$table)
							 ->setKeywords("")
							 ->setCategory("");

// Set default font
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(10);

//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No')
							  ->setCellValue('B1', 'Name')
							  ->setCellValue('C1', 'Email')
							  ->setCellValue('D1', 'Phone')
							  ->setCellValue('E1', 'Message')
							  ->setCellValue('F1', 'IP')
							  ->setCellValue('G1', 'Sms Status')
 							  ->setCellValue('I1', 'Time');
								

							  
//Rename the worksheet
$objPHPExcel->getActiveSheet()->setTitle(names);

//Set active worksheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



/*************** Fetching data from database ***************/
$sql = "select * from ".$table;
$res = mysqli_query($con, $sql);

if(mysqli_num_rows($res)>0)
{
	 $i = 1;
	 while($row = mysqli_fetch_object($res)) {
		 $timefield = date("d-m-Y", strtotime($row->time));
		 
		$objPHPExcel->getActiveSheet()->setCellValue('A'.($i+1), $i)
									  ->setCellValue('B'.($i+1), $row->c_name)
									  ->setCellValue('C'.($i+1), $row->c_email)
									  ->setCellValue('D'.($i+1), $row->c_phone)
									  ->setCellValue('E'.($i+1), $row->c_message)
									  ->setCellValue('F'.($i+1), $row->ip)
									  ->setCellValue('G'.($i+1), $row->sms_status)
									  ->setCellValue('I'.($i+1), $timefield);	
									  

	    $i++;
	 }
}
							  

//Dynamic name, the combination of date and time
$filename = $table.'-'.date('d-m-Y').'-'.'.xlsx';


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

//if you want to save the file on the server instead of downloading, 
//comment the last 3 lines and remove the comment from the next line
//$objWriter->save(str_replace('.php', '.xlsx', $filename));
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
$objWriter->save("php://output");
?>