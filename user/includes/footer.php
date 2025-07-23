<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-about">
            <h4 class="footer-logo">Smart Career AI</h4>
            <p>
                Empowering professionals to navigate their career paths with confidence. We leverage AI to provide personalized guidance, job recommendations, and skill analysis.
            </p>
            <div class="social-icons">
                <a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
                <a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
        
        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="test.php">Aptitude Test</a></li>
                <li><a href="results.php">Results</a></li>
                <li><a href="career-roadmap.php">Career Roadmap</a></li>
                <li><a href="mentor-connect.php">Mentors</a></li>
            </ul>
        </div>
        <div class="footer-links">
            <h4>Resources</h4>
            <ul>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Career Tips</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <h4>Contact Us</h4>
            <ul>
                <li><i class="fas fa-envelope"></i> support@smartcareerai.com</li>
                <li><i class="fas fa-map-marker-alt"></i> San Francisco, CA</li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> SmartCareerAI. All Rights Reserved.</p>
    </div>
</footer>
<script>
    // JavaScript for mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mainNav = document.getElementById('main-nav');
    if (mobileMenuBtn && mainNav) {
        mobileMenuBtn.addEventListener('click', () => {
            mainNav.classList.toggle('active');
        });
    }
</script>
</body>
</html>