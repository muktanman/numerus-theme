<?php
/**
 * Template Name: Logistics
 * Slug: logistics
 */
get_header();
numerus_header( 'sectors' );
$img = get_template_directory_uri() . '/assets/images/';
?>
<main class="main">
<div class="al-estilam-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title">Logistics</h1>
                <p class="page-header-subtitle">Nationwide express, cargo and ground transportation solutions</p>
            </div>
        </div>
    </section>

    <!-- Introduction -->
    <section class="intro-section">
        <div class="container">
            <div class="intro-content">
                <h2 class="section-title">ABOUT</h2>
                <p class="intro-text">Numerus Group operates one of Iraq's most reliable logistics networks, serving as the fully deployed General Services Provider for FedEx and TNT. Our operations combine international standards with deep local expertise, enabling secure, efficient, and nationwide delivery.</p>
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
                <?php
                $capabilities = [
                    [ 'Express courier and cargo services', 'M16.5 9.4l-9-5.19M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16zM3.27 6.96L12 12.01l8.73-5.05M12 22.08V12' ],
                    [ 'Customs clearance and documentation', 'M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M16 13H8M16 17H8' ],
                    [ 'Door to door delivery across Iraq / Last Mile Delivery Service', 'M1 3h15v13H1zM16 8h4l3 3v5h-7V8zM5.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM18.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5z' ],
                    [ 'Secure logistics for government, embassies, and IOCs', 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z' ],
                    [ 'Cross border trucking between Iraq, Jordan, and Kuwait', 'M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zM2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z' ],
                    [ 'Real time shipment tracking and automated systems', 'M22 12l-4 0-3 9-6-18-3 9-4 0' ],
                ];
                foreach ( $capabilities as $cap ) {
                    echo '<div class="capability-card"><span class="capability-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="' . esc_attr( $cap[1] ) . '"/></svg></span><p><strong>' . esc_html( $cap[0] ) . '</strong></p></div>';
                }
                ?>
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
                        <?php
                        $infra = [
                            [ '5 major logistics hubs across Iraq', 'M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zM9 22V12h6v10' ],
                            [ 'Secure facilities in Baghdad, Basra and Erbil', 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z' ],
                            [ 'BGW and ERB airport facilities', 'M22 2L11 13M22 2l-7 20-4-9-9-4z' ],
                            [ 'Fleet of distribution vehicles', 'M1 3h15v13H1zM16 8h4l3 3v5h-7V8zM5.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM18.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5z' ],
                        ];
                        foreach ( $infra as $item ) {
                            echo '<div class="infra-item"><div class="infra-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="' . esc_attr( $item[1] ) . '"/></svg></div><div class="infra-text"><strong>' . esc_html( $item[0] ) . '</strong></div></div>';
                        }
                        ?>
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
                <div class="why-numerus-card"><h3 class="why-numerus-title">200,000+</h3><p class="why-numerus-text">missions executed</p></div>
                <div class="why-numerus-card"><h3 class="why-numerus-title">95%</h3><p class="why-numerus-text">Required Delivery Date (RDD) performance</p></div>
                <div class="why-numerus-card"><h3 class="why-numerus-title">Prime Contractor</h3><p class="why-numerus-text">for U.S. Government logistics</p></div>
                <div class="why-numerus-card"><h3 class="why-numerus-title">20+ Years</h3><p class="why-numerus-text">of continuous FedEx operations</p></div>
            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
