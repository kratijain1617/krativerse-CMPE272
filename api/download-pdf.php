<?php
/**
 * Serves print-friendly HTML for Treatment Pack (user can Print → Save as PDF).
 * Or redirects to treatment-pack.php?print=1 for print view.
 */
$sid = $_GET['sid'] ?? '';
if (empty($sid)) {
    header('Location: resonance.php');
    exit;
}
header('Location: treatment-pack.php?sid=' . urlencode($sid) . '&print=1');
exit;
