<?php
/**
 * Define sections for header settings
 *
 * @package Flexible
 */

add_action( 'customize_register', 'flexible_header_settings_register' );

function flexible_header_settings_register( $wp_customize ) {

    /**
     * Add Header Settings Panel
     */
    $wp_customize->add_panel( 
        'flexible_header_settings_panel', 
        array(
            'priority'       => 3,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Header Settings', 'flexible' ),
        ) 
    );
/*-----------------------------------------------------------------------*/
    /**
     * Header Style
     */
    $wp_customize->add_section(
        'flexible_header_section',
        array(
            'title'     => __( 'Header Extra Options', 'flexible' ),
            'priority'  => 50,
            'panel'     => 'flexible_header_settings_panel'
        )
    );

    // Sticky menu
    $wp_customize->add_setting(
        'flexible_header_sticky', 
        array(
            'default'     => 0,
            'transport'   => 'postMessage',
            'sanitize_callback' => 'flexible_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'flexible_header_sticky', 
        array(
            'type'        => 'checkbox',
            'label'       => __( 'Sticky Header Option', 'flexible' ),
            'description' => __( 'Checked to disabled header section sticky features.', 'flexible' ),
            'section'     => 'flexible_header_section',
            'priority'    => 4
        )
    );

    // Search icon
    $wp_customize->add_setting(
        'flexible_header_search', 
        array(
            'default'     => 0,
            'transport'   => 'postMessage',
            'sanitize_callback' => 'flexible_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'flexible_header_search', 
        array(
            'type'        => 'checkbox',
            'label'       => __( 'Search Icon', 'flexible' ),
            'description' => __( 'Checked to add search icon at menu section.', 'flexible' ),
            'section'     => 'flexible_header_section',
            'priority'    => 5
        )
    );
}