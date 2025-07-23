        </main> <!-- End Main Content -->
    </div> <!-- End Main Flex Container -->

    <!-- Global Modal Structure for Edit/Delete confirmations -->
    <div id="modal-overlay" class="modal-overlay">
        <div id="modal-content" class="modal-content">
            <!-- Modal content will be injected here by JavaScript -->
        </div>
    </div>
    
    <footer class="text-center text-sm text-gray-500 py-4 relative z-10">
        &copy; <?php echo date('Y'); ?> SmartCareerAI. All Rights Reserved.
    </footer>

    <script src="assets/js/script.js"></script>
    <script>
        // --- Modal Control Functions ---
        const modalOverlay = document.getElementById('modal-overlay');
        const modalContent = document.getElementById('modal-content');

        function showModal(htmlContent) {
            modalContent.innerHTML = htmlContent;
            modalOverlay.classList.add('visible');
        }

        function hideModal() {
            modalOverlay.classList.remove('visible');
            modalContent.innerHTML = ''; // Clear content
        }
        
        // Close modal when clicking the overlay
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                hideModal();
            }
        });
    </script>
</body>
</html>
