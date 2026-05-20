<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Stack | {{ $profile['name'] }}</title>
    
    <!-- SEO Optimization -->
    <meta name="description" content="Detailed technical capabilities and tech stack of {{ $profile['name'] }}.">
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
        
        .bento-card {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(229, 231, 235, 0.6);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        
        .dark .bento-card {
            background: rgba(22, 27, 46, 0.6);
            border: 1px solid rgba(46, 53, 79, 0.5);
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="bg-[#f9fafb] dark:bg-dark-bg text-[#111827] dark:text-dark-text min-h-screen transition-colors duration-300 relative overflow-x-hidden w-full selection:bg-indigo-500 selection:text-white">

    <!-- Background Decorative Blobs Container -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0 hidden dark:block">
        <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-600/5 blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-600/5 blur-[120px]"></div>
    </div>

    <div id="app-container" class="max-w-4xl mx-auto px-4 pt-8 pb-4 relative z-10 flex flex-col min-h-screen">

        <!-- HEADER NAVIGATION -->
        <header class="mb-8 flex flex-col items-start">
            <a href="/" class="inline-flex items-center gap-1.5 text-xs text-slate-600 dark:text-slate-400 hover:text-indigo-600 font-semibold transition-colors cursor-pointer" aria-label="Back to portfolio home">
                <i class="fas fa-arrow-left text-[10px]"></i>
                <span>Back to Home</span>
            </a>
            <h1 class="text-2xl md:text-3xl font-bold text-black dark:text-white display-font mt-3">Tech Stack</h1>
        </header>

        <!-- SKILLS CATEGORIES GRID -->
        <main class="space-y-4">
            @foreach($techStack as $category => $skills)
                <div class="rounded-xl p-5 space-y-4 bg-white/60 dark:bg-slate-900/40 subtle-border">
                    <h2 class="text-lg md:text-xl font-bold text-black dark:text-white display-font">
                        {{ $category }}
                    </h2>
                    
                    <div class="flex flex-wrap gap-2 md:gap-2.5">
                        @foreach($skills as $skill)
                            <div class="px-3 md:px-4 py-1.5 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 text-[11px] md:text-xs font-semibold border border-slate-200 dark:border-slate-700 transition-colors cursor-default">
                                {{ $skill['name'] }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
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
