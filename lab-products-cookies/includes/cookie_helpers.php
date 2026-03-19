<?php
/**
 * Cookie helper functions for the lab.
 *
 * Requirements:
 * - Use PHP cookies only (no sessions, no database, no localStorage).
 * - Use setcookie() and $_COOKIE.
 * - Cookies MUST be set before any HTML output.
 * - Keep last 5 unique recently viewed products.
 * - Track most visited products (counts) using cookies.
 */

/**
 * 30-day expiration.
 */
function cookie_expiration_30_days(): int {
    return time() + 60 * 60 * 24 * 30;
}

/**
 * Read a JSON cookie into a PHP array.
 */
function get_json_cookie(string $name, array $default = []): array {
    if (!isset($_COOKIE[$name]) || $_COOKIE[$name] === '') return $default;
    $decoded = json_decode($_COOKIE[$name], true);
    return is_array($decoded) ? $decoded : $default;
}

/**
 * Write a PHP array to a JSON cookie.
 * NOTE: setcookie() must happen before HTML output.
 */
function set_json_cookie(string $name, array $value, int $expiresAt): void {
    $json = json_encode($value);
    // Basic cookie flags (works for localhost/class labs)
    setcookie($name, $json, [
        'expires' => $expiresAt,
        'path' => '/',
        'samesite' => 'Lax',
    ]);
    // Keep current request consistent
    $_COOKIE[$name] = $json;
}

/**
 * Track recently viewed products.
 * - Most recent first
 * - Unique
 * - Max 5 items
 */
function track_recently_viewed(string $productId): void {
    $cookieName = 'recently_viewed_products';
    $list = get_json_cookie($cookieName, []);

    // Remove if already in list
    $list = array_values(array_filter($list, fn($id) => $id !== $productId));
    // Add to front
    array_unshift($list, $productId);
    // Keep only 5
    $list = array_slice($list, 0, 5);

    set_json_cookie($cookieName, $list, cookie_expiration_30_days());
}

function get_recently_viewed(): array {
    return get_json_cookie('recently_viewed_products', []);
}

/**
 * Track visit counts for each product.
 * Stores a map: { "p1": 3, "p2": 1, ... }
 */
function increment_visit_count(string $productId): void {
    $cookieName = 'product_visit_counts';
    $counts = get_json_cookie($cookieName, []);

    if (!isset($counts[$productId])) $counts[$productId] = 0;
    $counts[$productId] = (int)$counts[$productId] + 1;

    set_json_cookie($cookieName, $counts, cookie_expiration_30_days());
}

function get_visit_counts(): array {
    return get_json_cookie('product_visit_counts', []);
}

/**
 * Return top N products by visits.
 * Tie-breaker: product name, then product id (stable).
 *
 * @return array list of [product, count]
 */
function top_visited_products(array $products, int $limit = 5): array {
    $counts = get_visit_counts();
    $byId = [];
    foreach ($products as $p) $byId[$p['id']] = $p;

    $rows = [];
    foreach ($counts as $id => $count) {
        if (isset($byId[$id])) {
            $rows[] = ['product' => $byId[$id], 'count' => (int)$count];
        }
    }

    usort($rows, function($a, $b) {
        if ($a['count'] !== $b['count']) return $b['count'] <=> $a['count'];
        $nameCmp = strcmp($a['product']['name'], $b['product']['name']);
        if ($nameCmp !== 0) return $nameCmp;
        return strcmp($a['product']['id'], $b['product']['id']);
    });

    return array_slice($rows, 0, $limit);
}

