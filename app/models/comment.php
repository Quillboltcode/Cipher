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
    // create comment for question only
    public function createComment($userId, $questionId, $body)
    {
        if (is_null($questionId)) {
            throw new \InvalidArgumentException('Question_id cannot be null');
        }

        $query = 'INSERT INTO Comments (user_id, question_id, body) VALUES (:userId, :questionId, :body)';
        $params = [
            ':userId' => $userId,
            ':questionId' => $questionId,
            ':body' => $body
        ];
        try {
            $this->executeQuery($query, $params);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw new \InvalidArgumentException('Failed to create comment: ' . $e->getMessage());
        }
    }
    public function getCommentByQuestionId($questionId)
    {
        $query = 'SELECT Comments.comment_id, Comments.body, Comments.created_at, Users.username, Users.user_id
                  FROM Comments
                  JOIN Users ON Comments.user_id = Users.user_id
                  WHERE question_id = :questionId';
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