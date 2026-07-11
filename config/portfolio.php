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
            'image' => 'project-images/ordering_detail.png',
            'demo' => 'https://ordering-system-sigma.vercel.app/',
            'github' => 'https://github.com/lyshandave/ordering-system',
            'featured' => true,
            'my_role' => 'Full-stack Developer & Database Designer',
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'MVC / Decoupled',
                'Type' => 'Web Platform',
                'Collaboration' => 'Independent Project'
            ],
            'problem' => 'Manual ordering and cashier tracking at Cafe Misto caused long queues, delays during peak hours, and human errors in paper-based transaction logs.',
            'challenges' => 'Implementing real-time SMTP-based password recovery and building secure login auth guards while maintaining low response latency.',
            'solution' => 'Decoupled frontend/backend routing, built custom Laravel auth controllers, integrated secure SMTP email services, and implemented optimized Eloquent queries.',
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
            ],
            'development_process' => [
                'Research & Wireframing',
                'Database Schema Design & Normalization',
                'Backend API Development (Laravel & Postgres)',
                'Frontend Component Implementation (React & Tailwind)',
                'SMTP Service & Auth Testing',
                'Deployment & Environment Sync'
            ],
            'results' => [
                'Successfully deployed to Vercel production hosting.',
                'Reduced transaction processing time to under 30 seconds.',
                'Digitized all customer transaction logs, eliminating paper invoices.'
            ],
            'lessons_learned' => [
                'Mastered secure token-based user verification pathways.',
                'Improved understanding of decoupled React-Laravel routing structures.',
                'Optimized query performance for relational database systems.'
            ],
            'future_improvements' => [
                'Integration of local payment gateways (GCash, Maya).',
                'Real-time inventory alerts using websockets.',
                'Analytics dashboard for cafe administrators.'
            ],
            'showcase_sections' => [
                // === CUSTOMER SIDE ===
                [
                    'title' => 'Customer: Secure Authentication Gateway',
                    'image' => 'project-images/ordering_login.png',
                    'features' => [
                        ['title' => 'Credential Validation', 'text' => 'Supports dual input parameters (Email or Phone) for user convenience.', 'icon' => 'fas fa-shield-alt'],
                        ['title' => 'Remember Me Utility', 'text' => 'Option to persist login sessions securely across browser instances.', 'icon' => 'fas fa-cookie-bite'],
                        ['title' => 'Google OAuth Integration', 'text' => 'Provides single sign-on access using Google Accounts.', 'icon' => 'fab fa-google']
                    ]
                ],
                [
                    'title' => 'Customer: Interactive Menu & Detail Panel',
                    'image' => 'project-images/ordering_detail.png',
                    'features' => [
                        ['title' => 'Menu Categories', 'text' => 'Categorized grid layout for Appetizers, Beverages, and Main Course items.', 'icon' => 'fas fa-th-list'],
                        ['title' => 'Ingredients Visualization', 'text' => 'Displays ingredient badges such as Falafel, Cabbage, Jalapeno, and Tortilla in the detail view.', 'icon' => 'fas fa-leaf'],
                        ['title' => 'Dynamic Customizer', 'text' => 'Handles quantity adjustments and dynamic pricing previews.', 'icon' => 'fas fa-sliders-h']
                    ]
                ],
                [
                    'title' => 'Customer: Slide-out Cart Management',
                    'image' => 'project-images/ordering_cart.png',
                    'features' => [
                        ['title' => 'Quantity Controls', 'text' => 'Inline increment and decrement selectors with instant price calculations.', 'icon' => 'fas fa-calculator'],
                        ['title' => 'Quick Items Removal', 'text' => 'One-click item deletion directly from the cart drawer.', 'icon' => 'fas fa-trash-alt'],
                        ['title' => 'Tax & Subtotal Estimates', 'text' => 'Real-time calculation displaying subtotal and computed sales tax (8%).', 'icon' => 'fas fa-percentage']
                    ]
                ],
                [
                    'title' => 'Customer: Structured Order Checkout',
                    'image' => 'project-images/ordering_checkout.png',
                    'features' => [
                        ['title' => 'Encrypted Info Display', 'text' => 'Secures user phone details during checkout using masked digit sequences.', 'icon' => 'fas fa-user-lock'],
                        ['title' => 'Multi-Payment Options', 'text' => 'Supports Cash on Delivery (COD) and Credit Card payment methods.', 'icon' => 'fas fa-wallet'],
                        ['title' => 'Address Coordinates', 'text' => 'Shows clear delivery address fields mapped to user profile records.', 'icon' => 'fas fa-map-marker-alt']
                    ]
                ],
                [
                    'title' => 'Customer: User Profile Settings Modal',
                    'image' => 'project-images/ordering_profile.png',
                    'features' => [
                        ['title' => 'Tabbed Dashboard Layout', 'text' => 'Easy navigation between Profile, Address, Order History, and Settings.', 'icon' => 'fas fa-user-cog'],
                        ['title' => 'Personal Info Manager', 'text' => 'Displays Full Name, Email, Contact Phone, and Primary Delivery Address.', 'icon' => 'fas fa-address-card']
                    ]
                ],
                // === ADMIN SIDE ===
                [
                    'title' => 'Admin: Dashboard & Revenue Analytics',
                    'image' => 'project-images/ordering_admin_dashboard.png',
                    'features' => [
                        ['title' => 'Revenue Momentum Chart', 'text' => 'Visualizes earnings curves generated from live orders over time.', 'icon' => 'fas fa-chart-line'],
                        ['title' => 'Active Orders KPI Tracker', 'text' => 'Aggregates Total Revenue, Total Orders, Active Orders, and Product Count.', 'icon' => 'fas fa-tachometer-alt'],
                        ['title' => 'Order Flow Bar Graph', 'text' => 'Presents order volumes classified by active states (preparing, on the way, delivered).', 'icon' => 'fas fa-chart-bar']
                    ]
                ],
                [
                    'title' => 'Admin: Real-time Order Operations Manager',
                    'image' => 'project-images/ordering_admin_orders.png',
                    'features' => [
                        ['title' => 'Status Update Panel', 'text' => 'Single-click dropdown controls to mark orders as Processing, On the Way, Delivered, or Cancelled.', 'icon' => 'fas fa-edit'],
                        ['title' => 'Consolidated Order Table', 'text' => 'Detailed records showing Order ID, Customer Name, Item Summary, and Total Price.', 'icon' => 'fas fa-list-alt']
                    ]
                ],
                [
                    'title' => 'Admin: Inventory & Product Catalog Editor',
                    'image' => 'project-images/ordering_admin_products.png',
                    'features' => [
                        ['title' => 'Add/Edit Product Wizards', 'text' => 'Admin tools to create, edit, or delete items from the menu.', 'icon' => 'fas fa-plus-circle'],
                        ['title' => 'Detailed Meta Data Cards', 'text' => 'Shows item status (Active/Inactive), rating stars, ingredients count, and price.', 'icon' => 'fas fa-info-circle']
                    ]
                ],
                [
                    'title' => 'Admin: Customer Lifetime Value Directory',
                    'image' => 'project-images/ordering_admin_customers.png',
                    'features' => [
                        ['title' => 'Customer Details Table', 'text' => 'Displays registered name, email, phone, and dynamic status flags.', 'icon' => 'fas fa-users'],
                        ['title' => 'Spending Aggregator', 'text' => 'Tracks total lifetime spending and total order counts per client profile.', 'icon' => 'fas fa-dollar-sign']
                    ]
                ],
                [
                    'title' => 'Admin: Business Performance & Reports Generator',
                    'image' => 'project-images/ordering_admin_reports.png',
                    'features' => [
                        ['title' => 'Status Allocation Chart', 'text' => 'Pie/donut distribution chart showing the percentage of delivered vs. active orders.', 'icon' => 'fas fa-chart-pie'],
                        ['title' => 'Daily Sales Performance', 'text' => 'Tracks gross revenues, units sold, and menu coverage indicators.', 'icon' => 'fas fa-calendar-day']
                    ]
                ]
            ]
        ],
        [
            'title' => 'PureSafe',
            'slug' => 'puresafe',
            'subtitle' => 'Sleek customer portal for ordering purified water gallons, tracking delivery, and managing subscriptions.',
            'description' => 'Online purified water ordering platform with gallon selections, scheduling, and billing.',
            'technologies' => ['Laravel', 'React', 'PostgreSQL', 'Tailwind CSS', 'Vite', 'FontAwesome'],
            'image' => 'project-images/inventory.png',
            'demo' => 'https://web-app-users.vercel.app',
            'github' => 'https://github.com/lyshandave/puresafe',
            'featured' => true,
            'my_role' => 'Full-stack Developer & Database Designer',
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'MVC / Decoupled',
                'Type' => 'Web Platform',
                'Collaboration' => 'Family Business'
            ],
            'problem' => 'Household water delivery orders were traditionally managed via messy chat threads, causing delivery delays, lost orders, and inaccurate empty container records.',
            'challenges' => 'Calculating dynamic billing with empty container deposit offsets, and organizing order schedules based on address sub-regions.',
            'solution' => 'Designed a dynamic cart logic that subtracts empty container deposits and grouped customer schedules by geographic zones.',
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
            ],
            'development_process' => [
                'Customer Journey Mapping',
                'Database Modeling for Subscriptions & Orders',
                'API Integration for Cart Calculations',
                'UI Implementation with Dark Mode Support',
                'Simulated Billing and Route Testing',
                'Deployment'
            ],
            'results' => [
                'Created a centralized customer dashboard for water refilling.',
                'Automated calculations of empty gallon return balances.',
                'Streamlined delivery coordinates for dispatchers.'
            ],
            'lessons_learned' => [
                'Deepened skills in complex React state-management (cart & deposits).',
                'Learned how to group relational database queries for delivery zones.',
                'Enhanced UI responsiveness for mobile users ordering on the go.'
            ],
            'future_improvements' => [
                'Integration with Twilio SMS Gateway for automated status dispatches.',
                'Interactive map pins for delivery routes.',
                'Driver companion mobile layout.'
            ],
            'showcase_sections' => [
                [
                    'title' => 'Customer: Secure Authentication Gateway',
                    'image' => 'project-images/puresafe_login.png',
                    'features' => [
                        ['title' => 'Sign In Modal', 'text' => 'Welcome Back modal interface prompting for email and password credential entries.', 'icon' => 'fas fa-sign-in-alt'],
                        ['title' => 'Google SSO Integration', 'text' => 'Allows fast authorization using active Google profile sessions.', 'icon' => 'fab fa-google'],
                        ['title' => 'Secure Signup Gateway', 'text' => 'Direct path for new customers to configure primary delivery accounts.', 'icon' => 'fas fa-user-plus']
                    ]
                ],
                [
                    'title' => 'Customer: Home Landing Experience',
                    'image' => 'project-images/puresafe_banner.png',
                    'features' => [
                        ['title' => 'Hero Brand Message', 'text' => 'Introduces Pure Safe with a clean water-themed landing screen and clear product navigation.', 'icon' => 'fas fa-water'],
                        ['title' => 'Customer Navigation', 'text' => 'Provides quick access to products, accessories, water dispensers, account controls, search, and cart.', 'icon' => 'fas fa-compass']
                    ]
                ],
                [
                    'title' => 'Customer: Categorized Product & Accessories Directory',
                    'image' => 'project-images/puresafe_catalog.png',
                    'features' => [
                        ['title' => 'Categorized Drops', 'text' => 'Dropdown selectors separating Bottled Water, Round Containers, Family Bundles, and Slim Containers.', 'icon' => 'fas fa-chevron-down'],
                        ['title' => 'Equipment & Dispensers', 'text' => 'Catalog grid for automatic water pumps, heavy-duty jug stands, and electronic water dispensers.', 'icon' => 'fas fa-blender-phone'],
                        ['title' => 'Direct Add to Cart', 'text' => 'One-click item addition with live counts syncing to the main navigation header.', 'icon' => 'fas fa-shopping-basket']
                    ]
                ],
                [
                    'title' => 'Customer: Accessories Shop Directory',
                    'image' => 'project-images/puresafe_accessories.png',
                    'features' => [
                        ['title' => 'Spare Caps and Locks', 'text' => 'Add-ons and parts catalog enabling clients to buy replacement caps.', 'icon' => 'fas fa-cog'],
                        ['title' => 'Heavy-Duty Stands', 'text' => 'Allows users to purchase durable vertical metal stands for holding multiple water containers.', 'icon' => 'fas fa-layer-group']
                    ]
                ],
                [
                    'title' => 'Customer: Water Dispensers Catalog',
                    'image' => 'project-images/puresafe_dispenser.png',
                    'features' => [
                        ['title' => 'Tabletop & Standing Models', 'text' => 'Browse and order hot/cold water dispensers directly from the platform.', 'icon' => 'fas fa-blender-phone']
                    ]
                ],
                [
                    'title' => 'Customer: Order Checkout & Payment Wizard',
                    'image' => 'project-images/puresafe_checkout.png',
                    'features' => [
                        ['title' => 'Profile Delivery Address', 'text' => 'Displays active delivery markers, contact details, and client addresses.', 'icon' => 'fas fa-map-marker-alt'],
                        ['title' => 'Promo Code Engine', 'text' => 'Includes apply controls for coupon discount calculations.', 'icon' => 'fas fa-tag'],
                        ['title' => 'Flexible Payment Choices', 'text' => 'Supports Cash on Delivery (COD), Credit Card, and Wallet & Points systems.', 'icon' => 'fas fa-wallet']
                    ]
                ],
                [
                    'title' => 'Customer: User Profile Dashboard',
                    'image' => 'project-images/puresafe_profile.png',
                    'features' => [
                        ['title' => 'Sidebar Navigation List', 'text' => 'Fast switches between Profile, Addresses, Favorites, Orders, Notifications, and Subscriptions.', 'icon' => 'fas fa-list-ul'],
                        ['title' => 'Recent Orders Tracking', 'text' => 'List of past order codes showing dynamic status badges (Delivered/Pending) and total values.', 'icon' => 'fas fa-receipt'],
                        ['title' => 'Personal Information Card', 'text' => 'Presents full name, active email coordinates, and user phone numbers with edit wizard controls.', 'icon' => 'fas fa-user-edit']
                    ]
                ],
                [
                    'title' => 'Customer: Corporate Services & Contacts',
                    'image' => 'project-images/puresafe_about.png',
                    'features' => [
                        ['title' => 'Our Services', 'text' => 'Dedicated cards highlighting multi-stage reverse osmosis filtration processes.', 'icon' => 'fas fa-concierge-bell'],
                        ['title' => 'Quick Contact Directory', 'text' => 'Clear layout of verified phone coordinates, email channels, and physical warehouse addresses.', 'icon' => 'fas fa-map-marked-alt']
                    ]
                ]
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
            'github' => 'https://github.com/lyshandave/school-management-system',
            'featured' => true,
            'my_role' => 'Full-stack Developer & Database Designer',
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'Independent Refactor',
                'Type' => 'School Admin Portal',
                'Collaboration' => 'Academic System'
            ],
            'problem' => 'Paper enrollment systems and manual grade computation sheets caused administrative backlogs, data entry duplication, and course/classroom booking conflicts.',
            'challenges' => 'Preventing schedule overlaps for instructors and classrooms while keeping the grade computation matrix fast and responsive.',
            'solution' => 'Developed database-level overlap queries and built high-performance Vue.js grid components for calculating grade averages in real-time.',
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
            ],
            'development_process' => [
                'Requirements Analysis & Interviewing Admin Staff',
                'Relational Database Normalization (3NF)',
                'API Development with Laravel Resource Collections',
                'Inertia.js Integration with Vue Components',
                'Schedule Overlap Validation Setup',
                'Testing & Local Server Deployment'
            ],
            'results' => [
                'Consolidated school records into a secure central database.',
                'Reduced registration processing times from hours to minutes.',
                'Eliminated scheduling overlaps for classrooms and courses.'
            ],
            'lessons_learned' => [
                'Gained expertise in Vue.js and Inertia.js data hydration routing.',
                'Learned how to solve complex database locking & collision errors.',
                'Understood the value of user testing with actual administrators.'
            ],
            'future_improvements' => [
                'Student/Parent grades portal with SMS alerts.',
                'Digital payment integrations for tuition fees.',
                'Automated section allocation based on academic performance.'
            ],
            'showcase_sections' => [
                [
                    'title' => 'Portal: Administrator Dashboard & Records',
                    'image' => 'project-images/school.png',
                    'features' => [
                        ['title' => 'Centralized Student Directory', 'text' => 'Consolidates student transcripts, tuition balances, and academic histories in a searchable index.', 'icon' => 'fas fa-id-card'],
                        ['title' => 'Enrollment Wizard Pipeline', 'text' => 'Digital registration wizards that auto-assign sections and course materials to enrolling students.', 'icon' => 'fas fa-user-plus']
                    ]
                ],
                [
                    'title' => 'Portal: Academic Grading Sheets',
                    'image' => 'project-images/school.png',
                    'features' => [
                        ['title' => 'Professors Grading Grids', 'text' => 'Secure professor tables that compile exam results and automatically calculate semester GPA averages.', 'icon' => 'fas fa-table'],
                        ['title' => 'Report Card Exporters', 'text' => 'Generates and downloads print-ready PDF transcript documents.', 'icon' => 'fas fa-file-pdf']
                    ]
                ],
                [
                    'title' => 'Portal: Interactive Schedule Coordinator',
                    'image' => 'project-images/school.png',
                    'features' => [
                        ['title' => 'Calendar Overlap Validator', 'text' => 'Algorithmic checks that prevent instructor, classroom, and course time scheduling conflicts.', 'icon' => 'fas fa-calendar-times']
                    ]
                ]
            ]
        ],
        [
            'title' => 'StreamGrab',
            'slug' => 'streamgrab',
            'subtitle' => 'A high-speed media downloader supporting MP4/MP3 downloads across YouTube, TikTok, Facebook, and Instagram.',
            'description' => 'Multi-platform downloader allowing users to easily convert and save videos/audio in high definition.',
            'technologies' => ['React', 'Node.js', 'Express', 'Tailwind CSS', 'FFmpeg', 'Vite'],
            'image' => 'project-images/grade-evaluation.png',
            'demo' => 'https://downloader-khaki-six.vercel.app',
            'github' => 'https://github.com/lyshandave/streamgrab',
            'featured' => true,
            'my_role' => 'Full-stack Developer',
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'REST API / SPA',
                'Type' => 'Media Tool',
                'Collaboration' => 'Open Source'
            ],
            'problem' => 'Most online video downloaders are bloated with intrusive ads, redirect popups, malware risks, and have very slow file compilation pipelines.',
            'challenges' => 'Piping streaming data chunks in real-time, executing background FFmpeg processes, and clean up temporary files to avoid server storage blockages.',
            'solution' => 'Built an async queue worker for FFmpeg tasks, and created automated cron routines that delete temp files immediately after download completion.',
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
            ],
            'development_process' => [
                'Scraper & Extraction API Investigation',
                'Node.js Server Setup with Express & Async Queues',
                'FFmpeg Path Mapping & Stream Piping Configuration',
                'React Frontend & Download Progress Bar Sync',
                'Temp File Cleanup Scheduler Integration',
                'Production Vercel Serverless Sync'
            ],
            'results' => [
                'Created a completely ad-free, secure downloading gateway.',
                'Achieved conversion times under 5 seconds for medium-sized clips.',
                'Maintained 100% temporary file cleanup success, preventing server storage leaks.'
            ],
            'lessons_learned' => [
                'Learned how to pipe streams dynamically in Node.js.',
                'Familiarized with background threading and process spawning.',
                'Learned how to handle serverless hosting timeouts.'
            ],
            'future_improvements' => [
                'Batch playlist downloading configurations.',
                'Dedicated browser extension integration.',
                'Support for high-definition 4K rendering.'
            ],
            'showcase_sections' => [
                [
                    'title' => 'System Module: Link Extractor & Language Gateway',
                    'image' => 'project-images/streamgrab_home.png',
                    'features' => [
                        ['title' => 'One-Click Extraction Input', 'text' => 'Paste-and-go URL bar with a quick "Paste" button to quickly grab streaming URLs.', 'icon' => 'fas fa-paste'],
                        ['title' => 'Multi-Language Localization', 'text' => 'Searchable language selection dropdown supporting 18 international languages (e.g. English, Chinese, Arabic, French).', 'icon' => 'fas fa-language'],
                        ['title' => 'Auto Platform Detection', 'text' => 'Instantly identifies stream origins from YouTube, TikTok, or Facebook links.', 'icon' => 'fas fa-search-plus']
                    ]
                ],
                [
                    'title' => 'System Module: Feature Highlights & Workflow Timelines',
                    'image' => 'project-images/streamgrab_workflow.png',
                    'features' => [
                        ['title' => 'Feature Specifications', 'text' => 'Showcases key performance indicators (Fast Downloads, Multi-Platform, No Registration).', 'icon' => 'fas fa-layer-group'],
                        ['title' => 'Three-Step Guides', 'text' => 'Clean visual instructions detailing (1) Paste URL, (2) Choose Format (MP4/MP3), and (3) Download files.', 'icon' => 'fas fa-route']
                    ]
                ],
                [
                    'title' => 'System Module: FAQ Accordion Panel',
                    'image' => 'project-images/streamgrab_faq.png',
                    'features' => [
                        ['title' => 'Interactive Accordions', 'text' => 'Smooth dropdown cards addressing common usage questions (e.g. video quality formats, system safety, account registration requirements).', 'icon' => 'fas fa-question-circle']
                    ]
                ]
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
            'github' => null,
            'featured' => false,
            'my_role' => 'Network Engineer',
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'Cisco Packet Tracer',
                'Type' => 'LAN Layout',
                'Collaboration' => 'Academic Project'
            ],
            'problem' => 'An office network without department separation faces security risks (e.g., guest networks accessing HR records), IP conflict delays, and lacked voice service support.',
            'challenges' => 'Designing an efficient IP subnetting plan, separating voice and data traffic, and deploying centralized DHCP/DNS resources.',
            'solution' => 'Configured distinct VLANs for departments, mapped Voice VLANs for IP phones, and provisioned servers for automated IP and name resolution.',
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
            ],
            'development_process' => [
                'Office Floor Plan Requirements Gathering',
                'IP Subnet Design & Subnet Mask Calculations',
                'Switch Port Allocation & VLAN Configuration',
                'DHCP Helper Address & Voice VLAN Mapping',
                'DNS & Local Mail Server Setup',
                'Ping & Communication Pathway Verification'
            ],
            'results' => [
                'Successfully modeled a fully working multi-department network.',
                'IP phones configured to automatically register and place local calls.',
                'Secure guest access provided without access to local private networks.'
            ],
            'lessons_learned' => [
                'Deepened comprehension of dynamic host configuration protocols.',
                'Mastered Inter-VLAN routing using router-on-a-stick configurations.',
                'Learned how to configure voice QoS over switch configurations.'
            ],
            'future_improvements' => [
                'Deploy ASA Firewalls at the network edge.',
                'Implement HSRP for gateway redundancy.',
                'Integrate SNMP for active device monitoring.'
            ],
            'showcase_sections' => [
                [
                    'title' => 'Subsystem: VLAN Segregation & Security',
                    'image' => 'project-images/office-network.png',
                    'features' => [
                        ['title' => 'Broadcast Domain Partitioning', 'text' => 'Isolates department subnet traffic (HR, Accounting) to prevent unauthorized private file access.', 'icon' => 'fas fa-network-wired'],
                        ['title' => 'Secure IP Subnetting Scheme', 'text' => 'Optimized address allocation maps ensuring dynamic scalability per department.', 'icon' => 'fas fa-project-diagram']
                    ]
                ],
                [
                    'title' => 'Subsystem: Centralized Server Services',
                    'image' => 'project-images/office-network.png',
                    'features' => [
                        ['title' => 'Central Server Provisioning', 'text' => 'Hosts local DNS directory lookups, DHCP address pools, and private SMTP mail services.', 'icon' => 'fas fa-server']
                    ]
                ],
                [
                    'title' => 'Subsystem: VoIP & Wireless AP Configurations',
                    'image' => 'project-images/office-network.png',
                    'features' => [
                        ['title' => 'Voice Traffic Prioritization', 'text' => 'Quality of Service (QoS) configurations prioritizing VoIP packets to ensure clear IP phone calls.', 'icon' => 'fas fa-phone-alt'],
                        ['title' => 'Lightweight Wireless APs', 'text' => 'SSID configurations enabling seamless wireless roaming across the office floor.', 'icon' => 'fas fa-wifi']
                    ]
                ]
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
            'github' => null,
            'featured' => false,
            'my_role' => 'Network Security Engineer',
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'Cisco Packet Tracer',
                'Type' => 'Secure Network',
                'Collaboration' => 'Academic Project'
            ],
            'problem' => 'Large enterprise networks require dynamic routing and firewall policies to block security attacks and isolate public-facing web resources.',
            'challenges' => 'Configuring Cisco ASA 5505/5506 security rules, routing dynamic traffic over multiple OSPF areas, and setting up DMZ regions.',
            'solution' => 'Deployed firewall policies with strict ACL profiles, configured multi-area OSPF routing, and isolated public servers inside a dedicated DMZ.',
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
            ],
            'development_process' => [
                'Network Security Threat Modeling',
                'OSPF Area Allocation Design',
                'Switch Layer EtherChannel Grouping',
                'Cisco ASA Interface Security Level Assignment',
                'Static NAT & ACL Policy Rule Configurations',
                'Simulated Ping Sweep & Attack Pathway Testing'
            ],
            'results' => [
                'OSPF converged routing tables automatically across all areas.',
                'Firewalls filtered unauthorized pings while allowing HTTP traffic.',
                'Redundant connections handled simulated link breakdowns under 2 seconds.'
            ],
            'lessons_learned' => [
                'Learned how stateful firewalls handle traffic inspection.',
                'Understood multi-area OSPF route advertisement parameters.',
                'Learned how to set up EtherChannel load balancing.'
            ],
            'future_improvements' => [
                'Setup VPN tunnels for remote office connections.',
                'Implement dynamic NAT overload for public IP mapping.',
                'Upgrade routers to support BGP dynamic routing.'
            ],
            'showcase_sections' => [
                [
                    'title' => 'Subsystem: Edge Security & ASA Firewall Routing',
                    'image' => 'project-images/firewall-network.png',
                    'features' => [
                        ['title' => 'ASA Stateful Inspection', 'text' => 'Firewall policy configurations blocking external pings while securing outbound network requests.', 'icon' => 'fas fa-shield-alt'],
                        ['title' => 'Security Level Allocations', 'text' => 'Configures strict Access Control Lists (ACLs) to manage traffic crossing network borders.', 'icon' => 'fas fa-lock']
                    ]
                ],
                [
                    'title' => 'Subsystem: Dynamic OSPF Routing',
                    'image' => 'project-images/firewall-network.png',
                    'features' => [
                        ['title' => 'Multi-Area OSPF Convergence', 'text' => 'Dynamically advertises and updates routing tables across multiple router nodes.', 'icon' => 'fas fa-route']
                    ]
                ],
                [
                    'title' => 'Subsystem: Isolated Demilitarized Zone (DMZ)',
                    'image' => 'project-images/firewall-network.png',
                    'features' => [
                        ['title' => 'DMZ Server Isolation', 'text' => 'Separates public-facing HTTP web servers from sensitive intranet file systems.', 'icon' => 'fas fa-server']
                    ]
                ]
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
            'github' => null,
            'featured' => false,
            'my_role' => 'Network Engineer',
            'overview' => [
                'Lead Developer' => 'Lyshan Dave',
                'Architecture' => 'Cisco Packet Tracer',
                'Type' => 'Multi-Branch Network',
                'Collaboration' => 'Academic Project'
            ],
            'problem' => 'Multi-site corporations require seamless connection links to sync data across physical locations, and central controllers to manage multiple wireless access points.',
            'challenges' => 'Configuring dynamic routing over WAN connections and mapping wireless profiles across multiple lightweight access points.',
            'solution' => 'Implemented WAN connections using OSPF routing and deployed Centralized Wireless LAN Controllers (WLCs) for dynamic AP management.',
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
            ],
            'development_process' => [
                'Branch Connection Requirements Gathering',
                'IP Address Scheme Layout Mapping',
                'WAN Serial Interface Configuration',
                'OSPF Routing Advertisements Deployment',
                'Wireless WLC & Lightweight AP Association Setup',
                'Connectivity & Roaming Failure Tests'
            ],
            'results' => [
                'Dynamic WAN routes connected physical branches together.',
                'WAP roaming verified with active laptop ping tests.',
                'Subnet DHCP scopes resolved IP leases successfully.'
            ],
            'lessons_learned' => [
                'Learned how WLCs distribute wireless configuration profiles.',
                'Mastered OSPF area routing and WAN configuration standards.',
                'Enhanced network diagnostic skills using route tracking commands.'
            ],
            'future_improvements' => [
                'Deploy VPN protocols (IPsec) to encrypt branch data packets.',
                'Set up BGP routing for multi-home ISP configurations.',
                'Implement QoS profiles for priority video conference routing.'
            ],
            'showcase_sections' => [
                [
                    'title' => 'Subsystem: Inter-Branch WAN Dynamic Routing',
                    'image' => 'project-images/multi-branch.png',
                    'features' => [
                        ['title' => 'OSPF WAN Routing', 'text' => 'Configures path optimizations to link three physical building subnets over provider serial lines.', 'icon' => 'fas fa-project-diagram']
                    ]
                ],
                [
                    'title' => 'Subsystem: WLC-Managed Wireless Association',
                    'image' => 'project-images/multi-branch.png',
                    'features' => [
                        ['title' => 'Centralized WLC Association', 'text' => 'Pipes lightweight access point configurations dynamically from a central Wireless LAN Controller.', 'icon' => 'fas fa-wifi']
                    ]
                ],
                [
                    'title' => 'Subsystem: Gateway Redundancy & Recovery',
                    'image' => 'project-images/multi-branch.png',
                    'features' => [
                        ['title' => 'Fast Link Recovery Protocols', 'text' => 'EtherChannel bundling and failover route pathways designed to restore down connections in under 2 seconds.', 'icon' => 'fas fa-link']
                    ]
                ]
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
