<?php
/**
 * feedback.php — Comments & Portfolio Rating Handler
 * Storage: JSON flat-files (no database required)
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
error_reporting(0);
ini_set('display_errors', 0);

// ── Storage paths ─────────────────────────────────────────────────────
define('DATA_DIR',      __DIR__ . '/data');
define('COMMENTS_FILE', DATA_DIR . '/comments.json');
define('RATINGS_FILE',  DATA_DIR . '/ratings.json');

// Ensure data directory exists and is protected
if (!is_dir(DATA_DIR)) {
    mkdir(DATA_DIR, 0755, true);
    // Write .htaccess to block direct web access to /data/
    file_put_contents(DATA_DIR . '/.htaccess', "Order allow,deny\nDeny from all\n");
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$action = $_GET['action'] ?? '';

// ── Router ────────────────────────────────────────────────────────────
switch ($action) {
    case 'get_comments': getComments();    break;
    case 'post_comment': postComment();    break;
    case 'get_rating':   getRating();      break;
    case 'post_rating':  postRating();     break;
    case 'delete_comment': deleteComment(); break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}
exit;

function deleteComment(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); echo json_encode(['success'=>false,'message'=>'POST required.']); return;
    }

    // Simple admin token check — matches sessionStorage key set by JS
    $token = $_POST['admin_token'] ?? '';
    if ($token !== 'dave_admin_2025') {
        http_response_code(403);
        echo json_encode(['success'=>false,'message'=>'Unauthorized.']);
        return;
    }

    $id   = sanitize($_POST['id'] ?? '', 64);
    if (!$id) { echo json_encode(['success'=>false,'message'=>'Missing comment ID.']); return; }

    $data     = readJson(COMMENTS_FILE);
    $comments = $data['comments'] ?? [];
    $original = count($comments);
    $comments = array_values(array_filter($comments, fn($c) => $c['id'] !== $id));

    if (count($comments) === $original) {
        echo json_encode(['success'=>false,'message'=>'Comment not found.']); return;
    }

    $data['comments'] = $comments;
    if (writeJson(COMMENTS_FILE, $data)) {
        echo json_encode(['success'=>true]);
    } else {
        http_response_code(500);
        echo json_encode(['success'=>false,'message'=>'Could not save changes.']);
    }
}

// ── Helpers ───────────────────────────────────────────────────────────

function readJson(string $file): array {
    if (!file_exists($file)) return [];
    $content = file_get_contents($file);
    return json_decode($content, true) ?? [];
}

function writeJson(string $file, array $data): bool {
    return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
}

function sanitize(string $str, int $maxLen = 500): string {
    return htmlspecialchars(trim(mb_substr($str, 0, $maxLen)), ENT_QUOTES, 'UTF-8');
}

function clientIp(): string {
    foreach (['HTTP_CF_CONNECTING_IP','HTTP_X_FORWARDED_FOR','REMOTE_ADDR'] as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(explode(',', $_SERVER[$key])[0]);
            if (filter_var($ip, FILTER_VALIDATE_IP)) return $ip;
        }
    }
    return 'unknown';
}

function rateLimited(string $store, string $ip, int $windowSec = 120, int $maxHits = 2): bool {
    $data     = readJson($store);
    $limits   = $data['_rate_limits'] ?? [];
    $now      = time();
    $key      = md5($ip);
    $entry    = $limits[$key] ?? ['hits' => 0, 'window_start' => $now];

    if ($now - $entry['window_start'] > $windowSec) {
        $entry = ['hits' => 0, 'window_start' => $now];
    }

    if ($entry['hits'] >= $maxHits) return true;

    $entry['hits']++;
    $data['_rate_limits'][$key] = $entry;
    writeJson($store, $data);
    return false;
}

// ── Actions ───────────────────────────────────────────────────────────

function getComments(): void {
    $data     = readJson(COMMENTS_FILE);
    $comments = $data['comments'] ?? [];
    // Return newest first, strip internal fields
    $public = array_map(fn($c) => [
        'id'      => $c['id'],
        'name'    => $c['name'],
        'message' => $c['message'],
        'date'    => $c['date'],
        'avatar'  => $c['avatar'],
    ], array_reverse($comments));
    echo json_encode(['success' => true, 'comments' => $public, 'total' => count($comments)]);
}

function postComment(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); echo json_encode(['success'=>false,'message'=>'POST required.']); return;
    }

    $ip = clientIp();
    if (rateLimited(COMMENTS_FILE, $ip, 300, 3)) {
        http_response_code(429);
        echo json_encode(['success'=>false,'message'=>'Too many comments. Please wait a few minutes.']);
        return;
    }

    // Honeypot
    $honeypot = $_POST['website'] ?? '';
    if (!empty($honeypot)) {
        echo json_encode(['success'=>true,'message'=>'Comment posted!']); return;
    }

    $name    = sanitize($_POST['name']    ?? '', 60);
    $message = sanitize($_POST['message'] ?? '', 500);

    if (strlen($name) < 2)    { echo json_encode(['success'=>false,'message'=>'Name must be at least 2 characters.']); return; }
    if (strlen($message) < 2) { echo json_encode(['success'=>false,'message'=>'Comment must be at least 2 characters.']); return; }

    $data     = readJson(COMMENTS_FILE);
    $comments = $data['comments'] ?? [];

    // Generate avatar color from name
    $colors  = ['#0ea5e9','#8b5cf6','#22c55e','#f59e0b','#ef4444','#06b6d4','#ec4899','#f97316'];
    $avatar  = $colors[abs(crc32($name)) % count($colors)];
    $initial = mb_strtoupper(mb_substr(strip_tags($name), 0, 1));

    $comments[] = [
        'id'      => uniqid('c', true),
        'name'    => $name,
        'message' => $message,
        'date'    => date('Y-m-d H:i:s'),
        'avatar'  => $avatar,
        'initial' => $initial,
        'ip'      => md5($ip), // hashed — never store raw IPs
    ];
    $data['comments'] = $comments;

    if (writeJson(COMMENTS_FILE, $data)) {
        echo json_encode(['success'=>true,'message'=>'Comment posted!','comment'=>[
            'id'=>end($comments)['id'],'name'=>$name,'message'=>$message,
            'date'=>end($comments)['date'],'avatar'=>$avatar,'initial'=>$initial,
        ]]);
    } else {
        http_response_code(500);
        echo json_encode(['success'=>false,'message'=>'Could not save comment. Check server write permissions.']);
    }
}

function getRating(): void {
    $data    = readJson(RATINGS_FILE);
    $ratings = $data['ratings'] ?? [];
    $total   = count($ratings);
    $avg     = $total > 0 ? round(array_sum(array_column($ratings,'score')) / $total, 1) : 0;
    $dist    = [1=>0, 2=>0, 3=>0, 4=>0, 5=>0];
    foreach ($ratings as $r) $dist[(int)$r['score']]++;
    echo json_encode(['success'=>true,'average'=>$avg,'total'=>$total,'distribution'=>$dist]);
}

function postRating(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); echo json_encode(['success'=>false,'message'=>'POST required.']); return;
    }

    $score = (int)($_POST['score'] ?? 0);
    if ($score < 1 || $score > 5) {
        echo json_encode(['success'=>false,'message'=>'Rating must be between 1 and 5.']); return;
    }

    $ip      = md5(clientIp());
    $data    = readJson(RATINGS_FILE);
    $ratings = $data['ratings'] ?? [];

    // Find existing rating from this IP — update it instead of blocking
    $found = false;
    foreach ($ratings as &$r) {
        if (($r['ip'] ?? '') === $ip) {
            $r['score'] = $score;
            $r['date']  = date('Y-m-d H:i:s');
            $found = true;
            break;
        }
    }
    unset($r);

    // First-time rating — append
    if (!$found) {
        $ratings[] = ['score' => $score, 'date' => date('Y-m-d H:i:s'), 'ip' => $ip];
    }

    $data['ratings'] = $ratings;
    $total = count($ratings);
    $avg   = round(array_sum(array_column($ratings, 'score')) / $total, 1);

    $msg = $found ? 'Rating updated! Thanks. ⭐' : 'Thanks for rating! ⭐';

    if (writeJson(RATINGS_FILE, $data)) {
        echo json_encode(['success'=>true,'message'=>$msg,'average'=>$avg,'total'=>$total]);
    } else {
        http_response_code(500);
        echo json_encode(['success'=>false,'message'=>'Could not save rating. Check server write permissions.']);
    }
}
