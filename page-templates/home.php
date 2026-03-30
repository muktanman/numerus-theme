<?php
/**
 * Template Name: Home
 * Front page template for Numerus Group.
 */
get_header();
numerus_header( '' );
$img = get_template_directory_uri() . '/assets/images/';

// ── Hero ──────────────────────────────────────────────────────────────────────
$hero_title       = numerus_get_field( 'hero_title' )       ?: 'Building Sustainable Businesses in Iraq for <span class="hero-title-break">Over 50 Years</span>';
$hero_button_text = numerus_get_field( 'hero_button_text' ) ?: 'Partner With Us';
$hero_button_url  = numerus_get_field( 'hero_button_url' )  ?: home_url( '/contact' );
$hero_slides_raw  = numerus_get_field( 'hero_slides' );
$hero_slides = $hero_slides_raw ?: [
    [ 'slide_image' => $img . 'banner-0.jpg', 'slide_position' => 'center' ],
    [ 'slide_image' => $img . 'banner-1.png', 'slide_position' => 'center' ],
    [ 'slide_image' => $img . 'banner-2.jpg', 'slide_position' => 'center' ],
    [ 'slide_image' => $img . 'banner-3.png', 'slide_position' => 'bottom' ],
];

// ── About Us ──────────────────────────────────────────────────────────────────
$about_text = numerus_get_field( 'about_text' ) ?: 'Numerus Group is a diversified Iraqi conglomerate operating across Logistics, Oil &amp; Gas Services, and Automotive Distribution. With a national footprint and regional offices in the UAE, we deliver reliable, high performance solutions to global partners and local industries.';

// ── Our Sectors ───────────────────────────────────────────────────────────────
$sectors_raw = numerus_get_field( 'sectors' );
$sectors = $sectors_raw ?: [
    [
        'sector_image'       => $img . 'fedex-spotlight.png',
        'sector_logo'        => $img . 'estilam-logo.png',
        'sector_title'       => 'Logistics',
        'sector_company'     => 'Al-Estilam Express Cargo Company',
        'sector_description' => 'A nationwide express courier and cargo network, operating as the fully deployed General Services Provider for FedEx and TNT in Iraq, supported by secure hubs, cross border trucking, and advanced distribution systems.',
        'sector_url'         => home_url( '/logistics' ),
    ],
    [
        'sector_image'       => $img . 'sectors-automotive.png',
        'sector_logo'        => $img . 'leading-star-logo.svg',
        'sector_title'       => 'Automotive',
        'sector_company'     => 'Leading Star Automotive Company',
        'sector_description' => 'As the authorized distributor for Mercedes Benz commercial vehicles in the Kurdistan Region, we offer world class sales, service, and after sales support through Leading Star Automotive.',
        'sector_url'         => home_url( '/automotive' ),
    ],
    [
        'sector_image'       => $img . 'banner-2.jpg',
        'sector_logo'        => $img . 'agos-logo.jpg',
        'sector_title'       => 'Oil &amp; Gas',
        'sector_company'     => 'Al-Gharraf Oil Services (AGOS)',
        'sector_description' => 'Through Al Gharraf Oil Services (AGOS), we provide integrated camp services, manpower, logistics, and operational support to international oil companies across Iraq\'s upstream sector.',
        'sector_url'         => home_url( '/oil-gas' ),
    ],
];

// ── Trusted by Global Leaders ────────────────────────────────────────────────
$clients_title = numerus_get_field( 'clients_title' ) ?: 'Trusted by Global Leaders';
$clients_raw   = numerus_get_field( 'clients' );
$clients = $clients_raw ?: [
    [ 'client_logo' => $img . 'bakerhughes-logo.png',  'client_name' => 'Baker Hughes' ],
    [ 'client_logo' => $img . 'petrofac-logo.png',     'client_name' => 'Petrofac' ],
    [ 'client_logo' => $img . 'fedex-logo.png',        'client_name' => 'FedEx' ],
    [ 'client_logo' => $img . 'tnt-logo.png',          'client_name' => 'TNT' ],
    [ 'client_logo' => $img . 'mercedesbenz-logo.svg', 'client_name' => 'Mercedes-Benz' ],
    [ 'client_logo' => $img . 'zain-logo.svg',         'client_name' => 'Zain' ],
    [ 'client_logo' => $img . 'fonterra-logo.png',     'client_name' => 'Fonterra' ],
    [ 'client_logo' => $img . 'wartsila-logo.png',     'client_name' => 'Wärtsilä' ],
    [ 'client_logo' => $img . 'parsons-logo.png',      'client_name' => 'Parsons' ],
    [ 'client_logo' => $img . 'marathonoil-logo.svg',  'client_name' => 'Marathon Oil' ],
    [ 'client_logo' => $img . 'raytheon-logo.svg',     'client_name' => 'Raytheon' ],
];

// ── Our Footprint ─────────────────────────────────────────────────────────────
$fp_text_1       = numerus_get_field( 'footprint_text_1' )       ?: 'Operations across all major Iraqi governorates, supported by offices in Baghdad, Basra, Erbil, and Dubai.';
$fp_text_2       = numerus_get_field( 'footprint_text_2' )       ?: 'A workforce of 250+ trained professionals across engineering, logistics, operations, and management.';
$fp_years_number = numerus_get_field( 'footprint_years_number' ) ?: '20+';
$fp_years_label  = numerus_get_field( 'footprint_years_label' )  ?: 'Years of Excellence';
$fp_jobs_number  = numerus_get_field( 'footprint_jobs_number' )  ?: '250+';
$fp_jobs_label   = numerus_get_field( 'footprint_jobs_label' )   ?: 'Trained Professionals';

