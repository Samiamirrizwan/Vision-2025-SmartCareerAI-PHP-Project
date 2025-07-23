<?php
session_start();

// Redirect to login page if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// 1. Include the database connection
// This assumes user-settings.php is in the root project folder, next to the 'includes' folder.
require_once '../includes/db.php';

$user_id = $_SESSION['user_id'];
$user = null;
$error_message = '';
$success_message = '';

// Fetch current user details using MySQLi
$sql = "SELECT name, email, theme, categories, profile_image FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // If user exists in session but not in DB, force logout
    if (!$user) {
        session_destroy();
        header('Location: login.php?error=user_not_found');
        exit();
    }
} else {
    // For production, log this error instead of displaying it
    die("Error preparing the user data query: " . mysqli_error($conn));
}

// Handle form submission to update settings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $theme = $_POST['theme'] === 'light' ? 'light' : 'dark'; // Whitelist the theme value
    $categories = filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $profile_image_path = $user['profile_image']; // Default to old image

    // Handle profile image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Create an 'uploads' folder in your project root
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $img_name = time() . '_' . basename($_FILES['profile_image']['name']);
        $target_file = $upload_dir . $img_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate file type and size (e.g., max 2MB)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types) && $_FILES['profile_image']['size'] <= 2000000) {
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                $profile_image_path = $target_file;
            } else {
                $error_message = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error_message = "Invalid file type or size (max 2MB). Allowed types: jpg, png, gif.";
        }
    }

    // If no upload error, proceed to update the database
    if (empty($error_message) && $email) {
        $update_sql = "UPDATE users SET name = ?, email = ?, theme = ?, categories = ?, profile_image = ? WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        
        if ($update_stmt) {
            mysqli_stmt_bind_param($update_stmt, "sssssi", $name, $email, $theme, $categories, $profile_image_path, $user_id);
            if (mysqli_stmt_execute($update_stmt)) {
                $_SESSION['user_name'] = $name; // Update session with the new name
                header('Location: user-settings.php?success=1'); // Redirect to show success
                exit();
            } else {
                $error_message = "Database update failed. Please try again.";
            }
            mysqli_stmt_close($update_stmt);
        } else {
            $error_message = "Error preparing the update query: " . mysqli_error($conn);
        }
    } elseif (!$email) {
        $error_message = "The provided email address is not valid.";
    }
}

// 2. Include the header AFTER all PHP logic.
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

    <?php if ($user): // Only show the form if user data was successfully fetched ?>
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
// 3. Include the footer at the very end.
include_once 'includes/footer.php';
?>