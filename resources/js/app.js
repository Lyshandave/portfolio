// resources/js/app.js
import 'aos/dist/aos.css';
import AOS from 'aos';
import Lenis from 'lenis';

// Global state trackers for SPA navigation compatibility
window.testimonialAutoScrollTimer = null;
window.activeGalleryImages = [];
window.lightboxCurrentIndex = 0;

// Initialize Smooth Scroll and Bi-directional Animations globally
function initializeAnimations() {
    // 1. Initialize Lenis Smooth Scroll
    if (!window.lenisInstance) {
        window.lenisInstance = new Lenis({
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
            window.lenisInstance.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    }

    // 2. Dynamically apply AOS to ALL structural elements across all pages
    const animatedElements = document.querySelectorAll('.bento-card, .cert-card, .project-card, header, footer, section, main > div, main > a');
    animatedElements.forEach(el => {
        if (!el.hasAttribute('data-aos')) {
            el.setAttribute('data-aos', 'fade-up');
        }
        el.classList.remove('fade-in-section', 'is-visible');
    });

    // 3. Initialize/Refresh AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: false,
        mirror: true,
        offset: 50
    });

    // Force recalculate positions quickly
    setTimeout(() => {
        AOS.refresh();
    }, 50);
}

// Ensure theme toggle and other scripts run as well
function initializeOtherScripts() {
    // ----------------------------------------------------
    // 1. THEME SWITCHER (Light / Dark Mode)
    // ----------------------------------------------------
    const themeToggleBtn = document.getElementById('theme-toggle');

    if (themeToggleBtn) {
        // Prevent adding duplicate event listeners
        if (themeToggleBtn.dataset.listenerBound !== 'true') {
            themeToggleBtn.addEventListener('click', () => {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            });
            themeToggleBtn.dataset.listenerBound = 'true';
        }
    }

    // ----------------------------------------------------
    // 2. 3D INTERACTIVE PERSPECTIVE ACCESS CARD
    // ----------------------------------------------------
    const accessCard = document.getElementById('perspective-card');
    const cardGlow = document.getElementById('card-glow');

    if (accessCard) {
        accessCard.addEventListener('mousemove', (e) => {
            const rect = accessCard.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const xc = x / rect.width - 0.5;
            const ycNorm = y / rect.height - 0.5;
            const rotateX = ycNorm * -20;
            const rotateY = xc * 20;

            accessCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;

            if (cardGlow) {
                const glowX = (x / rect.width) * 100;
                const glowY = (y / rect.height) * 100;
                cardGlow.style.background = `radial-gradient(circle 120px at ${glowX}% ${glowY}%, rgba(99, 102, 241, 0.25), transparent 80%)`;
            }
        });

        accessCard.addEventListener('mouseleave', () => {
            accessCard.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
            accessCard.style.transition = 'transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)';
            if (cardGlow) {
                cardGlow.style.background = 'transparent';
                cardGlow.style.transition = 'background 0.5s ease';
            }
        });

        accessCard.addEventListener('mouseenter', () => {
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
        // Clear any running timers from previous page renders
        if (window.testimonialAutoScrollTimer) {
            clearInterval(window.testimonialAutoScrollTimer);
        }

        const slides = Array.from(testimonialTrack.children);
        let currentIndex = 0;

        // Generate indicators
        if (indicatorsContainer) {
            indicatorsContainer.innerHTML = '';
            slides.forEach((_, index) => {
                const indicator = document.createElement('button');
                indicator.className = `w-2 h-2 rounded-full transition-all duration-300 ${index === 0 ? 'bg-slate-900 dark:bg-white w-4' : 'bg-gray-300 dark:bg-gray-700'}`;
                indicator.setAttribute('aria-label', `Go to slide ${index + 1}`);
                indicator.addEventListener('click', () => {
                    goToSlide(index);
                    resetAutoScroll();
                });
                indicatorsContainer.appendChild(indicator);
            });
        }

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
            testimonialTrack.style.transform = `translateX(-${currentIndex * 100}%)`;
            updateIndicators(currentIndex);
        };

        const nextSlide = () => goToSlide(currentIndex + 1);
        const prevSlide = () => goToSlide(currentIndex - 1);

        if (nextBtn && nextBtn.dataset.listenerBound !== 'true') {
            nextBtn.addEventListener('click', () => { nextSlide(); resetAutoScroll(); });
            nextBtn.dataset.listenerBound = 'true';
        }
        if (prevBtn && prevBtn.dataset.listenerBound !== 'true') {
            prevBtn.addEventListener('click', () => { prevSlide(); resetAutoScroll(); });
            prevBtn.dataset.listenerBound = 'true';
        }

        const startAutoScroll = () => {
            window.testimonialAutoScrollTimer = setInterval(nextSlide, 6000);
        };

        const resetAutoScroll = () => {
            clearInterval(window.testimonialAutoScrollTimer);
            startAutoScroll();
        };

        startAutoScroll();

        testimonialTrack.addEventListener('mouseenter', () => clearInterval(window.testimonialAutoScrollTimer));
        testimonialTrack.addEventListener('mouseleave', startAutoScroll);
    }

    // ----------------------------------------------------
    // 4. IMAGE GALLERY CAROUSEL (Projects Showcase)
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
        
        if (gallNextBtn && gallNextBtn.dataset.listenerBound !== 'true') {
            gallNextBtn.addEventListener('click', () => updateGallery(gallIndex + 1));
            gallNextBtn.dataset.listenerBound = 'true';
        }
        
        if (gallPrevBtn && gallPrevBtn.dataset.listenerBound !== 'true') {
            gallPrevBtn.addEventListener('click', () => updateGallery(gallIndex - 1));
            gallPrevBtn.dataset.listenerBound = 'true';
        }
    }

    // ----------------------------------------------------
    // 5. EXPERIENCE TIMELINE MARKER SWITCHER
    // ----------------------------------------------------
    const experienceItems = document.querySelectorAll('.experience-item');
    experienceItems.forEach(item => {
        if (item.dataset.listenerBound !== 'true') {
            item.addEventListener('click', () => {
                experienceItems.forEach(el => {
                    const marker = el.querySelector('.timeline-marker');
                    if (marker) {
                        marker.className = 'timeline-marker absolute left-0 top-1.5 w-3 h-3 border-2 rounded-none border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900 transition-colors duration-200';
                    }
                });
                const activeMarker = item.querySelector('.timeline-marker');
                if (activeMarker) {
                    activeMarker.className = 'timeline-marker absolute left-0 top-1.5 w-3 h-3 border-2 rounded-none border-slate-900 bg-slate-900 dark:border-white dark:bg-white transition-colors duration-200';
                }
            });
            item.dataset.listenerBound = 'true';
        }
    });

    // ----------------------------------------------------
    // 6. LIGHTBOX FOR GALLERY HIGHLIGHTS
    // ----------------------------------------------------
    const galleryLightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    const lightboxCaption = document.getElementById('lightbox-caption');
    
    // Store active gallery images globally for navigation
    window.activeGalleryImages = Array.from(document.querySelectorAll('#gallery-track img'));
    
    if (galleryLightbox && window.activeGalleryImages.length > 0) {
        const openLightbox = (index) => {
            window.lightboxCurrentIndex = index;
            const img = window.activeGalleryImages[index];
            if (!img) return;

            lightboxImg.src = img.src;
            lightboxCaption.textContent = `Highlight ${index + 1} of ${window.activeGalleryImages.length}`;
            
            galleryLightbox.classList.remove('opacity-0', 'pointer-events-none');
            galleryLightbox.classList.add('opacity-100', 'pointer-events-auto');
            
            setTimeout(() => {
                lightboxImg.classList.remove('scale-95');
                lightboxImg.classList.add('scale-100');
            }, 50);
            
            document.body.style.overflow = 'hidden';
        };
        
        const closeLightbox = () => {
            lightboxImg.classList.remove('scale-100');
            lightboxImg.classList.add('scale-95');
            galleryLightbox.classList.remove('opacity-100', 'pointer-events-auto');
            galleryLightbox.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        };
        
        const nextImg = () => {
            let nextIndex = window.lightboxCurrentIndex + 1;
            if (nextIndex >= window.activeGalleryImages.length) nextIndex = 0;
            openLightbox(nextIndex);
        };
        
        const prevImg = () => {
            let prevIndex = window.lightboxCurrentIndex - 1;
            if (prevIndex < 0) prevIndex = window.activeGalleryImages.length - 1;
            openLightbox(prevIndex);
        };
        
        // Attach click event to gallery items (avoid duplicate binds by checking dataset)
        window.activeGalleryImages.forEach((img, index) => {
            const parent = img.parentElement;
            if (parent && parent.dataset.listenerBound !== 'true') {
                parent.addEventListener('click', (e) => {
                    e.preventDefault();
                    openLightbox(index);
                });
                parent.dataset.listenerBound = 'true';
            }
        });
        
        if (lightboxClose && lightboxClose.dataset.listenerBound !== 'true') {
            lightboxClose.addEventListener('click', closeLightbox);
            lightboxClose.dataset.listenerBound = 'true';
        }
        if (lightboxNext && lightboxNext.dataset.listenerBound !== 'true') {
            lightboxNext.addEventListener('click', (e) => { e.stopPropagation(); nextImg(); });
            lightboxNext.dataset.listenerBound = 'true';
        }
        if (lightboxPrev && lightboxPrev.dataset.listenerBound !== 'true') {
            lightboxPrev.addEventListener('click', (e) => { e.stopPropagation(); prevImg(); });
            lightboxPrev.dataset.listenerBound = 'true';
        }
        
        if (galleryLightbox.dataset.listenerBound !== 'true') {
            galleryLightbox.addEventListener('click', (e) => {
                if (e.target === galleryLightbox) {
                    closeLightbox();
                }
            });
            galleryLightbox.dataset.listenerBound = 'true';
        }
        
        if (!window.lightboxKeydownBound) {
            document.addEventListener('keydown', (e) => {
                if (galleryLightbox.classList.contains('opacity-100')) {
                    if (e.key === 'Escape') closeLightbox();
                    if (e.key === 'ArrowRight') nextImg();
                    if (e.key === 'ArrowLeft') prevImg();
                }
            });
            window.lightboxKeydownBound = true;
        }
    }
}

