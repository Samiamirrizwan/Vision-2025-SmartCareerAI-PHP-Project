<?php
// This file assumes a session has been started.
// It also assumes the existence of a db.php file for any potential database interactions in the header.

// Get user's name from session, default to 'User' if not set
$user_name = $_SESSION['user_name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Career AI - Dashboard</title>
    
    <!-- Centralized Styles and Fonts -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body class="bg-dark">

    <header class="site-header">
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-brain"></i> Smart Career AI
            </div>
            <nav class="main-nav" id="main-nav">
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="./test.php">Take Test</a>
                <a href="./results.php">Results</a>
                <a href="./career-roadmap.php">Roadmap</a>
                <a href="mentor-connect.php">Mentors</a>
            </nav>
            <div class="user-actions">
                <span class="welcome-msg">Welcome, <?php echo htmlspecialchars($user_name); ?>!</span>
                <a href="user-settings.php" class="settings-btn" title="User Settings">
                    <i class="fas fa-cog"></i>
                </a>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Open Menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <div class="content-wrapper">
