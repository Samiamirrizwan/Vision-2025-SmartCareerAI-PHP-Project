document.addEventListener('DOMContentLoaded', () => {

    // --- Filter functionality ---
    const filterType = document.getElementById('filter-type');
    const filterLocation = document.getElementById('filter-location');
    const jobCards = document.querySelectorAll('.job-card');
    const noResultsMessage = document.getElementById('no-results-message');

    function applyFilters() {
        const selectedType = filterType.value;
        const selectedLocation = filterLocation.value;
        let visibleCount = 0;

        jobCards.forEach(card => {
            const cardType = card.dataset.jobType;
            const cardLocation = card.dataset.jobLocation;

            const typeMatch = (selectedType === 'all') || (selectedType === 'Remote' && cardType === 'Remote') || (selectedType !== 'Remote' && cardType === selectedType);
            const locationMatch = (selectedLocation === 'all') || (selectedLocation === 'Remote' && cardLocation === 'Remote') || cardLocation === selectedLocation;
            
            // Special handling for Remote which can be both a type and a location
            let isVisible = false;
            if (selectedType === 'Remote' && selectedLocation === 'all') {
                 isVisible = cardType === 'Remote';
            } else if (selectedLocation === 'Remote' && selectedType === 'all') {
                 isVisible = cardLocation === 'Remote';
            } else {
                 isVisible = typeMatch && locationMatch;
            }


            if (isVisible) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Show or hide the 'no results' message
        noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    if (filterType && filterLocation) {
        filterType.addEventListener('change', applyFilters);
        filterLocation.addEventListener('change', applyFilters);
    }

    // --- Modal functionality ---
    const modal = document.getElementById('job-details-modal');
    const modalBody = document.getElementById('job-modal-body');
    const jobListingContainer = document.getElementById('job-listing-container');
    
    if (modal && jobListingContainer) {
        const closeModalBtn = modal.querySelector('.close-modal-btn');

        // Use event delegation for dynamically added/filtered elements
        jobListingContainer.addEventListener('click', (e) => {
            const detailsButton = e.target.closest('.details-btn');
            if (detailsButton) {
                const card = detailsButton.closest('.job-card');
                
                // Extract data from the card
                const title = card.querySelector('.job-title').textContent;
                const company = card.querySelector('.job-company').textContent;
                const location = card.querySelector('.job-location').innerHTML; // Keep icon
                const type = card.querySelector('.job-type-tag').textContent;
                const description = card.querySelector('.job-description').textContent;
                const tags = Array.from(card.querySelectorAll('.job-tags .tag')).map(tag => tag.outerHTML).join('');

                // Populate and show the modal
                modalBody.innerHTML = `
                    <h3>${title}</h3>
                    <p class="modal-company">${company}</p>
                    <div class="modal-job-details">
                        <span>${location}</span>
                        <span class="job-type-tag">${type}</span>
                    </div>
                    <h4>Job Description</h4>
                    <p>${description.replace(/\n/g, '<br>')}</p>
                    <h4>Required Skills</h4>
                    <div class="job-tags">${tags}</div>
                    <div class="modal-actions">
                        <a href="#" class="apply-btn">Apply Now</a>
                    </div>
                `;
                modal.style.display = 'block';
            }

            // Handle save job button clicks
            const saveButton = e.target.closest('.save-job-btn');
            if (saveButton) {
                saveButton.classList.toggle('saved');
                if (saveButton.classList.contains('saved')) {
                    saveButton.innerHTML = '<i class="fas fa-bookmark"></i> Saved';
                } else {
                    saveButton.innerHTML = '<i class="far fa-bookmark"></i> Save Job';
                }
            }
        });

        // Close modal actions
        closeModalBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    }
});
