<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Lyshan Dave</title>
    
    <!-- Premium Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Instrument+Sans:400,500,600,700|Space+Grotesk:500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Initial Theme Setup script to prevent light-to-dark flash on load -->
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
        .error-glow {
            filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.15));
        }
        .dark .error-glow {
            filter: drop-shadow(0 0 35px rgba(99, 102, 241, 0.3));
        }
    </style>
</head>
<body class="bg-light-bg text-light-text dark:bg-dark-bg dark:text-dark-text min-h-screen transition-colors duration-300 relative overflow-hidden w-full flex items-center justify-center p-4">
    
    <!-- Ambient Decorative Glowing Blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <!-- Light Mode Blobs -->
        <div class="absolute top-[-10%] left-[-10%] w-[60vw] h-[60vw] rounded-full bg-indigo-400/10 blur-[130px] dark:hidden"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[60vw] h-[60vw] rounded-full bg-emerald-400/10 blur-[130px] dark:hidden"></div>
        
        <!-- Dark Mode Blobs (more vivid glowing cores) -->
        <div class="absolute top-[-20%] left-[-20%] w-[70vw] h-[70vw] rounded-full bg-indigo-900/15 blur-[160px] hidden dark:block"></div>
        <div class="absolute bottom-[-20%] right-[-20%] w-[70vw] h-[70vw] rounded-full bg-violet-950/20 blur-[160px] hidden dark:block"></div>
    </div>

    <!-- Main Container -->
    <div class="max-w-md w-full relative z-10 p-1" data-aos="zoom-in" data-aos-duration="600">
        <div class="bento-card p-8 text-center flex flex-col items-center justify-center relative overflow-hidden subtle-border">
            
            <!-- Error Icon container with glowing outline -->
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center mb-6 bg-indigo-50/50 dark:bg-indigo-950/30 border border-indigo-100/50 dark:border-indigo-900/30 text-3xl text-indigo-600 dark:text-indigo-400 error-glow animate-float">
                @yield('icon')
            </div>

            <!-- Error Status Code -->
            <div class="display-font text-8xl font-bold tracking-tighter text-indigo-600/90 dark:text-indigo-400/90 leading-none select-none mb-3">
                @yield('code')
            </div>

            <!-- Short error title -->
            <h1 class="display-font text-2xl font-bold mb-3 text-light-text dark:text-dark-text tracking-tight">
                @yield('message')
            </h1>

            <!-- Detailed context description -->
            <p class="text-sm text-light-muted dark:text-dark-muted mb-8 leading-relaxed max-w-sm">
                @yield('description')
            </p>

            <!-- Navigation Button -->
            <div class="w-full flex flex-col sm:flex-row gap-3 justify-center items-center">
                @yield('action')
            </div>

            <!-- Security footprint footer -->
            <div class="mt-8 pt-4 border-t border-light-card-border/30 dark:border-dark-card-border/30 w-full flex items-center justify-center gap-2 text-2xs text-light-muted/50 dark:text-dark-muted/40">
                <i class="fa-solid fa-shield-halved text-emerald-500/70"></i>
                <span>Secure Shield Active • ID: {{ substr(md5(request()->ip() . time()), 0, 8) }}</span>
            </div>
        </div>
    </div>

    <!-- Fade in body setup for animations -->
    <script>
        // Set standard fade-in behavior
        document.addEventListener('DOMContentLoaded', () => {
            if (window.AOS) {
                window.AOS.init({
                    once: true,
                    mirror: false
                });
            }
        });
    </script>
</body>
</html>
