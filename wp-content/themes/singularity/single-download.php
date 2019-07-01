<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Singularity
 */

get_header();

// What layout are we using?
$main_class = singularity_get_single_download_main_class();
$has_sidebar = singularity_single_download_has_sidebar(); ?>

<div class="row">

	<div id="primary" class="content-area <?php echo esc_attr( $main_class ); ?>">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single-download' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		
		the_post_navigation();
		
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<?php if( $has_sidebar ) {
		get_sidebar( 'edd' );
	} ?>
	
</div><!-- .row -->

<?php get_footer();
