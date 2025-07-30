<?php
require_once 'includes/auth_header.php';

if (!isset($_SESSION['dev_reset_link'])) {
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'No reset link found. Please request one again.'];
    header('Location: forgot-password.php');
    exit();
}

$reset_link = $_SESSION['dev_reset_link'];
unset($_SESSION['dev_reset_link']); // Clean up the session
?>

<div class="forgot-password-container">
    <div class="form-header">
        <i class="fas fa-vial form-icon"></i>
        <h1 class="form-title">Development Reset Link</h1>
        <p class="form-subtitle">This page is for development only. In production, this link would be emailed.</p>
    </div>

    <div class="token-display-box">
        <p>Click the link below to reset your password:</p>
        <a href="<?php echo htmlspecialchars($reset_link); ?>" class="token-link" target="_blank">
            <?php echo htmlspecialchars($reset_link); ?>
        </a>
    </div>

    <a href="login.php" class="back-link">
        <i class="fas fa-arrow-left mr-2"></i> Back to Login
    </a>
</div>

<style>
.token-display-box {
    background-color: #1f2937;
    border: 1px solid #374151;
    padding: 20px;
    margin: 20px 0;
    border-radius: 8px;
    text-align: center;
    color: #d1d5db;
}
.token-link {
    color: #60a5fa;
    word-break: break-all;
    text-decoration: underline;
}
.token-link:hover {
    color: #93c5fd;
}
</style>

<?php 
require_once 'includes/auth_footer.php'; 
?>