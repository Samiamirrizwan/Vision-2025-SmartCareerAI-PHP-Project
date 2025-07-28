<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
include('includes/header.php');

// --- Mentor Data Array ---
// For a larger application, consider moving this array to a separate file (e.g., `data/mentors.php`)
// or fetching the data from a database to keep the presentation logic clean.
$mentors = [
    [
        'id' => 'evelyn_reed',
        'name' => 'Dr. Evelyn Reed',
        'field' => 'Lead Data Scientist at QuantumLeap',
        'bio' => 'PhD in Computer Science with 15+ years of experience in machine learning and big data analytics. Passionate about mentoring the next generation of data innovators.',
        'image' => 'https://i.pravatar.cc/300?u=evelyn_reed',
        'expertise' => ['Machine Learning', 'Python', 'Big Data', 'AI Ethics'],
        'social' => [
            'linkedin' => '#',
            'twitter' => '#'
        ]
    ],
    [
        'id' => 'markus_chen',
        'name' => 'Markus Chen',
        'field' => 'Principal Software Engineer at Nebula Systems',
        'bio' => 'Lead Backend Engineer specializing in scalable systems and cloud architecture. Loves tackling complex problems and building robust, high-performance applications.',
        'image' => 'https://i.pravatar.cc/300?u=markus_chen',
        'expertise' => ['Cloud Architecture', 'Go', 'Microservices', 'DevOps'],
        'social' => [
            'linkedin' => '#',
            'github' => '#'
        ]
    ],
    [
        'id' => 'aisha_khan',
        'name' => 'Aisha Khan',
        'field' => 'Senior UX Designer at CreativeFlow',
        'bio' => 'A creative problem-solver dedicated to crafting intuitive and beautiful user experiences. Specializes in user-centered design and interactive prototyping.',
        'image' => 'https://i.pravatar.cc/300?u=aisha_khan',
        'expertise' => ['UI/UX Design', 'Figma', 'User Research', 'Prototyping'],
        'social' => [
            'linkedin' => '#',
            'dribbble' => '#'
        ]
    ],
    [
        'id' => 'david_rodriguez',
        'name' => 'David Rodriguez',
        'field' => 'Cybersecurity Analyst at SecureNet',
        'bio' => 'Certified ethical hacker with a deep understanding of network security and threat analysis. Committed to making the digital world a safer place.',
        'image' => 'https://i.pravatar.cc/300?u=david_rodriguez',
        'expertise' => ['Network Security', 'Penetration Testing', 'Threat Analysis', 'Cryptography'],
        'social' => [
            'linkedin' => '#',
            'twitter' => '#'
        ]
    ]
];
?>

<link rel="stylesheet" href="assets/css/mentor-connect.css">

<main>
    <div class="page-header">
        <h2 class="page-title">Mentor Connect</h2>
        <p class="page-subtitle">Connect with experienced industry professionals. Browse profiles and send connection requests.</p>
    </div>

    <div class="mentor-grid">
        <?php foreach ($mentors as $mentor): ?>
            <div class="mentor-card animated-card">
                <div class="mentor-card-header">
                    <img src="<?php echo htmlspecialchars($mentor['image']); ?>" alt="Portrait of <?php echo htmlspecialchars($mentor['name']); ?>" class="mentor-image" onerror="this.onerror=null;this.src='https://placehold.co/400x400/1C2128/f0f6fc?text=Mentor';">
                </div>
                <div class="mentor-info">
                    <h3 class="mentor-name"><?php echo htmlspecialchars($mentor['name']); ?></h3>
                    <p class="mentor-field"><?php echo htmlspecialchars($mentor['field']); ?></p>
                    <div class="mentor-expertise">
                        <?php foreach ($mentor['expertise'] as $skill): ?>
                            <span class="expertise-tag"><?php echo htmlspecialchars($skill); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <p class="mentor-bio"><?php echo htmlspecialchars($mentor['bio']); ?></p>
                    <div class="mentor-footer">
                        <a href="start-connection.php?mentor_id=<?php echo htmlspecialchars($mentor['id']); ?>" class="mentor-connect-btn">
                            <i class="fas fa-user-plus"></i> Connect
                        </a>
                        <div class="mentor-socials">
                            <?php if (isset($mentor['social']['linkedin'])): ?>
                                <a href="<?php echo htmlspecialchars($mentor['social']['linkedin']); ?>" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>
                             <?php if (isset($mentor['social']['twitter'])): ?>
                                <a href="<?php echo htmlspecialchars($mentor['social']['twitter']); ?>" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                             <?php if (isset($mentor['social']['github'])): ?>
                                <a href="<?php echo htmlspecialchars($mentor['social']['github']); ?>" aria-label="GitHub"><i class="fab fa-github"></i></a>
                            <?php endif; ?>
                             <?php if (isset($mentor['social']['dribbble'])): ?>
                                <a href="<?php echo htmlspecialchars($mentor['social']['dribbble']); ?>" aria-label="Dribbble"><i class="fab fa-dribbble"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include('includes/footer.php'); ?>