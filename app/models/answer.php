<?php
namespace Models;
use Core\Model;
class Answer extends Model {
    public $table_name = 'Answers';

    public function __construct() {
        parent::__construct();
    }

    public function getAnswerByQuestionID($questionID) {
        $query = '
            SELECT 
                Answers.answer_id, 
                Answers.question_id, 
                Answers.user_id, 
                Answers.body, 
                Answers.created_at, 
                Answers.updated_at, 
                Users.username, 
                (
                    SELECT 
                        COUNT(*) 
                    FROM 
                        Comments 
                    WHERE 
                        Comments.answer_id = Answers.answer_id
                ) AS comment_count, 
                (
                    SELECT 
                        COUNT(*) 
                    FROM 
                        Votes 
                    WHERE 
                        Votes.answer_id = Answers.answer_id
                ) AS vote_count 
            FROM 
                Answers 
            JOIN 
                Users ON Answers.user_id = Users.user_id 
            WHERE 
                Answers.question_id = :questionID
        ';
        $params = [':questionID' => $questionID];
        return $this->getAll($query, $params);
    }

    public function addQuestionAnswer($questionID, $userID, $body) {
        $query = 'INSERT INTO Answers (question_id, user_id, body) VALUES (:questionID, :userID, :body)';
        $params = [':questionID' => $questionID, ':userID' => $userID, ':body' => $body];
        return $this->executeQuery($query, $params);
    }

    public function updateAnswer($answerID, $body) {
        $query = 'UPDATE Answers SET body = :body WHERE answer_id = :answerID';
        $params = [':answerID' => $answerID, ':body' => $body];
        return $this->executeQuery($query, $params);
    }

    public function deleteAnswer($answerID) {
        $query = 'DELETE FROM Answers WHERE answer_id = :answerID';
        $params = [':answerID' => $answerID];
        return $this->executeQuery($query, $params);
    }

    public function getAnswerByID($answerID) {
        $query = 'SELECT * FROM Answers WHERE answer_id = :answerID';
        $params = [':answerID' => $answerID];
        return $this->getSingle($query, $params);
    }

    
}