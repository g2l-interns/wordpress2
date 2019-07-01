<?php
/**
 * Template part for displaying page content in page-home.php
 *
 * This template consists of several areas that can be populated through widgets,
 * standard page content, and special sections unique to the theme.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */
?>

<?php 
$show_title = get_theme_mod( 'hide-homepage-title', 1 );
if( has_post_thumbnail() && ! singularity_has_pinned_thumb() ) { ?>
	<div class="featured-image center-content">
		<?php the_post_thumbnail( 'large' ); ?>
	</div>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if( ! $show_title ) { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php } ?>
	
	<div class="entry-content">
		<?php singularity_get_home_sections(); ?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
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
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
