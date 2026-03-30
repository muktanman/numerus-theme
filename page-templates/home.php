<?php
/**
 * Template Name: Home
 * Front page template for Numerus Group.
 */
get_header();
numerus_header( '' );
$img = get_template_directory_uri() . '/assets/images/';

// ── Field defaults ────────────────────────────────────────────────────────────
$hero_title          = numerus_get_field( 'hero_title' )             ?: 'Building Sustainable Businesses in Iraq for <span class="hero-title-break">Over 50 Years</span>';
$about_text          = numerus_get_field( 'about_text' )             ?: 'Numerus Group is a diversified Iraqi conglomerate operating across Logistics, Oil &amp; Gas Services, and Automotive Distribution. With a national footprint and regional offices in the UAE, we deliver reliable, high performance solutions to global partners and local industries.';
$fp_years_number     = numerus_get_field( 'footprint_years_number' ) ?: '20+';
$fp_years_label      = numerus_get_field( 'footprint_years_label' )  ?: 'Years of Excellence';
$fp_jobs_number      = numerus_get_field( 'footprint_jobs_number' )  ?: '250+';
$fp_jobs_label       = numerus_get_field( 'footprint_jobs_label' )   ?: 'Trained Professionals';
$fp_text_1           = numerus_get_field( 'footprint_text_1' )       ?: 'Operations across all major Iraqi governorates, supported by offices in Baghdad, Basra, Erbil, and Dubai.';
$fp_text_2           = numerus_get_field( 'footprint_text_2' )       ?: 'A workforce of 250+ trained professionals across engineering, logistics, operations, and management.';
$cta_subtitle_1      = numerus_get_field( 'cta_subtitle_1' )         ?: 'Over five decades, Numerus Group has built a diversified portfolio spanning telecom distribution, FMCG, power &amp; energy, and F&amp;B franchises.';
$cta_subtitle_2      = numerus_get_field( 'cta_subtitle_2' )         ?: 'While these sectors are no longer active or may otherwise been divested from the group, they form the foundation of our reputation for reliability, scale, and operational excellence.';
?>
<main class="main">

    <!-- Hero Section -->
    <section class="hero">
        <div class="background-images" id="backgroundImages">
            <div class="background-image active" style="background-image: url('<?php echo esc_url( $img . 'banner-0.jpg' ); ?>')"></div>
            <div class="background-image" style="background-image: url('<?php echo esc_url( $img . 'banner-1.png' ); ?>')"></div>
            <div class="background-image" style="background-image: url('<?php echo esc_url( $img . 'banner-2.jpg' ); ?>')"></div>
            <div class="background-image" style="background-image: url('<?php echo esc_url( $img . 'banner-3.png' ); ?>'); background-position: bottom"></div>
        </div>
        <div class="hero-overlay"></div>
        <div class="container hero-container">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo wp_kses( $hero_title, [ 'span' => [ 'class' => [] ] ] ); ?></h1>
                <div class="hero-cta">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn hero-button">
                        Partner With Us
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Strip / Ticker -->
    <section class="info-strip">
        <div class="ticker-wrapper">
            <div class="ticker-content">
                <?php
                $ticker_items = [
                    [ 'path' => 'M16.5 9.4l-9-5.19M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16zM3.27 6.96L12 12.01l8.73-5.05M12 22.08V12', 'text' => 'Service provider for FEDEX in Iraq since 2003' ],
                    [ 'path' => 'M6 22V4a2 2 0 012-2h8a2 2 0 012 2v18zM6 12H4a2 2 0 00-2 2v6a2 2 0 002 2h2M18 9h2a2 2 0 012 2v9a2 2 0 01-2 2h-2', 'text' => 'Master distributor and nationwide retail network' ],
                    [ 'path' => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z', 'text' => 'Partner to world-class global brands' ],
                    [ 'circle' => true, 'text' => 'Enabling international market entry' ],
                    [ 'polyline' => 'M23 6 13.5 15.5 8.5 10.5 1 18M17 6 23 6 23 12', 'text' => '20+ years of operational excellence' ],
                    [ 'path' => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z', 'text' => 'Trusted by Fortune 500 companies' ],
                ];
                // Output twice for infinite scroll
                for ( $r = 0; $r < 2; $r++ ) {
                    foreach ( $ticker_items as $item ) {
                        echo '<div class="ticker-item"><div class="ticker-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
                        if ( ! empty( $item['circle'] ) ) {
                            echo '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>';
                        } elseif ( ! empty( $item['polyline'] ) ) {
                            echo '<polyline points="' . esc_attr( $item['polyline'] ) . '"/>';
                        } else {
                            echo '<path d="' . esc_attr( $item['path'] ) . '"/>';
                        }
                        echo '</svg></div><span class="ticker-text">' . esc_html( $item['text'] ) . '</span></div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section about-section">
        <div class="container">
            <div class="about-content">
                <h2 class="about-title">About</h2>
                <p class="about-text"><?php echo wp_kses( $about_text, [ 'a' => [ 'href' => [] ] ] ); ?></p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">Contact Us</a>
            </div>
        </div>
    </section>

    <!-- Sectors Banner (Desktop) -->
    <div class="desktop-only">
        <section class="sectors-banner" id="sectorsBanner">
            <div class="banner-background" id="bannerBackground"></div>
            <div class="banner-overlay"></div>
            <div class="container">
                <p class="sectors-eyebrow">Our Sectors</p>
                <div class="sectors-row">
                    <a href="<?php echo esc_url( home_url( '/logistics' ) ); ?>" class="sector-item" data-image="<?php echo esc_url( $img . 'fedex-spotlight.png' ); ?>" data-sector="logistics">
                        <div class="sector-logo"><img src="<?php echo esc_url( $img . 'estilam-logo.png' ); ?>" alt="Al-Estilam Express"></div>
                        <h3 class="sector-title">Logistics</h3>
                        <p class="sector-company">Al-Estilam Express Cargo Company</p>
                        <p class="sector-description">A nationwide express courier and cargo network, operating as the fully deployed General Services Provider for FedEx and TNT in Iraq, supported by secure hubs, cross border trucking, and advanced distribution systems.</p>
                        <span class="sector-link">Learn more <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/automotive' ) ); ?>" class="sector-item" data-image="<?php echo esc_url( $img . 'sectors-automotive.png' ); ?>" data-sector="automotive">
                        <div class="sector-logo ls-lockup-v">
                            <img src="<?php echo esc_url( $img . 'leading-star-logo.svg' ); ?>" alt="Leading Star" class="ls-lockup-star-v">
                            <div class="ls-lockup-text-v"><span class="ls-lockup-name-v">Leading Star</span><span class="ls-lockup-sub-v">Automotive</span></div>
                        </div>
                        <h3 class="sector-title">Automotive</h3>
                        <p class="sector-company">Leading Star Automotive Company</p>
                        <p class="sector-description">As the authorized distributor for Mercedes Benz commercial vehicles in the Kurdistan Region, we offer world class sales, service, and after sales support through Leading Star Automotive.</p>
                        <span class="sector-link">Learn more <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/oil-gas' ) ); ?>" class="sector-item" data-image="<?php echo esc_url( $img . 'banner-2.jpg' ); ?>" data-sector="oilgas">
                        <div class="sector-logo"><img src="<?php echo esc_url( $img . 'agos-logo.jpg' ); ?>" alt="AGOS"></div>
                        <h3 class="sector-title">Oil &amp; Gas</h3>
                        <p class="sector-company">Al-Gharraf Oil Services (AGOS)</p>
                        <p class="sector-description">Through Al Gharraf Oil Services (AGOS), we provide integrated camp services, manpower, logistics, and operational support to international oil companies across Iraq's upstream sector.</p>
                        <span class="sector-link">Learn more <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    </a>
                </div>
            </div>
        </section>
    </div>

    <!-- Sectors Grid (Mobile) -->
    <div class="mobile-only">
        <section class="section sectors-section">
            <div class="container">
                <h2 class="section-title">Sectors</h2>
                <div class="sectors-grid">
                    <?php
                    $sector_cards = [
                        [ 'url' => '/logistics',  'img' => 'logistics.jpg',    'title' => 'Logistics',   'company' => 'Al-Estilam Express Cargo Company',   'desc' => 'A nationwide express courier and cargo network, operating as the fully deployed General Services Provider for FedEx and TNT in Iraq, supported by secure hubs, cross border trucking, and advanced distribution systems.' ],
                        [ 'url' => '/automotive', 'img' => 'automotive.avif',  'title' => 'Automotive',  'company' => 'Leading Star Automotive Company',     'desc' => 'As the authorized distributor for Mercedes Benz commercial vehicles in the Kurdistan Region, we offer world class sales, service, and after sales support through Leading Star Automotive.' ],
                        [ 'url' => '/oil-gas',    'img' => 'oil-gas.jpg',      'title' => 'Oil & Gas',   'company' => 'Al-Gharraf Oil Services (AGOS)',       'desc' => 'Through Al Gharraf Oil Services (AGOS), we provide integrated camp services, manpower, logistics, and operational support to international oil companies across Iraq\'s upstream sector.' ],
                    ];
                    foreach ( $sector_cards as $card ) {
                        echo '<a href="' . esc_url( home_url( $card['url'] ) ) . '" class="sector-card">';
                        echo '<div class="card-image"><div class="image-placeholder" style="background-image: url(\'' . esc_url( $img . $card['img'] ) . '\')"></div><div class="card-overlay"></div></div>';
                        echo '<div class="card-content"><h3 class="card-title">' . esc_html( $card['title'] ) . '</h3><p class="card-company">' . esc_html( $card['company'] ) . '</p><p class="card-description">' . esc_html( $card['desc'] ) . '</p><span class="card-link">Learn more <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>';
                        echo '</a>';
                    }
                    ?>
                </div>
                <div class="carousel-dots" id="sectorsDots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </section>
    </div>

    <!-- Clientele / Logo Slider -->
    <section class="section clientele-section">
        <div class="container">
            <div class="clientele-content">
                <h2 class="clientele-title">Trusted by Global Leaders</h2>
            </div>
        </div>
        <div class="slider-wrapper">
            <div class="slider-gradient-left"></div>
            <div class="slider-gradient-right"></div>
            <div class="client-slider">
                <div class="slider-track">
                    <?php
                    $logos = [ 'bakerhughes-logo.png' => 'Baker Hughes', 'petrofac-logo.png' => 'Petrofac', 'fedex-logo.png' => 'FedEx', 'tnt-logo.png' => 'TNT', 'mercedesbenz-logo.svg' => 'Mercedes-Benz', 'zain-logo.svg' => 'Zain', 'fonterra-logo.png' => 'Fonterra', 'wartsila-logo.png' => 'Wärtsilä', 'parsons-logo.png' => 'Parsons', 'marathonoil-logo.svg' => 'Marathon Oil', 'raytheon-logo.svg' => 'Raytheon' ];
                    for ( $r = 0; $r < 2; $r++ ) {
                        foreach ( $logos as $file => $alt ) {
                            echo '<div class="client-logo"><img src="' . esc_url( $img . $file ) . '" alt="' . esc_attr( $alt ) . '"></div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footprint / Vision Section -->
    <section class="section vision-section" id="visionSection">
        <div class="container">
            <div class="vision-grid">
                <div class="vision-image">
                    <div class="vision-image-placeholder" style="background-image: url('<?php echo esc_url( $img . 'vision.jpg' ); ?>')"></div>
                </div>
                <div class="vision-content">
                    <h2 class="vision-title">Our Footprint</h2>
                    <p class="vision-text"><?php echo esc_html( $fp_text_1 ); ?></p>
                    <p class="vision-text"><?php echo esc_html( $fp_text_2 ); ?></p>
                    <div class="vision-metrics">
                        <div class="metric"><span class="metric-number" id="yearsMetric"><?php echo esc_html( $fp_years_number ); ?></span><span class="metric-label"><?php echo esc_html( $fp_years_label ); ?></span></div>
                        <div class="metric"><span class="metric-number" id="jobsMetric"><?php echo esc_html( $fp_jobs_number ); ?></span><span class="metric-label"><?php echo esc_html( $fp_jobs_label ); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="cta-banner">
        <div class="cta-background"></div>
        <div class="container">
            <div class="cta-content">
                <p class="cta-subtitle"><strong><?php echo wp_kses( $cta_subtitle_1, [ 'strong' => [] ] ); ?></strong></p>
                <p class="cta-subtitle"><?php echo esc_html( $cta_subtitle_2 ); ?></p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn cta-button">
                    Partner With Us
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

</main>
<?php
get_footer();