// ----------------------------------------------------
// HIGH-PERFORMANCE SPA PAGE TRANSITION & PREFETCH ENGINE
// ----------------------------------------------------
const pageCache = new Map();

// Prefetches page contents asynchronously and caches them
async function prefetchPage(url) {
    try {
        const path = new URL(url, window.location.origin).pathname;
        if (pageCache.has(path)) return pageCache.get(path);

        const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        if (!response.ok) return null;
        
        const html = await response.text();
        pageCache.set(path, html);
        return html;
    } catch (e) {
        return null;
    }
}

// Proactive Cache Priming on site boot
function primeCache() {
    const ROUTES_TO_PREFETCH = ['/', '/tech-stack', '/projects', '/certifications'];
    // Delay slightly to ensure initial paint remains completely unhindered
    setTimeout(() => {
        ROUTES_TO_PREFETCH.forEach(url => {
            if (url !== window.location.pathname) {
                prefetchPage(url);
            }
        });
    }, 400);
}

// Primary routing function to handle instant page swapping
async function navigateTo(url, pushState = true) {
    const path = new URL(url, window.location.origin).pathname;
    
    // Obtain cached HTML or trigger prefetch instantly
    let html = pageCache.get(path);
    if (!html) {
        html = await prefetchPage(url);
    }

    // Fallback to traditional redirect if fetch fails
    if (!html) {
        window.location.href = url;
        return;
    }

    const appContainer = document.getElementById('app-container');
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');
    const newContainer = doc.getElementById('app-container');
    const newTitle = doc.querySelector('title')?.textContent;

    if (appContainer && newContainer) {
        // Prepare snap styling (fast 120ms fade-in transition)
        appContainer.style.opacity = '0.7';
        appContainer.style.transform = 'translateY(4px)';
        appContainer.style.transition = 'none';

        // Swap content INSTANTLY
        appContainer.innerHTML = newContainer.innerHTML;

        // Update page title
        if (newTitle) {
            document.title = newTitle;
        }

        // Push to browser history stack if not navigation (back/forward) popstate
        if (pushState) {
            window.history.pushState({ url: path }, '', url);
        }

        // Scroll instantly to top
        window.scrollTo(0, 0);

        // Bring opacity back instantly with a super-fast 120ms animation
        requestAnimationFrame(() => {
            appContainer.style.transition = 'opacity 0.12s cubic-bezier(0.16, 1, 0.3, 1), transform 0.12s cubic-bezier(0.16, 1, 0.3, 1)';
            appContainer.style.opacity = '1';
            appContainer.style.transform = 'translateY(0)';
        });

        // Re-initialize all dynamic libraries and UI elements
        initializeAnimations();
        initializeOtherScripts();
    } else {
        window.location.href = url;
    }
}

