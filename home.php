<?php include 'includes/header.php'; ?>

<main>
  <section id="home" class="hero-section relative pt-24">
        <div class="container mx-auto min-h-screen flex items-center justify-center text-center px-4 relative z-10">
            <div class="reveal">
                <h2 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4">Unlock Your Career Potential with AI</h2>
                <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-8 delay-100">
                    Let our intelligent platform guide you to your dream job. Personalized insights, resume optimization, and interview preparation, all in one place.
                </p>
                <a href="register.php" class="bg-blue-500 text-white font-bold py-4 px-8 rounded-lg text-lg hover:bg-blue-600 transition cta-button delay-200">Get Started for Free</a>
            </div>
        </div>
    </section>

    <section id="features" class="py-20">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl md:text-4xl font-bold mb-2 reveal">Why Choose Us?</h3>
            <p class="text-gray-400 mb-12 reveal delay-100">The features that make us the best choice for your career.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="glass-card p-8 rounded-xl text-center reveal interactive-tilt">
                    <img src="assets/img/course8.jpeg" alt="AI Resume Builder" class="w-full h-40 object-cover rounded-lg mb-4">
                    <div class="text-4xl text-blue-400 mb-4"><i class="fas fa-robot"></i></div>
                    <h4 class="text-xl font-bold mb-2">AI-Powered Resume Builder</h4>
                    <p class="text-gray-300">Create a professional, ATS-friendly resume in minutes with suggestions tailored to your target job.</p>
                </div>
                <div class="glass-card p-8 rounded-xl text-center reveal delay-100 interactive-tilt">
                     <img src="assets/img/Personalized-job-matches.jpg" alt="Personalized Job Matches" class="w-full h-40 object-cover rounded-lg mb-4">
                    <div class="text-4xl text-blue-400 mb-4"><i class="fas fa-lightbulb"></i></div>
                    <h4 class="text-xl font-bold mb-2">Personalized Job Matches</h4>
                    <p class="text-gray-300">Our AI scans thousands of listings to find the perfect opportunities that match your skills and aspirations.</p>
                </div>
                <div class="glass-card p-8 rounded-xl text-center reveal delay-200 interactive-tilt">
                    <img src="assets/img/courseprogramming.jpeg" alt="Interview Preparation" class="w-full h-40 object-cover rounded-lg mb-4">
                    <div class="text-4xl text-blue-400 mb-4"><i class="fas fa-comments"></i></div>
                    <h4 class="text-xl font-bold mb-2">Interview Preparation</h4>
                    <p class="text-gray-300">Practice common interview questions and get AI-driven feedback to boost your confidence.</p>
                </div>
            </div>
        </div>
    </section>

