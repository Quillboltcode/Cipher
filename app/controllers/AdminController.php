<?php

use Core\{Controller,Authenticator};

class AdminController extends Controller
{
    private $authenticate;

    public function __construct()
    {
        $this->authenticate = new Authenticator();
        if (!$this->authenticate->isAdmin()) {
            die("You are not admin");
            header(URLROOT.'user/login');
        }
    }

    public function index()
    {
        $this->view('view/index');
    }


}
