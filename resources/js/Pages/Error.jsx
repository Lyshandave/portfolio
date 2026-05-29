import { useEffect } from 'react';

export default function Error({ status, title, message, description }) {
    useEffect(() => {
        // Initialize animations if any
        if (window.initializeAnimations) {
            window.initializeAnimations();
        }
    }, []);

    // Status code configurations
    const configs = {
        403: {
            title: 'Access Denied',
            code: '403',
            iconClass: 'fa-solid fa-user-shield text-amber-500',
            message: 'Security Blocked',
            description: 'Your request has been flagged and intercepted by our high-security firewall shield. If you believe this is an error, please try refreshing or verify your credentials.',
            actionText: 'Return to Portfolio',
            actionIcon: 'fa-solid fa-house-chimney',
            actionUrl: '/'
        },
        404: {
            title: 'Page Not Found',
            code: '404',
            iconClass: 'fa-solid fa-compass text-indigo-500',
            message: 'Page Not Found',
            description: 'The link you followed may be broken, or the page has been moved. Let\'s get you back to the portfolio so you can continue exploring.',
            actionText: 'Go Back Home',
            actionIcon: 'fa-solid fa-arrow-left-long',
            actionUrl: '/'
        },
        500: {
            title: 'Server Error',
            code: '500',
            iconClass: 'fa-solid fa-server text-rose-500',
            message: 'System Error',
            description: 'An unexpected error occurred on our server. The incident has been securely logged, and stack traces have been completely hidden for security protection.',
            actionText: 'Retry Home',
            actionIcon: 'fa-solid fa-rotate-right',
            actionUrl: '/'
        },
        501: {
            title: 'Not Implemented',
            code: '501',
            iconClass: 'fa-solid fa-code text-indigo-500',
            message: 'Not Implemented',
            description: 'The requested method or function is not supported or implemented on our secure server gateway. Please return home or check your connection.',
            actionText: 'Go Back Home',
            actionIcon: 'fa-solid fa-house-chimney',
            actionUrl: '/'
        },
        503: {
            title: 'Service Unavailable',
            code: '503',
            iconClass: 'fa-solid fa-screwdriver-wrench text-emerald-500',
            message: 'System Maintenance',
            description: 'We are temporarily offline conducting scheduled security hardening and upgrades. Our portfolio will be back online shortly.',
            actionText: 'Reload Page',
            actionIcon: 'fa-solid fa-arrows-rotate',
            actionUrl: 'reload'
        }
    };

    const statusConfig = configs[status] || {};

    // Default configuration fallback
    const config = {
        title: title || statusConfig.title || 'Error',
        code: statusConfig.code || (status ? String(status) : 'Error'),
        iconClass: statusConfig.iconClass || 'fa-solid fa-triangle-exclamation text-rose-500',
        message: message || statusConfig.message || 'Something went wrong',
        description: description || statusConfig.description || 'An error occurred while processing your request.',
        actionText: statusConfig.actionText || 'Return to Portfolio',
        actionIcon: statusConfig.actionIcon || 'fa-solid fa-house-chimney',
        actionUrl: statusConfig.actionUrl || '/'
    };

    const handleActionClick = (e) => {
        if (config.actionUrl === 'reload') {
            e.preventDefault();
            window.location.reload();
        }
    };

    return (
        <>
            <title>{config.title} | Lyshan Dave</title>
            <meta name="description" content={config.description} />
            <style dangerouslySetInnerHTML={{ __html: `
                body { font-family: 'Instrument Sans', sans-serif; }
                .display-font { font-family: 'Space Grotesk', 'Instrument Sans', sans-serif; }
                .error-glow { filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.15)); }
                .dark .error-glow { filter: drop-shadow(0 0 35px rgba(99, 102, 241, 0.3)); }
            `}} />

            <div className="bg-light-bg text-light-text dark:bg-dark-bg dark:text-dark-text min-h-screen transition-colors duration-300 relative overflow-hidden w-full flex items-center justify-center p-4">
                {/* Ambient Decorative Glowing Blobs */}
                <div className="fixed inset-0 overflow-hidden pointer-events-none z-0">
                    {/* Light Mode Blobs */}
                    <div className="absolute top-[-10%] left-[-10%] w-[60vw] h-[60vw] rounded-full bg-indigo-400/10 blur-[130px] dark:hidden"></div>
                    <div className="absolute bottom-[-10%] right-[-10%] w-[60vw] h-[60vw] rounded-full bg-emerald-400/10 blur-[130px] dark:hidden"></div>
                    
                    {/* Dark Mode Blobs */}
                    <div className="absolute top-[-20%] left-[-20%] w-[70vw] h-[70vw] rounded-full bg-indigo-900/15 blur-[160px] hidden dark:block"></div>
                    <div className="absolute bottom-[-20%] right-[-20%] w-[70vw] h-[70vw] rounded-full bg-violet-950/20 blur-[160px] hidden dark:block"></div>
                </div>

                {/* Main Container */}
                <div className="max-w-md w-full relative z-10 p-1" data-aos="zoom-in" data-aos-duration="600">
                    <div className="bento-card p-8 text-center flex flex-col items-center justify-center relative overflow-hidden subtle-border">
                        
                        {/* Error Icon container with glowing outline */}
                        <div className="w-20 h-20 rounded-2xl flex items-center justify-center mb-6 bg-indigo-50/50 dark:bg-indigo-950/30 border border-indigo-100/50 dark:border-indigo-900/30 text-3xl error-glow animate-float">
                            <i className={config.iconClass}></i>
                        </div>

                        {/* Error Status Code */}
                        <div className="display-font text-8xl font-bold tracking-tighter text-indigo-600/90 dark:text-indigo-400/90 leading-none select-none mb-3">
                            {config.code}
                        </div>

                        {/* Short error title */}
                        <h1 className="display-font text-2xl font-bold mb-3 text-light-text dark:text-dark-text tracking-tight">
                            {config.message}
                        </h1>

                        {/* Detailed context description */}
                        <p className="text-sm text-light-muted dark:text-dark-muted mb-8 leading-relaxed max-w-sm">
                            {config.description}
                        </p>

                        {/* Navigation Button */}
                        <div className="w-full flex flex-col sm:flex-row gap-3 justify-center items-center">
                            <a 
                                href={config.actionUrl === 'reload' ? '#' : config.actionUrl} 
                                onClick={handleActionClick}
                                className="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition-all duration-300 shadow-md hover:shadow-lg shadow-indigo-600/20 hover:scale-[1.02]"
                            >
                                <i className={`${config.actionIcon} mr-2`}></i>
                                <span>{config.actionText}</span>
                            </a>
                        </div>

                        {/* Security footprint footer */}
                        <div className="mt-8 pt-4 border-t border-light-card-border/30 dark:border-dark-card-border/30 w-full flex items-center justify-center gap-2 text-2xs text-light-muted/50 dark:text-dark-muted/40">
                            <i className="fa-solid fa-shield-halved text-emerald-500/70"></i>
                            <span>Secure Shield Active • ID: ERR-{config.code}</span>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
