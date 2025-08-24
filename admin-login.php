<?php
// This is the admin login page for the public site
session_start();
// If an admin is already logged in, redirect them to the dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: admin/dashboard.php");
    exit();
}
// The main public header already includes all necessary CSS and JS
require_once 'includes/header.php';
?>

<!-- The body tag in header.php now controls the page-specific background -->
<main class="login-container">
    <div class="w-full max-w-md mx-auto">
        <!-- The 'form-container' class is now enhanced with glowing borders via CSS -->
        <div class="form-container p-8 md:p-10 rounded-xl">
            <div class="text-center mb-8">
                <i class="fas fa-user-shield text-5xl text-blue-400 mb-4"></i>
                <h2 class="text-3xl font-bold text-white">Admin Panel Login</h2>
                <p class="text-gray-400">Enter your credentials to access the dashboard.</p>
            </div>

            <!-- Display Login Errors -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger mb-4">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>
             <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mb-4">
                    <?php echo htmlspecialchars($_GET['success']); ?>
                </div>
            <?php endif; ?>

            <form action="admin-login-handler.php" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="email" name="email" id="email" class="form-input pl-10" placeholder="admin@example.com" required>
                    </div>
                </div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-300">Password</label>
                     <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="password" name="password" id="password" class="form-input pl-10 pr-10" placeholder="Enter the password" required>
                        <i class="toggle-password fas fa-eye" data-target="#password"></i>
                    </div>
                <div>
                    <button type="submit" class="w-full btn btn-primary">
                        <i class="fas fa-sign-in-alt mr-2"></i>Secure Login
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-400">
                    Need to register an admin account? 
                    <a href="admin-register.php" class="font-medium text-blue-400 hover:text-blue-300">Register here</a>
                </p>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; // Use the public footer ?>
