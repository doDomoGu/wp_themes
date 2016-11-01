<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexible
 */

if ( ! is_active_sidebar( 'flexible-sidebar-left' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area aside-left" role="complementary">
	<?php dynamic_sidebar( 'flexible-sidebar-left' ); ?>
</aside><!-- #secondary -->
