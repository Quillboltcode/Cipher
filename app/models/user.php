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
        $this->db->query("SELECT user_id, username, email,avatar,created_at,updated_at,role_id  FROM Users WHERE user_id = $id");
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

    public function getUserQuestionCount($id){
        $this->db->query("SELECT COUNT(*) as count FROM Questions WHERE user_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getUserAnswerCount($id){
        $this->db->query("SELECT COUNT(*) as count FROM Answers WHERE user_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single(); 
    }
 
    
    public function emailExists($email) {
        $this->db->query("SELECT 1 FROM Users WHERE email=?");
        $this->db->bind(1, $email); 
        return $this->db->rowCount();
    }

    /**
     * Update user information
     * 
     * @param int $id user id
     * @param array $data user data to update
     * 
     * @return void
     */
    public function UpdateUser($id, $data){
        // SQL query to update user information
        $this->db->query("UPDATE Users 
        SET Username = :username, 
            email = :email, 
            avatar = :avatar, 
            updated_at = NOW() 
        WHERE user_id = :id");
        
        // Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':avatar', $data['avatar'] ?? null);
        $this->db->bind(':id', $id);
        
        // Execute query
        $this->db->execute();
    }

    // Change password
    public function UpdateUserPassword($id, $data){
        $this->db->query("UPDATE Users SET Password = :password WHERE user_id = :id");
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function countUsers() : int {
        $this->db->query("SELECT COUNT(*) as count FROM Users");
        return $this->db->single()->count;
    }

    public function deleteUser($id){
        $this->db->query("DELETE FROM Users WHERE user_id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}   

