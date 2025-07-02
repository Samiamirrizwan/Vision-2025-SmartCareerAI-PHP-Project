<?php include 'includes/header.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Career AI - Unlock Your Potential</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="text-white">
  <!-- Hero Section -->
  <main class="hero-section relative">
        <div class="container mx-auto min-h-screen flex items-center justify-center text-center px-4">
            <div>
                <h2 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4">Unlock Your Career Potential with AI</h2>
                <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-8">
                    Let our intelligent platform guide you to your dream job. Personalized insights, resume optimization, and interview preparation, all in one place.
                </p>
                <a href="register.php" class="bg-blue-500 text-white font-bold py-4 px-8 rounded-lg text-lg hover:bg-blue-600 transition cta-button">Get Started for Free</a>
            </div>
        </div>
    </main>

    <section id="features" class="py-20">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl md:text-4xl font-bold mb-2">Why Choose Us?</h3>
            <p class="text-gray-400 mb-12">The features that make us the best choice for your career.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="glass-card p-8 rounded-xl text-center">
                    <img src="assets/img/course8.jpeg" alt="AI Resume Builder" class="w-full h-40 object-cover rounded-lg mb-4">
                    <div class="text-4xl text-blue-400 mb-4"><i class="fas fa-robot"></i></div>
                    <h4 class="text-xl font-bold mb-2">AI-Powered Resume Builder</h4>
                    <p class="text-gray-300">Create a professional, ATS-friendly resume in minutes with suggestions tailored to your target job.</p>
                </div>
                <div class="glass-card p-8 rounded-xl text-center">
                     <img src="assets/img/course10.jpeg" alt="Personalized Job Matches" class="w-full h-40 object-cover rounded-lg mb-4">
                    <div class="text-4xl text-blue-400 mb-4"><i class="fas fa-lightbulb"></i></div>
                    <h4 class="text-xl font-bold mb-2">Personalized Job Matches</h4>
                    <p class="text-gray-300">Our AI scans thousands of listings to find the perfect opportunities that match your skills and aspirations.</p>
                </div>
                <div class="glass-card p-8 rounded-xl text-center">
                    <img src="assets/img/courseprogramming.jpeg" alt="Interview Preparation" class="w-full h-40 object-cover rounded-lg mb-4">
                    <div class="text-4xl text-blue-400 mb-4"><i class="fas fa-comments"></i></div>
                    <h4 class="text-xl font-bold mb-2">Interview Preparation</h4>
                    <p class="text-gray-300">Practice common interview questions and get AI-driven feedback to boost your confidence.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="courses" class="py-20">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl md:text-4xl font-bold text-center mb-12">Explore Our Courses</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="course-card">
                    <img src="assets/img/course10.jpeg" alt="Web Development">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Web Development Mastery</h4>
                        <p class="text-gray-400 mb-4">From HTML to React, become a full-stack developer.</p>
                        <a href="#" class="text-blue-400 hover:underline">Learn More</a>
                    </div>
                </div>
                <div class="course-card">
                    <img src="assets/img/course3.jpeg" alt="Photography">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Digital Photography</h4>
                        <p class="text-gray-400 mb-4">Capture stunning photos and master your camera.</p>
                        <a href="#" class="text-blue-400 hover:underline">Learn More</a>
                    </div>
                </div>
                <div class="course-card">
                    <img src="assets/img/course4.jpeg" alt="Graphic Design">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Graphic Design Fundamentals</h4>
                        <p class="text-gray-400 mb-4">Learn the principles of design and create beautiful visuals.</p>
                        <a href="#" class="text-blue-400 hover:underline">Learn More</a>
                    </div>
                </div>
                 <div class="course-card">
                    <img src="assets/img/course9.jpeg" alt="Data Science">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Data Science & Analytics</h4>
                        <p class="text-gray-400 mb-4">"The risk I took was calculated, but man, am I bad at math." Unlock the power of data with Python and R.</p>
                        <a href="#" class="text-blue-400 hover:underline">Learn More</a>
                    </div>
                </div>
                 <div class="course-card">
                    <img src="assets/img/course8.jpeg" alt="Project Management">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Project Management Pro</h4>
                        <p class="text-gray-400 mb-4">Lead projects to success with Agile and Scrum methodologies.</p>
                        <a href="#" class="text-blue-400 hover:underline">Learn More</a>
                    </div>
                </div>
                 <div class="course-card">
                    <img src="assets/img/courseprogramming.jpeg" alt="Software Engineering">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Software Engineering Principles</h4>
                        <p class="text-gray-400 mb-4">Master software design patterns, architecture, and best practices.</p>
                        <a href="#" class="text-blue-400 hover:underline">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-20 section-banner">
        <div class="container mx-auto px-4 text-center bg-gray-900/70 py-12 rounded-xl">
            <h3 class="text-3xl md:text-4xl font-bold mb-4">Ready to Take the Next Step?</h3>
            <p class="text-gray-300 max-w-2xl mx-auto mb-8">Join thousands of professionals who have supercharged their careers with Smart Career AI. Your future starts now.</p>
            <a href="register.php" class="bg-blue-500 text-white font-bold py-4 px-8 rounded-lg text-lg hover:bg-blue-600 transition cta-button">Create Your Account</a>
        </div>
    </section>
<?php include 'includes/footer.php'; ?>
