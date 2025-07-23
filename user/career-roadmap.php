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
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Career Roadmap</h2>
        <p class="text-lg text-gray-700 mb-6">Based on your results, here’s your step-by-step career roadmap for becoming a Software Engineer.</p>
        
        <ol class="roadmap-steps">
            <li class="roadmap-step">
                <h4 class="roadmap-step-title">Foundation (0-6 months)</h4>
                <p class="roadmap-step-desc">Learn the fundamentals of programming with languages like Python or JavaScript. Complete online courses and build small projects.</p>
            </li>
            <li class="roadmap-step">
                <h4 class="roadmap-step-title">Core Skills (6-12 months)</h4>
                <p class="roadmap-step-desc">Dive deeper into data structures, algorithms, and object-oriented design. Learn about databases and basic system design.</p>
            </li>
            <li class="roadmap-step">
                <h4 class="roadmap-step-title">Specialization (1-2 years)</h4>
                <p class="roadmap-step-desc">Choose a specialization (e.g., Web Development, Mobile Development, Data Science) and build advanced projects in that area.</p>
            </li>
            <li class="roadmap-step">
                <h4 class="roadmap-step-title">Professional Development (2+ years)</h4>
                <p class="roadmap-step-desc">Contribute to open-source projects, prepare for technical interviews, and apply for internships or junior developer positions.</p>
            </li>
            <li class="roadmap-step">
                <h4 class="roadmap-step-title">Career Growth (Ongoing)</h4>
                <p class="roadmap-step-desc">Continue learning new technologies and frameworks. Consider leadership roles or advanced specializations.</p>
            </li>
        </ol>
        <div class="mt-8">
            <a href="mentor-connect.php" class="mentor-connect-btn">Connect with a Software Engineering Mentor</a>
        </div>
    </div>
</main>
<?php include('includes/footer.php'); ?>