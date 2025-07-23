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
    <div class="results-card">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Your Test Results</h2>
        <p class="text-lg text-gray-700">Based on your aptitude test, here's your personalized career analysis:</p>
        
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-800">Recommended Career Path:</h3>
            <p class="career-path">Software Engineering</p>
        </div>
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-800">Analysis:</h3>
            <p class="text-gray-700 mt-2">
                Your responses indicate a strong inclination towards problem-solving and technical challenges. 
                Software Engineering is a field that aligns with your interests and has a high demand in the job market. 
                This career path involves designing, developing, and maintaining software systems.
            </p>
        </div>
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-800">Next Steps:</h3>
            <ul class="list-disc pl-6 text-gray-700 mt-2">
                <li>Review your personalized career roadmap for a step-by-step plan.</li>
                <li>Connect with experienced mentors in the field of Software Engineering.</li>
                <li>Explore recommended courses and resources to build your skills.</li>
            </ul>
        </div>
        <div class="mt-8 flex gap-4">
            <a href="career-roadmap.php" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 cursor-pointer inline-block">View Career Roadmap</a>
            <a href="mentor-connect.php" class="bg-green-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-700 cursor-pointer inline-block">Connect with Mentors</a>
        </div>
    </div>
</main>
<?php include('includes/footer.php'); ?>