import { Link } from '@inertiajs/react';
import { useEffect } from 'react';

export default function Certifications({ profile, all_certifications }) {
    const currentYear = new Date().getFullYear();

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

                <header className="mb-8 flex flex-col items-start gap-3">
                    <Link href="/" prefetch="hover" className="inline-flex items-center gap-1.5 text-sm text-slate-700 dark:text-slate-300 hover:text-indigo-500 font-semibold transition-colors cursor-pointer" aria-label="Back to portfolio home">
                        <i className="fas fa-arrow-left text-xs"></i>
                        <span>{t.backToHome}</span>
                    </Link>
                    <div className="space-y-1">
                        <h1 className="text-2xl md:text-3xl font-bold text-slate-950 dark:text-white display-font">{t.title}</h1>
                        <p className="text-sm text-slate-600 dark:text-slate-400 font-medium">{t.subtitle}</p>
                    </div>
                </header>

                {/* CERTIFICATIONS SECTIONS */}
                <main>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {all_certifications.map((cert, i) => (
                            <article key={i} className="group rounded-xl overflow-hidden bg-white/70 dark:bg-slate-900/50 subtle-border transition-all duration-300 hover:shadow-lg hover:shadow-slate-200/50 dark:hover:shadow-black/30">
                                <a href={cert.url} target="_blank" className="relative block h-44 bg-slate-50 dark:bg-slate-950 border-b border-slate-200/70 dark:border-slate-800/80 overflow-hidden" aria-label={`View ${cert.title} certificate`}>
                                    <div className="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(99,102,241,0.08),transparent_45%)]"></div>
                                    <img src={cert.image} alt={cert.title} className="relative mx-auto h-full max-w-[78%] object-contain py-4 transition-transform duration-500 group-hover:scale-[1.03]" />
                                    <div className="absolute inset-0 bg-slate-950/0 group-hover:bg-slate-950/35 transition-colors flex items-center justify-center">
                                        <span className="opacity-0 group-hover:opacity-100 transition-opacity inline-flex items-center gap-2 rounded bg-white px-3 py-2 text-xs font-bold text-slate-950 shadow-sm">
                                            <i className="fas fa-search-plus text-base"></i>
                                            <span>{t.viewFull}</span>
                                        </span>
                                    </div>
                                </a>

                                <div className="p-5">
                                    <div className="flex items-start justify-between gap-4">
                                        <div className="min-w-0">
                                            <h3 className="text-base md:text-lg font-bold text-slate-950 dark:text-white leading-tight display-font">{cert.title}</h3>
                                            <p className="text-xs text-slate-500 dark:text-slate-400 mt-1 font-semibold">{cert.issuer}</p>
                                        </div>
                                        <span className="px-2.5 py-1 text-[9px] font-bold tracking-wider uppercase rounded-full bg-emerald-100 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-300 shrink-0">{t.verified}</span>
                                    </div>

                                    <div className="mt-5 pt-4 border-t border-slate-200/60 dark:border-slate-800/70">
                                        <a href={cert.url} target="_blank" className="inline-flex items-center gap-2 text-xs font-bold text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                            <span>{t.openDoc}</span>
                                            <i className="fas fa-arrow-right text-[10px] transition-transform group-hover:translate-x-0.5"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        ))}
                    </div>
                </main>

                {/* FOOTER */}
                <footer className="text-center" style={{ marginTop: '8rem', paddingBottom: '2rem' }}>
                    <p className="text-xs text-foreground/50">&copy; {currentYear} {profile.name}. {t.copyright}</p>
                </footer>
            </div>
        </>
    );
}
