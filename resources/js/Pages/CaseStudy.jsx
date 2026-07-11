import { Link } from '@inertiajs/react';
import { useEffect } from 'react';

export default function CaseStudy({ profile, project }) {
    const currentYear = new Date().getFullYear();

    useEffect(() => {
        if (window.initializeGlobalAnimations) window.initializeGlobalAnimations();
    }, []);

    // Helper to render icon for tech stacks or standard items if needed
    const getTechIcon = (tech) => {
        const lowerTech = tech.toLowerCase();
        if (lowerTech.includes('laravel')) return 'fab fa-laravel text-red-500';
        if (lowerTech.includes('react')) return 'fab fa-react text-sky-400';
        if (lowerTech.includes('vue')) return 'fab fa-vuejs text-emerald-500';
        if (lowerTech.includes('php')) return 'fab fa-php text-indigo-400';
        if (lowerTech.includes('js') || lowerTech.includes('javascript')) return 'fab fa-js text-yellow-500';
        if (lowerTech.includes('ts') || lowerTech.includes('typescript')) return 'fas fa-code text-blue-500';
        if (lowerTech.includes('node')) return 'fab fa-node-js text-green-500';
        if (lowerTech.includes('python')) return 'fab fa-python text-blue-400';
        if (lowerTech.includes('postgres') || lowerTech.includes('sql') || lowerTech.includes('db')) return 'fas fa-database text-slate-500';
        if (lowerTech.includes('tailwind')) return 'fab fa-css3-alt text-teal-400';
        if (lowerTech.includes('cisco') || lowerTech.includes('packet')) return 'fas fa-network-wired text-blue-500';
        return 'fas fa-check-circle text-indigo-500';
    };

    return (
        <>
            <title>{project.title} Case Study | {profile.name}</title>
            <meta name="description" content={project.subtitle || project.description} />
            <meta name="author" content={profile.name} />

            <style>{`
                body { font-family: 'Instrument Sans', sans-serif; }
                .display-font { font-family: 'Space Grotesk', 'Instrument Sans', sans-serif; }
            `}</style>

            {/* Background Decorative Blobs Container */}
            <div className="fixed inset-0 overflow-hidden pointer-events-none z-0 dark:hidden">
                <div className="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-400/10 blur-[120px]"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-400/10 blur-[120px]"></div>
            </div>

            <div id="app-container" className="max-w-5xl mx-auto px-4 pt-8 pb-4 relative z-10 flex flex-col min-h-screen">
                
                {/* HEADER NAVIGATION */}
                <header className="mb-8 flex flex-col items-start">
                    <Link href="/" prefetch="hover" className="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-indigo-500 font-semibold transition-colors cursor-pointer" aria-label="Back to home">
                        <i className="fas fa-arrow-left text-[10px]"></i>
                        <span>Back to Home</span>
                    </Link>
                    
                    <div className="w-full flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-4">
                        <div className="space-y-1.5 max-w-2xl">
                            <h1 className="text-2xl md:text-4xl font-bold text-slate-900 dark:text-white display-font">{project.title}</h1>
                            <p className="text-sm md:text-base text-slate-600 dark:text-slate-400 leading-relaxed font-medium">{project.subtitle || project.description}</p>
                        </div>
                        {project.demo && (
                            <a 
                                href={project.demo} 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                className="inline-flex h-9 items-center justify-center rounded-lg bg-indigo-600 hover:bg-indigo-500 px-4 text-xs font-bold text-white gap-1.5 cursor-pointer border-b-2 border-indigo-800 shadow-[0_3px_6px_rgba(79,70,229,0.25)] hover:shadow-[0_5px_10px_rgba(79,70,229,0.35)] transition-all duration-100 transform hover:-translate-y-0.5 active:translate-y-0 active:border-b-0 active:mt-[2px] whitespace-nowrap self-start sm:self-center"
                            >
                                <i className="fas fa-external-link-alt text-[10px]"></i>
                                <span>Visit Site</span>
                            </a>
                        )}
                    </div>
                </header>

                {/* CASE STUDY CONTENT GRID */}
                <main className="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {/* LEFT COLUMN: METADATA, TECH STACK, KEY FEATURES */}
                    <div className="space-y-6">
                        
                        {/* PROJECT OVERVIEW CARD */}
                        <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-5 space-y-4 shadow-sm">
                            <h2 className="text-xs font-bold uppercase tracking-wider text-slate-400">Project Overview</h2>
                            <div className="divide-y divide-slate-100 dark:divide-slate-800/80">
                                {Object.entries(project.overview || {}).map(([key, value]) => (
                                    <div key={key} className="py-2.5 flex items-center justify-between text-xs md:text-sm">
                                        <span className="font-semibold text-slate-500 dark:text-slate-400">{key}</span>
                                        <span className="font-bold text-slate-900 dark:text-white text-right">{value}</span>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* TECH STACK CARD */}
                        <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-5 space-y-4 shadow-sm">
                            <h2 className="text-xs font-bold uppercase tracking-wider text-slate-400">Tech Stack</h2>
                            <div className="grid grid-cols-2 gap-2">
                                {project.technologies.map((tech, i) => (
                                    <div key={i} className="flex items-center gap-2 p-2 rounded-lg bg-slate-50 dark:bg-slate-900 border border-slate-150 dark:border-slate-800/80">
                                        <i className={`${getTechIcon(tech)} text-sm shrink-0`}></i>
                                        <span className="text-[11px] md:text-xs font-bold text-slate-800 dark:text-slate-200 truncate">{tech}</span>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* KEY FEATURES CARD */}
                        {project.key_features && (
                            <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-5 space-y-4 shadow-sm">
                                <h2 className="text-xs font-bold uppercase tracking-wider text-slate-400">Key Features</h2>
                                <div className="space-y-3">
                                    {project.key_features.map((feat, i) => (
                                        <div key={i} className="flex items-start gap-2.5">
                                            <i className={`${feat.icon || 'fas fa-check-circle'} text-indigo-500 mt-0.5 text-xs shrink-0`}></i>
                                            <div>
                                                <h3 className="text-xs font-bold text-slate-900 dark:text-white">{feat.title}</h3>
                                                <p className="text-[10px] leading-relaxed text-slate-500 dark:text-slate-400">{feat.text}</p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>

                    {/* RIGHT COLUMN: OBJECTIVES & INTERACTIVE SHOWCASE */}
                    <div className="md:col-span-2 space-y-6">
                        
                        {/* SYSTEM OBJECTIVES */}
                        {project.objectives && (
                            <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-6 space-y-4 shadow-sm">
                                <h2 className="text-lg font-bold text-slate-900 dark:text-white display-font">System Objectives</h2>
                                <div className="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    {project.objectives.map((obj, i) => {
                                        // Dynamic colors for objectives cards
                                        const bgColors = [
                                            'bg-indigo-50/50 dark:bg-indigo-950/20 border-indigo-100 dark:border-indigo-900/50',
                                            'bg-emerald-50/50 dark:bg-emerald-950/20 border-emerald-100 dark:border-emerald-900/50',
                                            'bg-purple-50/50 dark:bg-purple-950/20 border-purple-100 dark:border-purple-900/50'
                                        ];
                                        const textColors = [
                                            'text-indigo-850 dark:text-indigo-205',
                                            'text-emerald-850 dark:text-emerald-205',
                                            'text-purple-850 dark:text-purple-205'
                                        ];
                                        return (
                                            <div key={i} className={`p-4 rounded-xl border ${bgColors[i % 3]} space-y-1.5`}>
                                                <h3 className={`text-xs md:text-sm font-bold ${textColors[i % 3]}`}>{obj.title}</h3>
                                                <p className="text-[11px] leading-relaxed text-slate-650 dark:text-slate-400">{obj.text}</p>
                                            </div>
                                        );
                                    })}
                                </div>
                            </div>
                        )}

                        {/* SCREENSHOT & SHOWCASE SECTION */}
                        <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-6 space-y-6 shadow-sm">
                            <div className="space-y-1.5">
                                <h2 className="text-lg font-bold text-slate-900 dark:text-white display-font">Application Showcase</h2>
                                <p className="text-xs text-slate-500 dark:text-slate-400">Interactive live screen captures and operational highlights.</p>
                            </div>
                            
                            <div className="relative aspect-[16/10] w-full overflow-hidden rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-950 shadow-md">
                                <img 
                                    src={`/${project.image}`} 
                                    alt={project.title} 
                                    className="w-full h-full object-cover" 
                                    onError={(e) => { 
                                        e.target.style.display = 'none';
                                        e.target.nextSibling.style.display = 'flex';
                                    }}
                                />
                                <div className="absolute inset-0 hidden flex-col items-center justify-center bg-gradient-to-br from-indigo-500/10 to-purple-500/10 text-slate-400 dark:text-slate-650">
                                    <i className="fas fa-network-wired text-4xl mb-2 text-indigo-500/40"></i>
                                    <span className="text-xs font-semibold uppercase tracking-wider">{project.title} Showcase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                {/* FOOTER */}
                <footer className="text-center" style={{ marginTop: '8rem', paddingBottom: '2rem' }}>
                    <p className="text-xs text-slate-450">&copy; {currentYear} {profile.name}. All rights reserved.</p>
                </footer>
            </div>
        </>
    );
}
