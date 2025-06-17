<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

function sendConfirmationEmail($email, $username) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.sendgrid.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'apikey'; // This is always "apikey" for SendGrid
        $mail->Password = 'YOUR_SENDGRID_API_KEY'; // Replace with your actual SendGrid API Key
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('no-reply@yourdomain.com', 'Affluence Jewels');
        $mail->addAddress($email, $username);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Affluence Jewels';
        $mail->Body = "
            <h2>Hi {$username},</h2>
            <p>Thanks for registering at <strong>Affluence Jewels</strong>!</p>
            <p>We're excited to have you with us. Browse our collection and enjoy elegance and class.</p>
            <p><strong>Stay Sparkling,</strong><br>Affluence Jewels Team</p>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return "Mailer Error: " . $mail->ErrorInfo;
    }
}
