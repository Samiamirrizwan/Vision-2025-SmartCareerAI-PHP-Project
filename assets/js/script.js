/**
 * ===================================================================
 * SCRIPT.JS - Refactored & Enhanced
 * ===================================================================
 * - Modular structure using an App object.
 * - Improved performance with throttling on scroll events.
 * - Robust password toggle using data attributes.
 * - NEW FEATURE: "Scroll to Top" button.
 * - Clear separation of concerns for easier maintenance.
 * ===================================================================
 */

// Wait for the DOM to be fully loaded before running scripts
document.addEventListener('DOMContentLoaded', () => {

    /**
     * An object to encapsulate all application logic.
     * This avoids polluting the global namespace.
     */
    const App = {
        // --- 1. STATE & ELEMENT CACHE ---
        // Caching DOM elements and state variables for performance and clarity.
        elements: {
            header: document.getElementById('main-header'),
            mobileMenuButton: document.getElementById('mobile-menu-button'),
            mobileMenu: document.getElementById('mobile-menu'),
            particleContainer: document.getElementById('particle-container'),
            passwordToggles: document.querySelectorAll('.toggle-password'),
            navLinks: document.querySelectorAll('.nav-link'),
            sections: document.querySelectorAll('section[id]'),
            scrollToTopBtn: null // Will be created dynamically
        },
        state: {
            currentPage: document.body.dataset.page || 'unknown',
            isMenuOpen: false,
            headerHeight: 0
        },
        config: {
            scrollThreshold: 50, // Pixels to scroll before header changes
            particleCount: 80,
            particleInteractiveRadius: 150
        },

        /**
         * --- 2. UTILITY FUNCTIONS ---
         * Reusable helper functions.
         */
        utils: {
            // Throttles a function to run at most once per limit
            throttle(func, limit) {
                let inThrottle;
                return function() {
                    const args = arguments;
                    const context = this;
                    if (!inThrottle) {
                        func.apply(context, args);
                        inThrottle = true;
                        setTimeout(() => inThrottle = false, limit);
                    }
                };
            }
        },

        /**
         * --- 3. CORE MODULES ---
         * Each method handles a specific feature.
         */

        /**
         * Initializes the main application logic.
         */
        init() {
            console.log(`SmartCareerAI JS Initializing for page: ${this.state.currentPage} 🚀`);
            
            this.state.headerHeight = this.elements.header ? this.elements.header.offsetHeight : 0;
            
            // Initialize all features
            this.initMobileMenu();
            this.initPasswordToggle();
            this.initScrollToTop();

            // Page-specific initializations
            if (this.state.currentPage === 'index.php') {
                this.initHeaderScrollBehavior();
                this.initNavScrollObserver();
                this.initSmoothScroll();
                if (this.elements.particleContainer) this.initParticleEffect();
            } else if (this.state.currentPage === 'login.php' || this.state.currentPage === 'register.php') {
                // Logic specific to login/register pages can go here
            }

            // Update header height on resize
            window.addEventListener('resize', this.utils.throttle(() => {
                this.state.headerHeight = this.elements.header ? this.elements.header.offsetHeight : 0;
            }, 200));
        },

        /**
         * Handles mobile menu toggling and closing behavior.
         */
        initMobileMenu() {
            const { mobileMenuButton, mobileMenu } = this.elements;
            if (!mobileMenuButton || !mobileMenu) return;

            mobileMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                this.state.isMenuOpen = !this.state.isMenuOpen;
                mobileMenu.classList.toggle('hidden', !this.state.isMenuOpen);
            });

            document.addEventListener('click', (e) => {
                if (this.state.isMenuOpen && !mobileMenu.contains(e.target)) {
                    this.state.isMenuOpen = false;
                    mobileMenu.classList.add('hidden');
                }
            });
        },

        /**
         * FIX & ENHANCEMENT: Makes password visibility toggles robust.
         * It now uses a `data-target` attribute on the icon to link it to the input field.
         * This is more reliable than relying on the parent element structure.
         * HTML should be: `<input id="pass" type="password"> <i class="toggle-password fa-solid fa-eye" data-target="#pass"></i>`
         */
        initPasswordToggle() {
            this.elements.passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const targetSelector = this.dataset.target;
                    const passwordInput = document.querySelector(targetSelector);
                    
                    if (!passwordInput) return;

                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                    // Toggle icon class
                    this.classList.toggle('fa-eye', !isPassword);
                    this.classList.toggle('fa-eye-slash', isPassword);
                });
            });
        },
        
        /**
         * Changes header background on scroll for applicable pages.
         */
        initHeaderScrollBehavior() {
            const { header } = this.elements;
            if (!header) return;

            const handleScroll = () => {
                const isScrolled = window.scrollY > this.config.scrollThreshold;
                header.classList.toggle('bg-gray-900', isScrolled);
                header.classList.toggle('shadow-lg', isScrolled);
            };

            window.addEventListener('scroll', this.utils.throttle(handleScroll, 100));
        },

        /**
         * Sets up Intersection Observer to highlight the active nav link on scroll.
         */
        initNavScrollObserver() {
            const { sections, navLinks } = this.elements;
            if (sections.length === 0 || navLinks.length === 0) return;

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.id;
                        navLinks.forEach(link => {
                            link.classList.toggle('active', link.getAttribute('href').includes(`#${id}`));
                        });
                    }
                });
            }, { rootMargin: `-${this.state.headerHeight}px 0px -50% 0px` });

            sections.forEach(section => observer.observe(section));
        },

        /**
         * Handles smooth scrolling when a nav link is clicked.
         */
        initSmoothScroll() {
            const { navLinks, mobileMenu } = this.elements;
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href');
                    const targetId = href.split('#')[1];

                    if (targetId) {
                        e.preventDefault();
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - this.state.headerHeight;
                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });
                            // Close mobile menu if open
                            if (this.state.isMenuOpen) {
                                this.state.isMenuOpen = false;
                                mobileMenu.classList.add('hidden');
                            }
                        }
                    }
                });
            });
        },

        /**
         * NEW FEATURE: Creates and manages a "Scroll to Top" button.
         */
        initScrollToTop() {
            // Create the button element
            const btn = document.createElement('button');
            btn.innerHTML = `<i class="fa-solid fa-arrow-up"></i>`;
            btn.id = 'scrollToTopBtn';
            btn.className = 'fixed bottom-5 right-5 z-50 w-12 h-12 bg-primary-dark text-white rounded-full shadow-lg flex items-center justify-center text-xl transform translate-y-20 opacity-0 transition-all duration-300 ease-in-out hover:bg-primary-light';
            document.body.appendChild(btn);
            this.elements.scrollToTopBtn = btn;

            // Show/hide based on scroll position
            const handleScroll = () => {
                if (window.scrollY > 300) {
                    btn.classList.remove('translate-y-20', 'opacity-0');
                } else {
                    btn.classList.add('translate-y-20', 'opacity-0');
                }
            };
            
            window.addEventListener('scroll', this.utils.throttle(handleScroll, 200));

            // Scroll to top on click
            btn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        },

        /**
         * Creates and animates the interactive particles in the background.
         */
        initParticleEffect() {
            const { particleContainer } = this.elements;
            const fragment = document.createDocumentFragment();

            for (let i = 0; i < this.config.particleCount; i++) {
                let particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = `${Math.random() * 100}vw`;
                particle.style.top = `${Math.random() * 100}vh`;
                particle.style.width = particle.style.height = `${Math.random() * 3 + 2}px`;
                particle.style.animationDuration = `${Math.random() * 15 + 10}s`;
                particle.style.animationDelay = `${Math.random() * -25}s`; // Start animations at random points
                fragment.appendChild(particle);
            }
            particleContainer.appendChild(fragment);

            // This part for mouse interaction can be performance-heavy.
            // It's kept minimal and can be enabled if needed.
            // Example: Add a class to particles near the mouse.
            // For simplicity, this example focuses on the floating effect.
        }
    };

    // Run the application
    App.init();

});


