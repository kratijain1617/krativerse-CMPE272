<?php
$pageTitle = 'Packages';
$currentPage = 'packages';
include 'includes/header.php';
?>

<section class="page-hero">
    <h1>Packages</h1>
    <p class="page-subtitle">Clear deliverables, transparent pricing</p>
</section>

<section class="packages-content">
    <div class="packages-grid">
        <article class="package-card">
            <h2>Starter</h2>
            <p class="package-price">From $5,000</p>
            <ul>
                <li>1 video up to 60 seconds</li>
                <li>2 cuts (16:9 + 9:16)</li>
                <li>1-day shoot</li>
                <li>Script + shot list</li>
                <li>2 revision rounds</li>
                <li>Delivery in 4 weeks</li>
            </ul>
            <a href="resonance.php" class="btn btn-secondary" data-analytics="started_flow">Get Treatment Pack</a>
        </article>

        <article class="package-card featured">
            <span class="package-badge">Most Popular</span>
            <h2>Growth</h2>
            <p class="package-price">From $15,000</p>
            <ul>
                <li>1 hero video + 3 social cuts</li>
                <li>4 formats (16:9, 9:16, 1:1, 4:5)</li>
                <li>2-day shoot</li>
                <li>Creative treatment + storyboard</li>
                <li>3 revision rounds</li>
                <li>B-roll library</li>
                <li>Delivery in 6 weeks</li>
            </ul>
            <a href="resonance.php" class="btn btn-primary" data-analytics="started_flow">Get Treatment Pack</a>
        </article>

        <article class="package-card">
            <h2>Scale</h2>
            <p class="package-price">From $40,000</p>
            <ul>
                <li>Campaign suite (3–5 videos)</li>
                <li>All platform formats</li>
                <li>3–5 day shoot</li>
                <li>Full creative production</li>
                <li>Unlimited revisions</li>
                <li>Dedicated producer</li>
                <li>Delivery in 8–10 weeks</li>
            </ul>
            <a href="contacts.php" class="btn btn-secondary">Request Quote</a>
        </article>
    </div>

    <div class="packages-cta">
        <p>Not sure which package fits? Run the <a href="resonance.php">Resonance Finder</a> for a personalized Treatment Pack.</p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
