<?php
use Core\Controller;

class ContactController extends Controller
{

    public function index()
    {
        $this->render('contact/index');
    }

    // Send mail function as post request using mail() in php
    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            if (!empty($name) && !empty($email) && !empty($message)) {
                $headers = "From: $email\r\n";
                $headers .= "Reply-To: $email\r\n";
                $headers .= "Content-Type: text/html; charset=utf-8\r\n";   

                $body = "Name: $name\n";
                $body .= "Email: $email\n";
                $body .= "Message: $message\n";
            }
            mail('minhhtgch230186@fpt.edu.vn', 'Contact Form', $body, $headers);
                }

    }
    


}