<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer"s autoloader
// require "vendor/autoload.php";
require_once("./includes/vendor/PHPMailer/PHPMailer.php");
require_once("./includes/vendor/PHPMailer/SMTP.php");
require_once("./includes/vendor/PHPMailer/Exception.php");
require_once ("./includes/conn/conn.php");



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
    // $mail->addAttachment($attachmentFile);
    //Content
    $mail->Subject = $mailSubject;
    $mail->setFrom("noreply@bulksys.ml");
    $mail->isHTML(true);                                  //Set email format to HTML
    //Get the uploaded file information

    
    // att strt



    // att end
    $mail->Body = "Hey, ".$recipient_fullname."<br>".$message;
    $mail->addAddress($recipient_email, $recipient_fullname);     //Add a recipient
    // $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    $mail->smtpClose();

    $mail->send();
    echo "Mail sent to : " . $recipient_email ."<br>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}