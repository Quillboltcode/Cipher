<?php

namespace Core;
class Authenticator {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Register a new user
    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = 'INSERT INTO Users (username, email, password) VALUES (:username, :email, :password)';
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashedPassword);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login a user
    public function login($email, $password) {
        $query = 'SELECT * FROM Users WHERE email = :email';
        $this->db->query($query);
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if ($row) {
            $hashedPassword = $row->password;
            if (password_verify($password, $hashedPassword)) {
                $this->createUserSession($row);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Create user session
    public function createUserSession($user) {
        session_start();
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
    }

    // Logout user
    public function logout() {
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        session_destroy();
    }

    // Check if user is logged in
    public function isLoggedIn() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
