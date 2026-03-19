<?php
$pageTitle = 'Products & Services';
require_once 'includes/products_data.php';
?>
<?php include 'includes/header.php'; ?>

<section class="hero">
  <h1>Products & Services</h1>
  <p>
    Choose a service to view details. Visiting a product page updates your
    <strong>Recently Viewed</strong> and <strong>Most Visited</strong> cookies.
  </p>
  <div class="btn-row">
    <a class="btn secondary" href="recently_viewed.php">Last 5 Recently Viewed</a>
    <a class="btn secondary" href="most_visited.php">Top 5 Most Visited</a>
  </div>
</section>

<div class="grid">
  <?php foreach ($PRODUCTS as $p): ?>
    <div class="card product-card">
      <img src="<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
      <div class="product-meta">
        <h3><?php echo htmlspecialchars($p['name']); ?></h3>
        <span class="badge"><?php echo htmlspecialchars(strtoupper($p['id'])); ?></span>
      </div>
      <p class="muted"><?php echo htmlspecialchars($p['short']); ?></p>
      <div class="btn-row">
        <a class="btn primary" href="<?php echo htmlspecialchars($p['page']); ?>">View</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>

