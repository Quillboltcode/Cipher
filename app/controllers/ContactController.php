<?php
use Core\Controller;

class ContactController extends Controller
{

    public function index()
    {
        $this->view('contact/index');
    }

    // send mail using PHPMailer
    public function send(){
        
    }

    


}