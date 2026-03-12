<?php
/**
 * Administrator authentication using userid and password.
 * Credentials stored in data/admin_credentials.txt (userid|password_hash).
 * Uses PHP sessions for login state.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$authCredentialsFile = dirname(__DIR__) . '/data/admin_credentials.txt';

/**
 * Ensure admin credentials file exists with valid hash.
 * Creates file with admin/admin123 if missing.
 */
function initCredentialsFile($file) {
    if (file_exists($file)) return;
    $dir = dirname($file);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    file_put_contents($file, "admin|$hash");
}

/**
 * Verify userid and password against credentials file.
 * @return bool True if valid
 */
function verifyCredentials($userid, $password) {
    global $authCredentialsFile;
    initCredentialsFile($authCredentialsFile);
    $lines = file($authCredentialsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        $parts = explode('|', $line, 2);
        if (count($parts) === 2 && trim($parts[0]) === $userid) {
            return password_verify($password, trim($parts[1]));
        }
    }
    return false;
}

/**
 * Check if current user is logged in as admin.
 */
function isLoggedIn() {
    return isset($_SESSION['admin_userid']) && $_SESSION['admin_userid'] === 'admin';
}

/**
 * Require admin login. Redirect to login if not authenticated.
 */
function requireAuth() {
    if (!isLoggedIn()) {
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        $base = ($scriptDir === '/' || $scriptDir === '\\') ? '' : dirname($scriptDir);
        $loginPath = rtrim($base ?: '', '/') . '/login.php';
        header('Location: ' . $loginPath . '?redirect=' . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
}
