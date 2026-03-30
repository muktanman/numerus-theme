/**
 * Numerus Group — About Page JavaScript
 * Handles: history image carousel infinite scroll
 */
(function () {
    'use strict';

    // History carousel auto-scroll is driven by CSS animation (@keyframes).
    // This file is a placeholder for any JS enhancements to the about page.

    // Smooth reveal on timeline events (optional progressive enhancement)
    var timelineEvents = document.querySelectorAll('.timeline-event');

    if (timelineEvents.length && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        timelineEvents.forEach(function (el) {
            observer.observe(el);
        });
    }

})();
