<?php
session_start();

// Include your database connection
include('includes/db.php');

/**
 * Checks if the current request is an AJAX (Asynchronous JavaScript and XML) request.
 * This helps the backend differentiate between a dynamic JS-driven submission and a standard form post.
 * @return bool True if it's an AJAX request, false otherwise.
 */
function is_ajax_request() {
    // Check for a common header sent by JS libraries
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }
    // Check for the 'Accept: application/json' header which our fetch API sends
    if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
        return true;
    }
    return false;
}

/**
 * Handles the response, sending JSON for AJAX requests or redirecting with flash messages for standard requests.
 * This makes the form functional and user-friendly even if JavaScript fails.
 *
 * @param string $status 'success' or 'error'.
 * @param string $message The message to display.
 * @param string|null $redirect_url_on_success The destination on successful login.
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
        
        $redirect_location = ($status === 'success' && $redirect_url_on_success) ? $redirect_url_on_success : 'login.php';
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

// --- 3. Input Gathering & Validation ---
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
// $remember_me = isset($_POST['remember']); 

if (empty($email) || empty($password)) {
    handle_response('error', 'Please enter both your email and password.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    handle_response('error', 'The email format is invalid. Please check your entry.');
}

// --- 4. Database Interaction & Authentication ---
try {
    $sql = "SELECT id, name, password FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // --- LOGIN SUCCESS ---
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            
            handle_response('success', 'Login successful! Redirecting to your dashboard...', 'user/dashboard.php');
        } else {
            // Password does not match.
            handle_response('error', 'Invalid email or password.');
        }
    } else {
        // No user found with that email.
        handle_response('error', 'Invalid email or password.');
    }
    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    error_log("Database error during login: " . $e->getMessage());
    handle_response('error', 'A critical server error occurred. Please contact support.');
}
?>
