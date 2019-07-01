<?php
/**
 * The template for displaying all single discussion topic post types
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Singularity
 */

get_header();

// What layout are we using?
$main_class = singularity_get_topic_main_class();
$has_sidebar = singularity_topic_has_sidebar(); ?>

<div class="row">

	<div id="primary" class="content-area <?php echo esc_attr( $main_class ); ?>">
		
		<?php do_action( 'singularity_ctdb_do_breadcrumb' ); ?>
		
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single-discussion-topics' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		
		the_post_navigation( '%title', '%title', true );
		
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<?php if( $has_sidebar ) {
		get_sidebar( 'discussion-board' );
	} ?>
	
</div><!-- .row -->

<?php get_footer();
