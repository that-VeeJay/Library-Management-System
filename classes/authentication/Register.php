<?php

declare(strict_types=1);

namespace classes\authentication;

use classes\core\Database;
use PDOException;

class Register extends Database
{
    private $username;
    private $email;
    private $password;
    private $confirmPassword;

    public function __construct(string $username, string $email, string $password, string $confirmPassword)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    /**
     * The function `isEmailDuplicate` checks if a given email already exists in the database table
     * `users`.
     * 
     * @return bool The function `isEmailDuplicate()` is returning a boolean value. It checks if there is a
     * duplicate email in the `users` table by executing a SQL query to select the email matching the
     * provided email value. If a matching email is found, it returns `true`, indicating that the email is
     * a duplicate. Otherwise, it returns `false`, indicating that the email is not a duplicate.
     */
    private function isEmailDuplicate(): bool
    {
        try {
            $query = "SELECT email FROM users WHERE email = :email";
            $stmt = Database::connection()->prepare($query);
            $stmt->execute([':email' => $this->email]);
            $email = $stmt->fetchColumn();
            return ($email !== false);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }

    /**
     * The hashPassword function uses the bcrypt algorithm to securely hash the password.
     * 
     * @return string The `hashPassword` function is returning the hashed value of the `->password`
     * using the `PASSWORD_BCRYPT` algorithm.
     */
    private function hashPassword(): string
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }

    /**
     * The function generates a unique member ID using a combination of current time, a random letter, and
     * a portion of a hashed password.
     * 
     * @return string The function `memberID()` is returning a string in the format "LMS-{current
     * time}-{random letter}{4 numeric characters from the hashed password}".
     */
    private function memberID(): string
    {
        $time = substr((string)time(), -2);

        $alphabet = range('A', 'Z');
        $randIndex = array_rand($alphabet);
        $letter = $alphabet[$randIndex];

        $hash = $this->hashPassword();
        $trimmed = '';
        $reversed_hash = strrev($hash);
        $count = 0;

        foreach (str_split($reversed_hash) as $char) {
            if (is_numeric($char)) {
                $trimmed .= $char;
                $count++;
            }
            if ($count == 4) {
                break;
            }
        }

        return "LMS-" . $time . "-" . $letter . $trimmed;
    }

    /**
     * The formInputValidation function in PHP validates username, email, password, and checks for
     * duplicate email.
     * 
     * @return array An array of error messages based on the input validation rules for the username,
     * email, password, and confirm password fields.
     */
    private function formInputValidation(): array
    {
        $errors = [];

        if (!preg_match('/^[a-zA-Z\s]+$/', $this->username)) {
            array_push($errors, 'Username can only contain letters and spaces (A-Z, a-z).');
        };

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Email is not valid.');
        };

        if ($this->isEmailDuplicate()) {
            array_push($errors, 'Email already exists.');
        }

        if (strlen($this->password) < 3) {
            array_push($errors, 'Password should be at least 8 characters.');
        };

        if ($this->password !== $this->confirmPassword) {
            array_push($errors, 'Password does not match.');
        }

        return $errors;
    }

    /**
     * The function `registerUser` inserts user data into a database table using prepared statements in
     * PHP.
     */
    private function registerUser(): void
    {
        try {
            $query = "INSERT INTO users (member_id, username, email, password) VALUES (:member_id, :username, :email, :password);";
            $stmt = Database::connection()->prepare($query);
            $data = [
                ':member_id' => $this->memberID(),
                ':username' => $this->username,
                ':email' => $this->email,
                ':password' => $this->hashPassword(),
            ];
            $stmt->execute($data);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }

    /**
     * The function `displayMessages` checks for form input validation errors and displays corresponding
     * messages in HTML format.
     */
    public function displayMessages(): void
    {
        $errors = $this->formInputValidation();
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> $error </div>";
            }
        } else {
            $this->registerUser();
            echo "<div class='alert alert-success'> <i class=' fa fa-check-circle'></i> Registration successful! </div>";
        }
    }
}
