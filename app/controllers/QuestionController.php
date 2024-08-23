<?php

use Core\{Controller, Authenticator};
use Models\{
    Question,
    Answer,
    Comment,
    Module,
    Vote,
};
// use CommentController;
require_once 'app/models/question.php';
require_once 'app/models/answer.php';
require_once 'app/models/comment.php';
require_once 'app/models/module.php';
require_once 'app/models/vote.php';
require_once 'app/controllers/CommentController.php';
class QuestionController extends Controller
{

    private $questionmodel;
    private $answermodel;
    private $commentmodel;
    private $authenticate;
    private $modulesmodel;
    private $votemodel;
    private $CommentController;
    public function __construct()
    {
        $this->questionmodel = new Question();
        $this->answermodel = new Answer();
        $this->commentmodel = new Comment();
        $this->authenticate = new Authenticator();
        $this->modulesmodel = new Module();
        $this->votemodel = new Vote();
        $this->CommentController = new CommentController();
    }

    public function index($page = 1, $limit = 5)
    {
        // $offset = ($page - 1) * $limit;
        $questions = $this->questionmodel->getAllQuestions($page, $limit);
        $questions_count = $this->questionmodel->countQuestions()->count;
        $data = [
            'title' => 'Questions Listing',
            'questions' => $questions ?? [],
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total_page' => ceil($questions_count / $limit),
            ]
            // 'timediff' => $timediff,
        ];
        $this->view('question/index', $data);
    }
    public function create()
    {
        if (!$this->authenticate->isLoggedIn()) {
            header('Location: ' . URLROOT . '/user/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and sanitize form data
            $data = [
                'title' => trim($_POST['title'] ?? ''),
                'body' => trim($_POST['body'] ?? ''),
                'user_id' => $_SESSION['user_id'] ?? 0,
                'image_path' => $_FILES["image_path"] ?? '',
            ];

            // Check for required fields
            if (empty($data['title']) || empty($data['body'])) {
                header('Location: ' . URLROOT . '/question/create');
                exit;
            }
            // handle image upload
            if (!empty($_FILES['image_path'])) {
                $file = $_FILES['image_path'];
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];
                $fileType = $file['type'];
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg', 'jpeg', 'png');
                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        // Limit file size to 6MB with ratio of 1920*1080 RGB color 24 bit color, 3 bit per pixel
                        // Source https://stackoverflow.com/questions/63464736/image-maximum-file-size-based-on-image-dimension
                        if ($fileSize < 6000000) {
                            // Create unique file name based on timestamp
                            // This could be a problem if multiple people upload the same image at the same time
                            // This coudld be abused to upload malicious files
                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                            $fileDestination = UPLOAD_DOCUMENTS . $fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);
                            $data['image_path'] = $fileNameNew;
                        }
                    }
                }
            }
            try {
                // Create question
                $question_id = $this->questionmodel->createQuestion($data);
                $this->modulesmodel->createQuestionModule($question_id, $_POST['module_names']);
            } catch (\Exception $e) {
                // Handle any exceptions that may occur
                die($e->getMessage());
            }

            header('Location: ' . URLROOT . '/question');
            exit;
        }
        $data['module'] = json_decode(json_encode($this->modulesmodel->getModules()), true);
        $this->view('question/create', $data);
    }

    public function show(int $questionId)
    {

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

    public function edit(int $questionId)
    {
        //validate if user logged in
        // redirect to login if not
        if (!$this->authenticate->isLoggedIn()) {
            header('Location: ' . URLROOT . '/user/login');
            exit;
        }
        $question = $this->questionmodel->getQuestionById($questionId);
        $question_array = json_decode(json_encode($question), true);
        // validate if user owns the question
        if ($question_array['user_id'] != $_SESSION['user_id']) {
            $this->view('403');
            exit;
        }
        // convert module to array
        $module = $this->modulesmodel->getModules();
        $module_array = json_decode(json_encode($module), true);
        // Display edit form
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = [
                'id' => $questionId,
                'title' => $question_array['title'],
                'body' => $question_array['body'],
                'module' => $module_array,
            ];
            $this->view('question/edit', $data);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => ($_POST['title']),
                'body' => ($_POST['body']),
                'image_path' => $_FILES['image_path']??'',
            ];

            if (empty($data['title'])) {
                $errors[] = 'Title is required';
            }
            if (empty($data['body'])) {
                $errors[] = 'Body is required';
            }
            if (count($errors) > 0) {
                $data['errors'] = $errors;
                $this->view('question/edit', $data);
                exit;
            }
            error_log(print_r($_FILES, true));
            if (!empty($_FILES['image_path']['name'])) {
                $file = $_FILES['image_path'];
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];
                $fileType = $file['type'];
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png','JPG', 'JPEG', 'PNG'); // Add more extensions as needed

                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < 5000000) {
                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                            $fileDestination = UPLOAD_DOCUMENTS . $fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);
                            $data['image_path'] = $fileNameNew;
                        }
                    }
                }
            }

            $this->questionmodel->updateQuestion($questionId, $data);
            // if not emty modules then update
            if (!empty($_POST['module_names'])) {
                $this->modulesmodel->updateQuestionModule($questionId, $_POST['module_names']);
            }
            
            header('Location: ' . URLROOT . '/question/show/' . $questionId);
            exit;

        }
    }

    public function delete(int $questionId)
    {
        //validate if user logged in
        // redirect to login if not
        if (!$this->authenticate->isLoggedIn()) {
            header('Location: ' . URLROOT . '/user/login');
            exit;
        }
        $question = $this->questionmodel->getQuestionById($questionId);
        $question_array = json_decode(json_encode($question), true);
        // validate if user owns the question
        if ($question_array['user_id'] != $_SESSION['user_id']) {
            $this->view('403');
            exit;
        }
        $this->questionmodel->deleteQuestion($questionId);
        header('Location: ' . URLROOT . '/question');
        exit;
    }

    public function vote(int $questionId)
    {
        $this->votemodel->vote($_SESSION['user_id'], $questionId, $_POST['vote_type']);
        header('Location: ' . URLROOT . '/question/show/' . $questionId);
        exit;
    }


    public function comment(int $questionId)
    {
        $this->CommentController->create($questionId);

        header('Location: ' . URLROOT . '/question/show/' . $questionId);
        exit;
    }

    public function search($page = 1, $limit = 5)
    {
        $search = $_GET['search'] ?? '';
        if (empty($search)) {
            header('Location: ' . URLROOT . '/question');
            exit;
        }
        if (strlen($search)<4) {
            $this->view('question/notfound', ['search' => 'Please enter at least 3 or more characters']);
            exit;
        }
        // unwrap array of result

        $result = $this->questionmodel->searchQuestions($search);
        // error_log(print_r($result, true));
        // notfound 
        if (empty($result['question'])) {
            $this->view('question/notfound', ['search' => $search]);
            exit;
        }
        $question = $result['question'];
        $questions_count = count($question);


        $data = [
            'title' => 'Search Results',
            'questions' => $question,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total_page' => ceil($questions_count / $limit)
            ]
        ];
        $this->view('question/index', $data);
    }

}