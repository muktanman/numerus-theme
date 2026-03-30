<?php
/**
 * Template Name: Subsidiaries
 * Slug: subsidiaries
 */
get_header();
numerus_header( 'subsidiaries' );
$img = get_template_directory_uri() . '/assets/images/';
?>
<main class="main">
<div class="subsidiaries-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title">Subsidiaries</h1>
                <p class="page-header-subtitle">Our operating companies across active and legacy sectors</p>
            </div>
        </div>
    </section>

    <!-- Active Subsidiaries -->
    <section class="partners-section">
        <div class="container">
            <h2 class="section-title">ACTIVE SUBSIDIARIES</h2>
            <div class="companies-grid">
                <a href="<?php echo esc_url( home_url( '/logistics' ) ); ?>" class="company-card">
                    <div class="company-logo-wrapper"><img src="<?php echo esc_url( $img . 'estilam-logo.png' ); ?>" alt="Al-Estilam Express Cargo" class="company-logo-img"></div>
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
                    <div class="company-logo-wrapper"><img src="<?php echo esc_url( $img . 'agos-logo.jpg' ); ?>" alt="Al Gharraf Oil Services" class="company-logo-img"></div>
                    <p class="company-sector">Oil &amp; Gas</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Legacy Subsidiaries -->
    <section class="infra-section">
        <div class="container">
            <h2 class="section-title section-title--mb-lg">LEGACY SUBSIDIARIES</h2>
            <div class="legacy-subs-grid">
                <div class="legacy-sub-item"><strong>Al Awsat FMCG</strong></div>
                <div class="legacy-sub-item"><strong>Triangle Numerus Iraq</strong><span>Telecom</span></div>
                <div class="legacy-sub-item"><strong>HMS F&amp;B</strong></div>
                <div class="legacy-sub-item"><strong>Power &amp; Energy JV</strong></div>
                <div class="legacy-sub-item"><strong>Iraqi Transportation Network (ITN)</strong><span>Cross border trucking</span></div>
            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
