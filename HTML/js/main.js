// USPS-inspired Website Main JavaScript

document.addEventListener('DOMContentLoaded', function() {
    console.log('USPS Website: Initializing components...');

    // Initialize all components
    initializeNavigation();
    initializeSearch();
    initializeAnimations();
    initializeAccessibility();
    initializePerformance();

    console.log('USPS Website: All components initialized successfully');
});

// Navigation Enhancement
function initializeNavigation() {
    console.log('Initializing navigation...');

    // Mobile menu toggle enhancement
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            // Add smooth animation
            navbarCollapse.style.transition = 'all 0.3s ease';
        });
    }

    // Simple navigation - no dropdowns needed
    console.log('Simple navigation initialized');

    // Add active state to current page
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPage || (currentPage === '' && href === 'index.html')) {
            link.classList.add('active');
        }
    });

    // Active navigation highlighting
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
}

// No dropdown functionality needed for simple navigation

// Search Functionality
function initializeSearch() {
    const searchInputs = document.querySelectorAll('input[type="text"]');
    const searchButtons = document.querySelectorAll('.btn:has(.bi-search)');
    
    // Enhanced search functionality
    searchInputs.forEach(input => {
        // Auto-complete suggestions (mock data)
        const suggestions = [
            'Track a package',
            'Buy stamps',
            'Change of address',
            'PO Box',
            'Informed delivery',
            'Calculate shipping cost',
            'Find ZIP code',
            'Schedule pickup',
            'Hold mail',
            'International shipping'
        ];
        
        input.addEventListener('input', function() {
            const value = this.value.toLowerCase();
            if (value.length > 2) {
                showSearchSuggestions(this, suggestions.filter(s => 
                    s.toLowerCase().includes(value)
                ));
            } else {
                hideSearchSuggestions(this);
            }
        });
        
        // Handle Enter key
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                performSearch(this.value);
            }
        });
    });
    
    // Search button functionality
    searchButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input') || 
                          this.closest('.input-group').querySelector('input');
            if (input) {
                performSearch(input.value);
            }
        });
    });
}

function showSearchSuggestions(input, suggestions) {
    hideSearchSuggestions(input); // Remove existing suggestions
    
    if (suggestions.length === 0) return;
    
    const suggestionsList = document.createElement('div');
    suggestionsList.className = 'search-suggestions position-absolute bg-white border rounded shadow-sm w-100';
    suggestionsList.style.top = '100%';
    suggestionsList.style.left = '0';
    suggestionsList.style.zIndex = '1000';
    suggestionsList.style.maxHeight = '200px';
    suggestionsList.style.overflowY = 'auto';
    
    suggestions.slice(0, 5).forEach(suggestion => {
        const item = document.createElement('div');
        item.className = 'suggestion-item p-2 cursor-pointer';
        item.textContent = suggestion;
        item.style.cursor = 'pointer';
        
        item.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'white';
        });
        
        item.addEventListener('click', function() {
            input.value = suggestion;
            hideSearchSuggestions(input);
            performSearch(suggestion);
        });
        
        suggestionsList.appendChild(item);
    });
    
    // Position relative to input
    const inputGroup = input.closest('.input-group') || input.parentElement;
    inputGroup.style.position = 'relative';
    inputGroup.appendChild(suggestionsList);
}

function hideSearchSuggestions(input) {
    const inputGroup = input.closest('.input-group') || input.parentElement;
    const existing = inputGroup.querySelector('.search-suggestions');
    if (existing) {
        existing.remove();
    }
}

function performSearch(query) {
    if (!query.trim()) return;
    
    // Mock search functionality
    console.log('Searching for:', query);
    
    // Show loading state
    showNotification('Searching...', 'info');
    
    // Simulate API call
    setTimeout(() => {
        showNotification(`Search results for "${query}" would appear here.`, 'success');
    }, 1000);
}

// Animation and Visual Effects
function initializeAnimations() {
    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animatedElements = document.querySelectorAll(
        '.quick-tool-card, .featured-card, .update-card, .tool-link'
    );
    
    animatedElements.forEach(el => {
        observer.observe(el);
    });
    
    // Parallax effect for hero section
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            heroSection.style.transform = `translateY(${rate}px)`;
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
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
}

// Accessibility Enhancements
function initializeAccessibility() {
    // Keyboard navigation for dropdowns
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
    
    // Focus management for modals
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function() {
            const firstInput = this.querySelector('input, button, [tabindex]');
            if (firstInput) {
                firstInput.focus();
            }
        });
    });
    
    // Skip to main content functionality
    const skipLink = document.createElement('a');
    skipLink.href = '#main-content';
    skipLink.textContent = 'Skip to main content';
    skipLink.className = 'sr-only sr-only-focusable position-absolute';
    skipLink.style.top = '10px';
    skipLink.style.left = '10px';
    skipLink.style.zIndex = '9999';
    document.body.insertBefore(skipLink, document.body.firstChild);
    
    // Add main content landmark
    const mainContent = document.querySelector('.hero-section');
    if (mainContent) {
        mainContent.id = 'main-content';
        mainContent.setAttribute('role', 'main');
    }
}

// Performance Optimizations
function initializePerformance() {
    // Lazy loading for images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('loading');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => {
        img.classList.add('loading');
        imageObserver.observe(img);
    });
    
    // Debounced resize handler
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Recalculate layouts if needed
            handleResize();
        }, 250);
    });
}

function handleResize() {
    // Responsive adjustments
    if (window.innerWidth < 992) {
        // Mobile adjustments - close all dropdowns
        closeAllDropdowns();
    }
}

// Utility Functions
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Form validation helper
function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });
    
    return isValid;
}

// Export functions for external use
window.USPSApp = {
    showNotification,
    validateForm,
    performSearch
};
