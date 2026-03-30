<?php
/**
 * Template Name: Legacy Businesses
 * Slug: legacy
 */
get_header();
numerus_header( 'sectors' );
$img = get_template_directory_uri() . '/assets/images/';
?>
<main class="main">
<div class="legacy-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title">Legacy Businesses</h1>
                <p class="page-header-subtitle">Decades of diversified operations that shaped our reputation and capabilities</p>
            </div>
        </div>
    </section>

    <!-- Overview -->
    <section class="intro-section">
        <div class="container">
            <div class="intro-content">
                <h2 class="section-title">OVERVIEW</h2>
                <p class="intro-text">Numerus Group's legacy sectors reflect decades of diversified operations that shaped our reputation and capabilities. While these sectors are no longer active, they demonstrate the breadth of our historical experience.</p>
            </div>
        </div>
    </section>

    <!-- Legacy Sectors (Dark with bg image) -->
    <section class="services-section section-with-bg-image">
        <div class="section-bg-overlay section-bg-overlay--dim" style="background-image: url('<?php echo esc_url( $img . 'banner-0.jpg' ); ?>')"></div>
        <div class="container section-content-layer">
            <h3 class="section-title light">LEGACY SECTORS</h3>
            <div class="capability-cards legacy-cards">
                <?php
                $legacy = [
                    [ 'FMCG Distribution', 'Nationwide cold chain distribution for global brands including Fonterra Anchor.', 'M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6' ],
                    [ 'Telecom Distribution', 'Master distributor for IraQna and later Zain Iraq with 500+ POS.', 'M5 2h14a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zM12 18h.01' ],
                    [ 'Power & Energy', '600 MW of power projects delivered with Wartsila; smart metering initiatives.', 'M13 2L3 14h9l-1 8 10-12h-9l1-8z' ],
                    [ 'Trucking & Transportation', 'The Iraqi Transportation Network (ITN) with 1,600 drivers and 1,200 trucks.', 'M1 3h15v13H1zM16 8h4l3 3v5h-7V8zM5.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM18.5 16a2.5 2.5 0 100 5 2.5 2.5 0 000-5z' ],
                    [ 'F&B Franchises', 'Master franchisee for Second Cup and Steak Escape.', 'M18 8h1a4 4 0 0 1 0 8h-1M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8zM6 1v3M10 1v3M14 1v3' ],
                    [ 'Industrial Projects', 'Cement plants, railroads, power stations, and large scale civil works.', 'M2 6h20v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6zM12 12h.01M17 12h.01M7 12h.01' ],
                ];
                foreach ( $legacy as $item ) {
                    echo '<div class="capability-card"><span class="capability-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="' . esc_attr( $item[2] ) . '"/></svg></span><p><strong>' . esc_html( $item[0] ) . '</strong></p><p class="capability-desc">' . esc_html( $item[1] ) . '</p></div>';
                }
                ?>
            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
