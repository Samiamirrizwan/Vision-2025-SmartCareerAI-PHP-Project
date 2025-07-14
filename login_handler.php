<?php
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['message'] = 'Please enter both email and password.';
        $_SESSION['message_type'] = 'danger';
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name']; // Storing name for dashboard greeting
            
            // Redirect to dashboard
            header("Location: user/dashboard.php");
            exit();
        } else {
            // Invalid password
            $_SESSION['message'] = 'Invalid email or password.';
            $_SESSION['message_type'] = 'danger';
            header("Location: login.php");
            exit();
        }
    } else {
        // No user found
        $_SESSION['message'] = 'Invalid email or password.';
        $_SESSION['message_type'] = 'danger';
        header("Location: login.php");
        exit();
    }
} else {
    // Redirect if accessed directly
    header("Location: login.php");
    exit();
}
?>
