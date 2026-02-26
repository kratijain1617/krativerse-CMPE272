/* Echo Creative Studio - Analytics events */
(function() {
    window.echoAnalytics = function(event) {
        if (typeof gtag !== 'undefined') {
            gtag('event', event, { event_category: 'resonance_finder' });
        }
        if (typeof dataLayer !== 'undefined') {
            dataLayer.push({ event: event, eventCategory: 'resonance_finder' });
        }
        console.log('[Analytics]', event);
    };

    document.addEventListener('click', function(e) {
        const el = e.target.closest('[data-analytics]');
        if (el && el.dataset.analytics) {
            window.echoAnalytics(el.dataset.analytics);
        }
    });
})();
