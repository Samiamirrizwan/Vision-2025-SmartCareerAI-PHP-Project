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
        <i class="fas fa-file-alt icon-blue"></i>
        <h2 class="api-title">AI Resume Builder</h2>
        <p class="api-subtitle">Fill in your details below, and our AI will craft a professional, ATS-friendly resume for you.</p>
    </div>

    <div class="api-content-wrapper">
        <!-- Input Form -->
        <div class="api-form-container">
            <form id="resume-form">
                <div class="form-section">
                    <h4><i class="fas fa-user"></i> Personal Details</h4>
                    <input type="text" id="name" placeholder="Full Name" required>
                    <input type="email" id="email" placeholder="Email Address" required>
                    <input type="tel" id="phone" placeholder="Phone Number">
                    <input type="text" id="linkedin" placeholder="LinkedIn Profile URL">
                </div>

                <div class="form-section">
                    <h4><i class="fas fa-briefcase"></i> Work Experience</h4>
                    <textarea id="experience" rows="6" placeholder="Describe your work experience. Start each new role on a new line. e.g., Software Engineer at TechCorp (2020-2024) - Developed and maintained web applications..."></textarea>
                </div>

                <div class="form-section">
                    <h4><i class="fas fa-graduation-cap"></i> Education</h4>
                    <textarea id="education" rows="4" placeholder="Your educational background. e.g., B.S. in Computer Science - University of Technology (2016-2020)"></textarea>
                </div>

                <div class="form-section">
                    <h4><i class="fas fa-cogs"></i> Skills</h4>
                    <input type="text" id="skills" placeholder="Enter your skills, separated by commas (e.g., JavaScript, React, Node.js)">
                </div>

                <button type="submit" class="api-submit-btn">
                    <i class="fas fa-magic"></i> Generate My Resume
                </button>
            </form>
        </div>

        <!-- Output Area -->
        <div class="api-output-container">
            <div class="output-header">
                <h4>Generated Resume</h4>
                <button id="copy-resume-btn" class="copy-btn" title="Copy to Clipboard"><i class="far fa-copy"></i> Copy</button>
            </div>
            <div id="resume-output" class="output-content">
                <div class="placeholder-text">Your generated resume will appear here...</div>
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
