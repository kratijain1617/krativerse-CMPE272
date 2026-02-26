<?php
$pageTitle = 'Your Treatment Pack';
$currentPage = 'treatment';
require_once 'includes/treatment-generator.php';

$sessionId = $_GET['sid'] ?? '';
$responses = $sessionId ? loadResonanceSession($sessionId) : null;
$treatment = $responses ? generateTreatmentPack($responses) : null;
$emailUnlocked = isset($_GET['unlocked']) && $_GET['unlocked'] === '1';

// If no session or invalid, redirect to resonance
if (!$treatment) {
    header('Location: resonance.php');
    exit;
}

include 'includes/header.php';
?>

<section class="treatment-hero">
    <h1>Your Creative Treatment Pack</h1>
    <p class="treatment-subtitle">Personalized blueprint for your video project</p>
</section>

<?php if (!$emailUnlocked): ?>
<section class="treatment-gate" id="treatmentGate">
    <div class="gate-content">
        <p>Enter your email to unlock the full Treatment Pack and download it as PDF.</p>
        <form id="emailGateForm" class="gate-form">
            <input type="hidden" name="session_id" value="<?php echo htmlspecialchars($sessionId); ?>">
            <input type="email" name="email" placeholder="your@email.com" required>
            <label class="consent-label">
                <input type="checkbox" name="consent" required>
                I agree to receive my Treatment Pack and occasional updates from Echo Creative Studio.
            </label>
            <button type="submit" class="btn btn-primary" data-analytics="downloaded_pdf">Unlock & Download PDF</button>
        </form>
        <p class="gate-preview"><a href="#treatmentPreview" id="previewLink">Preview treatment first</a></p>
    </div>
</section>
<?php endif; ?>

<section class="treatment-content" id="treatmentPreview">
    <div class="treatment-pack">

        <div class="treatment-section">
            <h2>1. Script Outline (30–60 sec)</h2>
            <div class="script-outline">
                <p><strong>Hook:</strong> <?php echo htmlspecialchars($treatment['script_outline']['hook']); ?></p>
                <p><strong>Problem:</strong> <?php echo htmlspecialchars($treatment['script_outline']['problem']); ?></p>
                <p><strong>Promise:</strong> <?php echo htmlspecialchars($treatment['script_outline']['promise']); ?></p>
                <p><strong>Proof:</strong> <?php echo htmlspecialchars($treatment['script_outline']['proof']); ?></p>
                <p><strong>CTA:</strong> <?php echo htmlspecialchars($treatment['script_outline']['cta']); ?></p>
            </div>
        </div>

        <div class="treatment-section">
            <h2>2. Shot List & B-Roll</h2>
            <ul class="shot-list">
                <?php foreach ($treatment['shot_list'] as $shot): ?>
                    <li><?php echo htmlspecialchars($shot); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="treatment-section">
            <h2>3. Visual Direction</h2>
            <div class="visual-direction">
                <p><strong>Mood:</strong> <?php echo htmlspecialchars(implode(', ', $treatment['visual_direction']['mood_keywords'])); ?></p>
                <p><strong>Lighting:</strong> <?php echo htmlspecialchars($treatment['visual_direction']['lighting']); ?></p>
                <p><strong>Pacing:</strong> <?php echo htmlspecialchars($treatment['visual_direction']['pacing']); ?></p>
                <p><strong>Music:</strong> <?php echo htmlspecialchars($treatment['visual_direction']['music_vibe']); ?></p>
            </div>
        </div>

        <div class="treatment-section">
            <h2>4. Recommended Deliverables</h2>
            <p>Formats for your chosen platforms:</p>
            <ul class="deliverables-list">
                <?php foreach ($treatment['deliverables'] as $d): ?>
                    <li><?php echo htmlspecialchars($d); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="treatment-section">
            <h2>5. Production Plan</h2>
            <ul class="production-plan">
                <li><strong>Pre-production:</strong> <?php echo htmlspecialchars($treatment['production_plan']['pre_production']); ?></li>
                <li><strong>Shoot:</strong> <?php echo htmlspecialchars($treatment['production_plan']['shoot']); ?></li>
                <li><strong>Post-production:</strong> <?php echo htmlspecialchars($treatment['production_plan']['post_production']); ?></li>
            </ul>
            <?php if (!empty(trim($treatment['production_plan']['risk_notes']))): ?>
                <p class="risk-notes"><strong>Risk notes:</strong> <?php echo htmlspecialchars($treatment['production_plan']['risk_notes']); ?></p>
            <?php endif; ?>
        </div>

        <div class="treatment-section project-fit">
            <h2>6. Project Fit Score</h2>
            <div class="fit-score">
                <span class="score-value"><?php echo (int)$treatment['project_fit']['score']; ?>%</span>
                <p>Ready to finalize a quote</p>
            </div>
            <?php if (!empty($treatment['project_fit']['missing'])): ?>
                <p class="missing-info"><strong>To complete your quote:</strong> <?php echo htmlspecialchars(implode(', ', $treatment['project_fit']['missing'])); ?></p>
            <?php endif; ?>
        </div>

        <div class="treatment-ctas">
            <?php if ($emailUnlocked): ?>
            <button type="button" class="btn btn-secondary" onclick="window.print()">Save as PDF</button>
            <?php endif; ?>
            <a href="contacts.php?ref=treatment" class="btn btn-primary" data-analytics="requested_quote">Request a Quote</a>
            <a href="contacts.php?ref=call" class="btn btn-secondary" data-analytics="requested_quote">Book a Call</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
