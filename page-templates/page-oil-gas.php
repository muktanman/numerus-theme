<?php
/**
 * Template Name: Oil & Gas
 * Slug: oil-gas
 */
get_header();
numerus_header( 'sectors' );
$img = get_template_directory_uri() . '/assets/images/';
?>
<main class="main">
<div class="oil-gas-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title">Oil &amp; Gas</h1>
                <p class="page-header-subtitle">Integrated support services across Iraq's energy and utilities sectors</p>
            </div>
        </div>
    </section>

    <!-- AGOS Introduction -->
    <section class="intro-section">
        <div class="container">
            <div class="intro-with-logo">
                <div class="partner-card partner-card--compact">
                    <div class="partner-logo-wrapper"><img src="<?php echo esc_url( $img . 'agos-logo.jpg' ); ?>" alt="Al-Gharraf Oil Services" class="partner-logo-img"></div>
                    <p class="partner-label">AGOS</p>
                </div>
                <div class="intro-content intro-content--left">
                    <h2 class="section-title">ABOUT AGOS</h2>
                    <p class="intro-text">Al Gharraf Oil Services (AGOS) delivers integrated support services to international oil companies and EPC contractors operating in Iraq's upstream sector. Our experience spans camp construction, life support, manpower, logistics, and specialized engineering services.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services (Dark with bg image) -->
    <section class="services-section section-with-bg-image">
        <div class="section-bg-overlay section-bg-overlay--dim" style="background-image: url('<?php echo esc_url( $img . 'oil-gas-main.jpg' ); ?>')"></div>
        <div class="container section-content-layer">
            <h3 class="section-title light">SERVICES</h3>
            <div class="capability-cards">
                <?php
                $services = [
                    'Water Treatment / Desalination Plant O&M',
                    'Camp construction and accommodation units',
                    'Catering, life support, and O&M of remote camps',
                    'Manpower supply and payroll management',
                    'Fuel and water supply services',
                    'Waste management and environmental services',
                    'Logistics, transport, and trucking',
                    'Cathodic protection engineering and installation',
                    'Supply of valves, pipes, drill bits, and O&G materials',
                ];
                foreach ( $services as $svc ) {
                    echo '<div class="capability-card"><span class="capability-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span><p><strong>' . esc_html( $svc ) . '</strong></p><a href="' . esc_url( home_url( '/service-detail' ) ) . '" class="capability-learn-more">Learn More</a></div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Clients -->
    <section class="clients-static-section">
        <div class="container">
            <h2 class="section-title section-title--center section-title--mb-lg">CLIENTS</h2>
            <div class="partners-grid-full partners-grid-full--4col">
                <?php
                $clients = [ 'veolia-logo.svg' => 'Veolia', 'bakerhughes-logo.png' => 'Baker Hughes', 'petrofac-logo.png' => 'Petrofac', 'halliburton-logo.png' => 'Halliburton', 'nps-logo.jpg' => 'NPS', 'oilserv-logo.png' => 'OilSERV', 'weatherford-logo.png' => 'Weatherford' ];
                foreach ( $clients as $file => $alt ) {
                    echo '<div class="partner-grid-card"><div class="partner-logo-container"><img src="' . esc_url( $img . $file ) . '" alt="' . esc_attr( $alt ) . '" class="partner-grid-logo"></div></div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Experience Banner -->
    <section class="experience-banner">
        <div class="experience-banner__bg" style="background-image: url('<?php echo esc_url( $img . 'oil-gas-main.jpg' ); ?>')"></div>
        <div class="experience-banner__overlay"></div>
        <div class="container experience-banner__content">
            <h2 class="section-title light section-title--center">EXPERIENCE</h2>
            <p class="experience-text">AGOS has supported drilling, production, and field development operations across southern Iraq, delivering reliable services in challenging environments with a strong focus on safety and compliance.</p>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
