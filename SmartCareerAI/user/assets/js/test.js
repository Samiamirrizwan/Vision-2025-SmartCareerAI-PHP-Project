document.addEventListener('DOMContentLoaded', () => {
    const testForm = document.getElementById('career-test-form');
    if (!testForm) return;

    const steps = Array.from(testForm.querySelectorAll('.test-step'));
    const prevBtn = testForm.querySelector('.test-prev');
    const nextBtn = testForm.querySelector('.test-next');
    const submitBtn = testForm.querySelector('.test-submit');
    const progressBar = testForm.querySelector('.test-progress-bar');
    const progressInfo = testForm.querySelector('.test-progress-info');
    
    let currentStep = 0;
    const totalSteps = steps.length;

    function showStep(stepIndex) {
        // Hide all steps
        steps.forEach(step => step.classList.remove('active'));
        
        // Show the target step
        if (steps[stepIndex]) {
            steps[stepIndex].classList.add('active');
        }

        updateUI();
    }

    function isStepAnswered(stepIndex) {
        const currentStepElement = steps[stepIndex];
        if (!currentStepElement) return false;
        const radioButtons = currentStepElement.querySelectorAll('input[type="radio"]');
        return Array.from(radioButtons).some(radio => radio.checked);
    }

    function updateUI() {
        // Update progress bar
        const progressPercentage = ((currentStep + 1) / totalSteps) * 100;
        progressBar.style.width = `${progressPercentage}%`;
        
        // Update progress text
        progressInfo.textContent = `Question ${currentStep + 1} of ${totalSteps}`;

        // Update button visibility and state
        prevBtn.style.display = currentStep > 0 ? 'inline-flex' : 'none';
        nextBtn.style.display = currentStep < totalSteps - 1 ? 'inline-flex' : 'none';
        submitBtn.style.display = currentStep === totalSteps - 1 ? 'inline-flex' : 'none';

        // Disable Next/Submit button if the current question isn't answered
        const canProceed = isStepAnswered(currentStep);
        if (currentStep < totalSteps - 1) {
            nextBtn.disabled = !canProceed;
        } else {
            submitBtn.disabled = !canProceed;
        }
    }

    function validateStep() {
        if (!isStepAnswered(currentStep)) {
            alert('Please select an answer to continue.');
            return false;
        }
        return true;
    }

    // Event Listeners
    nextBtn.addEventListener('click', () => {
        if (validateStep()) {
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.addEventListener('click', () => {
        currentStep--;
        showStep(currentStep);
    });

    testForm.addEventListener('submit', (e) => {
        if (!validateStep()) {
            e.preventDefault(); // Prevent submission if last question isn't answered
        } else {
            // Improve appearance of submit button on click
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span>
                Submitting...
            `;
        }
    });

    // Add event listeners to all radio buttons to update UI on selection
    steps.forEach(step => {
        const radios = step.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                updateUI();
            });
        });
    });

    // Initialize the test
    showStep(0);
});
