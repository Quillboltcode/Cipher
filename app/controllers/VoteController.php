<?php

use Core\Controller;
use Models\Vote;
require_once 'app/models/vote.php';

class VoteController extends Controller
{   private $vote;
    public function __construct()
    {
        $this->vote = new Vote();
    }
    public function index()
    {
        // handle json vote request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $user_id = $data['user_id'];
            $question_id = $data['question_id'];
            $vote_type = $data['vote_type'];
            $this->vote->vote($user_id, $question_id, $vote_type);
            $this->view('question/show/'.$data['question_id']);
            echo json_encode(['success' => true]);
            return;
        }
        else {
            $this->view('404');
        }
    }
}   