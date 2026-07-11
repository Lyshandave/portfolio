import { Link } from '@inertiajs/react';
import { useEffect, useState } from 'react';

export default function Projects({ profile, projects }) {
    const currentYear = new Date().getFullYear();
    const t = {
        pageTitle: 'Projects',
        backToHome: 'Back to Home',
        allProjects: 'All Projects',
        visitSite: 'Visit site',
        copyright: 'All rights reserved.'
    };

    const projectsArray = Array.isArray(projects) ? projects : Object.values(projects);
    const [currentPage, setCurrentPage] = useState(1);
    const projectsPerPage = 4;
    
    const indexOfLastProject = currentPage * projectsPerPage;
    const indexOfFirstProject = indexOfLastProject - projectsPerPage;
    const currentProjects = projectsArray.slice(indexOfFirstProject, indexOfLastProject);
    const totalPages = Math.ceil(projectsArray.length / projectsPerPage);

    const handlePrev = () => {
        if (currentPage > 1) setCurrentPage(currentPage - 1);
    };

    const handleNext = () => {
        if (currentPage < totalPages) setCurrentPage(currentPage + 1);
    };

    useEffect(() => {
        if (window.initializeGlobalAnimations) window.initializeGlobalAnimations();
    }, []);

    return (
        <>
            <title>{t.pageTitle} | {profile.name}</title>
            <meta name="description" content={`All software development projects completed by ${profile.name}.`} />
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
                    <Link href="/" prefetch={['mount', 'hover']} className="inline-flex items-center gap-1.5 text-xs text-foreground/60 hover:text-indigo-500 font-semibold transition-colors cursor-pointer" aria-label="Back to portfolio home">
                        <i className="fas fa-arrow-left text-[10px]"></i>
                        <span>{t.backToHome}</span>
                    </Link>
                    <h1 className="text-2xl md:text-3xl font-bold text-black dark:text-white display-font mt-3">{t.allProjects}</h1>
                </header>

                {/* PROJECTS GRID */}
                <main className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {currentProjects.map((project, i) => (
                        <div key={project.slug} className="flex flex-col overflow-hidden rounded-xl bg-white/60 dark:bg-slate-900/40 subtle-border subtle-border-hover transition-all duration-300 group/project hover:shadow-lg">
                            <Link href={`/projects/${project.slug}`} prefetch="hover" className="block relative h-36 sm:h-44 w-full overflow-hidden bg-slate-100 dark:bg-slate-800 cursor-pointer">
                                <img
                                    src={`/${project.image}`}
                                    alt={project.title}
                                    className="w-full h-full object-cover group-hover/project:scale-105 transition-transform duration-500"
                                    onError={(e) => { e.target.onerror = null; e.target.style.display = 'none'; }}
                                />
                            </Link>
                            <div className="p-4 flex flex-col flex-grow justify-between space-y-3">
                                <Link href={`/projects/${project.slug}`} prefetch="hover" className="block space-y-2 cursor-pointer">
                                    <h3 className="text-base font-bold text-slate-950 dark:text-white group-hover/project:text-indigo-500 transition-colors">{project.title}</h3>
                                    <p className="text-xs md:text-sm text-slate-700 dark:text-slate-300 leading-relaxed line-clamp-2">{project.description}</p>
                                </Link>
                                <div className="mt-3 flex items-center justify-between">
                                    <Link href={`/projects/${project.slug}`} prefetch="hover" className="text-xs font-semibold text-slate-500 hover:text-indigo-500 transition-colors cursor-pointer">
                                        Case Study
                                    </Link>
                                    {project.demo && (
                                        <a
                                            href={project.demo}
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            className="inline-flex h-8 items-center rounded-lg bg-indigo-600 hover:bg-indigo-500 px-4 text-xs font-bold text-white gap-1.5 cursor-pointer border-b-2 border-indigo-800 shadow-[0_2px_4px_rgba(79,70,229,0.15)] hover:shadow-[0_4px_8px_rgba(79,70,229,0.25)] transition-all duration-100 transform hover:-translate-y-0.5 active:translate-y-0 active:border-b-0 active:mt-[2px] whitespace-nowrap"
                                        >
                                            <span>Visit Site</span>
                                            <i className="fas fa-chevron-right text-[8px] opacity-75"></i>
                                        </a>
                                    )}
                                </div>
                            </div>
                        </div>
                    ))}
                </main>

                {/* PAGINATION */}
                {totalPages > 1 && (
                    <div className="mt-10 mb-4 flex justify-center items-center gap-4">
                        <button 
                            onClick={handlePrev} 
                            disabled={currentPage === 1}
                            className={`w-10 h-10 flex items-center justify-center rounded-full border ${currentPage === 1 ? 'border-slate-200 text-slate-400 cursor-not-allowed dark:border-slate-800 dark:text-slate-600' : 'border-slate-300 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800'} transition-colors cursor-pointer`}
                            aria-label="Previous page"
                        >
                            <i className="fas fa-chevron-left text-sm"></i>
                        </button>
                        <span className="text-sm font-semibold text-slate-600 dark:text-slate-400">
                            {currentPage} / {totalPages}
                        </span>
                        <button 
                            onClick={handleNext} 
                            disabled={currentPage === totalPages}
                            className={`w-10 h-10 flex items-center justify-center rounded-full border ${currentPage === totalPages ? 'border-slate-200 text-slate-400 cursor-not-allowed dark:border-slate-800 dark:text-slate-600' : 'border-slate-300 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800'} transition-colors cursor-pointer`}
                            aria-label="Next page"
                        >
                            <i className="fas fa-chevron-right text-sm"></i>
                        </button>
                    </div>
                )}

                {/* FOOTER */}
                <footer className="text-center mt-auto pt-12 pb-8">
                    <p className="text-xs text-foreground/50">&copy; {currentYear} {profile.name}. {t.copyright}</p>
                </footer>
            </div>
        </>
    );
}
