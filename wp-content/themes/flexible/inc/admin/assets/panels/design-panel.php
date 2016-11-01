<?php
/**
 * Customizer function about design settings panel
 *
 * @package Flexible
 */

add_action( 'customize_register', 'flexible_design_settings_register' );

function flexible_design_settings_register( $wp_customize ) {

    /**
     * Add Design Settings Panel
     */

    $wp_customize->add_panel( 
    	'flexible_design_settings_panel', 
	    array(
	        'priority'       => 3,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Design Settings', 'flexible' ),
	    )
    );
/*-----------------------------------------------------------------------*/
	/**
     * Archive Settings
     */    
    $wp_customize->add_section(
        'flexible_archive_section',
        array(
            'title'		=> __( 'Archive Settings', 'flexible' ),
            'priority'  => 5,
            'panel'     => 'flexible_design_settings_panel',
        )
    );

    //Archive sidebar
    $wp_customize->add_setting(
        'flexible_archive_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'flexible_sidebar_layout',
        )       
    );
    $wp_customize->add_control(
        'flexible_archive_sidebar',
        array(
            'type'		=> 'radio',
            'priority'  => 5,
            'label' 	=> __( 'Available Sidebars', 'flexible' ),
            'section' 	=> 'flexible_archive_section',
            'choices' 	=> array(
                'right_sidebar' 	=> __( 'Right Sidebar', 'flexible' ),
                'left_sidebar' 		=> __( 'Left Sidebar', 'flexible' ),
                'no_sidebar' 		=> __( 'No sidebar Full Width', 'flexible' ),
                'no_sidebar_center' => __( 'No sidebar Centered', 'flexible' )
            ),
        )
    );

    //Excerpt Length
    $wp_customize->add_setting(
        'flexible_excerpt_length',
        array(
            'default' => '50',
            'sanitize_callback' => 'flexible_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'flexible_excerpt_length',
        array(
            'type' 			=> 'number',
            'priority' 		=> 6,
            'label' 		=> __( 'Archive Excerpt Length', 'flexible' ),
            'description'	=> __( 'Number of words to be display in content.', 'flexible' ),
            'section' 		=> 'flexible_archive_section',
            'input_attrs' 	=> array(
	                'min'   => 10,
	                'max'   => 300,
	                'step'  => 5
	                ),
            )
    );

    // archive read more button text
    $wp_customize->add_setting(
        'flexible_archive_read_more',
        array(
            'default' => __( 'Read More', 'flexible' ),
            'transport'=> 'postMessage',
            'sanitize_callback' => 'flexible_sanitize_text'
        )
    );
    $wp_customize->add_control(
        'flexible_archive_read_more',
        array(
            'type' => 'text',
            'priority' => 7,
            'label' => __( 'Read More button label', 'flexible' ),
            'section' => 'flexible_archive_section'
        )
    );
/*-----------------------------------------------------------------------*/
	/**
     * Post Settings
     */    
    $wp_customize->add_section(
        'flexible_post_section',
        array(
            'title'		=> __( 'Post Settings', 'flexible' ),
            'priority'  => 6,
            'panel'     => 'flexible_design_settings_panel',
        )
    );

    $wp_customize->add_setting(
        'flexible_default_post_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'flexible_sidebar_layout',
        )       
    );
    $wp_customize->add_control(
        'flexible_default_post_sidebar',
        array(
            'type'		=> 'radio',
            'priority'  => 5,
            'label' 	=> __( 'Available Sidebars', 'flexible' ),
            'section' 	=> 'flexible_post_section',
            'choices' 	=> array(
                'right_sidebar' 	=> __( 'Right Sidebar', 'flexible' ),
                'left_sidebar' 		=> __( 'Left Sidebar', 'flexible' ),
                'no_sidebar' 		=> __( 'No sidebar Full Width', 'flexible' ),
                'no_sidebar_center' => __( 'No sidebar Centered', 'flexible' )
            ),
        )
    );
/*-----------------------------------------------------------------------*/
	/**
     * Page Settings
     */    
    $wp_customize->add_section(
        'flexible_page_section',
        array(
            'title'		=> __( 'Page Settings', 'flexible' ),
            'priority'  => 7,
            'panel'     => 'flexible_design_settings_panel',
        )
    );

    $wp_customize->add_setting(
        'flexible_default_page_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'flexible_sidebar_layout',
        )       
    );
    $wp_customize->add_control(
        'flexible_default_page_sidebar',
        array(
            'type'		=> 'radio',
            'priority'  => 5,
            'label' 	=> __( 'Available Sidebars', 'flexible' ),
            'section' 	=> 'flexible_page_section',
            'choices' 	=> array(
                'right_sidebar' 	=> __( 'Right Sidebar', 'flexible' ),
                'left_sidebar' 		=> __( 'Left Sidebar', 'flexible' ),
                'no_sidebar' 		=> __( 'No sidebar Full Width', 'flexible' ),
                'no_sidebar_center' => __( 'No sidebar Centered', 'flexible' )
            ),
        )
    );
/*--------------------------------------------------------------------------------------------------------*/
    /**
    * Customm design
    */ 
    $wp_customize->add_section(
        'flexible_custom_design_section',
        array(
            'title'         => __( 'Custom Design', 'flexible' ),
            'priority'      => 8,
            'panel'         => 'flexible_design_settings_panel'
        )
    );
     
    // Breadcrumbes option
    $wp_customize->add_setting(
        'flexible_custom_css',
        array(
            'default' =>'',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'flexible_sanitize_text',
        )
    );
    $wp_customize->add_control( new Textarea_Custom_Control(
        $wp_customize,
        'flexible_custom_css',
            array(
                'type' => 'flexible_textarea',
                'label' => __( 'Custom css', 'flexible' ),
                'priority' => 5,
                'section' => 'flexible_custom_design_section'
                )
        )
    );
}