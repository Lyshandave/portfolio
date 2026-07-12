import { createInertiaApp, router } from '@inertiajs/react';
import { createElement } from 'react';
import { createRoot } from 'react-dom/client';
import '../css/app.css';
import 'aos/dist/aos.css';
import AOS from 'aos';
import Lenis from 'lenis';
import Certifications from './Pages/Certifications.jsx';
import ErrorPage from './Pages/Error.jsx';
import Portfolio from './Pages/Portfolio.jsx';
import Projects from './Pages/Projects.jsx';
import TechStack from './Pages/TechStack.jsx';
import CaseStudy from './Pages/CaseStudy.jsx';

// Initialize global animations
function initializeGlobalAnimations() {
    if (!window.lenisInstance) {
        window.lenisInstance = new Lenis({
            duration: 0.75,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
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

    const animatedElements = document.querySelectorAll('.bento-card, .case-study-card, .cert-card, .project-card, [data-global-animate]');
    animatedElements.forEach(el => {
        if (!el.hasAttribute('data-aos')) {
            el.setAttribute('data-aos', 'fade-up');
        }
    });

    const refreshAnimations = () => {
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                AOS.refreshHard();
            });
        });
    };

    if (!window.aosInitialized) {
        AOS.init({
            duration: 280,
            easing: 'ease-out-cubic',
            once: false,
            mirror: false,
            offset: 30,
            anchorPlacement: 'top-bottom',
            throttleDelay: 60,
            debounceDelay: 50,
        });
        window.aosInitialized = true;
        refreshAnimations();
        return;
    }

    refreshAnimations();
}

window.initializeGlobalAnimations = initializeGlobalAnimations;

function scrollToPageTop() {
    if (window.lenisInstance) {
        window.lenisInstance.scrollTo(0, { immediate: true });
    }

    window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'auto',
    });
}

router.on('navigate', () => {
    requestAnimationFrame(() => {
        scrollToPageTop();
        if (window.initializeGlobalAnimations) {
            window.initializeGlobalAnimations();
        }
    });
});

createInertiaApp({
    resolve: name => {
        switch (name) {
            case 'Certifications':
                return Certifications;
            case 'CaseStudy':
                return CaseStudy;
            case 'Error':
                return ErrorPage;
            case 'Portfolio':
                return Portfolio;
            case 'Projects':
                return Projects;
            case 'TechStack':
                return TechStack;
            default:
                return ErrorPage;
        }
    },
    setup({ el, App, props }) {
        createRoot(el).render(createElement(App, props));

        requestAnimationFrame(() => {
            scrollToPageTop();
            initializeGlobalAnimations();
        });
    },
    progress: false,
});
