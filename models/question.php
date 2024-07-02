<?php
require_once 'database.php';

class Question {
    private $conn;
    private $table_name = "Question";

    public $QuestionID;
    public $UserID;
    public $Title;
    public $Body;
    public $DatePosted;
    public $ViewCount;
    public $Upvotes;
    public $Downvotes;
    public $AcceptedAnswerID;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (UserID, Title, Body, DatePosted, ViewCount, Upvotes, Downvotes, AcceptedAnswerID) VALUES (:UserID, :Title, :Body, :DatePosted, :ViewCount, :Upvotes, :Downvotes, :AcceptedAnswerID)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':UserID', $this->UserID);
        $stmt->bindParam(':Title', $this->Title);
        $stmt->bindParam(':Body', $this->Body);
        $stmt->bindParam(':DatePosted', $this->DatePosted);
        $stmt->bindParam(':ViewCount', $this->ViewCount);
        $stmt->bindParam(':Upvotes', $this->Upvotes);
        $stmt->bindParam(':Downvotes', $this->Downvotes);
        $stmt->bindParam(':AcceptedAnswerID', $this->AcceptedAnswerID);

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
