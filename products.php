<?php
$pageTitle = 'Products & Services';
$currentPage = 'products';

// Reuse the lab product data so we have 10 concrete offerings.
require_once __DIR__ . '/lab-products-cookies/includes/products_data.php';

include 'includes/header.php';
?>

<section class="page-hero">
    <h1>Products & Services</h1>
    <p class="page-subtitle">End-to-end creative solutions for your brand</p>
</section>

<section class="products-content">
    <div class="product-grid">
        <article class="product-card">
            <div class="product-header">
                <span class="product-icon">🎬</span>
                <h2>Video Production</h2>
            </div>
            <p>From concept to final cut, we produce high-impact videos that drive engagement. Our services include:</p>
            <ul>
                <li>Commercial & Advertisement</li>
                <li>Corporate & Brand Films</li>
                <li>Documentaries & Short Films</li>
                <li>Product Launch Videos</li>
                <li>Event Coverage & Highlights</li>
            </ul>
        </article>

        <article class="product-card">
            <div class="product-header">
                <span class="product-icon">📸</span>
                <h2>Photography</h2>
            </div>
            <p>Professional photography services tailored to your needs:</p>
            <ul>
                <li>Product Photography</li>
                <li>Corporate Headshots & Team Portraits</li>
                <li>Event & Conference Photography</li>
                <li>Lifestyle & Editorial</li>
                <li>Architecture & Real Estate</li>
            </ul>
        </article>

        <article class="product-card">
            <div class="product-header">
                <span class="product-icon">✨</span>
                <h2>Brand & Design</h2>
            </div>
            <p>Build a cohesive visual identity that stands out:</p>
            <ul>
                <li>Logo & Brand Identity</li>
                <li>Motion Graphics & Animation</li>
                <li>Social Media Content</li>
                <li>Marketing Collateral</li>
                <li>Packaging Design</li>
            </ul>
        </article>

        <article class="product-card">
            <div class="product-header">
                <span class="product-icon">📱</span>
                <h2>Digital Content</h2>
            </div>
            <p>Content that performs across all platforms:</p>
            <ul>
                <li>Social Media Videos</li>
                <li>YouTube & Streaming Content</li>
                <li>Podcast Production</li>
                <li>Live Streaming</li>
                <li>Webinars & Virtual Events</li>
            </ul>
        </article>
    </div>

    <div class="products-cta">
        <p>Interested in a custom package? We tailor our services to fit your unique needs and budget.</p>
        <a href="contacts.php" class="btn btn-primary">Request a Quote</a>
    </div>
</section>

<section class="products-content">
    <h2 style="text-align:center;margin-bottom:2rem;">Production Packages</h2>
    <div class="product-grid">
        <?php foreach ($PRODUCTS as $p): ?>
            <article class="product-card">
                <div class="product-header">
                    <span class="product-icon">🎥</span>
                    <h2><?php echo htmlspecialchars($p['name']); ?></h2>
                </div>
                <p><?php echo htmlspecialchars($p['short']); ?></p>
                <div style="margin-top:0.75rem;display:flex;justify-content:space-between;align-items:center;gap:0.5rem;">
                    <span style="font-size:0.8rem;color:var(--color-text-muted);">
                        ID: <?php echo htmlspecialchars(strtoupper($p['id'])); ?>
                    </span>
                    <a
                        href="lab-products-cookies/<?php echo htmlspecialchars($p['page']); ?>"
                        class="btn btn-primary"
                        style="padding:0.5rem 1.2rem;font-size:0.9rem;"
                    >
                        View Details
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
