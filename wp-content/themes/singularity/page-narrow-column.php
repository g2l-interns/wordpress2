<?php
/**
 * Template Name: Narrow Column
 *
 * @package Singularity
 */

get_header(); ?>

<div class="row">
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page-narrow-column' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
</div><!-- .row -->

<?php
// get_sidebar();
get_footer();
