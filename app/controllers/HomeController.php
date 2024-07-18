<?php
use Core\Controller;
class HomeController extends Controller
{
    
    public function index()
    {
        $data = [
            'title'=> 'Coders Corner',
            'description'=> 'A brief description about StackOverflow and its purpose.',
        ];

        $this->view('home/index', $data);
    }

}
