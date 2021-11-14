<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// error_reporting(0);


//Load Composer"s autoloader
// require "vendor/autoload.php";
require_once("./includes/vendor/PHPMailer/PHPMailer.php");
require_once("./includes/vendor/PHPMailer/SMTP.php");
require_once("./includes/vendor/PHPMailer/Exception.php");
require_once ("./includes/conn/conn.php");

$conn = dbConnection();

$mailSubject = $_POST['subject'];
$message = $_POST['email-message'];
$usr = $_POST['user_id'];
$auth =$_POST['user_pass'];


$fetch_users_sql = "SELECT * FROM recipients";
$fetch_result = mysqli_query($conn, $fetch_users_sql);

while ($user = mysqli_fetch_assoc($fetch_result)) {
    sendEmail($user['email'], $user['name'], $message, $mailSubject, $usr, $auth);
}

function sendEmail($recipient_email, $recipient_fullname, $message, $mailSubject, $usr, $auth){

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
    $mail->Username   = $usr;                     //SMTP username
    $mail->Password   = $auth;                               //SMTP password
    
    PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                      //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    

    
    // $mail->addAddress("ellen@example.com");               //Name is optional
    // $mail->addReplyTo("info@example.com", "Information");
    // $mail->addCC("cc@example.com");
    // $mail->addBCC("bcc@example.com");
    $mail->Subject = $mailSubject;
    $mail->setFrom($usr);

// Count the number of uploaded files in array
    $total_count = count($_FILES['attachments']['name']);
        for($i=0; $i < $total_count; $i++){
            $file_tmp = $_FILES['attachments']['tmp_name'][$i];
            $file_name = $_FILES['attachments']['name'][$i];
            move_uploaded_file($file_tmp, "attachments/" . $file_name);
            $mail->addAttachment("attachments/" . $file_name);
        }
    $mail->isHTML(true); //Set email format to HTML

    $mail->Body = "Hey, ".$recipient_fullname."<br>".$message;
    $mail->addAddress($recipient_email, $recipient_fullname);     //Add a recipient
    $mail->smtpClose();
    $mail->send();
    print "Mail sent to : " . $recipient_email ."<br>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>