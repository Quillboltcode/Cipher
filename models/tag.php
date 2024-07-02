<?php
require_once 'database.php';

class Tag {
    private $conn;
    private $table_name = "Tag";

    public $TagID;
    public $TagName;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (TagName) VALUES (:TagName)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':TagName', $this->TagName);

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
