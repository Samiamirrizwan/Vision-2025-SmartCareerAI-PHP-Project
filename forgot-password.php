<?php
// Use the new, dedicated authentication page header
require_once 'includes/auth_header.php'; 

// Generate a CSRF token if one doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<div class="forgot-password-container">
    <div class="form-header">
        <i class="fas fa-key form-icon"></i>
        <h1 class="form-title">Forgot Your Password?</h1>
        <p class="form-subtitle">No problem. Enter your email below and we'll send you a link to reset it.</p>
    </div>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['flash_message']['type']; ?> mb-4">
            <?php echo $_SESSION['flash_message']['message']; ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <form id="forgot-password-form" action="forgot-password-handler.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        <div class="form-input-group">
            <i class="fas fa-envelope input-icon"></i>
            <input type="email" name="email" class="form-input" placeholder="Enter your registered email" required>
        </div>
        <button type="submit" class="form-button">Send Reset Link</button>
    </form>

    <a href="login.php" class="back-link">
        <i class="fas fa-arrow-left mr-2"></i> Back to Login
    </a>
</div>

<?php 
// Use the new, dedicated authentication page footer
require_once 'includes/auth_footer.php'; 
?>
