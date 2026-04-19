<?php

/**
 * Contact Form Handler
 * Requires: vendor/autoload.php (PHPMailer via Composer)
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
error_reporting(0);
ini_set('display_errors', 0);

// ── Config ────────────────────────────────────────────────────────────
define('SMTP_HOST',      'smtp.gmail.com');
define('SMTP_PORT',      587);
define('SMTP_USER',      'lyshandavet@gmail.com');
define('SMTP_PASS',      'sbzmjtypmfceduyg'); // Matches 16-char app password format
define('MAIL_TO',        'lyshandavet@gmail.com');
define('MAIL_FROM_NAME', 'Portfolio Contact Form');
// ─────────────────────────────────────────────────────────────────────

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $response['message'] = 'Method not allowed.';
    echo json_encode($response);
    exit;
}

// Honeypot anti-spam
if (!empty($_POST['website'])) {
    $response['success'] = true;
    $response['message'] = 'Message sent successfully!';
    echo json_encode($response);
    exit;
}

// Sanitise & validate
$name    = htmlspecialchars(trim($_POST['name']    ?? ''), ENT_QUOTES, 'UTF-8');
$email   = trim($_POST['email']   ?? '');
$subject = htmlspecialchars(trim($_POST['subject'] ?? ''), ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars(trim($_POST['message'] ?? ''), ENT_QUOTES, 'UTF-8');

$errors = [];
if (strlen($name) < 2)                          $errors[] = 'Please enter your name (at least 2 characters).';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';
if (empty($subject))                            $errors[] = 'Please enter a subject.';
if (strlen($message) < 1)                       $errors[] = 'Please enter a message.';

if (!empty($errors)) {
    $response['message'] = implode(' ', $errors);
    echo json_encode($response);
    exit;
}

// Try PHPMailer
$mailSent = false;
$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
}

if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = SMTP_PORT;
        $mail->Timeout    = 15;
        $mail->SMTPOptions = ['ssl' => [
            'verify_peer'       => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true,
        ]];
        $mail->setFrom(SMTP_USER, MAIL_FROM_NAME);
        $mail->addAddress(MAIL_TO);
        $mail->addReplyTo($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Portfolio Contact: ' . $subject;
        $mail->Body    = buildHtmlEmail($name, $email, $subject, $message);
        $mail->AltBody = buildPlainEmail($name, $email, $subject, $message);
        $mail->send();
        $mailSent = true;
    } catch (Exception $e) {
        error_log('[send.php] PHPMailer Error: ' . $mail->ErrorInfo);
        $response['debug'] = $mail->ErrorInfo;
    }
}

if (!$mailSent) {
    $response['message'] = 'Could not deliver your message. Please email ' . MAIL_TO . ' directly.';
    if (isset($response['debug'])) {
        // Optional: you can show info to user if desired, but default is generic
    }
    echo json_encode($response);
    exit;
}

$response['success']   = true;
$response['message']   = 'Message sent successfully!';
$response['mail_sent'] = true;
echo json_encode($response);
exit;

// ── Email templates ───────────────────────────────────────────────────

function buildHtmlEmail(string $name, string $email, string $subject, string $message): string
{
    $date = date('F j, Y g:i A');
    $ip   = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $host = $_SERVER['HTTP_HOST']   ?? 'Unknown';
    // Inline CSS is intentional — email clients strip external stylesheets
    return "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'>
<style>
body{font-family:'Segoe UI',Arial,sans-serif;background:#f4f4f4;margin:0;padding:0}
.wrap{max-width:600px;margin:20px auto;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.1)}
.hdr{background:linear-gradient(135deg,#0ea5e9,#8b5cf6);color:#fff;padding:30px;text-align:center}
.hdr h1{margin:0;font-size:22px}.hdr p{margin:8px 0 0;opacity:.9;font-size:13px}
.body{padding:30px}
.field{margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #eee}
.field:last-of-type{border:none}
.lbl{font-size:11px;font-weight:700;color:#0ea5e9;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px}
.val{font-size:15px;color:#333}
.msg{background:#f8f9fa;padding:16px;border-radius:8px;white-space:pre-wrap;word-wrap:break-word}
.ftr{background:#f8f9fa;padding:16px 30px;text-align:center;font-size:11px;color:#888}
</style></head><body>
<div class='wrap'>
  <div class='hdr'><h1>&#128236; New Contact Message</h1><p>From Your Portfolio</p></div>
  <div class='body'>
    <div class='field'><div class='lbl'>Name</div><div class='val'>{$name}</div></div>
    <div class='field'><div class='lbl'>Email</div><div class='val'><a href='mailto:{$email}'>{$email}</a></div></div>
    <div class='field'><div class='lbl'>Subject</div><div class='val'>{$subject}</div></div>
    <div class='field'><div class='lbl'>Message</div><div class='msg'>{$message}</div></div>
  </div>
  <div class='ftr'>Host: {$host} | IP: {$ip} | Date: {$date}</div>
</div></body></html>";
}

function buildPlainEmail(string $name, string $email, string $subject, string $message): string
{
    $date = date('F j, Y g:i A');
    $ip   = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    return "NEW CONTACT MESSAGE\n====================\n"
        . "Name   : {$name}\nEmail  : {$email}\nSubject: {$subject}\n\n"
        . "Message:\n{$message}\n\n"
        . "--------------------\nIP: {$ip} | Date: {$date}\n";
}
