<?php
$pageTitle = 'Contact';
$currentPage = 'contacts';
include 'includes/header.php';

/**
 * Reads company contact information from a text file and returns formatted content.
 * File path is relative to the directory containing this script.
 */
function readCompanyContacts($filePath = 'data/company_contacts.txt') {
    $content = [];
    if (file_exists($filePath)) {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines !== false) {
            $content = $lines;
        }
    }
    return $content;
}

/**
 * Reads team/department contacts from a text file and returns parsed array.
 * Format: Department|Name|Email|Phone|Title
 */
function readTeamContacts($filePath = 'data/team_contacts.txt') {
    $contacts = [];
    if (file_exists($filePath)) {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines !== false) {
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue; // Skip comment lines
                $parts = array_map('trim', explode('|', $line));
                if (count($parts) >= 5) {
                    $contacts[] = [
                        'department' => $parts[0],
                        'name' => $parts[1],
                        'email' => $parts[2],
                        'phone' => $parts[3],
                        'title' => $parts[4]
                    ];
                }
            }
        }
    }
    return $contacts;
}

$companyInfo = readCompanyContacts();
$teamContacts = readTeamContacts();
?>

<section class="page-hero">
    <h1>Contact Us</h1>
    <p class="page-subtitle">We'd love to hear from you</p>
</section>

<section class="contacts-content">
    <div class="contacts-grid">
        <div class="contact-block company-info">
            <h2>Company Contact</h2>
            <div class="contact-details">
                <?php if (!empty($companyInfo)): ?>
                    <?php foreach ($companyInfo as $line): ?>
                        <p><?php echo htmlspecialchars($line); ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="error">Contact information could not be loaded. Please try again later.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="contact-block team-contacts">
            <h2>Team Contacts</h2>
            <p class="contact-intro">Reach out to the right person for your needs:</p>
            <?php if (!empty($teamContacts)): ?>
                <div class="team-list">
                    <?php foreach ($teamContacts as $contact): ?>
                        <div class="team-card">
                            <div class="team-header">
                                <span class="team-name"><?php echo htmlspecialchars($contact['name']); ?></span>
                                <span class="team-dept"><?php echo htmlspecialchars($contact['department']); ?></span>
                            </div>
                            <p class="team-title"><?php echo htmlspecialchars($contact['title']); ?></p>
                            <p class="team-email"><a href="mailto:<?php echo htmlspecialchars($contact['email']); ?>"><?php echo htmlspecialchars($contact['email']); ?></a></p>
                            <p class="team-phone"><?php echo htmlspecialchars($contact['phone']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="error">Team contact list could not be loaded. Please try again later.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
