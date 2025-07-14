<?php
session_start();
include('includes/db.php');

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['message'] = 'Please fill in all fields.';
        $_SESSION['message_type'] = 'danger';
        header("Location: register.php");
        exit();
    }

    // Check if user already exists
    $sql_check = "SELECT id FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // User exists
        $_SESSION['message'] = 'An account with this email already exists.';
        $_SESSION['message_type'] = 'danger';
        header("Location: register.php");
        exit();
    } else {
        // User does not exist, proceed with registration
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql_insert = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt_insert->execute()) {
            $_SESSION['message'] = 'Registration successful! Please login.';
            $_SESSION['message_type'] = 'success';
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['message'] = 'An error occurred during registration. Please try again.';
            $_SESSION['message_type'] = 'danger';
            header("Location: register.php");
            exit();
        }
    }
} else {
    // Redirect if accessed directly
    header("Location: register.php");
    exit();
}
?>
