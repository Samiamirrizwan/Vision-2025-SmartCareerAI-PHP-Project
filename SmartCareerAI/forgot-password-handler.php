<?php
session_start();
require_once 'includes/db.php';
require_once 'utils/mail_config.php';

// --- Simple Rate Limiting (Prevents abuse) ---
if (isset($_SESSION['last_reset_request']) && (time() - $_SESSION['last_reset_request'] < 60)) {
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Please wait a minute before trying again.'];
    header('Location: forgot-password.php');
    exit();
}

// --- CSRF Token Validation ---
if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Invalid security token. Please try again.'];
    header('Location: forgot-password.php');
    exit();
}

// --- Production Mode Switch ---
// NOTE: This remains 'false' to allow email sending to occur.
define('IS_DEVELOPMENT', false); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Invalid email format provided.'];
        header('Location: forgot-password.php');
        exit();
    }
    
    $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'If an account with that email exists, a password reset link has been sent.'];

    $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        try {
            $conn->begin_transaction();

            $invalidate_old = $conn->prepare("UPDATE password_resets SET is_used = TRUE WHERE email = ?");
            $invalidate_old->bind_param("s", $email);
            $invalidate_old->execute();

            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $insert_stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("sss", $email, $token, $expires_at);
            $insert_stmt->execute();

            // --- Link Generation ---
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            
            // ===================================================================
            // !! IMPORTANT !! CONFIGURED FOR LOCAL XAMPP ENVIRONMENT
            // This path points to your project folder inside htdocs.
            // ===================================================================
            $base_path = '/SmartCareerAI/'; // <-- **UPDATED FOR XAMPP**

            $reset_link = "{$protocol}://{$host}{$base_path}reset-pasword.php?token={$token}";

            if (IS_DEVELOPMENT) {
                $_SESSION['dev_reset_link'] = $reset_link;
                $conn->commit();
                header('Location: show_token.php');
                exit();
            } else {
                if (send_password_reset_email($user['email'], $user['name'], $reset_link)) {
                     $_SESSION['last_reset_request'] = time();
                     $conn->commit();
                } else {
                     $conn->rollback();
                     $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Could not send the reset email. Please contact support.'];
                }
            }

        } catch (Exception $e) {
            $conn->rollback();
            error_log('Password reset failed: ' . $e->getMessage());
            $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Could not process your request. Please try again later.'];
        }
    }
    
    if (isset($stmt)) $stmt->close();
    $conn->close();

    header('Location: login.php');
    exit();
}