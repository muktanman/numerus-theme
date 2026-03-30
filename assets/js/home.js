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
    // Sectors banner hover — swap background image on hover
    // -------------------------------------------------------------------------
    var sectorItems    = document.querySelectorAll('.sector-item');
    var bannerBackground = document.getElementById('bannerBackground');

    if (sectorItems.length && bannerBackground) {
        sectorItems.forEach(function (item) {
            item.addEventListener('mouseenter', function () {
                var img = item.getAttribute('data-image');
                if (img) bannerBackground.style.backgroundImage = 'url(' + img + ')';
            });
        });
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

    // -------------------------------------------------------------------------
    // Mobile sectors carousel — auto-scroll + dots pagination
    // -------------------------------------------------------------------------
    var sectorsGrid = document.querySelector('.sectors-grid');
    var dots        = document.querySelectorAll('#sectorsDots .dot');

    if (sectorsGrid && dots.length) {
        var currentSlide      = 0;
        var autoScrollInterval;

        function updateDots(index) {
            dots.forEach(function (dot, i) {
                dot.classList.toggle('active', i === index);
            });
        }

        function scrollToSlide(index) {
            var firstCard = sectorsGrid.querySelector('.sector-card');
            if (!firstCard) return;
            var cardWidth = firstCard.offsetWidth + 16;
            sectorsGrid.scrollTo({ left: index * cardWidth, behavior: 'smooth' });
            currentSlide = index;
            updateDots(index);
        }

        function startAutoScroll() {
            autoScrollInterval = setInterval(function () {
                currentSlide = (currentSlide + 1) % 3;
                scrollToSlide(currentSlide);
            }, 4000);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        // Dot click navigation
        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                stopAutoScroll();
                scrollToSlide(i);
                setTimeout(startAutoScroll, 3000);
            });
        });

        // Pause on touch
        sectorsGrid.addEventListener('touchstart', stopAutoScroll);
        sectorsGrid.addEventListener('touchend', function () {
            setTimeout(startAutoScroll, 3000);
        });

        // Update dots on manual scroll
        sectorsGrid.addEventListener('scroll', function () {
            var firstCard = sectorsGrid.querySelector('.sector-card');
            if (!firstCard) return;
            var cardWidth = firstCard.offsetWidth + 16;
            var idx = Math.round(sectorsGrid.scrollLeft / cardWidth);
            currentSlide = idx;
            updateDots(idx);
        });

        startAutoScroll();
    }

})();
