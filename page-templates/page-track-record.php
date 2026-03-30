<?php
/**
 * Template Name: Track Record
 * Slug: track-record
 */
get_header();
numerus_header( 'track-record' );

// ── Field defaults ────────────────────────────────────────────────────────────
$header_title    = numerus_get_field( 'page_header_title' )    ?: 'Track Record';
$header_subtitle = numerus_get_field( 'page_header_subtitle' ) ?: 'Five decades of high-impact projects across Iraq\'s most critical sectors';

$projects_raw = numerus_get_field( 'projects' );
$projects = $projects_raw ?: [
    [ 'project_company' => 'Baker Hughes',   'project_description' => 'Camp life support, manpower, fuel supply' ],
    [ 'project_company' => 'Petrofac',       'project_description' => 'Rumailah base camp O&M' ],
    [ 'project_company' => 'FedEx',          'project_description' => 'Nationwide logistics network' ],
    [ 'project_company' => 'Wärtsilä',       'project_description' => '600 MW power generation projects' ],
    [ 'project_company' => 'Zain',           'project_description' => 'National telecom distribution' ],
    [ 'project_company' => 'KHD Wedag',      'project_description' => 'Samawa cement plant' ],
    [ 'project_company' => 'Mendes Junior',  'project_description' => 'Railroad and expressway construction' ],
    [ 'project_company' => 'Volkswagen',     'project_description' => 'Automotive distribution and assembly initiatives' ],
];

$highlights_raw = numerus_get_field( 'highlights' );
$highlights = $highlights_raw ?: [
    [ 'highlight_stat' => '600+ MW',   'highlight_label' => 'of power installed' ],
    [ 'highlight_stat' => '200,000+',  'highlight_label' => 'logistics missions' ],
    [ 'highlight_stat' => '6,000+',    'highlight_label' => 'FMCG retail points historically served' ],
    [ 'highlight_stat' => '500+',      'highlight_label' => 'telecom POS' ],
    [ 'highlight_stat' => '250+',      'highlight_label' => 'employees across the group' ],
];
?>
<main class="main">
<div class="services-page">

    <section class="page-header">
        <div class="page-header-overlay">
            <div class="container">
                <h1 class="page-header-title"><?php echo esc_html( $header_title ); ?></h1>
                <p class="page-header-subtitle"><?php echo esc_html( $header_subtitle ); ?></p>
            </div>
        </div>
    </section>

    <!-- Major Projects -->
    <section class="projects-section projects-section--white">
        <div class="container">
            <h2 class="section-title">MAJOR PROJECTS</h2>
            <p class="section-subtitle light-dark">A curated selection of high impact projects delivered over the past five decades</p>
            <div class="projects-table projects-no-dates">
                <?php foreach ( $projects as $p ) : ?>
                    <div class="project-row">
                        <div class="project-company"><?php echo esc_html( $p['project_company'] ); ?></div>
                        <div class="project-desc"><?php echo esc_html( $p['project_description'] ); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Performance Highlights (Blue) -->
    <section class="services-section services-section--flex-center">
        <div class="container">
            <h2 class="section-title light section-title--center">PERFORMANCE HIGHLIGHTS</h2>
            <div class="why-numerus-grid why-numerus-grid--top-space">
                <?php foreach ( $highlights as $h ) : ?>
                    <div class="why-numerus-card">
                        <h3 class="why-numerus-title"><?php echo esc_html( $h['highlight_stat'] ); ?></h3>
                        <p class="why-numerus-text"><?php echo esc_html( $h['highlight_label'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</div>
</main>
<?php get_footer(); ?>
