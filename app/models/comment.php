<?php
namespace Models;
use Core\Model;

class Comment extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllComments()
    {
        $query = 'SELECT * FROM Comments';
        return $this->getAll($query);
    }

    public function getCommentById($id)
    {
        $query = 'SELECT * FROM Comments WHERE id = :id';
        return $this->getSingle($query, ['id' => $id]);
    }

    public function createComment($userId, $questionId, $body)
    {
        $query = 'INSERT INTO Comments (user_id, question_id, body) VALUES (:userId, :questionId, :body)';
        $params = [
            ':userId' => $userId,
            ':questionId' => $questionId,
            ':body' => $body
        ];
        $this->executeQuery($query, $params);
    }

    public function getCommentByQuestionId($questionId)
    {
        $query = 'SELECT * FROM Comments WHERE question_id = :questionId';
        return $this->getAll($query, ['questionId' => $questionId]);
    }

    public function getCommentByAnswerIds(array $answerIds) {
        $placeholders = implode(',', array_fill(0, count($answerIds), '?'));
        $query = "SELECT * FROM Comments WHERE answer_id IN ($placeholders)";
        return $this->getAll($query, $answerIds);
    }

    public function updateComment($id, $body)
    {
        $query = 'UPDATE Comments SET body = :body WHERE id = :id';
        $params = [
            ':body' => $body,
            ':id' => $id
        ];
        $this->executeQuery($query, $params);
    }

    public function deleteComment($id)
    {
        $query = 'DELETE FROM Comments WHERE id = :id';
        $this->executeQuery($query, ['id' => $id]);
    }

    
}