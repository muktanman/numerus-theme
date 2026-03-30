<?php
/**
 * Template Name: Automotive
 * Slug: automotive
 */
get_header();
numerus_header( 'sectors' );
$img = get_template_directory_uri() . '/assets/images/';

// ── Field defaults ────────────────────────────────────────────────────────────
$header_title    = numerus_get_field( 'page_header_title' )    ?: 'Automotive';
$header_subtitle = numerus_get_field( 'page_header_subtitle' ) ?: 'Premium commercial vehicle solutions for Iraq\'s industrial sectors';
$about_text      = numerus_get_field( 'about_text' )           ?: 'Leading Star Automotive, a joint venture between Numerus Group and Gargash (UAE), is the authorized distributor for Mercedes Benz commercial vehicles in the Kurdistan Region of Iraq.';
$commitment_text = numerus_get_field( 'commitment_text' )      ?: 'We deliver world class sales and service experiences, ensuring reliability, performance, and long term value for commercial fleets across the region.';
?>
<main class="main">
<div class="automotive-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title"><?php echo esc_html( $header_title ); ?></h1>
                <p class="page-header-subtitle"><?php echo esc_html( $header_subtitle ); ?></p>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="intro-section">
        <div class="container">
            <div class="intro-content intro-content--full">
                <h2 class="section-title">ABOUT</h2>
                <p class="intro-text"><?php echo esc_html( $about_text ); ?></p>
            </div>
            <div class="partners-grid partners-grid-2 partners-grid--top-space">
                <div class="partner-card">
                    <div class="partner-logo-wrapper ls-lockup">
                        <img src="<?php echo esc_url( $img . 'leading-star-logo.svg' ); ?>" alt="Leading Star" class="ls-lockup-star">
                        <div class="ls-lockup-text"><span class="ls-lockup-name">Leading Star</span><span class="ls-lockup-sub">Automotive</span></div>
                    </div>
                    <p class="partner-label">Leading Star Automotive</p>
                </div>
                <div class="partner-card">
                    <div class="partner-logo-wrapper"><img src="<?php echo esc_url( $img . 'mercedesbenz-logo.svg' ); ?>" alt="Mercedes-Benz" class="partner-logo-img"></div>
                    <p class="partner-label">Mercedes-Benz</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Range & Facilities (Dark with bg image) -->
    <section class="services-section section-with-bg-image">
        <div class="section-bg-overlay section-bg-overlay--dim" style="background-image: url('<?php echo esc_url( $img . 'banner-1.png' ); ?>')"></div>
        <div class="container section-content-layer">
            <div class="auto-two-col">
                <div class="auto-col">
                    <h3 class="auto-col-title">PRODUCT RANGE</h3>
                    <div class="auto-h-cards">
                        <div class="auto-h-card"><span class="auto-h-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></span><span>Actros heavy duty trucks</span></div>
                        <div class="auto-h-card"><span class="auto-h-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg></span><span>Sprinter and Vito vans</span></div>
                        <div class="auto-h-card"><span class="auto-h-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span><span>Buses and minibuses</span></div>
                    </div>
                </div>
                <div class="auto-col">
                    <h3 class="auto-col-title">FACILITIES</h3>
                    <div class="auto-h-cards">
                        <div class="auto-h-card"><span class="auto-h-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></span><span>Modern showroom and service center in Erbil</span></div>
                        <div class="auto-h-card"><span class="auto-h-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg></span><span>Certified technicians trained to Mercedes Benz global standards</span></div>
                        <div class="auto-h-card"><span class="auto-h-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></span><span>Genuine spare parts and after sales support</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Commitment (Blue section centered) -->
    <section class="services-section services-section--flex-center">
        <div class="container section-content-layer--centered">
            <h2 class="section-title light section-title--center">COMMITMENT</h2>
            <p class="experience-text"><?php echo esc_html( $commitment_text ); ?></p>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
