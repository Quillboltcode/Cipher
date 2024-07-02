<?php
require_once 'database.php';

class Vote {
    private $conn;
    private $table_name = "Vote";

    public $VoteID;
    public $UserID;
    public $QuestionID;
    public $AnswerID;
    public $VoteType;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (UserID, QuestionID, AnswerID, VoteType) VALUES (:UserID, :QuestionID, :AnswerID, :VoteType)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':UserID', $this->UserID);
        $stmt->bindParam(':QuestionID', $this->QuestionID);
        $stmt->bindParam(':AnswerID', $this->AnswerID);
        $stmt->bindParam(':VoteType', $this->VoteType);

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
