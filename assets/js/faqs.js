// /assets/js/faqs.js
document.addEventListener('DOMContentLoaded', () => {
    // MODIFIED: Target the new unique ID for the FAQ container
    const accordion = document.getElementById('faqs-page-accordion');
    if (!accordion) {
        // If the container isn't found, do nothing.
        return;
    }

    const faqItems = accordion.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        
        // Ensure all required elements exist before adding a listener
        if (!question || !answer) {
            return;
        }

        question.addEventListener('click', () => {
            const icon = question.querySelector('i');
            const isOpen = item.classList.contains('open');

            // First, close all other items to create the accordion effect
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('open');
                    otherItem.querySelector('.faq-answer').style.maxHeight = null;
                    const otherIcon = otherItem.querySelector('i');
                    if (otherIcon) {
                        otherIcon.classList.remove('rotate-180');
                    }
                }
            });

            // Then, toggle the clicked item
            if (isOpen) {
                // It was open, so close it
                item.classList.remove('open');
                answer.style.maxHeight = null;
                if (icon) {
                    icon.classList.remove('rotate-180');
                }
            } else {
                // It was closed, so open it
                item.classList.add('open');
                // Set max-height to the element's actual scroll height to animate it open
                answer.style.maxHeight = answer.scrollHeight + 'px';
                 if (icon) {
                    icon.classList.add('rotate-180');
                }
            }
        });
    });
});
