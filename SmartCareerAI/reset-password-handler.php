<?php
session_start();
require_once 'includes/db.php';

// --- CSRF Token Validation ---
if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Invalid security token. Please try again.'];
    header('Location: reset-password.php?token=' . urlencode($_POST['token'] ?? ''));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // --- Basic Validation ---
    if (empty($token) || empty($password) || empty($confirm_password)) {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'All fields are required.'];
        header('Location: reset-password.php?token=' . urlencode($token));
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Passwords do not match.'];
        header('Location: reset-password.php?token=' . urlencode($token));
        exit();
    }
    
    // --- Validate Token and Get Email ---
    $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ? AND is_used = FALSE AND expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $stmt->close();

        // --- Update Password ---
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $conn->begin_transaction();
        try {
            // Update user's password
            $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $hashed_password, $email);
            $update_stmt->execute();
            $update_stmt->close();

            // Mark token as used
            $invalidate_stmt = $conn->prepare("UPDATE password_resets SET is_used = TRUE WHERE token = ?");
            $invalidate_stmt->bind_param("s", $token);
            $invalidate_stmt->execute();
            $invalidate_stmt->close();

            $conn->commit();

            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Your password has been reset successfully! You can now log in.'];
            header('Location: login.php');
            exit();

        } catch (mysqli_sql_exception $exception) {
            $conn->rollback();
            $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'An error occurred. Please try again.'];
            header('Location: reset-password.php?token=' . urlencode($token));
            exit();
        }

    } else {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'This password reset link is invalid or has expired.'];
        header('Location: forgot-password.php');
        exit();
    }
}
