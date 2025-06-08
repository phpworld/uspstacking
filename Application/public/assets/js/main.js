// Royal Mail Website Clone - Main JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize Bootstrap popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Item selector dropdown functionality
    const itemOptions = document.querySelectorAll('.item-option');
    const selectedItemSpan = document.querySelector('.selected-item');
    const selectedPriceSpan = document.querySelector('.selected-price');
    const itemDropdownBtn = document.querySelector('.item-dropdown-btn');

    if (itemOptions.length > 0 && selectedItemSpan && selectedPriceSpan && itemDropdownBtn) {
        itemOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();

                const itemText = this.getAttribute('data-item');
                const priceText = this.getAttribute('data-price');

                // Remove active class from all options
                itemOptions.forEach(opt => opt.classList.remove('active'));

                // Add active class to selected option
                this.classList.add('active');

                // Update the dropdown button text
                if (selectedItemSpan) {
                    selectedItemSpan.textContent = itemText;
                }
                if (selectedPriceSpan) {
                    selectedPriceSpan.textContent = priceText;
                }

                // Update button styling to show selection
                itemDropdownBtn.classList.remove('btn-outline-secondary');
                itemDropdownBtn.classList.add('btn-outline-success');
                itemDropdownBtn.style.borderColor = '#28a745';
                itemDropdownBtn.style.color = '#28a745';

                // Close the dropdown
                const dropdownElement = document.getElementById('itemDropdown');
                if (dropdownElement) {
                    const dropdown = bootstrap.Dropdown.getInstance(dropdownElement);
                    if (dropdown) {
                        dropdown.hide();
                    }
                }

                console.log('Selected item:', itemText, priceText);
            });
        });
    }

    // Tracking form validation (only client-side validation, allow form submission)
    const trackingForm = document.querySelector('#track form');
    if (trackingForm) {
        trackingForm.addEventListener('submit', function(e) {
            const trackingNumber = document.querySelector('#trackingNumber').value.trim();

            if (!trackingNumber) {
                e.preventDefault();
                alert('Please enter a tracking number');
                return;
            }

            // Validate tracking number format
            if (!/^[A-Za-z0-9]{10,20}$/.test(trackingNumber)) {
                e.preventDefault();
                alert('Please enter a valid tracking number (10-20 characters, letters and numbers only)');
                return;
            }

            // Allow form to submit normally to the server
            console.log('Submitting tracking number:', trackingNumber);
        });
    }

    // Mobile menu enhancements
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            // Add animation class
            navbarCollapse.classList.toggle('show');
        });
    }

    // Dropdown hover effect for desktop
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
        
        if (window.innerWidth > 992) { // Only for desktop
            dropdown.addEventListener('mouseenter', function() {
                dropdownToggle.classList.add('show');
                dropdownMenu.classList.add('show');
            });
            
            dropdown.addEventListener('mouseleave', function() {
                dropdownToggle.classList.remove('show');
                dropdownMenu.classList.remove('show');
            });
        }
    });

    // Search functionality (placeholder - can be implemented later)
    const searchInputs = document.querySelectorAll('input[type="search"], .search-section input');
    searchInputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value.trim();
                if (searchTerm) {
                    // Log search term for now - can be implemented later
                    console.log('Search term:', searchTerm);
                    // Don't prevent default - allow normal form submission if needed
                }
            }
        });
    });

    // Card hover animations
    const cards = document.querySelectorAll('.quick-link-card, .service-card, .help-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Lazy loading for images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));

    // Form validation helpers
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validatePostcode(postcode) {
        const re = /^[A-Z]{1,2}[0-9]{1,2}[A-Z]?\s?[0-9][A-Z]{2}$/i;
        return re.test(postcode);
    }

    // Accessibility improvements
    document.addEventListener('keydown', function(e) {
        // ESC key closes dropdowns
        if (e.key === 'Escape') {
            const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
            openDropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
                const toggle = dropdown.previousElementSibling;
                if (toggle) {
                    toggle.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });

    // Tab navigation with keyboard
    const tabs = document.querySelectorAll('[role="tab"]');
    tabs.forEach(tab => {
        tab.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
                e.preventDefault();
                const tabList = Array.from(this.parentElement.parentElement.querySelectorAll('[role="tab"]'));
                const currentIndex = tabList.indexOf(this);
                let nextIndex;
                
                if (e.key === 'ArrowRight') {
                    nextIndex = currentIndex + 1 >= tabList.length ? 0 : currentIndex + 1;
                } else {
                    nextIndex = currentIndex - 1 < 0 ? tabList.length - 1 : currentIndex - 1;
                }
                
                tabList[nextIndex].focus();
                tabList[nextIndex].click();
            }
        });
    });

    // Performance monitoring
    if ('performance' in window) {
        window.addEventListener('load', function() {
            setTimeout(function() {
                const perfData = performance.getEntriesByType('navigation')[0];
                console.log('Page load time:', perfData.loadEventEnd - perfData.loadEventStart, 'ms');
            }, 0);
        });
    }

    // Cookie consent (placeholder)
    function showCookieConsent() {
        // This would show a cookie consent banner
        console.log('Cookie consent would be shown here');
    }

    // Check if user has already consented to cookies
    if (!localStorage.getItem('cookieConsent')) {
        setTimeout(showCookieConsent, 2000);
    }

    // Analytics tracking (placeholder)
    function trackEvent(category, action, label) {
        // This would send analytics data
        console.log('Analytics event:', category, action, label);
    }

    // Track button clicks
    document.querySelectorAll('button, .btn').forEach(button => {
        button.addEventListener('click', function() {
            const buttonText = this.textContent.trim();
            trackEvent('Button', 'Click', buttonText);
        });
    });

    console.log('Royal Mail website clone initialized successfully');
});

// Global function for tracking items
function trackItem() {
    const trackingInput = document.getElementById('trackingNumber');
    if (trackingInput) {
        const trackingNumber = trackingInput.value.trim();
        if (trackingNumber) {
            // Validate tracking number format
            if (!/^[A-Za-z0-9]{10,20}$/.test(trackingNumber)) {
                alert('Please enter a valid tracking number (10-20 characters, letters and numbers only)');
                trackingInput.focus();
                return;
            }
            // Redirect to CodeIgniter tracking route
            window.location.href = `/track/${encodeURIComponent(trackingNumber)}`;
        } else {
            alert('Please enter a tracking number');
            trackingInput.focus();
        }
    }
}
