<?php
$pageTitle = 'Home';
$currentPage = 'home';
include 'includes/header.php';
?>

<section class="hero">
    <div class="hero-content">
        <h1>Stories that <span class="highlight">Resonate</span></h1>
        <p class="hero-tagline">We craft compelling video content and creative media that connects brands with audiences.</p>
        <div class="hero-cta">
            <a href="products.php" class="btn btn-primary">Our Services</a>
            <a href="contacts.php" class="btn btn-secondary">Get in Touch</a>
        </div>
    </div>
    <div class="hero-visual">
        <div class="hero-shapes">
            <span class="hero-rec">REC</span>
            <div class="hero-frame"></div>
            <div class="hero-frame hero-frame-alt"></div>
        </div>
    </div>
</section>

<section class="features">
    <h2>What We Do</h2>
    <div class="feature-grid">
        <article class="feature-card">
            <div class="feature-icon">🎬</div>
            <h3>Video Production</h3>
            <p>Commercials, documentaries, corporate videos, and cinematic storytelling that captivates.</p>
        </article>
        <article class="feature-card">
            <div class="feature-icon">📸</div>
            <h3>Photography</h3>
            <p>Stunning visuals for brands, events, and editorial content that make an impact.</p>
        </article>
        <article class="feature-card">
            <div class="feature-icon">✨</div>
            <h3>Creative Branding</h3>
            <p>Identity design, motion graphics, and visual storytelling that builds recognition.</p>
        </article>
    </div>
</section>

<section class="cta-section">
    <div class="cta-content">
        <h2>Ready to bring your vision to life?</h2>
        <p>Let's create something extraordinary together.</p>
        <a href="contacts.php" class="btn btn-primary">Start a Project</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
