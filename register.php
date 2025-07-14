<?php
session_start();
include('includes/header.php');

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
    <title>Create Account - Smart Career AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="register-page text-white">

    <div class="min-h-screen flex items-start justify-center p-4 pt-16 md:pt-24">
        <div class="w-full max-w-md mx-auto">
            <div class="form-container p-8 md:p-10 rounded-2xl shadow-2xl bg-gray-900/50 backdrop-blur-sm">
                <h2 class="text-3xl font-bold text-center mb-4">Create an account</h2>

                <?php if ($message): ?>
                <div id="alertMessage" class="alert <?php echo $message_type === 'success' ? 'alert-success' : 'alert-danger'; ?>">
                    <span><?php echo $message; ?></span>
                    <button class="close-btn" onclick="document.getElementById('alertMessage').style.display='none'">&times;</button>
                </div>
                <?php endif; ?>

                <form method="POST" action="register_handler.php">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-3 bg-gray-800/60 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="John Doe" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 bg-gray-800/60 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="your.email@example.com" required>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full px-4 py-3 bg-gray-800/60 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
                            <i class="fas fa-eye absolute top-1/2 right-4 -translate-y-1/2 cursor-pointer text-gray-400" id="togglePassword"></i>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Create account</button>
                </form>

                <p class="text-center text-gray-400 mt-8">
                    Already have an account? <a href="login.php" class="text-blue-400 font-semibold hover:underline">Log in</a>
                </p>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>

<?php
include('includes/footer.php');
?>
