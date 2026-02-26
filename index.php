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
            <a href="resonance.php" class="btn btn-primary btn-large" data-analytics="started_flow">Generate Your Treatment Pack (Free)</a>
            <a href="packages.php" class="btn btn-secondary">View Packages</a>
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

<section class="how-it-works" id="howItWorks">
    <h2>How It Works</h2>
    <div class="steps-grid">
        <div class="step-card">
            <span class="step-num">1</span>
            <h3>Resonance Finder</h3>
            <p>Answer 12 quick questions about your brand, audience, and goals. Takes 3–5 minutes.</p>
        </div>
        <div class="step-card">
            <span class="step-num">2</span>
            <h3>Treatment Pack</h3>
            <p>Get a personalized Creative Treatment Pack — script outline, shot list, visual direction, and production plan.</p>
        </div>
        <div class="step-card">
            <span class="step-num">3</span>
            <h3>Shoot</h3>
            <p>We bring your vision to life. Pre-pro, shoot, post — we handle it all.</p>
        </div>
        <div class="step-card">
            <span class="step-num">4</span>
            <h3>Deliverables</h3>
            <p>Receive polished content in all the formats you need — 16:9, 9:16, 1:1, and more.</p>
        </div>
    </div>
    <a href="resonance.php" class="btn btn-primary" data-analytics="started_flow">Start Resonance Finder</a>
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

<section class="packages-preview">
    <h2>Packages</h2>
    <p class="packages-intro">Clear deliverables, transparent pricing. No surprises.</p>
    <div class="packages-mini">
        <div class="pkg-mini"><strong>Starter</strong> — From $5K · 1 video, 2 cuts</div>
        <div class="pkg-mini featured"><strong>Growth</strong> — From $15K · Hero + 3 social cuts</div>
        <div class="pkg-mini"><strong>Scale</strong> — From $40K · Campaign suite</div>
    </div>
    <a href="packages.php" class="btn btn-secondary">View All Packages</a>
</section>

<section class="cta-section">
    <div class="cta-content">
        <h2>Ready to bring your vision to life?</h2>
        <p>Get your free Creative Treatment Pack — no obligation.</p>
        <a href="resonance.php" class="btn btn-primary" data-analytics="started_flow">Generate Your Treatment Pack (Free)</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
