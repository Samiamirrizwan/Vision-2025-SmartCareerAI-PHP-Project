<?php
session_start();
// **FIXED**: Check for 'user_id' instead of 'email'
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}
include('includes/header.php');
?>
<main class="p-8 max-w-7xl mx-auto">
     <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Mentor Connect</h2>
        <p class="text-lg text-gray-700 mb-6">Connect with experienced mentors in your field. Browse profiles and send connection requests.</p>
        
        <div class="mentor-grid">
            <div class="mentor-card">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Doe" class="mentor-image">
                <div class="mentor-info">
                    <h3 class="mentor-name">John Doe</h3>
                    <p class="mentor-field">Senior Software Engineer at TechCorp</p>
                    <p class="mentor-bio">10+ years of experience in full-stack development. Specialized in JavaScript frameworks and cloud architecture.</p>
                    <a href="#" class="mentor-connect-btn">Connect</a>
                </div>
            </div>
            <div class="mentor-card">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Jane Smith" class="mentor-image">
                <div class="mentor-info">
                    <h3 class="mentor-name">Jane Smith</h3>
                    <p class="mentor-field">Lead Data Scientist at DataWorks</p>
                    <p class="mentor-bio">Expert in machine learning and big data analytics. Passionate about mentoring aspiring data scientists.</p>
                    <a href="#" class="mentor-connect-btn">Connect</a>
                </div>
            </div>
            <div class="mentor-card">
                <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Robert Johnson" class="mentor-image">
                <div class="mentor-info">
                    <h3 class="mentor-name">Robert Johnson</h3>
                    <p class="mentor-field">Product Manager at InnovateInc</p>
                    <p class="mentor-bio">Helps professionals transition into product management. Focus on agile methodologies and user-centered design.</p>
                    <a href="#" class="mentor-connect-btn">Connect</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('includes/footer.php'); ?>