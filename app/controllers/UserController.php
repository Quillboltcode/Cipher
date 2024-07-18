<?php

use Core\Controller;
use Core\Authenticator;
class UsersController extends Controller {
    private $auth;

    public function __construct() {
        $this->auth = new Authenticator();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password == $confirmPassword) {
                if ($this->auth->register($username, $email, $password)) {
                    header('Location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                die('Passwords do not match');
            }
        } else {
            $this->view('users/register');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->auth->login($email, $password)) {
                header('Location: ' . URLROOT . '/questions/index');
            } else {
                die('Invalid login credentials');
            }
        } else {
            $this->view('users/login');
        }
    }

    public function logout() {
        $this->auth->logout();
        header('Location: ' . URLROOT . '/users/login');
    }
}
