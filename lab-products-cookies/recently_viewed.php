<?php
// Recently viewed report page
require_once 'includes/products_data.php';
require_once 'includes/cookie_helpers.php';

$pageTitle = 'Recently Viewed (Last 5)';
$recentIds = get_recently_viewed();
$byId = products_by_id($PRODUCTS);

// Build display list in cookie order
$recentProducts = [];
foreach ($recentIds as $id) {
    if (isset($byId[$id])) $recentProducts[] = $byId[$id];
}

include 'includes/header.php';
?>

<section class="hero">
  <h1>Recently Viewed</h1>
  <p>Your last 5 <strong>unique</strong> visited product pages (most recent first).</p>
  <div class="btn-row">
    <a class="btn secondary" href="products.php">Browse Products</a>
    <a class="btn secondary" href="most_visited.php">Most Visited</a>
  </div>
</section>

<?php if (empty($recentProducts)): ?>
  <div class="card" style="margin-top: 18px;">
    <h3>No history yet</h3>
    <p class="muted">Visit a few product pages, then come back here.</p>
    <a class="btn primary" href="products.php">Go to Products</a>
  </div>
<?php else: ?>
  <div class="grid">
    <?php foreach ($recentProducts as $p): ?>
      <div class="card product-card">
        <img src="<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
        <div class="product-meta">
          <h3><?php echo htmlspecialchars($p['name']); ?></h3>
          <span class="badge"><?php echo htmlspecialchars(strtoupper($p['id'])); ?></span>
        </div>
        <p class="muted"><?php echo htmlspecialchars($p['short']); ?></p>
        <div class="btn-row">
          <a class="btn primary" href="<?php echo htmlspecialchars($p['page']); ?>">Open</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>

