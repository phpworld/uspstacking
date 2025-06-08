// Admin Panel JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize all admin components
    initSidebar();
    initAlerts();
    initDeleteConfirmation();
    initFormValidation();
    initTooltips();
    initDataTables();
    initCharts();
    
    // Sidebar functionality
    function initSidebar() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                
                // Add overlay for mobile
                if (window.innerWidth <= 768) {
                    toggleOverlay();
                }
            });
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768 && sidebar && sidebar.classList.contains('show')) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                    removeOverlay();
                }
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && sidebar) {
                sidebar.classList.remove('show');
                removeOverlay();
            }
        });
    }
    
    // Overlay for mobile sidebar
    function toggleOverlay() {
        let overlay = document.querySelector('.sidebar-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 999;
                opacity: 0;
                transition: opacity 0.3s ease;
            `;
            document.body.appendChild(overlay);
            
            // Fade in
            setTimeout(() => overlay.style.opacity = '1', 10);
            
            // Close sidebar when clicking overlay
            overlay.addEventListener('click', function() {
                document.querySelector('.sidebar').classList.remove('show');
                removeOverlay();
            });
        }
    }
    
    function removeOverlay() {
        const overlay = document.querySelector('.sidebar-overlay');
        if (overlay) {
            overlay.style.opacity = '0';
            setTimeout(() => overlay.remove(), 300);
        }
    }
    
    // Alert management
    function initAlerts() {
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(function(alert) {
                if (bootstrap.Alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            });
        }, 5000);
        
        // Add fade-in animation to alerts
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.add('fade-in');
        });
    }
    
    // Delete confirmation
    function initDeleteConfirmation() {
        document.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.btn-delete');
            if (deleteBtn) {
                e.preventDefault();
                
                const itemName = deleteBtn.getAttribute('data-item-name') || 'this item';
                const confirmMessage = `Are you sure you want to delete ${itemName}? This action cannot be undone.`;
                
                if (confirm(confirmMessage)) {
                    // Show loading state
                    const originalText = deleteBtn.innerHTML;
                    deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                    deleteBtn.disabled = true;
                    
                    // If it's a form submission
                    const form = deleteBtn.closest('form');
                    if (form) {
                        form.submit();
                    } else {
                        // If it's an AJAX call or link
                        const href = deleteBtn.getAttribute('href') || deleteBtn.getAttribute('data-url');
                        if (href) {
                            window.location.href = href;
                        }
                    }
                } else {
                    return false;
                }
            }
        });
    }
    
    // Form validation enhancement
    function initFormValidation() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            // Add loading state to submit buttons
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                    submitBtn.disabled = true;
                    
                    // Store original text for restoration if needed
                    submitBtn.setAttribute('data-original-text', originalText);
                    
                    // Re-enable after 10 seconds as fallback
                    setTimeout(() => {
                        if (submitBtn.disabled) {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }
                    }, 10000);
                }
            });
            
            // Real-time validation
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });
                
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        validateField(this);
                    }
                });
            });
        });
    }
    
    // Field validation
    function validateField(field) {
        const value = field.value.trim();
        const isRequired = field.hasAttribute('required');
        const type = field.getAttribute('type');
        const pattern = field.getAttribute('pattern');
        
        let isValid = true;
        let errorMessage = '';
        
        // Required validation
        if (isRequired && !value) {
            isValid = false;
            errorMessage = 'This field is required.';
        }
        
        // Email validation
        if (type === 'email' && value && !isValidEmail(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address.';
        }
        
        // Pattern validation
        if (pattern && value && !new RegExp(pattern).test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid format.';
        }
        
        // Password confirmation
        if (field.name === 'confirm_password') {
            const passwordField = document.querySelector('input[name="password"]');
            if (passwordField && value !== passwordField.value) {
                isValid = false;
                errorMessage = 'Passwords do not match.';
            }
        }
        
        // Update field state
        if (isValid) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
            removeFieldError(field);
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
            showFieldError(field, errorMessage);
        }
        
        return isValid;
    }
    
    // Show field error
    function showFieldError(field, message) {
        removeFieldError(field);
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        
        field.parentNode.appendChild(errorDiv);
    }
    
    // Remove field error
    function removeFieldError(field) {
        const existingError = field.parentNode.querySelector('.invalid-feedback');
        if (existingError) {
            existingError.remove();
        }
    }
    
    // Email validation helper
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Initialize tooltips
    function initTooltips() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    }
    
    // Initialize DataTables if available
    function initDataTables() {
        if (typeof DataTable !== 'undefined') {
            const tables = document.querySelectorAll('.data-table');
            tables.forEach(table => {
                new DataTable(table, {
                    pageLength: 25,
                    responsive: true,
                    order: [[0, 'desc']],
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "Next",
                            previous: "Previous"
                        }
                    }
                });
            });
        }
    }
    
    // Initialize charts if Chart.js is available
    function initCharts() {
        if (typeof Chart !== 'undefined') {
            // Dashboard charts would go here
            initDashboardCharts();
        }
    }
    
    // Dashboard charts
    function initDashboardCharts() {
        // Example chart initialization
        const chartCanvas = document.getElementById('dashboardChart');
        if (chartCanvas) {
            const ctx = chartCanvas.getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Users',
                        data: [12, 19, 3, 5, 2, 3],
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
    
    // Utility functions
    window.AdminPanel = {
        showAlert: function(message, type = 'info') {
            const alertContainer = document.querySelector('.content-wrapper');
            if (alertContainer) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'danger' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                alertContainer.insertBefore(alertDiv, alertContainer.firstChild);
                
                // Auto-hide after 5 seconds
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        const bsAlert = new bootstrap.Alert(alertDiv);
                        bsAlert.close();
                    }
                }, 5000);
            }
        },
        
        confirmAction: function(message, callback) {
            if (confirm(message)) {
                callback();
            }
        },
        
        formatNumber: function(num) {
            return new Intl.NumberFormat().format(num);
        },
        
        formatDate: function(date) {
            return new Intl.DateTimeFormat('en-GB', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }).format(new Date(date));
        }
    };
});

// Handle page visibility change
document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        // Page is hidden
        console.log('Admin panel hidden');
    } else {
        // Page is visible
        console.log('Admin panel visible');
    }
});

// Handle beforeunload for unsaved changes
window.addEventListener('beforeunload', function(e) {
    const forms = document.querySelectorAll('form');
    let hasUnsavedChanges = false;
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (input.defaultValue !== input.value) {
                hasUnsavedChanges = true;
            }
        });
    });
    
    if (hasUnsavedChanges) {
        e.preventDefault();
        e.returnValue = '';
    }
});
