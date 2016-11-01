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
            $image_path = wp_get_attachment_image_src( $image_id, 'uniform_single_default', true );
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        ?>
            <div class="single-post-image">
                <figure><img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt );?>" title="<?php the_title();?>" /></figure>
            </div>
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			if ( 'post' === get_post_type() ) { 
		?>
		<div class="entry-meta">
			<?php flexible_posted_on(); ?>
			<?php flexible_entry_footer(); ?>
		</div><!-- .entry-meta -->
		<?php
			}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'flexible' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flexible' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
