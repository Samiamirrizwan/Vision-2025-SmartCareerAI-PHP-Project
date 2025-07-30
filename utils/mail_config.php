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

/**
 * Sends a password reset email.
 *
 * @param string $recipient_email The email address of the recipient.
 * @param string $recipient_name The name of the recipient.
 * @param string $reset_link The password reset link.
 * @return bool True on success, false on failure.
 */
function send_password_reset_email($recipient_email, $recipient_name, $reset_link) {
    $mail = new PHPMailer(true);

    // --- Server settings ---
    $smtp_host = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
    $smtp_username = getenv('SMTP_USER') ?: 'sarizwan777@gmail.com'; // Fallback
    $smtp_password = getenv('SMTP_PASS') ?: 'epnb afus kuti tzzc';      // Fallback

    if (!$smtp_username || !$smtp_password) {
        error_log('SMTP credentials are not set.');
        return false;
    }

    try {
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
        
        $template_path = __DIR__ . '/email_template.html'; // Assuming you have a password reset template
        if (file_exists($template_path)) {
            $mail->Body = file_get_contents($template_path);
            $mail->Body = str_replace('{{recipient_name}}', htmlspecialchars($recipient_name), $mail->Body);
            $mail->Body = str_replace('{{reset_link}}', $reset_link, $mail->Body);
        } else {
            // Fallback plain text body if template is missing
            $mail->Body = "Hello " . htmlspecialchars($recipient_name) . ",<br><br>Please click the following link to reset your password: <a href='{$reset_link}'>Reset Password</a>";
        }
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log("Password reset email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * NEW FUNCTION: Sends an email from the contact form to the site admin.
 *
 * @param string $sender_name The name of the person filling the form.
 * @param string $sender_email The email of the person filling the form.
 * @param string $subject The subject of the message.
 * @param string $message The message content.
 * @return bool True on success, false on failure.
 */
function send_contact_email($sender_name, $sender_email, $subject, $message) {
    $mail = new PHPMailer(true);

    // --- Server settings (using the same credentials) ---
    $smtp_host = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
    $smtp_username = getenv('SMTP_USER') ?: 'sarizwan777@gmail.com'; // Fallback
    $smtp_password = getenv('SMTP_PASS') ?: 'epnb afus kuti tzzc';      // Fallback
    
    // The admin email will receive the contact form submissions.
    // For this example, it's the same as the SMTP user.
    $admin_email = $smtp_username;

    if (!$smtp_username || !$smtp_password) {
        error_log('SMTP credentials are not set.');
        return false;
    }

    try {
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_username;
        $mail->Password   = $smtp_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom($smtp_username, 'SmartCareerAI Contact Form'); // From the system
        $mail->addAddress($admin_email, 'SmartCareerAI Admin');        // To the Admin
        $mail->addReplyTo($sender_email, $sender_name);               // So admin can reply directly to the user

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Submission: ' . htmlspecialchars($subject);
        
        // Load the new contact email template
        $template_path = __DIR__ . '/email-contact.html';
        if (!file_exists($template_path)) {
            throw new Exception('Could not load contact email template.');
        }
        $body = file_get_contents($template_path);

        // Replace placeholders with form data
        $body = str_replace('{{sender_name}}', htmlspecialchars($sender_name), $body);
        $body = str_replace('{{sender_email}}', htmlspecialchars($sender_email), $body);
        $body = str_replace('{{email_subject}}', htmlspecialchars($subject), $body);
        $body = str_replace('{{email_message}}', nl2br(htmlspecialchars($message)), $body);
        $body = str_replace('{{current_year}}', date('Y'), $body);
        
        $mail->Body = $body;
        
        $mail->send();
        return true;

    } catch (Exception $e) {
        error_log("Contact form email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
