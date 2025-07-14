<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Set a logout message
session_start();
$_SESSION['message'] = "You have been logged out successfully.";
$_SESSION['message_type'] = "success";

// Redirect to login page
header("Location: ../login.php");
exit;
?>