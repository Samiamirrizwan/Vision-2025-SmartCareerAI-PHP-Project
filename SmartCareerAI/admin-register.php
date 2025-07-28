<?php
// This is the admin registration page for the public site
session_start();
// The main public header already includes all necessary CSS and JS
require_once 'includes/header.php';
?>

<main class="login-container">
    <div class="w-full max-w-md mx-auto">
        <div class="form-container p-8 md:p-10 rounded-xl">
            <div class="text-center mb-8">
                <i class="fas fa-user-plus text-5xl text-blue-400 mb-4"></i>
                <h2 class="text-3xl font-bold text-white">Create Admin Account</h2>
                <p class="text-gray-400">An invite code is required for registration.</p>
            </div>

            <!-- Display Success/Error Messages -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger mb-4">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <form action="admin-register-handler.php" method="POST" class="space-y-4">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Full Name</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="name" id="name" class="form-input pl-10" required>
                    </div>
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Email Address</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="email" name="email" id="email" class="form-input pl-10" required>
                    </div>
                </div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-300">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="password" name="password" id="password" class="form-input pl-10 pr-10" required>
                        <i class="toggle-password fas fa-eye" data-target="#password"></i>
                    </div>
                 <div>
                    <label for="invite_code" class="block mb-2 text-sm font-medium text-gray-300">Invite Code</label>
                    <div class="relative">
                        <i class="fas fa-key absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="invite_code" id="invite_code" class="form-input pl-10" placeholder="SCA-ADMIN-XXXX-XYZ" required>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full btn btn-primary mt-4">
                        <i class="fas fa-check-circle mr-2"></i>Register Admin
                    </button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-sm text-gray-400">
                    Already have an admin account? 
                    <a href="admin-login.php" class="font-medium text-blue-400 hover:text-blue-300">Login here</a>
                </p>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; // Use the public footer ?>
