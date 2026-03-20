<?php
/**
 * API endpoint: Returns this company's users.
 * - Browsers: creative HTML page (Accept: text/html)
 * - CURL / API: JSON (default for non-browser, or ?format=json)
 *
 * Other companies (B, C) use CURL — they receive JSON.
 */
require_once dirname(__DIR__) . '/config/companies_config.php';
require_once dirname(__DIR__) . '/includes/db.php';

$users = getLocalUsers();
$payload = [
    'company' => 'A',
    'company_name' => COMPANY_A_NAME,
    'users' => $users,
];

// Force JSON for API / CURL
$forceJson = isset($_GET['format']) && $_GET['format'] === 'json';

// Browser visit: show HTML (Chrome etc. send text/html in Accept)
$accept = $_SERVER['HTTP_ACCEPT'] ?? '';
$wantsHtml = !$forceJson && (isset($_GET['view']) && $_GET['view'] === '1')
    || (!$forceJson && stripos($accept, 'text/html') !== false);

if ($wantsHtml) {
    header('Content-Type: text/html; charset=UTF-8');
    $companyName = htmlspecialchars(COMPANY_A_NAME, ENT_QUOTES, 'UTF-8');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $companyName; ?> — User Directory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0d1117;
            --card: #161b22;
            --border: #30363d;
            --text: #e6edf3;
            --muted: #8b949e;
            --accent: #58a6ff;
            --warm: #f0883e;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(88, 166, 255, 0.12), transparent),
                radial-gradient(ellipse 60% 40% at 100% 50%, rgba(240, 136, 62, 0.08), transparent);
        }
        .wrap { max-width: 960px; margin: 0 auto; padding: 2rem 1.5rem 3rem; }
        .hero {
            text-align: center;
            margin-bottom: 2.5rem;
            padding: 2rem;
            background: linear-gradient(135deg, rgba(22, 27, 34, 0.9), rgba(33, 38, 45, 0.6));
            border: 1px solid var(--border);
            border-radius: 16px;
        }
        .hero::before {
            content: '';
            display: block;
            width: 56px;
            height: 56px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, var(--accent), var(--warm));
            border-radius: 14px;
            opacity: 0.35;
        }
        .badge {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            border: 1px solid rgba(88, 166, 255, 0.35);
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            margin-bottom: 0.75rem;
        }
        .hero h1 {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .hero p { color: var(--muted); margin-top: 0.5rem; font-size: 0.95rem; }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.25rem;
        }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.35rem;
            transition: border-color 0.2s, transform 0.2s;
        }
        .card:hover {
            border-color: rgba(88, 166, 255, 0.4);
            transform: translateY(-2px);
        }
        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(88, 166, 255, 0.25), rgba(240, 136, 62, 0.2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1rem;
            color: var(--accent);
            margin-bottom: 1rem;
        }
        .card h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
        }
        .card .email {
            color: var(--accent);
            font-size: 0.85rem;
            word-break: break-all;
        }
        .dept {
            display: inline-block;
            margin-top: 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--warm);
            background: rgba(240, 136, 62, 0.12);
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
        }
        footer {
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            text-align: center;
            color: var(--muted);
            font-size: 0.85rem;
        }
        footer a {
            color: var(--accent);
        }
    </style>
</head>
<body>
    <div class="wrap">
        <header class="hero">
            <span class="badge">Company A · API directory</span>
            <h1><?php echo $companyName; ?></h1>
            <p><?php echo count($users); ?> team members · This page is the human-friendly view of your user API.</p>
        </header>
        <div class="grid">
            <?php foreach ($users as $u):
                $name = htmlspecialchars($u['name'] ?? '', ENT_QUOTES, 'UTF-8');
                $email = htmlspecialchars($u['email'] ?? '', ENT_QUOTES, 'UTF-8');
                $dept = htmlspecialchars($u['department'] ?? '', ENT_QUOTES, 'UTF-8');
                $initials = '';
                $parts = preg_split('/\s+/', $u['name'] ?? '');
                foreach (array_slice($parts, 0, 2) as $p) {
                    $initials .= strtoupper(substr($p, 0, 1));
                }
                $initials = $initials ?: '?';
            ?>
            <article class="card">
                <div class="avatar"><?php echo htmlspecialchars($initials, ENT_QUOTES, 'UTF-8'); ?></div>
                <h2><?php echo $name; ?></h2>
                <div class="email"><?php echo $email; ?></div>
                <?php if ($dept !== ''): ?><span class="dept"><?php echo $dept; ?></span><?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
        <footer>
            <p>For CURL / machine clients: <a href="?format=json">?format=json</a> returns raw JSON.</p>
            <p style="margin-top:0.5rem;"><a href="../list_all_users.php">← All companies (CURL lab)</a></p>
        </footer>
    </div>
</body>
</html>
    <?php
    exit;
}

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');

echo json_encode($payload);
