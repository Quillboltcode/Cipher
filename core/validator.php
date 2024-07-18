<?php

class Validator
{
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
}   

?>