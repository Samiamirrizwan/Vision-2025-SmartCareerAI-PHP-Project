<?php
require_once 'includes/db.php'; // Public db connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $invite_code = trim($_POST['invite_code']);

    // --- Validation ---
    if (empty($name) || empty($email) || empty($password) || empty($invite_code)) {
        header("Location: admin-register.php?error=All fields are required.");
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: admin-register.php?error=Invalid email format.");
        exit();
    }

    // --- Check Invite Code ---
    $stmt = $conn->prepare("SELECT id, is_used FROM admin_invites WHERE code = ?");
    $stmt->bind_param("s", $invite_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: admin-register.php?error=Invalid invite code.");
        exit();
    }

    $invite = $result->fetch_assoc();
    if ($invite['is_used']) {
        header("Location: admin-register.php?error=This invite code has already been used.");
        exit();
    }
    $invite_id = $invite['id'];
    $stmt->close();

    // --- Check if admin email already exists ---
    $stmt = $conn->prepare("SELECT id FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        header("Location: admin-register.php?error=An admin with this email already exists.");
        exit();
    }
    $stmt->close();

    // --- Create Admin Account ---
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Use a transaction to ensure both operations succeed or fail together
    $conn->begin_transaction();
    try {
        // Insert new admin
        $stmt_insert = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("sss", $name, $email, $hashed_password);
        $stmt_insert->execute();
        $stmt_insert->close();

        // Mark invite code as used
        $stmt_update = $conn->prepare("UPDATE admin_invites SET is_used = TRUE WHERE id = ?");
        $stmt_update->bind_param("i", $invite_id);
        $stmt_update->execute();
        $stmt_update->close();

        // If all good, commit the transaction
        $conn->commit();
        header("Location: admin-login.php?success=Registration successful. Please log in.");
        exit();

    } catch (mysqli_sql_exception $exception) {
        $conn->rollback(); // Rollback on error
        header("Location: admin-register.php?error=Registration failed. Please try again.");
        exit();
    }

} else {
    header("Location: admin-register.php");
    exit();
}
?>
