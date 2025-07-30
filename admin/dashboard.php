<?php
// Include the master header file
require_once 'includes/header.php';

// --- DATA FETCHING FOR STATS ---

// Fetch total number of users
$user_query = "SELECT COUNT(*) as total_users FROM users";
$user_result = mysqli_query($conn, $user_query);
$user_count = mysqli_fetch_assoc($user_result)['total_users'];

// Fetch total number of careers
$career_query = "SELECT COUNT(*) as total_careers FROM careers";
$career_result = mysqli_query($conn, $career_query);
$career_count = mysqli_fetch_assoc($career_result)['total_careers'];

// Fetch total number of test sessions
$session_query = "SELECT COUNT(*) as total_sessions FROM test_sessions";
$session_result = mysqli_query($conn, $session_query);
$session_count = mysqli_fetch_assoc($session_result)['total_sessions'];

// Fetch total number of mentors
$mentor_query = "SELECT COUNT(*) as total_mentors FROM mentors";
$mentor_result = mysqli_query($conn, $mentor_query);
$mentor_count = mysqli_fetch_assoc($mentor_result)['total_mentors'];
?>

<h1 class="text-4xl font-bold mb-8">Admin Dashboard</h1>

<!-- Stats Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Users Card -->
    <div class="content-card">
        <div class="flex items-center">
            <div class="p-4 bg-blue-500/20 rounded-lg">
                <i class="fas fa-users text-3xl text-blue-400"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-400 text-sm font-medium">Total Users</p>
                <p class="text-3xl font-bold"><?php echo $user_count; ?></p>
            </div>
        </div>
    </div>

    <!-- Total Careers Card -->
    <div class="content-card">
        <div class="flex items-center">
            <div class="p-4 bg-green-500/20 rounded-lg">
                <i class="fas fa-briefcase text-3xl text-green-400"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-400 text-sm font-medium">Listed Careers</p>
                <p class="text-3xl font-bold"><?php echo $career_count; ?></p>
            </div>
        </div>
    </div>

    <!-- Tests Taken Card -->
    <div class="content-card">
        <div class="flex items-center">
            <div class="p-4 bg-yellow-500/20 rounded-lg">
                <i class="fas fa-file-alt text-3xl text-yellow-400"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-400 text-sm font-medium">Tests Taken</p>
                <p class="text-3xl font-bold"><?php echo $session_count; ?></p>
            </div>
        </div>
    </div>

    <!-- Mentors Card -->
    <div class="content-card">
        <div class="flex items-center">
            <div class="p-4 bg-purple-500/20 rounded-lg">
                <i class="fas fa-chalkboard-teacher text-3xl text-purple-400"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-400 text-sm font-medium">Available Mentors</p>
                <p class="text-3xl font-bold"><?php echo $mentor_count; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="mt-10">
    <h2 class="text-2xl font-bold mb-4">Quick Actions</h2>
    <div class="flex flex-wrap gap-4">
        <a href="manage-careers.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-5 rounded-lg transition duration-300">
            <i class="fas fa-plus-circle mr-2"></i>Add New Career
        </a>
        <a href="reports.php" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-5 rounded-lg transition duration-300">
            <i class="fas fa-chart-pie mr-2"></i>Generate Report
        </a>
    </div>
</div>


<?php
// Include the master footer file
require_once 'includes/footer.php';
?>
