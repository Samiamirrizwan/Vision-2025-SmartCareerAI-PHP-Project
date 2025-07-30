document.addEventListener('DOMContentLoaded', () => {

    // --- Page Loader ---
    const pageLoader = document.getElementById('page-loader');
    if (pageLoader) {
        window.addEventListener('load', () => {
            pageLoader.style.opacity = '0';
            pageLoader.style.visibility = 'hidden';
        });
    }

    // --- Form Submission Handler ---
    const form = document.getElementById('forgot-password-form');
    const submitButton = form ? form.querySelector('button[type="submit"]') : null;

    if (form && submitButton) {
        form.addEventListener('submit', () => {
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span>
                Processing...
            `;
        });
    }

    // --- Password Reset Form with Strength Meter ---
    const resetForm = document.getElementById('reset-password-form');
    if (resetForm) {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        const strengthIndicator = document.getElementById('strength-indicator');
        const strengthText = document.getElementById('strength-text');
        const submitResetButton = resetForm.querySelector('button[type="submit"]');

        const checkPasswordStrength = () => {
            const val = password.value;
            let strength = 0;
            if (val.length > 7) strength++;
            if (val.match(/[A-Z]/)) strength++;
            if (val.match(/[a-z]/)) strength++;
            if (val.match(/[0-9]/)) strength++;
            if (val.match(/[^A-Za-z0-9]/)) strength++;

            const strengthMap = {
                0: { text: '', class: '' },
                1: { text: 'Very Weak', class: 'bg-red-500' },
                2: { text: 'Weak', class: 'bg-orange-500' },
                3: { text: 'Medium', class: 'bg-yellow-500' },
                4: { text: 'Strong', class: 'bg-blue-500' },
                5: { text: 'Very Strong', class: 'bg-green-500' }
            };

            strengthIndicator.className = `h-1 rounded-full transition-all ${strengthMap[strength].class}`;
            strengthIndicator.style.width = `${strength * 20}%`;
            strengthText.textContent = strengthMap[strength].text;
        };

        const validatePasswords = () => {
            if (password.value && password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords do not match.");
                submitResetButton.disabled = true;
            } else {
                confirmPassword.setCustomValidity("");
                submitResetButton.disabled = false;
            }
        };
        
        password.addEventListener('input', () => {
            checkPasswordStrength();
            validatePasswords();
        });

        confirmPassword.addEventListener('input', validatePasswords);
    }
});
