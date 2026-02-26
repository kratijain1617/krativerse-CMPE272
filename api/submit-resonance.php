<?php
/**
 * Saves Resonance Finder responses to JSON file.
 * PHP reads/writes to data/resonance_submissions.json
 */
header('Content-Type: application/json');

$dataDir = dirname(__DIR__) . '/data';
$file = $dataDir . '/resonance_submissions.json';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$submission = [
    'session_id' => $data['session_id'] ?? uniqid('rf_', true),
    'responses' => $data['responses'] ?? [],
    'created_at' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
];

// Load existing submissions
$submissions = [];
if (file_exists($file)) {
    $content = file_get_contents($file);
    $submissions = json_decode($content, true) ?: [];
}

$submissions[] = $submission;

if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

if (file_put_contents($file, json_encode($submissions, JSON_PRETTY_PRINT))) {
    echo json_encode([
        'success' => true,
        'session_id' => $submission['session_id'],
        'redirect' => 'treatment-pack.php?sid=' . urlencode($submission['session_id'])
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to save']);
}
