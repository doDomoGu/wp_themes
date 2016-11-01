<?php
/**
 * Flexible functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flexible
 */

if ( ! function_exists( 'flexible_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function flexible_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on flexible, use a find and replace
	 * to change 'flexible' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'flexible', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 */
	add_image_size( 'flexible-site-logo', 320, 160 );
	add_theme_support( 'custom-logo', array( 'size' => 'flexible-site-logo' ) );

	add_image_size( 'flexible-blog-thumb', 478, 316, true );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'flexible' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'flexible_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'flexible_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flexible_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'flexible_content_width', 640 );
}
add_action( 'after_setup_theme', 'flexible_content_width', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Added custom functions.
 */
require get_template_directory() . '/inc/flexible-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load related file for widgets
 */
require get_template_directory() . '/inc/flexible-widgets.php';
require get_template_directory() . '/inc/widgets/flexible-widget-fields.php';
require get_template_directory() . '/inc/widgets/flexible-about-page.php';
require get_template_directory() . '/inc/widgets/flexible-services.php';
require get_template_directory() . '/inc/widgets/flexible-portfolios.php';
require get_template_directory() . '/inc/widgets/flexible-testimonials.php';
require get_template_directory() . '/inc/widgets/flexible-cta.php';
require get_template_directory() . '/inc/widgets/flexible-latest-news.php';
require get_template_directory() . '/inc/widgets/flexible-clients.php';
require get_template_directory() . '/inc/widgets/flexible-contact-us.php';

/**
 * Load custom classes file.
 */
require get_template_directory() . '/inc/admin/assets/flexible-custom-classes.php';

/**
 * Load sanitize file.
 */
require get_template_directory() . '/inc/admin/assets/flexible-sanitize.php';

/**
 * Load customizer panels
 */
require get_template_directory() . '/inc/admin/assets/panels/general-panel.php'; // General Settings
require get_template_directory() . '/inc/admin/assets/panels/header-panel.php'; // Header Settings
require get_template_directory() . '/inc/admin/assets/panels/frontpage-panel.php'; // FrontPage Settings
require get_template_directory() . '/inc/admin/assets/panels/design-panel.php'; // Design Settings
require get_template_directory() . '/inc/admin/assets/panels/footer-panel.php'; // Footer Settings

/**
 * Load flexible metaboxes
 */
require get_template_directory() . '/inc/admin/metabox/flexible-page-metabox.php'; //page metabox
require get_template_directory() . '/inc/admin/metabox/flexible-post-metabox.php'; //post metabox