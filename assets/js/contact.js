/**
 * Numerus Group — Contact Page JavaScript
 * Handles: AJAX form submission
 */
(function () {
    'use strict';

    var form           = document.getElementById('contactForm');
    var successMessage = document.getElementById('successMessage');
    var submitBtn      = form ? form.querySelector('.submit-button') : null;

    if (!form || !successMessage) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var name    = form.querySelector('[name="name"]').value.trim();
        var email   = form.querySelector('[name="email"]').value.trim();
        var company = form.querySelector('[name="company"]').value.trim();
        var message = form.querySelector('[name="message"]').value.trim();

        if (!name || !email || !message) return;

        // Show loading state
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
        }

        var data = new FormData();
        data.append('action', 'numerus_contact');
        data.append('nonce',   numerusAjax.nonce);
        data.append('name',    name);
        data.append('email',   email);
        data.append('company', company);
        data.append('message', message);

        fetch(numerusAjax.ajaxurl, { method: 'POST', body: data })
            .then(function (res) { return res.json(); })
            .then(function (res) {
                if (res.success) {
                    form.style.display = 'none';
                    successMessage.style.display = 'block';
                    successMessage.textContent = res.data.message;
                } else {
                    alert(res.data.message || 'An error occurred. Please try again.');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'Send Message <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
                    }
                }
            })
            .catch(function () {
                alert('A network error occurred. Please try again.');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Send Message <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
                }
            });
    });

})();
