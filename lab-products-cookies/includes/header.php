<?php
// Simple shared header for the cookie lab pages.
$pageTitle = $pageTitle ?? 'Home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> | Echo Creative Studio (Lab)</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="index.php">Echo Creative Studio <span class="pill">Products Cookies Lab</span></a>
            <nav class="nav">
                <a href="index.php">Home</a>
                <a href="products.php">Products/Services</a>
                <a href="recently_viewed.php">Recently Viewed</a>
                <a href="most_visited.php">Most Visited</a>
            </nav>
        </div>
    </header>
    <main class="container">

