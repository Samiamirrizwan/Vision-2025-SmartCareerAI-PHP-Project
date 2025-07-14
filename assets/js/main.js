document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    if (togglePassword && password) {
        togglePassword.addEventListener('click', function () {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    }

    // Alert message fade out
    const alertMessage = document.getElementById('alertMessage');
    if (alertMessage) {
        // Automatically fade out after 5 seconds
        setTimeout(() => {
            alertMessage.classList.add('alert-fade-out');
            // Optional: remove from DOM after fade out
            setTimeout(() => {
                if(alertMessage) alertMessage.style.display = 'none';
            }, 500); // Corresponds to the transition duration
        }, 5000);
    }
});