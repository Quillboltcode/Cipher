<?php
namespace Core;
use Exception;
class Authenticator {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Register a new user
    // Handles unique email and username error here
    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = 'INSERT INTO Users (username, email, password) VALUES (:username, :email, :password)';

        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashedPassword);

        try {
            if ($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Database error: Failed to register user");
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $errorCode = ord(substr($e->errorInfo[2], 0, 1));
                if ($errorCode == 1062) {
                    if (strpos($e->errorInfo[2], 'username')) {
                        throw new Exception("Username already exists");
                    } elseif (strpos($e->errorInfo[2], 'email')) {
                        throw new Exception("Email already exists");
                    }
                }
            }
            throw new Exception("Database error: Failed to register user");
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
    // Todo : create user session even when user is not logged in
    // Todo : create user session when user is logged in
    // This can be used when user updates their profile

    public function createUserSession($user) {
        if ($user) {
            // session_start();
            $_SESSION['user_id'] = $user->user_id ?? null;
            $_SESSION['username'] = $user->username ?? null;
            $_SESSION['email'] = $user->email ?? null;
            $_SESSION['logged_in'] = true;
        } else {
            throw new Exception('User object is null');
        }
    }

    // Logout user
    public function logout() {
        
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        // session_destroy();
    }

    // Check if user is logged in
    public function isLoggedIn() {
        if (isset($_SESSION['user_id']) && $_SESSION['logged_in'] === true) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin() {
        if ($this->isLoggedIn()) {
            $query = 'SELECT role_id FROM Users WHERE user_id = :user_id';
            $this->db->query($query);
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $row = $this->db->single();
            if ($row->role_id == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
