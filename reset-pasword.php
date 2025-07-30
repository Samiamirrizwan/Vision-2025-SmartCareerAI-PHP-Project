<?php
require_once 'includes/db.php';
require_once 'includes/auth_header.php'; // Use new auth header

$token = $_GET['token'] ?? '';
$error = '';
$is_token_valid = false;

if (empty($token)) {
    $error = "No reset token provided. Please use the link from your email.";
} else {
    // Check if token is valid and not expired
    $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ? AND is_used = FALSE AND expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $is_token_valid = true;
    } else {
        $error = "This password reset link is invalid or has expired. Please request a new one.";
    }
    $stmt->close();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<div class="forgot-password-container">
    <div class="form-header">
        <i class="fas fa-lock form-icon"></i>
        <h1 class="form-title">Set a New Password</h1>
    </div>

    <?php if (!empty($error)): ?>
        <div class="text-center">
            <p class="form-subtitle text-red-400 mb-6"><?php echo htmlspecialchars($error); ?></p>
            <a href="forgot-password.php" class="form-button" style="text-decoration: none; display: inline-block; width: auto; padding: 0.8rem 1.5rem;">Request a New Link</a>
        </div>
        <?php elseif ($is_token_valid): ?>
        <p class="form-subtitle">Create a new secure password for your account.</p>

        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['flash_message']['type']; ?> mb-4">
                <?php echo $_SESSION['flash_message']['message']; ?>
            </div>
            <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>

        <form id="reset-password-form" action="reset-password-handler.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

            <div class="form-input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" id="password" class="form-input" placeholder="New Password" required>
            </div>
            
            <div class="w-full bg-gray-700 rounded-full h-1 mb-1">
                <div id="strength-indicator" class="h-1 rounded-full"></div>
            </div>
            <p id="strength-text" class="text-xs text-gray-400 text-left mb-4"></p>

            <div class="form-input-group">
                <i class="fas fa-check-circle input-icon"></i>
                <input type="password" name="confirm_password" id="confirm_password" class="form-input" placeholder="Confirm New Password" required>
            </div>
            <button type="submit" class="form-button">Reset Password</button>
        </form>
    <?php endif; ?>
</div>

<?php 
require_once 'includes/auth_footer.php'; // Use new auth footer
?>