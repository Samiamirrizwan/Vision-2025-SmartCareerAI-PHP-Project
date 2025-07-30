<?php
// This script acts as an API endpoint for the contact form.
header('Content-Type: application/json');

// Ensure mail_config.php is loaded to access the sending function.
// The path is relative to this file's location in the project root.
require_once 'utils/mail_config.php';

// --- Security: Only allow POST requests ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// --- Sanitize and Validate Input ---
$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
$subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING));
$message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Please fill out all required fields.']);
    exit;
}

if (!$email) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Please provide a valid email address.']);
    exit;
}

// --- Call the Centralized Email Sending Function ---
// The actual sending logic is now handled by mail_config.php
$is_sent = send_contact_email($name, $email, $subject, $message);


// --- Provide JSON Response to the Frontend ---
if ($is_sent) {
    echo json_encode(['success' => true, 'message' => 'Thank you! Your message has been sent successfully.']);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'message' => 'Sorry, we could not send your message at this time. Please try again later or contact support directly.']);
}

?>
