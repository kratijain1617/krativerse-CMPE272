<?php
$pageTitle = 'Home';
include 'includes/header.php';
?>

<section class="hero">
  <h1>Products/Services Cookies Lab</h1>
  <p>
    This mini-site demonstrates a Products/Services section with <strong>10 products</strong>,
    each on its own PHP page. We track <strong>last 5 recently viewed</strong> products and the
    <strong>top 5 most visited</strong> products using <strong>PHP cookies</strong>.
  </p>
  <div class="btn-row">
    <a class="btn primary" href="products.php">Browse Products/Services</a>
    <a class="btn secondary" href="recently_viewed.php">See Recently Viewed</a>
    <a class="btn secondary" href="most_visited.php">See Most Visited</a>
  </div>
</section>

<div class="grid">
  <div class="card">
    <h3>What this lab proves</h3>
    <p class="muted">
      Cookies are set with <code>setcookie()</code> before output, and read using <code>$_COOKIE</code>.
      Data is stored as JSON using <code>json_encode()</code> / <code>json_decode()</code>.
    </p>
  </div>
  <div class="card">
    <h3>Company theme</h3>
    <p class="muted">
      Echo Creative Studio offers production services and content packages for modern brands.
      The “products” are realistic services you could buy.
    </p>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

