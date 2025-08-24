// /assets/js/contact.js
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contact-form');
    if (!form) return;

    const submitButton = document.getElementById('submit-button');
    const buttonText = submitButton.querySelector('.btn-text');
    const loader = submitButton.querySelector('.loader');
    const formResponse = document.getElementById('form-response');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Basic frontend validation
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Show loading state
        buttonText.classList.add('hidden');
        loader.classList.remove('hidden');
        submitButton.disabled = true;
        formResponse.classList.add('hidden'); // Hide previous messages

        const formData = new FormData(form);

        // --- FIX ---
        // The path is corrected to point to the root directory where send_email.php is located.
        // It was previously '/api/send_email.php' which caused a 404 Not Found error.
        fetch('send_email.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // First, check if the response is ok (status in the range 200-299)
            if (!response.ok) {
                // If not, throw an error to be caught by the .catch block
                throw new Error(`Network response was not ok, status: ${response.status}`);
            }
            // If response is ok, proceed to parse it as JSON
            return response.json();
        })
        .then(data => {
            formResponse.classList.remove('hidden', 'bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800');
            if (data.success) {
                formResponse.classList.add('bg-green-100', 'text-green-800');
                formResponse.textContent = data.message;
                form.reset();
            } else {
                formResponse.classList.add('bg-red-100', 'text-red-800');
                formResponse.textContent = 'Error: ' + data.message;
            }
        })
        .catch(error => {
            formResponse.classList.remove('hidden');
            formResponse.classList.add('bg-red-100', 'text-red-800');
            formResponse.textContent = 'An unexpected error occurred. Please check the browser console for details.';
            console.error('Fetch Error:', error);
        })
        .finally(() => {
            // Hide loading state
            buttonText.classList.remove('hidden');
            loader.classList.add('hidden');
            submitButton.disabled = false;
        });
    });
});
