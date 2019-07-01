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
if( has_post_thumbnail() ) { ?>
	<div class="featured-image col center-content">
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

</article><!-- #post-## -->


