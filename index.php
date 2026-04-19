<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="Lyshan Dave B. Tomo — Computer Technician specializing in system administration, network configuration, and web development.">
    <meta name="author" content="Lyshan Dave B. Tomo">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0ea5e9">
    <meta property="og:title" content="Lyshan Dave B. Tomo | Computer Technician">
    <meta property="og:description" content="Computer Technician specializing in system administration, network configuration, and web development.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://lyshandave.github.io/">
    <title>Lyshan Dave B. Tomo | Computer Technician</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <nav class="navbar" id="navbar" role="navigation" aria-label="Main navigation">
        <div class="nav-container">
            <div class="nav-menu" id="navMenu">
                <a href="#home"         class="nav-link active">Home</a>
                <a href="#about"        class="nav-link">About</a>
                <a href="#skills"       class="nav-link">Skills</a>
                <a href="#projects"     class="nav-link">Projects</a>
                <a href="#certificates" class="nav-link">Certificates</a>
                <a href="#contact"      class="nav-link">Contact</a>
                <a href="#comments"     class="nav-link">Comments</a>
            </div>
            <div class="nav-actions">
                <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
                    <i class="fas fa-sun"  aria-hidden="true"></i>
                    <i class="fas fa-moon" aria-hidden="true"></i>
                </button>
                <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="navMenu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    <main id="main-content">

        <section id="home" class="hero">
            <div class="hero-bg" aria-hidden="true">
                <div class="gradient-orb orb-1"></div>
                <div class="gradient-orb orb-2"></div>
                <div class="gradient-orb orb-3"></div>
            </div>
            <div class="hero-grid" aria-hidden="true"></div>
            <div class="container hero-container">
                <div class="hero-content">
                    <div class="hero-badge">
                        <span class="badge-dot" aria-hidden="true"></span>
                        <span>Available for Work</span>
                    </div>
                    <h1 class="hero-title">
                        <span class="title-greeting">Hi, I'm</span>
                        <span class="title-name">Lyshan Dave B. Tomo</span>
                    </h1>
                    <div class="hero-role" aria-label="Role">
                        <span class="role-prefix" aria-hidden="true">&gt;</span>
                        <span class="typewriter" id="typewriter" aria-live="polite"></span>
                        <span class="cursor" aria-hidden="true">|</span>
                    </div>
                    <p class="hero-description">
                        Passionate Computer Technician specializing in system administration,
                        network configuration, and web development. Delivering reliable technical
                        solutions with expertise in Linux, Cisco technologies, and modern web stacks.
                    </p>
                    <div class="hero-actions">
                        <a href="#projects" class="btn btn-primary">
                            <i class="fas fa-folder-open" aria-hidden="true"></i> View Projects
                        </a>
                        <button class="btn btn-secondary" onclick="openResumeModal()">
                            <i class="fas fa-file-alt" aria-hidden="true"></i> View Resume
                        </button>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">10+</span>
                            <span class="stat-label">Projects Completed</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">95%</span>
                            <span class="stat-label">Client Satisfaction</span>
                        </div>
                    </div>
                </div>
                <div class="hero-visual" aria-hidden="true">
                    <div class="tech-orbit">
                        <div class="orbit-center"><i class="fas fa-microchip"></i></div>
                        <div class="orbit-ring ring-1">
                            <i class="fab fa-linux"></i><i class="fab fa-html5"></i>
                            <i class="fab fa-css3-alt"></i><i class="fab fa-js"></i>
                            <i class="fab fa-php"></i><i class="fab fa-git-alt"></i>
                        </div>
                        <div class="orbit-ring ring-2">
                            <i class="fas fa-network-wired"></i><i class="fas fa-tools"></i>
                            <i class="fas fa-server"></i><i class="fas fa-shield-alt"></i>
                            <i class="fas fa-wifi"></i><i class="fas fa-desktop"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-indicator" aria-hidden="true">
                <div class="mouse"><div class="wheel"></div></div>
                <span>Scroll Down</span>
            </div>
        </section>

        <section id="about" class="about">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">About Me</span>
                    <h2 class="section-title">Who I Am</h2>
                    <div class="section-line" aria-hidden="true"></div>
                </div>
                <div class="about-content">
                    <div class="about-image">
                        <div class="image-frame">
                            <div class="profile-img-wrap" id="profileImgWrap" aria-label="Profile photo">
                                <img class="profile-img profile-light" src="images/profile-light.jpg" alt="Lyshan Dave - Light Mode" draggable="false">
                                <img class="profile-img profile-dark"  src="images/profile-dark.png"  alt="Lyshan Dave - Dark Mode"  draggable="false">
                            </div>
                            <div class="image-decoration" aria-hidden="true"></div>
                        </div>
                    </div>
                    <div class="about-text">
                        <div class="about-card">
                            <h3>Computer Technician &amp; IT Specialist</h3>
                            <p>I'm a dedicated Computer Technician based in Quezon City, Philippines, with a strong passion for technology and problem-solving. My journey in IT started with a curiosity about how systems work, which evolved into a professional career helping businesses and individuals with their technical needs.</p>
                            <p>With expertise spanning system administration, network configuration, and web development, I bring a comprehensive approach to every project. I believe in continuous learning and staying updated with the latest technologies to deliver the best solutions.</p>
                            <div class="about-highlights">
                                <div class="highlight-item"><i class="fas fa-check-circle" aria-hidden="true"></i><span>System Installation &amp; Configuration</span></div>
                                <div class="highlight-item"><i class="fas fa-check-circle" aria-hidden="true"></i><span>Network Setup &amp; Troubleshooting</span></div>
                                <div class="highlight-item"><i class="fas fa-check-circle" aria-hidden="true"></i><span>Hardware Repair &amp; Maintenance</span></div>
                                <div class="highlight-item"><i class="fas fa-check-circle" aria-hidden="true"></i><span>Web Development &amp; Design</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="skills" class="skills">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">My Expertise</span>
                    <h2 class="section-title">Tech Stack &amp; Expertise</h2>
                    <div class="section-line" aria-hidden="true"></div>
                </div>

                <!-- Category Tabs -->
                <div class="skills-tabs" role="tablist" aria-label="Skill categories">
                    <button class="skills-tab active" role="tab" aria-selected="true"  data-tab="frontend"    aria-controls="tab-frontend">
                        <i class="fas fa-code" aria-hidden="true"></i> Frontend
                    </button>
                    <button class="skills-tab"        role="tab" aria-selected="false" data-tab="backend"     aria-controls="tab-backend">
                        <i class="fas fa-database" aria-hidden="true"></i> Backend
                    </button>
                    <button class="skills-tab"        role="tab" aria-selected="false" data-tab="networking"  aria-controls="tab-networking">
                        <i class="fas fa-network-wired" aria-hidden="true"></i> Network
                    </button>
                </div>

                <!-- Frontend Panel -->
                <div id="tab-frontend" class="skills-panel active" role="tabpanel">
                    <div class="skills-grid-v2">
                        <div class="skill-card-v2" style="--icon-color:#e34c26">
                            <div class="skill-icon-v2"><i class="fab fa-html5"></i></div>
                            <span class="skill-name-v2">HTML</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#264de4">
                            <div class="skill-icon-v2"><i class="fab fa-css3-alt"></i></div>
                            <span class="skill-name-v2">CSS</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#f7df1e">
                            <div class="skill-icon-v2"><i class="fab fa-js"></i></div>
                            <span class="skill-name-v2">JavaScript</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#38bdf8">
                            <div class="skill-icon-v2"><i class="fas fa-wind"></i></div>
                            <span class="skill-name-v2">Tailwind CSS</span>
                        </div>
                    </div>
                </div>

                <!-- Backend Panel -->
                <div id="tab-backend" class="skills-panel" role="tabpanel" hidden>
                    <div class="skills-grid-v2">
                        <div class="skill-card-v2" style="--icon-color:#777bb4">
                            <div class="skill-icon-v2"><i class="fab fa-php"></i></div>
                            <span class="skill-name-v2">PHP</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#00758f">
                            <div class="skill-icon-v2"><i class="fas fa-database"></i></div>
                            <span class="skill-name-v2">MySQL</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#f05032">
                            <div class="skill-icon-v2"><i class="fab fa-git-alt"></i></div>
                            <span class="skill-name-v2">Git</span>
                        </div>
                    </div>
                </div>

                <!-- Networking / IT Panel -->
                <div id="tab-networking" class="skills-panel" role="tabpanel" hidden>
                    <div class="skills-grid-v2">
                        <div class="skill-card-v2" style="--icon-color:#fcc624">
                            <div class="skill-icon-v2"><i class="fab fa-linux"></i></div>
                            <span class="skill-name-v2">Linux</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#1ba0d7">
                            <div class="skill-icon-v2"><i class="fas fa-network-wired"></i></div>
                            <span class="skill-name-v2">Cisco</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#94a3b8">
                            <div class="skill-icon-v2"><i class="fas fa-microchip"></i></div>
                            <span class="skill-name-v2">Hardware</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#22c55e">
                            <div class="skill-icon-v2"><i class="fas fa-shield-alt"></i></div>
                            <span class="skill-name-v2">Cybersecurity</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#f59e0b">
                            <div class="skill-icon-v2"><i class="fas fa-wifi"></i></div>
                            <span class="skill-name-v2">LAN / WAN</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#06b6d4">
                            <div class="skill-icon-v2"><i class="fas fa-sitemap"></i></div>
                            <span class="skill-name-v2">TCP / IP</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#0ea5e9">
                            <div class="skill-icon-v2"><i class="fas fa-project-diagram"></i></div>
                            <span class="skill-name-v2">IP Addressing</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#0ea5e9">
                            <div class="skill-icon-v2"><i class="fas fa-server"></i></div>
                            <span class="skill-name-v2">Server Setup</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#8b5cf6">
                            <div class="skill-icon-v2"><i class="fas fa-hdd"></i></div>
                            <span class="skill-name-v2">OS Installation</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#f97316">
                            <div class="skill-icon-v2"><i class="fas fa-desktop"></i></div>
                            <span class="skill-name-v2">PC Assembly</span>
                        </div>
                        <div class="skill-card-v2" style="--icon-color:#ef4444">
                            <div class="skill-icon-v2"><i class="fas fa-wrench"></i></div>
                            <span class="skill-name-v2">Troubleshooting</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="projects" class="projects">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Portfolio</span>
                    <h2 class="section-title">Featured Projects</h2>
                    <div class="section-line" aria-hidden="true"></div>
                </div>
                <div class="projects-grid">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="images/project1.jpg" alt="Network Simulator" loading="lazy">
                            <div class="project-overlay"><div class="project-actions">
                                <a href="http://network-simulator.wuaze.com" class="project-btn btn-live" target="_blank" rel="noopener noreferrer"><i class="fas fa-external-link-alt" aria-hidden="true"></i> Live Demo</a>
                                <button class="project-btn btn-details" onclick="showProjectModal('project1')"><i class="fas fa-info-circle" aria-hidden="true"></i> Details</button>
                            </div></div>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">Network Simulator</h3>
                            <p class="project-desc">Interactive network topology visualization with drag-and-drop components, VLAN configuration, and real-time packet simulation.</p>
                            <div class="project-tags"><span class="tag">HTML</span><span class="tag">CSS</span><span class="tag">JavaScript</span></div>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="images/project2.jpg" alt="Server Monitor Dashboard" loading="lazy">
                            <div class="project-overlay"><div class="project-actions">
                                <a href="http://server-dashboard.wuaze.com" class="project-btn btn-live" target="_blank" rel="noopener noreferrer"><i class="fas fa-external-link-alt" aria-hidden="true"></i> Live Demo</a>
                                <button class="project-btn btn-details" onclick="showProjectModal('project2')"><i class="fas fa-info-circle" aria-hidden="true"></i> Details</button>
                            </div></div>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">Server Monitor Dashboard</h3>
                            <p class="project-desc">Real-time server monitoring dashboard with CPU, memory, disk space, and network traffic animated charts.</p>
                            <div class="project-tags"><span class="tag">JavaScript</span><span class="tag">Canvas API</span><span class="tag">CSS3</span></div>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="images/project4.jpg" alt="PC Diagnostic Tool" loading="lazy">
                            <div class="project-overlay"><div class="project-actions">
                                <a href="http://pc-diagnostic.wuaze.com" class="project-btn btn-live" target="_blank" rel="noopener noreferrer"><i class="fas fa-external-link-alt" aria-hidden="true"></i> Live Demo</a>
                                <button class="project-btn btn-details" onclick="showProjectModal('project4')"><i class="fas fa-info-circle" aria-hidden="true"></i> Details</button>
                            </div></div>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">PC Diagnostic Tool</h3>
                            <p class="project-desc">Interactive PC hardware diagnostic simulator with component testing, error detection, and repair recommendations.</p>
                            <div class="project-tags"><span class="tag">JavaScript</span><span class="tag">HTML5</span><span class="tag">CSS3</span></div>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="images/project_cisco1.png" alt="Multi-Branch Office Network" loading="lazy">
                            <div class="project-overlay"><div class="project-actions">
                                <button class="project-btn btn-details" onclick="showProjectModal('project_cisco1')"><i class="fas fa-info-circle" aria-hidden="true"></i> Details</button>
                            </div></div>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">Multi-Branch Office Network</h3>
                            <p class="project-desc">Cisco Packet Tracer — multi-branch office with routers, switches, wireless APs, and inter-branch routing across 3 buildings.</p>
                            <div class="project-tags"><span class="tag">Cisco</span><span class="tag">Networking</span><span class="tag">IP Addressing</span></div>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="images/project_cisco2.png" alt="Multi-Area Network with Firewall" loading="lazy">
                            <div class="project-overlay"><div class="project-actions">
                                <button class="project-btn btn-details" onclick="showProjectModal('project_cisco2')"><i class="fas fa-info-circle" aria-hidden="true"></i> Details</button>
                            </div></div>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">Multi-Area Network with Firewall</h3>
                            <p class="project-desc">3-area hierarchical network with ISP, firewalls (550X), routers, and distribution/access layer switching.</p>
                            <div class="project-tags"><span class="tag">Cisco</span><span class="tag">VLAN</span><span class="tag">Routing</span></div>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="images/project_cisco3.png" alt="Office Floor Plan Network" loading="lazy">
                            <div class="project-overlay"><div class="project-actions">
                                <button class="project-btn btn-details" onclick="showProjectModal('project_cisco3')"><i class="fas fa-info-circle" aria-hidden="true"></i> Details</button>
                            </div></div>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">Office Floor Plan Network</h3>
                            <p class="project-desc">Full office floor plan with department VLANs, IP phones, wireless APs, and DNS/DHCP/Mail servers.</p>
                            <div class="project-tags"><span class="tag">Cisco</span><span class="tag">DHCP</span><span class="tag">DNS</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="certificates" class="certificates">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Achievements</span>
                    <h2 class="section-title">My Certificates</h2>
                    <div class="section-line" aria-hidden="true"></div>
                </div>
                <div class="certificates-grid">
                    <div class="certificate-card" onclick="openLightbox('cert1')" role="button" tabindex="0" aria-label="View Networking Basics certificate" onkeydown="if(event.key==='Enter'||event.key===' ')openLightbox('cert1')">
                        <div class="certificate-image">
                            <img src="images/cert1.png" alt="Networking Basics Certificate — Cisco Networking Academy" loading="lazy">
                            <div class="certificate-overlay" aria-hidden="true"><i class="fas fa-expand"></i><span>Click to Enlarge</span></div>
                        </div>
                        <div class="certificate-info">
                            <h3>Networking Basics</h3>
                            <p>Cisco Networking Academy</p>
                            <span class="cert-date">Dec 2025</span>
                        </div>
                    </div>
                    <div class="certificate-card" onclick="openLightbox('cert2')" role="button" tabindex="0" aria-label="View Computer Systems Servicing certificate" onkeydown="if(event.key==='Enter'||event.key===' ')openLightbox('cert2')">
                        <div class="certificate-image">
                            <img src="images/cert2.png" alt="Computer Systems Servicing Certificate — TESDA NC II" loading="lazy">
                            <div class="certificate-overlay" aria-hidden="true"><i class="fas fa-expand"></i><span>Click to Enlarge</span></div>
                        </div>
                        <div class="certificate-info">
                            <h3>Computer Systems Servicing</h3>
                            <p>TESDA NC II — CSS</p>
                            <span class="cert-date">Apr 2024</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="contact">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Get In Touch</span>
                    <h2 class="section-title">Contact Me</h2>
                    <div class="section-line" aria-hidden="true"></div>
                </div>
                <div class="contact-content">
                    <div class="contact-info">
                        <h3>Let's Work Together</h3>
                        <p>Have a project in mind or need technical assistance? I'm always open to discussing new opportunities and challenges. Reach out and let's create something amazing together.</p>
                        <div class="contact-details">
                            <div class="contact-item">
                                <div class="contact-icon" aria-hidden="true"><i class="fas fa-envelope"></i></div>
                                <div class="contact-text">
                                    <span class="contact-label">Email</span>
                                    <a href="mailto:lyshandavet@gmail.com">lyshandavet@gmail.com</a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon" aria-hidden="true"><i class="fas fa-phone"></i></div>
                                <div class="contact-text">
                                    <span class="contact-label">Phone</span>
                                    <a href="tel:+639623885226">09623885226</a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="contact-text">
                                    <span class="contact-label">Address</span>
                                    <span>701 Commonwealth Avenue, Quezon City, Philippines</span>
                                </div>
                            </div>
                        </div>
                        <div class="contact-social">
                            <a href="https://www.facebook.com/Dave062"           class="social-link" aria-label="Facebook"  target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"  aria-hidden="true"></i></a>
                            <a href="https://github.com/Lyshandave"              class="social-link" aria-label="GitHub"    target="_blank" rel="noopener noreferrer"><i class="fab fa-github"      aria-hidden="true"></i></a>
                            <a href="https://www.instagram.com/lyshan_dave/"     class="social-link" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"   aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/in/lyshan-dave-tomo-09166337b/" class="social-link" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="contact-form-wrapper">
                        <form class="contact-form" id="contactForm" action="send.php" method="POST" novalidate>
                            <div class="honeypot-field" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user" aria-hidden="true"></i> Your Name</label>
                                <input type="text" id="name" name="name" required maxlength="100" placeholder="Enter your full name" autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope" aria-hidden="true"></i> Your Email</label>
                                <input type="email" id="email" name="email" required maxlength="100" placeholder="Enter your email address" autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="subject"><i class="fas fa-tag" aria-hidden="true"></i> Subject</label>
                                <input type="text" id="subject" name="subject" required maxlength="200" placeholder="What is this about?">
                            </div>
                            <div class="form-group">
                                <label for="message"><i class="fas fa-comment" aria-hidden="true"></i> Your Message</label>
                                <textarea id="message" name="message" rows="6" required maxlength="2000" placeholder="Tell me about your project or inquiry..."></textarea>
                            </div>
                            <button type="submit" class="submit-btn" id="submitBtn">
                                <span class="btn-text">Send Message</span>
                                <span class="btn-icon" aria-hidden="true"><i class="fas fa-paper-plane"></i></span>
                                <span class="btn-loading" aria-hidden="true"><i class="fas fa-spinner fa-spin"></i></span>
                            </button>
                            <div class="form-message" id="formMessage" role="alert" aria-live="polite"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Comments & Rating (combined) -->
        <section id="comments" class="comments-section">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Feedback</span>
                    <h2 class="section-title">Comments &amp; Ratings</h2>
                    <div class="section-line" aria-hidden="true"></div>
                </div>
                <div class="comments-layout">

                    <!-- Left: form + inline rating -->
                    <div class="comment-form-card">
                        <h3><i class="fas fa-comment-dots" aria-hidden="true"></i> Leave a Comment</h3>
                        <p>Share your thoughts or feedback about my portfolio.</p>

                        <div class="inline-rating">
                            <span class="inline-rating-label">Rate this portfolio:</span>
                            <div class="inline-rating-right">
                                <div class="star-picker" id="starPicker" role="group" aria-label="Select a star rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <button class="star-btn" data-value="<?= $i ?>" aria-label="<?= $i ?> star<?= $i > 1 ? 's' : '' ?>" type="button">&#9733;</button>
                                    <?php endfor; ?>
                                </div>
                                <button class="rating-submit-btn" id="ratingSubmitBtn" disabled type="button">Submit</button>
                            </div>
                            <div class="rating-msg" id="ratingMsg" role="alert" aria-live="polite"></div>
                        </div>

                        <form class="comment-form" id="commentForm" novalidate>
                            <div class="honeypot-field" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                            <div class="form-group">
                                <label for="commentName"><i class="fas fa-user" aria-hidden="true"></i> Your Name</label>
                                <input type="text" id="commentName" name="name" maxlength="60" placeholder="Enter your name" required autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="commentMessage"><i class="fas fa-comment" aria-hidden="true"></i> Comment</label>
                                <textarea id="commentMessage" name="message" maxlength="500" rows="4" placeholder="Write your comment here..." required></textarea>
                            </div>
                            <button type="submit" class="comment-submit-btn" id="commentSubmitBtn">
                                <i class="fas fa-paper-plane" aria-hidden="true"></i> Post Comment
                            </button>
                            <div class="comment-form-msg" id="commentFormMsg" role="alert" aria-live="polite"></div>
                        </form>
                    </div>

                    <!-- Right: rating summary + comments list -->
                    <div class="comments-list-wrap">
                        <div class="rating-summary-bar">
                            <div class="rating-summary-score">
                                <span class="rating-big-score" id="ratingAvg">—</span>
                                <div class="rating-stars-display" id="ratingStarsDisplay" aria-label="Average rating"></div>
                                <span class="rating-total" id="ratingTotal">No ratings yet</span>
                            </div>
                            <div class="rating-bars" id="ratingBars">
                                <?php foreach ([5,4,3,2,1] as $n): ?>
                                <div class="rating-bar-row">
                                    <span class="rating-bar-label"><?= $n ?> <i class="fas fa-star" aria-hidden="true"></i></span>
                                    <div class="rating-bar-track"><div class="rating-bar-fill" id="ratingBar<?= $n ?>"></div></div>
                                    <span class="rating-bar-count" id="ratingCount<?= $n ?>">0</span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <h3>
                            <i class="fas fa-comments" aria-hidden="true"></i>
                            Visitor Comments
                            <span class="comments-count-badge" id="commentsCountBadge">0</span>
                        </h3>
                        <div class="comments-list" id="commentsList" role="list" aria-live="polite">
                            <div class="comments-loading"><i class="fas fa-spinner fa-spin" aria-hidden="true"></i> Loading comments…</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Lyshan Dave B. Tomo. All rights reserved.</p>
        </div>
    </footer>

    <!-- Resume Modal -->
    <div class="modal resume-modal" id="resumeModal" role="dialog" aria-modal="true" aria-label="Resume">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('resumeModal')" aria-label="Close resume"><i class="fas fa-times" aria-hidden="true"></i></button>
            <div class="resume-modal-inner">
                <img src="images/resume.png" alt="Resume — Lyshan Dave B. Tomo">
                <div class="resume-modal-actions">
                    <a href="images/resume.png" download="Resume-Lyshan-Dave-Tomo.png" class="btn btn-primary"><i class="fas fa-download" aria-hidden="true"></i> Download</a>
                    <button class="btn btn-secondary" onclick="closeModal('resumeModal')"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Modal -->
    <div class="modal" id="projectModal" role="dialog" aria-modal="true" aria-label="Project details">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('projectModal')" aria-label="Close project details"><i class="fas fa-times" aria-hidden="true"></i></button>
            <div class="modal-body" id="projectModalBody"></div>
        </div>
    </div>

    <!-- Certificate Lightbox -->
    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Certificate viewer">
        <button class="lightbox-close" onclick="closeLightbox()" aria-label="Close certificate viewer"><i class="fas fa-times" aria-hidden="true"></i></button>
        <button class="lightbox-nav lightbox-prev" onclick="changeImage(-1)" aria-label="Previous certificate"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>
        <div class="lightbox-content">
            <img src="" alt="" id="lightboxImage">
            <div class="lightbox-caption" id="lightboxCaption"></div>
        </div>
        <button class="lightbox-nav lightbox-next" onclick="changeImage(1)" aria-label="Next certificate"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>
    </div>

    <!-- Chatbot Widget -->
    <div class="chatbot-container" id="chatbotContainer" aria-hidden="true">
        <div class="chatbot-header">
            <div class="chatbot-header-info">
                <div class="chatbot-avatar"><i class="fas fa-robot" aria-hidden="true"></i></div>
                <div>
                    <div class="chatbot-title">Chat with Dave</div>
                    <div class="chatbot-status"><span class="chatbot-dot"></span> Online</div>
                </div>
            </div>
            <button class="chatbot-close" id="chatbotClose" aria-label="Close chat"><i class="fas fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="chatbot-messages" id="chatbotMessages" role="log" aria-live="polite">
            <div class="chat-msg bot">
                <div class="chat-bubble">Hey! I'm Dave's assistant. Ask me anything about his skills, projects, or contact info — in English or Tagalog! 😊</div>
            </div>
        </div>
        <div class="chatbot-input-row">
            <input type="text" id="chatbotInput" placeholder="Ask something…" autocomplete="off" maxlength="300" aria-label="Chat message">
            <button id="chatbotSend" aria-label="Send message"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
        </div>
    </div>

    <button class="chatbot-toggle" id="chatbotToggle" aria-label="Open chat assistant" aria-expanded="false">
        <i class="fas fa-robot" aria-hidden="true"></i>
        <span class="chatbot-badge" id="chatbotBadge" aria-hidden="true">1</span>
    </button>

    <button class="scroll-top" id="scrollTop" aria-label="Scroll to top"><i class="fas fa-arrow-up" aria-hidden="true"></i></button>

    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script src="js/projects.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
