<?php

use Core\{Controller,Authenticator};
use Models\{Module,Question,Answer};
require_once 'app/models/Module.php';
require_once 'app/models/Question.php';
require_once 'app/models/Answer.php';

class AdminController extends Controller
{
    private $authenticate;
    private $modulemodel;
    private $questionmodel;
    public function __construct()
    {
        $this->authenticate = new Authenticator();
        if (!$this->authenticate->isAdmin()) {

            header('Location: ' . URLROOT . '/user/login');
            die();
        }

        $this->modulemodel = new Module();
        $this->questionmodel = new Question();
        $this->answermodel = new Answer();

    }

    public function index()
    {   

        $modules = $this->modulemodel->getAllMoudules();
        $questions = $this->questionmodel->getAllQuestions();
        
        $data = [
            'modules' => $modules,
            'questions' => $questions,
            
        ];

        $this->view('admin/index', $data);
    }


}
