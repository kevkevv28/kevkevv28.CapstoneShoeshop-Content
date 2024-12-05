<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

if(isset($_POST['submitContact'])){


$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'dljpsfootwearshop2@gmail.com';                     //SMTP username
    $mail->Password   = '';                               //SMTP password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('dljpsfootwearshop2@gmail.com', 'Mailer');
    $mail->addAddress('dljpsfootwearshop2@gmail.com', 'Joe User');     //Add a recipient



    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New Enquiry - Dljps Website Contact Form';
    $mail->Body    = '<h3> Hello you got a new Message </h3>
        <h4>Fullname: '. $name .'</h4>
        <h4>Email: '. $email .' </h4>
        <h4>Subject: '. $subject .' </h4>
        <h4>Message: '. $message .' </h4>
    
    
    ';


    if($mail->send()){
        $_SESSION['statusemail'] = "Our team will try to resolve your inquiry ASAP - DLJPS TEAM";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }else{
        $_SESSION['statusemail'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }
    
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}else{
    header('Location: ../contactUs.php');
}
