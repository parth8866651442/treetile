<?php
function SMTPMailSend($to,$subject,$mailcontent,$fromname,$fromemail,$company)
{
   	$n = $_POST['name'];
	$em = $_POST['email'];
	$phone = $_POST['phone'];
    $m = $_POST['message'];
	$de = $_POST['details'];
    $sitename =company;
    date_default_timezone_set("Asia/Bangkok");
	include_once('smtpemail/class.phpmailer.php');
	$mail = new PHPMailer(true);
	$fromemail = $from = "no-reply@sologresgranito.com";
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = "false"; 
    $mail->Host = "mail.sologresgranito.com"; 
	$mail->Port = 587; 
	$mail->Username = $from;
    $mail->Password = "{fTH]hGy7NHO";  
	$name=$sitename;
	$name_from = $fromname;
	$re = '/[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+/';
	preg_match_all($re, $mailcontent, $matches, PREG_SET_ORDER, 0);
    $mail->AddAddress($to, $name);
    if(isset($matches[0][0]) && $matches[0][0] != '')
	{
	    $mail->addReplyTo($matches[0][0], $fromname);
	    $mail->SetFrom($matches[0][0], $name_from);
	}
	else
	{
	    $mail->SetFrom($fromemail, $name_from);
	}
	$mailcontent = file_get_contents('mail.html');
    $str = <<<EOF
    <html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title></title>
  <!--[if !mso]><!-- -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
 
  <style type="text/css">
  
    #outlook a {
      padding: 0;
    }

    .ReadMsgBody {
      width: 100%;
    }

    .ExternalClass {
      width: 100%;
    }

    .ExternalClass * {
      line-height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

   

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    p {
      display: block;
      margin: 13px 0;
        text-align: center;
    }
	
	.tborder
	{
		 border: 1px solid black;
		 padding: 10px;
text-align: center
	}
	



  </style>
  <!--[if !mso]><!-->
  <style type="text/css">
    @media only screen and (max-width:480px) {
      @-ms-viewport {
        width: 320px;
      }
      @viewport {
        width: 320px;
      }
    }
  </style>
  <!--<![endif]-->
  <!--[if mso]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <!--[if lte mso 11]>
<style type="text/css">
  .outlook-group-fix {
    width:100% !important;
  }
</style>
<![endif]-->

  <!--[if !mso]><!-->
  <link href="smtpemail/font/ufont.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    @import url(smtpemail/font/ufont.css);
  </style>
  <!--<![endif]-->
  <style type="text/css">
    @media only screen and (min-width:480px) {
      .mj-column-per-75 {
        width: 75%!important;
      }
      .mj-column-per-100 {
        width: 100%!important;
      }
      .mj-column-per-50 {
        width: 50%!important;
      }
    }
  </style>
</head>

<body>

  <div class="mj-container">
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <table role="presentation" style="font-size:0px;width:100%;" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td>
            <div style="margin:0px auto;max-width:600px;">
              <table role="presentation" style="font-size:0px;width:100%;" border="0" align="center" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:20px;"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="margin:0px auto;max-width:600px;background:#2f323b;">
      <table role="presentation" style="font-size:0px;width:100%;background:#2f323b;" border="0" align="center" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:0px;padding-top:0px;">
              <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:450px;">
      <![endif]-->
              
               <div class="mj-column-per-50 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;padding-right:25px;padding-left:25px;" align="left">
                        <div style="cursor:auto;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;text-align:left;">
                                <p style="color:#fff !important;">Product Inquiry From  $sitename</p>
                 
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="margin:0px auto;max-width:600px;">
    <br/>
    
    
        
  <table style="width:100%;border: 1px solid black;">

  <tr class="tborder">
        <th class="tborder">Product</th>
        <td class="tborder">$de</td>
   </tr>
  
      <tr class="tborder">
        <th class="tborder">Name</th>
        <td class="tborder">$n</td>
 	 </tr>
   

      <tr class="tborder">
 		<th class="tborder">Email</th>
        <td class="tborder">$em</td>
      </tr>
      <tr class="tborder">
      	<th class="tborder">Phone</th>
        <td class="tborder">$phone</td>
      </tr>
      <tr class="tborder">
        <th class="tborder">Message</th>
        <td class="tborder">$m</td>
      </tr>

  </table>
  <br/>
<center>
<a href="mailto:$em" style="background-color:#449d44;color:#fff;text-decoration:none;font-size:15px;padding:6px;border:#449d44 1px solid;border-radius:5px;">Reply To Inquiry</a></center>
<br/>
     
    </div>
  
    <div style="margin:0px auto;max-width:600px;background:#2f323b;">
      <table role="presentation" style="font-size:0px;width:100%;background:#2f323b;" border="0" align="center" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:0px;padding-top:0px;">
          
              <div class="mj-column-per-50 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;padding-right:25px;padding-left:25px;" align="left">
                        <div style="cursor:auto;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;text-align:left;">
                                   <p align="center"><a href="$company" style="text-decoration: none; color: inherit;">$company</a></p>
                 
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
          
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  
  </div>


</body></html>
EOF;
	file_put_contents("mail2.html",$str);
	$mailcontent  = file_get_contents("mail2.html",$str);
	$mail->Subject = $subject;
	$mail->Body = $mailcontent;
	$mail->isHTML(true);
	try{
	    $mail->Send();
		$file = "mail2.html";
        unlink($file);
    	return true;
	} catch(Exception $e){
	    return false;
		}
}


