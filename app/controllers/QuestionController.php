<?php

use Core\{Controller,Authenticator};
use Models\{Question,
Answer,
Comment,
};
require_once 'app/models/question.php';
require_once 'app/models/answer.php';
require_once 'app/models/comment.php';

class QuestionController extends Controller{

    private $questionmodel;
    private $answermodel;
    private $commentmodel;
    private $authenticate;
    public function __construct() {
        $this->questionmodel = new Question();
        $this->answermodel = new Answer();
        $this->commentmodel = new Comment();
        $this->authenticate = new Authenticator();
    }

    public function index() {
        $questions = $this->questionmodel->getAllQuestions();
        // $timediff = $this->questionmodel->timeDiffForDisplay();
        $data = [
            'title' => 'Questions Listing',
            'questions' => $questions ?? [],
            // 'timediff' => $timediff,
        ];
        $this->view('question/index', $data);
    }
<<<<<<<<<<<<<<  ✨ Codeium Command 🌟 >>>>>>>>>>>>>>>>
    //todo handle fileupload to folder image/ and rename it to CurrentTime+user_id
    public function create() {
        if (!$this->authenticate->isLoggedIn()) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image_path = '';
            if(!empty($_FILES['image_path']['name'])) {
                $target_dir = 'public/images/';
                $target_file = $target_dir . time() . $_SESSION['user_id'] . '_' . basename($_FILES['image_path']['name']);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $check = getimagesize($_FILES['image_path']['tmp_name']);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
                if (file_exists($target_file)) {
                    $uploadOk = 0;
                }
                if ($_FILES['image_path']['size'] > 500000) {
                    $uploadOk = 0;
                }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES['image_path']['tmp_name'], $target_file)) {
                        $image_path = $target_file;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
            $question = [
                'title' => $_POST['title'],
                'body' => $_POST['body'],
                'user_id' => $_SESSION['user_id'],
                'image_path' => $image_path,
                'image_path' => $_POST['image_path'],
            ];
            $this->questionmodel->createQuestion($question);
            header('Location: ' . URLROOT . '/questions');
            exit;
        }
        $this->view('question/create', [
            
        ]);

    }
<<<<<<<  4a7922e5-001a-4070-84ef-8db508eeae1f  >>>>>>>

    public function show(int $questionId) {

        $question = $this->questionmodel->getQuestionById($questionId);
        // Check if the question ID is valid
        if (empty($question)) {
            $this->view('404');
            return;
        }
        $question_votecount = 
        // Get all answer related to the question
        $answer = $this->answermodel->getAnswerByQuestionID($questionId);

        // Get all comments related to the question
        $comment = $this->commentmodel->getCommentByQuestionId($questionId);

        $data = [
            'title' => 'Question Details',
            'question' => $question,
            'answer' => $answer,
            'comment' => $comment,
        ];

        $this->view('question/show', $data);
    }


}