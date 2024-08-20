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

    public function create(int|null $question_id, int|null $answer_id) {
        $user_id = $_SESSION['user_id'];
        $body = $_POST['body'];
        $this->comment->createComment($user_id, $question_id, $answer_id, $body);
        header('Location: /question/' . $question_id);
    }
}
