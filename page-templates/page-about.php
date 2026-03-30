<?php
/**
 * Template Name: About
 * Slug: about
 */
get_header();
numerus_header( 'about' );
$img = get_template_directory_uri() . '/assets/images/';

// ── Field defaults ────────────────────────────────────────────────────────────
$header_title    = numerus_get_field( 'page_header_title' )    ?: 'About Numerus';
$header_subtitle = numerus_get_field( 'page_header_subtitle' ) ?: 'A legacy of excellence spanning generations';
$who_we_are_text = numerus_get_field( 'who_we_are_text' )      ?: 'Numerus Group is a multi sector business group with deep roots in Iraq\'s economic development. Since the 1970s, we have partnered with leading global companies to deliver complex projects in logistics, energy, infrastructure, and consumer markets. Today, our focus is on three high impact sectors where we maintain strong operational capabilities and long standing client relationships.';
$mission_text    = numerus_get_field( 'mission_text' )         ?: 'To build and operate sustainable, high performance businesses that create long term value for our partners, employees, and the Iraqi economy.';
$vision_text     = numerus_get_field( 'vision_text' )          ?: 'We strive to be leaders in best-practice operations, innovation and performance excellence, and long-term value creation for all stakeholders.';
$cta_title       = numerus_get_field( 'cta_title' )       ?: 'Ready to Enter the Iraqi Market?';
$cta_subtitle    = numerus_get_field( 'cta_subtitle' )    ?: 'Let\'s discuss how we can help you succeed';
$cta_button_text = numerus_get_field( 'cta_button_text' ) ?: 'Get Started';
$cta_button_url  = numerus_get_field( 'cta_button_url' )  ?: home_url( '/contact' );

$values_raw = numerus_get_field( 'values' );
$values = $values_raw ?: [
    [ 'value_number' => '01', 'value_name' => 'Excellence' ],
    [ 'value_number' => '02', 'value_name' => 'Integrity' ],
    [ 'value_number' => '03', 'value_name' => 'Ownership' ],
    [ 'value_number' => '04', 'value_name' => 'Teamwork' ],
    [ 'value_number' => '05', 'value_name' => 'Innovation' ],
    [ 'value_number' => '06', 'value_name' => 'Differentiation' ],
    [ 'value_number' => '07', 'value_name' => 'Perseverance' ],
    [ 'value_number' => '08', 'value_name' => 'Mutuality' ],
    [ 'value_number' => '09', 'value_name' => 'Pride' ],
    [ 'value_number' => '10', 'value_name' => 'Passion' ],
];

