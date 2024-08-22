<?php

use Core\{Controller, Authenticator, Validator};

use Models\{Answer, Vote};
require_once 'app/models/answer.php';
require_once 'app/models/vote.php';
class AnswerController extends Controller {
    private  $answermodel;
    private $votemodel;
    private $auth;
    public function __construct() {
        $this->answermodel = new Answer();
        $this->votemodel = new Vote();
        $this->auth = new Authenticator();
    }
    // There should not be any index method for this controller
    // public function index() {
    //     $this->view('answer/index');
    // }
    // Create a new answer based on the question id
    //redirects to the question page after finishing
    public function create($question_id) 
    {   
        // TODO: check if user is logged in
        if (!$this->auth->isLoggedIn()) {
            header('Location: ' . URLROOT . '/user/login');
            exit;
        }        
        $this->view('answer/create', ['question_id' => $question_id]);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $answer_id = $this->answermodel->addQuestionAnswer($question_id, $_SESSION['user_id'], $_POST['content']);
            
            header('Location: ' . URLROOT . '/question/show/' . $question_id);
        }
    }

    public function vote($answer_id) {
        // TODO: check if user is logged in
        if (!$this->auth->isLoggedIn()) {
            header('Location: ' . URLROOT . '/user/login');
            exit;
        }
        error_log(print_r($_POST, true));
        $this->votemodel->voteanswer($_SESSION['user_id'], $answer_id, $_POST['vote_type']);
        $question_id = $this->answermodel->getAnswerById($answer_id)->question_id;
        header('Location: ' . URLROOT . '/question/show/' . $question_id);
        exit;
    }
}