<section id="how-it-works" class="py-20 bg-gray-900 relative overflow-hidden">
        <canvas id="matrix-canvas"></canvas>

        <div class="container mx-auto px-4 text-center relative z-10">
            <h3 class="text-3xl md:text-4xl font-bold mb-2 reveal">Get Started in 3 Simple Steps</h3>
            <p class="text-gray-400 mb-12 max-w-2xl mx-auto reveal delay-100">Our streamlined process makes it easy to begin your journey towards a better career.</p>
            <div class="relative">
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 border-t-2 border-dashed border-gray-600" style="transform: translateY(-50%);"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                    <div class="flex flex-col items-center reveal step-item">
                        <div class="step-circle w-24 h-24 rounded-full bg-blue-500/20 border-2 border-blue-400 flex items-center justify-center text-blue-300 text-3xl font-bold mb-4">1</div>
                        <h4 class="text-xl font-bold mb-2">Create Your Profile</h4>
                        <p class="text-gray-300">Sign up and tell us about your skills, experience, and career goals. The more we know, the better we can help.</p>
                    </div>
                    <div class="flex flex-col items-center reveal delay-100 step-item">
                        <div class="step-circle w-24 h-24 rounded-full bg-blue-500/20 border-2 border-blue-400 flex items-center justify-center text-blue-300 text-3xl font-bold mb-4">2</div>
                        <h4 class="text-xl font-bold mb-2">Get AI Recommendations</h4>
                        <p class="text-gray-300">Our AI analyzes your profile to provide personalized job matches, resume feedback, and interview tips.</p>
                    </div>
                    <div class="flex flex-col items-center reveal delay-200 step-item">
                        <div class="step-circle w-24 h-24 rounded-full bg-blue-500/20 border-2 border-blue-400 flex items-center justify-center text-blue-300 text-3xl font-bold mb-4">3</div>
                        <h4 class="text-xl font-bold mb-2">Apply with Confidence</h4>
                        <p class="text-gray-300">Use our tools to build the perfect application and prepare for interviews, giving you the edge you need to succeed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ai-suggester" class="py-20">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl md:text-4xl font-bold mb-4 reveal">Get Instant Career Suggestions</h3>
            <p class="text-gray-400 max-w-2xl mx-auto mb-8 reveal delay-100">
                Enter your personality type (e.g., INTJ, ENFP) or a key interest (e.g., Artistic, Investigative) to get AI-powered career recommendations.
            </p>
            
            <form id="career-form" class="max-w-xl mx-auto reveal delay-200">
                <div class="flex items-center border-2 border-gray-600 rounded-lg overflow-hidden">
                    <input type="text" id="personality-input" name="personality" class="w-full bg-gray-800 text-white p-4 border-0 focus:ring-0" placeholder="e.g., INTJ, Artistic, Investigative..." required>
                    <button type="submit" class="bg-blue-500 text-white font-bold py-4 px-6 hover:bg-blue-600 transition">
                        <i class="fas fa-magic mr-2"></i> Get Suggestions
                    </button>
                </div>
            </form>

            <div id="ai-results" class="mt-12 text-left max-w-2xl mx-auto">
                </div>
        </div>
    </section>

    <section id="courses" class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl md:text-4xl font-bold text-center mb-12 reveal">Explore Our Courses & Insights</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="course-card reveal interactive-tilt">
                    <img src="assets/img/Web-development-and-mastery-2.jpg" alt="Web Development">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Web Development Mastery</h4>
                        <p class="text-gray-400 mb-4">From HTML to React, become a full-stack developer.</p>
                        <a href="blogs/web-development-mastery.php" class="text-blue-400 hover:underline">Read More &raquo;</a>
                    </div>
                </div>
                <div class="course-card reveal delay-100 interactive-tilt">
                    <img src="assets/img/course3.jpeg" alt="Photography">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Digital Photography</h4>
                        <p class="text-gray-400 mb-4">Capture stunning photos and master your camera.</p>
                        <a href="blogs/digital-photography.php" class="text-blue-400 hover:underline">Read More &raquo;</a>
                    </div>
                </div>
                <div class="course-card reveal delay-200 interactive-tilt">
                    <img src="assets/img/course4.jpeg" alt="Graphic Design">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Graphic Design Fundamentals</h4>
                        <p class="text-gray-400 mb-4">Learn the principles of design and create beautiful visuals.</p>
                        <a href="blogs/graphic-design-fundamentals.php" class="text-blue-400 hover:underline">Read More &raquo;</a>
                    </div>
                </div>
                 <div class="course-card reveal interactive-tilt">
                    <img src="assets/img/Data-analytics-and-science.jpg" alt="Data Science">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Data Science & Analytics</h4>
                        <p class="text-gray-400 mb-4">Unlock the power of data with Python, R, and machine learning.</p>
                        <a href="blogs/data-science-analytics.php" class="text-blue-400 hover:underline">Read More &raquo;</a>
                    </div>
                </div>
                 <div class="course-card reveal delay-100 interactive-tilt">
                    <img src="assets/img/Project-management-pro.jpg" alt="Project Management">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Project Management Pro</h4>
                        <p class="text-gray-400 mb-4">Lead projects to success with Agile and Scrum methodologies.</p>
                        <a href="blogs/project-management-pro.php" class="text-blue-400 hover:underline">Read More &raquo;</a>
                    </div>
                </div>
                 <div class="course-card reveal delay-200 interactive-tilt">
                    <img src="assets/img/software-engineering-pic.jpg" alt="Software Engineering">
                    <div class="course-card-content">
                        <h4 class="text-xl font-bold mb-2">Software Engineering Principles</h4>
                        <p class="text-gray-400 mb-4">Master software design patterns, architecture, and best practices.</p>
                        <a href="blogs/software-engineering-principles.php" class="text-blue-400 hover:underline">Read More &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4 reveal">The Future of Career Development</h2>
                <p class="text-lg text-gray-400 max-w-3xl mx-auto reveal delay-100">We are more than a platform; we are your dedicated partner in building a fulfilling and successful professional life.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 text-center">
                <div class="about-card reveal interactive-tilt">
                    <div class="about-icon"><i class="fas fa-eye"></i></div>
                    <h4 class="text-2xl font-bold mb-3">Our Vision</h4>
                    <p class="text-gray-300">To create a world where everyone has access to the tools and insights needed to find a career they are passionate about, regardless of their background or location.</p>
                </div>
                <div class="about-card reveal delay-100 interactive-tilt">
                    <div class="about-icon"><i class="fas fa-bullseye"></i></div>
                    <h4 class="text-2xl font-bold mb-3">Our Mission</h4>
                    <p class="text-gray-300">To empower individuals by leveraging artificial intelligence for personalized career counseling, skill development, and connecting talent with opportunity seamlessly.</p>
                </div>
                <div class="about-card reveal delay-200 interactive-tilt">
                    <div class="about-icon"><i class="fas fa-tasks"></i></div>
                    <h4 class="text-2xl font-bold mb-3">Our Objective</h4>
                    <p class="text-gray-300">To provide an integrated, data-driven platform that simplifies resume building, offers precise job matching, and delivers actionable feedback for interview excellence.</p>
                </div>
                <div class="about-card reveal delay-300 interactive-tilt">
                    <div class="about-icon"><i class="fas fa-rocket"></i></div>
                    <h4 class="text-2xl font-bold mb-3">Our Future</h4>
                    <p class="text-gray-300">We are continuously evolving, integrating more advanced AI, expanding mentorship networks, and forging partnerships to become the ultimate career ecosystem.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const careerForm = document.getElementById('career-form');
        if (careerForm) {
            const personalityInput = document.getElementById('personality-input');
            const resultsContainer = document.getElementById('ai-results');

            careerForm.addEventListener('submit', function(event) {
                event.preventDefault();

                resultsContainer.innerHTML = `<p class="text-center text-gray-400">🧠 AI is thinking... Please wait.</p>`;

                const formData = new FormData();
                formData.append('prompt', personalityInput.value);

                fetch('api/ai_suggestions.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.choices && data.choices.length > 0) {
                        const aiResponse = data.choices[0].message.content;
                        let resultsHtml = `
                            <h4 class="text-2xl font-bold mb-4 text-blue-400">AI Career Guidance</h4>
                            <div class="glass-card p-6 rounded-lg">
                                <p class="text-gray-300">${aiResponse.replace(/\n/g, '<br>')}</p>
                            </div>
                        `;
                        resultsContainer.innerHTML = resultsHtml;
                    } else {
                        resultsContainer.innerHTML = `<p class="text-center text-red-400">No response from AI. Please try again.</p>`;
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    resultsContainer.innerHTML = `<p class="text-center text-red-400">An error occurred. Please check the console.</p>`;
                });
            });
        }
    });
</script>

<?php include 'includes/footer.php'; ?>