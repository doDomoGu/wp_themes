<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Flexible
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

if( ! function_exists( 'flexible_body_classes' ) ):
    
    function flexible_body_classes( $classes ) {
    	global $post;

    	// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

    	if( $post ) { $sidebar_meta = get_post_meta( $post->ID, 'flexible_page_sidebar', true ); }
        
    	if( is_home() ) {
    		$queried_id = get_option( 'page_for_posts' );
    		$sidebar_meta = get_post_meta( $queried_id, 'flexible_page_sidebar', true );
    	}    	
    	if( empty( $sidebar_meta ) || is_archive() || is_search() ) { $sidebar_meta = 'default_sidebar'; }
    	$flexible_archive_sidebar = get_theme_mod( 'flexible_archive_sidebar', 'right_sidebar' );

    	$flexible_default_page_sidebar = get_theme_mod( 'flexible_default_page_sidebar', 'right_sidebar' );
    	$flexible_default_post_sidebar = get_theme_mod( 'flexible_default_post_sidebar', 'right_sidebar' );
        
    	if( $sidebar_meta == 'default_sidebar' ) {
    		if( is_page() ) {
    			if( $flexible_default_page_sidebar == 'right_sidebar' ) { $classes[] = ''; }
    			elseif( $flexible_default_page_sidebar == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
    			elseif( $flexible_default_page_sidebar == 'no_sidebar' ) { $classes[] = 'no-sidebar-fullwidth'; }
    			elseif( $flexible_default_page_sidebar == 'no_sidebar_center' ) { $classes[] = 'no-sidebar-centered'; }
    		}
    		elseif( is_single() ) {
    			if( $flexible_default_post_sidebar == 'right_sidebar' ) { $classes[] = ''; }
    			elseif( $flexible_default_post_sidebar == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
    			elseif( $flexible_default_post_sidebar == 'no_sidebar' ) { $classes[] = 'no-sidebar-fullwidth'; }
    			elseif( $flexible_default_post_sidebar == 'no_sidebar_center' ) { $classes[] = 'no-sidebar-centered'; }
    		}
    		elseif( $flexible_archive_sidebar == 'right_sidebar' ) { $classes[] = ''; }
    		elseif( $flexible_archive_sidebar == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
    		elseif( $flexible_archive_sidebar == 'no_sidebar' ) { $classes[] = 'no-sidebar-fullwidth'; }
    		elseif( $flexible_archive_sidebar == 'no_sidebar_center' ) { $classes[] = 'no-sidebar-centered'; }
    	}
    	elseif( $sidebar_meta == 'right_sidebar' ) { $classes[] = ''; }
    	elseif( $sidebar_meta == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
    	elseif( $sidebar_meta == 'no_sidebar' ) { $classes[] = 'no-sidebar-fullwidth'; }
    	elseif( $sidebar_meta == 'no_sidebar_center' ) { $classes[] = 'no-sidebar-centered'; }

        $flexible_slider_option = get_theme_mod( 'flexible_slider_option', '0' );
        if( $flexible_slider_option == 1 ) {
            $classes[] = 'disable-main-slider';
        }

    	return $classes;
    }
endif;

add_filter( 'body_class', 'flexible_body_classes' );

/**
 * Theme color function
 */
add_action( 'wp_head', 'flexible_dynamic_style' );

if( ! function_exists( 'flexible_dynamic_style' ) ) :
    function flexible_dynamic_style() {
        $flexible_theme_color = get_theme_mod( 'flexible_theme_color', '#00A9E0' );
        $flexible_custom_css = get_theme_mod( 'flexible_custom_css', '' );
?>
        <style type="text/css">
            /** color **/
            a,
            .entry-footer a:hover,
            .comment-author .fn .url:hover,
            #cancel-comment-reply-link,
            #cancel-comment-reply-link:before,
            .logged-in-as a,
            #site-navigation ul li:hover > a,
            #site-navigation ul li.current-one-page-item > a,
            .header-search-wrapper .search-main:hover,
            .testimonial-content::before,
            .testi-author-name,
            .widget a:hover,
            .widget a:hover::before,
            .widget li:hover::before,
            .entry-title a:hover,
            .post-readmore a:hover,
            .site-info a:hover,
            .about-section-wrapper ul li::before,
            .flexible-front-slider .bx-next:hover, 
            .flexible-front-slider .bx-prev:hover,
            .entry-meta span a:hover { 
                color: <?php echo esc_attr( $flexible_theme_color ); ?>; 
            }
            
            /** background color **/
            .navigation .nav-links a:hover,
            .bttn:hover,
            button,
            input[type="button"]:hover,
            input[type="reset"]:hover,
            input[type="submit"]:hover,
            .reply .comment-reply-link,
            .header-search-wrapper .search-submit,
            .slider-btn:hover,
            .widget .about-section-wrapper .widget-title:after,
            .flexible-widget-wrapper .widget-title::after,
            .service_icon_class:hover,
            .flexible_portfolio_section .plus-link:hover,
            .flexible-cta-wrapper,
            .blog-content-wrapper .news-more,
            .flexible_contact_us input.wpcf7-submit,
            .contact-icon:hover,
            .widget_search .search-submit,
            #mt-scrollup,
            .error404 .page-title,
            .edit-link .post-edit-link { 
                background-color: <?php echo esc_attr( $flexible_theme_color ); ?>; 
            }
            
            /** border-color **/
            .navigation .nav-links a,
            .bttn,
            button,
            input[type="button"],
            input[type="reset"],
            input[type="submit"],
            .contact-icon:hover,
            .widget_search .search-submit{ 
                border-color: <?php echo esc_attr( $flexible_theme_color ); ?>; 
            }

            .comment-list .comment-body{ 
                border-top-color: <?php echo esc_attr( $flexible_theme_color ); ?>; 
            }

            .flexible-widget-wrapper .widget-title::before{ 
                border-bottom-color: <?php echo esc_attr( $flexible_theme_color ); ?>; 
            }

            .service_icon_class:hover:after,
            .widget-title{ 
                border-left-color: <?php echo esc_attr( $flexible_theme_color ); ?>; 
            }

            .slide-info,
            .portfolio-content-wrapper,
            .cta-overlay{
                background: <?php echo flexible_hex2rgba( $flexible_theme_color, 0.6 ); ?>;
            }

            .blog-content-wrapper .news-more:hover,
            .flexible_cta .cta-button:hover {
                background-color: <?php echo flexible_color_dark( $flexible_theme_color, '-0.9' ); ?>;
            }

            a:hover, a:focus, a:active{
                color: <?php echo flexible_color_dark( $flexible_theme_color, '-0.9' ); ?>;
            }

            .flexible_cta .cta-button:hover{
                border-color: <?php echo flexible_color_dark( $flexible_theme_color, '-0.9' ); ?>;
            }

            <?php echo wp_kses_post( $flexible_custom_css ); ?>
        </style>
<?php
    }
endif;

//Converts hex colors to rgba
function flexible_hex2rgba( $color, $opacity ) {

        if ( $color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        $rgb =  array_map( 'hexdec', $hex );
        //$opacity = 0.9;
        $output = 'rgba( '.implode( ",",$rgb ).','.$opacity.' )';
        return $output;
}

// Converts hex dark value to rgba
if( ! function_exists( 'flexible_color_dark' ) ):
function flexible_color_dark( $hex, $percent ) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE 
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

endif;