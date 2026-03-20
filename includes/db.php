<?php
/**
 * Local database for list_of_users_A (Company A).
 * Uses SQLite - no external DB server required.
 */

$dbPath = dirname(__DIR__) . '/data/company_a.db';

function getDb(): PDO {
    global $dbPath;
    $dir = dirname($dbPath);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create table if not exists
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS list_of_users_A (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            department TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    // Seed initial data if empty
    $count = $pdo->query("SELECT COUNT(*) FROM list_of_users_A")->fetchColumn();
    if ($count == 0) {
        $stmt = $pdo->prepare("INSERT INTO list_of_users_A (name, email, department) VALUES (?, ?, ?)");
        $users = [
            ['Mary Smith', 'mary.smith@email.com', 'Marketing'],
            ['John Wang', 'john.wang@email.com', 'Engineering'],
            ['Alex Bington', 'alex.bington@email.com', 'Sales'],
            ['Sarah Johnson', 'sarah.j@email.com', 'Creative'],
            ['Michael Chen', 'm.chen@email.com', 'Support'],
        ];
        foreach ($users as $u) $stmt->execute($u);
    }
    
    return $pdo;
}

/**
 * Get list_of_users_A from local database (normal PHP database call).
 */
function getLocalUsers(): array {
    $pdo = getDb();
    $stmt = $pdo->query("SELECT id, name, email, department FROM list_of_users_A ORDER BY name");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return array_map(function ($r) {
        return [
            'id' => (int)$r['id'],
            'name' => $r['name'],
            'email' => $r['email'],
            'department' => $r['department'] ?? '',
        ];
    }, $rows);
}
