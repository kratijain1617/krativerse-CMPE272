/* Treatment Pack - Email gate & PDF download */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('emailGateForm');
    const previewLink = document.getElementById('previewLink');

    function fireAnalytics(event) {
        if (typeof window.echoAnalytics === 'function') window.echoAnalytics(event);
    }

    if (previewLink) {
        previewLink.addEventListener('click', function() {
            document.getElementById('treatmentPreview').scrollIntoView({ behavior: 'smooth' });
        });
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = form.querySelector('input[name="email"]').value;
            const consent = form.querySelector('input[name="consent"]').checked;
            const sessionId = form.querySelector('input[name="session_id"]').value;
            if (!consent) {
                alert('Please agree to receive the Treatment Pack and updates.');
                return;
            }
            fetch('api/save-lead.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    email: email,
                    consent: true,
                    session_id: sessionId,
                    action: 'download'
                })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    fireAnalytics('downloaded_pdf');
                    window.location.href = 'treatment-pack.php?sid=' + encodeURIComponent(sessionId) + '&unlocked=1';
                } else {
                    alert(data.error || 'Something went wrong.');
                }
            })
            .catch(() => alert('Network error. Please try again.'));
        });
    }
});
