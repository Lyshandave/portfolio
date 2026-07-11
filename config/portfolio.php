<?php

return [
    'profile' => [
        'name' => 'Lyshan Dave',
        'title' => 'AI \ Software Engineer \ Content Creator',
        'location' => 'Metro Manila, Philippines',
        'about' => [
            "I am a TESDA NC II Certified Computer Systems Technician with specialized training in Networking Basics through the Cisco Networking Academy.",
            "I am proficient in PC assembly, server configuration, and network troubleshooting. I have hands-on experience setting up and maintaining local servers, testing and replacing components, and ensuring system stability.",
            "I am committed to delivering reliable technical support and maintaining high system uptime in a fast-paced environment, prioritizing teamwork and workplace safety.",
            "Alongside my expertise in hardware and networking, I also have a foundation in web development. I am passionate about exploring web technologies to build applications and continuously broaden my technical skill set."
        ]
    ],

    'experience' => [
        [
            'role' => 'Web Development',
            'company' => 'Core Technology & PocketDevs',
            'period' => '2026',
            'active' => true,
            'description' => 'Delivering robust core software systems combining fast frontend interfaces with high-performance backend APIs.',
            'highlights' => [
                'Spearheaded teams of web development interns, building practical project structures.',
                'Optimized legacy database schemas and refactored crucial back-office APIs.',
            ],
            'technologies' => ['PHP', 'Laravel', 'JavaScript', 'TypeScript', 'Node.js', 'React'],
        ],
        [
            'role' => 'Computer Systems Servicing',
            'company' => 'GCM Tech Services',
            'period' => '2024',
            'active' => false,
            'description' => 'Managed IT infrastructure, configured hardware and network configurations, and implemented backup controls.',
            'highlights' => [
                'Optimized company servers and solved hardware issues to reduce downtime.',
            ],
            'technologies' => ['Networking', 'Hardware Troubleshooting', 'OS Deployment', 'Security Controls'],
        ],
        [
            'role' => 'BS Computer Science',
            'company' => 'Asian Institute of Computer Studies',
            'period' => '2025',
            'active' => false,
            'description' => 'Graduated with a focus on Software Engineering, Database Systems, and Application Architectures.',
            'highlights' => [
                'Built software systems implemented by the university for its operational needs.',
            ],
            'technologies' => ['Algorithms', 'Data Structures', 'Databases', 'Software Engineering'],
        ],
        [
            'role' => 'Networking Basics (Cisco Networking Academy)',
            'company' => 'Asian Institute of Computer Studies',
            'period' => '2025',
            'active' => false,
            'description' => 'Developed key competencies in computer networking fundamentals, network operations, and connectivity troubleshooting.',
            'highlights' => [
                'Configured and simulated complex network setups using Cisco Packet Tracer.',
            ],
            'technologies' => ['Cisco Packet Tracer', 'Networking Fundamentals', 'Connectivity Troubleshooting'],
        ],
        [
            'role' => 'Hello World! 👏',
            'company' => 'Wrote my first line of code',
            'period' => '2025',
            'active' => false,
            'description' => 'Took the first step into the programming world, sparking a lifelong passion for technology and software creation.',
            'highlights' => [],
            'technologies' => ['HTML', 'CSS', 'Basic Programming'],
        ],
    ],

    'techStack' => [
        'Frontend' => [
            ['name' => 'JavaScript', 'level' => 'Expert', 'icon' => 'fab fa-js'],
            ['name' => 'TypeScript', 'level' => 'Expert', 'icon' => 'fas fa-code'],
            ['name' => 'React', 'level' => 'Expert', 'icon' => 'fab fa-react'],
            ['name' => 'Next.js', 'level' => 'Expert', 'icon' => 'fas fa-arrow-right'],
            ['name' => 'Vue.js', 'level' => 'Advanced', 'icon' => 'fab fa-vuejs'],
            ['name' => 'Tailwind CSS', 'level' => 'Expert', 'icon' => 'fab fa-css3-alt'],
        ],
        'Backend' => [
            ['name' => 'Node.js', 'level' => 'Expert', 'icon' => 'fab fa-node-js'],
            ['name' => 'Python', 'level' => 'Expert', 'icon' => 'fab fa-python'],
            ['name' => 'PHP', 'level' => 'Expert', 'icon' => 'fab fa-php'],
            ['name' => 'Laravel', 'level' => 'Expert', 'icon' => 'fab fa-laravel'],
            ['name' => 'MySQL', 'level' => 'Expert', 'icon' => 'fas fa-database'],
        ],
        'DevOps' => [
            ['name' => 'GitHub Actions', 'level' => 'Advanced', 'icon' => 'fab fa-github'],
            ['name' => 'Laragon', 'level' => 'Advanced', 'icon' => 'fas fa-server'],
        ],
        'Developer Tools' => [
            ['name' => 'GitHub', 'level' => 'Expert', 'icon' => 'fab fa-github'],
            ['name' => 'Git', 'level' => 'Expert', 'icon' => 'fab fa-git-alt'],
            ['name' => 'VS Code', 'level' => 'Expert', 'icon' => 'fas fa-laptop-code'],
            ['name' => 'Discord', 'level' => 'Advanced', 'icon' => 'fab fa-discord'],
        ],
        'Networking' => [
            ['name' => 'LAN/WAN Configuration', 'level' => 'Advanced', 'icon' => 'fas fa-network-wired'],
            ['name' => 'TCP/IP & IP Addressing', 'level' => 'Advanced', 'icon' => 'fas fa-globe'],
            ['name' => 'Router & Switch Setup', 'level' => 'Intermediate', 'icon' => 'fas fa-route'],
            ['name' => 'Server Management', 'level' => 'Advanced', 'icon' => 'fas fa-server'],
            ['name' => 'PC Assembly & Maintenance', 'level' => 'Expert', 'icon' => 'fas fa-tools'],
            ['name' => 'Hardware Troubleshooting', 'level' => 'Expert', 'icon' => 'fas fa-wrench'],
        ],
    ],

    'projects' => [
        [
            'title' => 'Ordering System',
            'slug' => 'ordering-system',
            'subtitle' => 'A premium online ordering and food services system for Cafe Misto, designed to streamline customer ordering, payments, and checkout flows.',
            'description' => 'Online ordering system for efficient customer transactions and fast checkout.',
            'technologies' => ['Laravel', 'React', 'PostgreSQL', 'Tailwind CSS', 'Vite', 'FontAwesome', 'Gmail SMTP'],
            'image' => 'project-images/ordering.png',
            'demo' => 'https://ordering-system-sigma.vercel.app/',
            'featured' => true,
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'MVC / Decoupled',
                'Type' => 'Web Platform',
                'Collaboration' => 'Independent Project'
            ],
            'objectives' => [
                ['title' => 'Seamless User Experience', 'text' => 'Develop an intuitive cafe dashboard where users can quickly select beverage options, configure sizes, and make additions.'],
                ['title' => 'Operational Efficiency', 'text' => 'Optimize inventory consumption rates and checkout pipelines to reduce wait times to under 30 seconds.'],
                ['title' => 'Secure Authentications', 'text' => 'Protect customer information and transactions using state-of-the-art authentication guards and HTTPS scheme enforcement.']
            ],
            'key_features' => [
                ['title' => 'User Experience', 'text' => 'The login interface features a "Remember Me" option and password visibility toggle for enhanced usability.', 'icon' => 'fas fa-mug-hot'],
                ['title' => 'Automated Identification', 'text' => 'Generates unique customer tracking numbers and custom invoices upon order completion.', 'icon' => 'fas fa-barcode'],
                ['title' => 'Secure Recovery', 'text' => 'Secure password reset links sent exclusively to verified email addresses with real-time feedback warnings.', 'icon' => 'fas fa-key'],
                ['title' => 'Welcome Notifications', 'text' => 'Triggers an automated welcome email with verification links for all newly registered accounts.', 'icon' => 'fas fa-envelope']
            ]
        ],
        [
            'title' => 'PureSafe',
            'slug' => 'puresafe',
            'subtitle' => 'Sleek customer portal for ordering purified water gallons, tracking delivery, and managing subscriptions.',
            'description' => 'Online purified water ordering platform with gallon selections, scheduling, and billing.',
            'technologies' => ['Laravel', 'React', 'PostgreSQL', 'Tailwind CSS', 'Vite', 'FontAwesome'],
            'image' => 'project-images/inventory.png',
            'demo' => 'https://pure-safe.vercel.app',
            'featured' => true,
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'MVC / Decoupled',
                'Type' => 'Web Platform',
                'Collaboration' => 'Family Business'
            ],
            'objectives' => [
                ['title' => 'Streamlined Ordering', 'text' => 'Fast ordering system for customers to select gallon types, dynamic quantities, and request deliveries.'],
                ['title' => 'Delivery Tracking', 'text' => 'Coordinates routes and details delivery parameters for drivers and operators.'],
                ['title' => 'Household Reminders', 'text' => 'Allows households to set up weekly or bi-weekly automated refilling reminders and tasks.']
            ],
            'key_features' => [
                ['title' => 'Product Catalog', 'text' => 'Sleek selection of purified water types, dispenser units, and accessories.', 'icon' => 'fas fa-tint'],
                ['title' => 'Smart Billing', 'text' => 'Automated calculation of dynamic delivery charges and empty container deposits.', 'icon' => 'fas fa-receipt'],
                ['title' => 'Order History', 'text' => 'Customer dashboard showing past deliveries, active invoices, and current status.', 'icon' => 'fas fa-history'],
                ['title' => 'SMS Reminders', 'text' => 'Automated delivery notifications showing dispatch status and dynamic ETAs.', 'icon' => 'fas fa-sms']
            ]
        ],
        [
            'title' => 'School Management System',
            'slug' => 'school-management-system',
            'subtitle' => 'A comprehensive portal for tracking student profiles, enrollment pipelines, and academic grading sheets.',
            'description' => 'All-in-one administration portal for student records, enrollment, and grading.',
            'technologies' => ['Laravel', 'Vue.js', 'PostgreSQL', 'Tailwind CSS', 'Inertia.js', 'FullCalendar'],
            'image' => 'project-images/school.png',
            'demo' => 'https://school-system.lyshandave.com',
            'featured' => true,
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'Independent Refactor',
                'Type' => 'School Admin Portal',
                'Collaboration' => 'Academic System'
            ],
            'objectives' => [
                ['title' => 'Centralized Records Management', 'text' => 'Consolidate student details, transcripts, contact details, and parent contact cards in one secure database.'],
                ['title' => 'Automated Enrollment Workflows', 'text' => 'Transition traditional paper forms to digital registration wizards with automatic section and class assigning.'],
                ['title' => 'Class Schedule Coordination', 'text' => 'Prevent scheduling conflicts for instructors, classrooms, and courses through overlapping checking algorithms.']
            ],
            'key_features' => [
                ['title' => 'Student Records', 'text' => 'Searchable directories hosting student information cards, tuition structures, and advisor notes.', 'icon' => 'fas fa-user-graduate'],
                ['title' => 'Schedule Calendar', 'text' => 'Interactive school calendar displaying holidays, midterm schedules, and customized course times.', 'icon' => 'fas fa-calendar-alt'],
                ['title' => 'Academic Grading Sheets', 'text' => 'Provides professors with secure input tables to calculate exam averages and semester grades.', 'icon' => 'fas fa-edit'],
                ['title' => 'Automated Reports', 'text' => 'Export tools to generate and compile university-wide transcripts and population distribution reports.', 'icon' => 'fas fa-file-alt']
            ]
        ],
        [
            'title' => 'StreamGrab',
            'slug' => 'streamgrab',
            'subtitle' => 'A high-speed media downloader supporting MP4/MP3 downloads across YouTube, TikTok, Facebook, and Instagram.',
            'description' => 'Multi-platform downloader allowing users to easily convert and save videos/audio in high definition.',
            'technologies' => ['React', 'Node.js', 'Express', 'Tailwind CSS', 'FFmpeg', 'Vite'],
            'image' => 'project-images/grade-evaluation.png',
            'demo' => 'https://streamgrab.vercel.app',
            'featured' => true,
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'REST API / SPA',
                'Type' => 'Media Tool',
                'Collaboration' => 'Open Source'
            ],
            'objectives' => [
                ['title' => 'High-Speed Extraction', 'text' => 'Optimize multi-threaded streams to parse and convert videos under 5 seconds.'],
                ['title' => 'Multi-Platform Compatibility', 'text' => 'Ensure extractor engines support downloading links from TikTok, Facebook, IG, and YouTube.'],
                ['title' => 'Lossless Audio Extraction', 'text' => 'Provide crystal clear MP3 conversions at 320kbps with proper metadata tags.']
            ],
            'key_features' => [
                ['title' => 'URL Parser', 'text' => 'Smart link analyzer that automatically detects the host platform and retrieves raw CDN streams.', 'icon' => 'fas fa-link'],
                ['title' => 'Quality Selector', 'text' => 'Select and download media in various formats: MP4 videos (1080p, 720p) or MP3 audio.', 'icon' => 'fas fa-sliders-h'],
                ['title' => 'Fast Conversion', 'text' => 'FFmpeg background integration that compiles and packages media file formats in real-time.', 'icon' => 'fas fa-bolt'],
                ['title' => 'Clean Interface', 'text' => 'Minimalist modern layout centered around a single paste-and-go input bar.', 'icon' => 'fas fa-desktop']
            ]
        ],
        [
            'title' => 'Office Floor Plan Network',
            'slug' => 'office-floor-plan-network',
            'subtitle' => 'VLAN partition, IP phone setups, wireless access points, and DHCP/DNS server configurations.',
            'description' => 'Full office floor plan with department VLANs, IP phones, wireless APs, and DNS/DHCP/Mail servers.',
            'technologies' => ['Cisco Packet Tracer', 'Networking', 'VLAN', 'Servers'],
            'image' => 'project-images/office-network.png',
            'demo' => null,
            'featured' => false,
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'Cisco Packet Tracer',
                'Type' => 'LAN Layout',
                'Collaboration' => 'Academic Project'
            ],
            'objectives' => [
                ['title' => 'Secure Department Separation', 'text' => 'Partition offices into distinct VLANs to protect accounting and HR resources from public/guest networks.'],
                ['title' => 'IP Phone Integration', 'text' => 'Setup Voice VLANs and DHCP options to automate Cisco IP phone IP allocation and dial configurations.'],
                ['title' => 'Central Server Resources', 'text' => 'Provision DNS, DHCP, and mail servers locally to handle department requests without external web reliance.']
            ],
            'key_features' => [
                ['title' => 'VLAN Partitioning', 'text' => 'Configured separate broadcast domains to isolate department traffic and maximize network bandwidth.', 'icon' => 'fas fa-network-wired'],
                ['title' => 'Centralized DHCP/DNS', 'text' => 'Dynamic host configuration protocols ensuring immediate connectivity for newly connected devices.', 'icon' => 'fas fa-server'],
                ['title' => 'IP Voice setups', 'text' => 'Dedicated VoIP networks configured to ensure high call quality and minimum latency.', 'icon' => 'fas fa-phone'],
                ['title' => 'Wireless Coverage', 'text' => 'Strategic placements of WAPs to guarantee seamless wireless roaming throughout the building floor.', 'icon' => 'fas fa-wifi']
            ]
        ],
        [
            'title' => 'Multi-Area Network with Firewall',
            'slug' => 'multi-area-network-with-firewall',
            'subtitle' => 'Hierarchical router structure with distribution switching and ASA firewall security policy rules.',
            'description' => '3-area hierarchical network with ISP, firewalls (550X), routers, and distribution/access layer switching.',
            'technologies' => ['Cisco Packet Tracer', 'Firewall (550X)', 'Routing & Switching', 'Network Security'],
            'image' => 'project-images/firewall-network.png',
            'demo' => null,
            'featured' => false,
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'Cisco Packet Tracer',
                'Type' => 'Secure Network',
                'Collaboration' => 'Academic Project'
            ],
            'objectives' => [
                ['title' => 'Robust Edge Security', 'text' => 'Implement Cisco ASA 5505/5506 firewalls to block unauthorized inbound requests while securing outbound employee traffic.'],
                ['title' => 'Logical Routing Configuration', 'text' => 'Set up strict static routes and access lists (ACLs) to manage traffic flows between different logical security zones.'],
                ['title' => 'Redundant Connection Links', 'text' => 'Configure dual ISP lines and etherchannels to guarantee failover switches operate under 2 seconds.']
            ],
            'key_features' => [
                ['title' => 'ASA Firewall Integration', 'text' => 'Equipped the network edge with stateful packet inspection firewalls and strict security rule sets.', 'icon' => 'fas fa-shield-alt'],
                ['title' => 'OSPF Dynamic Routing', 'text' => 'Configured multi-area OSPF routing protocols to automate routing tables across distribution routers.', 'icon' => 'fas fa-route'],
                ['title' => 'Redundant Links', 'text' => 'Configured EtherChannel groupings and Spanning Tree protocols to provide automatic link redundancy.', 'icon' => 'fas fa-link'],
                ['title' => 'DMZ Zone Configuration', 'text' => 'Isolated public-facing web servers in a Demilitarized Zone, separating them from core intranet servers.', 'icon' => 'fas fa-lock']
            ]
        ],
        [
            'title' => 'Multi-Branch Office Network',
            'slug' => 'multi-branch-office-network',
            'subtitle' => 'Hierarchical triple building networking mapping with OSPF inter-branch routing policies.',
            'description' => 'Cisco Packet Tracer — multi-branch office with routers, switches, wireless APs, and inter-branch routing across 3 buildings.',
            'technologies' => ['Cisco Packet Tracer', 'Inter-Branch Routing', 'WLAN', 'OSPF'],
            'image' => 'project-images/multi-branch.png',
            'demo' => null,
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'Cisco Packet Tracer',
                'Type' => 'Multi-Branch Network',
                'Collaboration' => 'Academic Project'
            ],
            'objectives' => [
                ['title' => 'Fast Inter-Branch Connectivity', 'text' => 'Configure hierarchical OSPF routing configurations to sync networking paths between 3 branch buildings.'],
                ['title' => 'Wireless Roaming', 'text' => 'Deploy wireless controllers (WLCs) to ensure corporate laptops roam without losing connection between buildings.'],
                ['title' => 'Local Service Redundancy', 'text' => 'Maintain backup DNS and DHCP routers locally in each building to guarantee local subnet uptime.']
            ],
            'key_features' => [
                ['title' => 'OSPF Routing', 'text' => 'Configured open shortest path first routing to optimize WAN bandwidth and minimize hop count.', 'icon' => 'fas fa-random'],
                ['title' => 'Wireless AP setups', 'text' => 'Corporate SSID mapping with lightweight access points controlled by central wireless controllers.', 'icon' => 'fas fa-wifi'],
                ['title' => 'Local Subnet DHCP', 'text' => 'Configured routers as local DHCP agents to supply unique IP scopes and lease limits.', 'icon' => 'fas fa-server'],
                ['title' => 'Multi-Building Map', 'text' => 'Logical mapping of three separate corporate sites connecting through a centralized service provider link.', 'icon' => 'fas fa-map-marked-alt']
            ]
        ],
    ],

    'certifications' => [
        [
            'title' => 'Networking Basics',
            'issuer' => 'Cisco Networking Academy',
            'date' => 'Credential Verified',
            'credential_url' => '/certs/cisco_cert.png',
            'logo' => 'certs/cisco.png',
        ],
        [
            'title' => 'Computer Systems Servicing',
            'issuer' => 'TESDA',
            'date' => 'Credential Verified',
            'credential_url' => '/certs/tesda_cert.png',
            'logo' => 'certs/tesda.png',
        ],
    ],

    'all_certifications' => [
        [
            'title' => 'Networking Basics',
            'issuer' => 'Cisco Networking Academy',
            'image' => '/certs/cisco_cert.png',
            'url' => '/certs/cisco_cert.png',
            'description' => 'Successfully completed the Networking Basics course offered by Asian Institute of Computer Studies - Bicutan Branch through the Cisco Networking Academy program.',
            'featured' => true,
        ],
        [
            'title' => 'Computer Systems Servicing (NC II)',
            'issuer' => 'TESDA',
            'image' => '/certs/tesda_cert.png',
            'url' => '/certs/tesda_cert.png',
            'description' => 'National Certificate II for completing competency requirements under the Philippine TVET Assessment and Certification System in: Install & Configure Computer Systems, Set-up Computer Networks, Set-up Computer Servers, and Maintain & Repair Computer Systems and Networks.',
            'featured' => true,
        ],
    ],

    'recommendations' => [
        [
            'name' => 'IT Instructor',
            'role' => 'Cisco Networking Academy',
            'company' => 'Training Center',
            'text' => 'Lyshan is a highly dedicated student. He mastered LAN/WAN configuration and PC troubleshooting quickly and always prioritized teamwork and safety during hands-on laboratory activities.',
            'avatar' => null,
            'linkedin' => null,
        ],
        [
            'name' => 'Operations Manager',
            'role' => 'IT Department',
            'company' => 'GCM Tech Services',
            'text' => 'During his time with us, Lyshan was exceptional. He quickly optimized our local servers and resolved hardware issues, significantly reducing downtime. His understanding of network configurations is impressive for his level.',
            'avatar' => null,
            'linkedin' => null,
        ],
        [
            'name' => 'Senior Technician',
            'role' => 'Technical Support',
            'company' => 'Local IT Solutions',
            'text' => 'Lyshan has a solid foundation in IT support and hardware maintenance. He is a fast learner, a reliable team player, and always ensures system stability when deploying solutions.',
            'avatar' => null,
            'linkedin' => null,
        ],
    ],

    'associations' => [
        [
            'name' => 'Analytics & Artificial Intelligence Association of the Philippines (AAP)',
            'role' => 'Professional Member',
            'description' => 'Dedicated to advancing the practice and adoption of AI and analytics technologies across the region.',
            'url' => 'https://www.aap.ph',
        ],
        [
            'name' => 'Philippine Software Industry Association (PSIA)',
            'role' => 'Professional Member',
            'description' => 'Fostering excellence and growth inside the software engineering and IT service provider network.',
            'url' => 'https://www.psia.org.ph',
        ],
    ],

    'socialLinks' => [
        'GitHub' => [
            'url' => 'https://github.com/lyshandave',
            'icon' => 'fab fa-github',
        ],
        'Facebook' => [
            'url' => 'https://www.facebook.com/Dave062',
            'icon' => 'fab fa-facebook',
        ],
        'Instagram' => [
            'url' => 'https://www.instagram.com/lyshan_dave/',
            'icon' => 'fab fa-instagram',
        ],
    ],

    'speakingContact' => [
        [
            'title' => "Let's Talk",
            'description' => 'Schedule a structured one-on-one video call via Calendly to discuss project advisory, engineering audits, or custom technical mentorship.',
            'url' => 'https://calendly.com/lyshandavebayocboctomo12/30min',
        ],
        [
            'title' => 'lyshandavet@gmail.com',
            'description' => 'Send direct partnership, corporate training, or speaking engagement opportunities straight to my mailbox.',
            'url' => 'mailto:lyshandavet@gmail.com',
        ],
    ],
];
