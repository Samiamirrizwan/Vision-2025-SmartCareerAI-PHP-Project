<?php
include("includes/db.php");

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($name && $email && $password) {
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email already exists.";
    } else {
        $insert = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $insert)) {
            header("Location: login.php");
            exit;
        } else {
            echo "Error registering user.";
        }
    }
} else {
    echo "Please fill all fields.";
}
?>
