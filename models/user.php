<?php
require_once 'database/database.php';

class User {
    private $conn;
    private $table_name = "User";

    public $UserID;
    public $Username;
    public $Email;
    public $PasswordHash;
    public $DateJoined;
    public $Reputation;
    public $ProfilePicture;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (Username, Email, PasswordHash, DateJoined, Reputation, ProfilePicture) VALUES (:Username, :Email, :PasswordHash, :DateJoined, :Reputation, :ProfilePicture)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':Username', $this->Username);
        $stmt->bindParam(':Email', $this->Email);
        $stmt->bindParam(':PasswordHash', $this->PasswordHash);
        $stmt->bindParam(':DateJoined', $this->DateJoined);
        $stmt->bindParam(':Reputation', $this->Reputation);
        $stmt->bindParam(':ProfilePicture', $this->ProfilePicture);

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
