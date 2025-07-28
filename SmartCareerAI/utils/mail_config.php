<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require __DIR__ . '/../vendor/autoload.php';

// It's highly recommended to use a library like Dotenv to load environment variables
// For simplicity, we'll use getenv() here.
// Create a .env file in your project root with these lines:
// SMTP_HOST="smtp.gmail.com"
// SMTP_USER="your-email@gmail.com"
// SMTP_PASS="your-16-digit-app-password"

function send_password_reset_email($recipient_email, $recipient_name, $reset_link) {
    $mail = new PHPMailer(true);

    // --- Server settings ---
    // Fetch credentials from environment variables for better security
    $smtp_host = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
    $smtp_username = getenv('SMTP_USER') ?: 'sarizwan777@gmail.com'; // Fallback for your existing setup
    $smtp_password = getenv('SMTP_PASS') ?: 'epnb afus kuti tzzc';      // Fallback

    if (!$smtp_username || !$smtp_password) {
        error_log('SMTP credentials are not set in environment variables.');
        return false;
    }

    try {
        // Enable verbose debug output only when needed
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_username;
        $mail->Password   = $smtp_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom($smtp_username, 'SmartCareerAI Support');
        $mail->addAddress($recipient_email, $recipient_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Password Reset Request for SmartCareerAI';
        
        // Robustly load email template
        $template_path = __DIR__ . '/email_template.html';
        if (file_exists($template_path)) {
            $mail->Body = file_get_contents($template_path);
        } else {
            throw new Exception('Could not load email template.');
        }

        // Replace placeholders
        $mail->Body = str_replace('{{recipient_name}}', htmlspecialchars($recipient_name), $mail->Body);
        $mail->Body = str_replace('{{reset_link}}', $reset_link, $mail->Body);
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        // Log the detailed error for debugging
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}