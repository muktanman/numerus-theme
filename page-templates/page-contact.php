<?php
/**
 * Template Name: Contact
 * Slug: contact
 */
get_header();
numerus_header( 'contact' );

// ── Field defaults ────────────────────────────────────────────────────────────
$header_title    = numerus_get_field( 'page_header_title' )    ?: 'Contact Us';
$header_subtitle = numerus_get_field( 'page_header_subtitle' ) ?: 'Connect with our global team to explore partnership opportunities';
$form_intro      = numerus_get_field( 'form_intro' )           ?: 'We welcome inquiries from partners, clients, and stakeholders across all sectors.';
$contact_email   = numerus_get_field( 'contact_email' )        ?: 'info@numerusgroup.com';

$offices_raw = numerus_get_field( 'offices' );
$offices = $offices_raw ?: [
    [ 'office_city' => 'Baghdad', 'office_address' => 'Al Karrada, District 905, Street 1, Building 8', 'office_phone' => '+964 (1) 717 8456/7' ],
    [ 'office_city' => 'Basra',   'office_address' => 'Sayed Ameen Street, Albradeyya',                 'office_phone' => '+964 (781) 877 4944' ],
    [ 'office_city' => 'Erbil',   'office_address' => 'Royal City, Building C7, Suite 30',              'office_phone' => '+964 (750) 461 1833' ],
    [ 'office_city' => 'Dubai',   'office_address' => 'The Binary Tower, Suite 811, Business Bay',       'office_phone' => '+971 (4) 457 3030' ],
];

$pin_svg = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#161B52" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>';
?>
<main class="main">
<div class="contact-page">

    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title"><?php echo esc_html( $header_title ); ?></h1>
                <p class="page-header-subtitle"><?php echo esc_html( $header_subtitle ); ?></p>
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
                    <p class="contact-intro"><?php echo esc_html( $form_intro ); ?></p>
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
                        <?php foreach ( $offices as $office ) : ?>
                            <div class="quick-card">
                                <div class="quick-card-header"><?php echo $pin_svg; ?><div><h4><?php echo esc_html( $office['office_city'] ); ?></h4></div></div>
                                <div class="quick-card-content">
                                    <p class="address-line"><?php echo esc_html( $office['office_address'] ); ?></p>
                                    <p class="phone-line">T: <?php echo esc_html( $office['office_phone'] ); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <p class="contact-email-line">Email: <a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a></p>
                </div>

            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
