<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// --- PAGE-SPECIFIC CONFIGURATION ---
$page_specific_css = 'assets/css/roadmap-style.css';
$body_class = 'roadmap-page';

// --- DYNAMIC ROADMAP DATA ---
$career_path = isset($_SESSION['career_path']) ? $_SESSION['career_path'] : 'Software Engineering'; // Default

$roadmaps = [
    'Software Engineering' => [
        'title' => 'Software Engineer',
        'description' => 'A detailed guide to becoming a proficient software engineer, from foundational knowledge to professional development.',
        'steps' => [
            // ... existing steps for Software Engineering ...
            [
                'title' => 'Foundation (0-6 Months)', 'icon' => 'fas fa-layer-group',
                'description' => 'Build a strong base in programming and computer science fundamentals.',
                'skills' => ['Programming Basics (Python/JavaScript)', 'Data Structures & Algorithms', 'Version Control (Git)'],
                'resources' => ['freeCodeCamp', 'Coursera: Python for Everybody', 'The Odin Project'],
                'milestone' => 'Build 3-5 small projects, like a calculator or a to-do list app.'
            ],
            [
                'title' => 'Specialization (1-2 Years)', 'icon' => 'fas fa-star',
                'description' => 'Choose a field to focus on and develop specialized, in-demand skills.',
                'skills' => ['Frontend (React/Vue)', 'Backend (Node.js/Django)', 'Cloud Basics (AWS/Azure)'],
                'resources' => ['Official React Docs', 'Django Girls Tutorial', 'AWS Cloud Practitioner Essentials'],
                'milestone' => 'Develop a complex project in your chosen specialty.'
            ]
        ]
    ],
    'Creative Design' => [
        'title' => 'Creative Designer',
        'description' => 'Your path to becoming a successful creative designer, covering everything from theory to professional practice.',
        'steps' => [
            // ... existing steps for Creative Design ...
             [
                'title' => 'Design Fundamentals (0-6 Months)', 'icon' => 'fas fa-palette',
                'description' => 'Master the core principles of visual design and communication.',
                'skills' => ['Color Theory', 'Typography', 'Composition & Layout', 'Intro to Adobe Suite (Photoshop, Illustrator)'],
                'resources' => ['Canva Design School', 'Adobe Creative Cloud Tutorials', 'Interaction Design Foundation'],
                'milestone' => 'Create a personal branding package (logo, color scheme, business card design).'
            ],
            [
                'title' => 'Building a Portfolio (1-2 Years)', 'icon' => 'fas fa-image',
                'description' => 'Develop a strong portfolio that showcases your skills and unique style.',
                'skills' => ['Case Study Development', 'Project Presentation', 'Personal Branding'],
                'resources' => ['Behance', 'Dribbble', 'Bestfolios by Semplice'],
                'milestone' => 'Complete 3-5 detailed case studies for your portfolio.'
            ]
        ]
    ],
    'Data Analysis' => [
        'title' => 'Data Analyst',
        'description' => 'A comprehensive roadmap to becoming a data analyst, focusing on skills to turn raw data into meaningful insights.',
        'steps' => [
            [
                'title' => 'Statistical & Math Foundation (0-6 Months)', 'icon' => 'fas fa-calculator',
                'description' => 'Understand the core mathematical concepts that underpin data analysis.',
                'skills' => ['Descriptive Statistics', 'Probability', 'Linear Algebra Basics'],
                'resources' => ['Khan Academy Statistics', '3Blue1Brown (YouTube)'],
                'milestone' => 'Complete a course on statistics for data science.'
            ],
            [
                'title' => 'Technical Skills (6-12 Months)', 'icon' => 'fas fa-code',
                'description' => 'Master the essential tools for data manipulation and analysis.',
                'skills' => ['SQL for Data Querying', 'Python with Pandas & NumPy', 'Spreadsheet Software (Excel/Google Sheets)'],
                'resources' => ['SQLZoo', 'Kaggle Courses', 'DataCamp'],
                'milestone' => 'Clean and analyze a real-world dataset and present your findings.'
            ],
            [
                'title' => 'Visualization & Reporting (1-2 Years)', 'icon' => 'fas fa-chart-bar',
                'description' => 'Learn to communicate your findings effectively through visual storytelling.',
                'skills' => ['Tableau or Power BI', 'Python Libraries (Matplotlib/Seaborn)', 'Dashboard Creation'],
                'resources' => ['Tableau Public Gallery', 'The Data Visualisation Catalogue'],
                'milestone' => 'Create an interactive dashboard to explore a dataset.'
            ]
        ]
    ],
    'Project Management' => [
        'title' => 'Project Manager',
        'description' => 'Your journey to becoming an effective project manager, capable of leading projects to success.',
        'steps' => [
            [
                'title' => 'Methodology Basics (0-6 Months)', 'icon' => 'fas fa-sitemap',
                'description' => 'Learn the fundamental frameworks for managing projects.',
                'skills' => ['Agile & Scrum Principles', 'Waterfall Methodology', 'Project Lifecycle'],
                'resources' => ['Scrum Guide', 'PMI Basics', 'Atlassian Agile Coach'],
                'milestone' => 'Get a foundational certification like the Certified Associate in Project Management (CAPM).'
            ],
            [
                'title' => 'Tools & Software (6-12 Months)', 'icon' => 'fas fa-tools',
                'description' => 'Become proficient in the software used to track and manage projects.',
                'skills' => ['Jira or Trello', 'Asana', 'Microsoft Project', 'Communication Tools (Slack/Teams)'],
                'resources' => ['Official tutorials for Jira/Asana', 'Udemy courses on project management software'],
                'milestone' => 'Manage a personal project from start to finish using a tool like Trello or Asana.'
            ],
            [
                'title' => 'Soft Skills & Leadership (1-2 Years)', 'icon' => 'fas fa-users',
                'description' => 'Develop the crucial interpersonal skills needed to lead a team.',
                'skills' => ['Communication', 'Risk Management', 'Stakeholder Management', 'Negotiation'],
                'resources' => ['Books: "The Mythical Man-Month"', 'Toastmasters International'],
                'milestone' => 'Lead a small team or volunteer project to a successful outcome.'
            ]
        ]
    ]
];

