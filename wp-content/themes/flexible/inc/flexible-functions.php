<?php
/**
 * Define some custom function for flexible themes.
 *
 * @package Flexible
 */
/*-------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for admin
 */
add_action( 'admin_enqueue_scripts', 'flexible_admin_scripts' );

function flexible_admin_scripts() {
	
	if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
	}

    wp_register_script( 'of-media-uploader', get_template_directory_uri() . '/inc/admin/js/media-uploader.js', array('jquery'), '1.0.0' );
    wp_enqueue_script( 'of-media-uploader' );
    wp_localize_script( 'of-media-uploader', 'flexible_l10n', array(
        'upload' => __( 'Upload', 'flexible' ),
        'remove' => __( 'Remove', 'flexible' )
    ));

    wp_enqueue_style( 'flexible-choosen', get_template_directory_uri() . '/inc/admin/css/chosen.css', array(), '1.0.1' );
		wp_enqueue_style( 'flexible-admin-styles', get_template_directory_uri() . '/inc/admin/css/admin-styles.css', array(), '1.0.0' );
		wp_enqueue_script( 'flexible-choose-scripts', get_template_directory_uri() . '/inc/admin/js/chosen.jquery.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'flexible-admin-scripts', get_template_directory_uri() . '/inc/admin/js/admin-scripts.js', false, '1.0.0', true );
}
/*-------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 */
function flexible_scripts() {

	wp_enqueue_style( 'flexible-font-awesome', get_template_directory_uri().'/font-awesome/css/font-awesome.min.css', array(), '4.5.0' );

	wp_enqueue_style( 'flexible-google-font', 'https://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,700,700italic,500italic,900' );
    
	wp_enqueue_style( 'flexible-style', get_stylesheet_uri() );

	wp_enqueue_style( 'flexible-responsive', get_template_directory_uri() . '/css/flexible-responsive.css');

	wp_enqueue_script( 'flexible-bxSlider', get_template_directory_uri() .'/js/jquery.bxslider.js', array( 'jquery' ), '4.1.2', true );

	wp_enqueue_script( 'flexible-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'flexible-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'flexible-onePage', get_template_directory_uri() .'/js/jquery.nav.js', array('jquery'), '1.0.0' ,true );

	$header_sticky_option = get_theme_mod( 'flexible_header_sticky', '0' );
	if( empty( $header_sticky_option ) && $header_sticky_option != 1 ) {
		wp_enqueue_script( 'flexible-sticky', get_template_directory_uri() .'/js/sticky/jquery.sticky.js', array('jquery'), '1.0.2' ,true );
		wp_enqueue_script( 'flexible-sticky-setting', get_template_directory_uri() .'/js/sticky/sticky-setting.js', array('flexible-sticky'), '1.0.0' ,true );
	}

	wp_enqueue_script( 'flexible-parallax', get_template_directory_uri() .'/js/jquery.parallax-1.1.3.js', array(), '1.1.3' ,true );	

	wp_enqueue_script( 'flexible-custom-scripts', get_template_directory_uri() .'/js/flexible-custom.js', array( 'jquery', 'flexible-bxSlider' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flexible_scripts' );
/*------------------------------------------------------------------------------------*/
if ( ! function_exists( 'flexible_the_custom_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 */
	function flexible_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;
/*------------------------------------------------------------------------------------*/
/**
 * Flexible front slider
 */
add_action( 'flexible_front_slider', 'flexible_front_slider_cb', 10 );

if( !function_exists( 'flexible_front_slider_cb' ) ) :
	function flexible_front_slider_cb() {
?>
	<section class="flexible-front-slider">
		<div id="homeSlider">
			<?php 
				for( $i=1; $i < 4; $i++ ) {
					$flexible_slide_caption = get_theme_mod( 'flexible_slide_caption'.$i );
					$flexible_slide_info = get_theme_mod( 'flexible_slide_info'.$i );
					$flexible_slide_image = get_theme_mod( 'flexible_slide_image'.$i );
                    $flexible_slide_btn_text = get_theme_mod( 'flexible_slide_btn_text'.$i );
                    $flexible_slide_btn_url = get_theme_mod( 'flexible_slide_btn_url'.$i );
					if( !empty( $flexible_slide_image ) ) {
			?>
				<div class="front-slide">
					<img src="<?php echo esc_url( $flexible_slide_image );?>" />
                    <!-- <div class="slider-overlay"> </div> -->
					<div class="slider-caption-wrapper">
						<?php if( !empty( $flexible_slide_caption ) ) { ?>
								<h2 class="slide-caption"><?php echo esc_html( $flexible_slide_caption );?></h2>
						<?php } ?>
						<?php if( !empty( $flexible_slide_info ) ) { ?>
								<span class="slide-info"><?php echo wp_kses_post( $flexible_slide_info );?></span>
						<?php } ?>
						<div class="clearfix"> </div>
                        <?php if( !empty( $flexible_slide_btn_text ) ) { ?>
                                <a class="slider-btn" href="<?php echo esc_url( $flexible_slide_btn_url ); ?>"><?php echo esc_html( $flexible_slide_btn_text );?></a>
                        <?php } ?>
					</div>
				</div>
			<?php
					}
				}
			?>
		</div>
	</section>
<?php
	}
endif;

/*----------------------------------------------------------------------*/
/**
 * Flexible page dropdown
 */
$flexible_pages = get_pages();
$flexible_page_dropdown['0'] = __( 'Select Page', 'flexible' );
foreach ( $flexible_pages as $flexible_page ) {
	$flexible_page_dropdown[$flexible_page->ID] = $flexible_page->post_title;
}

/**
 * Flexible category dropdown
 */
$flexible_categories = get_categories( array( 'hide_empty' => 0 ) );
$flexible_category_dropdown['0'] = __( 'Select Category', 'flexible' );
foreach ( $flexible_categories as $flexible_category ) {
	$flexible_category_dropdown[$flexible_category->term_id] = $flexible_category->cat_name;
}

/**
 * Flexible category list
 */
$flexible_cat_args = array(
            	'type'                     => 'post',
                'child_of'                 => 0,
            	'orderby'                  => 'name',
            	'order'                    => 'ASC',
            	'hide_empty'               => 1,
            	'taxonomy'                 => 'category',
            );
$flexible_categories = get_categories( $flexible_cat_args );
$flexible_categories_lists = array();
foreach( $flexible_categories as $category ) {
    $flexible_categories_lists[$category->term_id] = $category->name;
}

/*------------------------------------------------------------------------*/
/**
 * Flexible homepage excerpt
 */
if( ! function_exists( 'flexible_get_excerpt' ) ):
function flexible_get_excerpt( $content, $limit ) {
	$striped_content = strip_tags( $content );
	$striped_content = strip_shortcodes( $striped_content );
	$limit_content = mb_substr( $striped_content, 0 , $limit );
	if( $limit_content < $content ){
		$limit_content .= "..."; 
	}
	return $limit_content;
}
endif;

/**
 * Function to get excerpt content according to define length
 */
if( ! function_exists( 'flexible_archive_excerpt' ) ):
    function flexible_archive_excerpt( $content, $limit ) {
        $content = strip_tags( $content );
        $content = strip_shortcodes( $content );
        $words = explode( ' ', $content );    
        return implode( ' ', array_slice( $words, 0, $limit ) );
    }
endif;

/*-------------------------------------------------------------------------*/
/**
 * Function define about page/post/archive sidebar
 */
if( ! function_exists( 'flexible_get_sidebar' ) ):
function flexible_get_sidebar() {
    global $post;
    if( $post ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'flexible_page_sidebar', true );
    }
     
    if( is_home() ) {
        $front_id = get_option( 'page_for_posts' );
		$sidebar_meta_option = get_post_meta( $front_id, 'flexible_page_sidebar', true );
    }
    
    if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    
    $vmag_archive_sidebar = get_theme_mod( 'flexible_archive_sidebar', 'right_sidebar' );
    $vmag_post_default_sidebar = get_theme_mod( 'flexible_default_post_sidebar', 'right_sidebar' );
    $vmag_page_default_sidebar = get_theme_mod( 'flexible_default_page_sidebar', 'right_sidebar' );
    
    if( $sidebar_meta_option == 'default_sidebar' ) {
        if( is_single() ) {
            if( $vmag_post_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $vmag_post_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( is_page() ) {
            if( $vmag_page_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $vmag_page_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( $vmag_archive_sidebar == 'right_sidebar' ) {
            get_sidebar();
        } elseif( $vmag_archive_sidebar == 'left_sidebar' ) {
            get_sidebar( 'left' );
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        get_sidebar();
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        get_sidebar( 'left' );
    }
}
endif;

/**
 * Social media function
 */

if( !function_exists( 'flexible_social_media' ) ):
	function flexible_social_media() {

		$social_section_option = get_theme_mod( 'flexible_social_option', 0 );

		$social_fb = get_theme_mod( 'flexible_fb_link', 'https://facebook.com/' );
		$social_tw = get_theme_mod( 'flexible_tw_link', 'https://twitter.com/' );
		$social_gp = get_theme_mod( 'flexible_gp_link', 'https://plus.google.com/' );
		$social_lnk = get_theme_mod( 'flexible_lnk_link', 'https://linkedin.com/' );
		$social_yt = get_theme_mod( 'flexible_yt_link', 'https://youtube.com/' );
		$social_vm = get_theme_mod( 'flexible_vm_link', 'https://vimeo.com/' );
		$social_pin = get_theme_mod( 'flexible_pin_link', 'https://www.pinterest.com/' );
		$social_insta = get_theme_mod( 'flexible_insta_link', 'https://www.instagram.com/' );
		if( $social_section_option != 1 ) {
?>
			<div class="right-section">
	            <?php if( !empty( $social_fb ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $social_fb ); ?>" target="_blank"><i class="fa  fa-facebook"></i></a></span><?php } ?>
	            <?php if( !empty( $social_tw ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $social_tw ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></span><?php } ?>
	            <?php if( !empty( $social_gp ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $social_gp ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></span><?php } ?>
	            <?php if( !empty( $social_lnk ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $social_lnk ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></span><?php } ?>
	            <?php if( !empty( $social_yt ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $social_yt ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></span><?php } ?>
	            <?php if( !empty( $social_vm ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $social_vm ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></span><?php } ?>
	            <?php if( !empty( $social_pin ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $social_pin ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></span><?php } ?>
	            <?php if( !empty( $social_insta ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $social_insta ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></span><?php } ?>
	        </div>
<?php
		}
	}
endif;