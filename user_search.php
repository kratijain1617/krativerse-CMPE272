<?php
$pageTitle = 'Search Users';
$currentPage = 'users';

require_once __DIR__ . '/includes/mysql_users_db.php';

$q = trim($_GET['q'] ?? '');
$results = [];
$searchError = '';

if ($q !== '') {
    try {
        $pdo = getUsersMysqlPdo();
        $stmt = $pdo->prepare(
            'SELECT id, first_name, last_name, email, home_address, home_phone, cell_phone
             FROM users
             WHERE first_name LIKE :term
                OR last_name LIKE :term
                OR email LIKE :term
                OR home_phone LIKE :term
                OR cell_phone LIKE :term
             ORDER BY last_name, first_name'
        );
        $term = '%' . $q . '%';
        $stmt->execute(['term' => $term]);
        $results = $stmt->fetchAll();
    } catch (Throwable $e) {
        $searchError = 'Search failed. Check MySQL setup and table creation.';
    }
}

include 'includes/header.php';
?>

<section class="page-hero">
    <h1>Search Users</h1>
    <p class="page-subtitle">Search by name, email, or phone</p>
</section>

<section class="users-form-wrap">
    <div class="users-form-card">
        <form method="get" class="users-form users-search-form">
            <label>Search Keyword
                <input type="text" name="q" placeholder="Ex: Mary, @email.com, 408" value="<?php echo htmlspecialchars($q); ?>">
            </label>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="users.php" class="btn btn-secondary">Back to Users</a>
        </form>
    </div>

    <?php if ($searchError): ?>
        <p class="form-error"><?php echo htmlspecialchars($searchError); ?></p>
    <?php endif; ?>

    <?php if ($q !== ''): ?>
        <div class="users-document users-search-results">
            <div class="document-header">
                <h2>Search Results</h2>
                <p><?php echo count($results); ?> match(es) for "<?php echo htmlspecialchars($q); ?>"</p>
            </div>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Home Address</th>
                        <th>Home Phone</th>
                        <th>Cell Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$results): ?>
                        <tr><td colspan="6">No users found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($results as $i => $user): ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['home_address']); ?></td>
                                <td><?php echo htmlspecialchars($user['home_phone']); ?></td>
                                <td><?php echo htmlspecialchars($user['cell_phone']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>

