<?php
// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "smartcareerai";

// Establish a database connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check if the connection was successful
if (!$conn) {
  // If connection fails, terminate the script and display an error
  die("Connection failed: " . mysqli_connect_error());
}
?>
