<?php
session_start();

// Include your database connection
include('includes/db.php');

/**
 * Checks if the current request is an AJAX (Asynchronous JavaScript and XML) request.
 * @return bool True if it's an AJAX request, false otherwise.
 */
function is_ajax_request() {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }
    if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
        return true;
    }
    return false;
}

/**
 * Handles the response, sending JSON for AJAX or redirecting with flash messages for standard requests.
 *
 * @param string $status 'success' or 'error'.
 * @param string $message The message to display.
 * @param string|null $redirect_url_on_success The destination on successful registration.
 */
function handle_response($status, $message, $redirect_url_on_success = null) {
    if (is_ajax_request()) {
        // --- Handle AJAX Request: Send JSON response ---
        header('Content-Type: application/json');
        $response = ['status' => $status, 'message' => $message];
        if ($status === 'success' && $redirect_url_on_success) {
            $response['redirect_url'] = $redirect_url_on_success;
        }
        echo json_encode($response);
    } else {
        // --- Handle Standard Request: Use Session Flash Messages & Redirect ---
        $_SESSION['flash_message'] = [
            'type' => $status === 'success' ? 'success' : 'danger',
            'message' => $message
        ];
        // On error, save the user's input to repopulate the form
        if ($status === 'error') {
            $_SESSION['old_input'] = $_POST;
        }
        
        // Redirect to the appropriate page
        $redirect_location = ($status === 'success' && $redirect_url_on_success) ? $redirect_url_on_success : 'register.php';
        header("Location: " . $redirect_location);
    }
    exit();
}

// --- 1. Request Method Validation ---
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    handle_response('error', 'Invalid request method.');
}

// --- 2. CSRF Token Validation ---
if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    handle_response('error', 'Invalid security token. Please refresh and try again.');
}

// --- 3. Input Gathering & Sanitization ---
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';
$terms_agreed = isset($_POST['terms']);

// --- 4. Comprehensive Server-Side Validation ---
if (empty($name) || empty($email) || empty($password) || empty($password_confirm)) {
    handle_response('error', 'All fields are required. Please fill them out.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    handle_response('error', 'Please enter a valid email address.');
}
if (strlen($password) < 8) {
    handle_response('error', 'Password must be at least 8 characters long.');
}
if ($password !== $password_confirm) {
    handle_response('error', 'The passwords you entered do not match.');
}
if (!$terms_agreed) {
    handle_response('error', 'You must agree to the Terms of Service to create an account.');
}

// --- 5. Database Interaction ---
try {
    $sql_check = "SELECT id FROM users WHERE email = ? LIMIT 1";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        handle_response('error', 'An account with this email address already exists.');
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql_insert = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt_insert->execute()) {
            handle_response('success', 'Account created successfully! You can now log in.', 'login.php');
        } else {
            error_log("Registration failed: " . $stmt_insert->error);
            handle_response('error', 'A server error occurred. Please try again later.');
        }
        $stmt_insert->close();
    }
    $stmt_check->close();
    $conn->close();

} catch (Exception $e) {
    error_log("Database error during registration: " . $e->getMessage());
    handle_response('error', 'A critical server error occurred. Please contact support.');
}
?>
