<?php
// Set the default timezone for all PHP date/time functions to UTC.
date_default_timezone_set('UTC');

$host = "localhost";
$user = "root";
$password = "";
$database = "smartcareerai";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Set the timezone for the database session to UTC to ensure consistency.
mysqli_query($conn, "SET time_zone = '+00:00'");
?>