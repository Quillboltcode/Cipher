<?php
namespace Core;
class Validator
{
    public $errors = [];

    public function __construct() {
        
    }
    /**
     * Validates if a string is within a specified length range.
     *
     * @param string $input The string to validate.
     * @param int $maxLength The maximum length of the string.
     * @return bool Returns true if the string is within the specified length range, false otherwise.
     */
    public static function isWithinLengthRange($input, $maxLength)
    {
        $trimmedInput = trim($input);
        $inputLength = strlen($trimmedInput);

        return $inputLength > 0 && $inputLength < $maxLength;
    }

    /**
     * Validates an email address.
     *
     * @param string $email The email address to be validated.
     * @return bool Returns true if the email address is valid, false otherwise.
     */
    public static function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

   

    /**
     * Validates data against a set of predefined rules.
     *
     * @param array $data The data to be validated.
     * @param array $rules An array of rules where the key is the field name and the value is a pipe-separated list of rules.
     * @return array An array of errors where the key is the field name and the value is a list of error messages.
     */
    public function validate($data, $rules)
    {
        foreach ($rules as $field => $ruleSet) {
            $rulesArray = explode('|', $ruleSet);
            foreach ($rulesArray as $rule) {
                $value = isset($data[$field]) ? $data[$field] : null;

                switch ($rule) {
                    case 'required':
                        if (empty($value)) {
                            $this->errors[$field][] = 'This field is required';
                        }
                        break;
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->errors[$field][] = 'This field must be a valid email address';
                        }
                        break;
                    case 'password_match':
                        if ($data['password'] !== $data['confirm_password']) {
                            $this->errors[$field][] = 'Passwords do not match';
                        }
                        break;
                    // Rule username exists
                    
                }
            }
        }

        return $this->errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }
}


