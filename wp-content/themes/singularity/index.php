<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */

get_header();

// What layout are we using?
$layout = singularity_get_archive_layout();
$sidebar = false;
if( $layout == 'no-sidebar' ) {
	// No sidebar
	$main_class = 'col col-xsmall-full';
} else if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
	// With a sidebar
	$main_class = 'col col-xsmall-full col-large-two-thirds';
	$sidebar = true;
} else {
	// No sidebar, narrow layout
	$main_class = 'col col-large-two-thirds center-content';
} ?>

<div class="row">

	<div id="primary" class="content-area <?php echo esc_attr( $main_class ); ?>">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) {

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			$count = 0;
			$row_count = 0;
			$posts_per_row = get_theme_mod( 'posts-per-row', 2 );
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			
				// Decide when to start a new row
				if( $count == 0 || $posts_per_row == 1 || $count%$posts_per_row == 1 ) {
					echo '<div class="row row-' . $row_count . '">';
					$row_status = 'open';
				}
				
				// Pass the $count parameter to the template part
				set_query_var( 'count', $count );
				set_query_var( 'posts_per_row', $posts_per_row );
				get_template_part( 'template-parts/content' );
				
				// Decide when to close a row 
				if( $count == 0 || $posts_per_row == 1 || $count%$posts_per_row == 0 ) {
					echo '</div><!-- .row-' . $row_count . ' -->';
					$row_status = 'closed';
					$row_count++;
				}
				
				$count++;
				
			endwhile;
			
			// Close any hanging rows
			if( $row_status == 'open' ) {
				echo '</div><!-- .row-' . $row_count . ' -->';
			} ?>

			<div class="posts-navigation-wrapper">
				<div class="row">
					<div class="col col-xsmall-full">
						<?php the_posts_navigation(); ?>
					</div><!-- .col -->
				</div><!-- .row -->
			</div><!-- .posts-navigation-wrapper -->
			
			<?php

		} else {

			get_template_part( 'template-parts/content', 'none' );

		} ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<?php if( $sidebar ) {
		get_sidebar();
	} ?>
	
</div><!-- .row -->

<?php
get_footer();
