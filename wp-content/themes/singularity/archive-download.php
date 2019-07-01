<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */

get_header();

// What layout are we using?
$main_class = singularity_get_archive_download_main_class();
$has_sidebar = singularity_archive_download_has_sidebar(); ?>

<div class="row">

	<div id="primary" class="content-area <?php echo esc_attr( $main_class ); ?>">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			$count = 1;
			$posts_per_row = get_theme_mod( 'downloads-per-row', 2 );
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			
				// Decide when to start a new row
				if( $count == 1 || $posts_per_row == 1 || $count%$posts_per_row == 1 ) {
					echo '<div class="row">';
					$row_status = 'open';
				}
			
				// Pass the $count parameter to the template part
				set_query_var( 'posts_per_row', $posts_per_row );
				get_template_part( 'template-parts/content-download' );
			
				// Decide when to close a row 
				if( $posts_per_row == 1 || $count%$posts_per_row == 0 ) {
					echo '</div><!-- .row -->';
					$row_status = 'closed';
				}
				
				$count++;
				
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<?php if( $has_sidebar ) {
		get_sidebar( 'edd' );
	} ?>

</div><!-- .row -->

<?php get_footer();
