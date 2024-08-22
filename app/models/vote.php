<?php

namespace Models;

use Core\Model;

class Vote extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getUpvotes(int $question_id) {
        // vote_type is enum of upvote or downvote
        $query = "SELECT * FROM votes WHERE question_id = :question_id AND vote_type = 'upvote'";
        $this->db->query($query);
        $this->db->bind(':question_id', $question_id);
        return $this->db->rowCount();
    }


    public function getDownvotes(int $question_id) {
        $query = "SELECT * FROM votes WHERE question_id = :question_id AND vote_type = 'downvote'";
        $this->db->query($query);
        $this->db->bind(':question_id', $question_id);
        return $this->db->rowCount();
    }
    // vote_type is enum of upvote or downvote, check vote_type and question_id existes
    // user can only vote once(check if the user has already voted) if yes do  insert query else update query
    public function vote(int $user_id, int $question_id, string $vote_type) {
        // check if the user voted before
        // if the user has already voted, update the existing vote
        // if not, create a new vote
        $query = "SELECT * FROM cipher.Votes WHERE user_id = :user_id AND question_id = :question_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':question_id', $question_id);

        if ($this->db->rowCount() > 0) {
            // update the existing vote

            $current_vote_type = $this->db->single()->vote_type;
            if ($current_vote_type !== $vote_type) {
                $query = "UPDATE Votes SET vote_type = :vote_type WHERE user_id = :user_id AND question_id = :question_id";
                $this->db->query($query);
                $this->db->bind(':user_id', $user_id);
                $this->db->bind(':question_id', $question_id);
                $this->db->bind(':vote_type', $vote_type);
                $this->db->execute();
            }
        } else {
            // create a new vote
            $query = "INSERT INTO Votes (user_id, question_id, vote_type, created_at) VALUES (:user_id, :question_id, :vote_type, NOW())";
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':question_id', $question_id);
            $this->db->bind(':vote_type', $vote_type);
            $this->db->execute();
        }
    }

    public function voteanswer(int $user_id, int $answer_id, string $vote_type) {
        // check if the user voted before
        // if the user has already voted update the existing vote
        // if not, create a new vote
        error_log($vote_type);
        $query = "SELECT * FROM cipher.Votes WHERE user_id = :user_id AND answer_id = :answer_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':answer_id', $answer_id);
        if ($this->db->rowCount() > 0) {
            // update the existing vote

            $current_vote_type = $this->db->single()->vote_type;
            if ($current_vote_type !== $vote_type) {
                $query = "UPDATE Votes SET vote_type = :vote_type WHERE user_id = :user_id AND answer_id = :answer_id";
                $this->db->query($query);
                $this->db->bind(':user_id', $user_id);
                $this->db->bind(':answer_id', $answer_id);
                $this->db->bind(':vote_type', $vote_type);
                $this->db->execute();
            }
        } else {
            // create a new vote
           
            $query = "INSERT INTO Votes (user_id, answer_id, vote_type, created_at) VALUES (:user_id, :answer_id, :vote_type, NOW())";
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':answer_id', $answer_id);
            $this->db->bind(':vote_type', $vote_type);
            $this->db->execute();
        }
    }



}