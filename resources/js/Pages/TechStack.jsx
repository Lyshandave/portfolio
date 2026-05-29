import { Link } from '@inertiajs/react';
import { useEffect } from 'react';

export default function TechStack({ profile, techStack }) {
    const currentYear = new Date().getFullYear();

    useEffect(() => {
        if (window.initializeAnimations) window.initializeAnimations();
        if (window.initializeOtherScripts) window.initializeOtherScripts();
    }, []);

    return (
        <>
            <title>Tech Stack | {profile.name}</title>
            <meta name="description" content={`Detailed technical capabilities and tech stack of ${profile.name}.`} />
            <meta name="author" content={profile.name} />

            <style dangerouslySetInnerHTML={{ __html: `
                body { font-family: 'Instrument Sans', sans-serif; }
                .display-font { font-family: 'Space Grotesk', 'Instrument Sans', sans-serif; }
            `}} />

            {/* Background Decorative Blobs Container */}
            <div className="fixed inset-0 overflow-hidden pointer-events-none z-0 hidden dark:block">
                <div className="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-600/5 blur-[120px]"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-600/5 blur-[120px]"></div>
            </div>

            <div id="app-container" className="max-w-4xl mx-auto px-4 pt-8 pb-4 relative z-10 flex flex-col min-h-screen">

                {/* HEADER NAVIGATION */}
                <header className="mb-8 flex flex-col items-start">
                    <Link href="/" prefetch="hover" className="inline-flex items-center gap-1.5 text-xs text-slate-600 dark:text-slate-400 hover:text-indigo-600 font-semibold transition-colors cursor-pointer" aria-label="Back to portfolio home">
                        <i className="fas fa-arrow-left text-[10px]"></i>
                        <span>Back to Home</span>
                    </Link>
                    <h1 className="text-2xl md:text-3xl font-bold text-black dark:text-white display-font mt-3">Tech Stack</h1>
                </header>

                {/* SKILLS CATEGORIES GRID */}
                <main className="space-y-4">
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
                    <p className="text-xs text-foreground/50">&copy; {currentYear} {profile.name}. All rights reserved.</p>
                </footer>
            </div>
        </>
    );
}
