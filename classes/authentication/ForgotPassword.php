<?php

namespace classes\authentication;

require_once(__DIR__ . '/../../vendor/autoload.php');

use classes\core\Database;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;

class ForgotPassword extends Database
{
    private $memberId;
    private $email;

    public function __construct($memberId, $email)
    {
        $this->memberId = $memberId;
        $this->email = $email;
    }

    /**
     * The function `sendVerificationLink` uses PHPMailer to send a password recovery email with a
     * verification link to the user's email address.
     */
    public function sendVerificationLink()
    {
        $mail = new PHPMailer(true);
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['GMAIL_SMTP_SERVER'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_SENDER'];
            $mail->Password = $_ENV['GMAIL_APP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $_ENV['GMAIL_SMTP_PORT'];

            $mail->setFrom($_ENV['EMAIL_SENDER'], 'LMS Admin');
            $mail->addAddress($this->email);

            $mail->isHTML(true);
            $mail->Subject = 'LMS Password Recovery';
            $mail->Body = 'Change your password through this link: localhost/lms/change_password.php';
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    /**
     * The function `matchedInput` checks if a user with a specific member ID and email exists in the
     * database and sends a verification link if found.
     */
    public function matchedInput()
    {
        $query = "SELECT member_id, email FROM users WHERE member_id = :member_id AND email = :email;";
        $stmt = Database::connection()->prepare($query);
        $stmt->execute([
            ':member_id' => $this->memberId,
            ':email' => $this->email,
        ]);
        $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($user)) {
            echo "<div class='alert alert-danger'><i class='fa-solid fa-exclamation-circle'></i> Record not found. </div>";
        } else {
            $this->sendVerificationLink();
            echo "<div class='alert alert-success'><i class='fa-solid fa-check-circle'></i> Verification has been sent! </div>";
        }
    }
}
