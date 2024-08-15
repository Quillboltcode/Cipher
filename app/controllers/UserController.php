<?php

use Core\Controller;
use Core\Authenticator;
use Core\Validator;
require_once 'Core/Validator.php';
class UserController extends Controller {
    private $auth;
    private $validate;
    public function __construct() {
        $this->auth = new Authenticator();
        $this->validate = new Validator();
    }

    public function register()
    {

        $data = [
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? '',
        ];

        $rules = [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|password_match',
        ];

        $this->validate->validate($data, $rules);

        if ($this->validate->hasErrors()) {
            $this->view('user/register', ['errors' => $this->validate->getErrors()]);
            return;
        }

        if (!$this->auth->register($data['username'], $data['email'], $data['password'])) {
            die('Something went wrong');
        }

        header('Location: ' . URLROOT . '/user/login');
    }
    public function login() {
        $data = [
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
        ];

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];


        $this->validate->validate($data, $rules);

        if ($this->validate->hasErrors()) {
            $this->view('user/login', ['errors' => $this->validate->getErrors()]);
            // error_log(print_r($this->validate->getErrors(), true));
            return;
        }

        if (!$this->auth->login($data['email'], $data['password'])) {
            die('Invalid login credentials');
        }
        // login
        $this->auth->login($data['email'], $data['password']);
        header('Location: ' . URLROOT . '/question/index');
    }

    public function logout() {
        $this->auth->logout();
        header('Location: ' . URLROOT . '/user/login');
    }

    public function profile() {
        $this->view('user/profile');
    }
}

