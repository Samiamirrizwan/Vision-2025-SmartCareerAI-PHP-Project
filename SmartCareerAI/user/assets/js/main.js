document.addEventListener('DOMContentLoaded', () => {
    console.log("SmartCareerAI JS Initialized");

    // --- Live Clock Functionality ---
    const clockElement = document.getElementById('live-clock');
    function updateClock() {
        if (clockElement) {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            clockElement.textContent = now.toLocaleDateString('en-US', options);
        }
    }
    updateClock();
    setInterval(updateClock, 1000 * 60); // Update every minute

    // --- ENHANCED Mobile Menu Toggle ---
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mainNav = document.getElementById('main-nav');
    
    if (mobileMenuBtn && mainNav) {
        const menuIcon = mobileMenuBtn.querySelector('i'); // Get the icon element

        mobileMenuBtn.addEventListener('click', () => {
            const isActive = mainNav.classList.toggle('active');
            
            // Prevent body from scrolling when the overlay is active
            document.body.classList.toggle('no-scroll', isActive);

             // --- ADD THIS LINE FOR ACCESSIBILITY ---
        mobileMenuBtn.setAttribute('aria-expanded', isActive);


            // Change icon from hamburger to 'X' and back
            if (isActive) {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            } else {
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        });


            // --- ADD THIS ENTIRE BLOCK TO CLOSE MENU ON LINK CLICK ---
    mainNav.addEventListener('click', (e) => {
        // Check if the clicked element is a link inside the nav
        if (e.target.tagName === 'A' && mainNav.classList.contains('active')) {
            mainNav.classList.remove('active');
            document.body.classList.remove('no-scroll');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            
            // Reset menu icon
            if (menuIcon) {
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        }
    });

    
    }

    

    // --- Test Form Multi-step and Validation ---
    const testForm = document.getElementById('career-test-form');
    if (testForm) {
        // (Your existing test form JS logic remains unchanged here)
        const questions = testForm.querySelectorAll('.test-step');
        if (questions.length > 0) {
            const prevBtn = testForm.querySelector('.test-prev');
            const nextBtn = testForm.querySelector('.test-next');
            const submitBtn = testForm.querySelector('.test-submit');
            const progressBar = document.querySelector('.test-progress-bar');
            let currentStep = 0;

            function updateProgress() {
                const progress = ((currentStep + 1) / questions.length) * 100;
                progressBar.style.width = `${progress}%`;
            }

            function goToStep(step) {
                questions[currentStep].style.display = 'none';
                currentStep = step;
                questions[currentStep].style.display = 'block';

                prevBtn.style.display = (currentStep === 0) ? 'none' : 'inline-block';
                nextBtn.style.display = (currentStep === questions.length - 1) ? 'none' : 'inline-block';
                submitBtn.style.display = (currentStep === questions.length - 1) ? 'inline-block' : 'none';
                
                updateProgress();
            }

            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                const currentQuestion = questions[currentStep];
                const selectedOption = currentQuestion.querySelector('input[type="radio"]:checked');
                if (!selectedOption) {
                    alert('Please select an option before proceeding.');
                    return;
                }
                goToStep(currentStep + 1);
            });

            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                goToStep(currentStep - 1);
            });

            testForm.addEventListener('submit', (e) => {
                const currentQuestion = questions[currentStep];
                const selectedOption = currentQuestion.querySelector('input[type="radio"]:checked');
                if (!selectedOption) {
                    alert('Please select an option before submitting.');
                    e.preventDefault();
                }
            });
            
            goToStep(0);
        }
    }
});
