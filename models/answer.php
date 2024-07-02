<?php
require_once 'database.php';

class Answer {
    private $conn;
    private $table_name = "Answer";

    public $AnswerID;
    public $QuestionID;
    public $UserID;
    public $Body;
    public $DatePosted;
    public $Upvotes;
    public $Downvotes;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (QuestionID, UserID, Body, DatePosted, Upvotes, Downvotes) VALUES (:QuestionID, :UserID, :Body, :DatePosted, :Upvotes, :Downvotes)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':QuestionID', $this->QuestionID);
        $stmt->bindParam(':UserID', $this->UserID);
        $stmt->bindParam(':Body', $this->Body);
        $stmt->bindParam(':DatePosted', $this->DatePosted);
        $stmt->bindParam(':Upvotes', $this->Upvotes);
        $stmt->bindParam(':Downvotes', $this->Downvotes);

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
