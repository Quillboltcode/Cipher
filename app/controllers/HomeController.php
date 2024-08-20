<?php

use Core\Controller;
use Models\{Answer,Question,User};
require_once 'app/models/answer.php';
require_once 'app/models/question.php';
require_once 'app/models/user.php';
class HomeController extends Controller
{
    private $questionmodel ;
    private $answermodel;
    private $usermodel;
    public function __construct()
    {
        $this->questionmodel = new Question();
        $this->answermodel = new Answer();
        $this->usermodel = new User();
    }
    public function index()
    {   
        $question_count = $this->questionmodel->countQuestions();
        $answer_count = $this->answermodel->countAnswers();
        $user_count = $this->usermodel->countUsers();
        $data = [
            'title'=> 'Coders Corner',
            'description'=> 'A brief description about StackOverflow and its purpose.',
            'question_count' => $question_count,
            'answer_count' => $answer_count,
            'user_count' => $user_count

        ];

        $this->view('home/index', json_encode($data));
    }

}

?>
