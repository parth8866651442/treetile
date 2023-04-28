<?php 
include"db.php";

if(isset($_POST['submit']) && $_POST['submit'] == 'submit')
{
    

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $sms_details = 'sms active';
    $ip = $obj_fun->getUserIpAddr();
                
    @extract($post);
       
        

    $sql="INSERT INTO `contact_inquiry` ( `c_name`, `c_email`, `c_phone`, `c_message`,`sms_status`,ip) values ( '".$name."', '".$email."', '".$phone."' , '".$message."', '".$sms_details."','".$ip."')";
    global $con;
    $res = mysqli_query($con,$sql);

    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 
  
    $subject = 'Contact Inquery - Tree Tile LLP';

    $date = date("d-m-Y h:i:sa");

    $str= "Name:" . $name. "\nPhone Number:" . $phone. "\nEmail Id:" . $email . "\nMessage:" .$message ;
        
$apikey = "6s8ZxgfOF0eXj3gu6vy6dg";
  $apisender = "ANTIQU";
   $msg ="Contact Inquiry From Website

Name :- ". $name."
Number :- " . $phone ."
Email :- ". $email."
Message :- ".$message ."

Thank you, Antique Touch";
  $num = 919712704400; // MULTIPLE NUMBER VARIABLE PUT HERE...!
  $ms = rawurlencode($msg); //This for encode your message content
  $EntityId = "1201162028215588313";
  $dlttemplateid = "1207162047313150694";
  $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1&EntityId='.$EntityId.'&dlttemplateid='.$dlttemplateid.'';
  
  $ch=curl_init($url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch,CURLOPT_POST,1);
  curl_setopt($ch,CURLOPT_POSTFIELDS,"");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
  $data = curl_exec($ch);

    // mail("export@treetile.in",$subject,$str);

    $purl = $_POST['purl'];
    echo '<script>alert("Thanks for Contact Us");window.location.href = "index";</script>';                                    

                
            
}


if(isset($_POST['send']) && $_POST['send'] == 'send')
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $details = $_POST['details'];
    $sms_details = 'sms active';
    $ip = $obj_fun->getUserIpAddr();
                
    @extract($post);
    $sql="INSERT INTO `product_inquiry` ( `c_name`, `c_email`, `c_phone`, `c_message`,`details`,`sms_status`,ip) values ( '".$name."', '".$email."', '".$phone."' , '".$message."','".$details."','".$sms_details."','".$ip."')";

    global $con;
    $res = mysqli_query($con,$sql);
    
  
    $subject = 'Product Inquery - Tree Tile LLP';

    $date = date("d-m-Y h:i:sa");

    $str= "Name:" . $name. "\nPhone Number:" . $phone. "\nEmail Id:" . $email . "\nDetails:" . $details . "\nMessage:" .$message ;
       
    $apikey = "6s8ZxgfOF0eXj3gu6vy6dg";
  $apisender = "ANTIQU";
   $msg ="Product Inquiry From Website

Name :- ". $name."
Number :- " . $phone ."
Email :- ". $email."
Message :- ".$message ."

Thank you, Antique Touch ";
  $num = 919712704400; // MULTIPLE NUMBER VARIABLE PUT HERE...!
  $ms = rawurlencode($msg); //This for encode your message content
  $EntityId = "1201162028215588313";
  $dlttemplateid = "1207162047321404804";
  $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1&EntityId='.$EntityId.'&dlttemplateid='.$dlttemplateid.'';
  
  $ch=curl_init($url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch,CURLOPT_POST,1);
  curl_setopt($ch,CURLOPT_POSTFIELDS,"");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
  $data = curl_exec($ch); 

    // mail("export@treetile.in",$subject,$str);
    
        
    echo '<script>alert("Thanks for Inquery");window.location.href = "index";</script>';                                    

} 
?>