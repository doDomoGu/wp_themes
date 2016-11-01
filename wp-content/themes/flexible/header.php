<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexible
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	
	<header id="masthead" class="site-header <?php if( get_theme_mod( 'flexible_header_sticky', '0' ) == 1 ) { echo 'sticky-header'; }?>" role="banner">
		<div class="mt-container">
			<div class="site-branding">
				<div class="site-logo">
					<?php flexible_the_custom_logo(); ?>
				</div>
				<?php
					$site_title_option = get_theme_mod( 'header_textcolor' );
					if( $site_title_option != 'blank' ) {
						$title_class = 'show-title';
					} else {
						$title_class = 'hide-title';
					}
					$site_description = get_bloginfo( 'description', 'display' );
					if( $site_description ) {
						$has_desc = 'has-desc';
					} else {
						$has_desc = 'no-desc';
					}
				?>
				<div class="site-title-wrapper <?php echo esc_attr( $title_class ).' '. esc_attr( $has_desc ); ?>">
					<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
					endif; ?>
				</div><!-- .site-title-wrapper -->
			</div><!-- .site-branding -->
			<div class="search-nav-wrapper clearfix">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<div class="menu-toggle hide"> <i class="fa fa-navicon"> </i> </div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
				<?php if( get_theme_mod( 'flexible_header_search', 0 ) == 1 ) { ?>
					<div class="header-search-wrapper">                    
		                <span class="search-main"><i class="fa fa-search"></i></span>
		                <div class="search-form-main clearfix">
							<div class="mt-container">
			                	<?php get_search_form(); ?>
			                </div>
			            </div>
		            </div>
	            <?php } ?>
	        </div> <!-- seach nav wrapper -->
		</div> <!-- mt-container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

		<?php 
			$flexible_slider_option = get_theme_mod( 'flexible_slider_option', '0' );
			if( is_front_page() && $flexible_slider_option != 1 ) {
				do_action( 'flexible_front_slider' );
			} 
		?>
		<?php if( ! is_page_template( 'templates/flexible-home.php' ) ) { ?>
            <div class="mt-container">
        <?php } ?>