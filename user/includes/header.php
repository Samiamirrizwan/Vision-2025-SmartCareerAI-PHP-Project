<?php
// Assumes db.php is in the same /includes/ folder.
include('../includes/db.php'); 

// Get user's name from session, default to 'User' if not set
$user_name = $_SESSION['user_name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../user/assets/css/style.css"> 
    <title>Smart Career AI - User Panel</title>
</head>
<body class="bg-gray-100 font-sans">

    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <h1 class="text-2xl font-bold text-blue-600">Smart Career AI</h1>
                    <nav class="hidden md:flex items-baseline space-x-4">
                        <a href="dashboard.php" class="text-gray-700 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="test.php" class="text-gray-700 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Take Test</a>
                        <a href="results.php" class="text-gray-700 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Results</a>
                        <a href="career-roadmap.php" class="text-gray-700 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roadmap</a>
                        <a href="mentor-connect.php" class="text-gray-700 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Mentors</a>
                    </nav>
                </div>
                <div class="hidden md:flex items-center">
                    <span class="text-gray-700 mr-4">Welcome, <?php echo htmlspecialchars($user_name); ?>!</span>
                    <a href="logout.php" class="bg-red-500 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                </div>
                <div class="md:hidden flex items-center">
                     <a href="logout.php" class="text-red-500 hover:text-red-700 text-2xl"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </header>
