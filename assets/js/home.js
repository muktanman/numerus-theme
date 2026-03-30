/**
 * Numerus Group — Home Page JavaScript
 * Handles: hero image rotation, parallax, sectors banner hover, number animation, carousel pagination
 */
(function () {
    'use strict';

    // -------------------------------------------------------------------------
    // Hero image rotation (every 5 seconds)
    // -------------------------------------------------------------------------
    var bgImages     = document.querySelectorAll('.background-image');
    var currentIndex = 0;

    if (bgImages.length > 1) {
        setInterval(function () {
            bgImages[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % bgImages.length;
            bgImages[currentIndex].classList.add('active');
        }, 5000);
    }

    // -------------------------------------------------------------------------
    // Parallax effect for hero background images
    // -------------------------------------------------------------------------
    var backgroundImages = document.getElementById('backgroundImages');
    if (backgroundImages) {
        window.addEventListener('scroll', function () {
            backgroundImages.style.transform = 'translateY(' + (window.scrollY * 0.5) + 'px)';
        });
    }

    // -------------------------------------------------------------------------
    // Sectors auto-slider (5-second interval)
    // -------------------------------------------------------------------------
    var slider      = document.getElementById('sectorsSlider');
    var slides      = slider ? slider.querySelectorAll('.sector-slide')      : [];
    var navDots     = slider ? slider.querySelectorAll('.sectors-slider__dot'): [];
    var prevBtn     = document.getElementById('sectorsPrev');
    var nextBtn     = document.getElementById('sectorsNext');
    var sectorIndex = 0;
    var sectorTimer = null;
    var INTERVAL    = 5000;

    function goToSlide(next) {
        if (!slides.length) return;

        // Deactivate current
        slides[sectorIndex].classList.remove('active');
        navDots[sectorIndex] && navDots[sectorIndex].classList.remove('active');

        // Advance
        sectorIndex = (next + slides.length) % slides.length;

        // Activate next
        slides[sectorIndex].classList.add('active');
        if (navDots[sectorIndex]) {
            navDots[sectorIndex].classList.remove('active');
            // Force reflow so the animation restarts
            void navDots[sectorIndex].offsetWidth;
            navDots[sectorIndex].classList.add('active');
        }
    }

    function startSectorTimer() {
        clearInterval(sectorTimer);
        sectorTimer = setInterval(function () {
            goToSlide(sectorIndex + 1);
        }, INTERVAL);
    }

    function stopSectorTimer() {
        clearInterval(sectorTimer);
    }

    if (slides.length > 1) {
        // Dot click
        navDots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                goToSlide(i);
                startSectorTimer();
            });
        });

        // Arrow buttons
        if (prevBtn) prevBtn.addEventListener('click', function () { goToSlide(sectorIndex - 1); startSectorTimer(); });
        if (nextBtn) nextBtn.addEventListener('click', function () { goToSlide(sectorIndex + 1); startSectorTimer(); });

        // Pause on hover
        if (slider) {
            slider.addEventListener('mouseenter', stopSectorTimer);
            slider.addEventListener('mouseleave', startSectorTimer);
            slider.addEventListener('touchstart',  stopSectorTimer, { passive: true });
            slider.addEventListener('touchend',    function () { setTimeout(startSectorTimer, 1500); }, { passive: true });
        }

        startSectorTimer();
    }

    // -------------------------------------------------------------------------
    // Number animation for vision/footprint metrics
    // -------------------------------------------------------------------------
    var visionSection = document.getElementById('visionSection');
    var animated      = false;

    function animateNumbers() {
        if (animated) return;
        animated = true;

        var yearsEl = document.getElementById('yearsMetric');
        var jobsEl  = document.getElementById('jobsMetric');

        if (!yearsEl || !jobsEl) return;

        var duration = 2000;
        var steps    = 50;
        var interval = duration / steps;
        var step     = 0;

        var timer = setInterval(function () {
            step++;
            var progress = step / steps;
            yearsEl.textContent = Math.floor(20  * progress) + '+';
            jobsEl.textContent  = Math.floor(250 * progress) + '+';
            if (step >= steps) {
                clearInterval(timer);
                yearsEl.textContent = '20+';
                jobsEl.textContent  = '250+';
            }
        }, interval);
    }

    if (visionSection && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) animateNumbers();
            });
        }, { threshold: 0.3 });
        observer.observe(visionSection);
    }


})();
