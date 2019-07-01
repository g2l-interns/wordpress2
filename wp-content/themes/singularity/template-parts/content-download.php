<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */
?>

<?php // $posts_per_row is passed via set_query_arg from index.php
// Determine the layout
if( $posts_per_row == 1 ) {
	// Full width
	$class = 'blog-article col col-xsmall-full';
} else if( $posts_per_row == 2 ) {
	// Three across
	$class = 'blog-article col col-xsmall-full col-small-half';
} else if( $posts_per_row == 3 ) {
	// Three across
	$class = 'blog-article col col-xsmall-full col-large-one-third';
} else {
	// Four across
	$class = 'blog-article col col-xsmall-full col-large-quarter';
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
				?>
				<div class="edd-entry-meta entry-meta align-items-center">
					<?php singularity_edd_meta(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
			
			<div class="entry-categories">
				<?php singularity_edd_categories(); ?>
			</div><!-- .entry-categories -->

			<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php edit_post_link(
						sprintf(
							/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'singularity' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<span class="edit-link">',
						'</span>'
					); ?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
			
		</div><!-- .entry-wrapper -->
		
	</div><!-- .article-inner-wrapper -->
</article><!-- #post-## -->

