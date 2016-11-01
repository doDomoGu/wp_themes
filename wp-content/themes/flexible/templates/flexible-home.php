<?php
/**
 * Template Name: Home Page
 *
 * This page is display all sections of homepage.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexible
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
	        	if( is_active_sidebar( 'flexible-frontpage-widget-area' ) ) {
	            	if ( !dynamic_sidebar( 'flexible-frontpage-widget-area' ) ):
	            	endif;
	         	}
	        ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();