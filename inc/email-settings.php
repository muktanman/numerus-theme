<?php
/**
 * Numerus Group — Email Settings Admin Page
 *
 * Adds Settings → Email Settings in the WP admin where editors can
 * configure who receives form submissions and what the email looks like.
 * Values are stored as WP options (no SCF required).
 */

// ── Register settings & add menu page ────────────────────────────────────────
add_action( 'admin_menu', function () {
    add_options_page(
        'Email Settings',
        'Email Settings',
        'manage_options',
        'numerus-email-settings',
        'numerus_render_email_settings_page'
    );
} );

add_action( 'admin_init', function () {
    $group = 'numerus_email_settings';
    $page  = 'numerus-email-settings';

    register_setting( $group, 'numerus_email_to',      [ 'sanitize_callback' => 'sanitize_text_field' ] );
    register_setting( $group, 'numerus_email_cc',      [ 'sanitize_callback' => 'sanitize_text_field' ] );
    register_setting( $group, 'numerus_email_subject', [ 'sanitize_callback' => 'sanitize_text_field' ] );
    register_setting( $group, 'numerus_email_body',    [ 'sanitize_callback' => 'sanitize_textarea_field' ] );

    add_settings_section( 'numerus_email_section', '', '__return_null', $page );

    add_settings_field( 'numerus_email_to', 'Send Submissions To', function () {
        $val = get_option( 'numerus_email_to', get_option( 'admin_email' ) );
        echo '<input type="text" name="numerus_email_to" value="' . esc_attr( $val ) . '" class="regular-text">';
        echo '<p class="description">Email address that receives form submissions. Separate multiple addresses with commas.</p>';
    }, $page, 'numerus_email_section' );

    add_settings_field( 'numerus_email_cc', 'CC (optional)', function () {
        $val = get_option( 'numerus_email_cc', '' );
        echo '<input type="text" name="numerus_email_cc" value="' . esc_attr( $val ) . '" class="regular-text">';
        echo '<p class="description">Optional. Comma-separated addresses to CC on every submission.</p>';
    }, $page, 'numerus_email_section' );

    add_settings_field( 'numerus_email_subject', 'Email Subject', function () {
        $val = get_option( 'numerus_email_subject', 'New Contact Form Submission — Numerus Group' );
        echo '<input type="text" name="numerus_email_subject" value="' . esc_attr( $val ) . '" class="regular-text">';
    }, $page, 'numerus_email_section' );

    add_settings_field( 'numerus_email_body', 'Email Body Template', function () {
        $default = numerus_default_email_body();
        $val     = get_option( 'numerus_email_body', $default );
        echo '<textarea name="numerus_email_body" rows="14" class="large-text code">' . esc_textarea( $val ) . '</textarea>';
        echo '<p class="description">Available tokens: <code>{{name}}</code> <code>{{email}}</code> <code>{{company}}</code> <code>{{message}}</code> <code>{{date}}</code> <code>{{ip}}</code></p>';
    }, $page, 'numerus_email_section' );
} );

// ── Settings page renderer ────────────────────────────────────────────────────
function numerus_render_email_settings_page(): void {
    if ( ! current_user_can( 'manage_options' ) ) return;
    ?>
    <div class="wrap">
        <h1>Email Settings</h1>
        <p>Configure who receives contact form submissions and what the notification email looks like.</p>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'numerus_email_settings' );
            do_settings_sections( 'numerus-email-settings' );
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

// ── Default email body template ───────────────────────────────────────────────
function numerus_default_email_body(): string {
    return implode( "\n", [
        'You have a new contact form submission from the Numerus Group website.',
        str_repeat( '-', 50 ),
        '',
        'Name:    {{name}}',
        'Email:   {{email}}',
        'Company: {{company}}',
        '',
        'Message:',
        '{{message}}',
        '',
        str_repeat( '-', 50 ),
        'Submitted: {{date}}',
        'IP Address: {{ip}}',
    ] );
}

// ── Helper: build the final email body from the stored template ───────────────
function numerus_build_email_body( array $data ): string {
    $template = get_option( 'numerus_email_body', numerus_default_email_body() );
    return str_replace(
        [ '{{name}}', '{{email}}', '{{company}}', '{{message}}', '{{date}}', '{{ip}}' ],
        [
            $data['name'],
            $data['email'],
            $data['company'] ?: '—',
            $data['message'],
            date( 'D, d M Y H:i:s T' ),
            $data['ip'],
        ],
        $template
    );
}