function ContactSMTPMailSend($to,$subject,$mailcontent,$fromname,$fromemail,$company)
{
  $fname = $_POST['name'];
  
  
  $em = $_POST['email'];
  $phone = $_POST['phone'];
  $m = $_POST['message'];

  
  $sitename =company;
    date_default_timezone_set("Asia/Bangkok");
  include_once('smtpemail/class.phpmailer.php');
  $mail = new PHPMailer(true);
  $fromemail = $from = "no-reply@sologresgranito.com";
  $mail->IsSMTP(); 
  $mail->SMTPAuth = true; 
  $mail->SMTPSecure = "false"; 
  $mail->Host = "mail.sologresgranito.com"; 
  $mail->Port = 587; 
  $mail->Username = $from;
  $mail->Password = "{fTH]hGy7NHO"; 

  $re = '/[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+/';
  preg_match_all($re, $mailcontent, $matches, PREG_SET_ORDER, 0);
    $mail->AddAddress($to, $name);
    if(isset($matches[0][0]) && $matches[0][0] != '')
  {
      $mail->addReplyTo($matches[0][0], $fromname);
      $mail->SetFrom($matches[0][0], $name_from);
  }
  else
  {
      $mail->SetFrom($fromemail, $name_from);
  }
  $mailcontent = file_get_contents('mail.html');
    $str = <<<EOF
    <html>
<head>
  <title></title>
  <!--[if !mso]><!-- -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
 
  <style type="text/css">
  
    #outlook a {
      padding: 0;
    }

    .ReadMsgBody {
      width: 100%;
    }

    .ExternalClass {
      width: 100%;
    }

    .ExternalClass * {
      line-height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

   

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    p {
      display: block;
      margin: 13px 0;
        text-align: center;
    }
  
  .tborder
  {
     border: 1px solid black;
     padding: 10px;
text-align: center
  }
  



  </style>
  <!--[if !mso]><!-->
  <style type="text/css">
    @media only screen and (max-width:480px) {
      @-ms-viewport {
        width: 320px;
      }
      @viewport {
        width: 320px;
      }
    }
  </style>
  <!--<![endif]-->
  <!--[if mso]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <!--[if lte mso 11]>
<style type="text/css">
  .outlook-group-fix {
    width:100% !important;
  }
</style>
<![endif]-->

  <!--[if !mso]><!-->
  <link href="smtpemail/font/ufont.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    @import url(smtpemail/font/ufont.css);
  </style>
  <!--<![endif]-->
  <style type="text/css">
    @media only screen and (min-width:480px) {
      .mj-column-per-75 {
        width: 75%!important;
      }
      .mj-column-per-100 {
        width: 100%!important;
      }
      .mj-column-per-50 {
        width: 50%!important;
      }
    }
  </style>
</head>

<body>

  <div class="mj-container">
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <table role="presentation" style="font-size:0px;width:100%;" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td>
            <div style="margin:0px auto;max-width:600px;">
              <table role="presentation" style="font-size:0px;width:100%;" border="0" align="center" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:20px;"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="margin:0px auto;max-width:600px;background:#2f323b;">
      <table role="presentation" style="font-size:0px;width:100%;background:#2f323b;" border="0" align="center" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:0px;padding-top:0px;">
              <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:450px;">
      <![endif]-->
              
               <div class="mj-column-per-50 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;padding-right:25px;padding-left:25px;" align="left">
                        <div style="cursor:auto;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;text-align:left;">
                                <p style="color:#fff !important;">Contact Inquiry From  $sitename</p>
                 
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="margin:0px auto;max-width:600px;">
    <br/>
    
    
        
  <table style="width:100%;border: 1px solid black;">
  
      <tr class="tborder">
        <th class="tborder">Name</th>
        <td class="tborder">$fname</td>
      </tr>

      

      <tr class="tborder">
    <th class="tborder">Email</th>
        <td class="tborder">$em</td>
      </tr>
      <tr class="tborder">
        <th class="tborder">Phone</th>
        <td class="tborder">$phone</td>
      </tr>
      <tr class="tborder">
        <th class="tborder">Message</th>
        <td class="tborder">$m</td>
      </tr>
      

  </table>
  <br/>
<center>
<a href="mailto:$em" style="background-color:#449d44;color:#fff;text-decoration:none;font-size:15px;padding:6px;border:#449d44 1px solid;border-radius:5px;">Reply To Inquiry</a></center>
<br/>
     
    </div>
  
    <div style="margin:0px auto;max-width:600px;background:#2f323b;">
      <table role="presentation" style="font-size:0px;width:100%;background:#2f323b;" border="0" align="center" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:0px;padding-top:0px;">
          
              <div class="mj-column-per-50 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;padding-right:25px;padding-left:25px;" align="left">
                        <div style="cursor:auto;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;text-align:left;">
                                   <p align="center"><a href="$company" style="text-decoration: none; color: inherit;">$company</a></p>
                 
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
          
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  
  </div>


</body></html>
EOF;
  file_put_contents("mail2.html",$str);
  $mailcontent  = file_get_contents("mail2.html",$str);
  $mail->Subject = $subject;
  $mail->Body = $mailcontent;
  $mail->isHTML(true);
  try{
      $mail->Send();
    $file = "mail2.html";
        unlink($file);
      return true;
  } catch(Exception $e){
      return false;
    }
}



