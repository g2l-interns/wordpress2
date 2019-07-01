<?php
/**
 * Template Name: Sidebar Right
 *
 * @package Singularity
 */

get_header();

$main_class = singularity_get_page_main_class(); ?>

<div class="row">

	<div id="primary" class="content-area col col-xsmall-full <?php echo esc_attr( $main_class ); ?>">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<?php // We can filter the sidebar if we wish
	$sidebar = apply_filters( 'singularity_filter_page_sidebar_right', '' );
	get_sidebar( $sidebar ); ?>
	
</div><!-- .row -->

<?php get_footer();
