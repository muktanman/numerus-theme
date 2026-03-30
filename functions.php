<?php
/**
 * Numerus Group Theme Functions
 */

/**
 * Safe wrapper around SCF/ACF get_field().
 * Returns false (triggers fallback) when SCF is not active.
 */
if ( ! function_exists( 'numerus_get_field' ) ) {
    function numerus_get_field( $selector, $post_id = false ) {
        if ( function_exists( 'get_field' ) ) {
            return get_field( $selector, $post_id );
        }
        return false;
    }
}

// Allow SVG uploads in the media library.
add_filter( 'upload_mimes', function ( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
} );
add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes ) {
    if ( ! $data['type'] ) {
        $ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
        if ( $ext === 'svg' ) {
            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }
    }
    return $data;
}, 10, 4 );

// SCF (Secure Custom Fields) field group definitions.
// Hook on acf/include_fields which fires during SCF's own init sequence.
add_action( 'acf/include_fields', function () {
    require_once get_template_directory() . '/inc/scf-fields.php';
} );

// One-time content migration: populates all fields from hardcoded defaults.
require_once get_template_directory() . '/inc/migration.php';

// Auto-expand the Gutenberg Meta Boxes panel so SCF fields are visible on page load.
add_action( 'admin_footer-post.php', function () {
    $screen = get_current_screen();
    if ( ! $screen || $screen->post_type !== 'page' ) return;
    ?>
    <script>
    (function () {
        function expandMetaBoxes() {
            var inner = document.querySelector('.edit-post-layout__metaboxes');
            if (inner) {
                inner.removeAttribute('hidden');
                var panel = document.querySelector('.edit-post-meta-boxes-main');
                if (panel && panel.offsetHeight < 200) {
                    panel.style.height = '500px';
                }
                return true;
            }
            return false;
        }
        // Retry until Gutenberg has rendered
        var tries = 0;
        var interval = setInterval(function () {
            if (expandMetaBoxes() || ++tries > 30) clearInterval(interval);
        }, 300);
    })();
    </script>
    <?php
} );

// -------------------------------------------------------------------------
// Theme Setup
// -------------------------------------------------------------------------
function numerus_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'numerus' ),
        'footer'  => __( 'Footer Navigation', 'numerus' ),
    ] );
}
add_action( 'after_setup_theme', 'numerus_setup' );

// -------------------------------------------------------------------------
// Enqueue Scripts & Styles
// -------------------------------------------------------------------------
function numerus_enqueue_assets() {
    $uri = get_template_directory_uri();
    $ver = '1.0.0';

    // Google Fonts
    wp_enqueue_style(
        'numerus-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style( 'numerus-styles', $uri . '/assets/css/styles.css', [ 'numerus-fonts' ], $ver );

    // Main JS (navigation, mobile menu, dropdowns) — defer
    wp_enqueue_script( 'numerus-main', $uri . '/assets/js/main.js', [], $ver, true );

    // Page-specific scripts
    if ( is_front_page() ) {
        wp_enqueue_script( 'numerus-home', $uri . '/assets/js/home.js', [ 'numerus-main' ], $ver, true );
    }

    if ( is_page( 'about' ) ) {
        wp_enqueue_script( 'numerus-about', $uri . '/assets/js/about.js', [ 'numerus-main' ], $ver, true );
    }

    if ( is_page( 'track-record' ) ) {
        wp_enqueue_script( 'numerus-track-record', $uri . '/assets/js/track-record.js', [ 'numerus-main' ], $ver, true );
    }

    if ( is_page( 'oil-gas' ) ) {
        wp_enqueue_script( 'numerus-oil-gas', $uri . '/assets/js/oil-gas.js', [ 'numerus-main' ], $ver, true );
    }

    if ( is_page( 'contact' ) ) {
        wp_enqueue_script( 'numerus-contact', $uri . '/assets/js/contact.js', [ 'numerus-main' ], $ver, true );
        wp_localize_script( 'numerus-contact', 'numerusAjax', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'numerus_contact_nonce' ),
        ] );
    }
}
add_action( 'wp_enqueue_scripts', 'numerus_enqueue_assets' );

