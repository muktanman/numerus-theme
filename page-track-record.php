<?php
/**
 * Template Name: Track Record
 * Slug: track-record
 */
get_header();
numerus_header( 'track-record' );
?>
<main class="main">
<div class="services-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title">Track Record</h1>
                <p class="page-header-subtitle">Five decades of high-impact projects across Iraq's most critical sectors</p>
            </div>
        </div>
    </section>

    <!-- Major Projects -->
    <section class="projects-section projects-section--white">
        <div class="container">
            <h2 class="section-title">MAJOR PROJECTS</h2>
            <p class="section-subtitle light-dark">A curated selection of high impact projects delivered over the past five decades</p>
            <div class="projects-table projects-no-dates">
                <?php
                $projects = [
                    [ 'Baker Hughes',   'Camp life support, manpower, fuel supply' ],
                    [ 'Petrofac',       'Rumailah base camp O&M' ],
                    [ 'FedEx',          'Nationwide logistics network' ],
                    [ 'Wärtsilä',       '600 MW power generation projects' ],
                    [ 'Zain',           'National telecom distribution' ],
                    [ 'KHD Wedag',      'Samawa cement plant' ],
                    [ 'Mendes Junior',  'Railroad and expressway construction' ],
                    [ 'Volkswagen',     'Automotive distribution and assembly initiatives' ],
                ];
                foreach ( $projects as $p ) {
                    echo '<div class="project-row"><div class="project-company">' . esc_html( $p[0] ) . '</div><div class="project-desc">' . esc_html( $p[1] ) . '</div></div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Performance Highlights (Blue) -->
    <section class="services-section services-section--flex-center">
        <div class="container">
            <h2 class="section-title light section-title--center">PERFORMANCE HIGHLIGHTS</h2>
            <div class="why-numerus-grid why-numerus-grid--top-space">
                <div class="why-numerus-card"><h3 class="why-numerus-title">600+ MW</h3><p class="why-numerus-text">of power installed</p></div>
                <div class="why-numerus-card"><h3 class="why-numerus-title">200,000+</h3><p class="why-numerus-text">logistics missions</p></div>
                <div class="why-numerus-card"><h3 class="why-numerus-title">6,000+</h3><p class="why-numerus-text">FMCG retail points historically served</p></div>
                <div class="why-numerus-card"><h3 class="why-numerus-title">500+</h3><p class="why-numerus-text">telecom POS</p></div>
                <div class="why-numerus-card"><h3 class="why-numerus-title">250+</h3><p class="why-numerus-text">employees across the group</p></div>
            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
