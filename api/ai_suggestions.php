<?php
// No need for API keys, but we can load other env variables if we want
require_once 'load_env.php';

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// --- Main Logic ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prompt = strtolower($_POST['prompt'] ?? '');

    if (empty($prompt)) {
        // Send an error response if the prompt is empty
        http_response_code(400);
        echo json_encode(['error' => 'Prompt cannot be empty.']);
        exit;
    }

    // Generate the AI career suggestions
    $suggestion = generate_career_advice($prompt);

    // The frontend expects a specific JSON structure, which we replicate here.
    $response_data = [
        'choices' => [
            [
                'message' => [
                    'content' => $suggestion
                ]
            ]
        ]
    ];

    echo json_encode($response_data);
} else {
    // Handle cases where the script is accessed directly via GET request
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method. Please use POST.']);
}


/**
 * Generates career advice based on a user's input prompt.
 * This function simulates an AI response.
 *
 * @param string $prompt The user's input (e.g., personality type, interest).
 * @return string The generated career advice.
 */
function generate_career_advice($prompt) {
    // Sanitize the prompt for cleaner matching
    $sanitized_prompt = htmlspecialchars(trim($prompt));
    $model_name = $_ENV['AI_MODEL_NAME'] ?? 'Career Counselor AI';

    $advice = "Based on your input of '<b>{$sanitized_prompt}</b>', the {$model_name} suggests the following career paths:\n\n";

    // Create a simple rules-based suggestion engine
    if (strpos($sanitized_prompt, 'intj') !== false) {
        $advice .= "• <b>Strategic Planner or Systems Analyst:</b> Your logical and strategic mindset is perfect for analyzing complex systems and developing long-range plans.\n";
        $advice .= "• <b>Software or Data Architect:</b> You excel at designing complex, efficient systems, making you a natural fit for high-level tech roles.\n";
        $advice .= "• <b>Management Consultant:</b> Your ability to see inefficiencies and devise solutions would be highly valued in helping businesses improve.\n";
    } elseif (strpos($sanitized_prompt, 'enfp') !== false) {
        $advice .= "• <b>Counselor or Psychologist:</b> Your empathy and insight into human motivation make you ideal for helping others navigate their challenges.\n";
        $advice .= "• <b>Public Relations Specialist:</b> Your enthusiasm and strong communication skills are perfect for shaping public perception and building relationships.\n";
        $advice .= "• <b>Creative Director or Entrepreneur:</b> Your innovative ideas and ability to inspire others would allow you to thrive in roles where you can bring a vision to life.\n";
    } elseif (strpos($sanitized_prompt, 'artistic') !== false) {
        $advice .= "• <b>Graphic Designer or Illustrator:</b> Use your creativity to produce visual content for brands, media, or publications.\n";
        $advice .= "• <b>Photographer or Videographer:</b> Capture moments and tell stories through visual media.\n";
        $advice .= "• <b>UI/UX Designer:</b> Combine your artistic talent with technology to design beautiful and user-friendly digital experiences.\n";
    } elseif (strpos($sanitized_prompt, 'investigative') !== false) {
        $advice .= "• <b>Data Scientist or Market Researcher:</b> Use your analytical skills to uncover insights and trends from data.\n";
        $advice .= "• <b>Journalist or Detective:</b> Your curiosity and desire to uncover the truth would be well-suited to fields that require in-depth investigation.\n";
        $advice .= "• <b>Medical Scientist:</b> Apply your methodical approach to research and help advance our understanding of diseases and treatments.\n";
    } else {
        // Generic fallback response
        $advice .= "• <b>Software Developer:</b> A field with high demand that rewards problem-solving skills.\n";
        $advice .= "• <b>Digital Marketer:</b> A dynamic field for those who are creative and enjoy understanding consumer behavior.\n";
        $advice .= "• <b>Project Manager:</b> Ideal for organized individuals who can lead teams and manage resources effectively.\n\n";
        $advice .= "<i>Tip: Your input was quite unique! Try using keywords like 'artistic', 'investigative', or a personality type like 'INTJ' for more tailored suggestions.</i>";
    }

    return $advice;
}
?>
