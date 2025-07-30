<?php
session_start();
require_once('../includes/db.php'); // Note the path change to ../

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}

if (!isset($_GET['session_id'])) {
    die("No session specified.");
}

$session_id = (int)$_GET['session_id'];
$user_id = (int)$_SESSION['user_id'];

// --- Fetch all report data from the database ---
$report_data = [];

// Query to get user info, session date, and result summary
$sql = "SELECT u.name, u.email, s.started_at, r.category_scores, r.ai_feedback
        FROM results r
        JOIN test_sessions s ON r.session_id = s.id
        JOIN users u ON r.user_id = u.id
        WHERE r.session_id = ? AND r.user_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $session_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$report_data = mysqli_fetch_assoc($result);

if (!$report_data) {
    die("Report not found or you do not have permission to view it.");
}

// Query to get all questions and the user's answers for this session
$answers_sql = "SELECT tq.question_text, tq.option_a, tq.option_b, tq.option_c, tq.option_d, ta.selected_option
                FROM test_answers ta
                JOIN test_questions tq ON ta.question_id = tq.id
                WHERE ta.session_id = ?
                ORDER BY tq.id";
$answer_stmt = mysqli_prepare($conn, $answers_sql);
mysqli_stmt_bind_param($answer_stmt, "i", $session_id);
mysqli_stmt_execute($answer_stmt);
$answers_result = mysqli_stmt_get_result($answer_stmt);
$report_data['answers'] = mysqli_fetch_all($answers_result, MYSQLI_ASSOC);

// Decode the JSON scores
$report_data['scores'] = json_decode($report_data['category_scores'], true);

// Determine the recommended career path from the feedback
$career_path = "Not Determined";
if (strpos($report_data['ai_feedback'], 'Software Engineering') !== false) $career_path = 'Software Engineering';
if (strpos($report_data['ai_feedback'], 'Creative Design') !== false) $career_path = 'Creative Design';
if (strpos($report_data['ai_feedback'], 'Data Analysis') !== false) $career_path = 'Data Analysis';
if (strpos($report_data['ai_feedback'], 'Project Management') !== false) $career_path = 'Project Management';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Aptitude Report</title>
    <link rel="stylesheet" href="../assets/css/report.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="report-container">
        <header class="report-header">
            <h1>Career Aptitude Report</h1>
            <div class="report-meta">
                <p><strong>User:</strong> <?php echo htmlspecialchars($report_data['name']); ?></p>
                <p><strong>Date:</strong> <?php echo date("F j, Y, g:i a", strtotime($report_data['started_at'])); ?></p>
            </div>
            <button onclick="window.print()" class="print-btn"><i class="fas fa-print"></i> Print Report</button>
        </header>

        <section class="report-section summary-section">
            <h2>Test Summary</h2>
            <div class="summary-grid">
                <div class="summary-card">
                    <h3>Recommended Path</h3>
                    <p class="highlight-text"><?php echo htmlspecialchars($career_path); ?></p>
                </div>
                <div class="summary-card">
                    <h3>AI-Generated Analysis</h3>
                    <p><?php echo htmlspecialchars($report_data['ai_feedback']); ?></p>
                </div>
            </div>
        </section>

        <section class="report-section">
            <h2>Category Scores</h2>
            <div class="scores-container">
                <?php
                $score_labels = ['a' => 'Analytical', 'b' => 'Creative', 'c' => 'Investigative', 'd' => 'Leadership'];
                foreach($report_data['scores'] as $cat => $score):
                    $percentage = (count($report_data['answers']) > 0) ? ($score / count($report_data['answers'])) * 100 : 0;
                ?>
                <div class="score-item">
                    <label><?php echo $score_labels[$cat]; ?></label>
                    <div class="progress-bar-report">
                        <div class="progress-report" style="width: <?php echo $percentage; ?>%;">
                            <?php echo round($percentage); ?>%
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="report-section">
            <h2>Detailed Answers</h2>
            <table class="answers-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Your Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($report_data['answers'] as $index => $answer): 
                        $option_key = 'option_' . $answer['selected_option'];
                    ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($answer['question_text']); ?></td>
                        <td><?php echo htmlspecialchars($answer[$option_key]); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <footer class="report-footer">
            <p>&copy; <?php echo date("Y"); ?> SmartCareerAI. This report is confidential and intended for the specified user only.</p>
        </footer>
    </div>
    <script src="../assets/js/report.js"></script>
</body>
</html>
