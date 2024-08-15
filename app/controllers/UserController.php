<?php

use Core\Controller;
use Core\Authenticator;
use Core\Validator;
use Models\User;
require_once 'app/models/user.php';
require_once 'Core/Validator.php';
class UserController extends Controller {
    private $auth;
    private $validate;
    private $usermodel;
    public function __construct() {
        $this->auth = new Authenticator();
        $this->validate = new Validator();
        $this->usermodel = new User();
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
        if (!$this->auth->isLoggedIn()) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }
        // Get user profile from database
        $user = $this->usermodel->getUserById($_SESSION['user_id']);
        $this->view('user/profile', $user);
    }
    public function edit(int $userId) {
        if (!$this->auth->isLoggedIn()) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }
        $user = $this->usermodel->getUserById($_SESSION['user_id']);
        $this->view('user/edit', $user);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->usermodel->getUserById($_SESSION['user_id']);
            // Validate and sanitize form data
            $errors = [];
            $data = [
                'username' => trim($_POST['username'] ?? $user->username),
                'email' => trim($_POST['email'] ?? $user->email),
                'password' => trim($_POST['password'] ?? ''),
                'avatar' => $_FILES['avatar'] ?? '',
            ];
            $rules = [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ];

            $this->validate->validate($data, $rules);

            if ($this->validate->hasErrors()) {
                $errors = $this->validate->getErrors();
            } else {
                $user->username = $data['username'];
                $user->email = $data['email'];
                if (!empty($data['password'])) {
                    $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
                }
                if (!empty($data['avatar'])) {
                    $avatar = $data['avatar'];
                    $avatar_name = $avatar['name'];
                    $avatar_tmp_name = $avatar['tmp_name'];
                    $avatar_error = $avatar['error'];
                    $avatar_size = $avatar['size'];

                    $extensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $avatar_ext = explode('.', $avatar_name);
                    $avatar_ext = strtolower(end($avatar_ext));

                    if (in_array($avatar_ext, $extensions)) {
                        if ($avatar_error === 0 && $avatar_size <= 2000000) {
                            $avatar_name = uniqid('avatar_') . '.' . $avatar_ext;
                            move_uploaded_file($avatar_tmp_name, URLROOT . '/uploads/' . $avatar_name);
                            $user->avatar = $avatar_name;
                        }
                    }
                }
                $this->usermodel->updateUser($user['user_id'], $user);
                header('Location: ' . URLROOT . '/user/profile');
            }
        }
    }
}

