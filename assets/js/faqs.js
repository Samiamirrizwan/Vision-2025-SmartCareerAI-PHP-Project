// /assets/js/faqs.js
document.addEventListener('DOMContentLoaded', () => {
    const accordion = document.getElementById('faq-accordion');
    if (!accordion) return;

    const faqItems = accordion.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = question.querySelector('i');

        question.addEventListener('click', () => {
            const isOpen = item.classList.contains('open');

            // Close all other items
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('open');
                otherItem.querySelector('.faq-answer').style.maxHeight = '0px';
                otherItem.querySelector('i').classList.remove('rotate-180');
            });

            // Open the clicked item if it was closed
            if (!isOpen) {
                item.classList.add('open');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                icon.classList.add('rotate-180');
            }
        });
    });
});