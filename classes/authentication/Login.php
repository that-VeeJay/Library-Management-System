<?php

declare(strict_types=1);

namespace classes\authentication;

use classes\core\Database;
use PDOException;

class Login extends Database
{
    private $email;
    private $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * The function loginUser() attempts to authenticate a user by querying the database for their email
     * and verifying their password.
     */
    public function loginUser(): void
    {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = Database::connection()->prepare($query);
            $stmt->execute([':email' => $this->email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            $verifyPass = password_verify($this->password, $user['password']);

            if (!$verifyPass) {
                echo "<div class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> Incorrect email or password. </div>";
            } else {
                header("Location: index.php");
            }
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }
}
