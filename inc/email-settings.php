<?php
/**
 * Numerus Group — Email Settings Admin Page
 *
 * Settings → Email Settings covers two sections:
 *  1. Notifications  — who gets the email and what it says
 *  2. SMTP           — outgoing mail server so emails actually reach inboxes
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

    // ── Notification options ──────────────────────────────────────────────────
    register_setting( $group, 'numerus_email_to',      [ 'sanitize_callback' => 'sanitize_text_field' ] );
    register_setting( $group, 'numerus_email_cc',      [ 'sanitize_callback' => 'sanitize_text_field' ] );
    register_setting( $group, 'numerus_email_subject', [ 'sanitize_callback' => 'sanitize_text_field' ] );
    register_setting( $group, 'numerus_email_body',    [ 'sanitize_callback' => 'sanitize_textarea_field' ] );

    // ── SMTP options ──────────────────────────────────────────────────────────
    register_setting( $group, 'numerus_smtp_host',       [ 'sanitize_callback' => 'sanitize_text_field' ] );
    register_setting( $group, 'numerus_smtp_port',       [ 'sanitize_callback' => 'absint' ] );
    register_setting( $group, 'numerus_smtp_encryption', [ 'sanitize_callback' => 'sanitize_text_field' ] );
    register_setting( $group, 'numerus_smtp_user',       [ 'sanitize_callback' => 'sanitize_text_field' ] );
    register_setting( $group, 'numerus_smtp_from_email', [ 'sanitize_callback' => 'sanitize_email' ] );
    register_setting( $group, 'numerus_smtp_from_name',  [ 'sanitize_callback' => 'sanitize_text_field' ] );
    // Password: only update if a new value is submitted; never overwrite with blank
    register_setting( $group, 'numerus_smtp_pass', [
        'sanitize_callback' => function ( $val ) {
            if ( $val === '' ) return get_option( 'numerus_smtp_pass', '' );
            return $val;
        },
    ] );

    // ── Section: Notifications ────────────────────────────────────────────────
    add_settings_section( 'numerus_notifications_section', 'Notifications', function () {
        echo '<p>Who receives form submissions and what the email looks like.</p>';
    }, $page );

    add_settings_field( 'numerus_email_to', 'Send Submissions To', function () {
        $val = get_option( 'numerus_email_to', get_option( 'admin_email' ) );
        echo '<input type="text" name="numerus_email_to" value="' . esc_attr( $val ) . '" class="regular-text">';
        echo '<p class="description">Recipient email. Separate multiple addresses with commas.</p>';
    }, $page, 'numerus_notifications_section' );

    add_settings_field( 'numerus_email_cc', 'CC (optional)', function () {
        $val = get_option( 'numerus_email_cc', '' );
        echo '<input type="text" name="numerus_email_cc" value="' . esc_attr( $val ) . '" class="regular-text">';
        echo '<p class="description">Comma-separated addresses to CC on every submission.</p>';
    }, $page, 'numerus_notifications_section' );

    add_settings_field( 'numerus_email_subject', 'Email Subject', function () {
        $val = get_option( 'numerus_email_subject', 'New Contact Form Submission — Numerus Group' );
        echo '<input type="text" name="numerus_email_subject" value="' . esc_attr( $val ) . '" class="regular-text">';
    }, $page, 'numerus_notifications_section' );

    add_settings_field( 'numerus_email_body', 'Email Body Template', function () {
        $val = get_option( 'numerus_email_body', numerus_default_email_body() );
        echo '<textarea name="numerus_email_body" rows="14" class="large-text code">' . esc_textarea( $val ) . '</textarea>';
        echo '<p class="description">Available tokens: <code>{{name}}</code> <code>{{email}}</code> <code>{{company}}</code> <code>{{message}}</code> <code>{{date}}</code> <code>{{ip}}</code></p>';
    }, $page, 'numerus_notifications_section' );

    // ── Section: SMTP Configuration ───────────────────────────────────────────
    add_settings_section( 'numerus_smtp_section', 'SMTP Configuration', function () {
        echo '<p>Configure an outgoing mail server so emails reliably reach inboxes. Leave blank to use the server default (not recommended for production).</p>';
    }, $page );

    add_settings_field( 'numerus_smtp_from_name', 'From Name', function () {
        $val = get_option( 'numerus_smtp_from_name', get_bloginfo( 'name' ) );
        echo '<input type="text" name="numerus_smtp_from_name" value="' . esc_attr( $val ) . '" class="regular-text">';
        echo '<p class="description">The sender name recipients see (e.g. Numerus Group).</p>';
    }, $page, 'numerus_smtp_section' );

    add_settings_field( 'numerus_smtp_from_email', 'From Email', function () {
        $val = get_option( 'numerus_smtp_from_email', get_option( 'admin_email' ) );
        echo '<input type="email" name="numerus_smtp_from_email" value="' . esc_attr( $val ) . '" class="regular-text">';
        echo '<p class="description">Must match or be authorised by your SMTP account.</p>';
    }, $page, 'numerus_smtp_section' );

    add_settings_field( 'numerus_smtp_host', 'SMTP Host', function () {
        $val = get_option( 'numerus_smtp_host', '' );
        echo '<input type="text" name="numerus_smtp_host" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="smtp.gmail.com">';
        echo '<p class="description">Common hosts: <code>smtp.gmail.com</code> · <code>smtp.office365.com</code> · <code>smtp.mail.yahoo.com</code></p>';
    }, $page, 'numerus_smtp_section' );

    add_settings_field( 'numerus_smtp_port_enc', 'Port &amp; Encryption', function () {
        $port = get_option( 'numerus_smtp_port', 587 );
        $enc  = get_option( 'numerus_smtp_encryption', 'tls' );
        echo '<input type="number" name="numerus_smtp_port" value="' . esc_attr( $port ) . '" style="width:80px"> &nbsp;';
        echo '<select name="numerus_smtp_encryption">';
        foreach ( [ 'tls' => 'TLS (recommended — port 587)', 'ssl' => 'SSL (port 465)', 'none' => 'None (port 25, not recommended)' ] as $k => $label ) {
            echo '<option value="' . esc_attr( $k ) . '"' . selected( $enc, $k, false ) . '>' . esc_html( $label ) . '</option>';
        }
        echo '</select>';
    }, $page, 'numerus_smtp_section' );

    add_settings_field( 'numerus_smtp_user', 'SMTP Username', function () {
        $val = get_option( 'numerus_smtp_user', '' );
        echo '<input type="text" name="numerus_smtp_user" value="' . esc_attr( $val ) . '" class="regular-text" autocomplete="off" placeholder="your@email.com">';
    }, $page, 'numerus_smtp_section' );

    add_settings_field( 'numerus_smtp_pass', 'SMTP Password', function () {
        $saved = get_option( 'numerus_smtp_pass', '' );
        echo '<input type="password" name="numerus_smtp_pass" value="" class="regular-text" autocomplete="new-password" placeholder="' . ( $saved ? '••••••••  (saved — leave blank to keep)' : 'Enter password' ) . '">';
        echo '<p class="description">For Gmail, use an <a href="https://myaccount.google.com/apppasswords" target="_blank">App Password</a>, not your Google account password.</p>';
    }, $page, 'numerus_smtp_section' );
} );

// ── Wire up PHPMailer to use SMTP settings when a host is configured ─────────
add_action( 'phpmailer_init', function ( $phpmailer ) {
    $host = get_option( 'numerus_smtp_host', '' );
    if ( ! $host ) return; // No SMTP configured — fall back to server default

    $phpmailer->isSMTP();
    $phpmailer->Host       = $host;
    $phpmailer->Port       = (int) get_option( 'numerus_smtp_port', 587 );
    $phpmailer->SMTPSecure = get_option( 'numerus_smtp_encryption', 'tls' );
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = get_option( 'numerus_smtp_user', '' );
    $phpmailer->Password   = get_option( 'numerus_smtp_pass', '' );

    $from_email = get_option( 'numerus_smtp_from_email', '' );
    $from_name  = get_option( 'numerus_smtp_from_name', get_bloginfo( 'name' ) );
    if ( $from_email ) {
        $phpmailer->From     = $from_email;
        $phpmailer->FromName = $from_name;
    }
} );

// ── Settings page renderer ────────────────────────────────────────────────────
function numerus_render_email_settings_page(): void {
    if ( ! current_user_can( 'manage_options' ) ) return;
    ?>
    <div class="wrap">
        <h1>Email Settings</h1>
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
