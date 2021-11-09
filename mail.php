<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=1">
  <meta name="description" content="Get your Website & Android Apps made from us at cheapest prices">
  <meta name="author" content="Techno3Gamma">
  <title>Login - Report Submit</title>

  <!-- SEO  -->


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/touch-icon.png" rel="touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS Files -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body style="background:#000;">
<?php

$b = 'techno3gamma@gmail.com';

// include required phpmailer files
require 'includes/PHPMailer.php'; 
require 'includes/SMTP.php'; 
require 'includes/Exception.php'; 
// define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// create instance of phpmailer
$mail = new PHPMailer;
// set mailer to use smtp
$mail->isSMTP();
// Timeout settings
set_time_limit(120); // set the time limit to 120secs
$mail->Timeout = 120; // set timeout to 120s
// define smtp host
$mail->Host = "smtp.hostinger.in";
//  enable smtp authentication
$mail->SMTPAuth = "true";
// set type of encryption (ssl/tsl)
$mail->SMTPSecure = "tls";
// set port to connect smtp
$mail->Port = "587";
// set gmail username
$mail->Username = "connect@quickkmedds.com";
// set gmail password
$mail->Password = "Romonrohan5#";
// set email subect
$mail->Subject = "REPORT TEST MAIL";
// set sender email
$mail->setFrom("connect@quickkmedds.com");
// enable html
$mail->isHTML(true);
//Get the uploaded file information
$name_of_uploaded_file =
    basename($_FILES['uploaded_file']['name']);
//get the file extension of the file
$type_of_uploaded_file =
    substr($name_of_uploaded_file,
    strrpos($name_of_uploaded_file, '.') + 1);
$size_of_uploaded_file =
    $_FILES["uploaded_file"]["size"]/1024;//size in KBs
// copy the temp. uploaded file to uploads folder
$upload_folder = "uploads/";
$path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;
$tmp_path = $_FILES["uploaded_file"]["tmp_name"];
if(is_uploaded_file($tmp_path))
{
  if(!copy($tmp_path,$path_of_uploaded_file))
  {
    $errors .= '\n error while copying the uploaded file';
  }
}
// Attachment
$mail->addAttachment($path_of_uploaded_file);
// email body
$mail->Body = $_POST['Message'].'<br/><br/>From<br/>';
// add recipient
$mail->addAddress("$b");

// send mail
// if ( $mail->Send() ) {
//     echo "Email Sent..!";
// }else{
//     echo "Error...!";
// }
// close smtp connection.
$mail->smtpClose();
?>
<section>
      <div class="container">     
        <div class="row  mt-5">
          <div class="col-lg-6 m-auto">
            <div class="card bg-dark mt-5">
            <div class="section-header mt-3" > 
        <div class="align-centre">
        <h3>
        <?php
                    if ( $mail->Send() ) {
                        
                        echo "Report Submitted..!";
                    }else{
                        echo "Error. Try Again..!";
                    }
                    ?>
        </h3>
        </div>
        </div>
        <div class="m-auto" > 
        <h4>
        <?php echo '<a href="logout.php?logout">Logout</a>';?>
        </h4>
        </div>                 
            </div>
          </div>
        </div>     
    </div>
  </div>
</section>
</body>
</html>