<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
// Assuming you have the user's name in the session
$user_name = $_SESSION['user_name'] ?? 'User';

include('includes/header.php');
?>

<main>
    <div class="page-header">
        <div>
            <h2 class="page-title">Welcome Back, <?php echo htmlspecialchars($user_name); ?>!</h2>
            <p class="page-subtitle">Here's your career intelligence overview for today.</p>
        </div>
        <div id="live-clock">
            </div>
    </div>

    <div class="dashboard-layout">
        <div class="main-content">
            <div class="widget-grid">
                <div class="dashboard-card">
                    <div class="card-header">
                        <i class="fas fa-file-alt" style="color: #5DADE2;"></i>
                        <h3 class="card-title">AI Resume Builder</h3>
                    </div>
                    <p class="card-description">Create a professional, ATS-friendly resume. Our AI provides suggestions to highlight your skills and experiences effectively.</p>
                    <a href="#" class="card-link blue">Build My Resume &rarr;</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-header">
                        <i class="fas fa-briefcase" style="color: #58D68D;"></i>
                        <h3 class="card-title">Job Recommendations</h3>
                    </div>
                    <p class="card-description">Discover job opportunities perfectly matched to your profile and skills.</p>
                    <a href="#" class="card-link green">View Matched Jobs &rarr;</a>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-header">
                        <i class="fas fa-chart-line" style="color: #AF7AC5;"></i>
                        <h3 class="card-title">Skill Analysis</h3>
                    </div>
                    <p class="card-description">Get a detailed analysis of your skills to identify strengths and areas for development.</p>
                    <a href="#" class="card-link purple">Analyze My Skills &rarr;</a>
                </div>
            </div>
            
            <div class="sidebar-widget">
                 <h3 class="widget-title">Latest News & Career Articles</h3>
                 <ul class="article-list">
                     <li>
                         <a href="#" target="_blank" class="article-title">The Top 10 In-Demand Tech Skills for 2025</a>
                         <span class="article-meta">From TechCrunch | 5 min read</span>
                     </li>
                     <li>
                         <a href="#" target="_blank" class="article-title">How to Ace a Behavioral Interview: A Step-by-Step Guide</a>
                         <span class="article-meta">From LinkedIn Careers Blog | 8 min read</span>
                     </li>
                 </ul>
            </div>
        </div>

        <aside class="sidebar">
            <div class="sidebar-widget">
                <h3 class="widget-title">Notifications</h3>
                <ul class="notifications-list">
                    <li>
                        <span class="status-indicator success"></span>
                        <span>System status: All services operational.</span>
                    </li>
                </ul>
            </div>
        
            <div class="sidebar-widget">
                <h3 class="widget-title">Profile Completion</h3>
                <p class="progress-text">Complete your profile to get more accurate recommendations.</p>
                <div class="progress-bar">
                    <div class="progress" style="width: 75%;"></div>
                </div>
                <p style="text-align: right; font-size: 0.9rem; margin-top: 0.5rem;">75% Complete</p>
            </div>

            <div class="sidebar-widget">
                <h3 class="widget-title">Quick Actions</h3>
                <ul class="quick-actions-list">
                    <li><a href="#"><i class="fas fa-user-edit"></i> Update Your Profile</a></li>
                    <li><a href="#"><i class="fas fa-bookmark"></i> View Saved Jobs</a></li>
                    <li><a href="test.php"><i class="fas fa-tasks"></i> Retake Aptitude Test</a></li>
                    <li><a href="#"><i class="fas fa-headset"></i> Contact Support</a></li>
                </ul>
            </div>
        </aside>
    </div>
</main>

<?php
include('includes/footer.php');
?>
