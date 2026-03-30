document.addEventListener('DOMContentLoaded', function () {
    var track = document.querySelector('.clients-static-section .partners-grid-full');
    if (!track) return;

    var dotsContainer = null;

    function isMobile() {
        return window.innerWidth <= 640;
    }

    function getCards() {
        return Array.prototype.slice.call(track.querySelectorAll('.partner-grid-card'));
    }

    function getActiveIndex() {
        var cards = getCards();
        var trackLeft = track.getBoundingClientRect().left;
        var closest = 0;
        var minDist = Infinity;
        cards.forEach(function (card, i) {
            var dist = Math.abs(card.getBoundingClientRect().left - trackLeft);
            if (dist < minDist) { minDist = dist; closest = i; }
        });
        return closest;
    }

    function updateDots() {
        if (!dotsContainer) return;
        var active = getActiveIndex();
        var dots = dotsContainer.querySelectorAll('.clients-dot');
        dots.forEach(function (dot, i) {
            dot.classList.toggle('clients-dot--active', i === active);
        });
    }

    function scrollToCard(index) {
        var cards = getCards();
        if (!cards[index]) return;
        track.scrollTo({ left: cards[index].offsetLeft, behavior: 'smooth' });
    }

    function buildDots() {
        if (dotsContainer) return;
        var cards = getCards();
        if (cards.length < 2) return;

        dotsContainer = document.createElement('div');
        dotsContainer.className = 'clients-dots';

        cards.forEach(function (_, i) {
            var dot = document.createElement('button');
            dot.className = 'clients-dot' + (i === 0 ? ' clients-dot--active' : '');
            dot.setAttribute('aria-label', 'Go to client ' + (i + 1));
            dot.addEventListener('click', function () { scrollToCard(i); });
            dotsContainer.appendChild(dot);
        });

        track.parentNode.insertBefore(dotsContainer, track.nextSibling);
        track.addEventListener('scroll', updateDots, { passive: true });
    }

    function removeDots() {
        if (dotsContainer) {
            dotsContainer.parentNode && dotsContainer.parentNode.removeChild(dotsContainer);
            dotsContainer = null;
            track.removeEventListener('scroll', updateDots);
        }
    }

    function init() {
        if (isMobile()) {
            buildDots();
        } else {
            removeDots();
        }
    }

    init();
    window.addEventListener('resize', init);
});
