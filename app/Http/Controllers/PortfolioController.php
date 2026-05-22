<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display the portfolio index page with Lyshan Dave's authentic structured data.
     *
     * @return \Illuminate\View\View
     */
    /**
     * Display the portfolio index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('portfolio', $this->getPortfolioData());
    }

    /**
     * Display the full Tech Stack page.
     *
     * @return \Illuminate\View\View
     */
    public function techStack()
    {
        return view('tech-stack', $this->getPortfolioData());
    }

    /**
     * Display the full Projects page.
     *
     * @return \Illuminate\View\View
     */
    public function projects()
    {
        return view('projects', $this->getPortfolioData());
    }

    /**
     * Display the full Certifications page.
     *
     * @return \Illuminate\View\View
     */
    public function certifications()
    {
        return view('certifications', $this->getPortfolioData());
    }

    /**
     * Get Lyshan Dave's authentic structured portfolio data.
     *
     * @return array
     */
    public function getPortfolioData()
    {
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
                    'description' => 'Online ordering system for efficient customer transactions and fast checkout.',
                    'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS'],
                    'image' => 'projects/ordering.png',
                    'github' => null,
                    'demo' => 'https://ordering-system-xi.vercel.app',
                    'domain' => 'ordering-system-xi.vercel.app',
                    'featured' => true,
                ],
                [
                    'title' => 'Inventory System',
                    'description' => 'Real-time stock tracking and inventory management solution.',
                    'technologies' => ['Node.js', 'Express', 'MongoDB', 'React'],
                    'image' => 'projects/inventory.png',
                    'github' => null,
                    'demo' => 'https://inventory.lyshandave.com',
                    'domain' => 'inventory.lyshandave.com',
                    'featured' => true,
                ],
                [
                    'title' => 'School Management System',
                    'description' => 'All-in-one administration portal for student records, enrollment, and grading.',
                    'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS'],
                    'image' => 'projects/school.png',
                    'github' => null,
                    'demo' => 'https://school-system.lyshandave.com',
                    'domain' => 'school-system.lyshandave.com',
                    'featured' => true,
                ],
                [
                    'title' => 'Grade-Evaluation',
                    'description' => 'Automated student academic grade evaluation and performance analysis system.',
                    'technologies' => ['Python', 'Django', 'PostgreSQL', 'React'],
                    'image' => 'projects/grade-evaluation.png',
                    'github' => null,
                    'demo' => 'https://grade-evaluation.lyshandave.com',
                    'domain' => 'grade-evaluation.lyshandave.com',
                    'featured' => true,
                ],
                [
                    'title' => 'Office Floor Plan Network',
                    'description' => 'Full office floor plan with department VLANs, IP phones, wireless APs, and DNS/DHCP/Mail servers.',
                    'technologies' => ['Cisco Packet Tracer', 'Networking', 'VLAN', 'Servers'],
                    'image' => 'projects/office-network.png',
                    'github' => null,
                    'demo' => 'https://drive.google.com/drive/folders/PLACEHOLDER_GDRIVE_LINK',
                    'domain' => 'drive.google.com',
                    'featured' => false,
                ],
                [
                    'title' => 'Multi-Area Network with Firewall',
                    'description' => '3-area hierarchical network with ISP, firewalls (550X), routers, and distribution/access layer switching.',
                    'technologies' => ['Cisco Packet Tracer', 'Firewall (550X)', 'Routing & Switching', 'Network Security'],
                    'image' => 'projects/firewall-network.png',
                    'github' => null,
                    'demo' => 'https://drive.google.com/drive/folders/PLACEHOLDER_GDRIVE_LINK',
                    'domain' => 'drive.google.com',
                    'featured' => false,
                ],
                [
                    'title' => 'Multi-Branch Office Network',
                    'description' => 'Cisco Packet Tracer — multi-branch office with routers, switches, wireless APs, and inter-branch routing across 3 buildings.',
                    'technologies' => ['Cisco Packet Tracer', 'Inter-Branch Routing', 'WLAN', 'OSPF'],
                    'image' => 'projects/multi-branch.png',
                    'github' => null,
                    'demo' => 'https://drive.google.com/drive/folders/PLACEHOLDER_GDRIVE_LINK',
                    'domain' => 'drive.google.com',
                    'featured' => false,
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
                'LinkedIn' => [
                    'url' => 'https://www.linkedin.com/in/lyshan-dave-tomo-09166337b/',
                    'icon' => 'fab fa-linkedin',
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
    }
}
