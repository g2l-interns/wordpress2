<?php
/**
 * Template part for displaying featured pages on the homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */
?>

<?php // $count and $posts_per_row are passed via set_query_arg from index.php
if( ! isset( $count ) ) {
	$count = 1;
}

// Determine the layout
if( $posts_per_row == 1 ) {
	// Full width
	$class = 'blog-article col col-xsmall-full article-' . $count;
} else if( $posts_per_row == 2 ) {
	// Three across
	$class = 'blog-article col col-xsmall-full col-small-half article-' . $count;
} else if( $posts_per_row == 3 ) {
	// Three across
	$class = 'blog-article col col-xsmall-full col-large-one-third article-' . $count;
} else {
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
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				// How to display content
				$extract = get_theme_mod( 'featured-page-extract-' . $count );
				if( ! empty( $extract ) ) {
					// Use excerpt specified in Customizer
					printf( '<p>%s</p>', esc_html( $extract ) );
				} else {
					// Use the excerpt
					the_excerpt();
				}

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

