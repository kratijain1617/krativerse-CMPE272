<?php
/**
 * Generates Creative Treatment Pack content from Resonance Finder responses.
 * PHP-based content generation.
 */

function loadResonanceSession($sessionId) {
    $file = dirname(__DIR__) . '/data/resonance_submissions.json';
    if (!file_exists($file)) return null;
    $submissions = json_decode(file_get_contents($file), true) ?: [];
    foreach (array_reverse($submissions) as $s) {
        if (($s['session_id'] ?? '') === $sessionId) {
            return $s['responses'] ?? [];
        }
    }
    return null;
}

function generateTreatmentPack($responses) {
    $r = $responses;
    $industry = $r['industry'] ?? 'general';
    $audience = $r['audience'] ?? 'consumers';
    $objective = $r['objective'] ?? 'awareness';
    $tone = $r['tone'] ?? 'professional';
    $platforms = is_array($r['platform'] ?? null) ? $r['platform'] : (isset($r['platform']) ? [$r['platform']] : ['instagram', 'youtube']);
    $deliverable = $r['deliverable'] ?? 'commercial';
    $timeline = $r['timeline'] ?? '4weeks';
    $budget = $r['budget'] ?? '25k';
    $location = $r['location'] ?? 'office';
    $talent = $r['talent'] ?? 'yes_exec';
    $brandRefs = trim($r['brand_refs'] ?? '');
    $keyMessage = trim($r['key_message'] ?? '');

    $industries = [
        'tech' => 'Technology / SaaS', 'healthcare' => 'Healthcare', 'finance' => 'Finance',
        'retail' => 'Retail', 'education' => 'Education', 'manufacturing' => 'Manufacturing',
        'realestate' => 'Real Estate', 'hospitality' => 'Hospitality', 'nonprofit' => 'Nonprofit', 'other' => 'Other'
    ];
    $tones = [
        'professional' => ['trust', 'credibility', 'expertise'],
        'inspiring' => ['aspiration', 'motivation', 'possibility'],
        'playful' => ['fun', 'approachability', 'energy'],
        'urgent' => ['action', 'urgency', 'momentum'],
        'empathetic' => ['connection', 'understanding', 'human'],
        'bold' => ['disruption', 'confidence', 'innovation']
    ];
    $toneMoods = $tones[$tone] ?? ['professional', 'clear', 'engaging'];
    $lighting = $tone === 'inspiring' ? 'Soft, warm key light with subtle rim' : ($tone === 'bold' ? 'High contrast, dramatic shadows' : 'Clean, even 3-point lighting');
    $pacing = $tone === 'urgent' ? 'Fast cuts, dynamic motion' : ($tone === 'empathetic' ? 'Slower, contemplative pacing' : 'Medium tempo, clear beats');

    // 1) Script outline
    $hook = $keyMessage ?: "Open with the core insight that stops the scroll.";
    $problem = "Your audience faces a specific challenge in the {$industries[$industry] ?? $industry} space.";
    $promise = "Show how your solution addresses it uniquely.";
    $proof = "One concrete proof point — stat, testimonial, or demo.";
    $cta = "Clear next step: visit site, book demo, or follow.";
    $scriptOutline = compact('hook', 'problem', 'promise', 'proof', 'cta');

    // 2) Shot list (10–20 shots)
    $baseShots = [
        'Wide establishing shot of environment',
        'Medium shot of key subject/product',
        'Close-up of product/logo/hands',
        'B-roll: people in natural context',
        'B-roll: screens/UI (if applicable)',
        'Talking head or spokesperson (if talent)',
        'Cutaway: reaction or detail',
        'End frame: logo + CTA'
    ];
    $industryShots = [
        'tech' => ['Product demo', 'Team collaboration', 'Office/workspace', 'Dashboard/interface'],
        'healthcare' => ['Patient/provider interaction', 'Facility/equipment', 'Compassionate moment'],
        'retail' => ['Product in use', 'Shopping experience', 'Unboxing moment'],
        'education' => ['Learning moment', 'Classroom/lab', 'Student success'],
        'finance' => ['Confident professional', 'Data/analytics', 'Secure transaction']
    ];
    $extraShots = $industryShots[$industry] ?? ['Industry-specific context', 'Key differentiator visual'];
    $shotList = array_merge($baseShots, $extraShots);

    // 3) Visual direction
    $visualDirection = [
        'mood_keywords' => $toneMoods,
        'lighting' => $lighting,
        'pacing' => $pacing,
        'music_vibe' => $tone === 'playful' ? 'Upbeat, modern' : ($tone === 'empathetic' ? 'Emotional, piano/strings' : 'Confident, cinematic')
    ];

    // 4) Deliverables
    $deliverables = [];
    if (in_array('instagram', $platforms)) $deliverables[] = '9:16 Reel';
    if (in_array('youtube', $platforms)) $deliverables[] = '16:9 YouTube';
    if (in_array('linkedin', $platforms)) $deliverables[] = '1:1 LinkedIn';
    if (in_array('tiktok', $platforms)) $deliverables[] = '9:16 TikTok';
    if (in_array('tv', $platforms)) $deliverables[] = '16:9 Broadcast';
    if (in_array('website', $platforms)) $deliverables[] = '16:9 Web hero';
    if (empty($deliverables)) $deliverables = ['16:9 Master', '9:16 Social', '1:1 Square'];

    // 5) Production timeline + risk notes
    $timelineWeeks = ['2weeks' => 2, '4weeks' => 4, '6weeks' => 6, '8weeks' => 8, 'flexible' => 4];
    $weeks = $timelineWeeks[$timeline] ?? 4;
    $prePro = ceil($weeks * 0.25);
    $shoot = 1;
    $post = $weeks - $prePro - $shoot;
    $productionPlan = [
        'pre_production' => "{$prePro} week(s) — creative brief, shot list, location scout, talent booking",
        'shoot' => "{$shoot} day(s) — principal photography",
        'post_production' => "{$post} week(s) — edit, color, sound, revisions",
        'risk_notes' => ($location === 'remote' ? 'Remote capture may require extra coordination.' : '') .
            ($talent === 'yes_exec' ? ' Executive availability is critical.' : '') .
            ($timeline === '2weeks' ? ' Aggressive timeline — prioritize must-haves.' : '')
    ];

    // 6) Project fit score
    $score = 70;
    $missing = [];
    if (empty($keyMessage)) { $score -= 10; $missing[] = 'Key message'; }
    if (empty($brandRefs)) { $score -= 5; $missing[] = 'Brand references'; }
    if ($budget === '5k' && in_array('tv', $platforms)) { $score -= 15; $missing[] = 'Budget vs. platform mismatch'; }
    $score = max(40, min(95, $score));
    $projectFit = ['score' => $score, 'missing' => array_unique($missing)];

    return [
        'script_outline' => $scriptOutline,
        'shot_list' => $shotList,
        'visual_direction' => $visualDirection,
        'deliverables' => $deliverables,
        'production_plan' => $productionPlan,
        'project_fit' => $projectFit,
        'responses' => $r
    ];
}
