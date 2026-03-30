<?php
/**
 * Numerus Group — Contact Form Submissions
 *
 * Registers the `numerus_submission` custom post type so every contact
 * form entry is stored in the database and viewable in WP admin.
 */

// ── Register CPT ──────────────────────────────────────────────────────────────
add_action( 'init', function () {
    register_post_type( 'numerus_submission', [
        'labels' => [
            'name'          => 'Form Submissions',
            'singular_name' => 'Submission',
            'menu_name'     => 'Submissions',
            'all_items'     => 'All Submissions',
            'view_item'     => 'View Submission',
            'search_items'  => 'Search Submissions',
            'not_found'     => 'No submissions found.',
        ],
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'show_in_rest'    => false,      // disable Gutenberg
        'menu_icon'       => 'dashicons-email-alt',
        'menu_position'   => 25,
        'capability_type' => 'post',
        'capabilities'    => [ 'create_posts' => 'do_not_allow' ],
        'map_meta_cap'    => true,
        'supports'        => [ 'title' ],
    ] );
} );

// ── Save a submission (called from the AJAX handler) ─────────────────────────
if ( ! function_exists( 'numerus_save_submission' ) ) {
    function numerus_save_submission( array $data ): int {
        $title = sprintf(
            '%s — %s',
            sanitize_text_field( $data['name'] ),
            current_time( 'j M Y, H:i' )
        );

        $post_id = wp_insert_post( [
            'post_title'  => $title,
            'post_type'   => 'numerus_submission',
            'post_status' => 'publish',
        ] );

        if ( is_wp_error( $post_id ) || ! $post_id ) return 0;

        update_post_meta( $post_id, '_sub_name',    sanitize_text_field( $data['name'] ) );
        update_post_meta( $post_id, '_sub_email',   sanitize_email( $data['email'] ) );
        update_post_meta( $post_id, '_sub_company', sanitize_text_field( $data['company'] ?? '' ) );
        update_post_meta( $post_id, '_sub_message', sanitize_textarea_field( $data['message'] ) );
        update_post_meta( $post_id, '_sub_ip',      sanitize_text_field( $data['ip'] ?? '' ) );

        return (int) $post_id;
    }
}

// ── Admin list columns ────────────────────────────────────────────────────────
add_filter( 'manage_numerus_submission_posts_columns', function ( $cols ) {
    return [
        'cb'          => $cols['cb'],
        'sub_name'    => 'Name',
        'sub_email'   => 'Email',
        'sub_company' => 'Company',
        'sub_message' => 'Message',
        'date'        => 'Date',
    ];
} );

add_action( 'manage_numerus_submission_posts_custom_column', function ( $col, $post_id ) {
    switch ( $col ) {
        case 'sub_name':
            echo '<strong>' . esc_html( get_post_meta( $post_id, '_sub_name', true ) ) . '</strong>';
            break;
        case 'sub_email':
            $email = get_post_meta( $post_id, '_sub_email', true );
            echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
            break;
        case 'sub_company':
            $company = get_post_meta( $post_id, '_sub_company', true );
            echo $company ? esc_html( $company ) : '<span style="color:#aaa">—</span>';
            break;
        case 'sub_message':
            echo esc_html( wp_trim_words( get_post_meta( $post_id, '_sub_message', true ), 12, '…' ) );
            break;
    }
}, 10, 2 );

add_filter( 'manage_edit-numerus_submission_sortable_columns', function ( $cols ) {
    $cols['sub_name']  = 'sub_name';
    $cols['sub_email'] = 'sub_email';
    return $cols;
} );

// ── Detail meta box — full submission on the edit screen ──────────────────────
add_action( 'add_meta_boxes', function () {
    add_meta_box(
        'numerus_sub_details',
        'Submission Details',
        'numerus_render_submission_meta_box',
        'numerus_submission',
        'normal',
        'high'
    );
} );

function numerus_render_submission_meta_box( WP_Post $post ): void {
    $name    = get_post_meta( $post->ID, '_sub_name',    true );
    $email   = get_post_meta( $post->ID, '_sub_email',   true );
    $company = get_post_meta( $post->ID, '_sub_company', true );
    $message = get_post_meta( $post->ID, '_sub_message', true );
    $ip      = get_post_meta( $post->ID, '_sub_ip',      true );
    ?>
    <style>
        .sub-detail-table { border-collapse: collapse; width: 100%; }
        .sub-detail-table th,
        .sub-detail-table td { padding: 10px 14px; border-bottom: 1px solid #eee; vertical-align: top; }
        .sub-detail-table th { width: 120px; font-weight: 600; color: #333; background: #f9f9f9; }
        .sub-detail-table .sub-message { white-space: pre-wrap; line-height: 1.6; }
    </style>
    <table class="sub-detail-table">
        <tr><th>Name</th><td><?php echo esc_html( $name ); ?></td></tr>
        <tr><th>Email</th><td><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></td></tr>
        <?php if ( $company ) : ?>
        <tr><th>Company</th><td><?php echo esc_html( $company ); ?></td></tr>
        <?php endif; ?>
        <tr><th>Message</th><td class="sub-message"><?php echo esc_html( $message ); ?></td></tr>
        <tr><th>Date</th><td><?php echo get_the_date( 'D, j M Y \a\t H:i', $post ); ?></td></tr>
        <tr><th>IP Address</th><td><?php echo esc_html( $ip ); ?></td></tr>
    </table>
    <?php
}

// ── Hide the title input on the edit screen (read-only, auto-generated) ───────
add_action( 'admin_head', function () {
    global $post_type;
    if ( $post_type === 'numerus_submission' ) {
        echo '<style>#titlediv { display: none; } #minor-publishing { display: none; }</style>';
    }
} );
