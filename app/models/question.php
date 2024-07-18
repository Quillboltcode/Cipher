<?php

use \Core\Model;
class Question extends Model {
    
    private $tablename = 'Questions';
    public function __construct() {
        parent::__construct();
        $this->tablename = $this->tablename;
    }

    public function getAllQuestions() {
        $query = 'SELECT * FROM this->tablename';
        return $this->getAll($query);
    }

    /**
     * Get a question by its ID.
     *
     * @param int $questionId The ID of the question.
     * @return array The question data.
     */
    public function getQuestionById(int $questionId): object | null {
        $query = 'SELECT * FROM Questions WHERE question_id = :questionId';
        $params = [':questionId' => $questionId];
        return $this->getSingle($query, $params);
    }

    /**
     * Create a new question in the database.
     *
     * @param int $userId The ID of the user who created the question.
     * @param string $title The title of the question.
     * @param string $body The body of the question.
     * @param string|null $imagePath The path to the image associated with the question.
     *
     * @return bool Whether the question was created successfully.
     */
    public function createQuestion(int $userId, string $title, string $body, ?string $imagePath): bool
    {
        if (is_null($userId) || is_null($title) || is_null($body)) {
            throw new \InvalidArgumentException('Missing required parameters for creating a question');
        }

        $query = 'INSERT INTO Questions (user_id, title, body, image_path) VALUES (:userId, :title, :body, :imagePath)';
        $params = [
            ':userId' => $userId,
            ':title' => $title,
            ':body' => $body,
            ':imagePath' => $imagePath ?? '',
        ];

        try {
            $this->executeQuery($query, $params);
            return true;
        } catch (\PDOException $e) {
            throw new \InvalidArgumentException('Failed to create question: ' . $e->getMessage());
        }
    }


    
}
