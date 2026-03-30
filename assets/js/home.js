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
    // Sectors banner — auto-highlight each item every 5 seconds
    // -------------------------------------------------------------------------
    var sectorItems      = document.querySelectorAll('.sector-item');
    var bannerBackground = document.getElementById('bannerBackground');
    var sectorsBanner    = document.getElementById('sectorsBanner');
    var autoIndex        = 0;
    var autoTimer        = null;

    function activateSector(index) {
        sectorItems.forEach(function (el) { el.classList.remove('active'); });
        var item = sectorItems[index];
        if (!item) return;
        item.classList.add('active');
        var img = item.getAttribute('data-image');
        if (img && bannerBackground) {
            bannerBackground.style.backgroundImage = 'url(' + img + ')';
        }
        if (sectorsBanner) sectorsBanner.classList.add('has-active');
    }

    function startAutoHighlight() {
        clearInterval(autoTimer);
        autoTimer = setInterval(function () {
            autoIndex = (autoIndex + 1) % sectorItems.length;
            activateSector(autoIndex);
        }, 5000);
    }

    function stopAutoHighlight() {
        clearInterval(autoTimer);
    }

    if (sectorItems.length) {
        // Keep hover working — pause auto on hover, resume on leave
        sectorItems.forEach(function (item, i) {
            item.addEventListener('mouseenter', function () {
                stopAutoHighlight();
                sectorItems.forEach(function (el) { el.classList.remove('active'); });
                item.classList.add('active');
                var img = item.getAttribute('data-image');
                if (img && bannerBackground) bannerBackground.style.backgroundImage = 'url(' + img + ')';
                if (sectorsBanner) sectorsBanner.classList.add('has-active');
                autoIndex = i;
            });
            item.addEventListener('mouseleave', function () {
                startAutoHighlight();
            });
        });

        // Start with first item highlighted
        activateSector(0);
        startAutoHighlight();
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
        var currentSlide     = 0;
        var autoScrollTimer;

        function updateDots(index) {
            dots.forEach(function (dot, i) { dot.classList.toggle('active', i === index); });
        }

        function scrollToSlide(index) {
            var firstCard = sectorsGrid.querySelector('.sector-card');
            if (!firstCard) return;
            sectorsGrid.scrollTo({ left: index * (firstCard.offsetWidth + 16), behavior: 'smooth' });
            currentSlide = index;
            updateDots(index);
        }

        function startMobileScroll() {
            autoScrollTimer = setInterval(function () {
                currentSlide = (currentSlide + 1) % dots.length;
                scrollToSlide(currentSlide);
            }, 5000);
        }

        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                clearInterval(autoScrollTimer);
                scrollToSlide(i);
                setTimeout(startMobileScroll, 3000);
            });
        });

        sectorsGrid.addEventListener('touchstart', function () { clearInterval(autoScrollTimer); });
        sectorsGrid.addEventListener('touchend',   function () { setTimeout(startMobileScroll, 3000); });
        sectorsGrid.addEventListener('scroll', function () {
            var firstCard = sectorsGrid.querySelector('.sector-card');
            if (!firstCard) return;
            currentSlide = Math.round(sectorsGrid.scrollLeft / (firstCard.offsetWidth + 16));
            updateDots(currentSlide);
        });

        startMobileScroll();
    }

})();
