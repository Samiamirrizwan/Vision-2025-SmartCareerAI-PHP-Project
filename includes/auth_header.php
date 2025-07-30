<?php
// This is a dedicated header for authentication pages.
// It ensures a clean layout without the main site's navigation.
session_start();

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCareerAI - <?php echo ucfirst(str_replace(['.php', '-'], ['', ' '], $currentPage)); ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Link to the dedicated stylesheet for these pages -->
    <link rel="stylesheet" href="assets/css/forgot-password.css">
</head>
<body class="auth-page-body">

    <!-- Page Loader Animation -->
    <div id="page-loader" class="page-loader-wrapper">
        <div class="loader-spinner"></div>
    </div>

    <main class="auth-main-container">
        <!-- The form container from each page will be loaded here -->
