import { Link } from '@inertiajs/react';
import { useEffect } from 'react';

export default function Certifications({ profile, all_certifications }) {
    const currentYear = new Date().getFullYear();

    useEffect(() => {
        if (window.initializeAnimations) window.initializeAnimations();
        if (window.initializeOtherScripts) window.initializeOtherScripts();
    }, []);

    return (
        <>
            <title>All Certifications | {profile.name}</title>
            <meta name="description" content={`Verified professional developer certifications of ${profile.name}.`} />
            <meta name="author" content={profile.name} />

            <style dangerouslySetInnerHTML={{ __html: `
                body { font-family: 'Instrument Sans', sans-serif; }
                .display-font { font-family: 'Space Grotesk', 'Instrument Sans', sans-serif; }
                .cert-card {
                    background: rgba(255, 255, 255, 0.6);
                    border: 1px solid rgba(0, 0, 0, 0.04);
                    border-radius: 12px;
                    padding: 24px;
                    transition: all 0.2s ease;
                    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.02);
                }
                .dark .cert-card {
                    background: rgba(22, 27, 46, 0.6);
                    border: 1px solid rgba(255, 255, 255, 0.05);
                    box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.3);
                }
                .cert-card:hover {
                    border-color: rgba(0, 0, 0, 0.08);
                    box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.03);
                }
                .dark .cert-card:hover {
                    border-color: rgba(255, 255, 255, 0.12);
                    box-shadow: 0 10px 30px 0 rgba(99, 102, 241, 0.1);
                }
            `}} />

            {/* Background Decorative Blobs Container */}
            <div className="fixed inset-0 overflow-hidden pointer-events-none z-0">
                <div className="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-400/5 dark:bg-indigo-600/5 blur-[120px]"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-400/5 dark:bg-emerald-600/5 blur-[120px]"></div>
            </div>

            <div id="app-container" className="max-w-4xl mx-auto px-4 pt-8 pb-4 relative z-10 flex flex-col min-h-screen">

                <header className="mb-8 flex flex-col items-start gap-2.5">
                    <Link href="/" prefetch="hover" className="inline-flex items-center gap-1.5 text-sm text-slate-700 dark:text-slate-300 hover:text-indigo-500 font-semibold transition-colors cursor-pointer" aria-label="Back to portfolio home">
                        <i className="fas fa-arrow-left text-xs"></i>
                        <span>Back to Home</span>
                    </Link>
                    <h1 className="text-xl md:text-2xl font-bold text-slate-950 dark:text-white display-font">All Certifications</h1>
                </header>

                {/* CERTIFICATIONS SECTIONS */}
                <main className="space-y-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16">
                        {all_certifications.map((cert, i) => (
                            <div key={i} className="rounded-xl p-5 bg-white/60 dark:bg-slate-900/40 subtle-border flex flex-col justify-between transition-all duration-300">
                                <div className="space-y-4">
                                    {/* Certificate Image Container */}
                                    <div className="w-full relative group/cert-img overflow-hidden rounded-lg subtle-border bg-slate-50 dark:bg-slate-950 flex items-center justify-center h-28">
                                        <img src={cert.image} alt={cert.title} className="max-w-[160px] max-h-full object-contain p-1 transition-transform duration-500 group-hover/cert-img:scale-105" />
                                        {/* Hover Overlay */}
                                        <a href={cert.url} target="_blank" className="absolute inset-0 bg-slate-950/40 opacity-0 group-hover/cert-img:opacity-100 transition-opacity flex items-center justify-center gap-2 text-white font-semibold text-xs backdrop-blur-xs cursor-pointer">
                                            <i className="fas fa-search-plus text-base"></i>
                                            <span>View Full Certificate</span>
                                        </a>
                                    </div>

                                    {/* Certificate Details */}
                                    <div className="space-y-2">
                                        <div className="flex items-start justify-between gap-3">
                                            <div>
                                                <h3 className="text-base md:text-lg font-bold text-slate-950 dark:text-white leading-tight display-font">{cert.title}</h3>
                                                <p className="text-xs text-slate-500 dark:text-slate-400 mt-0.5 font-semibold">{cert.issuer}</p>
                                            </div>
                                            <span className="px-2 py-0.5 text-[9px] font-bold tracking-wider uppercase rounded-full bg-emerald-100 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-300 shrink-0">Verified</span>
                                        </div>
                                        <p className="text-xs text-slate-700 dark:text-slate-300 leading-relaxed font-medium">{cert.description}</p>
                                    </div>
                                </div>

                                <div className="pt-3 border-t border-slate-200/50 dark:border-slate-800/50 mt-4 flex items-center justify-start">
                                    <a href={cert.url} target="_blank" className="inline-flex items-center gap-1.5 text-xs font-bold text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                        <i className="fas fa-external-link-alt text-[10px]"></i>
                                        <span>Open credential document</span>
                                    </a>
                                </div>
                            </div>
                        ))}
                    </div>
                </main>

                {/* FOOTER */}
                <footer className="text-center" style={{ marginTop: '8rem', paddingBottom: '2rem' }}>
                    <p className="text-xs text-foreground/50">&copy; {currentYear} {profile.name}. All rights reserved.</p>
                </footer>
            </div>
        </>
    );
}
