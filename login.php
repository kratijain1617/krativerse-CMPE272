<?php
$pageTitle = 'Admin Login';
$currentPage = 'login';
require_once 'includes/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = trim($_POST['userid'] ?? '');
    $password = $_POST['password'] ?? '';
    if (empty($userid) || empty($password)) {
        $error = 'Please enter both user ID and password.';
    } elseif (verifyCredentials($userid, $password)) {
        $_SESSION['admin_userid'] = $userid;
        $_SESSION['admin_login_at'] = time();
        $redirect = $_GET['redirect'] ?? 'secure/users.php';
        header('Location: ' . $redirect);
        exit;
    } else {
        $error = 'Invalid user ID or password.';
    }
}

if (isLoggedIn()) {
    header('Location: secure/users.php');
    exit;
}

include 'includes/header.php';
?>

<section class="login-section">
    <div class="login-box">
        <h1>Administrator Login</h1>
        <p class="login-subtitle">Sign in to access the secure section</p>
        <?php if ($error): ?>
            <p class="login-error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="post" class="login-form">
            <label>
                <span>User ID</span>
                <input type="text" name="userid" value="<?php echo htmlspecialchars($_POST['userid'] ?? ''); ?>" required autofocus placeholder="admin">
            </label>
            <label>
                <span>Password</span>
                <input type="password" name="password" required>
            </label>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
