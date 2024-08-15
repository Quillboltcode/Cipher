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
        $this->db->query("SELECT user_id, username, email,created_at,updated_at FROM Users");
        return $this->db->resultSet();
    }
    
    public function getUserbyId($id){
        $this->db->query("SELECT user_id, username, email,created_at,updated_at,role_id  FROM Users WHERE user_id = $id");
        return $this->db->single();
    }

    public function findUserByEmail($email){
        $this->db->query("SELECT * FROM Users WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function findUserByUsername($username){
        $this->db->query("SELECT * FROM Users WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

 
    
    public function emailExists($email) {
        $this->db->query("SELECT 1 FROM Users WHERE email=?");
        $this->db->bind(1, $email); 
        return $this->db->rowCount();
    }

    // Change username 
    public function UpdateUser($id, $data){
        $this->db->query("UPDATE Users SET Username = :username, email = :email, ,updated_at = NOW() WHERE user_id = :id");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    // Change password
    public function UpdateUserPassword($id, $data){
        $this->db->query("UPDATE Users SET Password = :password WHERE user_id = :id");
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}   

