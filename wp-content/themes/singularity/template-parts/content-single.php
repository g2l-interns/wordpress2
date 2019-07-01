<?php
/**
 * Template part for displaying post singles
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */
?>

<?php
if( has_post_thumbnail() && ! singularity_has_pinned_thumb() ) { ?>
	<div class="featured-image">
		<?php the_post_thumbnail( 'large' ); ?>
	</div>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'singularity' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php get_template_part( 'template-parts/author', 'bio' ); ?>
		<?php if ( get_edit_post_link() ) : ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'singularity' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
		<?php endif; ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->


