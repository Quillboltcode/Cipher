<?php
use Core\Model;
use Core\Authenticator;
class User extends Model
{
    private $table;
    
    public function __construct()
    {
        $this->table = 'users';
    }

    public function getAllUsers(){
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function getUserbyId($id){
        $this->db->query("SELECT * FROM $this->table WHERE UserID = $id");
        return $this->db->single();
    }

    public function findUserByEmail($email){
        $this->db->query("SELECT * FROM $this->table WHERE Email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }
    
    public function login(){
        
    }

    public function register(){
        
    }
}   

