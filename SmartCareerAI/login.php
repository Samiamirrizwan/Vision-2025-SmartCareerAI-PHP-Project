<?php
session_start();

// --- 1. Security & UX: Check for a "Remember Me" cookie ---
// If the user isn't logged in via session, check for a persistent login cookie.
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    // This part requires database interaction. See explanation below.
    // include('includes/db.php'); // Your database connection
    // include('utils/auth_utils.php'); // A utility file to handle token validation
    // login_via_cookie($_COOKIE['remember_me']); 
}

// --- 2. Redirect if already logged in (either by session or cookie) ---
if (isset($_SESSION['user_id'])) {
    header("Location: user/dashboard.php");
    exit();
}

// --- 3. Security: Generate CSRF Token ---
// Protects against Cross-Site Request Forgery attacks.
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// --- 4. UX: Retrieve Flash Messages & Old Input ---
// Gets messages and repopulates the email field on a failed login attempt.
$message = $_SESSION['flash_message']['message'] ?? '';
$message_type = $_SESSION['flash_message']['type'] ?? '';
$old_email = $_SESSION['old_input']['email'] ?? '';

// Clear session data after retrieving it.
unset($_SESSION['flash_message']);
unset($_SESSION['old_input']);

// Include the header after all PHP logic
include('includes/header.php');
?>

<link rel="stylesheet" href="assets/css/style.css">
<script src="/assets/js/script.js"></script>
<script src="/assets/js/main.js"></script>

<main class="pt-16 md:pt-0">
    <div class="flex flex-col md:flex-row min-h-screen">
        <div class="left-panel md:w-1/2 text-white p-12 flex flex-col justify-center items-start">
            <h1 class="text-3xl font-bold mb-4">Smart Career AI</h1>
            <h2 class="text-5xl font-bold mb-4">Welcome Back</h2>
            <p class="text-xl text-blue-200">Log in to continue your journey with us.</p>
        </div>

        <div class="w-full md:w-1/2 bg-white p-8 md:p-12 flex items-center justify-center form-light">
            <div class="w-full max-w-md">
                <h3 class="text-3xl font-bold text-gray-800 mb-6">Login to your account</h3>

                <?php if ($message): ?>
                <div id="alertMessage" class="alert <?php echo $message_type === 'success' ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                    <span><?php echo htmlspecialchars($message); ?></span>
                    <button class="close-btn" aria-label="Close" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
                <?php endif; ?>

                <form id="loginForm" method="POST" action="login_handler.php" novalidate>
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="your.email@example.com" value="<?php echo htmlspecialchars($old_email); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required>
                            <i class="toggle-password fas fa-eye text-gray-400" data-target="#password" aria-label="Toggle password visibility"></i>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>
                        <div>
                            <a href="forgot-password.php" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full btn btn-primary">Login</button>
                </form>

                <p class="text-center text-gray-600 mt-8">
                    Don't have an account? <a href="register.php" class="text-blue-600 font-semibold hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </div>
</main>
    
<?php include('includes/footer.php'); ?>
