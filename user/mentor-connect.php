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
        <p class="text-lg text-gray-700">Connect with experienced mentors in your field.</p>
    </div>
</main>
<?php include('includes/footer.php'); ?>