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
    // create comment for question or answer
    // answer_id  and canbe null and question_id can be null but not both at the same time
    // there cannot be both value of answer_id and question_id
    public function createComment($userId, $questionId, $answer_id, $body)
    {
        if (!is_null($questionId) && !is_null($answer_id)) {
            throw new \InvalidArgumentException('Cannot have both question_id and answer_id present in a comment');
        }

        if (is_null($questionId) && is_null($answer_id)) {
            throw new \InvalidArgumentException('Question_id and answer_id cannot both be null');
        }

        $query = 'INSERT INTO Comments (user_id, question_id, answer_id, body) VALUES (:userId, :questionId, :answer_id, :body)';
        $params = [
            ':userId' => $userId,
            ':questionId' => $questionId,
            ':answer_id' => $answer_id,
            ':body' => $body
        ];
        try {
            $this->executeQuery($query, $params);
        } catch (\PDOException $e) {
            throw new \InvalidArgumentException('Failed to create comment: ' . $e->getMessage());
        }
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