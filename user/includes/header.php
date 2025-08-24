<?php
// This file assumes a session has been started.
$user_name = $_SESSION['user_name'] ?? 'User';
$profile_image = $_SESSION['profile_image'] ?? 'assets/img/default-avatar.png';
// --- NEW: Fetch theme from session, default to 'dark' ---
$theme = $_SESSION['theme'] ?? 'dark';

function is_active($page_name) {
    return basename($_SERVER['PHP_SELF']) == $page_name ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Career AI - Dashboard</title>

    <link rel="icon" href="<?php echo $basePath; ?>assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/img/site.webmanifest">


    <link rel="icon" href="<?php echo $basePath; ?>../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/roadmap-style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js" defer></script>
    <script src="assets/js/roadmap-3d.js" defer></script>
    
    <style>
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-color);
            transition: border-color 0.3s ease;
        }
        .user-avatar:hover {
            border-color: var(--primary-color);
        }
        .user-avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 1.2rem;
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
        }
        .user-avatar-placeholder:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        .user-actions .settings-btn {
            padding: 0;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body class="bg-dark theme-<?php echo htmlspecialchars($theme); ?>">

    <div id="preloader">
        <div class="preloader-icon">
            <i class="fas fa-brain"></i>
        </div>
    </div>

    <div id="roadmap-3d-container"></div>
    <header class="site-header">
        <div class="header-container">
            <a href="dashboard.php" class="logo-link">
                <div class="logo logo-glow">
                    <i class="fas fa-brain"></i> Smart Career AI
                </div>
            </a>
            <nav class="main-nav" id="main-nav">
                <div class="main-nav-wrapper">
                    <a href="dashboard.php" class="<?php echo is_active('dashboard.php'); ?>">Dashboard</a>
                    <a href="test.php" class="<?php echo is_active('test.php'); ?>">Take Test</a>
                    <a href="results.php" class="<?php echo is_active('results.php'); ?>">Results</a>
                    <a href="career-roadmap.php" class="<?php echo is_active('career-roadmap.php'); ?>">Roadmap</a>
                    <a href="mentor-connect.php" class="<?php echo is_active('mentor-connect.php'); ?>">Mentors</a>
                    <div class="mobile-nav-footer">
                        <a href="user-settings.php" class="settings-btn-mobile <?php echo is_active('user-settings.php'); ?>">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <a href="logout.php" class="logout-btn-mobile">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </nav>
            <div class="user-actions">
                <span class="welcome-msg">Welcome, <?php echo htmlspecialchars($user_name); ?>!</span>
                <a href="user-settings.php" class="settings-btn" title="User Settings">
                    <?php if ($profile_image !== 'assets/img/default-avatar.png'): ?>
                        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Your profile picture" class="user-avatar">
                    <?php else: ?>
                        <div class="user-avatar-placeholder" title="Update your profile picture">
                            <i class="fas fa-user-secret"></i>
                        </div>
                    <?php endif; ?>
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