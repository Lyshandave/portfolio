// resources/js/app.js
import 'aos/dist/aos.css';
import AOS from 'aos';
import Lenis from 'lenis';

// Initialize Smooth Scroll and Bi-directional Animations globally
function initializeAnimations() {
    // 1. Initialize Lenis Smooth Scroll
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1.1,
        smoothTouch: false,
        touchMultiplier: 1.5,
        infinite: false,
    });

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    // 2. Dynamically apply AOS to ALL structural elements across all pages
    const animatedElements = document.querySelectorAll('.bento-card, .cert-card, .project-card, header, footer, section, main > div, main > a');
    animatedElements.forEach(el => {
        // Only apply if it doesn't already have an AOS attribute
        if (!el.hasAttribute('data-aos')) {
            el.setAttribute('data-aos', 'fade-up');
        }
        // Remove any old static visibility classes if they exist
        el.classList.remove('fade-in-section', 'is-visible');
    });

    // 3. Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: false,
        mirror: true,
        offset: 50
    });

    // 4. Force AOS to recalculate positions after everything (fonts, images) has fully loaded.
    // This fixes issues where elements animate too early or don't trigger correctly on scroll up.
    window.addEventListener('load', () => {
        AOS.refresh();
    });
}

// Run immediately if DOM is ready, otherwise wait
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeAnimations);
} else {
    initializeAnimations();
}

