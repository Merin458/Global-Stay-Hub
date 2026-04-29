<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include PHPMailer autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// Create a new PHPMailer instance
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // SMTP server address
    $mail->SMTPAuth   = true;                // Enable SMTP authentication
    $mail->Username   = 'globalstayhub5833@gmail.com';  // SMTP username
    $mail->Password   = 'grvz huen wecs bruh';     // SMTP password
    $mail->SMTPSecure = 'ssl';               // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                 // TCP port to connect to
    // Sender and recipient details
    $mail->setFrom('globalstayhub5833@gmail.com');
    $mail->addAddress($mailtoaddress);
    // Email subject and body
    $mail->Subject = ' Successful Login to Your Global Stay Hub Account ';


    $mail->Body    = $bodyContent;
    // Optional: Add attachments
   // $mail->addAttachment('/path/to/file.pdf');
    // Send the email
    $mail->send();
    echo"<script> alert('Registered Successfully'); window.location='guestindex.php';</script>";
} catch (Exception $e) {
    echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
}
?>
