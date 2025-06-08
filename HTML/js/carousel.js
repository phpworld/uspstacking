// Enhanced Carousel Functionality for USPS Website

document.addEventListener('DOMContentLoaded', function() {
    initializeCarousel();
    initializeCarouselEnhancements();
});

function initializeCarousel() {
    const carousel = document.querySelector('#productCarousel');
    if (!carousel) return;
    
    // Initialize Bootstrap carousel with custom options
    const bsCarousel = new bootstrap.Carousel(carousel, {
        interval: 5000, // 5 seconds
        wrap: true,
        touch: true,
        pause: 'hover'
    });
    
    // Store reference for external access
    carousel.bsCarousel = bsCarousel;
    
    // Add custom event listeners
    carousel.addEventListener('slide.bs.carousel', function(e) {
        handleSlideTransition(e);
    });
    
    carousel.addEventListener('slid.bs.carousel', function(e) {
        handleSlideComplete(e);
    });
}

function initializeCarouselEnhancements() {
    const carousel = document.querySelector('#productCarousel');
    if (!carousel) return;
    
    // Add keyboard navigation
    addKeyboardNavigation(carousel);
    
    // Add touch/swipe support enhancement
    addTouchSupport(carousel);
    
    // Add progress indicator
    addProgressIndicator(carousel);
    
    // Add auto-pause on focus
    addFocusManagement(carousel);
    
    // Add thumbnail navigation (if needed)
    // addThumbnailNavigation(carousel);
}

function addKeyboardNavigation(carousel) {
    carousel.addEventListener('keydown', function(e) {
        switch(e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                carousel.bsCarousel.prev();
                break;
            case 'ArrowRight':
                e.preventDefault();
                carousel.bsCarousel.next();
                break;
            case ' ':
            case 'Enter':
                e.preventDefault();
                toggleCarouselPlayback(carousel);
                break;
            case 'Home':
                e.preventDefault();
                goToSlide(carousel, 0);
                break;
            case 'End':
                e.preventDefault();
                const totalSlides = carousel.querySelectorAll('.carousel-item').length;
                goToSlide(carousel, totalSlides - 1);
                break;
        }
    });
    
    // Make carousel focusable
    carousel.setAttribute('tabindex', '0');
    carousel.setAttribute('role', 'region');
    carousel.setAttribute('aria-label', 'Product showcase carousel');
}

function addTouchSupport(carousel) {
    let startX = 0;
    let endX = 0;
    let startY = 0;
    let endY = 0;
    
    carousel.addEventListener('touchstart', function(e) {
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
    }, { passive: true });
    
    carousel.addEventListener('touchmove', function(e) {
        // Prevent default scrolling if horizontal swipe is detected
        const deltaX = Math.abs(e.touches[0].clientX - startX);
        const deltaY = Math.abs(e.touches[0].clientY - startY);
        
        if (deltaX > deltaY) {
            e.preventDefault();
        }
    }, { passive: false });
    
    carousel.addEventListener('touchend', function(e) {
        endX = e.changedTouches[0].clientX;
        endY = e.changedTouches[0].clientY;
        
        const deltaX = endX - startX;
        const deltaY = endY - startY;
        const minSwipeDistance = 50;
        
        // Only trigger if horizontal swipe is greater than vertical
        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > minSwipeDistance) {
            if (deltaX > 0) {
                carousel.bsCarousel.prev();
            } else {
                carousel.bsCarousel.next();
            }
        }
    }, { passive: true });
}

function addProgressIndicator(carousel) {
    const indicators = carousel.querySelector('.carousel-indicators');
    if (!indicators) return;
    
    // Create progress bar
    const progressBar = document.createElement('div');
    progressBar.className = 'carousel-progress position-absolute w-100';
    progressBar.style.bottom = '0';
    progressBar.style.height = '4px';
    progressBar.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
    progressBar.style.zIndex = '10';
    
    const progressFill = document.createElement('div');
    progressFill.className = 'carousel-progress-fill h-100 bg-primary';
    progressFill.style.width = '0%';
    progressFill.style.transition = 'width 0.3s ease';
    
    progressBar.appendChild(progressFill);
    carousel.appendChild(progressBar);
    
    // Update progress on slide change
    carousel.addEventListener('slid.bs.carousel', function(e) {
        const totalSlides = carousel.querySelectorAll('.carousel-item').length;
        const currentSlide = e.to;
        const progress = ((currentSlide + 1) / totalSlides) * 100;
        progressFill.style.width = progress + '%';
    });
    
    // Initialize progress
    const totalSlides = carousel.querySelectorAll('.carousel-item').length;
    progressFill.style.width = (1 / totalSlides) * 100 + '%';
}

