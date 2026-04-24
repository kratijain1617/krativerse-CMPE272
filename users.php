<?php
$pageTitle = 'Users';
$currentPage = 'users';
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

<?php include 'includes/footer.php'; ?>

