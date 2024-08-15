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
     * @return array|null The question data, including the username and vote count.
     */
    public function getQuestionById(int $questionId): ?object {
        $query = 'SELECT Questions.question_id, Questions.user_id, Questions.title, Questions.body, Questions.image_path, Questions.created_at, Questions.updated_at, Users.username, 
        (SELECT COUNT(*) FROM Votes WHERE Votes.question_id = Questions.question_id AND Votes.vote_type = "upvote") AS upvotes,
        (SELECT COUNT(*) FROM Votes WHERE Votes.question_id = Questions.question_id AND Votes.vote_type = "downvote") AS downvotes,
        (SELECT COUNT(*) FROM Votes WHERE Votes.question_id = Questions.question_id) AS vote_count 
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
     * @return bool Whether the question was created successfully.
     */
    public function createQuestion(array $data): bool
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
            return true;
        } catch (\PDOException $e) {
            throw new \InvalidArgumentException('Failed to create question: ' . $e->getMessage());
        }
    }

    

    
}