function addFocusManagement(carousel) {
    const carouselItems = carousel.querySelectorAll('.carousel-item');
    
    // Pause carousel when any interactive element receives focus
    carouselItems.forEach(item => {
        const interactiveElements = item.querySelectorAll('a, button, input, select, textarea, [tabindex]');
        
        interactiveElements.forEach(element => {
            element.addEventListener('focus', function() {
                carousel.bsCarousel.pause();
            });
            
            element.addEventListener('blur', function() {
                // Resume after a delay to allow for tab navigation
                setTimeout(() => {
                    if (!carousel.querySelector(':focus')) {
                        carousel.bsCarousel.cycle();
                    }
                }, 100);
            });
        });
    });
    
    // Add play/pause button
    const controlsContainer = document.createElement('div');
    controlsContainer.className = 'carousel-controls position-absolute';
    controlsContainer.style.top = '10px';
    controlsContainer.style.right = '10px';
    controlsContainer.style.zIndex = '10';
    
    const playPauseBtn = document.createElement('button');
    playPauseBtn.className = 'btn btn-sm btn-outline-light';
    playPauseBtn.innerHTML = '<i class="bi bi-pause-fill"></i>';
    playPauseBtn.setAttribute('aria-label', 'Pause carousel');
    playPauseBtn.setAttribute('title', 'Pause carousel');
    
    let isPlaying = true;
    playPauseBtn.addEventListener('click', function() {
        toggleCarouselPlayback(carousel);
        isPlaying = !isPlaying;
        this.innerHTML = isPlaying ? '<i class="bi bi-pause-fill"></i>' : '<i class="bi bi-play-fill"></i>';
        this.setAttribute('aria-label', isPlaying ? 'Pause carousel' : 'Play carousel');
        this.setAttribute('title', isPlaying ? 'Pause carousel' : 'Play carousel');
    });
    
    controlsContainer.appendChild(playPauseBtn);
    carousel.appendChild(controlsContainer);
}

function handleSlideTransition(e) {
    // Add loading animation to incoming slide
    const nextSlide = e.relatedTarget;
    if (nextSlide) {
        nextSlide.classList.add('slide-entering');
    }
    
    // Announce slide change to screen readers
    const slideNumber = e.to + 1;
    const totalSlides = e.target.querySelectorAll('.carousel-item').length;
    announceToScreenReader(`Slide ${slideNumber} of ${totalSlides}`);
}

function handleSlideComplete(e) {
    // Remove loading animation
    const currentSlide = e.target.querySelector('.carousel-item.active');
    if (currentSlide) {
        currentSlide.classList.remove('slide-entering');
    }
    
    // Update indicators accessibility
    updateIndicatorsAccessibility(e.target, e.to);
}

function toggleCarouselPlayback(carousel) {
    const isPlaying = carousel.getAttribute('data-playing') !== 'false';
    
    if (isPlaying) {
        carousel.bsCarousel.pause();
        carousel.setAttribute('data-playing', 'false');
    } else {
        carousel.bsCarousel.cycle();
        carousel.setAttribute('data-playing', 'true');
    }
}

function goToSlide(carousel, slideIndex) {
    carousel.bsCarousel.to(slideIndex);
}

function updateIndicatorsAccessibility(carousel, activeIndex) {
    const indicators = carousel.querySelectorAll('.carousel-indicators button');
    
    indicators.forEach((indicator, index) => {
        if (index === activeIndex) {
            indicator.setAttribute('aria-current', 'true');
            indicator.setAttribute('aria-label', `Slide ${index + 1} (current)`);
        } else {
            indicator.removeAttribute('aria-current');
            indicator.setAttribute('aria-label', `Go to slide ${index + 1}`);
        }
    });
}

function announceToScreenReader(message) {
    const announcement = document.createElement('div');
    announcement.setAttribute('aria-live', 'polite');
    announcement.setAttribute('aria-atomic', 'true');
    announcement.className = 'sr-only';
    announcement.textContent = message;
    
    document.body.appendChild(announcement);
    
    // Remove after announcement
    setTimeout(() => {
        document.body.removeChild(announcement);
    }, 1000);
}

// Auto-height adjustment for responsive design
function adjustCarouselHeight() {
    const carousel = document.querySelector('#productCarousel');
    if (!carousel) return;
    
    const activeItem = carousel.querySelector('.carousel-item.active');
    if (activeItem) {
        const height = activeItem.scrollHeight;
        carousel.style.height = height + 'px';
    }
}

// Initialize auto-height on window resize
window.addEventListener('resize', function() {
    setTimeout(adjustCarouselHeight, 100);
});

// Preload next/previous images for smoother transitions
function preloadCarouselImages() {
    const carousel = document.querySelector('#productCarousel');
    if (!carousel) return;
    
    const images = carousel.querySelectorAll('img[data-src]');
    images.forEach(img => {
        const preloadImg = new Image();
        preloadImg.src = img.dataset.src;
    });
}

// Initialize preloading
document.addEventListener('DOMContentLoaded', preloadCarouselImages);

// Export functions for external use
window.CarouselController = {
    togglePlayback: toggleCarouselPlayback,
    goToSlide: goToSlide,
    adjustHeight: adjustCarouselHeight
};
