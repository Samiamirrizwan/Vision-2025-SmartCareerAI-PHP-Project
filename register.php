<?php
session_start();

// --- 1. Security Enhancement: Generate CSRF Token ---
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// --- 2. UX Enhancement: Retrieve Flash Messages & Old Input ---
$message = $_SESSION['flash_message']['message'] ?? '';
$message_type = $_SESSION['flash_message']['type'] ?? '';
$old_input = $_SESSION['old_input'] ?? [];

// Clear session data after retrieving it.
unset($_SESSION['flash_message']);
unset($_SESSION['old_input']);

// Include the header after all PHP logic
include('includes/header.php');
?>

<link rel="stylesheet" href="assets/css/style.css">
<!-- General scripts are loaded first -->
<script src="/assets/js/script.js"></script>
<script src="/assets/js/main.js"></script>

<main class="register-page text-white">
    <div class="min-h-screen flex items-center justify-center p-4 pt-24 md:pt-24">
        <div class="w-full max-w-md mx-auto">
            <div class="form-container p-8 md:p-10 rounded-2xl shadow-2xl">
                <h2 class="text-3xl font-bold text-center mb-2">Create Your Account</h2>
                <p class="text-center text-gray-400 mb-6">Join us and start your journey.</p>

                <?php if ($message): ?>
                <div id="alertMessage" class="alert <?php echo $message_type === 'success' ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                    <span><?php echo htmlspecialchars($message); ?></span>
                    <button class="close-btn" aria-label="Close" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
                <?php endif; ?>

                <form id="registerForm" method="POST" action="register_handler.php" novalidate>
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="John Doe" value="<?php echo htmlspecialchars($old_input['name'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="your.email@example.com" value="<?php echo htmlspecialchars($old_input['email'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="form-input" placeholder="Choose a strong password" required>
                            <i class="toggle-password fas fa-eye" data-target="#password" aria-label="Toggle password visibility"></i>
                        </div>
                        <div id="password-strength-meter" class="mt-2 h-2.5 w-full bg-gray-700 rounded-full">
                           <div class="strength-bar h-full rounded-full transition-all duration-300"></div>
                        </div>
                        <p id="password-strength-text" class="text-xs text-gray-400 mt-1"></p>
                    </div>
                    
                    <div class="mb-6">
                        <label for="password_confirm" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                        <div class="password-container">
                            <input type="password" id="password_confirm" name="password_confirm" class="form-input" placeholder="Enter your password again" required>
                            <i class="toggle-password fas fa-eye" data-target="#password_confirm" aria-label="Toggle password visibility"></i>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 rounded border-gray-500 bg-gray-700 text-blue-600 focus:ring-blue-500">
                            <label for="terms" class="ml-2 block text-sm text-gray-300">
                                I agree to the <a href="/terms.php" class="text-blue-400 hover:underline" target="_blank">Terms of Service</a>.
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full btn btn-primary">Create Account</button>
                </form>

                <p class="text-center text-gray-400 mt-8">
                    Already have an account? <a href="login.php" class="text-blue-400 font-semibold hover:underline">Log In</a>
                </p>
            </div>
        </div>
    </div>
</main>

<!-- Specific script for register page functionality -->
<script src="assets/js/register.js"></script>

<?php include('includes/footer.php'); ?>
