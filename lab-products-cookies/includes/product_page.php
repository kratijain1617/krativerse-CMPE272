<?php
/**
 * Shared product page renderer.
 * Each productX.php sets $productId and includes this file.
 *
 * IMPORTANT: Cookie tracking is done BEFORE any HTML output.
 */

require_once __DIR__ . '/products_data.php';
require_once __DIR__ . '/cookie_helpers.php';

$byId = products_by_id($PRODUCTS);
if (!isset($productId) || !isset($byId[$productId])) {
    header('Location: ../products.php');
    exit;
}

// Cookie tracking (must run before includes/header.php outputs HTML)
track_recently_viewed($productId);
increment_visit_count($productId);

$product = $byId[$productId];
$pageTitle = $product['name'];

include __DIR__ . '/header.php';
?>

<section class="product-page">
  <div class="card product-hero">
    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
    <div class="product-meta" style="margin-top: 14px;">
      <h1 style="margin:0;"><?php echo htmlspecialchars($product['name']); ?></h1>
      <span class="badge"><?php echo htmlspecialchars(strtoupper($product['id'])); ?></span>
    </div>
    <p class="muted" style="margin-top: 10px;"><?php echo htmlspecialchars($product['long']); ?></p>
    <div class="btn-row" style="margin-top: 14px;">
      <a class="btn secondary" href="products.php">← Back to Products/Services</a>
      <a class="btn secondary" href="recently_viewed.php">Recently Viewed</a>
      <a class="btn secondary" href="most_visited.php">Most Visited</a>
    </div>
  </div>

  <aside class="card">
    <h3>Cookie tracking</h3>
    <p class="muted">
      This page visit updates:
      <br>1) <strong>Last 5 Recently Viewed</strong>
      <br>2) <strong>Most Visited</strong> counts
    </p>
    <p class="muted" style="margin-top: 12px;">
      Tip: open several product pages, then check the report pages.
    </p>
  </aside>
</section>

<?php include __DIR__ . '/footer.php'; ?>

