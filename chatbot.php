<?php
/**
 * chatbot.php — Server-side proxy for Claude API
 * Works on XAMPP (localhost) and InfinityFree (deployment)
 * Put your Anthropic API key in config.php (excluded from repo)
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
error_reporting(0);
ini_set('display_errors', 0);

// ── Load API key ──────────────────────────────────────────
// Option 1: config.php (recommended — add to .gitignore)
$configFile = __DIR__ . '/config.php';
if (file_exists($configFile)) {
    require_once $configFile;
}

// Option 2: environment variable (InfinityFree / cPanel)
if (empty($ANTHROPIC_API_KEY)) {
    $ANTHROPIC_API_KEY = getenv('ANTHROPIC_API_KEY') ?: '';
}

// Option 3: fallback hardcoded (for local testing only — remove before going live)
if (empty($ANTHROPIC_API_KEY)) {
    $ANTHROPIC_API_KEY = 'YOUR_API_KEY_HERE';
}

if (empty($ANTHROPIC_API_KEY) || $ANTHROPIC_API_KEY === 'YOUR_API_KEY_HERE') {
    echo json_encode(['error' => 'API key not configured. Please set it in config.php.']);
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

// ── Sanitize & validate messages ─────────────────────────
$messages = [];
foreach ($body['messages'] as $msg) {
    $role    = in_array($msg['role'] ?? '', ['user', 'assistant']) ? $msg['role'] : null;
    $content = mb_substr(trim($msg['content'] ?? ''), 0, 1000);
    if ($role && $content) {
        $messages[] = ['role' => $role, 'content' => $content];
    }
}

if (empty($messages)) {
    echo json_encode(['error' => 'No valid messages.']);
    exit;
}

// ── System prompt ─────────────────────────────────────────
$systemPrompt = <<<PROMPT
You are Dave's personal AI assistant on his portfolio website. Talk like a real, friendly person — casual but professional. 
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

Socials: GitHub: github.com/Lyshandave | Facebook: facebook.com/Dave062 | Instagram: @lyshan_dave | LinkedIn: Lyshan Dave Tomo

Personality: Be like a real person answering on Dave's behalf. Keep it conversational and natural — not robotic. Use contractions. Be warm, helpful, and a little personable. Don't just list facts; talk like a human. 
Keep answers concise (2–4 sentences unless they ask for more detail).
If they ask something you don't know about Dave, honestly say you're not sure and suggest they reach out directly.
PROMPT;

// ── Call Anthropic API ────────────────────────────────────
$payload = json_encode([
    'model'      => 'claude-haiku-4-5-20251001',  // fast & cost-effective for chat
    'max_tokens' => 512,
    'system'     => $systemPrompt,
    'messages'   => $messages
]);

$ch = curl_init('https://api.anthropic.com/v1/messages');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_TIMEOUT        => 20,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'x-api-key: ' . $ANTHROPIC_API_KEY,
        'anthropic-version: 2023-06-01',
    ],
    CURLOPT_SSL_VERIFYPEER => true,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlErr  = curl_error($ch);
curl_close($ch);

if ($curlErr) {
    http_response_code(502);
    echo json_encode(['error' => 'Could not reach AI service. Try again later.']);
    exit;
}

$data = json_decode($response, true);

if ($httpCode !== 200 || empty($data['content'][0]['text'])) {
    http_response_code(502);
    $apiMsg = $data['error']['message'] ?? 'Unknown error from API.';
    echo json_encode(['error' => $apiMsg]);
    exit;
}

echo json_encode(['reply' => $data['content'][0]['text']]);
