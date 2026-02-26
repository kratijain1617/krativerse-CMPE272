<?php
/**
 * Saves lead (email + consent) to JSON file.
 * Stores submissions for Treatment Pack download / quote requests.
 */
header('Content-Type: application/json');

$dataDir = dirname(__DIR__) . '/data';
$file = $dataDir . '/leads.json';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || empty($data['email'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Email required']);
    exit;
}

if (empty($data['consent']) || $data['consent'] !== true) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Consent required']);
    exit;
}

$lead = [
    'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
    'name' => isset($data['name']) ? trim($data['name']) : '',
    'session_id' => $data['session_id'] ?? '',
    'action' => $data['action'] ?? 'download', // download | quote | call
    'consent' => true,
    'created_at' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
];

$leads = [];
if (file_exists($file)) {
    $content = file_get_contents($file);
    $leads = json_decode($content, true) ?: [];
}

$leads[] = $lead;

if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

if (file_put_contents($file, json_encode($leads, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to save']);
}
