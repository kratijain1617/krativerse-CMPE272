<?php
require_once dirname(__DIR__) . '/config/mysql_config.php';

/**
 * Returns PDO connection to MySQL for lab users table.
 */
function getUsersMysqlPdo(): PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        MYSQL_HOST,
        MYSQL_PORT,
        MYSQL_DB_NAME
    );

    $pdo = new PDO($dsn, MYSQL_DB_USER, MYSQL_DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $pdo;
}

/**
 * Returns a safe error message for UI/debug.
 */
function getMysqlErrorMessage(Throwable $e): string {
    $message = $e->getMessage();
    if (stripos($message, 'SQLSTATE[HY000] [2002]') !== false) {
        return 'Database host unreachable. Verify Cloud SQL IP and authorized networks.';
    }
    if (stripos($message, 'Access denied for user') !== false) {
        return 'Access denied. Check MYSQL_DB_USER / MYSQL_DB_PASS.';
    }
    if (stripos($message, 'Unknown database') !== false) {
        return 'Database not found. Check MYSQL_DB_NAME.';
    }
    if (stripos($message, "Table") !== false && stripos($message, "doesn't exist") !== false) {
        return 'Users table missing. Run sql/users_schema_seed.sql on Cloud SQL.';
    }
    return 'Database error: ' . $message;
}

