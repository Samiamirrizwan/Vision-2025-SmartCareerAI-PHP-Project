<?php
session_start();
require_once 'db.php';

// --- SECURITY CHECK ---
if (!isset($_SESSION['admin_id'])) {
    // For a real application, you MUST have a login system.
    // This example assumes an admin is logged in.
    // $_SESSION['admin_id'] = 1; // Temporary for testing
    // header('Location: ../login.php');
    // exit();
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SmartCareerAI</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Page Loader -->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>

    <!-- Interactive Background -->
    <canvas id="particle-canvas"></canvas>
    <div class="ghost-mouse"></div>

    <div class="relative min-h-screen md:flex">
        <!-- Mobile Menu Button -->
        <div class="md:hidden flex justify-between items-center p-4 bg-gray-900/50 backdrop-blur-sm sticky top-0 z-40">
            <a href="dashboard.php" class="text-xl font-bold">Admin Panel</a>
            <button id="mobile-menu-button" class="text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <aside id="sidebar" class="text-blue-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-300 ease-in-out z-50">
            <a href="dashboard.php" class="logo-container text-white flex items-center space-x-3 px-4">
                <i class="fas fa-brain text-3xl text-blue-400"></i>
                <span class="text-2xl font-extrabold">SmartCareerAI</span>
            </a>

            <nav class="flex flex-col justify-between h-[calc(100%-80px)]">
                <div>
                    <a href="dashboard.php" class="nav-link <?php echo ($currentPage == 'dashboard.php') ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt fa-fw mr-3"></i>Dashboard
                    </a>
                    <a href="users.php" class="nav-link <?php echo ($currentPage == 'users.php') ? 'active' : ''; ?>">
                        <i class="fas fa-users fa-fw mr-3"></i>Users
                    </a>
                    <a href="manage-careers.php" class="nav-link <?php echo ($currentPage == 'manage-careers.php') ? 'active' : ''; ?>">
                        <i class="fas fa-briefcase fa-fw mr-3"></i>Manage Careers
                    </a>
                    <a href="reports.php" class="nav-link <?php echo ($currentPage == 'reports.php') ? 'active' : ''; ?>">
                        <i class="fas fa-chart-line fa-fw mr-3"></i>Reports
                    </a>
                </div>
                <div>
                    <a href="logout.php" class="nav-link">
                        <i class="fas fa-sign-out-alt fa-fw mr-3"></i>Logout
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1 p-6 lg:p-10">
