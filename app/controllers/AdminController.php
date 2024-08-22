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

    public function edit(int $moduleid){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $module = $this->modulemodel->getModuleById($moduleid);
            // Validate and sanitize form data
            $data = [
                'module_name' => trim($_POST['module_name'] ?? $module->module_name),
                'description' => trim($_POST['description'] ?? $module->description),
            ];
            $this->modulemodel->updateModule($moduleid, $data);
            header('Location: ' . URLROOT . '/admin/index');
        }
    }

    public function createmodule(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and sanitize form data

            $data = [
                'module_name' => trim($_POST['module_name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
            ];
            error_log(print_r($data, true));
            $this->modulemodel->createModule($data);
            header('Location: ' . URLROOT . '/admin/index');
        }
    }

    public function deletemodule(int $moduleid): bool{
        $this->modulemodel->deleteModule($moduleid);
        header('Location: ' . URLROOT . '/admin/index');
        exit;
    }

    public function deletequestion(int $questionId): bool
    {
         $this->questionmodel->deleteQuestion($questionId);
         header('Location: ' . URLROOT . '/admin/index');
         exit;
    }


}
