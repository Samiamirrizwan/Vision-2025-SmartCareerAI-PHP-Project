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
    // --- Mobile Menu Toggle ---
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mainNav = document.getElementById('main-nav');
    if (mobileMenuBtn && mainNav) {
        mobileMenuBtn.addEventListener('click', () => {
            mainNav.classList.toggle('active');
        });
    }
    // --- Modal Handling ---
    // ... existing modal handling code ...
    // --- Test Form Multi-step and Validation ---
    const testForm = document.getElementById('career-test-form');
    if (testForm) {
        const questions = testForm.querySelectorAll('.test-step');
        const prevBtn = testForm.querySelector('.test-prev');
        const nextBtn = testForm.querySelector('.test-next');
        const submitBtn = testForm.querySelector('.test-submit');
        const progressBar = document.querySelector('.test-progress-bar');
        let currentStep = 0;
        // Initially hide all steps except the first
        questions.forEach((step, index) => {
            if (index !== 0) {
                step.style.display = 'none';
            }
        });
        // Update progress bar
        function updateProgress() {
            const progress = ((currentStep + 1) / questions.length) * 100;
            progressBar.style.width = `${progress}%`;
        }
        // Navigation functions
        function goToStep(step) {
            // Hide current step
            questions[currentStep].style.display = 'none';
            // Show new step
            currentStep = step;
            questions[currentStep].style.display = 'block';
            // Update buttons
            if (currentStep === 0) {
                prevBtn.style.display = 'none';
            } else {
                prevBtn.style.display = 'inline-block';
            }
            if (currentStep === questions.length - 1) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-block';
            } else {
                nextBtn.style.display = 'inline-block';
                submitBtn.style.display = 'none';
            }
            updateProgress();
        }
        // Next button
        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            // Validate current step
            const currentQuestion = questions[currentStep];
            const selectedOption = currentQuestion.querySelector('input[type="radio"]:checked');
            if (!selectedOption) {
                alert('Please select an option before proceeding.');
                return;
            }
            goToStep(currentStep + 1);
        });
        // Previous button
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            goToStep(currentStep - 1);
        });
        // Submit button
        submitBtn.addEventListener('click', (e) => {
            // Final validation on submit
            const currentQuestion = questions[currentStep];
            const selectedOption = currentQuestion.querySelector('input[type="radio"]:checked');
            if (!selectedOption) {
                alert('Please select an option before submitting.');
                e.preventDefault();
            }
        });
        // Initialize
        prevBtn.style.display = 'none';
        submitBtn.style.display = 'none';
        updateProgress();
    }
});