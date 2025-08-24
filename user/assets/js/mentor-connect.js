document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.animated-card');

    cards.forEach(card => {
        const maxRotation = 10; // Max rotation in degrees

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left; // Mouse X position relative to the element.
            const y = e.clientY - rect.top;  // Mouse Y position relative to the element.
            
            const { width, height } = rect;

            // Calculate rotation values from -maxRotation to +maxRotation
            const rotateY = maxRotation * ((x - width / 2) / (width / 2));
            const rotateX = -maxRotation * ((y - height / 2) / (height / 2));

            // Apply the 3D transformation
            card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        card.addEventListener('mouseenter', () => {
            // Set a smooth transition when the mouse enters
            card.style.transition = 'transform 0.1s ease-out';
        });

        card.addEventListener('mouseleave', () => {
            // Reset the card to its original state with a smooth transition
            card.style.transition = 'transform 0.5s ease-in-out';
            card.style.transform = 'rotateX(0deg) rotateY(0deg)';
        });
    });
});
