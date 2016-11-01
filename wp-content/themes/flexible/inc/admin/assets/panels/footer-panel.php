<?php
/**
 * Customizer function about footer settings panel
 *
 * @package Flexible
 */

add_action( 'customize_register', 'flexible_footer_settings_register' );

function flexible_footer_settings_register( $wp_customize ) {

	/**
     * Add Design Settings Panel
     */

    $wp_customize->add_panel( 
    	'flexible_footer_settings_panel', 
	    array(
	        'priority'       => 3,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Footer Settings', 'flexible' ),
	    )
    );
/*-----------------------------------------------------------------------*/
	/**
     * Widget Settings
     */    
    $wp_customize->add_section(
        'flexible_widget_section',
        array(
            'title'		=> __( 'Widget Settings', 'flexible' ),
            'priority'  => 5,
            'panel'     => 'flexible_footer_settings_panel',
        )
    );

    //Footer widget option
    $wp_customize->add_setting(
        'flexible_footer_widget',
        array(
            'default'           => 'three_columns',
            'sanitize_callback' => 'flexible_footer_widget_columns',
        )       
    );
    $wp_customize->add_control(
        'flexible_footer_widget',
        array(
            'type'		=> 'radio',
            'priority'  => 5,
            'label' 	=> __( 'Available Options', 'flexible' ),
            'description' => __( 'Choose option to display footer widget layout.', 'flexible' ),
            'section' 	=> 'flexible_widget_section',
            'choices' 	=> array(
                'four_columns' 	=> __( 'Four Columns', 'flexible' ),
                'three_columns' => __( 'Three Columns', 'flexible' ),
                'two_columns' 	=> __( 'Two Columns', 'flexible' ),
                'one_column' 	=> __( 'One Column', 'flexible' )
            )
        )
    );
/*-----------------------------------------------------------------------*/
    /**
     * Footer Copyright
     */    
    $wp_customize->add_section(
        'flexible_footer_copyright_section',
        array(
            'title'     => __( 'Footer Copyright', 'flexible' ),
            'priority'  => 10,
            'panel'     => 'flexible_footer_settings_panel',
        )
    );

    //Footer copyright textarea
    $wp_customize->add_setting(
        'flexible_copyright_txt', 
            array(
                'default'   => '2016 Flexible',
                'transport' => 'postMessage',
                'sanitize_callback' => 'flexible_sanitize_text'                    
           )
    );    
    $wp_customize->add_control( new Textarea_Custom_Control (
        $wp_customize,
        'flexible_copyright_txt',
            array(
            'type'       => 'flexible_textarea',
            'label'      => __( 'Footer Copyright', 'flexible' ),
            'section'    => 'flexible_footer_copyright_section',
            'description' => __( 'Edit your copyright content.', 'flexible' )                
            )
        )
    );

/*-----------------------------------------------------------------------*/
	/**
     * Social Media
     */    
    $wp_customize->add_section(
        'flexible_social_media_section',
        array(
            'title'		=> __( 'Social Media', 'flexible' ),
            'priority'  => 15,
            'panel'     => 'flexible_footer_settings_panel',
        )
    );

    //footer social option
    $wp_customize->add_setting(
        'flexible_social_option', 
        array(
            'default'     => 0,
            'sanitize_callback' => 'flexible_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'flexible_social_option', 
        array(
            'type'        => 'checkbox',
            'label'       => __( 'Social Media Section', 'flexible' ),
            'description' => __( 'Checked to disabled social media section.', 'flexible' ),
            'section'     => 'flexible_social_media_section',
            'priority'    => 2
        )
    );

    //Facebook Link
    $wp_customize->add_setting(
        'flexible_fb_link',
        array(
            'default' => __( 'https://facebook.com/', 'flexible' ),
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'flexible_fb_link',
        array(
            'type' => 'text',
            'priority' => 3,
            'label' => __( 'Facebook', 'flexible' ),
            'section' => 'flexible_social_media_section'
        )
    );

    //Twitter Link
    $wp_customize->add_setting(
        'flexible_tw_link',
        array(
            'default' => __( 'https://twitter.com/', 'flexible' ),
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'flexible_tw_link',
        array(
            'type' => 'text',
            'priority' => 4,
            'label' => __( 'Twitter', 'flexible' ),
            'section' => 'flexible_social_media_section'
            )
    );
    
    //Google plus Link
    $wp_customize->add_setting(
        'flexible_gp_link',
        array(
            'default' => __( 'https://plus.google.com/', 'flexible' ),
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'flexible_gp_link',
        array(
            'type' => 'text',
            'priority' => 5,
            'label' => __( 'Google Plus', 'flexible' ),
            'section' => 'flexible_social_media_section'
            )
    );
    
    //LinkedIn Link
    $wp_customize->add_setting(
        'flexible_lnk_link',
        array(
            'default' => __( 'https://linkedin.com/', 'flexible' ),
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'flexible_lnk_link',
        array(
            'type' => 'text',
            'priority' => 6,
            'label' => __( 'LinkedIn', 'flexible' ),
            'section' => 'flexible_social_media_section'
            )
    );
    
    //Youtube Link
    $wp_customize->add_setting(
        'flexible_yt_link',
        array(
            'default' => __( 'https://youtube.com/', 'flexible' ),
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'flexible_yt_link',
        array(
            'type' => 'text',
            'priority' => 7,
            'label' => __( 'YouTube', 'flexible' ),
            'section' => 'flexible_social_media_section'
            )
    );
    
    //Vimeo Link
    $wp_customize->add_setting(
        'flexible_vm_link',
        array(
            'default' => __( 'https://vimeo.com/', 'flexible' ),
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'flexible_vm_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => __( 'Vimeo', 'flexible' ),
            'section' => 'flexible_social_media_section'
            )
    );

    //Pinterest link
    $wp_customize->add_setting(
        'flexible_pin_link',
        array(
            'default' => __( 'https://www.pinterest.com/', 'flexible' ),
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'flexible_pin_link',
        array(
            'type' => 'text',
            'priority' => 9,
            'label' => __( 'Pinterest', 'flexible' ),
            'section' => 'flexible_social_media_section'
            )
    );

    //Instagram link
    $wp_customize->add_setting(
        'flexible_insta_link',
        array(
            'default' => __( 'https://www.instagram.com', 'flexible' ),
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'flexible_insta_link',
        array(
            'type' => 'text',
            'priority' => 10,
            'label' => __( 'Instagram', 'flexible' ),
            'section' => 'flexible_social_media_section'
            )
    );
}