$current_roadmap = $roadmaps[$career_path] ?? null;

include('includes/header.php');
?>
<div id="roadmap-3d-container"></div>

<main>
    <div class="roadmap-content">
        <?php if ($current_roadmap): ?>
            <div class="page-header">
                <h2 class="page-title">Your Career Roadmap: <?php echo htmlspecialchars($current_roadmap['title']); ?></h2>
                <p class="page-subtitle"><?php echo htmlspecialchars($current_roadmap['description']); ?></p>
            </div>

            <div class="roadmap-timeline">
                <?php foreach ($current_roadmap['steps'] as $index => $step): ?>
                    <div class="roadmap-item" style="animation-delay: <?php echo $index * 200; ?>ms;">
                        <div class="roadmap-icon"><i class="<?php echo htmlspecialchars($step['icon']); ?>"></i></div>
                        <div class="roadmap-item-content">
                            <h3 class="roadmap-step-title"><?php echo htmlspecialchars($step['title']); ?></h3>
                            <p class="roadmap-step-desc"><?php echo htmlspecialchars($step['description']); ?></p>
                            
                            <div class="roadmap-details">
                                <div>
                                    <h4><i class="fas fa-check-circle"></i> Key Skills</h4>
                                    <ul>
                                        <?php foreach ($step['skills'] as $skill): ?>
                                            <li><?php echo htmlspecialchars($skill); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div>
                                    <h4><i class="fas fa-book-open"></i> Resources</h4>
                                    <ul>
                                        <?php foreach ($step['resources'] as $resource): ?>
                                            <li><?php echo htmlspecialchars($resource); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                             <div class="roadmap-milestone">
                                <h4><i class="fas fa-flag-checkered"></i> Key Milestone</h4>
                                <p><?php echo htmlspecialchars($step['milestone']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
             <div class="roadmap-actions">
                <a href="mentor-connect.php" class="mentor-connect-btn">Connect with a <?php echo htmlspecialchars($current_roadmap['title']); ?> Mentor</a>
            </div>

        <?php else: ?>
            <div class="no-roadmap-card">
                 <div class="page-header">
                    <h2 class="page-title">No Roadmap Found</h2>
                </div>
                <p class="page-subtitle">We couldn't generate a roadmap for you. Please complete the career aptitude test first to get your personalized plan.</p>
                <a href="test.php" class="modal-submit-btn">Take the Test Now</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="assets/js/roadmap-3d.js"></script>

<?php include('includes/footer.php'); ?>
