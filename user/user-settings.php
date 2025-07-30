<?php
session_start();

// Redirect to login page if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../includes/db.php';

$user_id = $_SESSION['user_id'];
$user = null;
$error_message = '';
$success_message = '';

// Fetch current user details
$stmt = $conn->prepare("SELECT name, email, theme, categories, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    session_destroy();
    header('Location: login.php?error=user_not_found');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $theme = $_POST['theme'] === 'light' ? 'light' : 'dark';
    $categories = filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $profile_image_path = $user['profile_image'];

    // Handle file upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $img_name = time() . '_' . basename($_FILES['profile_image']['name']);
        $target_file = $upload_dir . $img_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types) && $_FILES['profile_image']['size'] <= 2000000) {
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                $profile_image_path = $target_file;
            } else {
                $error_message = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error_message = "Invalid file type or size (max 2MB).";
        }
    }

    if (empty($error_message) && $email) {
        $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, theme = ?, categories = ?, profile_image = ? WHERE id = ?");
        $update_stmt->bind_param("sssssi", $name, $email, $theme, $categories, $profile_image_path, $user_id);
        
        if ($update_stmt->execute()) {
            $_SESSION['user_name'] = $name;
            header('Location: user-settings.php?success=1');
            exit();
        } else {
            $error_message = "Database update failed. Please try again.";
        }
        $update_stmt->close();
    } elseif (!$email) {
        $error_message = "The provided email address is not valid.";
    }
}

include_once 'includes/header.php';
?>

<main>
    <div class="page-header">
        <h2 class="page-title">Account Settings</h2>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert success">Settings updated successfully!</div>
    <?php endif; ?>
    <?php if (!empty($error_message)): ?>
        <div class="alert error"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <?php if ($user): ?>
    <form action="user-settings.php" method="POST" enctype="multipart/form-data" class="settings-form">
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="profile_image">Profile Picture:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*">
            <?php if (!empty($user['profile_image'])): ?>
                <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Current profile picture" style="max-width: 100px; margin-top: 10px; border-radius: 50%;">
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="theme">Theme:</label>
            <select id="theme" name="theme">
                <option value="dark" <?php echo ($user['theme'] === 'dark') ? 'selected' : ''; ?>>Dark</option>
                <option value="light" <?php echo ($user['theme'] === 'light') ? 'selected' : ''; ?>>Light</option>
            </select>
        </div>

        <div class="form-group">
            <label for="categories">Preferred Job Categories:</label>
            <input type="text" id="categories" name="categories" value="<?php echo htmlspecialchars($user['categories'] ?? ''); ?>" placeholder="e.g., Software Development, Marketing">
        </div>

        <button type="submit" class="modal-submit-btn" style="width: auto; padding: 0.8rem 2rem;">Save Changes</button>
    </form>
    <?php else: ?>
        <p class="alert error">Could not load user settings. Please contact support.</p>
    <?php endif; ?>
</main>

<?php
include_once 'includes/footer.php';
?>