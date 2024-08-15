<?php
use Core\Authenticator;
use Core\Validator;
require_once 'core/Authenticator.php';
require_once 'core/database.php';
require_once 'config.php';
require_once 'core/Validator.php';
class AuthenticatorTest {
    private $authenticator;
    private $validator;
    private $rule;

    public function __construct() {
        $this->authenticator = new Authenticator();
        $this->validator = new Validator();
        $this->rule = [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|password_match'
        ];
    }

    public function testSuccessfulRegistration() {
        $username = 'testuser';
        $email = 'test@example.com';
        $password = 'password123';
        $confirm_password = 'password123';

        $validate = $this->validator->validate(['username' => $username, 'email' => $email, 'password' => $password, 'confirm_password' => $confirm_password], $this->rule);

        if (!$validate) {
            echo "Validation failed\n";
            return;
        }

        $result = $this->authenticator->register($username, $email, $password);

        if (!$result) {
            echo "Test failed: Successful registration\n";
            return;
        }

        echo "Test passed: Successful registration\n";
    }

    public function testRegistrationWithEmptyUsername() {
        $username = '';
        $email = 'test@example.com';
        $password = 'password123';
        $confirm_password = 'password123';

        $validate = $this->validator->validate(['username' => $username, 'email' => $email, 'password' => $password, 'confirm_password' => $confirm_password], $this->rule);

        if ($validate) {
            echo "Validation passed, but should have failed\n";
            return;
        }

        $result = $this->authenticator->register($username, $email, $password);

        if ($result) {
            echo "Test failed: Registration with empty username\n";
            return;
        }

        echo "Test passed: Registration with empty username\n";
    }

    public function testRegistrationWithEmptyEmail() {
        $username = 'testuser';
        $email = '';
        $password = 'password123';
        $confirm_password = 'password123';

        $validate = $this->validator->validate(['username' => $username, 'email' => $email, 'password' => $password, 'confirm_password' => $confirm_password], $this->rule);

        if ($validate) {
            echo "Validation passed, but should have failed\n";
            return;
        }

        $result = $this->authenticator->register($username, $email, $password);

        if ($result) {
            echo "Test failed: Registration with empty email\n";
            return;
        }

        echo "Test passed: Registration with empty email\n";
    }

    public function testRegistrationWithEmptyPassword() {
        $username = 'testuser';
        $email = 'test@example.com';
        $password = '';
        
        $validate = $this->validator->validate(['username' => $username, 'email' => $email, 'password' => $password, 'confirm_password' => $password], $this->rule);

        if ($validate) {
            echo "Validation passed, but should have failed\n";
            return;
        }

        $result = $this->authenticator->register($username, $email, $password);

        if ($result) {
            echo "Test failed: Registration with empty password\n";
            return;
        }

        echo "Test passed: Registration with empty password\n";
    }

    public function testRegistrationWithDuplicateEmail() {
        $username = 'testuser';
        $email = 'test@example.com';
        $password = 'password123';

        $this->authenticator->register($username, $email, $password);

        $validate = $this->validator->validate(['username' => $username, 'email' => $email, 'password' => $password], $this->rule);

        if (!$validate) {
            echo "Validation failed\n";
            return;
        }

        $result = $this->authenticator->register($username, $email, $password);

        if ($result) {
            echo "Test failed: Registration with duplicate email\n";
            return;
        }

        echo "Test passed: Registration with duplicate email\n";
    }

    public function testRegistrationWithInvalidEmailFormat() {
        $username = 'testuser';
        $email = 'invalidemail';
        $password = 'password123';

        $validate = $this->validator->validate(['username' => $username, 'email' => $email, 'password' => $password], $this->rule);

        if ($validate) {
            echo "Validation passed, but should have failed\n";
            return;
        }

        $result = $this->authenticator->register($username, $email, $password);

        if ($result) {
            echo "Test failed: Registration with invalid email format\n";
            return;
        }

        echo "Test passed: Registration with invalid email format\n";
    }

    public function runTests() {
        $this->testSuccessfulRegistration();
        $this->testRegistrationWithEmptyUsername();
        $this->testRegistrationWithEmptyEmail();
        $this->testRegistrationWithEmptyPassword();
        $this->testRegistrationWithDuplicateEmail();
        $this->testRegistrationWithInvalidEmailFormat();
    }
}

$test = new AuthenticatorTest();
$test->runTests();