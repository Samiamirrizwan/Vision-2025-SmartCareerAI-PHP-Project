<?php
// This file assumes a session has been started.
// It also assumes the existence of a db.php file for any potential database interactions in the header.

// Get user's name from session, default to 'User' if not set
$user_name = $_SESSION['user_name'] ?? 'User';

// Function to check for active navigation link
function is_active($page_name) {
    if (basename($_SERVER['PHP_SELF']) == $page_name) {
        return 'active';
    }
    return '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Career AI - Dashboard</title>
    
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body class="bg-dark">

    <header class="site-header">
        <div class="header-container">
            <a href="dashboard.php" class="logo-link">
                <div class="logo logo-glow">
                    <i class="fas fa-brain"></i> Smart Career AI
                </div>
            </a>
            <nav class="main-nav" id="main-nav">
                <!-- Main Desktop Links -->
                <a href="dashboard.php" class="<?php echo is_active('dashboard.php'); ?>">Dashboard</a>
                <a href="test.php" class="<?php echo is_active('test.php'); ?>">Take Test</a>
                <a href="results.php" class="<?php echo is_active('results.php'); ?>">Results</a>
                <a href="career-roadmap.php" class="<?php echo is_active('career-roadmap.php'); ?>">Roadmap</a>
                <a href="mentor-connect.php" class="<?php echo is_active('mentor-connect.php'); ?>">Mentors</a>

                <!-- --- ENHANCEMENT: Mobile-only links for settings and logout --- -->
                <div class="mobile-nav-footer">
                    <a href="user-settings.php" class="settings-btn-mobile <?php echo is_active('user-settings.php'); ?>">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <a href="logout.php" class="logout-btn-mobile">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </nav>
            <div class="user-actions">
                <span class="welcome-msg">Welcome, <?php echo htmlspecialchars($user_name); ?>!</span>
                <a href="user-settings.php" class="settings-btn" title="User Settings">
                    <i class="fas fa-cog"></i>
                </a>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Open Menu" aria-controls="main-nav" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <div class="content-wrapper">
