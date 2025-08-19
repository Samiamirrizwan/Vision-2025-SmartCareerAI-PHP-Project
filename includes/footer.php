<?php
    $isBlogPageFooter = strpos($_SERVER['REQUEST_URI'], '/blogs/') !== false;
    $footerBasePath = $isBlogPageFooter ? '../' : './';
?>
    <div id="mouse-glow"></div>

    <footer class="bg-gray-900 text-gray-400 py-12 relative z-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">SmartCareerAI</h3>
                    <p class="pr-4">Your personal AI-powered guide to navigating the complexities of career choices.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Explore</h4>
                    <ul>
                        <li class="mb-2"><a href="<?php echo $footerBasePath; ?>home.php#home" class="hover:text-white transition">Home</a></li>
                        <li class="mb-2"><a href="<?php echo $footerBasePath; ?>home.php#features" class="hover:text-white transition">Features</a></li>
                        <li class="mb-2"><a href="<?php echo $footerBasePath; ?>blogs/web-development-mastery.php" class="hover:text-white transition">Blogs</a></li>
                        <li class="mb-2"><a href="<?php echo $footerBasePath; ?>faqs.php" class="hover:text-white transition">FAQs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Access</h4>
                    <ul>
                        <li class="mb-2"><a href="<?php echo $footerBasePath; ?>login.php" class="hover:text-white transition">User Login</a></li>
                        <li class="mb-2"><a href="<?php echo $footerBasePath; ?>register.php" class="hover:text-white transition">User Sign Up</a></li>
                        <li class="mb-2"><a href="<?php echo $footerBasePath; ?>admin-login.php" class="hover:text-white transition">Admin Panel</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Connect</h4>
                     <ul class="mb-4">
                       <li class="mb-2"><a href="<?php echo $footerBasePath; ?>home.php#about" class="hover:text-white transition">About Us</a></li>
                       <li class="mb-2"><a href="<?php echo $footerBasePath; ?>contact.php" class="hover:text-white transition">Contact Us</a></li>
                    </ul>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/working4happiness/" class="text-2xl hover:text-blue-500 transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-2xl hover:text-blue-400 transition"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" class="text-2xl hover:text-purple-500 transition"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center border-t border-gray-800 pt-8 mt-8">
                <p>&copy; <?php echo date('Y'); ?> SmartCareerAI. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.2/dist/vanilla-tilt.min.js"></script>
    <script src="<?php echo $footerBasePath; ?>assets/js/script.js"></script>
</body>
</html>