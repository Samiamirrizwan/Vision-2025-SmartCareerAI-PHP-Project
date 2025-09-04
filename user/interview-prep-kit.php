<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

include('includes/header.php');

// Placeholder data
$prep_topics = [
    ['title' => 'Common Behavioral Questions', 'icon' => 'fas fa-comments', 'description' => 'Practice answering questions about teamwork, leadership, and problem-solving.'],
    ['title' => 'Technical Interview Simulation', 'icon' => 'fas fa-laptop-code', 'description' => 'Run through coding challenges and system design problems.'],
    ['title' => 'Salary Negotiation Tactics', 'icon' => 'fas fa-hand-holding-usd', 'description' => 'Learn how to research and negotiate your salary effectively.'],
    ['title' => 'Company Research Guide', 'icon' => 'fas fa-building', 'description' => 'A checklist for researching a company before your interview.'],
];

?>
<main>
    <div class="page-header">
        <h2 class="page-title">Interview Prep Kit</h2>
        <p class="page-subtitle">Resources to help you ace your next interview.</p>
    </div>

    <div class="widget-grid">
        <?php foreach ($prep_topics as $topic): ?>
        <div class="dashboard-card animated-card">
            <div class="card-header">
                <i class="<?php echo $topic['icon']; ?> icon-blue"></i>
                <h3 class="card-title"><?php echo htmlspecialchars($topic['title']); ?></h3>
            </div>
            <p class="card-description"><?php echo htmlspecialchars($topic['description']); ?></p>
            <a href="https://www.interviewbit.com/interview-preparation-kit/" class="card-link blue">Start Learning &rarr;</a>
        </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include('includes/footer.php'); ?>