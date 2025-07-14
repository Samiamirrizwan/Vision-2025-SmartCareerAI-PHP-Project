<?php
session_start();
include('includes/header.php');

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: user/dashboard.php");
    exit();
}

// Check for and display messages
$message = '';
$message_type = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_type = $_SESSION['message_type'];
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Career AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="flex flex-col md:flex-row min-h-screen">
        <div class="left-panel md:w-1/2 text-white p-12 flex flex-col justify-center items-start" style="background: linear-gradient(to right, #1e3a8a, #3b82f6);">
            <h1 class="text-3xl font-bold mb-4">Smart Career AI</h1>
            <h2 class="text-5xl font-bold mb-4">Login Page</h2>
            <p class="text-xl text-blue-200">Start your journey with us.</p>
        </div>

        <div class="w-full md:w-1/2 bg-white p-8 md:p-12 flex items-center justify-center">
            <div class="w-full max-w-md">
                <h3 class="text-3xl font-bold text-gray-800 mb-6">Login to your account</h3>

                <?php if ($message): ?>
                <div id="alertMessage" class="alert <?php echo $message_type === 'success' ? 'alert-success' : 'alert-danger'; ?>">
                    <span><?php echo $message; ?></span>
                    <button class="close-btn" onclick="document.getElementById('alertMessage').style.display='none'">&times;</button>
                </div>
                <?php endif; ?>

                <form method="POST" action="login_handler.php">
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="your.email@example.com" required>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
                             <i class="fas fa-eye absolute top-1/2 right-4 -translate-y-1/2 cursor-pointer text-gray-500" id="togglePassword"></i>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Login now</button>
                </form>

                <p class="text-center text-gray-600 mt-8">
                    Don't have an account? <a href="register.php" class="text-blue-600 font-semibold hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
<?php
include('includes/footer.php');
?>
