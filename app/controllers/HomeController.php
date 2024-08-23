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
            'description'=> 'A brief description about Cipher and its purpose.<br>
            Q&A Forum: Ask questions related to programming, software development, and technology, and get answers from experienced professionals and peers.<br>
Community Engagement: Interact with other users through comments, discussions, and sharing of knowledge.<br>
Resource Sharing: Share and discover valuable resources, such as tutorials, articles, and code snippets.
User Profiles: Create a profile to showcase your skills, experience, and achievements, and connect with others who share similar interests.
            ',
            'question_count' => $question_count,
            'answer_count' => $answer_count,
            'user_count' => $user_count

        ];

        $this->view('home/index', json_encode($data));
    }

}

?>
