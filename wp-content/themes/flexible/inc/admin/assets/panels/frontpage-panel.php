<?php
/**
 * Define customizer options/section for frontpage
 *
 * @package Flexible
 */

add_action( 'customize_register', 'flexible_frontpage_settings_register' );

function flexible_frontpage_settings_register( $wp_customize ) {

    /*$flexible_pages = get_pages( array( 'hide_empty' => 0 ) );
    foreach ( $flexible_pages as $single_flexible_pages ) {
        $flexible_page_select[ $single_flexible_pages->ID ] = $single_flexible_pages->post_title; 
    }*/

	/**
	 * Added frontpage panel
	 */
	$wp_customize->add_panel( 
    'flexible_frontpage_settings_panel', 
    array(
        'priority'       => 3,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'FrontPage Settings', 'flexible' ),
        ) 
    );
/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Slider Section
     */    
    $wp_customize->add_section(
        'flexible_slider_section',
        array(
            'title'     => __( 'Slider Settings', 'flexible' ),
            'priority'  => 5,
            'panel'     => 'flexible_frontpage_settings_panel',
        )
    );

    //Slider section option
    $wp_customize->add_setting(
        'flexible_slider_option', 
        array(
            'default'     => 0,
            'transport'   => 'postMessage',
            'sanitize_callback' => 'flexible_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'flexible_slider_option', 
        array(
            'type'        => 'checkbox',
            'label'       => __( 'Slider Section Option', 'flexible' ),
            'description' => __( 'Checked to disabled homepage slider section.', 'flexible' ),
            'section'     => 'flexible_slider_section',
            'priority'    => 4
        )
    );


    for ( $i=1; $i < 4; $i++ ) { 
        //Slider label
        $wp_customize->add_setting(
            'flexible_slider_label'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'flexible_sanitize_text'
            )
        );

        $wp_customize->add_control( new WP_Customize_Section_Label(
            $wp_customize,
            'flexible_slider_label'.$i,
                array(
                    'section'  => 'flexible_slider_section',
                    'label'    => __( 'Slider ', 'flexible' ).$i,
                )
            )
        );

        //Slider title
        $wp_customize->add_setting(
            'flexible_slide_caption'.$i, 
                array(
                    'default'   => '',
                    'transport' => 'postMessage',
                    'sanitize_callback' => 'flexible_sanitize_text'                    
               )
        );    
        $wp_customize->add_control(
            'flexible_slide_caption'.$i,
                array(
                'type'      => 'text',
                'label'     => __( 'Image Caption', 'flexible' ),
                'section'   => 'flexible_slider_section',
                'description'=> __( 'Add caption for slider image.', 'flexible' )
                
                )
        );

        //Slide description
        $wp_customize->add_setting(
            'flexible_slide_info'.$i, 
                array(
                    'default'   => '',
                    'transport' => 'postMessage',
                    'sanitize_callback' => 'flexible_sanitize_text'                    
               )
        );    
        $wp_customize->add_control( new Textarea_Custom_Control (
            $wp_customize,
            'flexible_slide_info'.$i,
                array(
                'type'       => 'flexible_textarea',
                'label'      => __( 'Image Description', 'flexible' ),
                'section'    => 'flexible_slider_section',
                'description' => __( 'Add description for slider image.', 'flexible' )                
                )
            )
        );

        //Slider button text
        $wp_customize->add_setting(
            'flexible_slide_btn_text'.$i, 
                array(
                    'default'   => '',
                    'transport' => 'postMessage',
                    'sanitize_callback' => 'flexible_sanitize_text'                    
               )
        );    
        $wp_customize->add_control(
            'flexible_slide_btn_text'.$i,
                array(
                'type'      => 'text',
                'label'     => __( 'Button Text', 'flexible' ),
                'section'   => 'flexible_slider_section',
                'description'=> __( 'Add a text for slide button.', 'flexible' )
                
                )
        );

        //Slider button url
        $wp_customize->add_setting(
            'flexible_slide_btn_url'.$i, 
                array(
                    'default'   => '',
                    'transport' => 'postMessage',
                    'sanitize_callback' => 'esc_url_raw'                    
               )
        );    
        $wp_customize->add_control(
            'flexible_slide_btn_url'.$i,
                array(
                'type'      => 'text',
                'label'     => __( 'Button url', 'flexible' ),
                'section'   => 'flexible_slider_section',
                'description'=> __( 'Add a url about slide button.', 'flexible' )
                
                )
        );

        // Slider image
        $wp_customize->add_setting(
            'flexible_slide_image'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'flexible_slide_image'.$i,
                array(
                    'label'       => __( 'Slider Image', 'flexible' ),
                    'section'     => 'flexible_slider_section',
                    'description' => __( 'Added image for slider.', 'flexible' )
                )
            )
        );
    }//endfor

}