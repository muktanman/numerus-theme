<?php
/**
 * Template Name: Logistics
 * Slug: logistics
 */
get_header();
numerus_header( 'sectors' );
$img = get_template_directory_uri() . '/assets/images/';

// ── Field defaults ────────────────────────────────────────────────────────────
$header_title    = numerus_get_field( 'page_header_title' )    ?: 'Logistics';
$header_subtitle = numerus_get_field( 'page_header_subtitle' ) ?: 'Nationwide express, cargo and ground transportation solutions';
$about_text      = numerus_get_field( 'about_text' )           ?: 'Numerus Group operates one of Iraq\'s most reliable logistics networks, serving as the fully deployed General Services Provider for FedEx and TNT. Our operations combine international standards with deep local expertise, enabling secure, efficient, and nationwide delivery.';

$capabilities_raw = numerus_get_field( 'capabilities' );
$capabilities = $capabilities_raw ?: [
    [ 'capability_text' => 'Express courier and cargo services' ],
    [ 'capability_text' => 'Customs clearance and documentation' ],
    [ 'capability_text' => 'Door to door delivery across Iraq / Last Mile Delivery Service' ],
    [ 'capability_text' => 'Secure logistics for government, embassies, and IOCs' ],
    [ 'capability_text' => 'Cross border trucking between Iraq, Jordan, and Kuwait' ],
    [ 'capability_text' => 'Real time shipment tracking and automated systems' ],
];

$infra_raw = numerus_get_field( 'infrastructure' );
$infrastructure = $infra_raw ?: [
    [ 'infra_text' => '5 major logistics hubs across Iraq' ],
    [ 'infra_text' => 'Secure facilities in Baghdad, Basra and Erbil' ],
    [ 'infra_text' => 'BGW and ERB airport facilities' ],
    [ 'infra_text' => 'Fleet of distribution vehicles' ],
];

$stats_raw = numerus_get_field( 'why_stats' );
$why_stats = $stats_raw ?: [
    [ 'stat_title' => '200,000+',        'stat_text' => 'missions executed' ],
    [ 'stat_title' => '95%',             'stat_text' => 'Required Delivery Date (RDD) performance' ],
    [ 'stat_title' => 'Prime Contractor','stat_text' => 'for U.S. Government logistics' ],
    [ 'stat_title' => '20+ Years',       'stat_text' => 'of continuous FedEx operations' ],
];

// SVG icon paths for capabilities (keyed by index)
$cap_icons = [
    'M16.5 9.4l-9-5.19M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16zM3.27 6.96L12 12.01l8.73-5.05M12 22.08V12',
    'M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M16 13H8M16 17H8',
    'M1 3h15v13H1zM16 8h4l3 3v5h-7V8zM5.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM18.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5z',
    'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
    'M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zM2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z',
    'M22 12l-4 0-3 9-6-18-3 9-4 0',
];
$infra_icons = [
    'M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zM9 22V12h6v10',
    'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
    'M22 2L11 13M22 2l-7 20-4-9-9-4z',
    'M1 3h15v13H1zM16 8h4l3 3v5h-7V8zM5.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM18.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5z',
];
?>
<main class="main">
<div class="al-estilam-page">

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
            <div class="intro-content">
                <h2 class="section-title">ABOUT</h2>
                <p class="intro-text"><?php echo esc_html( $about_text ); ?></p>
            </div>
            <div class="partnership-header">
                <h2 class="section-title">EXCLUSIVE PARTNERS IN IRAQ</h2>
            </div>
            <div class="partners-grid partners-grid-3">
                <div class="partner-card"><div class="partner-logo-wrapper"><img src="<?php echo esc_url( $img . 'estilam-logo.png' ); ?>" alt="Al-Estilam Express Cargo" class="partner-logo-img"></div><p class="partner-label">Express Cargo</p></div>
                <div class="partner-card"><div class="partner-logo-wrapper"><img src="<?php echo esc_url( $img . 'fedex-logo.png' ); ?>" alt="FedEx" class="partner-logo-img"></div><p class="partner-label">Global Express</p></div>
                <div class="partner-card"><div class="partner-logo-wrapper"><img src="<?php echo esc_url( $img . 'tnt-logo.png' ); ?>" alt="TNT" class="partner-logo-img"></div><p class="partner-label">International Delivery</p></div>
            </div>
        </div>
    </section>

    <!-- Capabilities (Dark with bg image) -->
    <section class="services-section section-with-bg-image">
        <div class="section-bg-overlay section-bg-overlay--dim" style="background-image: url('<?php echo esc_url( $img . 'logistics-2.jpg' ); ?>')"></div>
        <div class="container section-content-layer">
            <h3 class="section-title light">OUR CAPABILITIES</h3>
            <div class="capability-cards">
                <?php foreach ( $capabilities as $i => $cap ) :
                    $icon = $cap_icons[ $i ] ?? $cap_icons[0]; ?>
                    <div class="capability-card">
                        <span class="capability-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="<?php echo esc_attr( $icon ); ?>"/></svg></span>
                        <p><strong><?php echo esc_html( $cap['capability_text'] ); ?></strong></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Infrastructure -->
    <section class="infra-section">
        <div class="container">
            <div class="infra-layout">
                <div>
                    <h3 class="section-title section-title--mb-md">INFRASTRUCTURE</h3>
                    <div class="infra-grid">
                        <?php foreach ( $infrastructure as $i => $item ) :
                            $icon = $infra_icons[ $i ] ?? $infra_icons[0]; ?>
                            <div class="infra-item">
                                <div class="infra-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="<?php echo esc_attr( $icon ); ?>"/></svg></div>
                                <div class="infra-text"><strong><?php echo esc_html( $item['infra_text'] ); ?></strong></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="infra-image">
                    <img src="<?php echo esc_url( $img . 'logistics-2.jpg' ); ?>" alt="Al-Estilam Logistics Operations">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Numerus Logistics -->
    <section class="why-numerus-section">
        <div class="container">
            <div class="why-numerus-header"><h2 class="section-title">WHY NUMERUS LOGISTICS</h2></div>
            <div class="why-numerus-grid">
                <?php foreach ( $why_stats as $stat ) : ?>
                    <div class="why-numerus-card">
                        <h3 class="why-numerus-title"><?php echo esc_html( $stat['stat_title'] ); ?></h3>
                        <p class="why-numerus-text"><?php echo esc_html( $stat['stat_text'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
