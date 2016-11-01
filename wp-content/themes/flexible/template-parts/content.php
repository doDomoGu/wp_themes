<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexible
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
            $image_id = get_post_thumbnail_id();
            $image_path = wp_get_attachment_image_src( $image_id, 'large', true );
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
            $archive_read_button = get_theme_mod( 'flexible_archive_read_more', __( 'Read More', 'flexible' )  );
        ?>
            <div class="single-post-image">
                <figure><img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt );?>" title="<?php the_title();?>" /></figure>
            </div>
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php flexible_posted_on(); ?>
			<?php flexible_entry_footer(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			$flexible_post_content = get_the_content();
			$flexible_excerpt_length = get_theme_mod( 'flexible_excerpt_length', '50' );
			echo '<p>'. flexible_archive_excerpt( $flexible_post_content, $flexible_excerpt_length ) .'</p>';

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flexible' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<div class="post-readmore"><a href="<?php the_permalink();?>"><?php echo esc_html( $archive_read_button ); ?> </a> </div>
</article><!-- #post-## -->