<?php
// Set headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Load .env variables securely
require_once(__DIR__ . '/../includes/load_env.php');
$openai_api_key = getenv('OPENAI_API_KEY');

if (!$openai_api_key) {
    echo json_encode(["status" => "error", "message" => "API key missing."]);
    exit;
}

// Base suggestion map
$career_suggestions = [
    'INTJ' => ['Data Scientist', 'Software Engineer', 'Product Strategist'],
    'ENFP' => ['Marketing Specialist', 'UX Designer', 'Public Relations Manager'],
    'Artistic' => ['Graphic Designer', 'Animator', 'Multimedia Artist'],
    'Investigative' => ['Research Scientist', 'Psychologist', 'AI Engineer'],
];

// Match personality
$suggestions = [];
foreach ($career_suggestions as $key => $list) {
    if (stripos($personality, $key) !== false) {
        $suggestions = $list;
        break;
    }
}

// Fallback if no match
if (empty($suggestions)) {
    $suggestions = ['Career Coach', 'Project Assistant', 'Content Creator'];
}

// Build GPT prompt
$career_prompt = "Personality: {$personality}\n";
$career_prompt .= "Suggest 3 suitable careers with 1-line descriptions:\n";

foreach ($suggestions as $career) {
    $career_prompt .= "- {$career}\n";
}
$career_prompt .= "Give a short description for each.";

// OpenAI API Request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

$headers = [
    "Authorization: Bearer $openai_api_key",
    "Content-Type: application/json"
];

$data = [
    "model" => "gpt-3.5-turbo",
    "messages" => [
        ["role" => "user", "content" => $career_prompt]
    ],
    "temperature" => 0.7
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode([
        "status" => "error",
        "message" => "API call failed: " . curl_error($ch)
    ]);
    exit;
}

curl_close($ch);

// Decode response
$decoded = json_decode($response, true);
$gpt_output = $decoded['choices'][0]['message']['content'] ?? 'No response from AI.';

echo json_encode([
    "status" => "success",
    "personality_type" => $personality,
    "suggestions" => $suggestions,
    "descriptions" => $gpt_output
]);
?>