// -------------------------------------------------------------------------
// SEO: Open Graph + Twitter Cards + Meta Description
// -------------------------------------------------------------------------
function numerus_seo_meta() {
    global $post;

    $site_name    = get_bloginfo( 'name' );
    $site_url     = home_url( '/' );
    $logo_url     = get_template_directory_uri() . '/assets/images/logo.png';
    $default_img  = get_template_directory_uri() . '/assets/images/banner-0.jpg';

    // Per-page SEO data
    $seo = numerus_get_page_seo();

    $title       = isset( $seo['title'] )       ? $seo['title']       : get_the_title();
    $description = isset( $seo['description'] ) ? $seo['description'] : '';
    $og_image    = isset( $seo['og_image'] )    ? $seo['og_image']    : $default_img;
    $canonical   = isset( $seo['canonical'] )   ? $seo['canonical']   : get_permalink();
    $og_type     = isset( $seo['og_type'] )     ? $seo['og_type']     : 'website';

    if ( $description ) {
        echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
    }
    echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";

    // Open Graph
    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
    if ( $description ) {
        echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
    }
    echo '<meta property="og:url" content="' . esc_url( $canonical ) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";

    // Twitter Cards
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
    if ( $description ) {
        echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
    }
    echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";

    // Organization Schema
    if ( is_front_page() ) {
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Organization',
            'name'        => 'Numerus Group',
            'url'         => $site_url,
            'logo'        => $logo_url,
            'description' => 'A diversified Iraqi conglomerate operating across Logistics, Oil & Gas Services, and Automotive Distribution.',
            'address'     => [
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Baghdad',
                'addressCountry'  => 'IQ',
            ],
            'contactPoint' => [
                '@type'       => 'ContactPoint',
                'email'       => 'info@numerusgroup.com',
                'contactType' => 'customer service',
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'numerus_seo_meta' );

/**
 * Returns SEO data for each page.
 */
function numerus_get_page_seo() {
    $img_base = get_template_directory_uri() . '/assets/images/';

    if ( is_front_page() ) {
        return [
            'title'       => 'Numerus Group — A Trusted Partner Driving Sustainable Growth in Iraq',
            'description' => 'Numerus Group is a diversified Iraqi conglomerate operating across Logistics, Oil & Gas Services, and Automotive Distribution with over 50 years of experience.',
            'og_image'    => $img_base . 'banner-0.jpg',
            'canonical'   => home_url( '/' ),
        ];
    }

    $slug = get_post_field( 'post_name', get_the_ID() );

    $map = [
        'about' => [
            'title'       => 'About Numerus Group — 50 Years of Business Excellence in Iraq',
            'description' => 'Learn about Numerus Group\'s mission, values, history, and leadership across Logistics, Oil & Gas, and Automotive sectors in Iraq.',
            'og_image'    => $img_base . 'vision-image.jpg',
        ],
        'contact' => [
            'title'       => 'Contact Numerus Group — Baghdad, Basra, Erbil, Dubai',
            'description' => 'Get in touch with Numerus Group. Offices in Baghdad, Basra, Erbil, and Dubai. Email: info@numerusgroup.com',
            'og_image'    => $img_base . 'footer.jpg',
        ],
        'logistics' => [
            'title'       => 'Logistics — Al-Estilam Express Cargo | Numerus Group',
            'description' => 'Al-Estilam Express Cargo operates Iraq\'s most reliable logistics network as the exclusive FedEx and TNT General Services Provider.',
            'og_image'    => $img_base . 'logistics.jpg',
        ],
        'automotive' => [
            'title'       => 'Automotive — Leading Star Mercedes-Benz | Numerus Group',
            'description' => 'Leading Star Automotive is the authorized distributor for Mercedes-Benz commercial vehicles in the Kurdistan Region of Iraq.',
            'og_image'    => $img_base . 'automotive.avif',
        ],
        'oil-gas' => [
            'title'       => 'Oil & Gas — Al-Gharraf Oil Services (AGOS) | Numerus Group',
            'description' => 'AGOS delivers integrated camp services, manpower, logistics, and operational support to international oil companies across Iraq.',
            'og_image'    => $img_base . 'oil-gas-main.jpg',
        ],
        'water-treatment' => [
            'title'       => 'Water Treatment — AGOS Services | Numerus Group',
            'description' => 'AGOS provides water treatment and desalination plant operations and maintenance across Iraq\'s upstream sector.',
            'og_image'    => $img_base . 'oil-gas-main.jpg',
        ],
        'legacy' => [
            'title'       => 'Legacy Businesses — Numerus Group Historical Sectors',
            'description' => 'Explore Numerus Group\'s legacy sectors: FMCG, Telecom, Power & Energy, Transportation, and F&B that shaped our capabilities.',
            'og_image'    => $img_base . 'history-1.jpg',
        ],
        'subsidiaries' => [
            'title'       => 'Subsidiaries — Numerus Group Operating Companies',
            'description' => 'Numerus Group\'s active and legacy subsidiaries spanning Logistics, Automotive, Oil & Gas, Telecom, FMCG, and more.',
            'og_image'    => $img_base . 'vision.jpg',
        ],
        'track-record' => [
            'title'       => 'Track Record — Five Decades of Projects | Numerus Group',
            'description' => 'Numerus Group\'s track record spans 600+ MW of power, 200,000+ logistics missions, and major projects with Baker Hughes, FedEx, Wärtsilä, and more.',
            'og_image'    => $img_base . 'banner-2.jpg',
        ],
        'sectors' => [
            'title'       => 'Our Sectors — Logistics, Oil & Gas, Automotive | Numerus Group',
            'description' => 'Numerus Group operates across Logistics, Oil & Gas Services, and Automotive Distribution in Iraq.',
            'og_image'    => $img_base . 'banner-0.jpg',
        ],
        'privacy' => [
            'title'       => 'Privacy Policy — Numerus Group',
            'description' => 'Numerus Group privacy policy.',
        ],
        'terms' => [
            'title'       => 'Terms & Conditions — Numerus Group',
            'description' => 'Numerus Group terms and conditions.',
        ],
    ];

    return isset( $map[ $slug ] ) ? $map[ $slug ] : [];
}

// -------------------------------------------------------------------------
// Contact Form AJAX Handler
// -------------------------------------------------------------------------
function numerus_handle_contact() {
    check_ajax_referer( 'numerus_contact_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name']    ?? '' );
    $email   = sanitize_email(      $_POST['email']   ?? '' );
    $company = sanitize_text_field( $_POST['company'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( ! $name || ! $email || ! $message ) {
        wp_send_json_error( [ 'message' => 'Please fill in all required fields.' ] );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => 'Please enter a valid email address.' ] );
    }

    $to      = get_option( 'admin_email' );
    $subject = "New Contact Form Submission — Numerus Group";
    $body    = "Name: {$name}\nEmail: {$email}\nCompany: {$company}\n\nMessage:\n{$message}";
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>",
    ];

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => "Thank you for your message! We'll get back to you soon." ] );
    } else {
        wp_send_json_error( [ 'message' => 'There was an error sending your message. Please try again.' ] );
    }
}
add_action( 'wp_ajax_numerus_contact',        'numerus_handle_contact' );
add_action( 'wp_ajax_nopriv_numerus_contact', 'numerus_handle_contact' );

