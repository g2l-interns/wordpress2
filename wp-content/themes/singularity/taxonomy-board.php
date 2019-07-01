<?php
/**
 * The template part for displaying board taxonomy pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */

get_header();

// What layout are we using?
$main_class = singularity_get_topics_archive_main_class();
$has_sidebar = singularity_topics_archive_has_sidebar(); ?>

<div class="row">

	<div id="primary" class="content-area <?php echo esc_attr( $main_class ); ?>">
		
		<?php do_action( 'singularity_ctdb_do_breadcrumb' ); ?>
		
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) { ?>

			<header class="page-header">
				<?php
				printf( '<h1 class="page-title">%s</h1>', single_term_title( '', false ) );
				singularity_ctdb_board_description(); ?>
			</header><!-- .page-header -->

			<?php
			// If ctdb_selected_meta_fields doesn't exist, the Discussion Board plugin isn't enabled so don't print anything
			if( function_exists( 'ctdb_selected_meta_fields' ) ) {
				
				// Fields enabled on the DB Design tab
				$cols = ctdb_selected_meta_fields();
				$count_cols = count( $cols );
				
				// Column headings
				$field_titles = ctdb_meta_data_fields();
				
				// Only some columns are allowed
				// E.g. freshness is added under topic title with name of poster
				$permitted_cols = array(
					'replies', 'voices', 'status'
				);
				
				// Create the titles
				?>
				<div class="singularity-ctdb-archive-titles-wrap cols-<?php echo esc_attr( $count_cols ); ?>">
					<div class="singularity-ctdb-archive-avatar"></div>
					<div class="singularity-ctdb-archive-title"></div>
					<?php
					if( ! empty( $cols ) && is_array( $cols ) ) {
						foreach( $cols as $col ) {
							if( in_array( $col, $permitted_cols ) ) {
					 ?>
							<div class="singularity-ctdb-archive-col"><strong><?php echo $field_titles[$col]; ?></strong></div>
						<?php }
						}
					} ?>
				</div><!-- .ctdb-archive-titles-wrap -->
				<?php
				// Pass these variables into the template part
				set_query_var( 'cols', $cols );
				set_query_var( 'count_cols', $count_cols );
				set_query_var( 'field_titles', $field_titles );
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					
					get_template_part( 'template-parts/content-discussion-topic' );
				
				endwhile;
				
				// Add some buttons
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				echo singularity_ctdb_filter_board_footer( '', $term->term_id, $term );
				
				$args = array(
					'prev_text'	=> __( 'Older topics', 'singularity' ),
					'next_text'	=> __( 'Newer topics', 'singularity' ),
				);
				the_posts_navigation( $args );
				
			}
			
		} else {

			get_template_part( 'template-parts/content', 'none' );

		} ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<?php if( $has_sidebar ) {
		get_sidebar( 'discussion-board' );
	} ?>
	
	
	
</div><!-- .row -->

<?php get_footer();
