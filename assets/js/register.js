document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const strengthMeterBar = document.querySelector('#password-strength-meter .strength-bar');
    const strengthText = document.getElementById('password-strength-text');

    if (!passwordInput || !strengthMeterBar || !strengthText) {
        // If any required element is missing, do not proceed.
        return;
    }

    /**
     * Analyzes the password and returns a strength score and label.
     * @param {string} password The password to analyze.
     * @returns {object} An object containing the score (0-4) and a descriptive label.
     */
    const checkPasswordStrength = (password) => {
        let score = 0;
        let feedback = {
            label: 'Weak',
            className: 'weak'
        };

        if (password.length === 0) {
            return { score: -1, label: '', className: '' }; // Special case for empty
        }

        // Rule 1: Length (at least 8 characters)
        if (password.length >= 8) {
            score++;
        }
        // Rule 2: Contains a lowercase letter
        if (/[a-z]/.test(password)) {
            score++;
        }
        // Rule 3: Contains an uppercase letter
        if (/[A-Z]/.test(password)) {
            score++;
        }
        // Rule 4: Contains a number
        if (/[0-9]/.test(password)) {
            score++;
        }
        // Rule 5: Contains a special character
        if (/[^a-zA-Z0-9]/.test(password)) {
            score++;
        }

        // Determine feedback based on the final score
        switch (score) {
            case 5:
                feedback = { label: 'Very Strong', className: 'very-strong' };
                break;
            case 4:
                feedback = { label: 'Strong', className: 'strong' };
                break;
            case 3:
                feedback = { label: 'Medium', className: 'medium' };
                break;
            default: // Score 0, 1, or 2
                feedback = { label: 'Weak', className: 'weak' };
                break;
        }
        
        if (password.length < 8) {
             feedback.label = 'Weak (must be at least 8 characters)';
             feedback.className = 'weak';
        }


        return feedback;
    };

    /**
     * Updates the UI of the strength meter based on the password's strength.
     */
    const updateStrengthMeter = () => {
        const password = passwordInput.value;
        const strength = checkPasswordStrength(password);

        // Reset classes
        strengthMeterBar.classList.remove('weak', 'medium', 'strong', 'very-strong');

        if (password.length > 0) {
            strengthMeterBar.classList.add(strength.className);
            strengthText.textContent = `Strength: ${strength.label}`;
        } else {
            strengthText.textContent = '';
        }
    };

    // Add an event listener to the password field to check strength on input
    passwordInput.addEventListener('input', updateStrengthMeter);
});