// ── Legacy CTA ────────────────────────────────────────────────────────────────
$cta_subtitle_1 = numerus_get_field( 'cta_subtitle_1' ) ?: 'Over five decades, Numerus Group has built a diversified portfolio spanning telecom distribution, FMCG, power &amp; energy, and F&amp;B franchises.';
$cta_subtitle_2 = numerus_get_field( 'cta_subtitle_2' ) ?: 'While these sectors are no longer active or may otherwise been divested from the group, they form the foundation of our reputation for reliability, scale, and operational excellence.';

$arrow_svg = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>
<main class="main">

    <!-- Hero Section -->
    <section class="hero">
        <div class="background-images" id="backgroundImages">
            <?php foreach ( $hero_slides as $i => $slide ) :
                $pos = ! empty( $slide['slide_position'] ) ? esc_attr( $slide['slide_position'] ) : 'center';
            ?>
                <div class="background-image<?php echo $i === 0 ? ' active' : ''; ?>"
                     style="background-image: url('<?php echo esc_url( $slide['slide_image'] ); ?>'); background-position: <?php echo $pos; ?>"></div>
            <?php endforeach; ?>
        </div>
        <div class="hero-overlay"></div>
        <div class="container hero-container">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo wp_kses( $hero_title, [ 'span' => [ 'class' => [] ] ] ); ?></h1>
                <div class="hero-cta">
                    <a href="<?php echo esc_url( $hero_button_url ); ?>" class="btn hero-button">
                        <?php echo esc_html( $hero_button_text ); ?>
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

    <!-- About Us -->
    <section class="section about-section">
        <div class="container">
            <div class="about-content">
                <h2 class="about-title">About</h2>
                <p class="about-text"><?php echo esc_html( $about_text ); ?></p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">Contact Us</a>
            </div>
        </div>
    </section>

    <!-- Our Sectors Slider -->
    <section class="sectors-slider" id="sectorsSlider">

        <?php foreach ( $sectors as $i => $sector ) :
            $s_url   = esc_url( $sector['sector_url'] );
            $s_img   = esc_url( $sector['sector_image'] );
            $s_logo  = esc_url( $sector['sector_logo'] );
            $s_title = $sector['sector_title'];
            $s_co    = $sector['sector_company'];
            $s_desc  = $sector['sector_description'];
        ?>
            <div class="sector-slide<?php echo $i === 0 ? ' active' : ''; ?>"
                 style="background-image: url('<?php echo $s_img; ?>')">
                <div class="sector-slide__overlay"></div>
                <div class="container sector-slide__body">
                    <p class="sectors-eyebrow">Our Sectors</p>
                    <div class="sector-slide__content">
                        <div class="sector-slide__logo">
                            <img src="<?php echo $s_logo; ?>" alt="<?php echo esc_attr( $s_title ); ?>">
                        </div>
                        <div class="sector-slide__text">
                            <h3 class="sector-slide__title"><?php echo wp_kses_post( $s_title ); ?></h3>
                            <p class="sector-slide__company"><?php echo esc_html( $s_co ); ?></p>
                            <p class="sector-slide__description"><?php echo esc_html( $s_desc ); ?></p>
                            <a href="<?php echo $s_url; ?>" class="sector-slide__link">
                                Learn more <?php echo $arrow_svg; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Dots + progress bar -->
        <div class="sectors-slider__nav">
            <?php foreach ( $sectors as $i => $sector ) : ?>
                <button class="sectors-slider__dot<?php echo $i === 0 ? ' active' : ''; ?>"
                        data-index="<?php echo $i; ?>"
                        aria-label="<?php echo esc_attr( $sector['sector_title'] ); ?>">
                    <span class="sectors-slider__dot-fill"></span>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Prev / Next arrows -->
        <button class="sectors-slider__arrow sectors-slider__arrow--prev" id="sectorsPrev" aria-label="Previous sector">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <button class="sectors-slider__arrow sectors-slider__arrow--next" id="sectorsNext" aria-label="Next sector">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </button>

    </section>

    <!-- Trusted by Global Leaders -->
    <section class="section clientele-section">
        <div class="container">
            <div class="clientele-content">
                <h2 class="clientele-title"><?php echo esc_html( $clients_title ); ?></h2>
            </div>
        </div>
        <div class="slider-wrapper">
            <div class="slider-gradient-left"></div>
            <div class="slider-gradient-right"></div>
            <div class="client-slider">
                <div class="slider-track">
                    <?php
                    // Output twice for infinite marquee
                    for ( $r = 0; $r < 2; $r++ ) {
                        foreach ( $clients as $client ) {
                            $logo = esc_url( $client['client_logo'] );
                            $name = esc_attr( $client['client_name'] );
                            echo '<div class="client-logo"><img src="' . $logo . '" alt="' . $name . '"></div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Footprint -->
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
                        <div class="metric">
                            <span class="metric-number" id="yearsMetric"><?php echo esc_html( $fp_years_number ); ?></span>
                            <span class="metric-label"><?php echo esc_html( $fp_years_label ); ?></span>
                        </div>
                        <div class="metric">
                            <span class="metric-number" id="jobsMetric"><?php echo esc_html( $fp_jobs_number ); ?></span>
                            <span class="metric-label"><?php echo esc_html( $fp_jobs_label ); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Legacy CTA -->
    <section class="cta-banner">
        <div class="cta-background"></div>
        <div class="container">
            <div class="cta-content">
                <p class="cta-subtitle"><strong><?php echo esc_html( $cta_subtitle_1 ); ?></strong></p>
                <p class="cta-subtitle"><?php echo esc_html( $cta_subtitle_2 ); ?></p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn cta-button">
                    Partner With Us
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

</main>
<?php get_footer(); ?>
