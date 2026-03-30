<?php
/**
 * Template Name: Sectors
 * Slug: sectors
 */
get_header();
numerus_header( 'sectors' );
$img = get_template_directory_uri() . '/assets/images/';
?>
<main class="main">
<div class="sectors-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title">Our Sectors</h1>
                <p class="page-header-subtitle">Explore our diverse portfolio of sectors where we enable world-class operations</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
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
                    <div class="company-logo-wrapper"><img src="<?php echo esc_url( $img . 'agos-logo.jpg' ); ?>" alt="AGOS" class="company-logo-img"></div>
                    <p class="company-sector">Oil &amp; Gas</p>
                </a>
                <a href="<?php echo esc_url( home_url( '/legacy' ) ); ?>" class="company-card">
                    <div class="company-logo-wrapper" style="justify-content:center;align-items:center;">
                        <span style="font-size:2rem;opacity:.4;">&#9632;</span>
                    </div>
                    <p class="company-sector">Legacy Businesses</p>
                </a>
            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
