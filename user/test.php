<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Include database connection and site header
require_once('includes/db.php');
include('includes/header.php');

// Fetch questions from the database
$questions = [];
$sql = "SELECT id, question_text, option_a, option_b, option_c, option_d FROM test_questions ORDER BY id";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Re-structure the options into a nested array for easier handling in JS
        $questions[] = [
            'id' => $row['id'],
            'question' => $row['question_text'],
            'options' => [
                'a' => $row['option_a'],
                'b' => $row['option_b'],
                'c' => $row['option_c'],
                'd' => $row['option_d']
            ]
        ];
    }
}
$questions_json = json_encode($questions);
?>

<!-- Container for the 3D particles animation -->
<div id="particles-js"></div>

<!-- The main content now correctly uses the content-wrapper class from the overall layout -->
<main class="content-wrapper" style="position: relative; z-index: 2;">
    <div class="test-container animated-card">
        <div class="page-header">
            <div>
                <h1 class="page-title">Career Aptitude Test</h1>
                <p class="page-subtitle">Answer the questions to discover career paths that align with your personality and interests.</p>
            </div>
        </div>
        
        <form action="results.php" method="post" id="career-test-form">
            <!-- Container where JavaScript will inject the questions -->
            <div id="test-questions-container">
                <!-- Loader will be shown by JS if no questions are found -->
            </div>

            <!-- Test Navigation -->
            <div class="test-navigation">
                <button type="button" id="test-prev" class="test-prev" disabled>Previous</button>
                <div class="test-progress">
                    <div class="test-progress-bar" id="test-progress-bar"></div>
                </div>
                <button type="button" id="test-next" class="test-next">Next</button>
                <input type="submit" value="Submit" id="test-submit" class="test-submit" style="display: none;">
            </div>
        </form>
    </div>
</main>

<!-- Pass PHP questions to JavaScript -->
<script>
    const dbQuestions = <?php echo $questions_json; ?>;
</script>

<!-- Link to the dedicated CSS file for the test page -->
<link rel="stylesheet" href="assets/css/test.css">

<!-- Link to the Particles.js library -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<!-- Link to the dedicated JavaScript for the test functionality -->
<script src="assets/js/test.js"></script>

<?php
// The site footer is included last, after all main content and scripts.
include('includes/footer.php');
?>
