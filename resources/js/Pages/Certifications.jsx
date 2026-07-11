import { Link } from '@inertiajs/react';
import { useEffect, useState } from 'react';

export default function Certifications({ profile, all_certifications }) {
    const currentYear = new Date().getFullYear();
    const [selectedCert, setSelectedCert] = useState(null);

    useEffect(() => {
        if (window.initializeGlobalAnimations) window.initializeGlobalAnimations();
    }, []);

    // Localization strings to avoid JSX hardcoded i18n warnings
    const t = {
        title: 'All Certifications',
        subtitle: 'Verified credentials and training documents.',
        backToHome: 'Back to Home',
        viewFull: 'View Full Certificate',
        verified: 'Verified',
        openDoc: 'Open credential document',
        copyright: `All rights reserved.`
    };

    // Close modal on escape key
    useEffect(() => {
        const handleKeyDown = (e) => {
            if (e.key === 'Escape') setSelectedCert(null);
        };
        window.addEventListener('keydown', handleKeyDown);
        return () => window.removeEventListener('keydown', handleKeyDown);
    }, []);

    return (
        <>
            <title>{`${t.title} | ${profile.name}`}</title>
            <meta name="description" content={`Verified professional developer certifications of ${profile.name}.`} />
            <meta name="author" content={profile.name} />

            <style>{`
                body { font-family: 'Instrument Sans', sans-serif; }
                .display-font { font-family: 'Space Grotesk', 'Instrument Sans', sans-serif; }
            `}</style>

            {/* Background Decorative Blobs Container */}
            <div className="fixed inset-0 overflow-hidden pointer-events-none z-0">
                <div className="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-400/5 dark:bg-indigo-600/5 blur-[120px]"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-400/5 dark:bg-emerald-600/5 blur-[120px]"></div>
            </div>

            <div id="app-container" className="max-w-5xl mx-auto px-4 pt-8 pb-4 relative z-10 flex flex-col min-h-screen">

                <header className="mb-8 flex flex-col items-start">
                    <Link href="/" prefetch={['mount', 'hover']} className="inline-flex items-center gap-1.5 text-xs text-foreground/60 hover:text-indigo-500 font-semibold transition-colors cursor-pointer" aria-label="Back to portfolio home">
                        <i className="fas fa-arrow-left text-[10px]"></i>
                        <span>{t.backToHome}</span>
                    </Link>
                    <h1 className="text-2xl md:text-3xl font-bold text-black dark:text-white display-font mt-3">Certifications</h1>
                </header>

                {/* CERTIFICATIONS SECTIONS */}
                <main>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {all_certifications.map((cert, i) => (
                            <article key={i} className="flex flex-col overflow-hidden rounded-xl bg-white/60 dark:bg-slate-900/40 subtle-border subtle-border-hover transition-all duration-300 group/cert hover:shadow-lg">
                                <button 
                                    onClick={() => setSelectedCert(cert.image)}
                                    className="w-full relative block h-64 sm:h-72 bg-slate-100 dark:bg-slate-800 overflow-hidden cursor-pointer p-0 flex items-center justify-center border-b border-slate-200 dark:border-slate-800" 
                                    aria-label={`View ${cert.title} certificate`}
                                >
                                    <img src={cert.image} alt={cert.title} className="max-w-full max-h-full object-contain transition-transform duration-500 group-hover/cert:scale-[1.02] drop-shadow-md" />
                                </button>

                                <div className="p-5 flex flex-col flex-grow justify-between space-y-2">
                                    <h3 className="text-base font-bold text-slate-950 dark:text-white leading-tight display-font group-hover/cert:text-indigo-500 transition-colors">{cert.title}</h3>
                                    <p className="text-xs md:text-sm text-slate-700 dark:text-slate-300">{cert.issuer} • {cert.year || new Date().getFullYear()}</p>
                                </div>
                            </article>
                        ))}
                    </div>
                </main>

                {/* MODAL */}
                {selectedCert && (
                    <div 
                        className="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 sm:p-8"
                        onClick={() => setSelectedCert(null)}
                    >
                        <div className="relative max-w-4xl w-full flex flex-col items-center">
                            <img 
                                src={selectedCert} 
                                alt="Certificate Full View" 
                                className="w-full max-h-[85vh] object-contain rounded-lg shadow-2xl cursor-pointer" 
                                onClick={() => setSelectedCert(null)}
                            />
                        </div>
                    </div>
                )}

                {/* FOOTER */}
                <footer className="text-center" style={{ marginTop: '8rem', paddingBottom: '2rem' }}>
                    <p className="text-xs text-foreground/50">&copy; {currentYear} {profile.name}. {t.copyright}</p>
                </footer>
            </div>
        </>
    );
}
