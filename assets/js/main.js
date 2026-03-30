/**
 * Numerus Group — Main JavaScript
 * Handles: header scroll, mobile menu, desktop dropdown, mobile dropdown
 */
(function () {
    'use strict';

    // -------------------------------------------------------------------------
    // Header scroll effect
    // -------------------------------------------------------------------------
    var header = document.getElementById('header');
    if (header) {
        window.addEventListener('scroll', function () {
            header.classList.toggle('scrolled', window.scrollY > 10);
        });
    }

    // -------------------------------------------------------------------------
    // Mobile menu toggle
    // -------------------------------------------------------------------------
    var mobileMenuToggle = document.getElementById('mobileMenuToggle');
    var mobileMenu       = document.getElementById('mobileMenu');
    var hamburger        = document.getElementById('hamburger');

    if (mobileMenuToggle && mobileMenu && hamburger) {
        mobileMenuToggle.addEventListener('click', function () {
            var isOpen = mobileMenu.classList.toggle('show');
            hamburger.classList.toggle('open');
            mobileMenuToggle.setAttribute('aria-expanded', String(isOpen));
        });
    }

    // -------------------------------------------------------------------------
    // Desktop sectors dropdown
    // -------------------------------------------------------------------------
    var sectorsBtn      = document.getElementById('sectorsBtn');
    var sectorsDropdown = document.getElementById('sectorsDropdown');

    if (sectorsBtn && sectorsDropdown) {
        sectorsBtn.addEventListener('click', function () {
            var isOpen = sectorsDropdown.classList.toggle('show');
            sectorsBtn.setAttribute('aria-expanded', String(isOpen));
            var chevron = sectorsBtn.querySelector('.chevron');
            if (chevron) chevron.classList.toggle('chevron-up');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (!sectorsBtn.contains(e.target) && !sectorsDropdown.contains(e.target)) {
                sectorsDropdown.classList.remove('show');
                sectorsBtn.setAttribute('aria-expanded', 'false');
                var chevron = sectorsBtn.querySelector('.chevron');
                if (chevron) chevron.classList.remove('chevron-up');
            }
        });
    }

    // -------------------------------------------------------------------------
    // Mobile sectors dropdown
    // -------------------------------------------------------------------------
    var mobileSectorsBtn      = document.getElementById('mobileSectorsBtn');
    var mobileSectorsDropdown = document.getElementById('mobileSectorsDropdown');

    if (mobileSectorsBtn && mobileSectorsDropdown) {
        mobileSectorsBtn.addEventListener('click', function () {
            mobileSectorsDropdown.classList.toggle('show');
            var chevron = mobileSectorsBtn.querySelector('.chevron');
            if (chevron) chevron.classList.toggle('chevron-up');
        });
    }

})();
