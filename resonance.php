<?php
$pageTitle = 'Resonance Finder';
$currentPage = 'resonance';
include 'includes/header.php';
?>

<section class="resonance-hero">
    <div class="resonance-intro">
        <h1>Story Resonance Engine</h1>
        <p class="resonance-tagline">Answer 12 quick questions (3–5 min) and get a free <strong>Creative Treatment Pack</strong> — a personalized blueprint for your next video project.</p>
        <button type="button" class="btn btn-primary btn-large" id="startFlow" data-analytics="started_flow">
            Start Free Assessment
        </button>
    </div>
</section>

<section class="resonance-flow" id="resonanceFlow" hidden>
    <div class="flow-progress">
        <div class="progress-bar" id="progressBar"></div>
        <span class="progress-text" id="progressText">Question 1 of 12</span>
    </div>

    <form id="resonanceForm" class="resonance-form">
        <input type="hidden" name="session_id" id="sessionId" value="<?php echo uniqid('rf_', true); ?>">

        <div class="flow-step active" data-step="1">
            <h2>What industry is your brand in?</h2>
            <div class="options-grid" data-name="industry">
                <label><input type="radio" name="industry" value="tech"> Technology / SaaS</label>
                <label><input type="radio" name="industry" value="healthcare"> Healthcare</label>
                <label><input type="radio" name="industry" value="finance"> Finance / Fintech</label>
                <label><input type="radio" name="industry" value="retail"> Retail / E-commerce</label>
                <label><input type="radio" name="industry" value="education"> Education</label>
                <label><input type="radio" name="industry" value="manufacturing"> Manufacturing</label>
                <label><input type="radio" name="industry" value="realestate"> Real Estate</label>
                <label><input type="radio" name="industry" value="hospitality"> Hospitality</label>
                <label><input type="radio" name="industry" value="nonprofit"> Nonprofit</label>
                <label><input type="radio" name="industry" value="other"> Other</label>
            </div>
        </div>

        <div class="flow-step" data-step="2">
            <h2>Who is your primary target audience?</h2>
            <div class="options-grid" data-name="audience">
                <label><input type="radio" name="audience" value="consumers"> Consumers (B2C)</label>
                <label><input type="radio" name="audience" value="enterprise"> Enterprise / Decision Makers</label>
                <label><input type="radio" name="audience" value="investors"> Investors / Stakeholders</label>
                <label><input type="radio" name="audience" value="talent"> Job Candidates / Recruiting</label>
                <label><input type="radio" name="audience" value="partners"> Partners / Resellers</label>
                <label><input type="radio" name="audience" value="internal"> Internal / Employees</label>
            </div>
        </div>

        <div class="flow-step" data-step="3">
            <h2>What's your primary objective?</h2>
            <div class="options-grid" data-name="objective">
                <label><input type="radio" name="objective" value="awareness"> Brand Awareness</label>
                <label><input type="radio" name="objective" value="leads"> Lead Generation</label>
                <label><input type="radio" name="objective" value="recruiting"> Recruiting / Employer Brand</label>
                <label><input type="radio" name="objective" value="product"> Product Launch</label>
                <label><input type="radio" name="objective" value="education"> Education / Training</label>
                <label><input type="radio" name="objective" value="event"> Event Promotion</label>
            </div>
        </div>

        <div class="flow-step" data-step="4">
            <h2>What tone/emotion should the content evoke?</h2>
            <div class="options-grid" data-name="tone">
                <label><input type="radio" name="tone" value="professional"> Professional / Trustworthy</label>
                <label><input type="radio" name="tone" value="inspiring"> Inspiring / Aspirational</label>
                <label><input type="radio" name="tone" value="playful"> Playful / Fun</label>
                <label><input type="radio" name="tone" value="urgent"> Urgent / Action-oriented</label>
                <label><input type="radio" name="tone" value="empathetic"> Empathetic / Human</label>
                <label><input type="radio" name="tone" value="bold"> Bold / Disruptive</label>
            </div>
        </div>

        <div class="flow-step" data-step="5">
            <h2>Which platforms will this content live on?</h2>
            <div class="options-grid multi" data-name="platform">
                <label><input type="checkbox" name="platform[]" value="instagram"> Instagram</label>
                <label><input type="checkbox" name="platform[]" value="youtube"> YouTube</label>
                <label><input type="checkbox" name="platform[]" value="linkedin"> LinkedIn</label>
                <label><input type="checkbox" name="platform[]" value="tiktok"> TikTok</label>
                <label><input type="checkbox" name="platform[]" value="tv"> TV / Broadcast</label>
                <label><input type="checkbox" name="platform[]" value="website"> Website / Landing Page</label>
                <label><input type="checkbox" name="platform[]" value="events"> Events / Trade Shows</label>
            </div>
        </div>

        <div class="flow-step" data-step="6">
            <h2>What type of deliverable do you need?</h2>
            <div class="options-grid" data-name="deliverable">
                <label><input type="radio" name="deliverable" value="commercial"> 30–60 sec Commercial</label>
                <label><input type="radio" name="deliverable" value="social"> Social Media Ads (15–30 sec)</label>
                <label><input type="radio" name="deliverable" value="explainer"> Explainer / How-to</label>
                <label><input type="radio" name="deliverable" value="testimonial"> Testimonial / Case Study</label>
                <label><input type="radio" name="deliverable" value="recruiting"> Recruiting / Culture</label>
                <label><input type="radio" name="deliverable" value="event"> Event Highlight Reel</label>
            </div>
        </div>

        <div class="flow-step" data-step="7">
            <h2>What's your ideal timeline?</h2>
            <div class="options-grid" data-name="timeline">
                <label><input type="radio" name="timeline" value="2weeks"> 2 weeks</label>
                <label><input type="radio" name="timeline" value="4weeks"> 4 weeks</label>
                <label><input type="radio" name="timeline" value="6weeks"> 6 weeks</label>
                <label><input type="radio" name="timeline" value="8weeks"> 8+ weeks</label>
                <label><input type="radio" name="timeline" value="flexible"> Flexible</label>
            </div>
        </div>

        <div class="flow-step" data-step="8">
            <h2>What's your budget range?</h2>
            <div class="options-grid" data-name="budget">
                <label><input type="radio" name="budget" value="5k"> Under $5K</label>
                <label><input type="radio" name="budget" value="10k"> $5K – $10K</label>
                <label><input type="radio" name="budget" value="25k"> $10K – $25K</label>
                <label><input type="radio" name="budget" value="50k"> $25K – $50K</label>
                <label><input type="radio" name="budget" value="100k"> $50K – $100K</label>
                <label><input type="radio" name="budget" value="100k+"> $100K+</label>
            </div>
        </div>

        <div class="flow-step" data-step="9">
            <h2>Where will filming/photo take place?</h2>
            <div class="options-grid" data-name="location">
                <label><input type="radio" name="location" value="studio"> Our Studio</label>
                <label><input type="radio" name="location" value="office"> Your Office</label>
                <label><input type="radio" name="location" value="outdoor"> Outdoor / On-location</label>
                <label><input type="radio" name="location" value="remote"> Fully Remote</label>
                <label><input type="radio" name="location" value="mixed"> Mixed / TBD</label>
            </div>
        </div>

        <div class="flow-step" data-step="10">
            <h2>Will you have talent (spokespeople, executives) on camera?</h2>
            <div class="options-grid" data-name="talent">
                <label><input type="radio" name="talent" value="yes_exec"> Yes, executives</label>
                <label><input type="radio" name="talent" value="yes_customers"> Yes, customers/employees</label>
                <label><input type="radio" name="talent" value="yes_actors"> Yes, hired actors</label>
                <label><input type="radio" name="talent" value="voiceover"> Voiceover only</label>
                <label><input type="radio" name="talent" value="none"> No on-camera talent</label>
            </div>
        </div>

        <div class="flow-step" data-step="11">
            <h2>Any brand references or competitor content you admire?</h2>
            <textarea name="brand_refs" rows="4" placeholder="e.g., Apple product launches, Nike ads, etc."></textarea>
        </div>

        <div class="flow-step" data-step="12">
            <h2>Key message or hook you want to convey?</h2>
            <textarea name="key_message" rows="4" placeholder="One sentence that captures the core message..."></textarea>
        </div>

        <div class="flow-nav">
            <button type="button" class="btn btn-secondary" id="prevBtn" disabled>Back</button>
            <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
            <button type="submit" class="btn btn-primary" id="submitBtn" hidden>Get My Treatment Pack</button>
        </div>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
