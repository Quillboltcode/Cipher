<?php
require_once 'database.php';

class Comment {
    private $conn;
    private $table_name = "Comment";

    public $CommentID;
    public $UserID;
    public $QuestionID;
    public $AnswerID;
    public $Body;
    public $DatePosted;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (UserID, QuestionID, AnswerID, Body, DatePosted) VALUES (:UserID, :QuestionID, :AnswerID, :Body, :DatePosted)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':UserID', $this->UserID);
        $stmt->bindParam(':QuestionID', $this->QuestionID);
        $stmt->bindParam(':AnswerID', $this->AnswerID);
        $stmt->bindParam(':Body', $this->Body);
        $stmt->bindParam(':DatePosted', $this->DatePosted);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // Implement update and delete methods as needed
}
?>
