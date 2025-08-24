<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
// Include the main header
include('includes/header.php');
?>

<!-- Link to the dedicated stylesheet for API pages -->
<link rel="stylesheet" href="assets/css/api.css">
<link rel="stylesheet" href="assets/css/style.css">

<main class="api-page-container">
    <div class="api-header">
        <i class="fas fa-chart-line icon-purple"></i>
        <h2 class="api-title">AI Skill Analyzer</h2>
        <p class="api-subtitle">Enter your skills to receive an analysis of your strengths and personalized recommendations for growth.</p>
    </div>

    <div class="api-content-wrapper">
        <!-- Input Form -->
        <div class="api-form-container">
            <form id="skill-form">
                <div class="form-section">
                    <h4><i class="fas fa-lightbulb"></i> Your Skills</h4>
                    <p>Enter your professional skills, separated by commas.</p>
                    <input type="text" id="skills-input" placeholder="e.g., Python, React, Project Management, SQL" required>
                </div>

                <button type="submit" class="api-submit-btn purple">
                    <i class="fas fa-search"></i> Analyze My Skills
                </button>
            </form>
        </div>

        <!-- Output Area -->
        <div class="api-output-container">
             <div class="output-header">
                <h4>Analysis & Recommendations</h4>
                <button id="copy-skills-btn" class="copy-btn" title="Copy to Clipboard"><i class="far fa-copy"></i> Copy</button>
            </div>
            <div id="skill-output" class="output-content">
                <div class="placeholder-text">Your skill analysis will appear here...</div>
            </div>
        </div>
    </div>
</main>

<!-- Link to the dedicated script for API pages -->
<script src="assets/js/api.js"></script>

<?php
// Include the main footer
include('includes/footer.php');
?>
