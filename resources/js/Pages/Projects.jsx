import { Link } from '@inertiajs/react';
import { useEffect } from 'react';

export default function Projects({ profile, projects }) {
    const currentYear = new Date().getFullYear();

    useEffect(() => {
        if (window.initializeGlobalAnimations) window.initializeGlobalAnimations();
    }, []);

    return (
        <>
            <title>Projects | {profile.name}</title>
            <meta name="description" content={`All software development projects completed by ${profile.name}.`} />
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
                    <Link href="/" prefetch="hover" className="inline-flex items-center gap-1.5 text-xs text-foreground/60 hover:text-indigo-500 font-semibold transition-colors cursor-pointer" aria-label="Back to portfolio home">
                        <i className="fas fa-arrow-left text-[10px]"></i>
                        <span>Back to Home</span>
                    </Link>
                    <h1 className="text-2xl md:text-3xl font-bold text-black dark:text-white display-font mt-3">All Projects</h1>
                </header>

                {/* PROJECTS GRID */}
                <main className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {projects.map((project, i) => (
                        <a key={i} href={project.demo} target="_blank" className="block rounded-xl p-5 space-y-3 bg-white/60 dark:bg-slate-900/40 subtle-border subtle-border-hover transition-all duration-300 group hover:shadow-sm">
                            <div className="space-y-1">
                                <h3 className="text-base font-bold text-slate-950 dark:text-white transition-colors">{project.title}</h3>
                                <p className="text-xs md:text-sm text-slate-700 dark:text-slate-300 leading-relaxed">{project.description}</p>
                            </div>
                            <div className="flex flex-wrap gap-1.5 pt-1">
                                {project.technologies.map((tech, j) => (
                                    <span key={j} className="px-2 py-0.5 text-[11px] font-semibold rounded bg-slate-100 dark:bg-slate-800/80 subtle-border text-slate-700 dark:text-slate-300">{tech}</span>
                                ))}
                            </div>
                            <div className="pt-2 border-t border-slate-200/50 dark:border-slate-800/50 flex items-center justify-end">
                                <span className="text-xs text-slate-500 dark:text-slate-400 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors flex items-center gap-1 font-semibold">
                                    <span>Visit site</span>
                                    <i className="fas fa-external-link-alt text-[9px]"></i>
                                </span>
                            </div>
                        </a>
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
