<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// This MUST be included after the session and DB logic, but before any HTML output.
include('includes/header.php');

// --- Placeholder Job Data (Expanded) ---
// In a real application, this would be fetched from a database based on user profile.
$jobs = [
    [
        'id' => 1,
        'title' => 'Frontend Developer', 
        'company' => 'Tech Solutions Inc.', 
        'location' => 'San Francisco, CA', 
        'type' => 'Full-time',
        'tags' => ['React', 'CSS', 'JavaScript'],
        'description' => 'We are looking for a skilled Frontend Developer to join our team. You will be responsible for building the client-side of our web applications. You should be able to translate our company and customer needs into functional and appealing interactive applications.'
    ],
    [
        'id' => 2,
        'title' => 'UX/UI Designer', 
        'company' => 'Creative Minds LLC', 
        'location' => 'New York, NY', 
        'type' => 'Remote',
        'tags' => ['Figma', 'User Research', 'Prototyping'],
        'description' => 'Creative Minds LLC is seeking a talented UX/UI Designer to create amazing user experiences. The ideal candidate should have an eye for clean and artful design, possess superior UI skills and be able to translate high-level requirements into interaction flows and artifacts.'
    ],
    [
        'id' => 3,
        'title' => 'Backend Engineer', 
        'company' => 'Data Systems Co.', 
        'location' => 'Austin, TX', 
        'type' => 'Full-time',
        'tags' => ['Node.js', 'PostgreSQL', 'AWS'],
        'description' => 'Data Systems Co. is looking for a Backend Engineer to join our team. The successful candidate will be responsible for managing the interchange of data between the server and the users, as well as developing all server-side logic, definition, and maintenance of the central database.'
    ],
    [
        'id' => 4,
        'title' => 'Product Manager', 
        'company' => 'Innovate Hub', 
        'location' => 'Remote', 
        'type' => 'Contract',
        'tags' => ['Agile', 'Roadmap', 'Stakeholder Management'],
        'description' => 'Innovate Hub is hiring a contract Product Manager to guide the success of a product and lead the cross-functional team that is responsible for improving it. This is an exciting opportunity for a driven and ambitious individual to make a real impact.'
    ],
     [
        'id' => 5,
        'title' => 'DevOps Engineer', 
        'company' => 'CloudNet Solutions', 
        'location' => 'San Francisco, CA', 
        'type' => 'Full-time',
        'tags' => ['Kubernetes', 'Docker', 'CI/CD'],
        'description' => 'We are seeking a DevOps Engineer to help us build functional systems that improve customer experience. DevOps Engineer responsibilities include deploying product updates, identifying production issues and implementing integrations that meet customer needs.'
    ],
];

?>
<!-- Link to the dedicated stylesheet for this page -->
<link rel="stylesheet" href="assets/css/job-recommendations.css">

<main>
    <div class="page-header">
        <h2 class="page-title">Job Recommendations</h2>
        <p class="page-subtitle">AI-powered job matches based on your profile and skills.</p>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="filter-group">
            <label for="filter-type"><i class="fas fa-briefcase"></i> Job Type</label>
            <select id="filter-type" name="filter-type">
                <option value="all">All Types</option>
                <option value="Full-time">Full-time</option>
                <option value="Contract">Contract</option>
                <option value="Remote">Remote</option>
            </select>
        </div>
        <div class="filter-group">
            <label for="filter-location"><i class="fas fa-map-marker-alt"></i> Location</label>
            <select id="filter-location" name="filter-location">
                <option value="all">All Locations</option>
                <option value="San Francisco, CA">San Francisco, CA</option>
                <option value="New York, NY">New York, NY</option>
                <option value="Austin, TX">Austin, TX</option>
                <option value="Remote">Remote</option>
            </select>
        </div>
    </div>


    <!-- Job Listing Container -->
    <div class="job-listing-container" id="job-listing-container">
        <?php foreach ($jobs as $job): ?>
        <div class="job-card" data-job-type="<?php echo htmlspecialchars($job['type']); ?>" data-job-location="<?php echo htmlspecialchars($job['location']); ?>">
            <div class="job-card-header">
                <h3 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h3>
                <p class="job-company"><?php echo htmlspecialchars($job['company']); ?></p>
            </div>
            <div class="job-card-body">
                <div class="job-details">
                     <span class="job-location"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($job['location']); ?></span>
                     <span class="job-type-tag"><?php echo htmlspecialchars($job['type']); ?></span>
                </div>
                <div class="job-tags">
                    <?php foreach($job['tags'] as $tag): ?>
                        <span class="tag"><?php echo htmlspecialchars($tag); ?></span>
                    <?php endforeach; ?>
                </div>
                <!-- Hidden description for the modal -->
                <div class="job-description" style="display: none;"><?php echo htmlspecialchars($job['description']); ?></div>
            </div>
            <div class="job-card-footer">
                <button class="details-btn">View Details</button>
                <button class="save-job-btn"><i class="far fa-bookmark"></i> Save Job</button>
            </div>
        </div>
        <?php endforeach; ?>
         <p id="no-results-message" style="display: none;">No jobs match the selected filters.</p>
    </div>
</main>

<!-- Job Details Modal -->
<div id="job-details-modal" class="job-modal">
    <div class="job-modal-content">
        <button class="close-modal-btn">&times;</button>
        <div id="job-modal-body">
            <!-- Job details will be injected here by JavaScript -->
        </div>
    </div>
</div>


<!-- Link to the dedicated script for this page -->
<script src="assets/js/job-recommendations.js"></script>

<?php include('includes/footer.php'); ?>
