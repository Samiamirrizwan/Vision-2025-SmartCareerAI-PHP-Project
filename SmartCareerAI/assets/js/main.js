// Replace the content of /assets/js/script.js with this

document.addEventListener('DOMContentLoaded', () => {

    /**
     * Toggles password visibility in an input field.
     */
    const togglePasswordVisibility = () => {
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function () {
                const targetInput = document.querySelector(this.dataset.target);
                if (targetInput) {
                    if (targetInput.type === 'password') {
                        targetInput.type = 'text';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    } else {
                        targetInput.type = 'password';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    }
                }
            });
        });
    };

    /**
     * Asynchronously handles the submission for both login and register forms.
     * @param {HTMLFormElement} form - The form element being submitted.
     * @param {Event} event - The submit event.
     */
    const handleFormSubmit = async (form, event) => {
        event.preventDefault(); // Prevent the default page reload

        const submitButton = form.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;

        // --- Client-Side Validation ---
        if (form.id === 'registerForm') {
            const password = form.querySelector('#password').value;
            const passwordConfirm = form.querySelector('#password_confirm').value;
            const terms = form.querySelector('#terms').checked;

            if (password !== passwordConfirm) {
                showAlert('Form error: Passwords do not match.', 'danger', form);
                return;
            }
            if (!terms) {
                showAlert('Please agree to the Terms of Service to register.', 'danger', form);
                return;
            }
        }
        
        // --- Disable button and show loading state ---
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="loader"></span> Processing...';

        const formData = new FormData(form);
        const action = form.action;

        try {
            // --- AJAX request using fetch ---
            const response = await fetch(action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json' // Tell the server we want JSON back
                }
            });

            const result = await response.json();

            // --- Handle Server Response ---
            if (result.status === 'success') {
                showAlert(result.message, 'success', form);
                // Redirect on success after a short delay
                if (result.redirect_url) {
                    setTimeout(() => {
                        window.location.href = result.redirect_url;
                    }, 1500);
                }
            } else {
                showAlert(result.message || 'An unknown error occurred.', 'danger', form);
            }

        } catch (error) {
            console.error('Submission error:', error);
            showAlert('A network error occurred. Please try again later.', 'danger', form);
        } finally {
            // --- Re-enable button ---
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        }
    };

    // Attach event listeners to forms
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    if (loginForm) {
        loginForm.addEventListener('submit', (e) => handleFormSubmit(loginForm, e));
    }
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => handleFormSubmit(registerForm, e));
    }

    // Initialize password toggle feature
    togglePasswordVisibility();
});

/**
 * Displays a dynamic alert message within a form.
 * @param {string} message The message to display.
 * @param {string} type The alert type ('success' or 'danger').
 * @param {HTMLFormElement} form The form where the alert should be displayed.
 */
function showAlert(message, type, form) {
    // Remove any existing alert first
    const existingAlert = form.querySelector('#alertMessage');
    if (existingAlert) {
        existingAlert.remove();
    }

    const alertTypeClass = type === 'success' ? 'alert-success' : 'alert-danger';
    
    // Create the new alert element
    const alertDiv = document.createElement('div');
    alertDiv.id = 'alertMessage';
    alertDiv.className = `alert ${alertTypeClass}`;
    alertDiv.setAttribute('role', 'alert');
    alertDiv.innerHTML = `
        <span>${message}</span>
        <button class="close-btn" aria-label="Close" onclick="this.parentElement.remove()">&times;</button>
    `;
    
    // Insert the new alert at the top of the form
    form.prepend(alertDiv);
    alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
}