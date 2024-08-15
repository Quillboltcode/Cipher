<?php
use Core\{Controller,Authenticator};


class AdminController extends Controller{
    private $authenticate;

    public function __construct(){
        $this->authenticate = new Authenticator();
    }
}