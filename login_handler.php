<?php
include("includes/db.php");
session_start();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email && $password) {
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['email'] = $email;
        header("Location: user/dashboard.php");
        exit;
    } else {
        echo "Invalid credentials.";
    }
} else {
    echo "Please fill all fields.";
}
?>
