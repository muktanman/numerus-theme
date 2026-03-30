<?php
/**
 * Numerus Group — One-time content migration.
 *
 * Populates all SCF/ACF fields from the hardcoded defaults so editors
 * can manage everything through the WordPress admin.
 *
 * Runs once when any admin page loads. After first successful run the
 * option 'numerus_migration_v4_done' is set and the function exits
 * immediately on every subsequent call.
 *
 * To re-run: delete the option from the DB or call
 *   delete_option('numerus_migration_v4_done');
 */

// ── Helper: import a theme asset into the media library ───────────────────────
if ( ! function_exists( 'numerus_import_image' ) ) {
    function numerus_import_image( string $filename, string $title ): int {
        global $wpdb;

        // Return existing attachment if already imported in a previous run.
        $existing = (int) $wpdb->get_var( $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta}
             WHERE meta_key = '_numerus_src' AND meta_value = %s LIMIT 1",
            $filename
        ) );
        if ( $existing ) return $existing;

        $src = get_template_directory() . '/assets/images/' . $filename;
        if ( ! file_exists( $src ) ) return 0;

        $upload    = wp_upload_dir();
        $dest_path = trailingslashit( $upload['path'] ) . $filename;
        $dest_url  = trailingslashit( $upload['url'] )  . $filename;

        // Avoid overwriting an existing upload with the same name.
        if ( file_exists( $dest_path ) ) {
            $info      = pathinfo( $filename );
            $filename  = $info['filename'] . '-' . time() . '.' . $info['extension'];
            $dest_path = trailingslashit( $upload['path'] ) . $filename;
            $dest_url  = trailingslashit( $upload['url'] )  . $filename;
        }

        copy( $src, $dest_path );

        $filetype  = wp_check_filetype( $filename );
        $attach_id = wp_insert_attachment( [
            'guid'           => $dest_url,
            'post_mime_type' => $filetype['type'],
            'post_title'     => $title,
            'post_content'   => '',
            'post_status'    => 'inherit',
        ], $dest_path );

        if ( is_wp_error( $attach_id ) || ! $attach_id ) return 0;

        require_once ABSPATH . 'wp-admin/includes/image.php';
        wp_update_attachment_metadata( $attach_id, wp_generate_attachment_metadata( $attach_id, $dest_path ) );
        update_post_meta( $attach_id, '_numerus_src', basename( $src ) );

        return (int) $attach_id;
    }
}

