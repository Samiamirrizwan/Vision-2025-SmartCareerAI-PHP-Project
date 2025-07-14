<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-about">
            <h4 class="footer-logo">Smart Career AI</h4>
            <p>
                Empowering professionals to navigate their career paths with confidence. We leverage AI to provide personalized guidance, job recommendations, and skill analysis.
            </p>
        </div>
        
        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="test.php">Aptitude Test</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="footer-social">
            <h4>Connect With Us</h4>
            <p>Follow us on social media for the latest career tips and platform updates.</p>
            <div class="social-icons">
                <a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
                <a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
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