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
                    <Link href="/projects" prefetch="hover" className="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-indigo-500 font-semibold transition-colors cursor-pointer" aria-label="Back to projects">
                        <i className="fas fa-arrow-left text-[10px]"></i>
                        <span>View All Projects</span>
                    </Link>
                    
                    <div className="w-full flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-4">
                        <div className="space-y-1.5 max-w-2xl">
                            <h1 className="text-2xl md:text-4xl font-bold text-slate-900 dark:text-white display-font">{project.title}</h1>
                            <p className="text-sm md:text-base text-slate-600 dark:text-slate-400 leading-relaxed font-medium">{project.subtitle || project.description}</p>
                        </div>
                        <div className="flex flex-wrap gap-2 self-start sm:self-center">
                            {project.demo && (
                                <a 
                                    href={project.demo} 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    className="inline-flex h-9 items-center justify-center rounded-lg bg-indigo-600 hover:bg-indigo-500 px-4 text-xs font-bold text-white gap-1.5 cursor-pointer border-b-2 border-indigo-800 shadow-[0_3px_6px_rgba(79,70,229,0.25)] hover:shadow-[0_5px_10px_rgba(79,70,229,0.35)] transition-all duration-100 transform hover:-translate-y-0.5 active:translate-y-0 active:border-b-0 active:mt-[2px] whitespace-nowrap"
                                >
                                    <i className="fas fa-external-link-alt text-[10px]"></i>
                                    <span>Visit Site</span>
                                </a>
                            )}
                        </div>
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
                                {project.my_role && (
                                    <div className="py-2.5 flex items-start justify-between text-xs md:text-sm">
                                        <span className="font-semibold text-slate-500 dark:text-slate-400">My Role</span>
                                        <span className="font-bold text-slate-900 dark:text-white text-right max-w-[150px]">{project.my_role}</span>
                                    </div>
                                )}
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
                            <h2 className="text-xs font-bold uppercase tracking-wider text-slate-400">Tech Used</h2>
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
                        
                        {/* PROBLEM STATEMENT */}
                        {project.problem && (
                            <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-6 space-y-3 shadow-sm">
                                <h2 className="text-lg font-bold text-slate-900 dark:text-white display-font flex items-center gap-2">
                                    <i className="fas fa-exclamation-circle text-indigo-500"></i>
                                    <span>Problem Statement</span>
                                </h2>
                                <p className="text-xs md:text-sm leading-relaxed text-slate-750 dark:text-slate-300">{project.problem}</p>
                            </div>
                        )}

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
                                                <p className="text-[11px] leading-relaxed text-slate-600 dark:text-slate-400">{obj.text}</p>
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
                            
                            <div className="relative aspect-[16/10] w-full overflow-hidden rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-950 shadow-md group">
                                <a href={`/${project.image}`} target="_blank" rel="noopener noreferrer" className="block w-full h-full cursor-pointer">
                                    <img 
                                        src={`/${project.image}`} 
                                        alt={project.title} 
                                        className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                        onError={(e) => { 
                                            e.target.style.display = 'none';
                                            if (e.target.parentElement.nextSibling) {
                                                e.target.parentElement.nextSibling.style.display = 'flex';
                                            }
                                        }}
                                    />
                                    <div className="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <div className="bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-4 py-2 rounded-full shadow-xl flex items-center gap-2 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                            <i className="fas fa-expand text-indigo-600 dark:text-indigo-400 text-sm"></i>
                                            <span className="text-xs font-bold text-slate-800 dark:text-slate-200">View Full Image</span>
                                        </div>
                                    </div>
                                </a>
                                <div className="absolute inset-0 hidden flex-col items-center justify-center bg-gradient-to-br from-indigo-500/10 to-purple-500/10 text-slate-400 dark:text-slate-655 pointer-events-none">
                                    <i className="fas fa-network-wired text-4xl mb-2 text-indigo-500/40"></i>
                                    <span className="text-xs font-semibold uppercase tracking-wider">{project.title} Showcase</span>
                                </div>
                            </div>
                        </div>

                        {/* CHALLENGES & SOLUTION */}
                        {(project.challenges || project.solution) && (
                            <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-6 space-y-4 shadow-sm">
                                <h2 className="text-lg font-bold text-slate-900 dark:text-white display-font">Challenges & Solution</h2>
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    {project.challenges && (
                                        <div className="p-4 rounded-xl border border-red-100 dark:border-red-950/40 bg-red-50/20 dark:bg-red-950/10 space-y-1.5">
                                            <h3 className="text-xs md:text-sm font-bold text-red-800 dark:text-red-400 flex items-center gap-1.5">
                                                <i className="fas fa-tools"></i> Key Challenges
                                            </h3>
                                            <p className="text-[11px] md:text-xs leading-relaxed text-slate-700 dark:text-slate-350">{project.challenges}</p>
                                        </div>
                                    )}
                                    {project.solution && (
                                        <div className="p-4 rounded-xl border border-emerald-100 dark:border-emerald-950/40 bg-emerald-50/20 dark:bg-emerald-950/10 space-y-1.5">
                                            <h3 className="text-xs md:text-sm font-bold text-emerald-800 dark:text-emerald-400 flex items-center gap-1.5">
                                                <i className="fas fa-lightbulb"></i> Applied Solution
                                            </h3>
                                            <p className="text-[11px] md:text-xs leading-relaxed text-slate-700 dark:text-slate-350">{project.solution}</p>
                                        </div>
                                    )}
                                </div>
                            </div>
                        )}

                        {/* DEVELOPMENT PROCESS */}
                        {project.development_process && (
                            <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-6 space-y-4 shadow-sm">
                                <h2 className="text-lg font-bold text-slate-900 dark:text-white display-font">Development Process</h2>
                                <div className="relative border-l-2 border-indigo-500/20 dark:border-indigo-500/10 pl-5 ml-2.5 space-y-5">
                                    {project.development_process.map((step, i) => (
                                        <div key={i} className="relative">
                                            <div className="absolute -left-[27px] top-1 w-3 h-3 rounded-full bg-indigo-500 border-2 border-white dark:border-slate-950"></div>
                                            <span className="inline-block font-mono text-[9px] px-1.5 py-0.5 border border-indigo-150 dark:border-indigo-900/50 bg-indigo-50/50 dark:bg-indigo-950/30 text-indigo-700 dark:text-indigo-300 font-bold rounded mb-1">Step 0{i+1}</span>
                                            <div className="text-xs md:text-sm font-bold text-slate-800 dark:text-slate-200">{step}</div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        )}

                        {/* BOTTOM GRID FOR OUTCOMES */}
                        {(project.results || project.lessons_learned || project.future_improvements) && (
                            <div className="space-y-6">
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    {/* LESSONS LEARNED */}
                                    {project.lessons_learned && (
                                        <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-5 space-y-3.5 shadow-sm">
                                            <h3 className="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                                                <i className="fas fa-graduation-cap text-indigo-500"></i> Lessons Learned
                                            </h3>
                                            <ul className="space-y-2">
                                                {project.lessons_learned.map((les, i) => (
                                                    <li key={i} className="text-xs leading-relaxed text-slate-700 dark:text-slate-300 flex items-start gap-2">
                                                        <i className="fas fa-star text-[10px] text-indigo-500 mt-1 shrink-0"></i>
                                                        <span>{les}</span>
                                                    </li>
                                                ))}
                                            </ul>
                                        </div>
                                    )}

                                    {/* FUTURE IMPROVEMENTS */}
                                    {project.future_improvements && (
                                        <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-5 space-y-3.5 shadow-sm">
                                            <h3 className="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                                                <i className="fas fa-arrow-alt-circle-right text-purple-500"></i> Future Plans
                                            </h3>
                                            <ul className="space-y-2">
                                                {project.future_improvements.map((imp, i) => (
                                                    <li key={i} className="text-xs leading-relaxed text-slate-700 dark:text-slate-300 flex items-start gap-2">
                                                        <i className="fas fa-chevron-right text-[8px] text-purple-500 mt-1.5 shrink-0"></i>
                                                        <span>{imp}</span>
                                                    </li>
                                                ))}
                                            </ul>
                                        </div>
                                    )}
                                </div>

                                {/* RESULTS */}
                                {project.results && (
                                    <div className="rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-900/40 p-5 space-y-3.5 shadow-sm">
                                        <h3 className="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                                            <i className="fas fa-chart-line text-emerald-500"></i> Results
                                        </h3>
                                        <ul className="space-y-2">
                                            {project.results.map((res, i) => (
                                                <li key={i} className="text-xs leading-relaxed text-slate-700 dark:text-slate-300 flex items-start gap-2">
                                                    <i className="fas fa-check-circle text-[10px] text-emerald-500 mt-1 shrink-0"></i>
                                                    <span>{res}</span>
                                                </li>
                                            ))}
                                        </ul>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </main>

                {/* FOOTER */}
                <footer className="text-center" style={{ marginTop: '8rem', paddingBottom: '2rem' }}>
                    <p className="text-xs text-slate-400">&copy; {currentYear} {profile.name}. All rights reserved.</p>
                </footer>
            </div>
        </>
    );
}
