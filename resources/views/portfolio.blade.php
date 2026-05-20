<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile['name'] }} | Computer Systems Technician & Web Developer</title>
    
    <!-- SEO Optimization -->
    <meta name="description" content="Portfolio of {{ $profile['name'] }}, a certified Computer Systems Technician and Web Developer.">
    <meta name="keywords" content="Lyshan Dave, Computer Systems Technician, Web Developer, IT Support, Networking">
    <meta name="author" content="{{ $profile['name'] }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://lyshandave.com">
    <meta property="og:title" content="{{ $profile['name'] }} | Computer Systems Technician & Web Developer">
    <meta property="og:description" content="Portfolio of {{ $profile['name'] }}, a certified Computer Systems Technician and Web Developer.">
    <meta property="og:image" content="https://lyshandave.com/lyshandave.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://lyshandave.com">
    <meta property="twitter:title" content="{{ $profile['name'] }} | Computer Systems Technician & Web Developer">
    <meta property="twitter:description" content="Portfolio of {{ $profile['name'] }}, a certified Computer Systems Technician and Web Developer.">

    <!-- Premium Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Instrument+Sans:400,500,600,700|Space+Grotesk:500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $etag = md5(json_encode([
            'profile' => $profile ?? [],
            'experience' => $experience ?? [],
            'techStack' => $techStack ?? [],
            'projects' => $projects ?? [],
            'certifications' => $certifications ?? [],
        ]));
    @endphp
    <meta name="x-portfolio-etag" content="&quot;{{ $etag }}&quot;">

    <!-- Initial Theme Setup script to prevent light-to-dark flash on load -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || 
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@graph": [
            {
                "@@type": "Person",
                "@@id": "https://lyshandave.com/#person",
                "name": "{{ $profile['name'] }}",
                "jobTitle": "Software Engineer",
                "description": "Full-stack software engineer specializing in developing solutions with Javascript, Python, and PHP.",
                "image": "https://lyshandave.com/lyshandave.png",
                "sameAs": [
                    "https://linkedin.com/in/lyshandave",
                    "https://github.com/lyshandave",
                    "https://www.instagram.com/lyshan.dave/"
                ],
                "worksFor": {
                    "@@type": "Organization",
                    "name": "Cambridge"
                }
            },
            {
                "@@type": "WebSite",
                "@@id": "https://lyshandave.com/#website",
                "url": "https://lyshandave.com",
                "name": "{{ $profile['name'] }}",
                "description": "Portfolio of {{ $profile['name'] }}, a developer specializing in modern web technologies.",
                "publisher": {
                    "@@id": "https://lyshandave.com/#person"
                }
            }
        ]
    }
    </script>

    <style>
        /* Prevent transitions from flashing during page load */
        .preload * {
            -webkit-transition: none !important;
            -moz-transition: none !important;
            -ms-transition: none !important;
            -o-transition: none !important;
            transition: none !important;
        }

        /* Lenis Smooth Scroll styles */
        html.lenis, html.lenis body {
            height: auto;
        }
        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }
        .lenis.lenis-smooth [data-lenis-prevent] {
            overflow: clip;
        }
        .lenis.lenis-stopped {
            overflow: hidden;
        }
        .lenis.lenis-smooth iframe {
            pointer-events: none;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
        }
        .display-font {
            font-family: 'Space Grotesk', 'Instrument Sans', sans-serif;
        }
        
        /* Fade-in Animations scroll observer */
        .fade-in-section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
            will-change: opacity, transform;
        }
        .fade-in-section.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Glassmorphism custom rules for Light / Dark transitions */
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
        
        .bento-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
        }

        .dark .bento-card:hover {
            box-shadow: 0 10px 30px 0 rgba(99, 102, 241, 0.1);
            border-color: rgba(99, 102, 241, 0.4);
        }

        /* 3D card specific styles */
        .card-hover-shimmer-parent {
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .card-hover-shimmer-parent .card-hover-shimmer {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(
                120deg, 
                rgba(255, 255, 255, 0) 30%, 
                rgba(255, 255, 255, 0.15) 40%, 
                rgba(255, 255, 255, 0.2) 50%, 
                rgba(255, 255, 255, 0.15) 60%, 
                rgba(255, 255, 255, 0) 70%
            );
            background-size: 200% 100%;
            background-position: -200% 0;
            pointer-events: none;
            z-index: 5;
        }

        .card-hover-shimmer-parent:hover .card-hover-shimmer {
            animation: shimmer-effect 1.5s infinite linear;
        }

        @keyframes shimmer-effect {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body class="preload bg-light-bg text-light-text dark:bg-dark-bg dark:text-dark-text min-h-screen transition-colors duration-300 relative w-full selection:bg-indigo-500 selection:text-white">
    <!-- Remove preload class when page has loaded to re-enable transitions -->
    <script>
        window.addEventListener('load', function() {
            document.body.classList.remove('preload');
        });
    </script>

    <!-- Background Decorative Blobs Container -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0 dark:hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-400/10 blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-400/10 blur-[120px]"></div>
    </div>

    <div id="app-container" class="max-w-4xl mx-auto px-4 pt-8 pb-4 relative z-10 flex flex-col min-h-screen">

        <!-- PROFILE HERO SECTION -->
        <section class="mb-8 fade-in-section is-visible">
            <div class="flex items-center gap-4 md:gap-6">
                <!-- Profile Image Frame -->
                <div class="relative flex-shrink-0">
                    <!-- Light Mode (No Glasses) -->
                    <img alt="{{ $profile['name'] }}" fetchpriority="high" width="160" height="160" decoding="async" class="block dark:hidden rounded-lg w-32 h-32 md:w-40 md:h-40 object-cover border border-border/20 shadow-md" src="{{ asset('profile-frames/profile-light.png') }}" onerror="this.src='{{ asset('profile-frames/frame-000.png') }}'"/>
                    <!-- Dark Mode (With Sunglasses) -->
                    <img alt="{{ $profile['name'] }}" fetchpriority="high" width="160" height="160" decoding="async" class="hidden dark:block rounded-lg w-32 h-32 md:w-40 md:h-40 object-cover border border-border/20 shadow-md" src="{{ asset('profile-frames/profile-dark.png') }}" onerror="this.src='{{ asset('profile-frames/frame-000.png') }}'"/>
                    <div class="absolute inset-0 rounded-lg border-2 border-indigo-500/20 pointer-events-none"></div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl md:text-3xl font-bold truncate display-font">{{ $profile['name'] }}</h1>
                            <!-- Verified Badge -->
                            <svg viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" aria-label="Verified user">
                                <path d="M20.396 11c-.018-.646-.215-1.275-.57-1.816-.354-.54-.852-.972-1.438-1.246.223-.607.27-1.264.14-1.897-.131-.634-.437-1.218-.882-1.687-.47-.445-1.053-.75-1.687-.882-.633-.13-1.29-.083-1.897.14-.273-.587-.704-1.086-1.245-1.44S11.647 1.62 11 1.604c-.646.017-1.273.213-1.813.568s-.969.854-1.24 1.44c-.608-.223-1.267-.272-1.902-.14-.635.13-1.22.436-1.69.882-.445.47-.749 1.055-.878 1.688-.13.633-.08 1.29.144 1.896-.587.274-1.087.705-1.443 1.245-.356.54-.555 1.17-.574 1.817.02.647.218 1.276.574 1.817.356.54.856.972 1.443 1.245-.224.606-.274 1.263-.144 1.896.13.634.433 1.218.877 1.688.47.443 1.054.747 1.687.878.633.132 1.29.084 1.897-.136.274.586.705 1.084 1.246 1.439.54.354 1.17.551 1.816.569.647-.016 1.276-.213 1.817-.567s.972-.854 1.245-1.44c.604.239 1.266.296 1.903.164.636-.132 1.22-.447 1.68-.907.46-.46.776-1.044.908-1.681s.075-1.299-.165-1.903c.586-.274 1.084-.705 1.439-1.246.354-.54.551-1.17.569-1.816zM9.662 14.85l-3.429-3.428 1.293-1.302 2.072 2.072 4.4-4.794 1.347 1.246z" fill="#1d9bf0"></path>
                            </svg>
                        </div>
                        
                        <!-- Theme Toggle Button -->
                        <button id="theme-toggle" class="relative inline-flex h-[28px] w-[54px] items-center rounded-[2px] transition-colors duration-300 focus:outline-none bg-[#cbd1d8] dark:bg-[#475569] shrink-0" aria-label="Toggle theme">
                            <div class="absolute left-[2px] flex h-[24px] w-[24px] items-center justify-center rounded-[2px] bg-white transition-transform duration-300 ease-in-out dark:translate-x-[26px]">
                                <!-- Sun icon (shown in light mode) -->
                                <svg id="theme-toggle-sun" class="h-[14px] w-[14px] text-slate-500 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <!-- Moon icon (shown in dark mode) -->
                                <svg id="theme-toggle-moon" class="h-3 w-3 text-slate-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                            </div>
                        </button>
                    </div>

                    <p class="text-xs md:text-sm text-foreground/70 mt-1 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>{{ $profile['location'] }}</span>
                    </p>

                    <div class="flex items-center justify-between mt-2 flex-wrap gap-2">
                        <p class="text-xs md:text-sm font-medium">
                            Computer Systems Technician <span class="text-indigo-500/70 font-semibold">\</span> Web Developer
                        </p>
                    </div>

                    <!-- Call to Action Buttons -->
                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach($speakingContact as $contact)
                            @if(str_contains($contact['url'], 'calendly'))
                                <a target="_blank" rel="noopener noreferrer" class="inline-flex h-8 items-center rounded-lg bg-indigo-600 hover:bg-indigo-500 px-4 text-xs font-bold text-white gap-1.5 cursor-pointer border-b-2 border-indigo-800 shadow-[0_3px_6px_rgba(79,70,229,0.25)] hover:shadow-[0_5px_10px_rgba(79,70,229,0.35)] transition-all duration-100 transform hover:-translate-y-0.5 active:translate-y-0 active:border-b-0 active:mt-[2px]" href="{{ $contact['url'] }}">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>Schedule a Call</span>
                                    <i class="fas fa-chevron-right text-[10px] opacity-75"></i>
                                </a>
                            @elseif(str_contains($contact['url'], 'mailto'))
                                <a class="inline-flex h-8 items-center rounded-lg bg-white dark:bg-slate-800 px-4 text-xs font-bold text-slate-800 dark:text-slate-100 gap-1.5 cursor-pointer border border-slate-200 dark:border-slate-700 border-b-2 border-b-slate-300 dark:border-b-slate-900/80 shadow-[0_3px_6px_rgba(0,0,0,0.05)] hover:shadow-[0_5px_10px_rgba(0,0,0,0.08)] transition-all duration-100 transform hover:-translate-y-0.5 active:translate-y-0 active:border-b-[1px] active:mt-[1px]" href="{{ $contact['url'] }}">
                                    <i class="far fa-envelope text-indigo-500"></i>
                                    <span>Send Email</span>
                                </a>
                            @elseif(str_contains($contact['url'], 'blog'))
                                <a target="_blank" rel="noopener noreferrer" class="inline-flex h-8 items-center rounded-lg bg-white dark:bg-slate-800 px-4 text-xs font-bold text-slate-800 dark:text-slate-100 gap-1.5 flex-1 md:flex-none justify-between cursor-pointer border border-slate-200 dark:border-slate-700 border-b-2 border-b-slate-300 dark:border-b-slate-900/80 shadow-[0_3px_6px_rgba(0,0,0,0.05)] hover:shadow-[0_5px_10px_rgba(0,0,0,0.08)] transition-all duration-100 transform hover:-translate-y-0.5 active:translate-y-0 active:border-b-[1px] active:mt-[1px]" href="{{ $contact['url'] }}">
                                    <i class="fas fa-book-open text-indigo-500"></i>
                                    <span>Read my blog</span>
                                    <i class="fas fa-arrow-right text-[10px] opacity-75"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </section>

        <!-- BENTO GRID SYSTEM -->
        <section class="grid grid-cols-1 md:grid-cols-6 gap-2">

            <!-- ABOUT CARD (Col span 4) -->
            <div class="bento-card p-5 col-span-1 md:col-span-4 space-y-3 group fade-in-section is-visible">
                <h2 class="text-base font-bold uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-1.5">
                    <span>About</span>
                </h2>
                <div class="text-sm text-foreground/80 leading-relaxed space-y-4">
                    @foreach($profile['about'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>

            <!-- 3D INTERACTIVE ACCESS CARD (Col span 2) -->
            <div class="col-span-1 md:col-span-2 flex justify-center w-full fade-in-section is-visible">
                <div id="perspective-card" class="allow-rounded card-hover-shimmer-parent relative w-full max-w-[260px] overflow-hidden rounded-[12px] shadow-[0_4px_25px_rgba(0,0,0,0.15)] transition-transform duration-300 ease-out will-change-transform cursor-pointer aspect-[3/4]" role="link" tabindex="0">
                    <!-- Dark background gradient matching target -->
                    <div class="absolute inset-0 rounded-[12px]" style="background: linear-gradient(203.33deg, rgb(17, 17, 17) 1.16%, rgb(51, 51, 51) 14.27%, rgb(85, 85, 85) 34.09%, rgb(68, 68, 68) 53.64%, rgb(34, 34, 34) 80.17%, rgb(17, 17, 17) 100%)"></div>
                    
                    <!-- Glow shine overlay -->
                    <div id="card-glow" class="pointer-events-none absolute inset-0 rounded-[12px] z-10"></div>
                    
                    <!-- Shimmer highlight -->
                    <div class="card-hover-shimmer pointer-events-none absolute inset-0 rounded-[12px]"></div>
                    
                    <!-- Subtle glass borders -->
                    <div class="pointer-events-none absolute inset-0 z-20 rounded-[12px] border border-white/10"></div>
                    
                    <!-- Card Contents -->
                    <div class="absolute left-[20px] top-[30px] z-10 flex flex-col text-left">
                        <!-- Terminal icon mask -->
                        <div aria-hidden="true" class="h-[47px] w-[43px] bg-white" style="-webkit-mask-image:url('/card/terminal-icon.svg');mask-image:url('/card/terminal-icon.svg');-webkit-mask-size:contain;mask-size:contain;-webkit-mask-repeat:no-repeat;mask-repeat:no-repeat;-webkit-mask-position:center;mask-position:center"></div>
                        
                        <p class="mt-[15px] text-[15px] font-semibold tracking-[-0.01em] text-white font-sans uppercase">DEVS ONE HUNDRED</p>
                        <p class="mt-[2px] text-[9px] font-mono font-medium uppercase tracking-[0.05em] text-white/40">Access Card</p>
                        
                        <p class="mt-[50px] text-[9px] font-mono font-medium uppercase tracking-[0.05em] text-white/40">Founding Member</p>
                        <p class="mt-[2px] text-[13px] font-mono font-medium uppercase tracking-[0.05em] text-white">LYSHAN DAVE</p>
                    </div>
                    
                    <p class="absolute bottom-[20px] left-[20px] z-10 text-[9px] font-mono font-medium uppercase tracking-[0.05em] text-white/40">Developer</p>
                    
                    <!-- QR Code mask -->
                    <div aria-hidden="true" class="absolute bottom-[20px] right-[20px] z-10 h-[48px] w-[48px] bg-white opacity-40" style="-webkit-mask-image:url('/card/qr-code.svg');mask-image:url('/card/qr-code.svg');-webkit-mask-size:contain;mask-size:contain;-webkit-mask-repeat:no-repeat;mask-repeat:no-repeat;-webkit-mask-position:center;mask-position:center"></div>
                </div>
            </div>

            <!-- LEFT COLUMN WRAPPER (Col span 4) -->
            <div class="col-span-1 md:col-span-4 space-y-2 flex flex-col">
                <!-- TECH STACK CARD -->
                <div class="bento-card p-5 space-y-4 group fade-in-section is-visible">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-black dark:text-white display-font">Tech Stack</h2>
                        <a href="/tech-stack" id="tech-view-all" class="text-xs text-foreground/60 hover:text-indigo-500 font-semibold cursor-pointer flex items-center gap-1 transition-all" aria-label="View all capabilities">
                            <span>View All</span>
                            <i class="fas fa-chevron-right text-[9px]"></i>
                        </a>
                    </div>
                    
                    <div id="tech-stack-container" class="space-y-5">
                        @foreach($techStack as $category => $skills)
                            @if(in_array($category, ['Frontend', 'Backend']))
                                <div>
                                    <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200 mb-2">{{ $category }}</h3>
                                    <div class="flex flex-wrap gap-2 w-full">
                                        @foreach($skills as $skill)
                                            <span class="text-[13px] font-medium text-slate-800 dark:text-slate-200 px-3 py-1.5">
                                                {{ $skill['name'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- RECENT PROJECTS (Col span 4 in wrapper) -->
                <div class="bento-card p-5 space-y-4 group fade-in-section is-visible">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-black dark:text-white display-font">Recent Projects</h2>
                        <a href="/projects" id="projects-view-all" class="text-xs text-foreground/60 hover:text-indigo-500 font-semibold cursor-pointer flex items-center gap-1 transition-all" aria-label="View all projects">
                            <span>View All</span>
                            <i class="fas fa-chevron-right text-[9px]"></i>
                        </a>
                    </div>
                    
                    <div id="projects-container" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($projects as $project)
                            @if($project['featured'] ?? false)
                                <a href="{{ $project['demo'] }}" target="_blank" class="block bento-card py-2.5 px-3.5 space-y-1.5 border border-border/10 hover:border-slate-300 dark:hover:border-slate-700 transition-all duration-300 group">
                                    <div>
                                        <h3 class="text-sm md:text-base font-bold text-black dark:text-white transition-colors group-hover:text-black dark:group-hover:text-white">{{ $project['title'] }}</h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-300 mt-0.5 leading-relaxed">{{ $project['description'] }}</p>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- EXPERIENCE WIDGET (Col span 2) -->
            <div class="bento-card p-5 col-span-1 md:col-span-2 space-y-3 group fade-in-section is-visible self-start">
                <h2 class="text-lg font-bold text-black dark:text-white display-font">Experience</h2>
                
                <div id="experience-container" class="relative space-y-3 mt-2.5">
                    <!-- Timeline line -->
                    <div class="absolute left-1.5 top-1.5 bottom-2 w-px bg-slate-200 dark:bg-slate-800"></div>
                    
                    @foreach($experience as $exp)
                        <div class="relative pl-6 pb-2 last:pb-0 group/role experience-item cursor-pointer">
                            <!-- Marker Square -->
                            <div class="timeline-marker absolute left-0 top-1.5 w-3 h-3 border-2 rounded-none 
                                         {{ $exp['active'] ? 'border-slate-900 bg-slate-900 dark:border-white dark:bg-white' : 'border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900' }} 
                                         transition-colors duration-200">
                            </div>
                            
                            <div class="space-y-1">
                                <h3 class="text-xs md:text-sm font-bold leading-tight text-slate-900 dark:text-white transition-colors duration-200">
                                    {{ $exp['role'] }}
                                </h3>
                                
                                <div class="text-xs text-slate-700 dark:text-slate-300 font-medium leading-normal">
                                    {{ $exp['company'] }}
                                </div>
                                
                                <div class="pt-0.5">
                                    <span class="inline-block font-mono text-[10px] px-1.5 py-0.5 border border-slate-300 dark:border-slate-700 bg-slate-100/50 dark:bg-slate-800/50 text-slate-800 dark:text-slate-200 font-semibold rounded-[2px] whitespace-nowrap">
                                        {{ $exp['period'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- RECENT CERTIFICATIONS (Col span 3) -->
            <div class="bento-card py-3.5 px-4 col-span-1 md:col-span-3 space-y-3 group fade-in-section is-visible">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-1.5">
                        <span>Certifications</span>
                    </h2>
                    <a href="/certifications" class="text-xs font-semibold text-slate-500 hover:text-indigo-500 transition-colors flex items-center gap-1">
                        <span>View all</span>
                        <i class="fas fa-chevron-right text-[8px]"></i>
                    </a>
                </div>
                
                <div id="certifications-container" class="space-y-3 mt-4">
                    @foreach($certifications as $cert)
                        <a href="{{ $cert['credential_url'] ?? '#' }}" target="_blank" class="block py-2.5 px-3.5 rounded-lg subtle-border subtle-border-hover bg-white/60 dark:bg-slate-900/40 hover:bg-slate-50 dark:hover:bg-slate-900 transition-all duration-300 cursor-pointer">
                            <div class="flex items-center justify-between gap-2">
                                <div class="min-w-0">
                                    <h3 class="text-xs md:text-sm font-bold truncate text-slate-900 dark:text-white">{{ $cert['title'] }}</h3>
                                    <p class="text-[11px] text-slate-700 dark:text-slate-300 mt-0.5 font-semibold">{{ $cert['issuer'] }}</p>
                                </div>
                                <div class="flex items-center gap-1.5 flex-shrink-0">
                                    <span class="text-[9px] font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-full">
                                        Verified
                                    </span>
                                    <i class="fas fa-external-link-alt text-[9px] text-slate-400"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- RECOMMENDATIONS SLIDER (Col span 3) -->
            <div class="bento-card py-3.5 px-4 col-span-1 md:col-span-3 space-y-3 group overflow-hidden fade-in-section is-visible">
                <h2 class="text-base font-bold uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-1.5">
                    <span>Recommendations</span>
                </h2>
                
                <div class="relative overflow-hidden w-full h-[135px] mt-1.5">
                    <div id="testimonials-track" class="flex transition-transform duration-500 ease-out h-full" style="width: 100%;">
                        @foreach($recommendations as $rec)
                            <div class="w-full flex-shrink-0 flex flex-col justify-between h-full px-1">
                                <p class="text-[13px] leading-relaxed text-foreground/80 font-serif italic line-clamp-4">
                                    &ldquo;{{ $rec['text'] }}&rdquo;
                                </p>
                                
                                <div class="mt-2 pt-2 border-t border-border/30 flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-bold font-sans text-foreground/95">{{ $rec['name'] }}</p>
                                        <p class="text-[10px] text-foreground/50 font-sans mt-0.5">{{ $rec['role'] }} &bull; {{ $rec['company'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Testimonials Slider Controls -->
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-border/30">
                    <div id="testimonial-indicators" class="flex gap-1.5 items-center"></div>
                    <div class="flex gap-1">
                        <button id="testimonial-prev" class="p-1.5 text-foreground/50 hover:text-indigo-500 transition-all cursor-pointer" aria-label="Previous recommendation">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button id="testimonial-next" class="p-1.5 text-foreground/50 hover:text-indigo-500 transition-all cursor-pointer" aria-label="Next recommendation">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ASSOCIATIONS & SOCIAL CONNECTIONS (Col span 6) -->
            <div class="bento-card p-5 col-span-1 md:col-span-6 space-y-4 group fade-in-section is-visible">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    
                    <!-- Associations -->
                    <div class="flex flex-col justify-between space-y-2 col-span-1 md:col-span-1">
                        <p class="text-xs text-foreground/60 uppercase font-bold tracking-wider">Associations</p>
                        
                        <div class="space-y-1.5 flex-1 flex flex-col justify-center">
                             @foreach($associations as $assoc)
                                <a target="_blank" rel="noopener noreferrer" class="block p-3 rounded-lg bg-white/60 dark:bg-slate-900/40 subtle-border subtle-border-hover transition-all duration-200 group" href="{{ $assoc['url'] }}">
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="text-xs font-bold leading-tight text-slate-900 dark:text-white transition-colors">
                                            {{ $assoc['name'] }}
                                        </p>
                                        <i class="fas fa-external-link-alt text-[9px] text-slate-500 transition-transform group-hover:translate-x-0.5"></i>
                                    </div>
                                    <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 mt-1.5 block">{{ $assoc['role'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="space-y-2 col-span-1 md:col-span-1 flex flex-col justify-between">
                        <p class="text-xs text-foreground/60 uppercase font-bold tracking-wider">Social Links</p>
                        
                        <div class="grid grid-cols-1 gap-1.5 flex-1 justify-center flex flex-col">
                            @foreach($socialLinks as $platform => $social)
                                <a target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 p-2.5 rounded-lg bg-white/60 dark:bg-slate-900/40 subtle-border subtle-border-hover transition-all duration-200 group cursor-pointer" aria-label="Visit {{ $platform }} profile" href="{{ $social['url'] }}">
                                    <div class="text-slate-600 dark:text-slate-300 transition-colors">
                                        <i class="{{ $social['icon'] }} text-base"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-900 dark:text-white transition-colors">{{ $platform }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Speaking consult -->
                    <div class="space-y-2 col-span-1 md:col-span-1 flex flex-col justify-between">
                        <p class="text-xs text-foreground/60 uppercase font-bold tracking-wider">Speaking</p>
                        
                        <div class="p-3.5 rounded-lg bg-white/60 dark:bg-slate-900/40 subtle-border flex flex-col justify-between h-full flex-1">
                            <p class="text-xs text-slate-800 dark:text-slate-200 leading-relaxed font-medium">
                                Available for guest keynotes, panels, and tech tutorials relating to generative AI architectures, Laravel frameworks, and operational MLOps infrastructure.
                            </p>
                            <a class="text-xs font-bold text-slate-900 dark:text-white hover:underline inline-flex items-center gap-1 mt-3 transition-colors cursor-pointer" href="mailto:lyshandavet@gmail.com">
                                <span>Get in touch</span>
                                <i class="fas fa-arrow-right text-[9px]"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Speaking Contacts links list -->
                    <div class="space-y-1.5 col-span-1 md:col-span-1 flex flex-col justify-center">
                        @foreach($speakingContact as $contact)
                            <a target="_blank" rel="noopener noreferrer" class="group p-2.5 rounded-lg bg-white/60 dark:bg-slate-900/40 subtle-border subtle-border-hover transition-all duration-200 block cursor-pointer" href="{{ $contact['url'] }}">
                                <div class="flex items-center gap-1.5 mb-0.5 text-slate-900 dark:text-slate-100">
                                    @if(str_contains($contact['url'], 'mailto'))
                                        <i class="far fa-envelope text-xs text-slate-500 dark:text-slate-400"></i>
                                        <p class="text-[10px] text-slate-500 dark:text-slate-400 uppercase font-bold tracking-wide">EMAIL</p>
                                    @elseif(str_contains($contact['url'], 'calendly'))
                                        <i class="far fa-calendar-alt text-xs text-slate-500 dark:text-slate-400"></i>
                                        <p class="text-[10px] text-slate-500 dark:text-slate-400 uppercase font-bold tracking-wide">Consultation</p>
                                    @else
                                        <i class="fas fa-globe text-xs text-slate-500 dark:text-slate-400"></i>
                                        <p class="text-[10px] text-slate-500 dark:text-slate-400 uppercase font-bold tracking-wide">Technical Blog</p>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between gap-1 mt-1">
                                    <span class="text-xs font-bold text-slate-900 dark:text-white truncate">
                                        {{ $contact['title'] }}
                                    </span>
                                    <i class="fas fa-chevron-right text-[8px] text-slate-500 transition-transform group-hover:translate-x-0.5"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>

            <!-- GALLERY CAROUSEL (Col span 6) -->
            <div class="bento-card p-5 col-span-1 md:col-span-6 space-y-3 group overflow-hidden fade-in-section is-visible">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold uppercase tracking-wider text-slate-900 dark:text-white flex items-center gap-1.5">
                        <span>Gallery Highlights</span>
                    </h2>
                    <span class="text-xs text-foreground/50 font-medium">Events &amp; Workspaces</span>
                </div>
                
                <div class="relative w-full overflow-hidden mt-3">
                    <div id="gallery-track" class="flex gap-2.5 transition-transform duration-500 ease-out" style="width: 100%;">
                        <!-- Real high-quality developer-themed Unsplash images -->
                        @php
                            $galleryImages = [
                                'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=600&q=80',
                                'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80',
                                'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&q=80',
                                'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80',
                                'https://images.unsplash.com/photo-1600132806370-bf17e65e942f?auto=format&fit=crop&w=600&q=80',
                                'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=600&q=80',
                                'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=600&q=80',
                                'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=600&q=80',
                                'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80',
                                'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?auto=format&fit=crop&w=600&q=80'
                            ];
                        @endphp
                        @foreach($galleryImages as $index => $imgUrl)
                            <div class="relative flex-shrink-0 aspect-square overflow-hidden rounded-lg bg-foreground/5 border border-border/10 shadow-sm hover:border-indigo-500/30 transition-all duration-200 group/image cursor-pointer w-[48%] sm:w-[31%] md:w-[19%]">
                                <img alt="Gallery image {{ $index + 1 }}" loading="lazy" decoding="async" class="object-cover w-full h-full transition-transform duration-300 group-hover/image:scale-105" src="{{ $imgUrl }}"/>
                                <div class="absolute inset-0 bg-black/0 group-hover/image:bg-black/10 transition-colors duration-200"></div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Gallery Navigation Controls -->
                    <button id="gallery-prev" class="absolute left-1 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-card/85 text-foreground hover:bg-card border border-border/40 shadow-md hover:scale-110 transition-all duration-200 cursor-pointer" aria-label="Previous image">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button id="gallery-next" class="absolute right-1 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-card/85 text-foreground hover:bg-card border border-border/40 shadow-md hover:scale-110 transition-all duration-200 cursor-pointer" aria-label="Next image">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

        </section>

        <!-- FOOTER -->
        <footer class="border-t border-slate-200 dark:border-slate-800 text-center" style="margin-top: 2.5rem; padding-top: 2rem; padding-bottom: 2rem;">
            <p class="text-xs text-foreground/50">
                &copy; {{ date('Y') }} {{ $profile['name'] }}. All rights reserved.
            </p>
        </footer>

    </div>

    <!-- Lightbox Modal for Gallery -->
    <div id="gallery-lightbox" class="fixed inset-0 bg-[#5C6370]/95 z-[100] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 backdrop-blur-md">
        <button id="lightbox-close" class="absolute top-6 right-6 text-white hover:text-red-400 transition-colors p-2.5 text-2xl cursor-pointer z-[110]" aria-label="Close image view">
            <i class="fas fa-times"></i>
        </button>
        <button id="lightbox-prev" class="absolute left-4 md:left-8 text-white hover:text-slate-200 bg-white/10 hover:bg-white/20 rounded-full w-12 h-12 flex items-center justify-center transition-all cursor-pointer border border-white/10 shadow-lg z-[110]" aria-label="Previous image">
            <i class="fas fa-chevron-left text-lg"></i>
        </button>
        <button id="lightbox-next" class="absolute right-4 md:right-8 text-white hover:text-slate-200 bg-white/10 hover:bg-white/20 rounded-full w-12 h-12 flex items-center justify-center transition-all cursor-pointer border border-white/10 shadow-lg z-[110]" aria-label="Next image">
            <i class="fas fa-chevron-right text-lg"></i>
        </button>
        <div class="max-w-[90%] max-h-[85%] flex flex-col items-center z-40">
            <img id="lightbox-img" src="" alt="Viewed gallery image" class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl border border-white/10 transform scale-95 transition-transform duration-300">
            <p id="lightbox-caption" class="text-white text-xs font-mono mt-4 tracking-wider uppercase bg-white/10 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/10 shadow-sm"></p>
        </div>
    </div>

    <!-- Chatbot Toggle Button -->
    <button id="chatbot-toggle" class="fixed bottom-6 right-6 bg-[#111111] text-white px-4 py-2.5 rounded-lg shadow-xl flex items-center gap-2 hover:bg-black hover:-translate-y-1 transition-all duration-300 z-50 border border-white/10" aria-label="Toggle chatbot">
        <i id="chatbot-toggle-icon" class="fas fa-comment-dots text-[15px]"></i>
        <span class="font-medium text-[13px] tracking-wide">Chat with Lyshan</span>
    </button>

    <!-- Chatbot Window -->
    <div id="chatbot-window" class="fixed bottom-24 right-6 w-[380px] bg-white border border-slate-200 shadow-2xl z-50 flex flex-col opacity-0 translate-y-10 pointer-events-none transition-all duration-300 transform origin-bottom-right rounded-t-xl rounded-b-md">
        <!-- Chatbot Header -->
        <div class="bg-white p-4 flex items-center justify-between border-b border-slate-200 rounded-t-xl">
            <div class="flex items-center gap-3">
                <div class="relative w-10 h-10 flex-shrink-0">
                    <img src="{{ asset('profile-frames/profile-light.png') }}" alt="Lyshan" class="block dark:hidden w-10 h-10 rounded-full object-cover">
                    <img src="{{ asset('profile-frames/profile-dark.png') }}" alt="Lyshan" class="hidden dark:block w-10 h-10 rounded-full object-cover">
                </div>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Chat with Lyshan</h3>
                    <p class="text-xs text-slate-600 flex items-center gap-1.5 mt-0.5">
                        <span class="w-2 h-2 rounded-sm bg-green-500"></span> Online
                    </p>
                </div>
            </div>
            <button id="chatbot-close" class="text-slate-500 hover:text-slate-800 p-1 transition-colors">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Chatbot Body -->
        <style>
            #chatbot-messages::-webkit-scrollbar { display: none; }
        </style>
        <div id="chatbot-messages" class="h-[380px] overflow-y-auto p-5 space-y-5 bg-[#f9f9f9]" style="scrollbar-width: none; -ms-overflow-style: none;">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <div class="relative w-5 h-5 flex-shrink-0">
                        <img src="{{ asset('profile-frames/profile-light.png') }}" alt="Lyshan" class="block dark:hidden w-5 h-5 rounded-full object-cover">
                        <img src="{{ asset('profile-frames/profile-dark.png') }}" alt="Lyshan" class="hidden dark:block w-5 h-5 rounded-full object-cover">
                    </div>
                    <span class="text-xs font-medium text-slate-700">Lyshan Dave</span>
                </div>
                <div class="bg-[#f0f0f0] p-4 rounded-lg text-[14px] text-slate-800 max-w-[90%] leading-relaxed inline-block">
                    Hi there! 👋 Thanks for visiting my website. Feel free to ask me anything about programming, web development, or my experiences in tech. Let me know how I can help!
                </div>
            </div>
        </div>

        <!-- Chatbot Input -->
        <div class="p-4 bg-white border-t border-slate-200 rounded-b-md">
            <form id="chatbot-form" class="relative">
                <div class="flex items-stretch gap-2 mb-2">
                    <input type="text" id="chatbot-input" placeholder="Type a message..." class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-slate-400 placeholder:text-slate-400" autocomplete="off" maxlength="1000">
                    <button type="submit" class="w-10 h-[38px] flex items-center justify-center bg-slate-500 hover:bg-slate-600 text-white rounded flex-shrink-0 transition-colors" aria-label="Send message">
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </div>
                <div class="flex items-center justify-between text-[11px] text-slate-500">
                    <span>Ask me about programming, web dev, or tech!</span>
                    <span id="chatbot-char-count">0/1000</span>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chatbotToggle = document.getElementById('chatbot-toggle');
            const chatbotClose = document.getElementById('chatbot-close');
            const chatbotWindow = document.getElementById('chatbot-window');
            const chatbotForm = document.getElementById('chatbot-form');
            const chatbotInput = document.getElementById('chatbot-input');
            const chatbotMessages = document.getElementById('chatbot-messages');
            const charCount = document.getElementById('chatbot-char-count');
            const getAvatarUrl = () => document.documentElement.classList.contains('dark') ? "{{ asset('profile-frames/profile-dark.png') }}" : "{{ asset('profile-frames/profile-light.png') }}";

            function toggleChat(e) {
                if(e) e.preventDefault();
                const isActive = chatbotWindow.classList.contains('opacity-100');
                const toggleIcon = document.getElementById('chatbot-toggle-icon');
                
                if (isActive) {
                    chatbotWindow.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    chatbotWindow.classList.add('opacity-0', 'translate-y-10', 'pointer-events-none');
                    toggleIcon.classList.remove('fa-times');
                    toggleIcon.classList.add('fa-comment-dots');
                } else {
                    chatbotWindow.classList.remove('opacity-0', 'translate-y-10', 'pointer-events-none');
                    chatbotWindow.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    toggleIcon.classList.remove('fa-comment-dots');
                    toggleIcon.classList.add('fa-times');
                    setTimeout(() => chatbotInput.focus(), 300);
                }
            }

            chatbotToggle.addEventListener('click', toggleChat);
            if (chatbotClose) chatbotClose.addEventListener('click', toggleChat);

            chatbotInput.addEventListener('input', () => {
                charCount.textContent = `${chatbotInput.value.length}/1000`;
            });

            async function getBotResponse(message) {
                const msg = message.toLowerCase();
                
                // Conversational
                if (msg.includes("hello") || msg.includes("hi") || msg.includes("hey") || msg.includes("uy")) return "Hello! 👋 Ako ang AI assistant ni Lyshan. Ano ang maitutulong ko sayo ngayon?";
                if (msg.includes("kumusta") || msg.includes("kamusta") || msg.includes("how are you")) return "Okay naman ako, salamat sa pagtatanong! Handa akong sagutin ang mga tanong mo tungkol sa skills at projects ni Lyshan.";
                if (msg.includes("sino ka") || msg.includes("who are you") || msg.includes("pangalan")) return "Ako ang virtual assistant ni Lyshan. Nandito ako para i-guide ka sa kanyang portfolio!";
                if (msg.includes("sino si") || msg.includes("who is lyshan") || msg.includes("lyshan")) return "Si Lyshan Dave ay isang magaling na Computer Systems Technician at Web Developer mula sa Metro Manila.";

                // Portfolio
                if (msg.includes("skill") || msg.includes("tech") || msg.includes("alam") || msg.includes("marunong") || msg.includes("language")) return "Marunong si Lyshan sa Frontend (React, Tailwind), Backend (Laravel, Node.js), pati na rin sa PC Troubleshooting at Networking.";
                if (msg.includes("project") || msg.includes("gawa") || msg.includes("portfolio")) return "Nakagawa na siya ng Ordering System, Inventory System, at School Management System. Tingnan mo yung 'Projects' section sa taas!";
                if (msg.includes("contact") || msg.includes("email") || msg.includes("hire") || msg.includes("usap") || msg.includes("number")) return "Pwede mong ma-contact si Lyshan sa lyshandavet@gmail.com o mag-schedule ng meeting gamit ang Calendly link sa footer.";
                if (msg.includes("aral") || msg.includes("school") || msg.includes("education") || msg.includes("graduate") || msg.includes("college")) return "Nag-aral si Lyshan ng BS Computer Science at may certifications din siya from Cisco at TESDA (Computer Systems Servicing).";
                if (msg.includes("work") || msg.includes("trabaho") || msg.includes("experience") || msg.includes("job")) return "May experience si Lyshan bilang Web Developer sa Core Technology & PocketDevs, at naging Computer Systems Servicing rin sa GCM Tech Services.";
                if (msg.includes("thank") || msg.includes("salamat")) return "Walang anuman! Sabihin mo lang kung may kailangan ka pa.";
                if (msg.includes("haha") || msg.includes("hehe") || msg.includes("lol")) return "Hehe! Nakakatuwa ba? Ano pang gusto mong malaman tungkol kay Lyshan?";
                
                // Fallback to Wikipedia API for general knowledge questions
                try {
                    const res = await fetch(`https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=${encodeURIComponent(message)}&utf8=&format=json&origin=*`);
                    const data = await res.json();
                    if (data.query.search && data.query.search.length > 0) {
                        const snippet = data.query.search[0].snippet.replace(/(<([^>]+)>)/gi, "");
                        const txt = document.createElement("textarea");
                        txt.innerHTML = snippet;
                        return `Ayon sa web: ${txt.value}... Baka may iba ka pang tanong tungkol kay Lyshan?`;
                    }
                } catch(e) {}
                
                const fallbacks = [
                    "Pasensya na, hindi ko masyadong naintindihan. Pero alam mo ba na magaling si Lyshan sa Laravel at Networking?",
                    "Medyo out of scope 'yan sa ngayon! 😅 Gusto mo bang pag-usapan ang mga projects ni Lyshan?",
                    "Wala akong sagot diyan ngayon, pero pwede mong i-email si Lyshan kung gusto mong makipag-usap ng personal!"
                ];
                return fallbacks[Math.floor(Math.random() * fallbacks.length)];
            }

            chatbotForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const message = chatbotInput.value.trim();
                if (!message) return;

                appendMessage('user', message);
                chatbotInput.value = '';
                charCount.textContent = '0/1000';

                const typingId = 'typing-' + Date.now();
                appendTypingIndicator(typingId);

                setTimeout(async () => {
                    const response = await getBotResponse(message);
                    removeTypingIndicator(typingId);
                    appendMessage('bot', response);
                }, 800 + Math.random() * 1000);
            });

            function appendTypingIndicator(id) {
                const msgDiv = document.createElement('div');
                msgDiv.id = id;
                msgDiv.innerHTML = `
                    <div class="flex items-center gap-2 mb-1.5 mt-4">
                        <img src="${getAvatarUrl()}" alt="Lyshan" class="w-5 h-5 rounded-full object-cover">
                        <span class="text-xs font-medium text-slate-700">Lyshan Dave is typing...</span>
                    </div>
                    <div class="bg-[#f0f0f0] p-4 rounded-lg text-[14px] text-slate-800 inline-flex gap-1.5 items-center h-[52px]">
                        <div class="w-2 h-2 bg-slate-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.15s"></div>
                        <div class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
                    </div>
                `;
                chatbotMessages.appendChild(msgDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }

            function removeTypingIndicator(id) {
                const el = document.getElementById(id);
                if (el) el.remove();
            }

            function appendMessage(sender, text) {
                const msgDiv = document.createElement('div');
                
                if (sender === 'user') {
                    msgDiv.className = 'flex justify-end mt-4';
                    msgDiv.innerHTML = `<div class="bg-slate-800 text-white p-3 rounded-lg text-[14px] max-w-[90%] leading-relaxed inline-block">${text}</div>`;
                } else {
                    msgDiv.innerHTML = `
                        <div class="flex items-center gap-2 mb-1.5 mt-4">
                            <img src="${getAvatarUrl()}" alt="Lyshan" class="w-5 h-5 rounded-full object-cover">
                            <span class="text-xs font-medium text-slate-700">Lyshan Dave</span>
                        </div>
                        <div class="bg-[#f0f0f0] p-4 rounded-lg text-[14px] text-slate-800 max-w-[90%] leading-relaxed inline-block">
                            ${text}
                        </div>
                    `;
                }
                
                chatbotMessages.appendChild(msgDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }
        });
    </script>

    {{-- ================================================================== --}}
    {{-- HIGH-PERFORMANCE REAL-TIME SYNC ENGINE (ETag + Stale-While-Revalidate) --}}
    {{-- ================================================================== --}}
    <script>
    (function() {
        'use strict';

        const SYNC_API = '/api/v1/portfolio-data';
        const CACHE_KEY = 'portfolio_data_cache';
        const ETAG_KEY = 'portfolio_data_etag';
        const SYNC_INTERVAL = 30000; // 30 seconds

        // XSS-safe text escaper
        function esc(str) {
            const d = document.createElement('div');
            d.appendChild(document.createTextNode(str || ''));
            return d.innerHTML;
        }

        // Get current ETag from page meta or localStorage
        function getCurrentETag() {
            const meta = document.querySelector('meta[name="x-portfolio-etag"]');
            return meta ? meta.getAttribute('content') : localStorage.getItem(ETAG_KEY) || '';
        }

        // Smooth fade-in animation for updated elements
        function fadeInElement(el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(8px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            requestAnimationFrame(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            });
        }

        // Re-render Experience timeline with new data
        function renderExperience(data) {
            const container = document.getElementById('experience-container');
            if (!container || !data) return;

            container.innerHTML = '';

            // Timeline line
            const line = document.createElement('div');
            line.className = 'absolute left-1.5 top-1.5 bottom-2 w-px bg-slate-200 dark:bg-slate-800';
            container.appendChild(line);

            data.forEach(exp => {
                const isActive = exp.active;
                const item = document.createElement('div');
                item.className = 'relative pl-6 pb-2 last:pb-0 group/role experience-item cursor-pointer';

                const markerClass = isActive
                    ? 'border-slate-900 bg-slate-900 dark:border-white dark:bg-white'
                    : 'border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900';

                item.innerHTML = `
                    <div class="timeline-marker absolute left-0 top-1.5 w-3 h-3 border-2 rounded-none ${markerClass} transition-colors duration-200"></div>
                    <div class="space-y-1">
                        <h3 class="text-xs md:text-sm font-bold leading-tight text-slate-900 dark:text-white transition-colors duration-200">${esc(exp.role)}</h3>
                        <div class="text-xs text-slate-700 dark:text-slate-300 font-medium leading-normal">${esc(exp.company)}</div>
                        <div class="pt-0.5">
                            <span class="inline-block font-mono text-[10px] px-1.5 py-0.5 border border-slate-300 dark:border-slate-700 bg-slate-100/50 dark:bg-slate-800/50 text-slate-800 dark:text-slate-200 font-semibold rounded-[2px] whitespace-nowrap">${esc(exp.period)}</span>
                        </div>
                    </div>
                `;
                container.appendChild(item);
                fadeInElement(item);
            });
        }

        // Re-render Projects grid with new data
        function renderProjects(data) {
            const container = document.getElementById('projects-container');
            if (!container || !data) return;

            container.innerHTML = '';
            data.forEach(project => {
                if (!project.featured) return;
                const card = document.createElement('a');
                card.href = project.demo || '#';
                card.target = '_blank';
                card.className = 'block bento-card py-2.5 px-3.5 space-y-1.5 border border-border/10 hover:border-slate-300 dark:hover:border-slate-700 transition-all duration-300 group';
                card.innerHTML = `
                    <div>
                        <h3 class="text-sm md:text-base font-bold text-black dark:text-white transition-colors group-hover:text-black dark:group-hover:text-white">${esc(project.title)}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-300 mt-0.5 leading-relaxed">${esc(project.description)}</p>
                    </div>
                `;
                container.appendChild(card);
                fadeInElement(card);
            });
        }

        // Re-render Certifications list with new data
        function renderCertifications(data) {
            const container = document.getElementById('certifications-container');
            if (!container || !data) return;

            container.innerHTML = '';
            data.forEach(cert => {
                const card = document.createElement('a');
                card.href = cert.credential_url || '#';
                card.target = '_blank';
                card.className = 'block py-2.5 px-3.5 rounded-lg subtle-border subtle-border-hover bg-white/60 dark:bg-slate-900/40 hover:bg-slate-50 dark:hover:bg-slate-900 transition-all duration-300 cursor-pointer';
                card.innerHTML = `
                    <div class="flex items-center justify-between gap-2">
                        <div class="min-w-0">
                            <h3 class="text-xs md:text-sm font-bold truncate text-slate-900 dark:text-white">${esc(cert.title)}</h3>
                            <p class="text-[11px] text-slate-700 dark:text-slate-300 mt-0.5 font-semibold">${esc(cert.issuer)}</p>
                        </div>
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <span class="text-[9px] font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-full">Verified</span>
                            <i class="fas fa-external-link-alt text-[9px] text-slate-400"></i>
                        </div>
                    </div>
                `;
                container.appendChild(card);
                fadeInElement(card);
            });
        }

        // Re-render Tech Stack with new data
        function renderTechStack(data) {
            const container = document.getElementById('tech-stack-container');
            if (!container || !data) return;

            container.innerHTML = '';
            ['Frontend', 'Backend'].forEach(category => {
                const skills = data[category];
                if (!skills) return;
                const section = document.createElement('div');
                section.innerHTML = `<h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200 mb-2">${esc(category)}</h3>`;
                const wrap = document.createElement('div');
                wrap.className = 'flex flex-wrap gap-2 w-full';
                skills.forEach(skill => {
                    const span = document.createElement('span');
                    span.className = 'text-[13px] font-medium text-slate-800 dark:text-slate-200 px-3 py-1.5';
                    span.textContent = skill.name;
                    wrap.appendChild(span);
                });
                section.appendChild(wrap);
                container.appendChild(section);
                fadeInElement(section);
            });
        }

        // Apply all data updates to the DOM
        function applyUpdates(data) {
            if (data.experience) renderExperience(data.experience);
            if (data.projects) renderProjects(data.projects);
            if (data.certifications) renderCertifications(data.certifications);
            if (data.techStack) renderTechStack(data.techStack);
        }

        // Dynamic Anti-DDoS Token generator (cycles every 10s)
        function updateDdosToken() {
            const tokenEl = document.getElementById('ddos-token');
            if (!tokenEl) return;
            const randPart = Math.random().toString(36).substring(2, 8).toUpperCase();
            const timePart = Date.now().toString(36).slice(-4).toUpperCase();
            tokenEl.textContent = `TOK-${randPart}-${timePart}`;
        }

        // Deflected scraper counters (increments slowly in real-time)
        let deflectedCount = parseInt(localStorage.getItem('ddos_deflected_count')) || 1420;
        function updateThreatCounter() {
            const threatEl = document.getElementById('live-threats');
            if (!threatEl) return;
            // Dynamic small increments to simulate real-time shielding activity
            if (Math.random() > 0.4) {
                deflectedCount += Math.floor(Math.random() * 2) + 1;
                localStorage.setItem('ddos_deflected_count', deflectedCount);
            }
            threatEl.textContent = deflectedCount.toLocaleString();
        }

        // Background sync with ETag conditional request
        async function syncPortfolio() {
            const latencyEl = document.getElementById('live-latency');
            const startTime = performance.now();
            try {
                const etag = getCurrentETag();
                const headers = { 'Accept': 'application/json' };
                if (etag) headers['If-None-Match'] = etag;

                const response = await fetch(SYNC_API, { headers, cache: 'no-cache' });

                // Calculate sync performance latency in milliseconds
                const endTime = performance.now();
                if (latencyEl) {
                    latencyEl.textContent = `${Math.round(endTime - startTime)} ms`;
                }

                if (response.status === 304) {
                    // Data unchanged — ultra-fast path, no work needed
                    return;
                }

                if (response.ok) {
                    const newData = await response.json();
                    const newEtag = response.headers.get('ETag') || '';

                    // Cache in localStorage for next instant paint
                    localStorage.setItem(CACHE_KEY, JSON.stringify(newData));
                    localStorage.setItem(ETAG_KEY, newEtag);

                    // Live-morph the DOM with fresh data
                    applyUpdates(newData);
                }
            } catch (e) {
                if (latencyEl) latencyEl.textContent = '-- ms';
            }
        }

        // Boot: initial sync + recurring intervals
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(syncPortfolio, 1000);
                updateDdosToken();
                updateThreatCounter();
            });
        } else {
            setTimeout(syncPortfolio, 1000);
            updateDdosToken();
            updateThreatCounter();
        }

        // Recurring updates
        setInterval(syncPortfolio, SYNC_INTERVAL);
        setInterval(updateDdosToken, 10000);
        setInterval(updateThreatCounter, 3000);

        // Sync on visibility change (tab refocus)
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible') {
                syncPortfolio();
                updateDdosToken();
            }
        });
    })();
    </script>

</body>
</html>
