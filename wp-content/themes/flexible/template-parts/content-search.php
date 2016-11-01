<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexible
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php flexible_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php 
			$flexible_post_content = get_the_content();
			$flexible_excerpt_length = get_theme_mod( 'flexible_excerpt_length', '50' );
			echo '<p>'. flexible_archive_excerpt( $flexible_post_content, $flexible_excerpt_length ) .'</p>';
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php flexible_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
