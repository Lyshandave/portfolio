<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Certifications | {{ $profile['name'] }}</title>
    
    <!-- SEO Optimization -->
    <meta name="description" content="Verified professional developer certifications of {{ $profile['name'] }}.">
    <meta name="author" content="{{ $profile['name'] }}">
    
    <!-- Premium Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Instrument+Sans:400,500,600,700|Space+Grotesk:500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Initial Theme Setup script to prevent flash -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || 
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
        .display-font {
            font-family: 'Space Grotesk', 'Instrument Sans', sans-serif;
        }
        
        /* Clean white card style exactly like Screenshot 2 */
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
    </style>
</head>
<body class="bg-[#f9fafb] dark:bg-dark-bg text-[#111827] dark:text-dark-text min-h-screen transition-colors duration-300 relative overflow-x-hidden w-full selection:bg-indigo-500 selection:text-white">

    <!-- Background Decorative Blobs Container -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-400/5 dark:bg-indigo-600/5 blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-400/5 dark:bg-emerald-600/5 blur-[120px]"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 pt-8 pb-4 relative z-10 flex flex-col min-h-screen">

        <header class="mb-8 flex flex-col items-start gap-2.5">
            <a href="/" class="inline-flex items-center gap-1.5 text-sm text-slate-700 dark:text-slate-300 hover:text-indigo-500 font-semibold transition-colors cursor-pointer" aria-label="Back to portfolio home">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Home</span>
            </a>
            <h1 class="text-xl md:text-2xl font-bold text-slate-950 dark:text-white display-font">All Certifications</h1>
        </header>

        <!-- CERTIFICATIONS SECTIONS -->
        <main class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16">
                @foreach($all_certifications as $cert)
                    <div class="rounded-xl p-5 bg-white/60 dark:bg-slate-900/40 subtle-border flex flex-col justify-between transition-all duration-300">
                        <div class="space-y-4">
                            <!-- Certificate Image Container -->
                            <div class="w-full relative group/cert-img overflow-hidden rounded-lg subtle-border bg-slate-50 dark:bg-slate-950 flex items-center justify-center h-28">
                                <img src="{{ $cert['image'] }}" alt="{{ $cert['title'] }}" class="max-w-[160px] max-h-full object-contain p-1 transition-transform duration-500 group-hover/cert-img:scale-105" />
                                
                                <!-- Hover Overlay to View Full Screen -->
                                <a href="{{ $cert['url'] }}" target="_blank" class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover/cert-img:opacity-100 transition-opacity flex items-center justify-center gap-2 text-white font-semibold text-xs backdrop-blur-xs cursor-pointer">
                                    <i class="fas fa-search-plus text-base"></i>
                                    <span>View Full Certificate</span>
                                </a>
                            </div>

                            <!-- Certificate Details -->
                            <div class="space-y-2">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h3 class="text-base md:text-lg font-bold text-slate-950 dark:text-white leading-tight display-font">
                                            {{ $cert['title'] }}
                                        </h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 font-semibold">
                                            {{ $cert['issuer'] }}
                                        </p>
                                    </div>
                                    <span class="px-2 py-0.5 text-[9px] font-bold tracking-wider uppercase rounded-full bg-emerald-100 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-300 flex-shrink-0">
                                        Verified
                                    </span>
                                </div>
                                <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed font-medium">
                                    {{ $cert['description'] }}
                                </p>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-200/50 dark:border-slate-800/50 mt-4 flex items-center justify-start">
                            <a href="{{ $cert['url'] }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                <i class="fas fa-external-link-alt text-[10px]"></i>
                                <span>Open credential document</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="text-center" style="margin-top: 8rem; padding-bottom: 2rem;">
            <p class="text-xs text-foreground/50">
                &copy; {{ date('Y') }} {{ $profile['name'] }}. All rights reserved.
            </p>
        </footer>

    </div>

</body>
</html>
