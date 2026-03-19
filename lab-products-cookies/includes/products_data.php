<?php
/**
 * Shared product/service data for the lab.
 * Keep all product info in ONE place to avoid duplication.
 */

$PRODUCTS = [
    [
        'id' => 'p1',
        'name' => 'Resonance Audit (Discovery)',
        'short' => 'A structured brand + audience discovery sprint.',
        'long' => 'A 90-minute discovery workshop + creative brief. We map your audience, objective, key message, and platform strategy so production is fast, focused, and measurable.',
        'image' => 'images/products/p1.svg',
        'page' => 'product1.php',
    ],
    [
        'id' => 'p2',
        'name' => '30–60s Brand Film',
        'short' => 'Cinematic brand story optimized for conversion.',
        'long' => 'A premium 30–60 second film with a clear hook → problem → promise → proof → CTA structure. Includes scripting, shot list, editing, color, and sound.',
        'image' => 'images/products/p2.svg',
        'page' => 'product2.php',
    ],
    [
        'id' => 'p3',
        'name' => 'Product Demo Video',
        'short' => 'Explain your product in under 90 seconds.',
        'long' => 'A focused demo that shows the problem, the workflow, and the outcome. Best for SaaS, apps, and tools. Includes screen capture and simple motion graphics.',
        'image' => 'images/products/p3.svg',
        'page' => 'product3.php',
    ],
    [
        'id' => 'p4',
        'name' => 'Customer Testimonial',
        'short' => 'Build trust with real customer proof.',
        'long' => 'Interview-driven testimonial content. We capture the customer’s challenge, your solution, and results. Great for landing pages and LinkedIn.',
        'image' => 'images/products/p4.svg',
        'page' => 'product4.php',
    ],
    [
        'id' => 'p5',
        'name' => 'Recruiting / Culture Video',
        'short' => 'Attract talent with authentic culture stories.',
        'long' => 'A short culture piece that highlights your values, team, and day-to-day. Designed to reduce candidate drop-off and improve applicant quality.',
        'image' => 'images/products/p5.svg',
        'page' => 'product5.php',
    ],
    [
        'id' => 'p6',
        'name' => 'Event Highlight Reel',
        'short' => 'Capture the energy and share it fast.',
        'long' => 'Same-day or next-day highlights with music, crowd moments, speaker soundbites, and brand moments. Perfect for conferences and launches.',
        'image' => 'images/products/p6.svg',
        'page' => 'product6.php',
    ],
    [
        'id' => 'p7',
        'name' => 'Photography Day (Brand + Team)',
        'short' => 'A full day of polished photos for web & socials.',
        'long' => 'Headshots, team photos, office lifestyle, product photos, and hero images. Delivered as web-ready and print-ready sets.',
        'image' => 'images/products/p7.svg',
        'page' => 'product7.php',
    ],
    [
        'id' => 'p8',
        'name' => 'Motion Graphics Pack',
        'short' => 'Animated titles, lower thirds, and end cards.',
        'long' => 'A cohesive motion kit that improves perceived quality and brand consistency. Includes exported templates for repeated use.',
        'image' => 'images/products/p8.svg',
        'page' => 'product8.php',
    ],
    [
        'id' => 'p9',
        'name' => 'Social Cutdown Suite',
        'short' => 'Turn 1 shoot into 6+ social assets.',
        'long' => 'We re-edit your hero video into multiple hooks, lengths, and aspect ratios. Ideal for IG Reels, TikTok, LinkedIn, and ads.',
        'image' => 'images/products/p9.svg',
        'page' => 'product9.php',
    ],
    [
        'id' => 'p10',
        'name' => 'Landing Page Video Embed Bundle',
        'short' => 'Video versions tuned for website speed + clarity.',
        'long' => 'Multiple encodes + thumbnails + recommended placement. Includes a short headline copy pack for the page sections where the video will live.',
        'image' => 'images/products/p10.svg',
        'page' => 'product10.php',
    ],
];

/**
 * Convenience index by id.
 */
function products_by_id(array $products): array {
    $map = [];
    foreach ($products as $p) {
        $map[$p['id']] = $p;
    }
    return $map;
}

