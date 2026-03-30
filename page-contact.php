<?php
/**
 * Template Name: Contact
 * Slug: contact
 */
get_header();
numerus_header( 'contact' );
?>
<main class="main">
<div class="contact-page">

    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title">Contact Us</h1>
                <p class="page-header-subtitle">Connect with our global team to explore partnership opportunities</p>
            </div>
        </div>
    </section>

    <!-- Contact Form + Office Locations -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">

                <!-- Form -->
                <div class="form-container">
                    <h2 class="contact-section-title">Get in Touch</h2>
                    <p class="contact-intro">We welcome inquiries from partners, clients, and stakeholders across all sectors.</p>
                    <div class="success-message" id="successMessage" role="alert"></div>
                    <form id="contactForm" class="contact-form" novalidate>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" required class="form-input">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email Address" required class="form-input">
                        </div>
                        <div class="form-group">
                            <input type="text" name="company" placeholder="Company Name" class="form-input">
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Your Message" required rows="6" class="form-textarea"></textarea>
                        </div>
                        <button type="submit" class="submit-button">
                            Send Message
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </form>
                </div>

                <!-- Office Locations -->
                <div class="info-container">
                    <h2 class="contact-section-title">Our Offices</h2>
                    <div class="quick-locations">
                        <?php
                        $offices = [
                            [ 'city' => 'Baghdad', 'address' => 'Al Karrada, District 905, Street 1, Building 8', 'phone' => '+964 (1) 717 8456/7' ],
                            [ 'city' => 'Basra',   'address' => 'Sayed Ameen Street, Albradeyya',                 'phone' => '+964 (781) 877 4944' ],
                            [ 'city' => 'Erbil',   'address' => 'Royal City, Building C7, Suite 30',              'phone' => '+964 (750) 461 1833' ],
                            [ 'city' => 'Dubai',   'address' => 'The Binary Tower, Suite 811, Business Bay',       'phone' => '+971 (4) 457 3030' ],
                        ];
                        $pin_svg = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#161B52" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>';
                        foreach ( $offices as $office ) {
                            echo '<div class="quick-card">';
                            echo '<div class="quick-card-header">' . $pin_svg . '<div><h4>' . esc_html( $office['city'] ) . '</h4></div></div>';
                            echo '<div class="quick-card-content"><p class="address-line">' . esc_html( $office['address'] ) . '</p><p class="phone-line">T: ' . esc_html( $office['phone'] ) . '</p></div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <p class="contact-email-line">Email: <a href="mailto:info@numerusgroup.com">info@numerusgroup.com</a></p>
                </div>

            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