// Ensure theme toggle and other scripts run as well
function initializeOtherScripts() {
    // ----------------------------------------------------
    // 1. THEME SWITCHER (Light / Dark Mode)
    // ----------------------------------------------------
    const themeToggleBtn = document.getElementById('theme-toggle');

    // Determine initial theme
    if (localStorage.getItem('color-theme') === 'dark' || 
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            // Toggle theme
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    }

    // ----------------------------------------------------
    // 2. 3D INTERACTIVE PERSPECTIVE ACCESS CARD
    // ----------------------------------------------------
    const accessCard = document.getElementById('perspective-card');
    const cardGlow = document.getElementById('card-glow');

    if (accessCard) {
        accessCard.addEventListener('mousemove', (e) => {
            const rect = accessCard.getBoundingClientRect();
            
            // Mouse position relative to the card
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            // Calculate normalized values (-0.5 to 0.5)
            const xc = x / rect.width - 0.5;
            const ycNorm = y / rect.height - 0.5;

            // Rotation angles (max 15 degrees)
            const rotateX = ycNorm * -20;
            const rotateY = xc * 20;

            // Apply style transforms with a subtle 3D lift
            accessCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;

            // Update card spotlight reflection
            if (cardGlow) {
                const glowX = (x / rect.width) * 100;
                const glowY = (y / rect.height) * 100;
                cardGlow.style.background = `radial-gradient(circle 120px at ${glowX}% ${glowY}%, rgba(99, 102, 241, 0.25), transparent 80%)`;
            }
        });

        accessCard.addEventListener('mouseleave', () => {
            // Smoothly restore card styles
            accessCard.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
            accessCard.style.transition = 'transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)';
            if (cardGlow) {
                cardGlow.style.background = 'transparent';
                cardGlow.style.transition = 'background 0.5s ease';
            }
        });

        accessCard.addEventListener('mouseenter', () => {
            // Remove transition for highly responsive tracking
            accessCard.style.transition = 'none';
            if (cardGlow) {
                cardGlow.style.transition = 'none';
            }
        });
    }

    // ----------------------------------------------------
    // 3. AUTO-SCROLLING TESTIMONIALS SLIDER
    // ----------------------------------------------------
    const testimonialTrack = document.getElementById('testimonials-track');
    const prevBtn = document.getElementById('testimonial-prev');
    const nextBtn = document.getElementById('testimonial-next');
    const indicatorsContainer = document.getElementById('testimonial-indicators');

    if (testimonialTrack) {
        const slides = Array.from(testimonialTrack.children);
        let currentIndex = 0;
        let autoScrollTimer = null;

        // Generate indicators
        slides.forEach((_, index) => {
            const indicator = document.createElement('button');
            indicator.className = `w-2 h-2 rounded-full transition-all duration-300 ${index === 0 ? 'bg-slate-900 dark:bg-white w-4' : 'bg-gray-300 dark:bg-gray-700'}`;
            indicator.setAttribute('aria-label', `Go to slide ${index + 1}`);
            indicator.addEventListener('click', () => {
                goToSlide(index);
                resetAutoScroll();
            });
            if (indicatorsContainer) indicatorsContainer.appendChild(indicator);
        });

        const updateIndicators = (activeIndex) => {
            if (!indicatorsContainer) return;
            const indicators = Array.from(indicatorsContainer.children);
            indicators.forEach((indicator, index) => {
                if (index === activeIndex) {
                    indicator.className = 'w-2 h-2 rounded-full transition-all duration-300 bg-slate-900 dark:bg-white w-4';
                } else {
                    indicator.className = 'w-2 h-2 rounded-full transition-all duration-300 bg-gray-300 dark:bg-gray-700';
                }
            });
        };

        const goToSlide = (index) => {
            if (index < 0) {
                currentIndex = slides.length - 1;
            } else if (index >= slides.length) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }
            
            // Translate slide track
            testimonialTrack.style.transform = `translateX(-${currentIndex * 100}%)`;
            updateIndicators(currentIndex);
        };

        const nextSlide = () => goToSlide(currentIndex + 1);
        const prevSlide = () => goToSlide(currentIndex - 1);

        if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); resetAutoScroll(); });
        if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); resetAutoScroll(); });

        // Auto-play setup
        const startAutoScroll = () => {
            autoScrollTimer = setInterval(nextSlide, 6000); // 6s duration
        };

        const resetAutoScroll = () => {
            clearInterval(autoScrollTimer);
            startAutoScroll();
        };

        startAutoScroll();

        // Pause on Hover
        testimonialTrack.addEventListener('mouseenter', () => clearInterval(autoScrollTimer));
        testimonialTrack.addEventListener('mouseleave', startAutoScroll);
    }

    // ----------------------------------------------------
    // 4. IMAGE GALLERY CAROUSEL (Projects Showcase / Bento Slider)
    // ----------------------------------------------------
    const galleryTrack = document.getElementById('gallery-track');
    const gallPrevBtn = document.getElementById('gallery-prev');
    const gallNextBtn = document.getElementById('gallery-next');
    
    if (galleryTrack) {
        let gallIndex = 0;
        const totalItems = galleryTrack.children.length;
        
        const updateGallery = (index) => {
            if (index < 0) {
                gallIndex = totalItems - 1;
            } else if (index >= totalItems) {
                gallIndex = 0;
            } else {
                gallIndex = index;
            }
            
            galleryTrack.style.transform = `translateX(-${gallIndex * 100}%)`;
        };
        
        if (gallNextBtn) gallNextBtn.addEventListener('click', () => {
            updateGallery(gallIndex + 1);
        });
        
        if (gallPrevBtn) gallPrevBtn.addEventListener('click', () => {
            updateGallery(gallIndex - 1);
        });
    }

    // ----------------------------------------------------
    // 5. COMPLEMENTARY EFFECT: SMOOTH FADE-IN SCROLL OBSERVER
    // ----------------------------------------------------
    const faders = document.querySelectorAll('.fade-in-section');
    const appearOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const appearOnScroll = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, appearOptions);

    faders.forEach(fader => appearOnScroll.observe(fader));
    // ----------------------------------------------------
    // 6. DYNAMIC EXPERIENCE TIMELINE MARKER SWITCHER
    // ----------------------------------------------------
    const experienceItems = document.querySelectorAll('.experience-item');
    experienceItems.forEach(item => {
        item.addEventListener('click', () => {
            experienceItems.forEach(el => {
                const marker = el.querySelector('.timeline-marker');
                if (marker) {
                    // Set all to inactive style
                    marker.className = 'timeline-marker absolute left-0 top-1.5 w-3 h-3 border-2 rounded-none border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900 transition-colors duration-200';
                }
            });
            // Set the clicked one to active solid style
            const activeMarker = item.querySelector('.timeline-marker');
            if (activeMarker) {
                activeMarker.className = 'timeline-marker absolute left-0 top-1.5 w-3 h-3 border-2 rounded-none border-slate-900 bg-slate-900 dark:border-white dark:bg-white transition-colors duration-200';
            }
        });
    });

    // ----------------------------------------------------
    // 7. LIGHTBOX FOR GALLERY HIGHLIGHTS
    // ----------------------------------------------------
    const galleryLightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const galleryImages = document.querySelectorAll('#gallery-track img');
    
    if (galleryLightbox && galleryImages.length > 0) {
        let currentImgIndex = 0;
        
        const openLightbox = (index) => {
            currentImgIndex = index;
            const img = galleryImages[index];
            lightboxImg.src = img.src;
            lightboxCaption.textContent = `Highlight ${index + 1} of ${galleryImages.length}`;
            
            galleryLightbox.classList.remove('opacity-0', 'pointer-events-none');
            galleryLightbox.classList.add('opacity-100', 'pointer-events-auto');
            
            // Trigger scale animation
            setTimeout(() => {
                lightboxImg.classList.remove('scale-95');
                lightboxImg.classList.add('scale-100');
            }, 50);
            
            document.body.style.overflow = 'hidden'; // Disable page scrolling
        };
        
        const closeLightbox = () => {
            lightboxImg.classList.remove('scale-100');
            lightboxImg.classList.add('scale-95');
            
            galleryLightbox.classList.remove('opacity-100', 'pointer-events-auto');
            galleryLightbox.classList.add('opacity-0', 'pointer-events-none');
            
            document.body.style.overflow = ''; // Re-enable page scrolling
        };
        
        const nextImg = () => {
            let nextIndex = currentImgIndex + 1;
            if (nextIndex >= galleryImages.length) nextIndex = 0;
            openLightbox(nextIndex);
        };
        
        const prevImg = () => {
            let prevIndex = currentImgIndex - 1;
            if (prevIndex < 0) prevIndex = galleryImages.length - 1;
            openLightbox(prevIndex);
        };
        
        // Attach click event to gallery items
        galleryImages.forEach((img, index) => {
            img.parentElement.addEventListener('click', (e) => {
                e.preventDefault();
                openLightbox(index);
            });
        });
        
        if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
        if (lightboxNext) lightboxNext.addEventListener('click', (e) => { e.stopPropagation(); nextImg(); });
        if (lightboxPrev) lightboxPrev.addEventListener('click', (e) => { e.stopPropagation(); prevImg(); });
        
        // Close on background click
        galleryLightbox.addEventListener('click', (e) => {
            if (e.target === galleryLightbox) {
                closeLightbox();
            }
        });
        
        // Key navigation
        document.addEventListener('keydown', (e) => {
            if (galleryLightbox.classList.contains('opacity-100')) {
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowRight') nextImg();
                if (e.key === 'ArrowLeft') prevImg();
            }
        });
    }
}

// Run other scripts immediately if DOM is ready, otherwise wait
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeOtherScripts);
} else {
    initializeOtherScripts();
}

