<?php
session_start();
require_once 'includes/db.php'; // Public db connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: admin-login.php?error=Email and password are required.");
        exit();
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, name, password FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $admin['password'])) {
            // Password is correct, start a new session
            session_regenerate_id();
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            
            // Redirect to the admin dashboard
            header("Location: admin/dashboard.php");
            exit();
        } else {
            // Invalid password
            header("Location: admin-login.php?error=Invalid email or password.");
            exit();
        }
    } else {
        // No user found with that email
        header("Location: admin-login.php?error=Invalid email or password.");
        exit();
    }
    $stmt->close();
    $conn->close();
} else {
    // Not a POST request
    header("Location: admin-login.php");
    exit();
}
?>
