/**
 * Numerus Group — Contact Page JavaScript
 * Handles: AJAX form submission with spam protection
 */
(function () {
    'use strict';

    var form           = document.getElementById('contactForm');
    var successMessage = document.getElementById('successMessage');
    var submitBtn      = form ? form.querySelector('.submit-button') : null;
    var loadedAtField  = document.getElementById('formLoadedAt');

    if (!form || !successMessage) return;

    // Record the exact timestamp when the page finishes loading.
    // The server rejects submissions that arrive in under 3 seconds.
    if (loadedAtField) {
        loadedAtField.value = Date.now();
    }

    function resetButton() {
        if (!submitBtn) return;
        submitBtn.disabled = false;
        submitBtn.innerHTML = (typeof numerusAjax !== 'undefined' && numerusAjax.submitText)
            ? numerusAjax.submitText
            : 'Send Message <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var name    = form.querySelector('[name="name"]').value.trim();
        var email   = form.querySelector('[name="email"]').value.trim();
        var company = form.querySelector('[name="company"]').value.trim();
        var message = form.querySelector('[name="message"]').value.trim();
        var hp      = form.querySelector('[name="website"]') ? form.querySelector('[name="website"]').value : '';
        var loadedAt = loadedAtField ? loadedAtField.value : '0';

        if (!name || !email || !message) return;

        // Client-side honeypot guard (belt-and-suspenders; server checks too)
        if (hp) return;

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
        }

        var data = new FormData();
        data.append('action',         'numerus_contact');
        data.append('nonce',          numerusAjax.nonce);
        data.append('name',           name);
        data.append('email',          email);
        data.append('company',        company);
        data.append('message',        message);
        data.append('form_loaded_at', loadedAt);

        fetch(numerusAjax.ajaxurl, { method: 'POST', body: data })
            .then(function (res) { return res.json(); })
            .then(function (res) {
                if (res.success) {
                    form.style.display = 'none';
                    successMessage.style.display = 'block';
                    successMessage.textContent = res.data.message;
                } else {
                    alert(res.data.message || 'An error occurred. Please try again.');
                    resetButton();
                }
            })
            .catch(function () {
                alert('A network error occurred. Please try again.');
                resetButton();
            });
    });

})();