// -------------------------------------------------------------------------
// Custom Nav Walker — renders the exact nav HTML structure
// -------------------------------------------------------------------------
function numerus_primary_nav( $active_page = '' ) {
    $pages = [
        [ 'slug' => '',             'label' => 'Home',        'url' => home_url( '/' ) ],
        [ 'slug' => 'about',        'label' => 'About',       'url' => home_url( '/about' ) ],
        [ 'slug' => '',             'label' => 'Sectors',     'dropdown' => true ],
        [ 'slug' => 'subsidiaries', 'label' => 'Subsidiaries','url' => home_url( '/subsidiaries' ) ],
        [ 'slug' => 'track-record', 'label' => 'Track Record','url' => home_url( '/track-record' ) ],
    ];

    $sectors_dropdown = [
        [ 'slug' => 'logistics',       'label' => 'Logistics',         'sub' => 'Al-Estilam Express Cargo Company' ],
        [ 'slug' => 'automotive',      'label' => 'Automotive',        'sub' => 'Leading Star Automotive Company' ],
        [ 'slug' => 'oil-gas',         'label' => 'Oil & Gas',         'sub' => 'Al-Gharraf Oil Services (AGOS)' ],
        [ 'slug' => 'legacy',          'label' => 'Legacy Businesses', 'sub' => 'Historical sectors and operations' ],
    ];

    // Desktop nav
    echo '<nav class="desktop-nav">';
    echo '<ul class="nav-list">';

    foreach ( $pages as $page ) {
        if ( ! empty( $page['dropdown'] ) ) {
            echo '<li class="nav-item">';
            echo '<div class="dropdown-wrapper">';
            echo '<button class="nav-link" id="sectorsBtn" aria-expanded="false" aria-haspopup="true">Sectors<svg class="chevron" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
            echo '<div class="dropdown" id="sectorsDropdown">';
            foreach ( $sectors_dropdown as $item ) {
                echo '<a href="' . esc_url( home_url( '/' . $item['slug'] ) ) . '" class="dropdown-item"><strong>' . esc_html( $item['label'] ) . '</strong><span class="dropdown-subtitle">' . esc_html( $item['sub'] ) . '</span></a>';
            }
            echo '</div></div></li>';
        } else {
            $is_active = ( $active_page === $page['slug'] ) ? ' active' : '';
            echo '<li class="nav-item"><a href="' . esc_url( $page['url'] ) . '" class="nav-link' . $is_active . '">' . esc_html( $page['label'] ) . '</a></li>';
        }
    }

    echo '</ul>';
    echo '<a href="' . esc_url( home_url( '/contact' ) ) . '" class="btn btn-primary">Contact Us<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>';
    echo '</nav>';

    // Mobile nav
    echo '<div class="mobile-menu" id="mobileMenu">';
    echo '<nav class="mobile-nav"><ul class="mobile-nav-list">';
    echo '<li class="mobile-nav-item"><a href="' . esc_url( home_url( '/' ) ) . '" class="mobile-nav-link' . ( $active_page === '' ? ' active' : '' ) . '">Home</a></li>';
    echo '<li class="mobile-nav-item"><a href="' . esc_url( home_url( '/about' ) ) . '" class="mobile-nav-link' . ( $active_page === 'about' ? ' active' : '' ) . '">About</a></li>';
    echo '<li class="mobile-nav-item">';
    echo '<button class="mobile-nav-link" id="mobileSectorsBtn">Sectors<svg class="chevron" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
    echo '<div class="mobile-dropdown" id="mobileSectorsDropdown">';
    foreach ( $sectors_dropdown as $item ) {
        echo '<a href="' . esc_url( home_url( '/' . $item['slug'] ) ) . '" class="mobile-dropdown-item"><strong>' . esc_html( $item['label'] ) . '</strong><span>' . esc_html( $item['sub'] ) . '</span></a>';
    }
    echo '</div></li>';
    echo '<li class="mobile-nav-item"><a href="' . esc_url( home_url( '/subsidiaries' ) ) . '" class="mobile-nav-link' . ( $active_page === 'subsidiaries' ? ' active' : '' ) . '">Subsidiaries</a></li>';
    echo '<li class="mobile-nav-item"><a href="' . esc_url( home_url( '/track-record' ) ) . '" class="mobile-nav-link' . ( $active_page === 'track-record' ? ' active' : '' ) . '">Track Record</a></li>';
    echo '<li class="mobile-nav-item"><a href="' . esc_url( home_url( '/contact' ) ) . '" class="mobile-nav-link contact-button' . ( $active_page === 'contact' ? ' active' : '' ) . '">Contact Us<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></li>';
    echo '</ul></nav></div>';
}

