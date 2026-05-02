<?php
/**
 * gemini.php — Server-side proxy for Google Gemini API
 * Works on XAMPP (localhost) and InfinityFree (deployment)
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

// Hide errors from output
error_reporting(0);
ini_set('display_errors', 0);

// ── Load API key ──────────────────────────────────────────
$configFile = __DIR__ . '/config.php';
if (file_exists($configFile)) {
    require_once $configFile;
}

if (empty($GOOGLE_API_KEY)) {
    $GOOGLE_API_KEY = getenv('GOOGLE_API_KEY') ?: '';
}

// Fallback for local testing (User should replace this in config.php)
if (empty($GOOGLE_API_KEY)) {
    $GOOGLE_API_KEY = 'YOUR_GOOGLE_API_KEY_HERE';
}

if (empty($GOOGLE_API_KEY) || $GOOGLE_API_KEY === 'YOUR_GOOGLE_API_KEY_HERE') {
    echo json_encode(['error' => 'Google API key not configured. Please set it in config.php.']);
    exit;
}

// ── Validate request ──────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'POST required.']);
    exit;
}

$body = json_decode(file_get_contents('php://input'), true);
if (!isset($body['messages']) || !is_array($body['messages'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request.']);
    exit;
}

// ── Convert messages to Gemini format ─────────────────────
$contents = [];
$lastRole = null;
foreach ($body['messages'] as $msg) {
    // Client uses 'user' and 'bot'
    $role = ($msg['role'] === 'bot' || $msg['role'] === 'assistant' || $msg['role'] === 'model') ? 'model' : 'user';
    
    // Gemini requires alternating roles. If same role as last, skip or combine? 
    // Usually user and model alternate in chat.
    if ($role === $lastRole) continue; 
    
    $contents[] = [
        'role'  => $role,
        'parts' => [['text' => $msg['content']]]
    ];
    $lastRole = $role;
}

// Gemini requires the first message to be from 'user' (usually)
if (!empty($contents) && $contents[0]['role'] === 'model') {
    array_shift($contents);
}

// ── System instruction ────────────────────────────────────
$systemPrompt = "You are Dave's personal AI assistant on his portfolio website. Talk like a real, friendly person — casual but professional. 
You represent Lyshan Dave B. Tomo, a Computer Technician from Quezon City, Philippines.

About Dave:
- Full name: Lyshan Dave B. Tomo
- Role: Computer Technician & IT Specialist
- Location: 701 Commonwealth Avenue, Quezon City, Philippines
- Email: lyshandavet@gmail.com | Phone: 09623885226
- Available for work and freelance projects

Skills: Linux, HTML, CSS, JavaScript, PHP, Git, Cisco networking, hardware repair/assembly, server setup, cybersecurity basics, LAN/WAN configuration, TCP/IP, IP addressing, OS installation, troubleshooting

Projects:
1. Network Simulator — interactive topology tool (HTML/CSS/JS)
2. Server Monitor Dashboard — real-time stats with animated charts
3. PC Diagnostic Tool — hardware diagnostic simulator
4. Multi-Branch Office Network (Cisco Packet Tracer)
5. Multi-Area Network with Firewall (Cisco Packet Tracer)
6. Office Floor Plan Network Design with VLANs (Cisco Packet Tracer)

Certifications:
- Cisco Networking Basics (Dec 2025)
- TESDA NC II Computer Systems Servicing (Apr 2024)

Personality: Be conversational and natural. Use contractions. Be warm and helpful. Don't be robotic. 
Keep answers concise (2–4 sentences unless they ask for more detail).
Answer in English or Tagalog depending on what the user uses.";

$payload = json_encode([
    'contents' => $contents,
    'systemInstruction' => [
        'parts' => [['text' => $systemPrompt]]
    ],
    'generationConfig' => [
        'maxOutputTokens' => 512,
        'temperature'     => 0.7,
    ]
]);

// ── Call Gemini API ───────────────────────────────────────
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $GOOGLE_API_KEY;

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_TIMEOUT        => 20,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_SSL_VERIFYPEER => true,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlErr  = curl_error($ch);
curl_close($ch);

if ($curlErr) {
    http_response_code(502);
    echo json_encode(['error' => 'Could not reach Gemini service.']);
    exit;
}

$data = json_decode($response, true);

if ($httpCode !== 200 || empty($data['candidates'][0]['content']['parts'][0]['text'])) {
    http_response_code(502);
    $apiMsg = $data['error']['message'] ?? 'Unknown error from Gemini API.';
    echo json_encode(['error' => $apiMsg]);
    exit;
}

echo json_encode(['reply' => $data['candidates'][0]['content']['parts'][0]['text']]);
