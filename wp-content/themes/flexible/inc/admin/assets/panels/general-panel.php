<?php
/**
 * Customizer function about general settings panel
 *
 * @package Flexible
 */

add_action( 'customize_register', 'flexible_general_settings_register' );

function flexible_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel = 'flexible_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '3';
    $wp_customize->get_section( 'colors' )->panel    = 'flexible_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority = '4';
    $wp_customize->get_section( 'background_image' )->panel = 'flexible_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '5';
    $wp_customize->get_section( 'static_front_page' )->panel = 'flexible_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '6';
    $wp_customize->remove_section('header_image');
    
/*------------------------------------------------------------------------------------------*/
    /**
     * Add General Settings Panel
     */

    $wp_customize->add_panel(
    'flexible_general_settings_panel', 
    array(
        'priority'       => 3,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'General Settings', 'flexible' ),
        ) 
    );
/*------------------------------------------------------------------------------------------*/
    /**
     * Theme Color
     */
    $wp_customize->add_setting(
        'flexible_theme_color',
        array(
            'default'     => '#00A9E0',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'flexible_theme_color',
            array(
                'label'      => __( 'Theme Color', 'flexible' ),
                'section'    => 'colors',
            )
        )
    );
}
