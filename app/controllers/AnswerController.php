<?php

use Core\Controller;
use Models\Answer;
require_once 'app/models/answer.php';
class AnswerController extends Controller {
    private object $answermodel;
    public function __construct() {
        $this->answermodel = new Answer();
    }

    public function index() {
        $this->view('answer/index');
    }
    // Create a new answer based on the question id
    //redirects to the question page after finishing
    public function create($question_id) 
    {           
        $this->view('answer/create', ['question_id' => $question_id]);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $answer_id = $this->answermodel->addQuestionAnswer($question_id, $_SESSION['user_id'], $_POST['content']);
            
            header('Location: ' . URLROOT . '/question/show/' . $question_id);
        }
    }

    public function vote($answer_id) {
        $this->view('answer/vote');
    }
}

