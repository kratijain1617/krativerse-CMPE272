<?php
$pageTitle = 'Website Users (Secure)';
require_once dirname(__DIR__) . '/includes/auth.php';
requireAuth();

/**
 * Read current website users from text file.
 * Format: Name|Email|Join Date
 */
function readWebsiteUsers($filePath = null) {
    $filePath = $filePath ?? dirname(__DIR__) . '/data/website_users.txt';
    $users = [];
    if (file_exists($filePath)) {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            $parts = array_map('trim', explode('|', $line));
            if (count($parts) >= 2) {
                $users[] = [
                    'name' => $parts[0],
                    'email' => $parts[1],
                    'join_date' => $parts[2] ?? ''
                ];
            }
        }
    }
    return $users;
}

$users = readWebsiteUsers();
$currentPage = 'secure';
$basePath = '../';
include dirname(__DIR__) . '/includes/header.php';
?>

<section class="secure-hero">
    <div class="secure-hero-inner">
        <span class="secure-icon">🔒</span>
        <h1>Current Website Users</h1>
        <p class="secure-subtitle">Administrator dashboard</p>
        <div class="secure-meta">
            <span class="secure-badge">Admin</span>
            <span class="secure-count"><?php echo count($users); ?> users</span>
        </div>
    </div>
</section>

<section class="secure-content">
    <div class="secure-toolbar">
        <a href="../index.php" class="btn btn-ghost">← Back to Site</a>
        <a href="../logout.php" class="btn btn-secondary">Logout</a>
    </div>
    <div class="users-document">
        <div class="document-header">
            <h2>User Directory</h2>
            <p>Registered website users</p>
        </div>
        <table class="users-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Join Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $i => $u): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo htmlspecialchars($u['name']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><?php echo htmlspecialchars($u['join_date']); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($users)): ?>
                <tr><td colspan="4">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
