<?php
session_start();
// No need for db.php on this page unless you plan to save results.

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// --- Career Path Definitions ---
// This map links the answer categories to career profiles.
$career_profiles = [
    'a' => [
        'path' => 'Software Engineering',
        'analysis' => 'Your responses indicate a strong inclination towards logical thinking, problem-solving, and building functional systems. A career in Software Engineering, where you can design and create tangible solutions, aligns perfectly with your interests.'
    ],
    'b' => [
        'path' => 'Creative Design',
        'analysis' => 'Your answers suggest a passion for creativity, aesthetics, and user experience. You enjoy crafting new ideas and visual concepts. A career in Creative Design, such as UI/UX or graphic design, would be an excellent fit.'
    ],
    'c' => [
        'path' => 'Data Analysis',
        'analysis' => 'You show a strong aptitude for pattern recognition, research, and making data-driven decisions. A career as a Data Analyst, where you can uncover insights from complex information, is highly recommended.'
    ],
    'd' => [
        'path' => 'Project Management',
        'analysis' => 'Your responses highlight skills in leadership, organization, and collaboration. You are motivated by guiding teams and achieving collective goals. A career in Project Management would leverage these strengths effectively.'
    ]
];

// --- Scoring Logic ---
$career_path = "Creative Design"; // Default path
$analysis = "Your answers suggest a passion for creativity and visual communication. A career in Creative Design, such as graphic or UI/UX design, could be a great fit.";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scores = [
        'a' => 0, // Analytical/Technical
        'b' => 0, // Creative/Artistic
        'c' => 0, // Data-driven/Research
        'd' => 0  // Leadership/Collaborative
    ];

    // Tally the scores for each answer category
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'q') === 0 && isset($scores[$value])) {
            $scores[$value]++;
        }
    }

    // Determine the category with the highest score
    if (array_sum($scores) > 0) {
        $top_category = array_keys($scores, max($scores))[0];
        $result = $career_profiles[$top_category];
        $career_path = $result['path'];
        $analysis = $result['analysis'];
    }
}

// Store the final career path in the session for the roadmap page
$_SESSION['career_path'] = $career_path;

// --- Page Display ---
include('includes/header.php');
?>

<main class="content-wrapper" style="position: relative; z-index: 2;">
    <div class="page-header">
        <div>
            <h1 class="page-title">Your Test Results</h1>
            <p class="page-subtitle">Based on your aptitude test, here's your personalized career analysis.</p>
        </div>
    </div>

    <div class="results-card animated-card">
        <div class="card-content">
            <h3 class="widget-title">Recommended Career Path:</h3>
            <p class="career-path"><?php echo htmlspecialchars($career_path); ?></p>
            
            <h3 class="widget-title mt-6">Analysis:</h3>
            <p class="text-secondary mt-2"><?php echo htmlspecialchars($analysis); ?></p>
            
            <h3 class="widget-title mt-6">Next Steps:</h3>
            <ul class="list-disc pl-6 text-secondary mt-2">
                <li>Review your personalized career roadmap for a step-by-step plan.</li>
                <li>Connect with experienced mentors in your recommended field.</li>
                <li>Explore recommended courses and resources to build your skills.</li>
            </ul>
        </div>
        
        <div class="results-actions">
            <a href="career-roadmap.php" class="modal-submit-btn">View Your Career Roadmap</a>
            <a href="mentor-connect.php" class="modal-submit-btn" style="background-color: var(--green);">Connect with Mentors</a>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>
