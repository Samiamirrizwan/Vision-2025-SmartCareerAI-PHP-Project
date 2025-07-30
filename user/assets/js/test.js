// assets/js/test.js

document.addEventListener('DOMContentLoaded', () => {
    // --- Initialize Particles.js Animation ---
    if (document.getElementById('particles-js')) {
        particlesJS("particles-js", {
            "particles": {
                "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
                "color": { "value": "#4A90E2" },
                "shape": { "type": "circle", "stroke": { "width": 0, "color": "#000000" } },
                "opacity": { "value": 0.5, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0.1, "sync": false } },
                "size": { "value": 3, "random": true, "anim": { "enable": false } },
                "line_linked": { "enable": true, "distance": 150, "color": "#30363d", "opacity": 0.4, "width": 1 },
                "move": { "enable": true, "speed": 2, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": true, "mode": "push" }, "resize": true },
                "modes": { "grab": { "distance": 140, "line_linked": { "opacity": 1 } }, "push": { "particles_nb": 4 } }
            },
            "retina_detect": true
        });
    }

    // --- Career Aptitude Test Logic ---
    const testForm = document.getElementById('career-test-form');
    if (!testForm) return;

    const questionsContainer = document.getElementById('test-questions-container');
    const prevBtn = document.getElementById('test-prev');
    const nextBtn = document.getElementById('test-next');
    const submitBtn = document.getElementById('test-submit');
    const progressBar = document.getElementById('test-progress-bar');

    // --- More Realistic and Diverse Questions ---
    const questions = [
        {
            question: "When faced with a complex problem, what is your first instinct?",
            name: "q1",
            options: { a: "Break it down into smaller, logical steps.", b: "Brainstorm creative and unconventional solutions.", c: "Analyze available data to find patterns.", d: "Organize a team to tackle it collaboratively." }
        },
        {
            question: "Which work environment sounds most appealing to you?",
            name: "q2",
            options: { a: "A quiet space where I can focus on technical tasks.", b: "A dynamic, collaborative studio or workshop.", c: "An office focused on data, research, and strategy.", d: "A leadership role where I can guide and motivate others." }
        },
        {
            question: "How do you feel about public speaking or presenting your ideas to a group?",
            name: "q3",
            options: { a: "I prefer to let my work speak for itself.", b: "I enjoy it if I'm passionate about the topic.", c: "I'm comfortable presenting data-driven insights.", d: "I feel energized by it and enjoy persuading others." }
        },
        {
            question: "What kind of tasks give you the most satisfaction?",
            name: "q4",
            options: { a: "Building or fixing something tangible (like code or hardware).", b: "Creating something new from scratch (art, music, stories).", c: "Discovering a key insight from a complex dataset.", d: "Achieving a team goal and celebrating success together." }
        },
        {
            question: "How do you prefer to learn new things?",
            name: "q5",
            options: { a: "Through structured courses, documentation, and hands-on practice.", b: "By experimenting, exploring, and learning from trial and error.", c: "By reading case studies, research papers, and analyzing trends.", d: "Through mentorship, discussion, and leading group projects." }
        },
        {
            question: "Are you more interested in the 'how' or the 'why' behind things?",
            name: "q6",
            options: { a: "Definitely 'how' – I want to know the mechanics.", b: "A mix of both – the inspiration ('why') and the execution ('how').", c: "Primarily 'why' – I want to understand the underlying reasons and impact.", d: "I'm focused on 'who' – who can make it happen and why it matters to them." }
        },
        {
            question: "When working on a project, what is your primary focus?",
            name: "q7",
            options: { a: "Functionality and efficiency.", b: "Aesthetics and user experience.", c: "Accuracy and data integrity.", d: "Team cohesion and project milestones." }
        }
    ];

    let currentStep = 0;

    function renderQuestions() {
        let questionHTML = '';
        questions.forEach((q, index) => {
            const optionsHTML = Object.entries(q.options).map(([value, label]) => `
                <div class="test-option">
                    <input type="radio" name="${q.name}" value="${value}" id="${q.name}_${value}" required>
                    <label for="${q.name}_${value}">${label}</label>
                </div>
            `).join('');

            questionHTML += `
                <div class="test-step ${index === 0 ? 'active' : ''}" data-step="${index}">
                    <label class="test-question-label">${index + 1}. ${q.question}</label>
                    <div class="test-options">${optionsHTML}</div>
                </div>
            `;
        });
        questionsContainer.innerHTML = questionHTML;
    }

    function showStep(stepIndex) {
        const steps = questionsContainer.querySelectorAll('.test-step');
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
        });
        updateUI();
    }

    function updateUI() {
        // Update Progress Bar
        const progress = ((currentStep + 1) / questions.length) * 100;
        progressBar.style.width = `${progress}%`;

        // Update Buttons
        prevBtn.disabled = currentStep === 0;
        nextBtn.style.display = currentStep === questions.length - 1 ? 'none' : 'inline-flex';
        submitBtn.style.display = currentStep === questions.length - 1 ? 'inline-flex' : 'none';
    }

    nextBtn.addEventListener('click', () => {
        const currentQuestion = questionsContainer.querySelector(`.test-step[data-step="${currentStep}"]`);
        const selectedOption = currentQuestion.querySelector('input[type="radio"]:checked');
        
        if (!selectedOption) {
            alert('Please select an option to continue.');
            return;
        }

        if (currentStep < questions.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    testForm.addEventListener('submit', (e) => {
        const lastQuestion = questionsContainer.querySelector(`.test-step[data-step="${currentStep}"]`);
        if (!lastQuestion.querySelector('input[type="radio"]:checked')) {
            e.preventDefault();
            alert('Please answer the final question before submitting.');
        }
    });

    // Initial setup
    renderQuestions();
    showStep(0);
});