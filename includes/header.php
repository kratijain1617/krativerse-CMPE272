<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?>Echo Creative Studio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <nav class="nav-container">
            <a href="index.php" class="logo">Echo<span>Creative</span></a>
            <button class="nav-toggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-menu">
                <li><a href="index.php" <?php echo ($currentPage ?? '') === 'home' ? 'class="active"' : ''; ?>>Home</a></li>
                <li><a href="about.php" <?php echo ($currentPage ?? '') === 'about' ? 'class="active"' : ''; ?>>About</a></li>
                <li><a href="products.php" <?php echo ($currentPage ?? '') === 'products' ? 'class="active"' : ''; ?>>Products & Services</a></li>
                <li><a href="packages.php" <?php echo ($currentPage ?? '') === 'packages' ? 'class="active"' : ''; ?>>Packages</a></li>
                <li><a href="news.php" <?php echo ($currentPage ?? '') === 'news' ? 'class="active"' : ''; ?>>News</a></li>
                <li><a href="contacts.php" <?php echo ($currentPage ?? '') === 'contacts' ? 'class="active"' : ''; ?>>Contact</a></li>
                <li><a href="resonance.php" class="nav-cta">Resonance Finder</a></li>
            </ul>
        </nav>
    </header>
    <main class="main-content">
