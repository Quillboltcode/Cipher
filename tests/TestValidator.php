<?php
// test_validator.php

require_once 'core/Validator.php';

class TestValidator
 // Your existing code here
{
    protected function assertTrue($condition)
    {
        if (!$condition) {
            throw new AssertionError("Assertion failed");
        }
    }

    // Your test methods here

    
    public function testIsWithinLengthRange()
    {
        $input = 'Hello World';
        $maxLength = 20;

        $result = Core\Validator::isWithinLengthRange($input, $maxLength);
        if ($result) {
            echo "Test 1 passed: isWithinLengthRange returned true for '$input'\n";
        } else {
            echo "Test 1 failed: isWithinLengthRange returned false for '$input'\n";
        }

        $input = 'This is a very long string that exceeds the maximum length';
        $maxLength = 20;

        $result = Core\Validator::isWithinLengthRange($input, $maxLength);
        if (!$result) {
            echo "Test 2 passed: isWithinLengthRange returned false for '$input'\n";
        } else {
            echo "Test 2 failed: isWithinLengthRange returned true for '$input'\n";
        }
    }

    public function testIsValidEmail()
    {
        $email = 'test@example.com';

        $result = Core\Validator::isValidEmail($email);
        if ($result) {
            echo "Test 3 passed: isValidEmail returned true for '$email'\n";
        } else {
            echo "Test 3 failed: isValidEmail returned false for '$email'\n";
        }

        $email = 'invalid_email';

        $result = Core\Validator::isValidEmail($email);
        if (!$result) {
            echo "Test 4 passed: isValidEmail returned false for '$email'\n";
        } else {
            echo "Test 4 failed: isValidEmail returned true for '$email'\n";
        }
    }

    public function testValidate()
    {
        $validator = new Core\Validator();
    
        // Test valid data
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'confirm_password' => 'password123',
        ];
    
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|password_match',
        ];
    
        $result = $validator->validate($data, $rules);
    
        // Check if validation passed
        if (!empty($validator->errors)) {
            throw new AssertionError("Validation failed");
        }
    
        // Test invalid data
        $data = [
            'name' => '',
            'email' => 'invalid_email',
            'password' => 'password123',
            'confirm_password' => 'wrong_password',
        ];
    
        $result = $validator->validate($data, $rules);
    
        // Check if validation failed
        if (empty($validator->errors)) {
            throw new AssertionError("Validation passed");
        }
        var_dump($validator->errors);
        // Check error messages
        if (!array_key_exists('name', $validator->errors)) {
            throw new AssertionError("Error message for 'name' is missing");
        } 
        if (!array_key_exists('email', $validator->errors)) {
            throw new AssertionError("Error message for 'email' is missing");
        }
        if (!array_key_exists('confirm_password', $validator->errors)) {
            throw new AssertionError("Error message for 'confirm_password' is missing");
        }
    }

    public function testGetErrorAndHasError()
{
    $validator = new Core\Validator();

    // Test with no errors
    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password123',
        'confirm_password' => 'password123',
    ];

    $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'confirm_password' => 'required|password_match',
    ];

    $result = $validator->validate($data, $rules);

    // Check if there are no errors
    if ($validator->hasErrors()) {
        throw new AssertionError("Expected no errors, but found some");
    }

    // Check if getError returns an empty array
    $errors = $validator->getErrors();
    if (!empty($errors)) {
        throw new AssertionError("Expected an empty array, but found some errors");
    }

    // Test with errors
    $data = [
        'name' => '',
        'email' => 'invalid_email',
        'password' => 'password123',
        'confirm_password' => 'wrong_password',
    ];

    $result = $validator->validate($data, $rules);

    // Check if there are errors
    if (!$validator->hasErrors()) {
        throw new AssertionError("Expected some errors, but found none");
    }

    // Check if getError returns an array with errors
    $errors = $validator->getErrors();
    if (empty($errors)) {
        throw new AssertionError("Expected some errors, but found none");
    }
}
}

$testValidator = new TestValidator();
$testValidator->testIsWithinLengthRange();
$testValidator->testIsValidEmail();
$testValidator->testValidate();
// $testValidator->testGetErrorAndHasError();