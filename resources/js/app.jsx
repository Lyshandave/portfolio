import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';
import '../css/app.css';
import 'aos/dist/aos.css';
import AOS from 'aos';
import Lenis from 'lenis';

// Initialize global animations
function initializeGlobalAnimations() {
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

    const animatedElements = document.querySelectorAll('.bento-card, .cert-card, .project-card, header, footer, section, main > div, main > a');
    animatedElements.forEach(el => {
        if (!el.hasAttribute('data-aos')) {
            el.setAttribute('data-aos', 'fade-up');
        }
    });

    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: false,
        mirror: true,
        offset: 50
    });

    setTimeout(() => {
        AOS.refresh();
    }, 50);
}

window.initializeGlobalAnimations = initializeGlobalAnimations;

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true });
        return pages[`./Pages/${name}.jsx`];
    },
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);

        requestAnimationFrame(() => {
            initializeGlobalAnimations();
        });
    },
    progress: false,
});

