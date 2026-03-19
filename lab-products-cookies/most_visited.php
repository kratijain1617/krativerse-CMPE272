<?php
// Most visited report page (extra credit)
require_once 'includes/products_data.php';
require_once 'includes/cookie_helpers.php';

$pageTitle = 'Most Visited (Top 5)';
$top = top_visited_products($PRODUCTS, 5);

include 'includes/header.php';
?>

<section class="hero">
  <h1>Most Visited Products</h1>
  <p>Top 5 products ranked by cookie-based visit counts.</p>
  <div class="btn-row">
    <a class="btn secondary" href="products.php">Browse Products</a>
    <a class="btn secondary" href="recently_viewed.php">Recently Viewed</a>
  </div>
</section>

<?php if (empty($top)): ?>
  <div class="card" style="margin-top: 18px;">
    <h3>No visits tracked yet</h3>
    <p class="muted">Open product pages to create visit counts, then come back here.</p>
    <a class="btn primary" href="products.php">Go to Products</a>
  </div>
<?php else: ?>
  <div class="card" style="margin-top: 18px;">
    <table class="table">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Product</th>
          <th>Visits</th>
          <th>Link</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($top as $i => $row): ?>
          <?php $p = $row['product']; $count = $row['count']; ?>
          <tr>
            <td><?php echo $i + 1; ?></td>
            <td>
              <strong><?php echo htmlspecialchars($p['name']); ?></strong><br>
              <span class="muted"><?php echo htmlspecialchars($p['short']); ?></span>
            </td>
            <td><?php echo (int)$count; ?></td>
            <td><a class="btn secondary" href="<?php echo htmlspecialchars($p['page']); ?>">Open</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>

