<?php
$pageTitle = 'Users';
$currentPage = 'users';
require_once __DIR__ . '/includes/mysql_users_db.php';

$dbError = '';
$totalUsers = null;
$recentUsers = [];
try {
    $pdo = getUsersMysqlPdo();
    $totalUsers = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    $stmt = $pdo->query(
        'SELECT first_name, last_name, email, home_phone, cell_phone
         FROM users ORDER BY id DESC LIMIT 10'
    );
    $recentUsers = $stmt->fetchAll();
} catch (Throwable $e) {
    $dbError = getMysqlErrorMessage($e);
}
include 'includes/header.php';
?>

<section class="page-hero">
    <h1>User Section</h1>
    <p class="page-subtitle">Create and search company users in MySQL</p>
</section>

<section class="users-hub">
    <article class="users-hub-card">
        <h2>Create User</h2>
        <p>Add a new user with first name, last name, email, address, and phone numbers.</p>
        <a href="user_create.php" class="btn btn-primary">Open User Creation Form</a>
    </article>

    <article class="users-hub-card">
        <h2>Search Users</h2>
        <p>Search users by first/last name, email, home phone, or cell phone.</p>
        <a href="user_search.php" class="btn btn-secondary">Open User Search Form</a>
    </article>
</section>

<section class="users-form-wrap">
    <?php if ($dbError): ?>
        <p class="form-error"><?php echo htmlspecialchars($dbError); ?></p>
    <?php else: ?>
        <div class="users-document">
            <div class="document-header">
                <h2>Cloud SQL Users Preview</h2>
                <p><?php echo $totalUsers; ?> total user(s) in database</p>
            </div>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Home Phone</th>
                        <th>Cell Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$recentUsers): ?>
                        <tr><td colspan="5">No users found in database.</td></tr>
                    <?php else: ?>
                        <?php foreach ($recentUsers as $i => $u): ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><?php echo htmlspecialchars($u['first_name'] . ' ' . $u['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($u['email']); ?></td>
                                <td><?php echo htmlspecialchars($u['home_phone']); ?></td>
                                <td><?php echo htmlspecialchars($u['cell_phone']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>

