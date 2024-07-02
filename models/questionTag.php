<?php
require_once 'database.php';

class QuestionTag {
    private $conn;
    private $table_name = "QuestionTag";

    public $QuestionID;
    public $TagID;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (QuestionID, TagID) VALUES (:QuestionID, :TagID)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':QuestionID', $this->QuestionID);
        $stmt->bindParam(':TagID', $this->TagID);

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