// Intercept clicks on internal links for zero-latency SPA loading
function initializePageRouter() {
    // 1. Hover prefetching (starts fetching target page as soon as a user hovers a link)
    document.addEventListener('mouseover', (e) => {
        const link = e.target.closest('a');
        if (!link) return;

        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) return;

        // Check if internal origin URL
        if (href.startsWith('/') || href.startsWith(window.location.origin)) {
            // Avoid prefetching graphic files directly
            if (href.includes('/certs/') || href.includes('/card/') || href.includes('.png') || href.includes('.jpg')) return;
            prefetchPage(href);
        }
    });

    // 2. Click interception
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (!link) return;

        // Skip middle click or Command/Ctrl click
        if (e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:') || link.getAttribute('target') === '_blank') return;

        // Check if internal origin
        if (href.startsWith('/') || href.startsWith(window.location.origin)) {
            if (href.includes('/certs/') || href.includes('/card/') || href.includes('.png') || href.includes('.jpg')) return;
            e.preventDefault();
            navigateTo(href);
        }
    });

    // 3. Listen to popstate (Back/Forward browser buttons)
    window.addEventListener('popstate', () => {
        navigateTo(window.location.pathname, false);
    });

    // 4. Prime the cache for all pages immediately
    primeCache();
}

// ----------------------------------------------------
// CORE APP BOOTSTRAP
// ----------------------------------------------------
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initializeAnimations();
        initializeOtherScripts();
        initializePageRouter();
    });
} else {
    initializeAnimations();
    initializeOtherScripts();
    initializePageRouter();
}
