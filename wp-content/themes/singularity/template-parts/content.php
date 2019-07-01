<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */
?>

<?php // $count and $posts_per_row are passed via set_query_arg from index.php
if( ! isset( $count ) ) {
	$count = 0;
}
// Determine the layout
if( $count == 0 || $posts_per_row == 1 ) {
	// Full width
	$class = 'blog-article col col-xsmall-full article-' . $count;
} else if( $posts_per_row == 2 ) {
	// Three across
	$class = 'blog-article col col-xsmall-full col-small-half article-' . $count;
} else if( $posts_per_row == 3 ) {
	// Three across
	$class = 'blog-article col col-xsmall-full col-large-one-third article-' . $count;
} else if( $posts_per_row == 4 ) {
	// Three across
	$class = 'blog-article col col-xsmall-full col-large-quarter article-' . $count;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( $class ) ); ?>>
	<div class="article-inner-wrapper border-color">
		<?php 
		if( has_post_thumbnail() ) { ?>
			<div class="featured-image">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<?php the_post_thumbnail( 'large' ); ?>
				</a>
			</div>
		<?php } else {
			$use_placeholder = get_theme_mod( 'thumbnail-placeholder', 1 );
			if( $use_placeholder ) { ?>
				<div class="featured-image">
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
						<?php singularity_thumbnail_placeholder(); ?>
					</a>
				</div>
			<?php }
		} ?>
		<div class="entry-wrapper">
			<header class="entry-header">
				<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta align-items-center">
					<?php singularity_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				// How to display content
				$format = get_theme_mod( 'blog-archive-content', 'excerpt' );
				if( $format == 'excerpt' || is_front_page() ) {
					the_excerpt();
				} else {
					the_content();
				}

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'singularity' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->
			
			<div class="entry-categories">
				<?php singularity_categories(); ?>
			</div><!-- .entry-categories -->

			<footer class="entry-footer">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php _e( 'Read more', 'singularity' ); ?></a>
				<?php if ( get_edit_post_link() ) : ?>
				<?php edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'singularity' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				); ?>
				<?php endif; ?>
			</footer><!-- .entry-footer -->
			
			
		</div><!-- .entry-wrapper -->
		
	</div><!-- .article-inner-wrapper -->
</article><!-- #post-## -->

