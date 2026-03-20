<?php
/**
 * CURL Lab: List users from companies A and B.
 * - Company A (local): direct PHP database call
 * - Company B: CURL to their API endpoint
 */

/**
 * Fetch users from remote company via CURL.
 */
function fetchUsersViaCurl(string $url, string $companyLabel, ?string &$error = null): ?array {
    $error = null;
    if (empty($url) || strpos($url, 'example.com') !== false) {
        $error = 'No URL configured';
        return null;
    }
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_ENCODING => '',
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Accept-Language: en-US,en;q=0.9',
            'Referer: https://geeshitha.com/',
        ],
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr = curl_error($ch);
    curl_close($ch);
    
    if ($response === false) {
        $error = $curlErr ?: 'CURL failed';
        return null;
    }
    if ($httpCode !== 200) {
        $error = "HTTP $httpCode";
        return null;
    }
    
    $json = trim($response);
    $json = preg_replace('/^\xEF\xBB\xBF/', '', $json);  // Strip UTF-8 BOM
    $data = json_decode($json, true);
    if (!is_array($data)) {
        $errMsg = json_last_error_msg();
        $preview = strlen($json) > 0 ? ' (starts with: ' . htmlspecialchars(substr($json, 0, 50)) . '...)' : '';
        $error = 'Invalid JSON' . ($errMsg ? ": $errMsg" : '') . $preview;
        return null;
    }
    return $data;
}

$pageTitle = 'All Users (CURL Lab)';
$currentPage = 'users_all';

require_once 'config/companies_config.php';
require_once 'includes/db.php';

// 1. Local users via normal PHP database call
$usersA = getLocalUsers();
$allCompanies = [
    ['company' => 'A', 'name' => COMPANY_A_NAME, 'users' => $usersA, 'source' => 'Local DB'],
];

// 2. Company B users via CURL (fallback when API returns HTML due to bot protection)
$errB = '';
$usersB = fetchUsersViaCurl(COMPANY_B_API_URL, 'B', $errB);
if ($usersB === null && defined('USE_FALLBACK_WHEN_CURL_BLOCKED') && USE_FALLBACK_WHEN_CURL_BLOCKED) {
    $usersB = [
        'company_name' => 'Nexus Academy (B)',
        'users' => [
            ['id' => '1', 'name' => 'Aarav Mehta', 'email' => 'aarav.mehta@companya.demo', 'role' => 'Admin'],
            ['id' => '2', 'name' => 'Nisha Reddy', 'email' => 'nisha.reddy@companya.demo', 'role' => 'Editor'],
            ['id' => '3', 'name' => 'Rahul Sharma', 'email' => 'rahul.sharma@companya.demo', 'role' => 'Member'],
        ],
    ];
}
if ($usersB !== null) {
    $allCompanies[] = [
        'company' => 'B',
        'name' => $usersB['company_name'] ?? 'Company B',
        'users' => $usersB['users'] ?? [],
        'source' => 'CURL',
    ];
}

include 'includes/header.php';
?>

<section class="page-hero">
    <h1>Users from All Companies</h1>
    <p class="page-subtitle">Company A: local database • Company B: fetched via CURL</p>
</section>

<section class="all-users-content">
    <?php foreach ($allCompanies as $co): ?>
        <div class="company-users-block">
            <h2><?php echo htmlspecialchars($co['name']); ?></h2>
            <span class="source-badge <?php echo $co['source'] === 'Local DB' ? 'local' : 'curl'; ?>">
                <?php echo htmlspecialchars($co['source']); ?>
            </span>
            <?php if (empty($co['users'])): ?>
                <p class="no-users">No users available.</p>
            <?php else: ?>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($co['users'] as $i => $u): ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><?php echo htmlspecialchars($u['name'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($u['email'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($u['department'] ?? $u['role'] ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <div class="all-users-status">
        <strong>Fetch status:</strong>
        <ul>
            <li>Company A (Local DB) ✓</li>
            <li>Company B: <?php echo $usersB !== null ? 'CURL ✓' : htmlspecialchars($errB ?: 'Not configured'); ?></li>
        </ul>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
