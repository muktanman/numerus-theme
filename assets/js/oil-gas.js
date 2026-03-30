document.addEventListener('DOMContentLoaded', function () {
    var track = document.querySelector('.clients-static-section .partners-grid-full');
    if (!track) return;

    var currentIndex = 0;
    var interval = null;

    function isMobile() {
        return window.innerWidth <= 640;
    }

    function getCards() {
        return Array.prototype.slice.call(track.querySelectorAll('.partner-grid-card'));
    }

    function scrollToCard(index) {
        var cards = getCards();
        if (!cards.length) return;
        if (index >= cards.length) index = 0;
        if (index < 0) index = cards.length - 1;
        currentIndex = index;
        track.scrollTo({ left: cards[index].offsetLeft, behavior: 'smooth' });
    }

    function startAutoSlide() {
        if (interval) return;
        interval = setInterval(function () {
            scrollToCard(currentIndex + 1);
        }, 5000);
    }

    function stopAutoSlide() {
        clearInterval(interval);
        interval = null;
    }

    if (isMobile()) {
        startAutoSlide();
    }

    window.addEventListener('resize', function () {
        if (isMobile()) {
            if (!interval) startAutoSlide();
        } else {
            stopAutoSlide();
        }
    });

    // Pause on touch, resume 3s after user lifts finger
    track.addEventListener('touchstart', function () {
        stopAutoSlide();
    }, { passive: true });

    track.addEventListener('touchend', function () {
        setTimeout(startAutoSlide, 3000);
    }, { passive: true });
});
