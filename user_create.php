<?php
$pageTitle = 'Create User';
$currentPage = 'users';

require_once __DIR__ . '/includes/mysql_users_db.php';

$errors = [];
$success = '';
$input = [
    'first_name' => '',
    'last_name' => '',
    'email' => '',
    'home_address' => '',
    'home_phone' => '',
    'cell_phone' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($input as $key => $value) {
        $input[$key] = trim($_POST[$key] ?? '');
    }

    if ($input['first_name'] === '') $errors[] = 'First name is required.';
    if ($input['last_name'] === '') $errors[] = 'Last name is required.';
    if ($input['email'] === '' || !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    }
    if ($input['home_address'] === '') $errors[] = 'Home address is required.';
    if ($input['home_phone'] === '') $errors[] = 'Home phone is required.';
    if ($input['cell_phone'] === '') $errors[] = 'Cell phone is required.';

    if (!$errors) {
        try {
            $pdo = getUsersMysqlPdo();
            $stmt = $pdo->prepare(
                'INSERT INTO users (first_name, last_name, email, home_address, home_phone, cell_phone)
                 VALUES (:first_name, :last_name, :email, :home_address, :home_phone, :cell_phone)'
            );
            $stmt->execute($input);
            $success = 'User created successfully.';
            foreach ($input as $key => $value) {
                $input[$key] = '';
            }
        } catch (Throwable $e) {
            $errors[] = getMysqlErrorMessage($e);
        }
    }
}

include 'includes/header.php';
?>

<section class="page-hero">
    <h1>Create User</h1>
    <p class="page-subtitle">Add a user to your MySQL users table</p>
</section>

<section class="users-form-wrap">
    <div class="users-form-card">
        <?php if ($success): ?>
            <p class="form-success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <?php if (!empty($errors)): ?>
            <div class="form-error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" class="users-form">
            <label>First Name
                <input type="text" name="first_name" required value="<?php echo htmlspecialchars($input['first_name']); ?>">
            </label>
            <label>Last Name
                <input type="text" name="last_name" required value="<?php echo htmlspecialchars($input['last_name']); ?>">
            </label>
            <label>Email
                <input type="email" name="email" required value="<?php echo htmlspecialchars($input['email']); ?>">
            </label>
            <label>Home Address
                <textarea name="home_address" required rows="3"><?php echo htmlspecialchars($input['home_address']); ?></textarea>
            </label>
            <label>Home Phone
                <input type="text" name="home_phone" required value="<?php echo htmlspecialchars($input['home_phone']); ?>">
            </label>
            <label>Cell Phone
                <input type="text" name="cell_phone" required value="<?php echo htmlspecialchars($input['cell_phone']); ?>">
            </label>
            <button type="submit" class="btn btn-primary">Create User</button>
            <a href="users.php" class="btn btn-secondary">Back to Users</a>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

