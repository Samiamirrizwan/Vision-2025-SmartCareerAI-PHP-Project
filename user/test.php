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
    <div class="bg-white p-8 rounded-lg shadow-md test-container">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Career Aptitude Test</h2>
        <form action="results.php" method="post" id="career-test-form">
            <div class="test-step">
                <div class="test-question">
                    <label>1. Do you enjoy solving technical problems?</label>
                    <div class="test-options">
                        <div class="test-option">
                            <input type="radio" name="q1" value="yes" id="q1_yes" class="mr-2">
                            <label for="q1_yes">Yes</label>
                        </div>
                        <div class="test-option">
                            <input type="radio" name="q1" value="no" id="q1_no" class="mr-2">
                            <label for="q1_no">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="test-step">
                <div class="test-question">
                    <label>2. Are you interested in creative activities such as writing, designing, or arts?</label>
                    <div class="test-options">
                        <div class="test-option">
                            <input type="radio" name="q2" value="yes" id="q2_yes" class="mr-2">
                            <label for="q2_yes">Yes</label>
                        </div>
                        <div class="test-option">
                            <input type="radio" name="q2" value="no" id="q2_no" class="mr-2">
                            <label for="q2_no">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="test-step">
                <div class="test-question">
                    <label>3. Do you like working with numbers and data analysis?</label>
                    <div class="test-options">
                        <div class="test-option">
                            <input type="radio" name="q3" value="yes" id="q3_yes" class="mr-2">
                            <label for="q3_yes">Yes</label>
                        </div>
                        <div class="test-option">
                            <input type="radio" name="q3" value="no" id="q3_no" class="mr-2">
                            <label for="q3_no">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="test-step">
                <div class="test-question">
                    <label>4. Are you comfortable leading a team and making decisions?</label>
                    <div class="test-options">
                        <div class="test-option">
                            <input type="radio" name="q4" value="yes" id="q4_yes" class="mr-2">
                            <label for="q4_yes">Yes</label>
                        </div>
                        <div class="test-option">
                            <input type="radio" name="q4" value="no" id="q4_no" class="mr-2">
                            <label for="q4_no">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="test-step">
                <div class="test-question">
                    <label>5. Do you enjoy helping and interacting with people?</label>
                    <div class="test-options">
                        <div class="test-option">
                            <input type="radio" name="q5" value="yes" id="q5_yes" class="mr-2">
                            <label for="q5_yes">Yes</label>
                        </div>
                        <div class="test-option">
                            <input type="radio" name="q5" value="no" id="q5_no" class="mr-2">
                            <label for="q5_no">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="test-navigation">
                <button type="button" class="test-prev bg-gray-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-gray-600 cursor-pointer">Previous</button>
                <button type="button" class="test-next bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 cursor-pointer">Next</button>
                <input type="submit" value="Submit" class="test-submit bg-green-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-700 cursor-pointer">
            </div>
            <div class="test-progress">
                <div class="test-progress-bar"></div>
            </div>
        </form>
    </div>
</main>
<?php 