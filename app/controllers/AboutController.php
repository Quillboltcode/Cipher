<?php
use Core\Controller;

class AboutController extends Controller
{
    public function index()
    {   $data=[
        'email'=> EMAIL
    ];
        $this->view('about/index',$data);
    }
}