// -------------------------------------------------------------------------
// Shared Header HTML (called from header.php)
// -------------------------------------------------------------------------
function numerus_header( $active_page = '' ) {
    ?>
    <header class="header" id="header">
        <div class="container">
            <div class="header-content">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo-image">
                </a>
                <?php numerus_primary_nav( $active_page ); ?>
                <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle mobile menu" aria-expanded="false">
                    <span class="hamburger" id="hamburger">
                        <span></span><span></span><span></span>
                    </span>
                </button>
            </div>
        </div>
    </header>
    <?php
}

// -------------------------------------------------------------------------
// Shared Footer HTML
// -------------------------------------------------------------------------
function numerus_footer() {
    $img = get_template_directory_uri() . '/assets/images/logo.png';
    ?>
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-grid">
                    <div class="footer-column">
                        <div class="brand-block">
                            <img src="<?php echo esc_url( $img ); ?>" alt="Numerus Group" class="footer-logo">
                        </div>
                    </div>
                    <div class="footer-column">
                        <h4 class="column-title">Our Presence</h4>
                        <ul class="location-list">
                            <li><strong>Iraq:</strong> Baghdad, Basra, Erbil</li>
                            <li><strong>UAE:</strong> Dubai</li>
                        </ul>
                        <p class="footer-coverage">Operations across all major Iraqi governorates, supported by a workforce of 250+ professionals.</p>
                    </div>
                    <div class="footer-column">
                        <h4 class="column-title">Quick Links</h4>
                        <ul class="link-list">
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>">About</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/logistics' ) ); ?>">Sectors</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/subsidiaries' ) ); ?>">Subsidiaries</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/track-record' ) ); ?>">Track Record</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4 class="column-title">Connect</h4>
                        <a href="mailto:info@numerusgroup.com" class="email-link">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            info@numerusgroup.com
                        </a>
                        <div class="social-icons">
                            <a href="#" class="social-icon" aria-label="LinkedIn">in</a>
                            <a href="#" class="social-icon" aria-label="Facebook">f</a>
                            <a href="#" class="social-icon" aria-label="X / Twitter">x</a>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <p class="copyright">&copy; <?php echo date( 'Y' ); ?> Numerus Group. All rights reserved.</p>
                        <div class="legal-links">
                            <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Terms &amp; Conditions</a>
                            <span class="separator">|</span>
                            <a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php
}