$timeline_raw = numerus_get_field( 'timeline' );
$timeline = $timeline_raw ?: [
    [ 'timeline_year' => '1970s–1990s', 'timeline_description' => 'Major industrial and infrastructure projects including cement plants, railroads, power stations, and large scale civil works.' ],
    [ 'timeline_year' => '2003–2007',   'timeline_description' => '600 MW of power generation projects delivered with Wärtsilä.' ],
    [ 'timeline_year' => '2003–Present','timeline_description' => 'Exclusive FedEx GSP in Iraq, building a nationwide logistics network.' ],
    [ 'timeline_year' => '2004–2021',   'timeline_description' => 'Telecom distribution for IraQna and later Zain Iraq.' ],
    [ 'timeline_year' => '2004–2025',   'timeline_description' => 'FMCG distribution leadership through Al Awsat.' ],
    [ 'timeline_year' => '2010–Present','timeline_description' => 'Oil & Gas services through AGOS.' ],
    [ 'timeline_year' => '2014–Present','timeline_description' => 'Mercedes Benz commercial vehicles dealership in Kurdistan.' ],
];
?>
<main class="main">
<div class="about-page">

    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title"><?php echo esc_html( $header_title ); ?></h1>
                <p class="page-header-subtitle"><?php echo esc_html( $header_subtitle ); ?></p>
            </div>
        </div>
    </section>

    <!-- Who We Are -->
    <section class="family-section">
        <div class="container">
            <div class="family-content">
                <h2 class="family-title">WHO WE ARE</h2>
                <p class="family-text"><?php echo esc_html( $who_we_are_text ); ?></p>
            </div>
            <div class="companies-grid">
                <a href="<?php echo esc_url( home_url( '/logistics' ) ); ?>" class="company-card">
                    <div class="company-logo-wrapper"><img src="<?php echo esc_url( $img . 'estilam-logo.png' ); ?>" alt="Al-Estilam" class="company-logo-img"></div>
                    <p class="company-sector">Logistics</p>
                </a>
                <a href="<?php echo esc_url( home_url( '/automotive' ) ); ?>" class="company-card">
                    <div class="company-logo-wrapper ls-lockup">
                        <img src="<?php echo esc_url( $img . 'leading-star-logo.svg' ); ?>" alt="Leading Star" class="ls-lockup-star">
                        <div class="ls-lockup-text"><span class="ls-lockup-name">Leading Star</span><span class="ls-lockup-sub">Automotive</span></div>
                    </div>
                    <p class="company-sector">Automotive</p>
                </a>
                <a href="<?php echo esc_url( home_url( '/oil-gas' ) ); ?>" class="company-card">
                    <div class="company-logo-wrapper"><img src="<?php echo esc_url( $img . 'agos-logo.jpg' ); ?>" alt="Al-Gharraf" class="company-logo-img"></div>
                    <p class="company-sector">Oil &amp; Gas</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mission-vision-section">
        <div class="mission-vision-parallax-bg"></div>
        <div class="container">
            <div class="mission-vision-grid">
                <div class="mission-content">
                    <h2 class="section-label">OUR MISSION</h2>
                    <p class="statement-text"><?php echo esc_html( $mission_text ); ?></p>
                </div>
                <div class="vision-mv-content">
                    <h2 class="section-label">OUR VISION</h2>
                    <p class="statement-text"><?php echo esc_html( $vision_text ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="culture-section">
        <div class="container">
            <div class="culture-header">
                <h2 class="culture-title">OUR VALUES</h2>
                <p class="culture-intro">These values guide every aspect of our operations—from frontline service delivery to strategic decision making.</p>
            </div>
            <div class="values-grid">
                <?php foreach ( $values as $v ) : ?>
                    <div class="value-card">
                        <div class="value-header">
                            <span class="value-number"><?php echo esc_html( $v['value_number'] ); ?></span>
                            <h3 class="value-card-title"><?php echo esc_html( $v['value_name'] ); ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- History Timeline -->
    <section class="timeline-section">
        <div class="container">
            <div class="timeline-header">
                <h2 class="timeline-title">OUR HISTORY</h2>
                <p class="timeline-subtitle">A legacy built over five decades.</p>
            </div>
            <div class="history-carousel">
                <div class="history-carousel-track">
                    <?php for ( $i = 1; $i <= 6; $i++ ) {
                        echo '<div class="history-carousel-image"><img src="' . esc_url( $img . 'history-' . $i . '.jpg' ) . '" alt="History"></div>';
                    }
                    for ( $i = 1; $i <= 6; $i++ ) {
                        echo '<div class="history-carousel-image"><img src="' . esc_url( $img . 'history-' . $i . '.jpg' ) . '" alt="History"></div>';
                    } ?>
                </div>
            </div>
            <div class="timeline-container">
                <div class="timeline-line"></div>
                <div class="timeline-events">
                    <?php foreach ( $timeline as $event ) : ?>
                        <div class="timeline-event">
                            <div class="timeline-year"><?php echo esc_html( $event['timeline_year'] ); ?></div>
                            <div class="timeline-event-content"><p><?php echo esc_html( $event['timeline_description'] ); ?></p></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Sectors Focus -->
    <section class="sectors-focus-section">
        <div class="container">
            <div class="sectors-focus-grid">
                <div class="sectors-focus-block">
                    <h2 class="section-label">Our Current Sectors</h2>
                    <p class="sectors-focus-text"><strong>Numerus Group today concentrates on three strategic sectors:</strong></p>
                    <div class="sectors-focus-items">
                        <div class="focus-item"><div class="focus-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M16.5 9.4l-9-5.19M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><path d="M3.27 6.96L12 12.01l8.73-5.05M12 22.08V12"/></svg></div><span>Logistics</span></div>
                        <div class="focus-item"><div class="focus-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><span>Oil &amp; Gas Services</span></div>
                        <div class="focus-item"><div class="focus-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div><span>Automotive Distribution</span></div>
                    </div>
                    <p class="sectors-focus-text">These sectors represent our strongest operational capabilities and our most active partnerships.</p>
                </div>
                <div class="sectors-focus-block">
                    <h2 class="section-label">Our Legacy Sectors</h2>
                    <p class="sectors-focus-text">While no longer active, our historical involvement in the following sectors strengthens our credibility and institutional knowledge:</p>
                    <div class="sectors-focus-items legacy">
                        <div class="focus-item"><div class="focus-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/></svg></div><span>FMCG Distribution</span></div>
                        <div class="focus-item"><div class="focus-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg></div><span>Telecom Distribution</span></div>
                        <div class="focus-item"><div class="focus-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><span>Power &amp; Energy</span></div>
                        <div class="focus-item"><div class="focus-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8zM6 1v3M10 1v3M14 1v3"/></svg></div><span>F&amp;B Franchises</span></div>
                        <div class="focus-item"><div class="focus-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 22V4a2 2 0 012-2h8a2 2 0 012 2v18zM6 12H4a2 2 0 00-2 2v6a2 2 0 002 2h2M18 9h2a2 2 0 012 2v9a2 2 0 01-2 2h-2"/></svg></div><span>Industrial &amp; Infrastructure</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="page-cta-section">
        <div class="page-cta-background">
            <div class="page-cta-overlay"></div>
            <div class="container">
                <div class="page-cta-content">
                    <h2 class="page-cta-title"><?php echo esc_html( $cta_title ); ?></h2>
                    <p class="page-cta-subtitle"><?php echo esc_html( $cta_subtitle ); ?></p>
                    <a href="<?php echo esc_url( $cta_button_url ); ?>" class="page-cta-button"><?php echo esc_html( $cta_button_text ); ?> <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                </div>
            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