// ── Main migration function ────────────────────────────────────────────────────
function numerus_run_migration(): void {
    if ( get_option( 'numerus_migration_v4_done' ) ) return;
    if ( ! function_exists( 'update_field' ) )        return;

    // ── HOME (page ID 5) ─────────────────────────────────────────────────────
    $home = 5;

    update_field( 'hero_title',       'Building Sustainable Businesses in Iraq for <span class="hero-title-break">Over 50 Years</span>', $home );
    update_field( 'hero_button_text', 'Partner With Us',       $home );
    update_field( 'hero_button_url',  home_url( '/contact' ),  $home );

    update_field( 'hero_slides', [
        [ 'slide_image' => numerus_import_image( 'banner-0.jpg', 'Hero Slide 1' ), 'slide_position' => 'center' ],
        [ 'slide_image' => numerus_import_image( 'banner-1.png', 'Hero Slide 2' ), 'slide_position' => 'center' ],
        [ 'slide_image' => numerus_import_image( 'banner-2.jpg', 'Hero Slide 3' ), 'slide_position' => 'center' ],
        [ 'slide_image' => numerus_import_image( 'banner-3.png', 'Hero Slide 4' ), 'slide_position' => 'bottom' ],
    ], $home );

    update_field( 'ticker_items', [
        [ 'ticker_text' => 'Service provider for FEDEX in Iraq since 2003' ],
        [ 'ticker_text' => 'Master distributor and nationwide retail network' ],
        [ 'ticker_text' => 'Authorized Mercedes Benz commercial vehicles distributor in Kurdistan' ],
        [ 'ticker_text' => 'Integrated camp services and O&M for international oil companies' ],
        [ 'ticker_text' => 'Over 50 years of project delivery in Iraq' ],
        [ 'ticker_text' => '250+ professionals across engineering, logistics, and operations' ],
    ], $home );

    update_field( 'about_text',        'Numerus Group is a diversified Iraqi conglomerate operating across Logistics, Oil & Gas Services, and Automotive Distribution. With a national footprint and regional offices in the UAE, we deliver reliable, high performance solutions to global partners and local industries.', $home );
    update_field( 'about_button_text', 'Contact Us',          $home );
    update_field( 'about_button_url',  home_url( '/contact' ), $home );

    update_field( 'sectors', [
        [
            'sector_image'       => numerus_import_image( 'fedex-spotlight.png',   'Logistics Background' ),
            'sector_logo'        => numerus_import_image( 'estilam-logo.png',       'Al-Estilam Logo' ),
            'sector_title'       => 'Logistics',
            'sector_company'     => 'Al-Estilam Express Cargo Company',
            'sector_description' => 'A nationwide express courier and cargo network, operating as the fully deployed General Services Provider for FedEx and TNT in Iraq, supported by secure hubs, cross border trucking, and advanced distribution systems.',
            'sector_url'         => home_url( '/logistics' ),
        ],
        [
            'sector_image'       => numerus_import_image( 'sectors-automotive.png', 'Automotive Background' ),
            'sector_logo'        => numerus_import_image( 'leading-star-logo.svg',  'Leading Star Logo' ),
            'sector_title'       => 'Automotive',
            'sector_company'     => 'Leading Star Automotive Company',
            'sector_description' => 'As the authorized distributor for Mercedes Benz commercial vehicles in the Kurdistan Region, we offer world class sales, service, and after sales support through Leading Star Automotive.',
            'sector_url'         => home_url( '/automotive' ),
        ],
        [
            'sector_image'       => numerus_import_image( 'banner-2.jpg',           'Oil Gas Background' ),
            'sector_logo'        => numerus_import_image( 'agos-logo.jpg',           'AGOS Logo' ),
            'sector_title'       => 'Oil & Gas',
            'sector_company'     => 'Al-Gharraf Oil Services (AGOS)',
            'sector_description' => 'Through Al Gharraf Oil Services (AGOS), we provide integrated camp services, manpower, logistics, and operational support to international oil companies across Iraq\'s upstream sector.',
            'sector_url'         => home_url( '/oil-gas' ),
        ],
    ], $home );

    update_field( 'clients_title', 'Trusted by Global Leaders', $home );
    update_field( 'clients', [
        [ 'client_logo' => numerus_import_image( 'bakerhughes-logo.png',  'Baker Hughes' ),   'client_name' => 'Baker Hughes' ],
        [ 'client_logo' => numerus_import_image( 'petrofac-logo.png',     'Petrofac' ),       'client_name' => 'Petrofac' ],
        [ 'client_logo' => numerus_import_image( 'fedex-logo.png',        'FedEx' ),          'client_name' => 'FedEx' ],
        [ 'client_logo' => numerus_import_image( 'tnt-logo.png',          'TNT' ),            'client_name' => 'TNT' ],
        [ 'client_logo' => numerus_import_image( 'mercedesbenz-logo.svg', 'Mercedes-Benz' ),  'client_name' => 'Mercedes-Benz' ],
        [ 'client_logo' => numerus_import_image( 'zain-logo.svg',         'Zain' ),           'client_name' => 'Zain' ],
        [ 'client_logo' => numerus_import_image( 'fonterra-logo.png',     'Fonterra' ),       'client_name' => 'Fonterra' ],
        [ 'client_logo' => numerus_import_image( 'wartsila-logo.png',     'Wärtsilä' ),       'client_name' => 'Wärtsilä' ],
        [ 'client_logo' => numerus_import_image( 'parsons-logo.png',      'Parsons' ),        'client_name' => 'Parsons' ],
        [ 'client_logo' => numerus_import_image( 'marathonoil-logo.svg',  'Marathon Oil' ),   'client_name' => 'Marathon Oil' ],
        [ 'client_logo' => numerus_import_image( 'raytheon-logo.svg',     'Raytheon' ),       'client_name' => 'Raytheon' ],
    ], $home );

    update_field( 'footprint_text_1',       'Operations across all major Iraqi governorates, supported by offices in Baghdad, Basra, Erbil, and Dubai.',   $home );
    update_field( 'footprint_text_2',       'A workforce of 250+ trained professionals across engineering, logistics, operations, and management.',         $home );
    update_field( 'footprint_years_number', '20+',                  $home );
    update_field( 'footprint_years_label',  'Years of Excellence',  $home );
    update_field( 'footprint_jobs_number',  '250+',                 $home );
    update_field( 'footprint_jobs_label',   'Trained Professionals',$home );

    update_field( 'cta_subtitle_1',  'Over five decades, Numerus Group has built a diversified portfolio spanning telecom distribution, FMCG, power & energy, and F&B franchises.', $home );
    update_field( 'cta_subtitle_2',  'While these sectors are no longer active or may otherwise been divested from the group, they form the foundation of our reputation for reliability, scale, and operational excellence.', $home );
    update_field( 'cta_button_text', 'Partner With Us',        $home );
    update_field( 'cta_button_url',  home_url( '/contact' ),   $home );

    // ── ABOUT (page ID 6) ────────────────────────────────────────────────────
    $about = 6;

    update_field( 'page_header_title',    'About Numerus',                          $about );
    update_field( 'page_header_subtitle', 'A legacy of excellence spanning generations', $about );
    update_field( 'who_we_are_text', 'Numerus Group is a multi sector business group with deep roots in Iraq\'s economic development. Since the 1970s, we have partnered with leading global companies to deliver complex projects in logistics, energy, infrastructure, and consumer markets. Today, our focus is on three high impact sectors where we maintain strong operational capabilities and long standing client relationships.', $about );
    update_field( 'mission_text',    'To build and operate sustainable, high performance businesses that create long term value for our partners, employees, and the Iraqi economy.', $about );
    update_field( 'vision_text',     'We strive to be leaders in best-practice operations, innovation and performance excellence, and long-term value creation for all stakeholders.', $about );
    update_field( 'cta_title',       'Ready to Enter the Iraqi Market?',           $about );
    update_field( 'cta_subtitle',    'Let\'s discuss how we can help you succeed', $about );
    update_field( 'cta_button_text', 'Get Started',          $about );
    update_field( 'cta_button_url',  home_url( '/contact' ), $about );

    update_field( 'values', [
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
    ], $about );

    update_field( 'timeline', [
        [ 'timeline_year' => '1970s–1990s', 'timeline_description' => 'Major industrial and infrastructure projects including cement plants, railroads, power stations, and large scale civil works.' ],
        [ 'timeline_year' => '2003–2007',   'timeline_description' => '600 MW of power generation projects delivered with Wärtsilä.' ],
        [ 'timeline_year' => '2003–Present','timeline_description' => 'Exclusive FedEx GSP in Iraq, building a nationwide logistics network.' ],
        [ 'timeline_year' => '2004–2021',   'timeline_description' => 'Telecom distribution for IraQna and later Zain Iraq.' ],
        [ 'timeline_year' => '2004–2025',   'timeline_description' => 'FMCG distribution leadership through Al Awsat.' ],
        [ 'timeline_year' => '2010–Present','timeline_description' => 'Oil & Gas services through AGOS.' ],
        [ 'timeline_year' => '2014–Present','timeline_description' => 'Mercedes Benz commercial vehicles dealership in Kurdistan.' ],
    ], $about );

    // ── CONTACT (page ID 7) ──────────────────────────────────────────────────
    $contact = 7;

    update_field( 'page_header_title',    'Contact Us',                                                          $contact );
    update_field( 'page_header_subtitle', 'Connect with our global team to explore partnership opportunities',    $contact );
    update_field( 'form_intro',             'We welcome inquiries from partners, clients, and stakeholders across all sectors.', $contact );
    update_field( 'contact_email',          'info@numerusgroup.com',                                               $contact );
    update_field( 'form_section_title',     'Get in Touch',   $contact );
    update_field( 'offices_section_title',  'Our Offices',    $contact );
    update_field( 'submit_button_text',     'Send Message',   $contact );
    update_field( 'notification_email',     get_option( 'admin_email' ), $contact );
    update_field( 'notification_cc',        '',               $contact );
    update_field( 'notification_subject',   'New Contact Form Submission — Numerus Group', $contact );

    update_field( 'offices', [
        [ 'office_city' => 'Baghdad', 'office_address' => 'Al Karrada, District 905, Street 1, Building 8', 'office_phone' => '+964 (1) 717 8456/7' ],
        [ 'office_city' => 'Basra',   'office_address' => 'Sayed Ameen Street, Albradeyya',                 'office_phone' => '+964 (781) 877 4944' ],
        [ 'office_city' => 'Erbil',   'office_address' => 'Royal City, Building C7, Suite 30',              'office_phone' => '+964 (750) 461 1833' ],
        [ 'office_city' => 'Dubai',   'office_address' => 'The Binary Tower, Suite 811, Business Bay',      'office_phone' => '+971 (4) 457 3030' ],
    ], $contact );

    // ── LOGISTICS (page ID 8) ────────────────────────────────────────────────
    $log = 8;

    update_field( 'page_header_title',    'Logistics',                                                                          $log );
    update_field( 'page_header_subtitle', 'Nationwide express, cargo and ground transportation solutions',                       $log );
    update_field( 'about_text',           'Numerus Group operates one of Iraq\'s most reliable logistics networks, serving as the fully deployed General Services Provider for FedEx and TNT. Our operations combine international standards with deep local expertise, enabling secure, efficient, and nationwide delivery.', $log );

    update_field( 'capabilities', [
        [ 'capability_text' => 'Express courier and cargo services' ],
        [ 'capability_text' => 'Customs clearance and documentation' ],
        [ 'capability_text' => 'Door to door delivery across Iraq / Last Mile Delivery Service' ],
        [ 'capability_text' => 'Secure logistics for government, embassies, and IOCs' ],
        [ 'capability_text' => 'Cross border trucking between Iraq, Jordan, and Kuwait' ],
        [ 'capability_text' => 'Real time shipment tracking and automated systems' ],
    ], $log );

    update_field( 'infrastructure', [
        [ 'infra_text' => '5 major logistics hubs across Iraq' ],
        [ 'infra_text' => 'Secure facilities in Baghdad, Basra and Erbil' ],
        [ 'infra_text' => 'BGW and ERB airport facilities' ],
        [ 'infra_text' => 'Fleet of distribution vehicles' ],
    ], $log );

    update_field( 'why_stats', [
        [ 'stat_title' => '200,000+',         'stat_text' => 'missions executed' ],
        [ 'stat_title' => '95%',              'stat_text' => 'Required Delivery Date (RDD) performance' ],
        [ 'stat_title' => 'Prime Contractor', 'stat_text' => 'for U.S. Government logistics' ],
        [ 'stat_title' => '20+ Years',        'stat_text' => 'of continuous FedEx operations' ],
    ], $log );

    // ── AUTOMOTIVE (page ID 9) ───────────────────────────────────────────────
    $auto = 9;

    update_field( 'page_header_title',    'Automotive',                                                                        $auto );
    update_field( 'page_header_subtitle', 'Premium commercial vehicle solutions for Iraq\'s industrial sectors',               $auto );
    update_field( 'about_text',           'Leading Star Automotive, a joint venture between Numerus Group and Gargash (UAE), is the authorized distributor for Mercedes Benz commercial vehicles in the Kurdistan Region of Iraq.', $auto );
    update_field( 'commitment_text',      'We deliver world class sales and service experiences, ensuring reliability, performance, and long term value for commercial fleets across the region.', $auto );

    update_field( 'products', [
        [ 'product_text' => 'Actros heavy duty trucks' ],
        [ 'product_text' => 'Sprinter and Vito vans' ],
        [ 'product_text' => 'Buses and minibuses' ],
    ], $auto );

    update_field( 'facilities', [
        [ 'facility_text' => 'Modern showroom and service center in Erbil' ],
        [ 'facility_text' => 'Certified technicians trained to Mercedes Benz global standards' ],
        [ 'facility_text' => 'Genuine spare parts and after sales support' ],
    ], $auto );

    // ── OIL & GAS (page ID 10) ───────────────────────────────────────────────
    $og = 10;

    update_field( 'page_header_title',    'Oil & Gas',                                                                         $og );
    update_field( 'page_header_subtitle', 'Integrated support services across Iraq\'s energy and utilities sectors',            $og );
    update_field( 'about_text',           'Al Gharraf Oil Services (AGOS) delivers integrated support services to international oil companies and EPC contractors operating in Iraq\'s upstream sector. Our experience spans camp construction, life support, manpower, logistics, and specialized engineering services.', $og );
    update_field( 'experience_text',      'AGOS has supported drilling, production, and field development operations across southern Iraq, delivering reliable services in challenging environments with a strong focus on safety and compliance.', $og );

    update_field( 'services', [
        [ 'service_text' => 'Water Treatment / Desalination Plant O&M',          'service_button_text' => 'Learn More', 'service_button_url' => home_url( '/contact' ) ],
        [ 'service_text' => 'Camp construction and accommodation units',           'service_button_text' => 'Learn More', 'service_button_url' => home_url( '/contact' ) ],
        [ 'service_text' => 'Catering, life support, and O&M of remote camps',    'service_button_text' => 'Learn More', 'service_button_url' => home_url( '/contact' ) ],
        [ 'service_text' => 'Manpower supply and payroll management',              'service_button_text' => 'Learn More', 'service_button_url' => home_url( '/contact' ) ],
        [ 'service_text' => 'Fuel and water supply services',                     'service_button_text' => 'Learn More', 'service_button_url' => home_url( '/contact' ) ],
        [ 'service_text' => 'Waste management and environmental services',         'service_button_text' => 'Learn More', 'service_button_url' => home_url( '/contact' ) ],
        [ 'service_text' => 'Logistics, transport, and trucking',                 'service_button_text' => 'Learn More', 'service_button_url' => home_url( '/contact' ) ],
        [ 'service_text' => 'Cathodic protection engineering and installation',    'service_button_text' => 'Learn More', 'service_button_url' => home_url( '/contact' ) ],
        [ 'service_text' => 'Supply of valves, pipes, drill bits, and O&G materials', 'service_button_text' => 'Learn More', 'service_button_url' => home_url( '/contact' ) ],
    ], $og );

    update_field( 'clients', [
        [ 'client_logo' => numerus_import_image( 'veolia-logo.svg',       'Veolia' ),       'client_name' => 'Veolia' ],
        [ 'client_logo' => numerus_import_image( 'bakerhughes-logo.png',  'Baker Hughes' ),  'client_name' => 'Baker Hughes' ],
        [ 'client_logo' => numerus_import_image( 'petrofac-logo.png',     'Petrofac' ),      'client_name' => 'Petrofac' ],
        [ 'client_logo' => numerus_import_image( 'halliburton-logo.png',  'Halliburton' ),   'client_name' => 'Halliburton' ],
        [ 'client_logo' => numerus_import_image( 'nps-logo.jpg',          'NPS' ),           'client_name' => 'NPS' ],
        [ 'client_logo' => numerus_import_image( 'oilserv-logo.png',      'OilSERV' ),       'client_name' => 'OilSERV' ],
        [ 'client_logo' => numerus_import_image( 'weatherford-logo.png',  'Weatherford' ),   'client_name' => 'Weatherford' ],
    ], $og );

    // ── WATER TREATMENT (page ID 11) ─────────────────────────────────────────
    $wt = 11;

    update_field( 'page_header_title',    'Water Treatment',                                                                    $wt );
    update_field( 'page_header_subtitle', 'Integrated support services across Iraq\'s energy and utilities sectors',             $wt );
    update_field( 'about_text',           'Al Gharraf Oil Services (AGOS) delivers integrated support services to international oil companies and EPC contractors operating in Iraq\'s upstream sector. Our experience spans camp construction, life support, manpower, logistics, and specialized engineering services.', $wt );
    update_field( 'experience_text',      'AGOS has supported drilling, production, and field development operations across southern Iraq, delivering reliable services in challenging environments with a strong focus on safety and compliance.', $wt );

    update_field( 'services', [
        [ 'service_text' => 'Desalination plant operations and maintenance' ],
        [ 'service_text' => 'Water purification system design and installation' ],
        [ 'service_text' => 'Reverse osmosis plant management' ],
        [ 'service_text' => 'Water quality testing and compliance' ],
        [ 'service_text' => 'Emergency water supply for remote camps' ],
        [ 'service_text' => 'Wastewater treatment and disposal' ],
    ], $wt );

    update_field( 'clients', [
        [ 'client_logo' => numerus_import_image( 'veolia-logo.svg',       'Veolia' ),       'client_name' => 'Veolia' ],
        [ 'client_logo' => numerus_import_image( 'bakerhughes-logo.png',  'Baker Hughes' ),  'client_name' => 'Baker Hughes' ],
        [ 'client_logo' => numerus_import_image( 'petrofac-logo.png',     'Petrofac' ),      'client_name' => 'Petrofac' ],
        [ 'client_logo' => numerus_import_image( 'halliburton-logo.png',  'Halliburton' ),   'client_name' => 'Halliburton' ],
        [ 'client_logo' => numerus_import_image( 'nps-logo.jpg',          'NPS' ),           'client_name' => 'NPS' ],
        [ 'client_logo' => numerus_import_image( 'oilserv-logo.png',      'OilSERV' ),       'client_name' => 'OilSERV' ],
        [ 'client_logo' => numerus_import_image( 'weatherford-logo.png',  'Weatherford' ),   'client_name' => 'Weatherford' ],
    ], $wt );

    // ── TRACK RECORD (page ID 14) ────────────────────────────────────────────
    $tr = 14;

    update_field( 'page_header_title',    'Track Record',                                                                       $tr );
    update_field( 'page_header_subtitle', 'Five decades of high-impact projects across Iraq\'s most critical sectors',          $tr );
    update_field( 'projects_subtitle',    'A curated selection of high impact projects delivered over the past five decades',   $tr );

    update_field( 'projects', [
        [ 'project_company' => 'Baker Hughes',   'project_description' => 'Camp life support, manpower, fuel supply' ],
        [ 'project_company' => 'Petrofac',       'project_description' => 'Rumailah base camp O&M' ],
        [ 'project_company' => 'FedEx',          'project_description' => 'Nationwide logistics network' ],
        [ 'project_company' => 'Wärtsilä',       'project_description' => '600 MW power generation projects' ],
        [ 'project_company' => 'Zain',           'project_description' => 'National telecom distribution' ],
        [ 'project_company' => 'KHD Wedag',      'project_description' => 'Samawa cement plant' ],
        [ 'project_company' => 'Mendes Junior',  'project_description' => 'Railroad and expressway construction' ],
        [ 'project_company' => 'Volkswagen',     'project_description' => 'Automotive distribution and assembly initiatives' ],
    ], $tr );

    update_field( 'highlights', [
        [ 'highlight_stat' => '600+ MW',  'highlight_label' => 'of power installed' ],
        [ 'highlight_stat' => '200,000+', 'highlight_label' => 'logistics missions' ],
        [ 'highlight_stat' => '6,000+',   'highlight_label' => 'FMCG retail points historically served' ],
        [ 'highlight_stat' => '500+',     'highlight_label' => 'telecom POS' ],
        [ 'highlight_stat' => '250+',     'highlight_label' => 'employees across the group' ],
    ], $tr );

    // ── Done ─────────────────────────────────────────────────────────────────
    update_option( 'numerus_migration_v4_done', true );
}

add_action( 'admin_init', 'numerus_run_migration' );
