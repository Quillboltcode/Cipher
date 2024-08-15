<?php
namespace Models;
use Core\Model;

class User extends Model
{
    private $tableName = "User";
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers(){
        $this->db->query("SELECT * FROM User");
        return $this->db->resultSet();
    }
    
    public function getUserbyId($id){
        $this->db->query("SELECT * FROM User WHERE UserID = $id");
        return $this->db->single();
    }

    public function findUserByEmail($email){
        $this->db->query("SELECT * FROM User WHERE Email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function findUserByUsername($username){
        $this->db->query("SELECT * FROM User WHERE Username = :username");
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function CreateUser($data){
        $this->db->query("INSERT INTO User(Username, Email, Password) VALUES (:username, :email, :password)");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->execute();
        return $this->db->lastInsertId();
    }
    
    public function emailExists($email) {
        $this->db->query("SELECT 1 FROM users WHERE email=?");
        $this->db->bind(1, $email); 
        return $this->db->rowCount();
    }

    // Change username 
    public function ChangeUsername($id, $username){
        $this->db->query("UPDATE User SET Username = :username WHERE UserID = :id");
        $this->db->bind(':username', $username);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}   

