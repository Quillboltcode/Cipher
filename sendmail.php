
<?php

require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';
include 'vendor/phpmailer/phpmailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // Path to Composer's autoload.php

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;
    
	$mail->Username   = 'minhhtgch230186@fpt.edu.vn';                     //SMTP username
    $mail->Password   = 'yrwa zhjm qfdb apqg';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port       = 587; // TCP port to connect to

    //Recipients
    $mail->setFrom('minhhtgch230186@fpt.edu.vn', 'Mailer');
    $mail->addAddress('minhhtgch230186@fpt.edu.vn', 'Joe User'); // Add a recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a <b>test email</b> sent using PHPMailer!';
    $mail->AltBody = 'This is a test email sent using PHPMailer!';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
