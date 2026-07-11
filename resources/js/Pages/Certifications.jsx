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

                <header className="mb-10 flex flex-col items-start gap-3">
                    <Link href="/" prefetch="hover" className="inline-flex items-center gap-1.5 text-sm text-slate-700 dark:text-slate-300 hover:text-indigo-500 font-semibold transition-colors cursor-pointer" aria-label="Back to portfolio home">
                        <i className="fas fa-arrow-left text-xs"></i>
                        <span>{t.backToHome}</span>
                    </Link>
                    <div className="space-y-2 mt-2">
                        <h1 className="text-3xl md:text-4xl font-bold text-slate-950 dark:text-white display-font">Certifications</h1>
                        <p className="text-sm md:text-base text-slate-500 dark:text-slate-400">Professional credentials and specialized training in Data Science, SQL, and AI.</p>
                    </div>
                </header>

                {/* CERTIFICATIONS SECTIONS */}
                <main>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {all_certifications.map((cert, i) => (
                            <article key={i} className="group rounded-xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:shadow-md hover:border-slate-200 dark:hover:border-slate-700">
                                <button 
                                    onClick={() => setSelectedCert(cert.image)}
                                    className="w-full relative block h-48 bg-slate-50 dark:bg-slate-950/50 overflow-hidden cursor-pointer flex items-center justify-center border-b border-slate-50 dark:border-slate-800/50" 
                                    aria-label={`View ${cert.title} certificate`}
                                >
                                    <img src={cert.image} alt={cert.title} className="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-[1.02]" />
                                </button>

                                <div className="p-6">
                                    <h3 className="text-lg font-bold text-slate-950 dark:text-white leading-tight display-font mb-1">{cert.title}</h3>
                                    <p className="text-sm text-slate-500 dark:text-slate-400">{cert.issuer} • {cert.year || new Date().getFullYear()}</p>
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
                        <div className="relative max-w-4xl w-full flex flex-col items-center" onClick={(e) => e.stopPropagation()}>
                            <div className="w-full flex justify-end mb-4">
                                <button 
                                    onClick={() => setSelectedCert(null)} 
                                    className="text-white flex items-center gap-2 font-bold hover:text-slate-300 transition-colors"
                                >
                                    <i className="fas fa-times text-xl"></i> <span>Close</span>
                                </button>
                            </div>
                            <img 
                                src={selectedCert} 
                                alt="Certificate Full View" 
                                className="w-full max-h-[85vh] object-contain rounded-lg shadow-2xl" 
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
