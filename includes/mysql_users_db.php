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

