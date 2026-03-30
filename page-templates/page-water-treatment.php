<?php
/**
 * Template Name: Water Treatment
 * Slug: water-treatment
 */
get_header();
numerus_header( 'sectors' );
$img = get_template_directory_uri() . '/assets/images/';

// ── Field defaults ────────────────────────────────────────────────────────────
$header_title    = numerus_get_field( 'page_header_title' )    ?: 'Water Treatment';
$header_subtitle = numerus_get_field( 'page_header_subtitle' ) ?: 'Integrated support services across Iraq\'s energy and utilities sectors';
$about_text      = numerus_get_field( 'about_text' )           ?: 'Al Gharraf Oil Services (AGOS) delivers integrated support services to international oil companies and EPC contractors operating in Iraq\'s upstream sector. Our experience spans camp construction, life support, manpower, logistics, and specialized engineering services.';
$experience_text = numerus_get_field( 'experience_text' )      ?: 'AGOS has supported drilling, production, and field development operations across southern Iraq, delivering reliable services in challenging environments with a strong focus on safety and compliance.';

$services_raw = numerus_get_field( 'services' );
$services = $services_raw ?: [
    [ 'service_text' => 'Desalination plant operations and maintenance' ],
    [ 'service_text' => 'Water purification system design and installation' ],
    [ 'service_text' => 'Reverse osmosis plant management' ],
    [ 'service_text' => 'Water quality testing and compliance' ],
    [ 'service_text' => 'Emergency water supply for remote camps' ],
    [ 'service_text' => 'Wastewater treatment and disposal' ],
];

$clients_raw = numerus_get_field( 'clients' );
$clients = $clients_raw ?: [
    [ 'client_logo' => $img . 'veolia-logo.svg',       'client_name' => 'Veolia' ],
    [ 'client_logo' => $img . 'bakerhughes-logo.png',  'client_name' => 'Baker Hughes' ],
    [ 'client_logo' => $img . 'petrofac-logo.png',     'client_name' => 'Petrofac' ],
    [ 'client_logo' => $img . 'halliburton-logo.png',  'client_name' => 'Halliburton' ],
    [ 'client_logo' => $img . 'nps-logo.jpg',          'client_name' => 'NPS' ],
    [ 'client_logo' => $img . 'oilserv-logo.png',      'client_name' => 'OilSERV' ],
    [ 'client_logo' => $img . 'weatherford-logo.png',  'client_name' => 'Weatherford' ],
];
?>
<main class="main">
<div class="oil-gas-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title"><?php echo esc_html( $header_title ); ?></h1>
                <p class="page-header-subtitle"><?php echo esc_html( $header_subtitle ); ?></p>
            </div>
        </div>
    </section>

    <!-- Introduction -->
    <section class="intro-section">
        <div class="container">
            <div class="intro-with-logo">
                <div class="partner-card partner-card--compact">
                    <div class="partner-logo-wrapper"><img src="<?php echo esc_url( $img . 'agos-logo.jpg' ); ?>" alt="Al-Gharraf Oil Services" class="partner-logo-img"></div>
                    <p class="partner-label">AGOS</p>
                </div>
                <div class="intro-content intro-content--left">
                    <h2 class="section-title">ABOUT AGOS</h2>
                    <p class="intro-text"><?php echo esc_html( $about_text ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services (Dark with bg image) -->
    <section class="services-section section-with-bg-image">
        <div class="section-bg-overlay section-bg-overlay--dim" style="background-image: url('<?php echo esc_url( $img . 'oil-gas-main.jpg' ); ?>')"></div>
        <div class="container section-content-layer">
            <h3 class="section-title light">WATER TREATMENT SERVICES</h3>
            <div class="capability-cards">
                <?php foreach ( $services as $svc ) : ?>
                    <div class="capability-card">
                        <span class="capability-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                        <p><strong><?php echo esc_html( $svc['service_text'] ); ?></strong></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Clients -->
    <section class="clients-static-section">
        <div class="container">
            <h2 class="section-title section-title--center section-title--mb-lg">CLIENTS</h2>
            <div class="partners-grid-full partners-grid-full--4col">
                <?php foreach ( $clients as $cl ) :
                    $logo = is_array( $cl['client_logo'] ) ? $cl['client_logo']['url'] : $cl['client_logo'];
                ?>
                    <div class="partner-grid-card"><div class="partner-logo-container"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $cl['client_name'] ); ?>" class="partner-grid-logo"></div></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Experience Banner -->
    <section class="experience-banner">
        <div class="experience-banner__bg" style="background-image: url('<?php echo esc_url( $img . 'oil-gas-main.jpg' ); ?>')"></div>
        <div class="experience-banner__overlay"></div>
        <div class="container experience-banner__content">
            <h2 class="section-title light section-title--center">EXPERIENCE</h2>
            <p class="experience-text"><?php echo esc_html( $experience_text ); ?></p>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
