/**
 * ===================================================================
 * SCRIPT.JS - Refactored & Enhanced
 * ===================================================================
 */

document.addEventListener('DOMContentLoaded', () => {

    const App = {
        elements: {
            header: document.getElementById('main-header'),
            mobileMenuButton: document.getElementById('mobile-menu-button'),
            mobileMenu: document.getElementById('mobile-menu'),
            particleContainer: document.getElementById('particle-container'),
            passwordToggles: document.querySelectorAll('.toggle-password'),
            navLinks: document.querySelectorAll('.nav-link'),
            sections: document.querySelectorAll('section[id]'),
            scrollToTopBtn: null,
            // Admin dropdown elements
            adminDropdownContainer: document.getElementById('admin-dropdown-container'),
            adminDropdownButton: document.getElementById('admin-dropdown-button'),
            adminDropdownMenu: document.getElementById('admin-dropdown-menu'),
            // Blog dropdown elements
            blogDropdownContainer: document.getElementById('blog-dropdown-container'),
            blogDropdownButton: document.getElementById('blog-dropdown-button'),
            blogDropdownMenu: document.getElementById('blog-dropdown-menu'),
            // FAQ elements
            faqAccordion: document.getElementById('faq-accordion'),
            // Contact form elements
            contactForm: document.getElementById('contact-form'),
            // UX Enhancement Elements
            pageLoader: document.getElementById('page-loader'),
            mouseGlow: document.getElementById('mouse-glow'),
            tiltElements: document.querySelectorAll('.blog-tilt-wrapper'),
            revealElements: document.querySelectorAll('.reveal'),
        },
        state: {
            currentPage: document.body.dataset.page || 'unknown',
            isBlogPage: document.body.classList.contains('blog-page'),
            isMenuOpen: false,
            isAdminDropdownOpen: false,
            isBlogDropdownOpen: false,
            headerHeight: 0
        },
        config: {
            scrollThreshold: 50,
            particleCount: 80,
        },

        utils: {
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

        init() {
            console.log(`SmartCareerAI JS Initializing for page: ${this.state.currentPage} 🚀`);
            this.state.headerHeight = this.elements.header ? this.elements.header.offsetHeight : 0;
            
            this.initPageLoader();
            this.initMobileMenu();
            this.initPasswordToggle();
            this.initScrollToTop();
            this.initAdminDropdown();
            this.initBlogDropdown();
            
            if (this.state.currentPage === 'home.php') {
                this.initHeaderScrollBehavior();
                this.initNavScrollObserver();
                this.initSmoothScroll();
                if (this.elements.particleContainer) this.initParticleEffect();
            }

            if (this.state.currentPage === 'faqs.php') {
                this.initFaqAccordion();
            }

            if (this.state.currentPage === 'contact.php') {
                this.initContactForm();
            }

            // Run blog-specific enhancements
            if (this.state.isBlogPage || document.querySelector('.site-logo')) {
                this.initMouseGlow();
            }
            if (this.state.isBlogPage) {
                this.initTiltEffect();
                this.initScrollAnimations();
            }

            window.addEventListener('resize', this.utils.throttle(() => {
                this.state.headerHeight = this.elements.header ? this.elements.header.offsetHeight : 0;
            }, 200));
        },

        initPageLoader() {
            window.addEventListener('load', () => {
                if(this.elements.pageLoader) {
                    this.elements.pageLoader.classList.add('fade-out');
                    setTimeout(() => {
                        this.elements.pageLoader.style.display = 'none';
                    }, 500);
                }
            });
        },
        
        initMouseGlow() {
            if (!this.elements.mouseGlow) return;
            document.addEventListener('mousemove', (e) => {
                // Use requestAnimationFrame for smoother animation
                window.requestAnimationFrame(() => {
                    this.elements.mouseGlow.style.transform = `translate(${e.clientX}px, ${e.clientY}px) translate(-50%, -50%)`;
                });
            });
        },

        initTiltEffect() {
            if (this.elements.tiltElements.length > 0 && typeof VanillaTilt !== 'undefined') {
                VanillaTilt.init(this.elements.tiltElements, {
                    max: 5,
                    speed: 400,
                    glare: true,
                    "max-glare": 0.1,
                    "transform-style": "preserve-3d"
                });
            }
        },
        
        initScrollAnimations() {
            if (this.elements.revealElements.length === 0) return;
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            this.elements.revealElements.forEach(el => observer.observe(el));
        },
        
        initBlogDropdown() {
            const { blogDropdownButton, blogDropdownMenu, blogDropdownContainer } = this.elements;
            if (!blogDropdownButton || !blogDropdownMenu || !blogDropdownContainer) return;

            const toggleDropdown = (e) => {
                 e.stopPropagation();
                 this.state.isBlogDropdownOpen = !this.state.isBlogDropdownOpen;
                 blogDropdownMenu.classList.toggle('hidden', !this.state.isBlogDropdownOpen);
            };
            
            blogDropdownButton.addEventListener('click', toggleDropdown);

            document.addEventListener('click', (e) => {
                if (this.state.isBlogDropdownOpen && !blogDropdownContainer.contains(e.target)) {
                    this.state.isBlogDropdownOpen = false;
                    blogDropdownMenu.classList.add('hidden');
                }
            });
        },

        initAdminDropdown() {
            const { adminDropdownButton, adminDropdownMenu, adminDropdownContainer } = this.elements;
            if (!adminDropdownButton || !adminDropdownMenu || !adminDropdownContainer) return;

            adminDropdownButton.addEventListener('click', (e) => {
                e.stopPropagation();
                this.state.isAdminDropdownOpen = !this.state.isAdminDropdownOpen;
                adminDropdownMenu.classList.toggle('hidden', !this.state.isAdminDropdownOpen);
            });
            
            document.addEventListener('click', (e) => {
                if (this.state.isAdminDropdownOpen && !adminDropdownContainer.contains(e.target)) {
                    this.state.isAdminDropdownOpen = false;
                    adminDropdownMenu.classList.add('hidden');
                }
            });
        },

        initMobileMenu() {
            const { mobileMenuButton, mobileMenu } = this.elements;
            if (!mobileMenuButton || !mobileMenu) return;

            mobileMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                this.state.isMenuOpen = !this.state.isMenuOpen;
                mobileMenu.classList.toggle('hidden', !this.state.isMenuOpen);
            });

            document.addEventListener('click', (e) => {
                if (this.state.isMenuOpen && !mobileMenu.contains(e.target) && e.target !== mobileMenuButton) {
                    this.state.isMenuOpen = false;
                    mobileMenu.classList.add('hidden');
                }
            });
        },

        initPasswordToggle() {
            this.elements.passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const targetSelector = this.dataset.target;
                    const passwordInput = document.querySelector(targetSelector);
                    if (!passwordInput) return;
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    this.classList.toggle('fa-eye', !isPassword);
                    this.classList.toggle('fa-eye-slash', isPassword);
                });
            });
        },
        
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

        initNavScrollObserver() {
            const { sections, navLinks } = this.elements;
            if (sections.length === 0 || navLinks.length === 0 || this.state.currentPage !== 'home.php') return;

            // A map to keep track of which sections are currently intersecting
            const intersectingState = new Map();

            const observerCallback = (entries) => {
                entries.forEach(entry => {
                    intersectingState.set(entry.target.id, entry.isIntersecting);
                });

                let currentActiveId = null;

                // Find the ID of the last intersecting section from the top of the page
                for (const section of sections) {
                    if (intersectingState.get(section.id)) {
                        currentActiveId = section.id;
                        // No break here, we want the last one in the DOM order that is intersecting
                    }
                }
                
                navLinks.forEach(link => {
                    const linkHref = link.getAttribute('href');
                    if (linkHref && linkHref.includes('#')) { // Process only anchor links
                        const linkId = linkHref.substring(linkHref.indexOf('#') + 1);
                        
                        // Set active if the link's ID matches the current active section ID
                        if (linkId === currentActiveId) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    }
                });

                // Special case: if no section is active (e.g., at the very top), activate the 'home' link
                if (!currentActiveId && window.scrollY < 200) {
                     navLinks.forEach(link => link.classList.remove('active'));
                     const homeLink = document.querySelector('.nav-links a[href*="#home"]');
                     if(homeLink) homeLink.classList.add('active');
                }
            };

            const observer = new IntersectionObserver(observerCallback, {
                // Adjust rootMargin to trigger when the section top is near the bottom of the header
                rootMargin: `-${this.state.headerHeight}px 0px -50% 0px`,
                threshold: 0
            });

            sections.forEach(section => observer.observe(section));
        },

        initSmoothScroll() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', (e) => {
                    const href = anchor.getAttribute('href');
                    const targetElement = document.querySelector(href);
                    if(targetElement) {
                        e.preventDefault();
                        const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - this.state.headerHeight;
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        },

        initScrollToTop() {
            const btn = document.createElement('button');
            btn.innerHTML = `<i class="fa-solid fa-arrow-up"></i>`;
            btn.id = 'scrollToTopBtn';
            btn.className = 'fixed bottom-5 right-5 z-50 w-12 h-12 bg-blue-600 text-white rounded-full shadow-lg flex items-center justify-center text-xl transform translate-y-20 opacity-0 transition-all duration-300 ease-in-out hover:bg-blue-700';
            document.body.appendChild(btn);
            this.elements.scrollToTopBtn = btn;
            const handleScroll = () => {
                if (window.scrollY > 300) {
                    btn.classList.remove('translate-y-20', 'opacity-0');
                } else {
                    btn.classList.add('translate-y-20', 'opacity-0');
                }
            };
            window.addEventListener('scroll', this.utils.throttle(handleScroll, 200));
            btn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        },
        
        /**
         * FIXED: Initializes the FAQ accordion with more robust checks.
         */
        initFaqAccordion() {
            if (!this.elements.faqAccordion) {
                console.warn('FAQ container with id="faq-accordion" not found.');
                return;
            }
            // Use event delegation for better performance and flexibility
            this.elements.faqAccordion.addEventListener('click', (e) => {
                const question = e.target.closest('.faq-question');
                if (!question) return; // Exit if the click was not on a question button

                const item = question.parentElement;
                const answer = question.nextElementSibling;
                const icon = question.querySelector('i');

                if (!item || !answer) {
                    console.warn('FAQ item has incorrect structure.', item);
                    return;
                }

                const isOpen = item.classList.toggle('open');
                
                if (isOpen) {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    if (icon) icon.style.transform = 'rotate(180deg)';
                } else {
                    answer.style.maxHeight = '0';
                    if (icon) icon.style.transform = 'rotate(0deg)';
                }
            });
        },

        initContactForm() {
            if (!this.elements.contactForm) return;

            this.elements.contactForm.addEventListener('submit', (e) => {
                const submitBtn = e.target.querySelector('#contact-submit-btn');
                const btnText = submitBtn.querySelector('.btn-text');
                const loader = submitBtn.querySelector('.loader');

                let isValid = true;
                e.target.querySelectorAll('[required]').forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                    }
                });

                if (isValid) {
                    btnText.style.display = 'none';
                    loader.style.display = 'inline-block';
                    submitBtn.disabled = true;
                }
            });
        },

        initParticleEffect() {
            const { particleContainer } = this.elements;
            if(!particleContainer) return;
            const fragment = document.createDocumentFragment();
            for (let i = 0; i < this.config.particleCount; i++) {
                let particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = `${Math.random() * 100}vw`;
                particle.style.top = `${Math.random() * 100}vh`;
                particle.style.width = particle.style.height = `${Math.random() * 3 + 2}px`;
                particle.style.animationDuration = `${Math.random() * 15 + 10}s`;
                particle.style.animationDelay = `${Math.random() * -25}s`;
                fragment.appendChild(particle);
            }
            particleContainer.appendChild(fragment);
        }
    };

    App.init();
});
