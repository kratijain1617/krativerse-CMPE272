/* Resonance Finder - Multi-step flow */
document.addEventListener('DOMContentLoaded', function() {
    const startBtn = document.getElementById('startFlow');
    const flowSection = document.getElementById('resonanceFlow');
    const form = document.getElementById('resonanceForm');
    const steps = form.querySelectorAll('.flow-step');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');

    let currentStep = 0;
    const totalSteps = steps.length;

    function fireAnalytics(event) {
        if (typeof window.echoAnalytics === 'function') {
            window.echoAnalytics(event);
        }
        const el = document.querySelector('[data-analytics="' + event + '"]');
        if (el) el.dispatchEvent(new CustomEvent('analytics', { detail: event }));
    }

    if (startBtn) {
        startBtn.addEventListener('click', function() {
            flowSection.hidden = false;
            startBtn.closest('.resonance-intro').style.display = 'none';
            fireAnalytics('started_flow');
        });
    }

    function updateProgress() {
        const pct = ((currentStep + 1) / totalSteps) * 100;
        progressBar.style.width = pct + '%';
        progressText.textContent = 'Question ' + (currentStep + 1) + ' of ' + totalSteps;
    }

    function showStep(i) {
        steps.forEach((s, idx) => s.classList.toggle('active', idx === i));
        currentStep = i;
        prevBtn.disabled = i === 0;
        nextBtn.hidden = i === totalSteps - 1;
        submitBtn.hidden = i !== totalSteps - 1;
        updateProgress();
    }

    function validateStep() {
        const step = steps[currentStep];
        const radios = step.querySelectorAll('input[type="radio"]:checked');
        const checkboxes = step.querySelectorAll('input[type="checkbox"]:checked');
        const textarea = step.querySelector('textarea');
        if (radios.length) return true;
        if (checkboxes.length) return true;
        if (textarea && step.dataset.step === '11') return true; // optional
        if (textarea && step.dataset.step === '12') return true; // optional
        return false;
    }

    if (prevBtn) prevBtn.addEventListener('click', () => { if (currentStep > 0) showStep(currentStep - 1); });
    if (nextBtn) nextBtn.addEventListener('click', () => {
        if (!validateStep() && (currentStep === 5 || currentStep < 10)) {
            alert('Please select an option to continue.');
            return;
        }
        if (currentStep < totalSteps - 1) showStep(currentStep + 1);
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        const responses = {};
        for (const [k, v] of formData) {
            if (k === 'session_id') continue;
            if (k === 'platform[]') {
                responses.platform = responses.platform || [];
                responses.platform.push(v);
            } else {
                responses[k] = v;
            }
        }
        const sessionId = formData.get('session_id');
        fetch('api/submit-resonance.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ session_id: sessionId, responses: responses })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                fireAnalytics('completed_flow');
                window.location.href = data.redirect;
            } else {
                alert('Something went wrong. Please try again.');
            }
        })
        .catch(() => alert('Network error. Please try again.'));
    });

    showStep(0);
});
