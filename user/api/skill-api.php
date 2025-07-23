<?php
// No longer requires Composer or the OpenAI SDK

header('Content-Type: text/html; charset=utf-8');

/**
 * Sends a request to the Google Gemini Pro API.
 *
 * @param string $prompt The prompt to send to the AI.
 * @param string $apiKey Your Google Gemini API key.
 * @return string The AI's response or an error message.
 */
function callGeminiAPI(string $prompt, string $apiKey): string {
    $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $apiKey;

    $data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $prompt]
                ]
            ]
        ]
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            'ignore_errors' => true // To handle API errors gracefully
        ]
    ];

    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === false) {
        return "Error: Could not connect to the API.";
    }

    $result = json_decode($response, true);
    
    // Extract the content or handle potential errors from the API
    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        return $result['candidates'][0]['content']['parts'][0]['text'];
    } elseif (isset($result['error']['message'])) {
        return "API Error: " . htmlspecialchars($result['error']['message']);
    } else {
        return "Error: Received an unexpected response from the API.";
    }
}

$skills = $_POST['skills'] ?? '';
if (empty(trim($skills))) {
    echo "Please provide some skills.";
    exit;
}

// --- CONFIGURATION ---
// Replace with your actual Google Gemini API key
$apiKey = 'AIzaSyCk01jvt7t8vR78VZnnb4rTEZU8kW4l5dk'; 

// Combine system instruction and user input into a single, clear prompt for Gemini
$prompt = "You are a career growth advisor. Your goal is to analyze the provided skills, identify strengths, and suggest concrete areas for improvement or complementary skills to learn. \n\nSkills Provided:\n" . $skills;

$ai_response = callGeminiAPI($prompt, $apiKey);

// Format the response for HTML display
echo nl2br(htmlspecialchars($ai_response));