/**
 * projectData — Portfolio Projects Configuration
 * Centralized list of projects shown in the modal.
 * Easy to add/edit links and details.
 */
const projectData = {
    project1: {
        title: 'Network Simulator', 
        image: 'images/project1.jpg',
        desc: 'Interactive network topology visualization with drag-and-drop components, real-time packet simulation, and VLAN configuration.',
        features: ['Drag and drop network components', 'Real-time packet flow visualization', 'Sample topology templates', 'Interactive device connections'],
        tech: ['HTML5 Canvas', 'JavaScript', 'CSS3'],
        demo: 'http://network-simulator.wuaze.com', 
        code: 'https://github.com/Lyshandave/network-simulator'
    },
    project2: {
        title: 'Server Monitor Dashboard', 
        image: 'images/project2.jpg',
        desc: 'Real-time server monitoring dashboard with CPU, memory, disk, and network traffic animated charts.',
        features: ['Real-time CPU and memory monitoring', 'Animated charts and graphs', 'Service status tracking', 'Disk usage visualization'],
        tech: ['JavaScript', 'Canvas API', 'CSS3'],
        demo: 'http://server-dashboard.wuaze.com', 
        code: 'https://github.com/Lyshandave/server-dashboard'
    },
    project4: {
        title: 'PC Diagnostic Tool', 
        image: 'images/project4.jpg',
        desc: 'Interactive PC hardware diagnostic simulator with component testing, error detection, and repair recommendations.',
        features: ['Visual PC component layout', 'Individual component tests', 'Diagnostic logging', 'Report generation'],
        tech: ['JavaScript', 'HTML5', 'CSS3'],
        demo: 'http://pc-diagnostic.wuaze.com', 
        code: 'https://github.com/Lyshandave/pc-diagnostic'
    },
    project_cisco1: {
        title: 'Multi-Branch Office Network', 
        image: 'images/project_cisco1.png',
        desc: 'Cisco Packet Tracer — multi-branch office with routers, switches, wireless APs, servers, and inter-branch routing across 3 buildings.',
        features: ['3 interconnected branch offices', 'Wired and wireless devices', 'Server and printer infrastructure per branch', 'IP routing and inter-branch connectivity'],
        tech: ['Cisco Packet Tracer', 'Networking', 'IP Addressing'],
        demo: null, 
        code: 'https://drive.google.com/drive/folders/1Dkoxpbqz1E2KY3iK27qOyi8RmRuNoec9?usp=sharing'
    },
    project_cisco2: {
        title: 'Multi-Area Network with Firewall', 
        image: 'images/project_cisco2.png',
        desc: 'Cisco Packet Tracer — 3-area hierarchical network with ISP, firewalls (550X), routers, and distribution/access layer switching.',
        features: ['3 network areas with ISP core', 'Firewall (550X) per area', 'Hierarchical design: core, distribution, access', 'Redundant links and inter-area routing'],
        tech: ['Cisco Packet Tracer', 'VLAN', 'Routing'],
        demo: null, 
        code: 'https://drive.google.com/drive/folders/1Dkoxpbqz1E2KY3iK27qOyi8RmRuNoec9?usp=sharing'
    },
    project_cisco3: {
        title: 'Office Floor Plan Network Design', 
        image: 'images/project_cisco3.png',
        desc: 'Cisco Packet Tracer — full office floor plan with department VLANs, IP phones, wireless APs, and DNS/DHCP/Mail servers.',
        features: ['Department VLANs: Employees, HR, Accountant, Manager, Secretary, Store, Meeting, Guest', 'Voice VLAN (VLAN 20) for IP phones', 'DNS, Mail, and DHCP servers in dedicated server room', 'Wireless access points for meeting room and mobile devices'],
        tech: ['Cisco Packet Tracer', 'DHCP', 'DNS'],
        demo: null, 
        code: 'https://drive.google.com/drive/folders/1Dkoxpbqz1E2KY3iK27qOyi8RmRuNoec9?usp=sharing'
    }
};
