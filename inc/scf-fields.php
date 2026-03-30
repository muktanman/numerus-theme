<?php
/**
 * Numerus Group — SCF (Secure Custom Fields) Field Group Definitions
 * All field groups are registered programmatically so they are version-controlled.
 * Editors see these fields on the Edit Page screen in the WordPress admin.
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

// ─── HOME PAGE ──────────────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'      => 'group_home',
    'title'    => 'Home Page Content',
    'fields'   => [
        [
            'key'   => 'field_home_hero_title',
            'label' => 'Hero Title',
            'name'  => 'hero_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_home_about_text',
            'label' => 'About Text',
            'name'  => 'about_text',
            'type'  => 'textarea',
            'rows'  => 4,
        ],
        [
            'key'   => 'field_home_footprint_years_number',
            'label' => 'Footprint — Years Number',
            'name'  => 'footprint_years_number',
            'type'  => 'text',
            'instructions' => 'e.g. 20+',
        ],
        [
            'key'   => 'field_home_footprint_years_label',
            'label' => 'Footprint — Years Label',
            'name'  => 'footprint_years_label',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_home_footprint_jobs_number',
            'label' => 'Footprint — Professionals Number',
            'name'  => 'footprint_jobs_number',
            'type'  => 'text',
            'instructions' => 'e.g. 250+',
        ],
        [
            'key'   => 'field_home_footprint_jobs_label',
            'label' => 'Footprint — Professionals Label',
            'name'  => 'footprint_jobs_label',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_home_footprint_text_1',
            'label' => 'Footprint — Text Line 1',
            'name'  => 'footprint_text_1',
            'type'  => 'textarea',
            'rows'  => 2,
        ],
        [
            'key'   => 'field_home_footprint_text_2',
            'label' => 'Footprint — Text Line 2',
            'name'  => 'footprint_text_2',
            'type'  => 'textarea',
            'rows'  => 2,
        ],
        [
            'key'   => 'field_home_cta_subtitle_1',
            'label' => 'CTA Banner — Subtitle 1',
            'name'  => 'cta_subtitle_1',
            'type'  => 'textarea',
            'rows'  => 2,
        ],
        [
            'key'   => 'field_home_cta_subtitle_2',
            'label' => 'CTA Banner — Subtitle 2',
            'name'  => 'cta_subtitle_2',
            'type'  => 'textarea',
            'rows'  => 2,
        ],
    ],
    'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/home.php' ] ] ],
] );

// ─── ABOUT PAGE ─────────────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_about',
    'title'  => 'About Page Content',
    'fields' => [
        [
            'key'   => 'field_about_header_title',
            'label' => 'Page Header — Title',
            'name'  => 'page_header_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_about_header_subtitle',
            'label' => 'Page Header — Subtitle',
            'name'  => 'page_header_subtitle',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_about_who_we_are',
            'label' => 'Who We Are — Text',
            'name'  => 'who_we_are_text',
            'type'  => 'textarea',
            'rows'  => 4,
        ],
        [
            'key'   => 'field_about_mission',
            'label' => 'Our Mission',
            'name'  => 'mission_text',
            'type'  => 'textarea',
            'rows'  => 3,
        ],
        [
            'key'   => 'field_about_vision',
            'label' => 'Our Vision',
            'name'  => 'vision_text',
            'type'  => 'textarea',
            'rows'  => 3,
        ],
        [
            'key'        => 'field_about_values',
            'label'      => 'Values',
            'name'       => 'values',
            'type'       => 'repeater',
            'button_label' => 'Add Value',
            'sub_fields' => [
                [ 'key' => 'field_about_value_number', 'label' => 'Number', 'name' => 'value_number', 'type' => 'text', 'wrapper' => [ 'width' => '20' ] ],
                [ 'key' => 'field_about_value_name',   'label' => 'Name',   'name' => 'value_name',   'type' => 'text', 'wrapper' => [ 'width' => '80' ] ],
            ],
        ],
        [
            'key'        => 'field_about_timeline',
            'label'      => 'History Timeline',
            'name'       => 'timeline',
            'type'       => 'repeater',
            'button_label' => 'Add Timeline Event',
            'sub_fields' => [
                [ 'key' => 'field_about_timeline_year', 'label' => 'Year / Period', 'name' => 'timeline_year',        'type' => 'text',     'wrapper' => [ 'width' => '30' ] ],
                [ 'key' => 'field_about_timeline_desc', 'label' => 'Description',   'name' => 'timeline_description', 'type' => 'textarea', 'rows' => 2, 'wrapper' => [ 'width' => '70' ] ],
            ],
        ],
        [
            'key'   => 'field_about_cta_title',
            'label' => 'CTA — Title',
            'name'  => 'cta_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_about_cta_subtitle',
            'label' => 'CTA — Subtitle',
            'name'  => 'cta_subtitle',
            'type'  => 'text',
        ],
    ],
    'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-about.php' ] ] ],
] );

// ─── CONTACT PAGE ───────────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_contact',
    'title'  => 'Contact Page Content',
    'fields' => [
        [
            'key'   => 'field_contact_header_title',
            'label' => 'Page Header — Title',
            'name'  => 'page_header_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_contact_header_subtitle',
            'label' => 'Page Header — Subtitle',
            'name'  => 'page_header_subtitle',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_contact_form_intro',
            'label' => 'Form Intro Text',
            'name'  => 'form_intro',
            'type'  => 'textarea',
            'rows'  => 2,
        ],
        [
            'key'        => 'field_contact_offices',
            'label'      => 'Office Locations',
            'name'       => 'offices',
            'type'       => 'repeater',
            'button_label' => 'Add Office',
            'sub_fields' => [
                [ 'key' => 'field_contact_office_city',    'label' => 'City',    'name' => 'office_city',    'type' => 'text',    'wrapper' => [ 'width' => '25' ] ],
                [ 'key' => 'field_contact_office_address', 'label' => 'Address', 'name' => 'office_address', 'type' => 'text',    'wrapper' => [ 'width' => '50' ] ],
                [ 'key' => 'field_contact_office_phone',   'label' => 'Phone',   'name' => 'office_phone',   'type' => 'text',    'wrapper' => [ 'width' => '25' ] ],
            ],
        ],
        [
            'key'   => 'field_contact_email',
            'label' => 'Contact Email',
            'name'  => 'contact_email',
            'type'  => 'email',
        ],
    ],
    'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-contact.php' ] ] ],
] );

// ─── TRACK RECORD PAGE ──────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_track_record',
    'title'  => 'Track Record Page Content',
    'fields' => [
        [
            'key'   => 'field_tr_header_title',
            'label' => 'Page Header — Title',
            'name'  => 'page_header_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_tr_header_subtitle',
            'label' => 'Page Header — Subtitle',
            'name'  => 'page_header_subtitle',
            'type'  => 'text',
        ],
        [
            'key'        => 'field_tr_projects',
            'label'      => 'Major Projects',
            'name'       => 'projects',
            'type'       => 'repeater',
            'button_label' => 'Add Project',
            'sub_fields' => [
                [ 'key' => 'field_tr_project_company', 'label' => 'Company / Client', 'name' => 'project_company',     'type' => 'text',    'wrapper' => [ 'width' => '35' ] ],
                [ 'key' => 'field_tr_project_desc',    'label' => 'Description',       'name' => 'project_description', 'type' => 'textarea', 'rows' => 2, 'wrapper' => [ 'width' => '65' ] ],
            ],
        ],
        [
            'key'        => 'field_tr_highlights',
            'label'      => 'Performance Highlights',
            'name'       => 'highlights',
            'type'       => 'repeater',
            'button_label' => 'Add Highlight',
            'sub_fields' => [
                [ 'key' => 'field_tr_highlight_stat',  'label' => 'Stat',  'name' => 'highlight_stat',  'type' => 'text', 'wrapper' => [ 'width' => '30' ] ],
                [ 'key' => 'field_tr_highlight_label', 'label' => 'Label', 'name' => 'highlight_label', 'type' => 'text', 'wrapper' => [ 'width' => '70' ] ],
            ],
        ],
    ],
    'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-track-record.php' ] ] ],
] );

// ─── LOGISTICS PAGE ─────────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_logistics',
    'title'  => 'Logistics Page Content',
    'fields' => [
        [
            'key'   => 'field_log_header_title',
            'label' => 'Page Header — Title',
            'name'  => 'page_header_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_log_header_subtitle',
            'label' => 'Page Header — Subtitle',
            'name'  => 'page_header_subtitle',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_log_about_text',
            'label' => 'About Text',
            'name'  => 'about_text',
            'type'  => 'textarea',
            'rows'  => 4,
        ],
        [
            'key'        => 'field_log_capabilities',
            'label'      => 'Capabilities',
            'name'       => 'capabilities',
            'type'       => 'repeater',
            'button_label' => 'Add Capability',
            'sub_fields' => [
                [ 'key' => 'field_log_cap_text', 'label' => 'Capability', 'name' => 'capability_text', 'type' => 'text' ],
            ],
        ],
        [
            'key'        => 'field_log_infrastructure',
            'label'      => 'Infrastructure Items',
            'name'       => 'infrastructure',
            'type'       => 'repeater',
            'button_label' => 'Add Infrastructure Item',
            'sub_fields' => [
                [ 'key' => 'field_log_infra_text', 'label' => 'Item', 'name' => 'infra_text', 'type' => 'text' ],
            ],
        ],
        [
            'key'        => 'field_log_stats',
            'label'      => 'Why Numerus Logistics — Stats',
            'name'       => 'why_stats',
            'type'       => 'repeater',
            'button_label' => 'Add Stat',
            'sub_fields' => [
                [ 'key' => 'field_log_stat_title', 'label' => 'Stat Title', 'name' => 'stat_title', 'type' => 'text', 'wrapper' => [ 'width' => '35' ] ],
                [ 'key' => 'field_log_stat_text',  'label' => 'Stat Label', 'name' => 'stat_text',  'type' => 'text', 'wrapper' => [ 'width' => '65' ] ],
            ],
        ],
    ],
    'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-logistics.php' ] ] ],
] );

// ─── AUTOMOTIVE PAGE ─────────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_automotive',
    'title'  => 'Automotive Page Content',
    'fields' => [
        [
            'key'   => 'field_auto_header_title',
            'label' => 'Page Header — Title',
            'name'  => 'page_header_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_auto_header_subtitle',
            'label' => 'Page Header — Subtitle',
            'name'  => 'page_header_subtitle',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_auto_about_text',
            'label' => 'About Text',
            'name'  => 'about_text',
            'type'  => 'textarea',
            'rows'  => 3,
        ],
        [
            'key'   => 'field_auto_commitment_text',
            'label' => 'Commitment Text',
            'name'  => 'commitment_text',
            'type'  => 'textarea',
            'rows'  => 3,
        ],
    ],
    'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-automotive.php' ] ] ],
] );

// ─── OIL & GAS PAGE ─────────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_oil_gas',
    'title'  => 'Oil & Gas Page Content',
    'fields' => [
        [
            'key'   => 'field_og_header_title',
            'label' => 'Page Header — Title',
            'name'  => 'page_header_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_og_header_subtitle',
            'label' => 'Page Header — Subtitle',
            'name'  => 'page_header_subtitle',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_og_about_text',
            'label' => 'About AGOS Text',
            'name'  => 'about_text',
            'type'  => 'textarea',
            'rows'  => 4,
        ],
        [
            'key'        => 'field_og_services',
            'label'      => 'Services',
            'name'       => 'services',
            'type'       => 'repeater',
            'button_label' => 'Add Service',
            'sub_fields' => [
                [ 'key' => 'field_og_service_text', 'label' => 'Service', 'name' => 'service_text', 'type' => 'text' ],
            ],
        ],
        [
            'key'   => 'field_og_experience_text',
            'label' => 'Experience Banner Text',
            'name'  => 'experience_text',
            'type'  => 'textarea',
            'rows'  => 3,
        ],
    ],
    'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-oil-gas.php' ] ] ],
] );

// ─── WATER TREATMENT PAGE ───────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_water_treatment',
    'title'  => 'Water Treatment Page Content',
    'fields' => [
        [
            'key'   => 'field_wt_header_title',
            'label' => 'Page Header — Title',
            'name'  => 'page_header_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_wt_header_subtitle',
            'label' => 'Page Header — Subtitle',
            'name'  => 'page_header_subtitle',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_wt_about_text',
            'label' => 'About AGOS Text',
            'name'  => 'about_text',
            'type'  => 'textarea',
            'rows'  => 4,
        ],
        [
            'key'        => 'field_wt_services',
            'label'      => 'Water Treatment Services',
            'name'       => 'services',
            'type'       => 'repeater',
            'button_label' => 'Add Service',
            'sub_fields' => [
                [ 'key' => 'field_wt_service_text', 'label' => 'Service', 'name' => 'service_text', 'type' => 'text' ],
            ],
        ],
        [
            'key'   => 'field_wt_experience_text',
            'label' => 'Experience Banner Text',
            'name'  => 'experience_text',
            'type'  => 'textarea',
            'rows'  => 3,
        ],
    ],
    'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-water-treatment.php' ] ] ],
] );
