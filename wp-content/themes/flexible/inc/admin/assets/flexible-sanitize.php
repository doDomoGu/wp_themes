<?php
/**
 * File to sanitize customizer field
 *
 * @package Flexible
 */

//Text
function flexible_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//Email
function flexible_sanitize_email( $input ) {
    return sanitize_email( $input );
}

//Checkboxes
function flexible_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return 0;
    }
}

// Number
function flexible_sanitize_number( $input ) {
    $output = intval($input);
     return $output;
}

// site layout
function flexible_sanitize_site_layout( $input ) {
    $valid_keys = array(
        'wide_layout'   => __( 'Wide Layout', 'flexible' ),
        'boxed_layout'  => __( 'Boxed Layout', 'flexible' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

// Archive Layouts
function flexible_sidebar_layout( $input ) {
    $valid_keys = array(
        'right_sidebar'     => __( 'Right Sidebar', 'flexible' ),
        'left_sidebar'      => __( 'Left Sidebar', 'flexible' ),
        'no_sidebar'        => __( 'No sidebar Full Width', 'flexible' ),
        'no_sidebar_center' => __( 'No sidebar Centered', 'flexible' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//Footer widget columns
function flexible_footer_widget_columns( $input ) {
    $valid_keys = array(
        'four_columns'  => __( 'Four Columns', 'flexible' ),
        'three_columns' => __( 'Three Columns', 'flexible' ),
        'two_columns'   => __( 'Two Columns', 'flexible' ),
        'one_column'    => __( 'One Column', 'flexible' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}