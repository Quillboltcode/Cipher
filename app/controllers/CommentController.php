<?php

use Core\Controller;
use Models\Comment;
require_once 'app/models/comment.php';

class CommentController extends Controller
{
    private $comment;
    public function __construct(){
        $this->comment = new Comment();
    }
    // create question comment or answer comment
    public function create(int $question_id) {
        $this->view('comment/create', ['question_id' => $question_id]);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->comment->createComment($_SESSION['user_id'], $question_id, $_POST['content']);
            header('Location: ' . URLROOT . '/question/show/' . $question_id);
            exit;
        }
    }
}
