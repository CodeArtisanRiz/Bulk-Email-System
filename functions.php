<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
error_reporting(0);


//Load Composer"s autoloader
// require "vendor/autoload.php";
require_once("./includes/vendor/PHPMailer/PHPMailer.php");
require_once("./includes/vendor/PHPMailer/SMTP.php");
require_once("./includes/vendor/PHPMailer/Exception.php");
require_once ("./includes/conn/conn.php");

$conn = dbConnection();

$mailSubject = $_POST['subject'];
$message = $_POST['email-message'];



$fetch_users_sql = "SELECT * FROM recipients";
$fetch_result = mysqli_query($conn, $fetch_users_sql);

while ($user = mysqli_fetch_assoc($fetch_result)) {
    sendEmail($user['email'], $user['name'], $message, $mailSubject);
}

function sendEmail($recipient_email, $recipient_fullname, $message, $mailSubject){

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();
    // set_time_limit(120); // set the time limit to 120secs
    $mail->Timeout = 120; // set timeout to 120s                                         //Send using SMTP
    $mail->Host       = "smtp.hostinger.in";                     //Set the SMTP server to send through
    $mail->SMTPAuth   = "true";
    $mail->SMTPSecure = "tls";
    $mail->Port       = "587";                                   //Enable SMTP authentication
    $mail->Username   = "noreply@bulksys.ml";                     //SMTP username
    $mail->Password   = "Brainkraft1@";                               //SMTP password
    
    // PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                      //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    

    
    // $mail->addAddress("ellen@example.com");               //Name is optional
    // $mail->addReplyTo("info@example.com", "Information");
    // $mail->addCC("cc@example.com");
    // $mail->addBCC("bcc@example.com");

    //Attachments
    // $mail->addAttachment("/var/tmp/file.tar.gz");         //Add attachments
    // $mail->addAttachment("/tmp/image.jpg", "new.jpg");    //Optional name
    // $mail->addAttachment($uploadfile, $filename);
    //Content
    $mail->Subject = $mailSubject;
    $mail->setFrom("noreply@bulksys.ml");
    $mail->isHTML(true);                                  //Set email format to HTML
    //Get the uploaded file information

    
    // att strt

$name_of_uploaded_file =
    basename($_FILES['uploaded_file']['name']);
//get the file extension of the file
$type_of_uploaded_file =
    substr($name_of_uploaded_file,
    strrpos($name_of_uploaded_file, '.') + 1);
$size_of_uploaded_file =
    $_FILES["uploaded_file"]["size"]/1024;//size in KBs

$files = array_filter($_FILES['upload']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count = count($_FILES['upload']['name']);
// Loop through every file
for( $i=0 ; $i < $total_count ; $i++ ) {
   //The temp file path is obtained
   $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
   //A file path needs to be present
   if ($tmpFilePath != ""){
      //Setup our new file path
      $newFilePath = "./uploads/" . $_FILES['upload']['name'][$i];
      //File is uploaded to temp dir
      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
         //Other code goes here
        //  $mail->addAttachment($newFilePath);
        // $newDocFileWithPath = $newFilePath;
        
      }
   }
}

    // att end
    $mail->Body = "Hey, ".$recipient_fullname."<br>".$message;
    $mail->addAddress($recipient_email, $recipient_fullname);     //Add a recipient
    // $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    if($newFilePath !=null){
    $mail->addAttachment($newFilePath);
    }else{
        print '';
    }
    $mail->smtpClose();

    $mail->send();
    echo "Mail sent to : " . $recipient_email ."<br>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}