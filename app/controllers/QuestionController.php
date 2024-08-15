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
    public function create() {
        if (!$this->authenticate->isLoggedIn()) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and sanitize form data
            $errors = [];
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'image_path' => '',
            ];

            if (empty($data['title'])) {
                $errors['title'] = 'Title is required';
            }
            if (empty($data['body'])) {
                $errors['body'] = 'Body is required';
            }

            if (!empty($_FILES['image_path']['name'])) {
                // Limit image upload to 1 file
                if (count($_FILES['image_path']['name']) > 1) {
                    $errors['image_path'] = 'You can only upload 1 image';
                }

                // Validate image file
                $target_dir = 'public/images/';
                $target_file = $target_dir . time() . $_SESSION['user_id'] . '_' . basename($_FILES['image_path']['name'][0]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $check = getimagesize($_FILES['image_path']['tmp_name'][0]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $errors['image_path'] = 'Not an image file';
                    $uploadOk = 0;
                }
                if (file_exists($target_file)) {
                    $errors['image_path'] = 'Image already exists';
                    $uploadOk = 0;
                }
                if ($_FILES['image_path']['size'][0] > 500000) {
                    $errors['image_path'] = 'Image size exceeds 500KB';
                    $uploadOk = 0;
                }
                if(!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                    $errors['image_path'] = 'Invalid image format';
                    $uploadOk = 0;
                }

                // Upload image file
                if (empty($errors['image_path'])) {
                    if (move_uploaded_file($_FILES['image_path']['tmp_name'][0], $target_file)) {
                        $data['image_path'] = $target_file;
                    } else {
                        $errors['image_path'] = 'Error uploading image';
                    }
                }
            }

            // Redirect back if there are errors
            if (!empty($errors)) {
                $this->view('question/create', [
                    'errors' => $errors,
                    'data' => $data,
                ]);
                return;
            }

            // Create question
            $this->questionmodel->createQuestion($data);
            header('Location: ' . URLROOT . '/questions');
            exit;
        }

        $this->view('question/create');
    }

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