function BlogSMTPMailSend($to,$subject,$mailcontent,$fromname,$fromemail,$company)
{
  $fname = $_POST['name'];
  
  
  $em = $_POST['email'];
  $comp = $_POST['company1'];
  $m = $_POST['message'];

  
  $sitename =company;
    date_default_timezone_set("Asia/Bangkok");
  include_once('smtpemail/class.phpmailer.php');
  $mail = new PHPMailer(true);
  $fromemail = $from = "no-reply@sologresgranito.com";
  $mail->IsSMTP(); 
  $mail->SMTPAuth = true; 
  $mail->SMTPSecure = "false"; 
  $mail->Host = "mail.sologresgranito.com"; 
  $mail->Port = 587; 
  $mail->Username = $from;
  $mail->Password = "{fTH]hGy7NHO"; 

  $re = '/[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+/';
  preg_match_all($re, $mailcontent, $matches, PREG_SET_ORDER, 0);
    $mail->AddAddress($to, $name);
    if(isset($matches[0][0]) && $matches[0][0] != '')
  {
      $mail->addReplyTo($matches[0][0], $fromname);
      $mail->SetFrom($matches[0][0], $name_from);
  }
  else
  {
      $mail->SetFrom($fromemail, $name_from);
  }
  $mailcontent = file_get_contents('mail.html');
    $str = <<<EOF
    <html>
<head>
  <title></title>
  <!--[if !mso]><!-- -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
 
  <style type="text/css">
  
    #outlook a {
      padding: 0;
    }

    .ReadMsgBody {
      width: 100%;
    }

    .ExternalClass {
      width: 100%;
    }

    .ExternalClass * {
      line-height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

   

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    p {
      display: block;
      margin: 13px 0;
        text-align: center;
    }
  
  .tborder
  {
     border: 1px solid black;
     padding: 10px;
text-align: center
  }
  



  </style>
  <!--[if !mso]><!-->
  <style type="text/css">
    @media only screen and (max-width:480px) {
      @-ms-viewport {
        width: 320px;
      }
      @viewport {
        width: 320px;
      }
    }
  </style>
  <!--<![endif]-->
  <!--[if mso]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <!--[if lte mso 11]>
<style type="text/css">
  .outlook-group-fix {
    width:100% !important;
  }
</style>
<![endif]-->

  <!--[if !mso]><!-->
  <link href="smtpemail/font/ufont.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    @import url(smtpemail/font/ufont.css);
  </style>
  <!--<![endif]-->
  <style type="text/css">
    @media only screen and (min-width:480px) {
      .mj-column-per-75 {
        width: 75%!important;
      }
      .mj-column-per-100 {
        width: 100%!important;
      }
      .mj-column-per-50 {
        width: 50%!important;
      }
    }
  </style>
</head>

<body>

  <div class="mj-container">
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <table role="presentation" style="font-size:0px;width:100%;" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td>
            <div style="margin:0px auto;max-width:600px;">
              <table role="presentation" style="font-size:0px;width:100%;" border="0" align="center" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:20px;"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="margin:0px auto;max-width:600px;background:#2f323b;">
      <table role="presentation" style="font-size:0px;width:100%;background:#2f323b;" border="0" align="center" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:0px;padding-top:0px;">
              <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:450px;">
      <![endif]-->
              
               <div class="mj-column-per-50 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;padding-right:25px;padding-left:25px;" align="left">
                        <div style="cursor:auto;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;text-align:left;">
                                <p style="color:#fff !important;">Contact Inquiry From  $sitename</p>
                 
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="margin:0px auto;max-width:600px;">
    <br/>
    
    
        
  <table style="width:100%;border: 1px solid black;">
  
      <tr class="tborder">
        <th class="tborder">Name</th>
        <td class="tborder">$fname</td>
      </tr>

      

      <tr class="tborder">
    <th class="tborder">Email</th>
        <td class="tborder">$em</td>
      </tr>
      <tr class="tborder">
        <th class="tborder">Company </th>
        <td class="tborder">$comp</td>
      </tr>
      <tr class="tborder">
        <th class="tborder">Message</th>
        <td class="tborder">$m</td>
      </tr>
      

  </table>
  <br/>
<center>
<a href="mailto:$em" style="background-color:#449d44;color:#fff;text-decoration:none;font-size:15px;padding:6px;border:#449d44 1px solid;border-radius:5px;">Reply To Inquiry</a></center>
<br/>
     
    </div>
  
    <div style="margin:0px auto;max-width:600px;background:#2f323b;">
      <table role="presentation" style="font-size:0px;width:100%;background:#2f323b;" border="0" align="center" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:0px;padding-top:0px;">
          
              <div class="mj-column-per-50 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;padding-right:25px;padding-left:25px;" align="left">
                        <div style="cursor:auto;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;text-align:left;">
                                   <p align="center"><a href="$company" style="text-decoration: none; color: inherit;">$company</a></p>
                 
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
          
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  
  </div>


</body></html>
EOF;
  file_put_contents("mail2.html",$str);
  $mailcontent  = file_get_contents("mail2.html",$str);
  $mail->Subject = $subject;
  $mail->Body = $mailcontent;
  $mail->isHTML(true);
  try{
      $mail->Send();
    $file = "mail2.html";
        unlink($file);
      return true;
  } catch(Exception $e){
      return false;
    }
}

