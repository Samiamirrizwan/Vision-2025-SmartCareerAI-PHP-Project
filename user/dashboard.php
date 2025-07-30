<?php
session_start();

// Redirect to login if user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Fetch user's name from session, default to 'User'
$user_name = $_SESSION['user_name'] ?? 'User';

// Include the site header
include('includes/header.php');
?>

<link rel="stylesheet" href="assets/css/style.css">
<script src="../assets/js/script.js"></script>
<main>
    <div class="page-header">
        <div>
            <h2 class="page-title">Welcome Back, <?php echo htmlspecialchars($user_name); ?>!</h2>
            <p class="page-subtitle">Your career intelligence overview for today.</p>
        </div>
        <div id="live-clock" class="live-clock"></div>
    </div>

    <div class="dashboard-layout">
        <!-- Main Content Area -->
        <div class="main-content">
            <div class="widget-grid">
                <!-- AI Resume Builder Card -->
                <div class="dashboard-card animated-card" id="resume-builder-card">
                    <div class="card-header">
                        <i class="fas fa-file-alt icon-blue"></i>
                        <h3 class="card-title">AI Resume Builder</h3>
                    </div>
                    <p class="card-description">Generate a professional, ATS-friendly resume. Our AI will help you highlight your skills and experiences effectively.</p>
                    <a href="resume-api.php" class="card-link blue">Build My Resume &rarr;</a>
                </div>

                <!-- Skill Analysis Card -->
                <div class="dashboard-card animated-card" id="skill-analysis-card">
                    <div class="card-header">
                        <i class="fas fa-chart-line icon-purple"></i>
                        <h3 class="card-title">Skill Analysis</h3>
                    </div>
                    <p class="card-description">Get a detailed analysis of your current skills to identify strengths and areas for strategic development.</p>
                    <a href="skill-api.php" class="card-link purple">Analyze My Skills &rarr;</a>
                </div>
                
                <!-- Job Recommendations Card -->
                <div class="dashboard-card animated-card">
                    <div class="card-header">
                        <i class="fas fa-briefcase icon-green"></i>
                        <h3 class="card-title">Job Recommendations</h3>
                    </div>
                    <p class="card-description">Discover job opportunities from top companies that are perfectly matched to your profile and skills.</p>
                    <a href="job-recommendations.php" class="card-link green">View Matched Jobs &rarr;</a>
                </div>

                <!-- Interview Prep Card -->
                <div class="dashboard-card animated-card">
                    <div class="card-header">
                        <i class="fas fa-microphone-alt icon-orange"></i>
                        <h3 class="card-title">Interview Prep Kit</h3>
                    </div>
                    <p class="card-description">Practice common interview questions and get AI-powered feedback on your answers to build confidence.</p>
                    <a href="interview-prep-kit.php" class="card-link orange">Start Prep &rarr;</a>
                </div>
            </div>
            
            <!-- News & Articles Widget -->
            <div class="sidebar-widget animated-card">
                 <h3 class="widget-title">Latest News & Career Articles</h3>
                 <ul class="article-list">
                     <li>
                         <a href="https://www.researchgate.net/post/Top_10_In-Demand_Tech_Skills_for_2030_Future-Proof_Your_Career_in_a_Fast-Changing_World" target="_blank" class="article-title">The Top 10 In-Demand Tech Skills for 2025</a>
                         <span class="article-meta">From TechCrunch | 5 min read</span>
                     </li>
                     <li>
                         <a href="https://www.albright.edu/wp-content/uploads/2020/08/Behavioral-Interviewing-Guide.pdf" target="_blank" class="article-title">How to Ace a Behavioral Interview: A Step-by-Step Guide</a>
                         <span class="article-meta">From LinkedIn Careers Blog | 8 min read</span>
                     </li>
                     <li>
                         <a href="https://dcpweb.co.uk/blog/the-art-of-digital-networking-building-connections-that-matter" target="_blank" class="article-title">Networking in the Digital Age: Building Real Connections</a>
                         <span class="article-meta">From Forbes | 6 min read</span>
                     </li>
                 </ul>
            </div>
        </div>

        <!-- Sidebar Area -->
        <aside class="sidebar">
            <div class="sidebar-widget animated-card">
                <h3 class="widget-title">Profile Completion</h3>
                <p class="progress-text">Complete your profile for more accurate AI recommendations.</p>
                <div class="progress-bar">
                    <div class="progress" style="width: 75%;"></div>
                </div>
                <p class="progress-label">75% Complete</p>
            </div>

            <div class="sidebar-widget animated-card">
                <h3 class="widget-title">Quick Actions</h3>
                <ul class="quick-actions-list">
                    <li><a href="user-settings.php"><i class="fas fa-user-edit"></i> Update Your Profile</a></li>
                    <li><a href="job-recommendations.php"><i class="fas fa-bookmark"></i> View Saved Jobs</a></li>
                    <li><a href="test.php"><i class="fas fa-tasks"></i> Retake Aptitude Test</a></li>
                    <li><a href="#"><i class="fas fa-headset"></i> Contact Support</a></li>
                </ul>
            </div>

            <div class="sidebar-widget animated-card">
                <h3 class="widget-title">Notifications</h3>
                <ul class="notifications-list">
                    <li>
                        <span class="status-indicator success"></span>
                        <span>System status: All services operational.</span>
                    </li>
                     <li>
                        <span class="status-indicator info"></span>
                        <span>New feature: Interview Prep Kit added.</span>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</main>

<!-- Modal for AI Resume Builder -->
<div id="resume-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div class="modal-header">
            <i class="fas fa-file-alt icon-blue"></i>
            <h2>AI Resume Builder</h2>
        </div>
        <p>Paste your job history, skills, and education below. Our AI will craft a professional resume for you.</p>
        <form id="resume-form">
            <textarea id="resume-input" rows="10" placeholder="e.g., John Doe - Software Engineer at Tech Corp (2020-2024)..."></textarea>
            <button type="submit" class="modal-submit-btn">Generate Resume</button>
        </form>
        <div id="resume-output" class="modal-output">
            <div class="loader-container" style="display: none;">
                <div class="loader"></div>
                <p>Generating your resume...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Skill Analyzer -->
<div id="skill-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div class="modal-header">
            <i class="fas fa-chart-line icon-purple"></i>
            <h2>AI Skill Analyzer</h2>
        </div>
        <p>Enter your skills (comma-separated). Our AI will analyze them and suggest areas for growth.</p>
        <form id="skill-form">
            <input type="text" id="skill-input" placeholder="e.g., Python, React, Project Management, SQL...">
            <button type="submit" class="modal-submit-btn">Analyze Skills</button>
        </form>
        <div id="skill-output" class="modal-output">
             <div class="loader-container" style="display: none;">
                <div class="loader"></div>
                <p>Analyzing your skills...</p>
            </div>
        </div>
    </div>
</div>


<?php
// Include the site footer
include('includes/footer.php');
?>
