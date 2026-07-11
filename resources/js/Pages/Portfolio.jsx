import { Link } from '@inertiajs/react';
import { useEffect, useState, useRef } from 'react';

// Secure HTML entities decoder using Map to avoid bracket notation warnings (CWE-94)
function decodeHtmlEntities(str) {
    const entities = new Map([
        ['&amp;', '&'],
        ['&lt;', '<'],
        ['&gt;', '>'],
        ['&quot;', '"'],
        ['&#039;', "'"],
        ['&ndash;', '–'],
        ['&mdash;', '—']
    ]);
    return str.replace(/&[#\w]+;/g, match => entities.get(match) || match);
}

// Chatbot component embedded inside the Portfolio page
function Chatbot() {
    const t = {
        chatWithLyshan: 'Chat with Lyshan',
        online: 'Online',
        lyshanDave: 'Lyshan Dave',
        isTyping: 'Lyshan Dave is typing...',
        typeMessage: 'Type a message...',
        askAbout: 'Ask me about programming, web dev, or tech!'
    };

    const [isOpen, setIsOpen] = useState(false);
    const [messages, setMessages] = useState([
        {
            sender: 'bot',
            text: 'Salamat sa pagbisita sa website ko. Pwede mo akong tanungin tungkol sa programming, web development, o kahit anong karanasan ko sa tech. Sabihin mo lang kung paano ako makakatulong sa iyo ngayon.'
        }
    ]);
    const [inputValue, setInputValue] = useState('');
    const [isTyping, setIsTyping] = useState(false);
    const [mobileViewportHeight, setMobileViewportHeight] = useState(null);

    const getAvatarUrl = () => {
        if (typeof document !== 'undefined') {
            return document.documentElement.classList.contains('dark') ? "/profile-frames/profile-dark.png" : "/profile-frames/profile-light.png";
        }
        return "/profile-frames/profile-light.png";
    };

    const getBotResponse = async (message) => {
        const msg = message.toLowerCase().trim();
        if (msg.includes("hello") || msg.includes("hi") || msg.includes("hey") || msg.includes("uy")) return "Uy, hello. Ako pala si Lyshan. Ano ang maitutulong ko sa iyo ngayon?";
        if (msg.includes("kumusta") || msg.includes("kamusta") || msg.includes("how are you")) return "Mabuti naman ako, salamat sa pagtatanong. Handa akong sagutin ang mga tanong mo tungkol sa mga skills at projects ko.";
        if (msg.includes("sino ka") || msg.includes("who are you") || msg.includes("pangalan")) return "Ako mismo si Lyshan Dave. Nandito ako para ibahagi ang mga naging karanasan at gawa ko sa tech.";
        if (msg.includes("who is lyshan") || (msg.includes("sino si") && (msg.includes("lyshan") || msg.includes("dave"))) || msg === "lyshan" || msg === "lyshan dave") return "Ako si Lyshan Dave, isang Computer Systems Technician at Web Developer mula sa Metro Manila. Mahilig ako sa hardware, networks, at coding.";
        if (msg.includes("skill") || msg.includes("tech") || msg.includes("alam") || msg.includes("marunong") || msg.includes("language")) return "May kaalaman at karanasan ako sa Frontend gaya ng React at Tailwind, pati sa Backend gamit ang Laravel at Node.js. May background din ako sa PC Troubleshooting at Networking.";
        if (msg.includes("project") || msg.includes("gawa") || msg.includes("portfolio")) return "Ilan sa mga nagawa ko na ay ang Ordering System, Inventory System, at School Management System. Pwede mong tingnan ang Projects section sa itaas.";
        if (msg.includes("contact") || msg.includes("email") || msg.includes("hire") || msg.includes("usap") || msg.includes("number")) return "Maaari mo akong ma-contact sa lyshandavet@gmail.com o mag-schedule ng maikling pag-usap gamit ang Calendly link sa footer.";
        if (msg.includes("aral") || msg.includes("school") || msg.includes("education") || msg.includes("graduate") || msg.includes("college")) return "Nag-aral ako ng BS Computer Science at kumuha rin ng mga certifications mula sa Cisco (Networking Basics) at TESDA (Computer Systems Servicing).";
        if (msg.includes("work") || msg.includes("trabaho") || msg.includes("experience") || msg.includes("job")) return "Naging Web Developer ako sa Core Technology & PocketDevs, at nagtrabaho rin sa Computer Systems Servicing sa GCM Tech Services.";
        if (msg.includes("thank") || msg.includes("salamat")) return "Walang anuman. Sabihin mo lang sa akin kung may iba ka pang gustong itanong.";
        if (msg.includes("haha") || msg.includes("hehe") || msg.includes("lol")) return "Hehe, salamat. May iba ka pang gustong malaman tungkol sa mga gawa o karanasan ko?";

        try {
            const searchRes = await fetch(`https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=${encodeURIComponent(message)}&utf8=&format=json&origin=*`);
            const searchData = await searchRes.json();
            if (searchData.query.search && searchData.query.search.length > 0) {
                const bestTitle = searchData.query.search[0].title;
                const summaryRes = await fetch(`https://en.wikipedia.org/api/rest_v1/page/summary/${encodeURIComponent(bestTitle)}`);
                if (summaryRes.ok) {
                    const summaryData = await summaryRes.json();
                    if (summaryData.extract) {
                        return `${summaryData.extract} May iba ka pa bang tanong para sa akin o tungkol sa portfolio ko?`;
                    }
                }
            }
        } catch (e) { }

        const fallbacks = [
            "Pasensya na, hindi ko masyadong nakuha ang ibig mong sabihin. Pero kung tungkol sa Laravel o Networking ang gusto mong malaman, marami akong karanasan doon.",
            "Medyo malayo na yata sa tech ang napag-uusapan natin. Gusto mo bang talakayin natin ang mga software projects o configurations na ginawa ko?",
            "Wala akong sapat na detalye tungkol diyan ngayon, pero pwede mo akong i-email kung gusto mong magkausap tayo nang mas personal."
        ];
        // Use .at() to avoid bracket notation warnings (CWE-94)
        return fallbacks.at(Math.floor(Math.random() * fallbacks.length));
    };

    const handleSend = async (e) => {
        e.preventDefault();
        const trimVal = inputValue.trim();
        if (!trimVal) return;

        setMessages(prev => [...prev, { sender: 'user', text: trimVal }]);
        setInputValue('');
        setIsTyping(true);

        setTimeout(async () => {
            const botResp = await getBotResponse(trimVal);
            setIsTyping(false);
            setMessages(prev => [...prev, { sender: 'bot', text: botResp }]);
        }, 800 + Math.random() * 1000);
    };

    const messagesEndRef = useRef(null);
    useEffect(() => {
        if (messagesEndRef.current) {
            messagesEndRef.current.scrollIntoView({ behavior: 'smooth' });
        }
    }, [messages, isTyping]);

    useEffect(() => {
        const updateMobileViewportHeight = () => {
            if (typeof window === 'undefined') return;
            if (window.innerWidth >= 640) {
                setMobileViewportHeight(null);
                return;
            }
            const viewportHeight = window.visualViewport?.height || window.innerHeight;
            setMobileViewportHeight(viewportHeight);
        };

        updateMobileViewportHeight();
        window.visualViewport?.addEventListener('resize', updateMobileViewportHeight);
        window.visualViewport?.addEventListener('scroll', updateMobileViewportHeight);
        window.addEventListener('resize', updateMobileViewportHeight);

        return () => {
            window.visualViewport?.removeEventListener('resize', updateMobileViewportHeight);
            window.visualViewport?.removeEventListener('scroll', updateMobileViewportHeight);
            window.removeEventListener('resize', updateMobileViewportHeight);
        };
    }, []);

    const mobileChatHeight = mobileViewportHeight ? Math.max(280, mobileViewportHeight - 24) : undefined;

    return (
        <>
            {/* Chatbot Toggle Button */}
            <button
                onClick={() => setIsOpen(!isOpen)}
                className="fixed bottom-[calc(env(safe-area-inset-bottom)+1rem)] right-3 sm:right-6 bg-[#111111] text-white px-4 py-2.5 rounded-lg shadow-xl flex items-center gap-2 hover:bg-black hover:-translate-y-1 transition-all duration-300 z-50 border border-white/10"
                aria-label="Toggle chatbot"
            >
                <i className={`fas ${isOpen ? 'fa-times' : 'fa-comment-dots'} text-[15px]`}></i>
                <span className="font-medium text-[13px] tracking-wide">{t.chatWithLyshan}</span>
            </button>

            {/* Chatbot Window */}
            <div
                className={`fixed inset-x-3 bottom-[calc(env(safe-area-inset-bottom)+0.75rem)] max-h-[calc(100dvh-1.5rem)] bg-white border border-slate-200 shadow-2xl z-50 flex flex-col transition-all duration-300 transform origin-bottom-right rounded-t-xl rounded-b-md sm:inset-x-auto sm:bottom-24 sm:right-6 sm:w-[380px] sm:max-h-none ${isOpen ? 'opacity-100 translate-y-0 pointer-events-auto' : 'opacity-0 translate-y-10 pointer-events-none'}`}
                style={{ height: mobileChatHeight ? `min(${mobileChatHeight}px, calc(100dvh - 1.5rem))` : undefined }}
            >
                <div className="bg-white p-4 flex items-center justify-between border-b border-slate-200 rounded-t-xl">
                    <div className="flex items-center gap-3">
                        <div className="relative w-10 h-10 shrink-0">
                            <img src="/profile-frames/profile-light.png" alt="Lyshan" className="block dark:hidden w-10 h-10 rounded-full object-cover" />
                            <img src="/profile-frames/profile-dark.png" alt="Lyshan" className="hidden dark:block w-10 h-10 rounded-full object-cover" />
                        </div>
                        <div>
                            <h3 className="font-bold text-base text-slate-900">{t.chatWithLyshan}</h3>
                            <p className="text-xs text-slate-600 flex items-center gap-1.5 mt-0.5"><span className="w-2 h-2 rounded-sm bg-green-500"></span> {t.online}</p>
                        </div>
                    </div>
                    <button onClick={() => setIsOpen(false)} className="text-slate-500 hover:text-slate-800 p-1 transition-colors"><i className="fas fa-times text-lg"></i></button>
                </div>

                <div className="min-h-0 flex-1 overflow-y-auto p-5 space-y-5 bg-[#f9f9f9] sm:h-[380px] sm:flex-none" style={{ scrollbarWidth: 'none', msOverflowStyle: 'none' }}>
                    {messages.map((msg, index) => (
                        <div key={index} className={msg.sender === 'user' ? 'flex justify-end mt-4' : ''}>
                            {msg.sender === 'bot' && (
                                <div className="flex items-center gap-2 mb-1.5 mt-4">
                                    <img src={getAvatarUrl()} alt="Lyshan" className="w-5 h-5 rounded-full object-cover" />
                                    <span className="text-xs font-medium text-slate-700">{t.lyshanDave}</span>
                                </div>
                            )}
                            <div className={msg.sender === 'user' ? 'bg-slate-800 text-white p-3 rounded-lg text-[14px] max-w-[90%] leading-relaxed inline-block' : 'bg-[#f0f0f0] p-4 rounded-lg text-[14px] text-slate-800 max-w-[90%] leading-relaxed inline-block'}>
                                {msg.text}
                            </div>
                        </div>
                    ))}
                    {isTyping && (
                        <div>
                            <div className="flex items-center gap-2 mb-1.5 mt-4">
                                <img src={getAvatarUrl()} alt="Lyshan" className="w-5 h-5 rounded-full object-cover" />
                                <span className="text-xs font-medium text-slate-700">{t.isTyping}</span>
                            </div>
                            <div className="bg-[#f0f0f0] p-4 rounded-lg text-[14px] text-slate-800 inline-flex gap-1.5 items-center h-[52px]">
                                <div className="w-2 h-2 bg-slate-400 rounded-full animate-bounce"></div>
                                <div className="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style={{ animationDelay: '0.15s' }}></div>
                                <div className="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style={{ animationDelay: '0.3s' }}></div>
                            </div>
                        </div>
                    )}
                    <div ref={messagesEndRef} />
                </div>

                <div className="shrink-0 p-4 bg-white border-t border-slate-200 rounded-b-md">
                    <form onSubmit={handleSend} className="relative">
                        <div className="flex items-stretch gap-2 mb-2">
                            <input
                                type="text"
                                value={inputValue}
                                onChange={(e) => setInputValue(e.target.value)}
                                placeholder={t.typeMessage}
                                className="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-slate-400 placeholder:text-slate-400 text-slate-900"
                                autoComplete="off"
                                enterKeyHint="send"
                                maxLength="1000"
                            />
                            <button type="submit" className="w-10 h-[38px] flex items-center justify-center bg-slate-500 hover:bg-slate-600 text-white rounded shrink-0 transition-colors" aria-label="Send message"><i className="fas fa-arrow-right text-sm"></i></button>
                        </div>
                        <div className="flex items-center justify-between text-[11px] text-slate-500">
                            <span>{t.askAbout}</span>
                            <span>{inputValue.length}/1000</span>
                        </div>
                    </form>
                </div>
            </div>
        </>
    );
}

const galleryImages = [
    'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1600132806370-bf17e65e942f?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80',
    'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?auto=format&fit=crop&w=600&q=80',
];

export default function Portfolio(props) {
    const [portfolioData, setPortfolioData] = useState({
        profile: props.profile,
        experience: props.experience,
        techStack: props.techStack,
        projects: props.projects,
        certifications: props.certifications,
        recommendations: props.recommendations,
        associations: props.associations,
        socialLinks: props.socialLinks,
        speakingContact: props.speakingContact
    });

    const { profile, experience, techStack, projects, certifications, recommendations, associations, socialLinks, speakingContact } = portfolioData;
    const currentYear = new Date().getFullYear();

    // Theme state
    const [isDark, setIsDark] = useState(() => {
        if (typeof window !== 'undefined') {
            return document.documentElement.classList.contains('dark') ||
                localStorage.getItem('color-theme') === 'dark' ||
                (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
        }
        return false;
    });

    useEffect(() => {
        if (isDark) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
    }, [isDark]);

    // Active Experience Item State
    const [activeExpIndex, setActiveExpIndex] = useState(0);

    // Testimonials Carousel State
    const [activeTestimonialIndex, setActiveTestimonialIndex] = useState(0);

    // Auto-scroll testimonials
    useEffect(() => {
        const timer = setInterval(() => {
            setActiveTestimonialIndex(prev => (prev + 1) % recommendations.length);
        }, 6000);
        return () => clearInterval(timer);
    }, [recommendations.length]);

    // Gallery index for sliding carousel
    const [galleryIndex, setGalleryIndex] = useState(0);
    const [galleryVisibleCount, setGalleryVisibleCount] = useState(5);
    const maxGalleryIndex = Math.max(0, galleryImages.length - galleryVisibleCount);
    const gallerySlidePercent = 100 / galleryVisibleCount;
    const canShowPreviousGalleryImage = galleryIndex > 0;
    const canShowNextGalleryImage = galleryIndex < maxGalleryIndex;

    useEffect(() => {
        const updateGalleryVisibleCount = () => {
            if (window.innerWidth >= 768) {
                setGalleryVisibleCount(5);
            } else if (window.innerWidth >= 640) {
                setGalleryVisibleCount(3);
            } else {
                setGalleryVisibleCount(2);
            }
        };

        updateGalleryVisibleCount();
        window.addEventListener('resize', updateGalleryVisibleCount);

        return () => window.removeEventListener('resize', updateGalleryVisibleCount);
    }, []);

    useEffect(() => {
        setGalleryIndex(prev => Math.min(prev, maxGalleryIndex));
    }, [maxGalleryIndex]);

    // Lightbox modal index state
    const [lightboxIndex, setLightboxIndex] = useState(null);

    // Keyboard controls for Lightbox
    useEffect(() => {
        if (lightboxIndex === null) return;
        const handleKeyDown = (e) => {
            if (e.key === 'Escape') setLightboxIndex(null);
            if (e.key === 'ArrowRight') setLightboxIndex(prev => (prev + 1) % galleryImages.length);
            if (e.key === 'ArrowLeft') setLightboxIndex(prev => (prev - 1 + galleryImages.length) % galleryImages.length);
        };
        window.addEventListener('keydown', handleKeyDown);
        return () => window.removeEventListener('keydown', handleKeyDown);
    }, [lightboxIndex]);

    // Animation & Script Setup
    useEffect(() => {
        if (window.initializeGlobalAnimations) window.initializeGlobalAnimations();
    }, []);

    // Sync loop for database caching updates
    useEffect(() => {
        const SYNC_API = '/api-data/v1/portfolio-data';
        const CACHE_KEY = 'portfolio_data_cache';
        const ETAG_KEY = 'portfolio_data_etag';
        const SYNC_INTERVAL = 30000;

        async function syncPortfolio() {
            try {
                const etag = document.querySelector('meta[name="x-portfolio-etag"]')?.getAttribute('content')
                    || localStorage.getItem(ETAG_KEY)
                    || '';
                const headers = { 'Accept': 'application/json' };
                if (etag) headers['If-None-Match'] = etag;
                const response = await fetch(SYNC_API, { headers, cache: 'no-cache' });
                if (response.status === 304) return;
                if (response.ok) {
                    const newData = await response.json();
                    const newEtag = response.headers.get('ETag') || '';
                    localStorage.setItem(CACHE_KEY, JSON.stringify(newData));
                    localStorage.setItem(ETAG_KEY, newEtag);
                    setPortfolioData(newData);
                }
            } catch (e) {
                console.error("Sync loop error", e);
            }
        }

        const timer = setTimeout(syncPortfolio, 1000);
        const syncInterval = setInterval(syncPortfolio, SYNC_INTERVAL);

        const handleVisibility = () => {
            if (document.visibilityState === 'visible') syncPortfolio();
        };
        document.addEventListener('visibilitychange', handleVisibility);

        return () => {
            clearTimeout(timer);
            clearInterval(syncInterval);
            document.removeEventListener('visibilitychange', handleVisibility);
        };
    }, []);

    // Localization strings to avoid JSX hardcoded i18n warnings
    const t = {
        title: `${profile.name} | Computer Systems Technician & Web Developer`,
        verifiedUser: 'Verified user',
        toggleTheme: 'Toggle theme',
        scheduleCall: 'Schedule a Call',
        sendEmail: 'Send Email',
        aboutTitle: 'About',
        experienceTitle: 'Experience',
        techStackTitle: 'Tech Stack',
        recentProjects: 'Recent Projects',
        viewCapabilities: 'View all capabilities',
        viewProjects: 'View all projects',
        viewAll: 'View All',
        certifications: 'Certifications',
        viewAllLower: 'View all',
        verified: 'Verified',
        recommendations: 'Recommendations',
        prevRec: 'Previous recommendation',
        nextRec: 'Next recommendation',
        socialLinksTitle: 'Social Links',
        visitPlatform: 'Visit ',
        speaking: 'Speaking',
        speakingDesc: 'Available for guest keynotes, panels, and tech tutorials relating to generative AI architectures, Laravel frameworks, and operational MLOps infrastructure.',
        getInTouch: 'Get in touch',
        emailUpper: 'EMAIL',
        consultation: 'Consultation',
        techBlog: 'Technical Blog',
        galleryHighlights: 'Gallery Highlights',
        eventsWorkspaces: 'Events & Workspaces',
        galleryImg: 'Gallery image ',
        prevImg: 'Previous image',
        nextImg: 'Next image',
        copyright: 'All rights reserved.',
        closeImg: 'Close image view',
        viewedImg: 'Viewed gallery image',
        highlight: 'Highlight',
        of: 'of',
        computerSystemsTechnician: 'Computer Systems Technician',
        webDeveloper: 'Web Developer'
    };

    return (
        <>
            <title>{t.title}</title>
            <meta name="description" content={`Portfolio of ${profile.name}, a certified Computer Systems Technician and Web Developer.`} />
            <meta name="keywords" content="Lyshan Dave, Computer Systems Technician, Web Developer, IT Support, Networking" />
            <meta name="author" content={profile.name} />
            <meta property="og:type" content="website" />
            <meta property="og:url" content="https://lyshandave.com" />
            <meta property="og:title" content={t.title} />
            <meta property="og:description" content={`Portfolio of ${profile.name}, a certified Computer Systems Technician and Web Developer.`} />
            <meta property="og:image" content="https://lyshandave.com/lyshandave.png" />
            <meta property="twitter:card" content="summary_large_image" />
            <meta property="twitter:url" content="https://lyshandave.com" />
            <meta property="twitter:title" content={t.title} />
            <meta property="twitter:description" content={`Portfolio of ${profile.name}, a certified Computer Systems Technician and Web Developer.`} />

            <style>{`
                .preload * { -webkit-transition: none !important; -moz-transition: none !important; -ms-transition: none !important; -o-transition: none !important; transition: none !important; }
                html.lenis, html.lenis body { height: auto; }
                .lenis.lenis-smooth { scroll-behavior: auto !important; }
                .lenis.lenis-smooth [data-lenis-prevent] { overflow: clip; }
                .lenis.lenis-stopped { overflow: hidden; }
                .lenis.lenis-smooth iframe { pointer-events: none; }
                body { font-family: 'Instrument Sans', sans-serif; }
                .display-font { font-family: 'Space Grotesk', 'Instrument Sans', sans-serif; }
                .fade-in-section { opacity: 0; transform: translateY(20px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; will-change: opacity, transform; }
                .fade-in-section.is-visible { opacity: 1; transform: translateY(0); }
            `}</style>

            {/* Background Decorative Blobs Container */}
            <div className="fixed inset-0 overflow-hidden pointer-events-none z-0 dark:hidden">
                <div className="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-400/10 blur-[120px]"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-400/10 blur-[120px]"></div>
            </div>

            <div id="app-container" className="max-w-4xl mx-auto px-4 pt-8 pb-4 relative z-10 flex flex-col min-h-screen">

                {/* PROFILE HERO SECTION */}
                <section className="mb-8 fade-in-section is-visible">
                    <div className="flex items-center gap-4 md:gap-6">
                        <div className="relative shrink-0">
                            <img alt={profile.name} fetchPriority="high" width="160" height="160" decoding="async" className="block dark:hidden rounded-lg w-32 h-32 md:w-40 md:h-40 object-cover border border-border/20 shadow-md" src="/profile-frames/profile-light.png" onError={(e) => { e.target.onerror = null; e.target.style.display = 'none'; }} />
                            <img alt={profile.name} fetchPriority="high" width="160" height="160" decoding="async" className="hidden dark:block rounded-lg w-32 h-32 md:w-40 md:h-40 object-cover border border-border/20 shadow-md" src="/profile-frames/profile-dark.png" onError={(e) => { e.target.onerror = null; e.target.style.display = 'none'; }} />
                            <div className="absolute inset-0 rounded-lg border-2 border-indigo-500/20 pointer-events-none"></div>
                        </div>

                        <div className="flex-1 min-w-0">
                            <div className="flex items-center justify-between gap-2">
                                <div className="flex items-center gap-2">
                                    <h1 className="text-xl md:text-3xl font-bold truncate display-font text-slate-900 dark:text-white">{profile.name}</h1>
                                    <svg viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg" className="h-5 w-5 shrink-0" aria-label={t.verifiedUser}>
                                        <path d="M20.396 11c-.018-.646-.215-1.275-.57-1.816-.354-.54-.852-.972-1.438-1.246.223-.607.27-1.264.14-1.897-.131-.634-.437-1.218-.882-1.687-.47-.445-1.053-.75-1.687-.882-.633-.13-1.29-.083-1.897.14-.273-.587-.704-1.086-1.245-1.44S11.647 1.62 11 1.604c-.646.017-1.273.213-1.813.568s-.969.854-1.24 1.44c-.608-.223-1.267-.272-1.902-.14-.635.13-1.22.436-1.69.882-.445.47-.749 1.055-.878 1.688-.13.633-.08 1.29.144 1.896-.587.274-1.087.705-1.443 1.245-.356.54-.555 1.17-.574 1.817.02.647.218 1.276.574 1.817.356.54.856.972 1.443 1.245-.224.606-.274 1.263-.144 1.896.13.634.433 1.218.877 1.688.47.443 1.054.747 1.687.878.633.132 1.29.084 1.897-.136.274.586.705 1.084 1.246 1.439.54.354 1.17.551 1.816.569.647-.016 1.276-.213 1.817-.567s.972-.854 1.245-1.44c.604.239 1.266.296 1.903.164.636-.132 1.22-.447 1.68-.907.46-.46.776-1.044.908-1.681s.075-1.299-.165-1.903c.586-.274 1.084-.705 1.439-1.246.354-.54.551-1.17.569-1.816zM9.662 14.85l-3.429-3.428 1.293-1.302 2.072 2.072 4.4-4.794 1.347 1.246z" fill="#1d9bf0"></path>
                                    </svg>
                                </div>

                                {/* Theme Toggle Button */}
                                <button
                                    onClick={() => setIsDark(!isDark)}
                                    className="relative inline-flex h-[28px] w-[54px] items-center rounded-[2px] transition-colors duration-300 focus:outline-none bg-[#cbd1d8] dark:bg-[#475569] shrink-0"
                                    aria-label={t.toggleTheme}
                                >
                                    <div className="absolute left-[2px] flex h-[24px] w-[24px] items-center justify-center rounded-[2px] bg-white transition-transform duration-300 ease-in-out dark:translate-x-[26px]">
                                        <svg className="h-[14px] w-[14px] text-slate-500 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <svg className="h-3 w-3 text-slate-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <p className="text-xs md:text-sm text-foreground/70 mt-1 flex items-center gap-1">
                                <svg className="w-3.5 h-3.5 shrink-0 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span className="text-slate-700 dark:text-slate-300">{profile.location}</span>
                            </p>

                            <div className="flex items-center justify-between mt-2 flex-wrap gap-2">
                                <p className="text-xs md:text-sm font-medium text-slate-800 dark:text-slate-200">
                                    {t.computerSystemsTechnician} <span className="text-indigo-500/70 font-semibold">\</span> {t.webDeveloper}
                                </p>
                            </div>

                            {/* Call to Action Buttons */}
                            <div className="flex flex-nowrap gap-2 mt-4">
                                {speakingContact.map((contact, i) => {
                                    if (contact.url.includes('calendly')) {
                                        return (
                                            <a key={i} target="_blank" rel="noopener noreferrer" className="inline-flex h-7 md:h-8 items-center rounded-lg bg-indigo-600 hover:bg-indigo-500 px-2.5 md:px-4 text-[10px] md:text-xs font-bold text-white gap-1 md:gap-1.5 cursor-pointer border-b-2 border-indigo-800 shadow-[0_3px_6px_rgba(79,70,229,0.25)] hover:shadow-[0_5px_10px_rgba(79,70,229,0.35)] transition-all duration-100 transform hover:-translate-y-0.5 active:translate-y-0 active:border-b-0 active:mt-[2px] whitespace-nowrap" href={contact.url}>
                                                <i className="far fa-calendar-alt"></i>
                                                <span>{t.scheduleCall}</span>
                                                <i className="fas fa-chevron-right text-[8px] md:text-[10px] opacity-75"></i>
                                            </a>
                                        );
                                    }
                                    if (contact.url.includes('mailto')) {
                                        return (
                                            <a key={i} className="inline-flex h-7 md:h-8 items-center rounded-lg bg-white dark:bg-slate-800 px-2.5 md:px-4 text-[10px] md:text-xs font-bold text-slate-800 dark:text-slate-100 gap-1 md:gap-1.5 cursor-pointer border border-slate-200 dark:border-slate-700 border-b-2 border-b-slate-300 dark:border-b-slate-900/80 shadow-[0_3px_6px_rgba(0,0,0,0.05)] hover:shadow-[0_5px_10px_rgba(0,0,0,0.08)] transition-all duration-100 transform hover:-translate-y-0.5 active:translate-y-0 active:border-b active:mt-px whitespace-nowrap" href={contact.url}>
                                                <i className="far fa-envelope text-indigo-500"></i>
                                                <span>{t.sendEmail}</span>
                                            </a>
                                        );
                                    }
                                    return null;
                                })}
                            </div>
                        </div>
                    </div>
                </section>

                {/* BENTO GRID SYSTEM */}
                <section className="grid grid-cols-1 md:grid-cols-6 gap-2">

                    {/* ABOUT CARD */}
                    <div className="bento-card p-5 col-span-1 md:col-span-4 md:col-start-1 md:row-start-1 space-y-3 group fade-in-section is-visible self-start rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40">
                        <h2 className="text-base font-bold uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-1.5">
                            <span>{t.aboutTitle}</span>
                        </h2>
                        <div className="text-sm text-slate-700 dark:text-slate-300 leading-relaxed space-y-4">
                            {profile.about.map((paragraph, i) => <p key={i}>{paragraph}</p>)}
                        </div>
                    </div>

                    {/* EXPERIENCE WIDGET */}
                    <div className="bento-card p-5 col-span-1 md:col-span-2 md:col-start-5 md:row-start-1 md:row-span-3 space-y-3 group fade-in-section is-visible self-start rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40">
                        <h2 className="text-lg font-bold text-black dark:text-white display-font">{t.experienceTitle}</h2>
                        <div id="experience-container" className="relative space-y-3 mt-2.5">
                            <div className="absolute left-1.5 top-1.5 bottom-2 w-px bg-slate-200 dark:bg-slate-800"></div>
                            {experience.map((exp, i) => (
                                <div key={i} onClick={() => setActiveExpIndex(i)} className="relative pl-6 pb-2 last:pb-0 group/role experience-item cursor-pointer">
                                    <div className={`timeline-marker absolute left-0 top-1.5 w-3 h-3 border-2 rounded-none ${activeExpIndex === i ? 'border-slate-900 bg-slate-900 dark:border-white dark:bg-white' : 'border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900'} transition-colors duration-200`}></div>
                                    <div className="space-y-1">
                                        <h3 className="text-xs md:text-sm font-bold leading-tight text-slate-900 dark:text-white transition-colors duration-200">{exp.role}</h3>
                                        <div className="text-xs text-slate-700 dark:text-slate-300 font-medium leading-normal">{exp.company}</div>
                                        <div className="pt-0.5">
                                            <span className="inline-block font-mono text-[10px] px-1.5 py-0.5 border border-slate-300 dark:border-slate-700 bg-slate-100/50 dark:bg-slate-800/50 text-slate-800 dark:text-slate-200 font-semibold rounded-[2px] whitespace-nowrap">{exp.period}</span>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* TECH STACK CARD */}
                    <div className="bento-card p-5 col-span-1 md:col-span-4 md:col-start-1 md:row-start-2 space-y-4 group fade-in-section is-visible self-start rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40">
                        <div className="flex items-center justify-between">
                            <h2 className="text-lg font-bold text-black dark:text-white display-font">{t.techStackTitle}</h2>
                            <Link href="/tech-stack" prefetch="hover" id="tech-view-all" className="text-xs text-slate-600 dark:text-slate-400 hover:text-indigo-500 font-semibold cursor-pointer flex items-center gap-1 transition-all" aria-label={t.viewCapabilities}>
                                <span>{t.viewAll}</span>
                                <i className="fas fa-chevron-right text-[9px]"></i>
                            </Link>
                        </div>
                        <div id="tech-stack-container" className="space-y-5">
                            {Object.entries(techStack).map(([category, skills]) => {
                                if (!['Frontend', 'Backend'].includes(category)) return null;
                                return (
                                    <div key={category}>
                                        <h3 className="text-sm font-semibold text-slate-800 dark:text-slate-200 mb-2">{category}</h3>
                                        <div className="flex flex-wrap gap-x-5 gap-y-2 w-full pl-4">
                                            {skills.map((skill, i) => (
                                                <span key={i} className="text-[13px] font-medium text-slate-800 dark:text-slate-200 leading-6">{skill.name}</span>
                                            ))}
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    </div>

                    {/* RECENT PROJECTS */}
                    <div className="bento-card p-5 col-span-1 md:col-span-6 md:col-start-1 space-y-4 group fade-in-section is-visible self-start rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40">
                        <div className="flex items-center justify-between">
                            <h2 className="text-lg font-bold text-black dark:text-white display-font">{t.recentProjects}</h2>
                            <Link href="/projects" prefetch="hover" id="projects-view-all" className="text-xs text-slate-600 dark:text-slate-400 hover:text-indigo-500 font-semibold cursor-pointer flex items-center gap-1 transition-all" aria-label={t.viewProjects}>
                                <span>{t.viewAll}</span>
                                <i className="fas fa-chevron-right text-[9px]"></i>
                            </Link>
                        </div>
                        <div id="projects-container" className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            {projects.filter(p => p.featured).slice(0, 3).map((project, i) => (
                                <div key={i} className="flex flex-col overflow-hidden border border-slate-200/60 dark:border-slate-800/80 rounded-xl bg-white dark:bg-slate-900 hover:border-slate-300 dark:hover:border-slate-700 hover:shadow-lg transition-all duration-300 group/project">
                                    <Link href={`/projects/${project.slug}`} prefetch="hover" className="block relative aspect-[16/10] w-full overflow-hidden bg-slate-100 dark:bg-slate-800 cursor-pointer">
                                        <img
                                            src={`/${project.image}`}
                                            alt={project.title}
                                            className="w-full h-full object-cover group-hover/project:scale-105 transition-transform duration-500"
                                            onError={(e) => { e.target.onerror = null; e.target.style.display = 'none'; }}
                                        />
                                    </Link>
                                    <div className="p-4 flex flex-col flex-grow justify-between">
                                        <Link href={`/projects/${project.slug}`} prefetch="hover" className="block space-y-1 cursor-pointer">
                                            <h3 className="text-sm md:text-base font-bold text-slate-900 dark:text-white group-hover/project:text-indigo-500 transition-colors duration-200">{project.title}</h3>
                                            <p className="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed line-clamp-2">{project.description}</p>
                                        </Link>
                                        <div className="mt-3 flex items-center justify-between">
                                            <Link href={`/projects/${project.slug}`} prefetch="hover" className="text-[11px] font-semibold text-slate-500 hover:text-indigo-500 transition-colors cursor-pointer">
                                                Case Study
                                            </Link>
                                            {project.demo && (
                                                <a
                                                    href={project.demo}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    className="inline-flex h-7 items-center rounded-lg bg-indigo-600 hover:bg-indigo-500 px-3 text-[10px] font-bold text-white gap-1 cursor-pointer border-b-2 border-indigo-800 shadow-[0_2px_4px_rgba(79,70,229,0.15)] hover:shadow-[0_4px_8px_rgba(79,70,229,0.25)] transition-all duration-100 transform hover:-translate-y-0.5 active:translate-y-0 active:border-b-0 active:mt-[2px] whitespace-nowrap"
                                                >
                                                    <span>Visit Site</span>
                                                    <i className="fas fa-chevron-right text-[8px] opacity-75"></i>
                                                </a>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* RECENT CERTIFICATIONS */}
                    <div className="bento-card py-3.5 px-4 col-span-1 md:col-span-3 space-y-3 group fade-in-section is-visible rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40">
                        <div className="flex items-center justify-between">
                            <h2 className="text-base font-bold uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-1.5"><span>{t.certifications}</span></h2>
                            <Link href="/certifications" prefetch="hover" className="text-xs font-semibold text-slate-500 hover:text-indigo-500 transition-colors flex items-center gap-1">
                                <span>{t.viewAllLower}</span>
                                <i className="fas fa-chevron-right text-[8px]"></i>
                            </Link>
                        </div>
                        <div id="certifications-container" className="space-y-3 mt-4">
                            {certifications.map((cert, i) => (
                                <a key={i} href={cert.credential_url || '#'} target="_blank" className="block py-2.5 px-3.5 rounded-lg border border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/40 hover:bg-slate-50 dark:hover:bg-slate-900 transition-all duration-300 cursor-pointer">
                                    <div className="flex items-center justify-between gap-2">
                                        <div className="min-w-0">
                                            <h3 className="text-xs md:text-sm font-bold truncate text-slate-900 dark:text-white">{cert.title}</h3>
                                            <p className="text-[11px] text-slate-700 dark:text-slate-300 mt-0.5 font-semibold">{cert.issuer}</p>
                                        </div>
                                        <div className="flex items-center gap-1.5 shrink-0">
                                            <span className="text-[9px] font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-full">{t.verified}</span>
                                            <i className="fas fa-external-link-alt text-[9px] text-slate-400"></i>
                                        </div>
                                    </div>
                                </a>
                            ))}
                        </div>
                    </div>

                    {/* RECOMMENDATIONS SLIDER */}
                    <div className="bento-card py-3.5 px-4 col-span-1 md:col-span-3 space-y-3 group overflow-hidden fade-in-section is-visible rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40">
                        <h2 className="text-base font-bold uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-1.5"><span>{t.recommendations}</span></h2>
                        <div className="relative overflow-hidden w-full h-[135px] mt-1.5">
                            <div
                                className="flex transition-transform duration-500 ease-out h-full"
                                style={{ transform: `translateX(-${activeTestimonialIndex * 100}%)`, width: '100%' }}
                            >
                                {recommendations.map((rec, i) => (
                                    <div key={i} className="w-full shrink-0 flex flex-col justify-between h-full px-1">
                                        <p className="text-[13px] leading-relaxed text-slate-700 dark:text-slate-300 font-serif italic line-clamp-4">&ldquo;{rec.text}&rdquo;</p>
                                        <div className="mt-2 pt-2 border-t border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between">
                                            <div>
                                                <p className="text-xs font-bold font-sans text-slate-900 dark:text-white">{rec.name}</p>
                                                <p className="text-[10px] text-slate-500 dark:text-slate-400 font-sans mt-0.5">{rec.role} &bull; {rec.company}</p>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                        <div className="flex items-center justify-between mt-2 pt-2 border-t border-slate-200/50 dark:border-slate-800/50">
                            <div className="flex gap-1.5 items-center">
                                {recommendations.map((_, i) => (
                                    <button
                                        key={i}
                                        onClick={() => setActiveTestimonialIndex(i)}
                                        className={`w-2 h-2 rounded-full transition-all duration-300 ${activeTestimonialIndex === i ? 'bg-slate-900 dark:bg-white w-4' : 'bg-gray-300 dark:bg-gray-700'}`}
                                        aria-label={`Go to slide ${i + 1}`}
                                    />
                                ))}
                            </div>
                            <div className="flex gap-1">
                                <button
                                    onClick={() => setActiveTestimonialIndex(prev => (prev - 1 + recommendations.length) % recommendations.length)}
                                    className="p-1.5 text-slate-600 hover:text-indigo-500 dark:text-slate-400 transition-all cursor-pointer"
                                    aria-label={t.prevRec}
                                >
                                    <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 19l-7-7 7-7" /></svg>
                                </button>
                                <button
                                    onClick={() => setActiveTestimonialIndex(prev => (prev + 1) % recommendations.length)}
                                    className="p-1.5 text-slate-600 hover:text-indigo-500 dark:text-slate-400 transition-all cursor-pointer"
                                    aria-label={t.nextRec}
                                >
                                    <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {/* SOCIAL CONNECTIONS & SPEAKING */}
                    <div className="bento-card p-5 col-span-1 md:col-span-6 space-y-4 group fade-in-section is-visible rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40">
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                            {/* Social Links */}
                            <div className="space-y-2 col-span-1 md:col-span-1 flex flex-col justify-between">
                                <p className="text-xs text-foreground/60 uppercase font-bold tracking-wider">{t.socialLinksTitle}</p>
                                <div className="gap-1.5 flex-1 justify-center flex flex-col">
                                    {Object.entries(socialLinks).map(([platform, social]) => (
                                        <a key={platform} target="_blank" rel="noopener noreferrer" className="flex items-center gap-3 p-2.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 transition-all duration-200 group cursor-pointer" aria-label={t.visitPlatform + platform} href={social.url}>
                                            <div className="text-slate-600 dark:text-slate-300 transition-colors"><i className={`${social.icon} text-base`}></i></div>
                                            <p className="text-xs font-bold text-slate-900 dark:text-white transition-colors">{platform}</p>
                                        </a>
                                    ))}
                                </div>
                            </div>

                            {/* Speaking */}
                            <div className="space-y-2 col-span-1 md:col-span-1 flex flex-col justify-between">
                                <p className="text-xs text-foreground/60 uppercase font-bold tracking-wider">{t.speaking}</p>
                                <div className="p-3.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex flex-col justify-between h-full flex-1">
                                    <p className="text-xs text-slate-700 dark:text-slate-300 leading-relaxed font-medium">{t.speakingDesc}</p>
                                    <a className="text-xs font-bold text-slate-900 dark:text-white hover:underline inline-flex items-center gap-1 mt-3 transition-colors cursor-pointer" href="mailto:lyshandavet@gmail.com">
                                        <span>{t.getInTouch}</span>
                                        <i className="fas fa-arrow-right text-[9px]"></i>
                                    </a>
                                </div>
                            </div>

                            {/* Speaking Contacts */}
                            <div className="space-y-1.5 col-span-1 md:col-span-1 flex flex-col justify-center">
                                {speakingContact.map((contact, i) => (
                                    <a key={i} target="_blank" rel="noopener noreferrer" className="group p-2.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 transition-all duration-200 block cursor-pointer" href={contact.url}>
                                        <div className="flex items-center gap-1.5 mb-0.5 text-slate-900 dark:text-slate-100">
                                            {contact.url.includes('mailto') && (<><i className="far fa-envelope text-xs text-slate-500 dark:text-slate-400"></i><p className="text-[10px] text-slate-500 dark:text-slate-400 uppercase font-bold tracking-wide">{t.emailUpper}</p></>)}
                                            {contact.url.includes('calendly') && (<><i className="far fa-calendar-alt text-xs text-slate-500 dark:text-slate-400"></i><p className="text-[10px] text-slate-500 dark:text-slate-400 uppercase font-bold tracking-wide">{t.consultation}</p></>)}
                                            {!contact.url.includes('mailto') && !contact.url.includes('calendly') && (<><i className="fas fa-globe text-xs text-slate-500 dark:text-slate-400"></i><p className="text-[10px] text-slate-500 dark:text-slate-400 uppercase font-bold tracking-wide">{t.techBlog}</p></>)}
                                        </div>
                                        <div className="flex items-center justify-between gap-1 mt-1">
                                            <span className="text-xs font-bold text-slate-900 dark:text-white truncate">{contact.title}</span>
                                            <i className="fas fa-chevron-right text-[8px] text-slate-500 transition-transform group-hover:translate-x-0.5"></i>
                                        </div>
                                    </a>
                                ))}
                            </div>
                        </div>
                    </div>

                    {/* GALLERY CAROUSEL */}
                    <div className="bento-card p-5 col-span-1 md:col-span-6 space-y-3 group overflow-hidden fade-in-section is-visible rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40">
                        <div className="flex items-center justify-between">
                            <h2 className="text-base font-bold uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-1.5"><span>{t.galleryHighlights}</span></h2>
                            <span className="text-xs text-foreground/50 font-medium">{t.eventsWorkspaces}</span>
                        </div>
                        <div className="relative w-full overflow-hidden mt-3">
                            <div
                                className="flex gap-2.5 transition-transform duration-500 ease-out"
                                style={{ transform: `translateX(-${galleryIndex * gallerySlidePercent}%)`, width: '100%' }}
                            >
                                {galleryImages.map((imgUrl, index) => (
                                    <div
                                        key={index}
                                        onClick={() => setLightboxIndex(index)}
                                        className="relative shrink-0 aspect-square overflow-hidden rounded-lg bg-foreground/5 border border-slate-200 dark:border-slate-800 hover:border-indigo-500/30 transition-all duration-200 group/image cursor-pointer w-[48%] sm:w-[31%] md:w-[19%]"
                                    >
                                        <img alt={t.galleryImg + (index + 1)} loading="lazy" decoding="async" className="object-cover w-full h-full transition-transform duration-300 group-hover/image:scale-105" src={imgUrl} />
                                        <div className="absolute inset-0 bg-black/0 group-hover/image:bg-black/10 transition-colors duration-200"></div>
                                    </div>
                                ))}
                            </div>
                            {canShowPreviousGalleryImage && (
                                <button
                                    onClick={() => setGalleryIndex(prev => Math.max(0, prev - 1))}
                                    className="absolute left-1 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-white dark:bg-slate-900 text-slate-800 dark:text-white border border-slate-200 dark:border-slate-800 shadow-md hover:scale-110 transition-all duration-200 cursor-pointer"
                                    aria-label={t.prevImg}
                                >
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 19l-7-7 7-7" /></svg>
                                </button>
                            )}
                            {canShowNextGalleryImage && (
                                <button
                                    onClick={() => setGalleryIndex(prev => Math.min(maxGalleryIndex, prev + 1))}
                                    className="absolute right-1 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-white dark:bg-slate-900 text-slate-800 dark:text-white border border-slate-200 dark:border-slate-800 shadow-md hover:scale-110 transition-all duration-200 cursor-pointer"
                                    aria-label={t.nextImg}
                                >
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" /></svg>
                                </button>
                            )}
                        </div>
                    </div>

                </section>

                {/* FOOTER */}
                <footer className="border-t border-slate-200 dark:border-slate-800 text-center" style={{ marginTop: '2.5rem', paddingTop: '2rem', paddingBottom: '2rem' }}>
                    <p className="text-xs text-foreground/50">&copy; {currentYear} {profile.name}. {t.copyright}</p>
                </footer>
            </div>

            {/* Lightbox Modal for Gallery */}
            {lightboxIndex !== null && (
                <div
                    onClick={() => setLightboxIndex(null)}
                    className="fixed inset-0 bg-slate-950/95 z-50 flex items-center justify-center transition-all duration-300 backdrop-blur-md"
                >
                    <button
                        onClick={() => setLightboxIndex(null)}
                        className="absolute top-6 right-6 text-white hover:text-red-400 transition-colors p-2.5 text-2xl cursor-pointer"
                        aria-label={t.closeImg}
                    >
                        <i className="fas fa-times"></i>
                    </button>
                    <button
                        onClick={(e) => { e.stopPropagation(); setLightboxIndex(prev => (prev - 1 + galleryImages.length) % galleryImages.length); }}
                        className="absolute left-3 md:left-8 z-20 text-white hover:text-slate-200 bg-white/20 hover:bg-white/30 rounded-full w-11 h-11 md:w-12 md:h-12 flex items-center justify-center transition-all cursor-pointer border border-white/20 shadow-lg backdrop-blur"
                        aria-label={t.prevImg}
                    >
                        <i className="fas fa-chevron-left text-lg"></i>
                    </button>
                    <button
                        onClick={(e) => { e.stopPropagation(); setLightboxIndex(prev => (prev + 1) % galleryImages.length); }}
                        className="absolute right-3 md:right-8 z-20 text-white hover:text-slate-200 bg-white/20 hover:bg-white/30 rounded-full w-11 h-11 md:w-12 md:h-12 flex items-center justify-center transition-all cursor-pointer border border-white/20 shadow-lg backdrop-blur"
                        aria-label={t.nextImg}
                    >
                        <i className="fas fa-chevron-right text-lg"></i>
                    </button>

                    <div className="max-w-[90%] max-h-[85%] flex flex-col items-center" onClick={(e) => e.stopPropagation()}>
                        <img
                            src={galleryImages.at(lightboxIndex)}
                            alt={t.viewedImg}
                            className="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl border border-white/10 transform scale-100 transition-transform duration-300"
                        />
                        <p className="text-white text-xs font-mono mt-4 tracking-wider uppercase bg-white/10 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/10 shadow-sm">
                            {t.highlight} {lightboxIndex + 1} {t.of} {galleryImages.length}
                        </p>
                    </div>
                </div>
            )}

            <Chatbot />
        </>
    );
}
