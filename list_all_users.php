<?php
/**
 * CURL Lab: List users from ALL companies (A, B, C).
 * - Company A (local): direct PHP database call
 * - Company B, C: CURL to their API endpoints
 */

/**
 * Fetch users from remote company via CURL.
 */
function fetchUsersViaCurl(string $url, string $companyLabel): ?array {
    if (empty($url) || strpos($url, 'example.com') !== false) {
        return null; // Placeholder URL - skip
    }
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($response === false || $httpCode !== 200) {
        return null;
    }
    
    $data = json_decode($response, true);
    return is_array($data) ? $data : null;
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

// 2. Company B users via CURL
$usersB = fetchUsersViaCurl(COMPANY_B_API_URL, 'B');
if ($usersB !== null) {
    $allCompanies[] = [
        'company' => 'B',
        'name' => $usersB['company_name'] ?? 'Company B',
        'users' => $usersB['users'] ?? [],
        'source' => 'CURL',
    ];
}

// 3. Company C users via CURL
$usersC = fetchUsersViaCurl(COMPANY_C_API_URL, 'C');
if ($usersC !== null) {
    $allCompanies[] = [
        'company' => 'C',
        'name' => $usersC['company_name'] ?? 'Company C',
        'users' => $usersC['users'] ?? [],
        'source' => 'CURL',
    ];
}

include 'includes/header.php';
?>

<section class="page-hero">
    <h1>Users from All Companies</h1>
    <p class="page-subtitle">Company A: local database • Company B & C: fetched via CURL</p>
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
                                <td><?php echo htmlspecialchars($u['department'] ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <?php if (count($allCompanies) === 1): ?>
        <div class="all-users-hint">
            Update <code>config/companies_config.php</code> with Company B and C API URLs to fetch their users via CURL.
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>
