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
            mobileNavLinks: document.querySelectorAll('.mobile-nav-link'),
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
            // UPDATED: Selector now includes home page cards and blog wrappers
            tiltElements: document.querySelectorAll('.blog-tilt-wrapper, .interactive-tilt'),
            revealElements: document.querySelectorAll('.reveal'),
            // ADDED: Elements for "How It Works" section enhancements
            matrixCanvas: document.getElementById('matrix-canvas'),
            stepItems: document.querySelectorAll('.step-item'),
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
            // ADDED: Config for magnetic effect
            magneticForce: 0.25, // How strongly the element is pulled to the cursor
            magneticDistance: 80, // The radius (in px) where the effect starts
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
            this.initDropdown(this.elements.adminDropdownButton, this.elements.adminDropdownMenu, 'isAdminDropdownOpen');
            this.initDropdown(this.elements.blogDropdownButton, this.elements.blogDropdownMenu, 'isBlogDropdownOpen');
            this.initScrollAnimations();
            this.initTiltEffect(); // MOVED: Initialize tilt effect globally, function will check for elements

            if (this.state.currentPage === 'home.php') {
                this.initHeaderScrollBehavior();
                this.initNavScrollObserver();
                this.initSmoothScroll();
                if (this.elements.particleContainer) this.initParticleEffect();
                // ADDED: Initialize "How It Works" enhancements
                if (this.elements.matrixCanvas) this.initMatrixEffect();
                if (this.elements.stepItems.length > 0) this.initMagneticSteps();
            }

            if (this.state.currentPage === 'faqs.php') {
                this.initFaqAccordion();
            }

            if (this.state.currentPage === 'contact.php') {
                this.initContactForm();
            }

            // FIXED: Refined logic for clarity. Glow now runs only on specified pages.
            if (this.state.currentPage === 'home.php' || this.state.isBlogPage) {
                this.initMouseGlow();
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
                window.requestAnimationFrame(() => {
                    this.elements.mouseGlow.style.transform = `translate(${e.clientX}px, ${e.clientY}px) translate(-50%, -50%)`;
                });
            });
        },
        
        // ENHANCED: Tilt effect now applies to home page cards with more interactive settings
        initTiltEffect() {
            if (this.elements.tiltElements.length > 0 && typeof VanillaTilt !== 'undefined') {
                VanillaTilt.init(this.elements.tiltElements, {
                    max: 8,           // Max tilt rotation (degrees)
                    speed: 600,         // Speed of the enter/exit transition
                    scale: 1.05,        // 1.05 = 5% grow effect on hover
                    perspective: 1500,  // Transform perspective, the lower the more extreme the tilt
                    glare: true,        // Add a glare effect
                    "max-glare": 0.25,  // How much glare to show (0 to 1)
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
        
        initDropdown(button, menu, stateKey) {
            if (!button || !menu) return;
            const icon = button.querySelector('i');

            button.addEventListener('click', (e) => {
                e.stopPropagation();
                this.state[stateKey] = !this.state[stateKey];
                menu.classList.toggle('open', this.state[stateKey]);
                if(icon) icon.style.transform = this.state[stateKey] ? 'rotate(180deg)' : 'rotate(0deg)';
            });

            document.addEventListener('click', (e) => {
                if (this.state[stateKey] && !menu.contains(e.target) && e.target !== button) {
                    this.state[stateKey] = false;
                    menu.classList.remove('open');
                    if(icon) icon.style.transform = 'rotate(0deg)';
                }
            });
        },

        initMobileMenu() {
            const { mobileMenuButton, mobileMenu } = this.elements;
            if (!mobileMenuButton || !mobileMenu) return;

            mobileMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                this.state.isMenuOpen = !this.state.isMenuOpen;
                mobileMenu.classList.toggle('open', this.state.isMenuOpen);
            });

            document.addEventListener('click', (e) => {
                if (this.state.isMenuOpen && !mobileMenu.contains(e.target) && e.target !== mobileMenuButton) {
                    this.state.isMenuOpen = false;
                    mobileMenu.classList.remove('open');
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
            const { sections, navLinks, mobileNavLinks } = this.elements;
            const allLinks = [...navLinks, ...mobileNavLinks];
            if (sections.length === 0 || allLinks.length === 0 || this.state.currentPage !== 'home.php') return;

            const intersectingState = new Map();

            const observerCallback = (entries) => {
                entries.forEach(entry => {
                    intersectingState.set(entry.target.id, entry.isIntersecting);
                });

                let currentActiveId = null;

                for (const section of sections) {
                    if (intersectingState.get(section.id)) {
                        currentActiveId = section.id;
                    }
                }
                
                allLinks.forEach(link => {
                    const linkHref = link.getAttribute('href');
                    if (linkHref && linkHref.includes('#')) {
                        const linkId = linkHref.substring(linkHref.indexOf('#') + 1);
                        if (linkId === currentActiveId) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    }
                });

                if (!currentActiveId && window.scrollY < 200) {
                     allLinks.forEach(link => {
                        const linkId = link.getAttribute('href').substring(link.getAttribute('href').indexOf('#') + 1);
                        if (linkId === 'home') {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                     });
                }
            };

            const observer = new IntersectionObserver(observerCallback, {
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
        
        initFaqAccordion() {
            if (!this.elements.faqAccordion) {
                console.warn('FAQ container with id="faq-accordion" not found.');
                return;
            }
            this.elements.faqAccordion.addEventListener('click', (e) => {
                const question = e.target.closest('.faq-question');
                if (!question) return;

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
        },

        // ===================================================================
        // ADDED: "HOW IT WORKS" SECTION ENHANCEMENTS
        // ===================================================================
        
        initMatrixEffect() {
            const canvas = this.elements.matrixCanvas;
            const ctx = canvas.getContext('2d');
            
            let animationFrameId;

            const setup = () => {
                if (animationFrameId) cancelAnimationFrame(animationFrameId);
                
                canvas.width = canvas.offsetWidth;
                canvas.height = canvas.offsetHeight;
        
                const characters = 'アァカサタナハマヤャラワガザダバパイィキシチニヒミリヰギジヂビピウゥクスツヌフムユュルグズブプエェケセテネヘメレヱゲゼデベペオォコソトノホモヨョロヲゴゾドボポヴッン01';
                const charArray = characters.split('');
                const fontSize = 14;
                const columns = Math.floor(canvas.width / fontSize);
                const drops = Array(columns).fill(1);
        
                const draw = () => {
                    ctx.fillStyle = 'rgba(10, 10, 26, 0.05)';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    
                    ctx.fillStyle = 'rgba(59, 130, 246, 0.7)';
                    ctx.font = `${fontSize}px monospace`;
        
                    for (let i = 0; i < drops.length; i++) {
                        const text = charArray[Math.floor(Math.random() * charArray.length)];
                        ctx.fillText(text, i * fontSize, drops[i] * fontSize);
        
                        if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                            drops[i] = 0;
                        }
                        drops[i]++;
                    }
                    animationFrameId = requestAnimationFrame(draw);
                };
                draw();
            }

            setup();
            window.addEventListener('resize', this.utils.throttle(setup, 250));
        },

        initMagneticSteps() {
            this.elements.stepItems.forEach(item => {
                const circle = item.querySelector('.step-circle');
                if (!circle) return;

                item.addEventListener('mousemove', (e) => {
                    const rect = item.getBoundingClientRect();
                    const mouseX = e.clientX - rect.left - rect.width / 2;
                    const mouseY = e.clientY - rect.top - rect.height / 2;

                    const moveX = mouseX * this.config.magneticForce;
                    const moveY = mouseY * this.config.magneticForce;
                    
                    window.requestAnimationFrame(() => {
                        circle.style.transform = `translate(${moveX}px, ${moveY}px)`;
                    });
                });

                item.addEventListener('mouseleave', () => {
                    window.requestAnimationFrame(() => {
                        circle.style.transform = 'translate(0, 0)';
                    });
                });
            });
        }
    };

    App.init();
});