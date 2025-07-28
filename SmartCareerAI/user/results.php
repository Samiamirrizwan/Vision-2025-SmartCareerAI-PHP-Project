<?php
session_start();
require_once '../includes/db.php'; // Ensure you have a db connection

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// This logic should be expanded for a real application
$yes_answers = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'q') === 0 && $value === 'yes') {
            $yes_answers++;
        }
    }
}

// Example of a simple determination logic
if ($yes_answers >= 3) {
    $career_path = "Software Engineering";
    $analysis = "Your responses indicate a strong inclination towards problem-solving and technical challenges. Software Engineering is a field that aligns with your interests and has a high demand in the job market.";
} else {
    $career_path = "Creative Design";
    $analysis = "Your answers suggest a passion for creativity and visual communication. A career in Creative Design, such as graphic or UI/UX design, could be a great fit.";
}

include('includes/header.php');
?>
<main>
    <div class="page-header">
        <h2 class="page-title">Your Test Results</h2>
    </div>

    <div class="results-card">
        <p class="page-subtitle">Based on your aptitude test, here's your personalized career analysis:</p>
        
        <div class="mt-6">
            <h3 class="widget-title">Recommended Career Path:</h3>
            <p class="career-path"><?php echo htmlspecialchars($career_path); ?></p>
        </div>
        <div class="mt-6">
            <h3 class="widget-title">Analysis:</h3>
            <p class="text-secondary mt-2"><?php echo htmlspecialchars($analysis); ?></p>
        </div>
        <div class="mt-6">
            <h3 class="widget-title">Next Steps:</h3>
            <ul class="list-disc pl-6 text-secondary mt-2">
                <li>Review your personalized career roadmap for a step-by-step plan.</li>
                <li>Connect with experienced mentors in your recommended field.</li>
                <li>Explore recommended courses and resources to build your skills.</li>
            </ul>
        </div>
        <div class="results-actions">
            <a href="career-roadmap.php" class="modal-submit-btn">View Career Roadmap</a>
            <a href="mentor-connect.php" class="modal-submit-btn" style="background-color: var(--green);">Connect with Mentors</a>
        </div>
    </div>
</main>
<?php include('includes/footer.php'); ?>