<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package Flexible
 */
?>

<?php
/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
 
if( !is_active_sidebar( 'flexible-footer-column-first' ) &&
	!is_active_sidebar( 'flexible-footer-column-second' ) &&
   !is_active_sidebar( 'flexible-footer-column-third' ) &&
   !is_active_sidebar( 'flexible-footer-column-forth' ) ) {
	return;
}
$flexible_footer_layout = get_theme_mod( 'flexible_footer_widget', 'three_columns' );
?>
<div id="top-footer" class="footer-widgets-wrapper footer_<?php echo esc_attr( $flexible_footer_layout ); ?> clearfix">
  <div class="mt-container">
  	<div class="footer-widgets-area clearfix">
          <div class="mt-footer-widget-wrapper mt-column-wrapper clearfix">
          		<div class="flexible-footer-widget wow fadeInLeft" data-wow-duration="0.5s">
          			<?php
          			if ( !dynamic_sidebar( 'flexible-footer-column-first' ) ):
          			endif;
          			?>
          		</div>
      		<?php if( $flexible_footer_layout != 'one_column' ){ ?>
                  <div class="flexible-footer-widget wow fadeInLeft" data-woww-duration="1s">
          			<?php
          			if ( !dynamic_sidebar( 'flexible-footer-column-second' ) ):
          			endif;
          			?>
          		</div>
              <?php } ?>
              <?php if( $flexible_footer_layout == 'three_columns' || $flexible_footer_layout == 'four_columns' ){ ?>
                  <div class="flexible-footer-widget wow fadeInLeft" data-wow-duration="1.5s">
                     <?php
                     if ( !dynamic_sidebar( 'flexible-footer-column-third' ) ):
                     endif;
                     ?>
                  </div>
              <?php } ?>
              <?php if( $flexible_footer_layout == 'four_columns' ){ ?>
                  <div class="flexible-footer-widget wow fadeInLeft" data-wow-duration="2s">
                     <?php
                     if ( !dynamic_sidebar( 'flexible-footer-column-forth' ) ):
                     endif;
                     ?>
                  </div>
              <?php } ?>
          </div><!-- .mt-footer-widget-wrapper -->
  	</div><!-- .footer-widgets-area -->
  </div>
</div><!-- .footer-widgets-wrapper -->