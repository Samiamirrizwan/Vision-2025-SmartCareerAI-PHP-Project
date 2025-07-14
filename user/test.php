<?php
session_start();
// **FIXED**: Check for 'user_id' instead of 'email'
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}
// **FIXED**: Correct path to header
include('includes/header.php'); 
?>
<main class="p-8 max-w-7xl mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Career Aptitude Test</h2>
        <form action="results.php" method="post">
            <div class="mb-6">
                <label class="block text-lg text-gray-700 mb-2">Do you enjoy solving technical problems?</label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center"><input type="radio" name="q1" value="yes" class="mr-2 h-4 w-4"> Yes</label>
                    <label class="flex items-center"><input type="radio" name="q1" value="no" class="mr-2 h-4 w-4"> No</label>
                </div>
            </div>
            <input type="submit" value="Submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 cursor-pointer">
        </form>
    </div>
</main>
<?php 
// **FIXED**: Correct path to footer
include('includes/footer.php'); 
?>