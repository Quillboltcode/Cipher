<?php
namespace Models;
use Core\Model;
class Question extends Model {
    

    public function __construct() {
        parent::__construct();
       

    }

    public function getAllQuestions(int $page = 1, int $questionsPerPage = 10) {
        // Select all questions from the Questions table
        // Join with the Users table to get the username of the user who posted the question and the vote count of each upvote and downvote of the question
        // Get the module name from the Modules table 
        // Paginate the results

        $offset = ($page - 1) * $questionsPerPage;

        $query = '
            SELECT 
                Questions.question_id, 
                Questions.user_id, 
                Questions.title, 
                Questions.body, 
                Questions.image_path, 
                Questions.created_at, 
                Questions.updated_at, 
                Users.username, 
                (
                    SELECT 
                        COUNT(*) 
                    FROM 
                        Votes 
                    WHERE 
                        Votes.question_id = Questions.question_id
                        AND Votes.vote_type = "upvote"
                ) AS upvotes,
                (
                    SELECT 
                        COUNT(*) 
                    FROM 
                        Votes 
                    WHERE 
                        Votes.question_id = Questions.question_id AND Votes.vote_type = "downvote"
                ) AS downvotes,
                (
                    SELECT 
                        GROUP_CONCAT(Modules.module_name SEPARATOR ", ") 
                    FROM 
                        QuestionModules 
                    LEFT JOIN 
                        Modules ON QuestionModules.module_id = Modules.module_id 
                    WHERE 
                        QuestionModules.question_id = Questions.question_id
                ) AS module_names
            FROM 
                Questions 
            JOIN 
                Users ON Questions.user_id = Users.user_id
            LIMIT :offset, :questionsPerPage
        ';
        $params = [':offset' => $offset, ':questionsPerPage' => $questionsPerPage];
        return $this->getAll($query, $params);
    }

    /**
     * Get a question by its ID, including the username of the user who posted it and the vote count.
     *
     * @param int $questionId The ID of the question.
     * @return array|null The question data, including the username, vote count and module names.
     */
    public function getQuestionById(int $questionId): ?object {
        $query = 'SELECT Questions.question_id, Questions.user_id, Questions.title, Questions.body, Questions.image_path, Questions.created_at, Questions.updated_at, Users.username, 
        (SELECT COUNT(*) FROM Votes WHERE Votes.question_id = Questions.question_id AND Votes.vote_type = "upvote") AS upvotes,
        (SELECT COUNT(*) FROM Votes WHERE Votes.question_id = Questions.question_id AND Votes.vote_type = "downvote") AS downvotes,
        (SELECT COUNT(*) FROM Votes WHERE Votes.question_id = Questions.question_id) AS vote_count,
        (
            SELECT 
                GROUP_CONCAT(Modules.module_name SEPARATOR ", ") 
            FROM 
                QuestionModules 
            LEFT JOIN 
                Modules ON QuestionModules.module_id = Modules.module_id 
            WHERE 
                QuestionModules.question_id = Questions.question_id
        ) AS module_names 
        FROM Questions JOIN Users ON Questions.user_id = Users.user_id WHERE Questions.question_id = :questionId';
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
     * @return int The ID of the newly created question.
     */
    public function createQuestion(array $data): int
    {
        if (is_null($data['user_id']) || is_null($data['title']) || is_null($data['body'])) {
            throw new \InvalidArgumentException('Missing required parameters for creating a question');
        }

        $query = 'INSERT INTO Questions (user_id, title, body, image_path) VALUES (:userId, :title, :body, :imagePath)';
        $params = [
            ':userId' => $data['user_id'],
            ':title' => $data['title'],
            ':body' => $data['body'],
            ':imagePath' => $data['image_path'] ?? '',
        ];

        try {
            $this->executeQuery($query, $params);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw new \InvalidArgumentException('Failed to create question: ' . $e->getMessage());
        }
    }

    public function updateQuestion(int $questionId, array $data): bool
    {
        if (is_null($data['title']) || is_null($data['body'])) {
            throw new \InvalidArgumentException('Missing required parameters for updating a question');
        }

        $query = 'UPDATE Questions SET title = :title, body = :body, image_path = :imagePath WHERE question_id = :questionId';
        $params = [
            ':questionId' => $questionId,
            ':title' => $data['title'],
            ':body' => $data['body'],
            ':imagePath' => $data['image_path'] ?? '',
        ];

        try {
            $this->executeQuery($query, $params);
            return true;
        } catch (\PDOException $e) {
            throw new \InvalidArgumentException('Failed to update question: ' . $e->getMessage());
        }
    }

    
    public function countQuestions(): object
    {
        $query = 'SELECT COUNT(*) AS count FROM Questions';
        $this->db->query($query);
        $result = $this->db->single();


        return $result;
    }

    public function deleteQuestion(int $questionId): bool
    {
        $query = 'DELETE FROM Questions WHERE question_id = :questionId';
        $params = [':questionId' => $questionId];
        $this->executeQuery($query, $params);
        return true;
    }

    
}
