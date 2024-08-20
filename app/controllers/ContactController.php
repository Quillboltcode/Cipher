<?php
use Core\Controller;
use Models\Contact;
require_once 'app/models/Contact.php';
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';
include 'vendor/phpmailer/phpmailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // Path to Composer's autoload.php

$mail = new PHPMailer(true);
class ContactController extends Controller
{   
    private $contactmodel;
    public $errors = [];
    public function __construct(){

        $this->contactmodel = new Contact();
    }

    public function index()
    {


        $this->view('contact/index');
    }

    // send mail using PHPMailer
    // with form data of email, subject, message
    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true;

                $mail->Username = 'minhhtgch230186@fpt.edu.vn';                     //SMTP username
                $mail->Password = PHP_MAILER;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587; // TCP port to connect to

                //Recipients
                $mail->setFrom($_POST['email'], $_SESSION['username']);
                $mail->addAddress('minhhtgch230186@fpt.edu.vn'); // Add a recipient

                // Content
                $mail->isHTML(true);
                $mail->Subject = $_POST['subject'];
                $mail->Body = $_POST['message'];
                $mail->AltBody = $_POST['message'];

                $mail->send();
                // Save email to database with array of $_POST
                $this->errors['database'] = $this->contactmodel->saveEmail(['user_id' => $_SESSION['user_id'],'email' => $_POST['email'], 'subject' => $_POST['subject'], 'message' => $_POST['message']]);
                $this->errors['success'] = 'Message has been sent';
            } catch (Exception $e) {
                // redirect to error page
                header('Location: ' . URLROOT . '/contact/error');
                $this->errors['error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }

    public function error()
    {
        $this->view('contact/error', $this->errors);
    }
}