<?php
/**
 * Template Name: Service Detail
 * Slug: service-detail
 */
get_header();
numerus_header( '' );
?>
<main class="main">
<div class="oil-gas-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title"><?php the_title(); ?></h1>
            </div>
        </div>
    </section>

    <!-- Back Button -->
    <section class="back-section">
        <div class="container">
            <a href="<?php echo esc_url( home_url( '/oil-gas' ) ); ?>" class="service-back-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to Oil &amp; Gas
            </a>
        </div>
    </section>

    <!-- Service Overview -->
    <section class="intro-section intro-section--padded">
        <div class="container">
            <div class="intro-content intro-content--left">
                <h2 class="section-title">SERVICE OVERVIEW</h2>
                <div class="intro-text">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
