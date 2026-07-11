import { Link } from '@inertiajs/react';
import { useEffect } from 'react';

export default function TechStack({ profile, techStack }) {
    const currentYear = new Date().getFullYear();

    useEffect(() => {
        if (window.initializeGlobalAnimations) window.initializeGlobalAnimations();
    }, []);

    // Localization strings to avoid JSX hardcoded i18n warnings
    const t = {
        title: 'Tech Stack',
        backToHome: 'Back to Home',
        copyright: 'All rights reserved.'
    };

    return (
        <>
            <title>{`${t.title} | ${profile.name}`}</title>
            <meta name="description" content={`Detailed technical capabilities and tech stack of ${profile.name}.`} />
            <meta name="author" content={profile.name} />

            <style>{`
                body { font-family: 'Instrument Sans', sans-serif; }
                .display-font { font-family: 'Space Grotesk', 'Instrument Sans', sans-serif; }
            `}</style>

            {/* Background Decorative Blobs Container */}
            <div className="fixed inset-0 overflow-hidden pointer-events-none z-0 hidden dark:block">
                <div className="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-600/5 blur-[120px]"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-600/5 blur-[120px]"></div>
            </div>

            <div id="app-container" className="max-w-4xl mx-auto px-4 pt-8 pb-4 relative z-10 flex flex-col min-h-screen">

                {/* HEADER NAVIGATION */}
                <header className="mb-8 flex flex-col items-start">
                    <Link href="/" prefetch="hover" className="inline-flex items-center gap-1.5 text-xs text-slate-600 dark:text-slate-400 hover:text-indigo-500 font-bold transition-all cursor-pointer px-3 py-1.5 rounded-lg bg-slate-100/50 hover:bg-indigo-50 dark:bg-slate-800/40 dark:hover:bg-indigo-950/20 border border-slate-200/50 dark:border-slate-700/50" aria-label="Back to portfolio home">
                        <i className="fas fa-arrow-left text-[10px]"></i>
                        <span>{t.backToHome}</span>
                    </Link>
                    <h1 className="text-2xl md:text-3xl font-bold text-black dark:text-white display-font mt-3">{t.title}</h1>
                </header>

                {/* SKILLS CATEGORIES GRID */}
                <main className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {Object.entries(techStack).map(([category, skills]) => (
                        <div key={category} className="rounded-xl p-5 space-y-4 bg-white/60 dark:bg-slate-900/40 subtle-border">
                            <h2 className="text-lg md:text-xl font-bold text-black dark:text-white display-font">{category}</h2>
                            <div className="flex flex-wrap gap-2 md:gap-2.5">
                                {skills.map((skill, i) => (
                                    <div key={i} className="px-3 md:px-4 py-1.5 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 text-[11px] md:text-xs font-semibold border border-slate-200 dark:border-slate-700 transition-colors cursor-default">
                                        {skill.name}
                                    </div>
                                ))}
                            </div>
                        </div>
                    ))}
                </main>

                {/* FOOTER */}
                <footer className="text-center" style={{ marginTop: '8rem', paddingBottom: '2rem' }}>
                    <p className="text-xs text-foreground/50">&copy; {currentYear} {profile.name}. {t.copyright}</p>
                </footer>
            </div>
        </>
    );
}
