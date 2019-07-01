<?php
/**
 * Singularity functions for the homepage template
 *
 * @package Singularity
 */

/**
 * Iterate through each homepage section and add the content
 */
if( ! function_exists( 'singularity_get_home_sections' ) ) {
	function singularity_get_home_sections() {
		for( $i=1; $i<=6; $i++ ) {
			$title = get_theme_mod( 'home-section-' . $i . '-title' );
			$content = get_theme_mod( 'home-section-' . $i . '-content' );
			
			if( ! empty( $title ) || ! empty( $content ) ) {
				// Open section wrapper
				echo '<div class="homepage-section-wrapper homepage-section-' . esc_attr( $content ) . '">';
			}
			if( ! empty( $title ) ) {
				printf( '<h2>%s</h2>', esc_html( $title ) );
			}
			
			if( ! empty( $content ) ) {
				if( $content == 'content' ) {
					the_content();
				} else if( $content == 'blog' ) {
					$posts = get_theme_mod( 'home-blog-posts', 3 );
					singularity_get_recent_posts( $posts );
				} else if( $content == 'widget-1' ) {
					if ( is_active_sidebar( 'home-1' ) ) {
						dynamic_sidebar( 'home-1' );
					}
				} else if( $content == 'widget-2' ) {
					if ( is_active_sidebar( 'home-2' ) ) {
						dynamic_sidebar( 'home-2' );
					}
				} else if( $content == 'downloads' ) {
					$downloads = get_theme_mod( 'home-number-downloads', 3 );
					singularity_get_recent_downloads( $downloads );
				} else if( $content == 'pages' ) {
					singularity_get_featured_pages();
				} else if( $content == 'topics' ) {
					singularity_get_homepage_topics();
				}
			}
			
			if( ! empty( $title ) || ! empty( $content ) ) {
				// Close section wrapper
				echo '</div><!-- .homepage-section-wrapper -->';
			}
		}
	}
}

/**
 * Print specified number of blog posts for homepage
 * @param $posts	Number of posts to query
 */
if( ! function_exists( 'singularity_get_recent_posts' ) ) {
	function singularity_get_recent_posts( $number_posts=3 ) {
		
		$args = array(
			'posts_per_page'	=> $number_posts
		);
		$posts = new WP_Query( $args );
		/* Start the Loop */
		if ( $posts->have_posts() ) {
			echo '<div class="row">';
			while ( $posts->have_posts() ) : $posts->the_post();
				$count = 1;
				// Pass the $count parameter to the template part
				set_query_var( 'count', $count );
				set_query_var( 'posts_per_row', $number_posts );
				get_template_part( 'template-parts/content' );
				$count++;
			endwhile;
			echo '</div>';
		}
		wp_reset_query();
		
	}
}

/**
 * Print specified number of downloads for homepage
 * @param $posts	Number of downloads to query
 */
if( ! function_exists( 'singularity_get_recent_downloads' ) ) {
	function singularity_get_recent_downloads( $number_downloads=3 ) {
		if( ! class_exists( 'Easy_Digital_Downloads' ) ) {
			return;
		}
		$args = array(
			'posts_per_page'	=> $number_downloads,
			'post_type'			=> 'download'
		);
		$posts = new WP_Query( $args );
		/* Start the Loop */
		if ( $posts->have_posts() ) {
			// Specify if this is the only download displayed so that we can format it differently
			$class = '';
			if( $number_downloads == 1 ) {
				$class = 'is-single-element';
			}
			echo '<div class="row ' . $class . '">';
			while ( $posts->have_posts() ) : $posts->the_post();
				$count = 1;
				// Pass the $count parameter to the template part
				set_query_var( 'count', $count );
				set_query_var( 'posts_per_row', $number_downloads );
				get_template_part( 'template-parts/content-download' );
				$count++;
			endwhile;
			echo '</div>';
		}
		wp_reset_query();
		
	}
}

/**
 * Print specified number of topics for homepage
 * @param $number_topics	Number of downloads to query
 */
if( ! function_exists( 'singularity_get_homepage_topics' ) ) {
	function singularity_get_homepage_topics( $number_topics=3 ) {
		if( ! class_exists( 'CT_DB_Public' ) ) {
			return;
		}
		$args = array(
			'posts_per_page'	=> $number_topics,
			'post_type'			=> 'discussion-topics'
		);
		$posts = new WP_Query( $args );
		/* Start the Loop */
		if ( $posts->have_posts() ) {
			
			// Fields enabled on the DB Design tab
			$cols = ctdb_selected_meta_fields();
			$count_cols = count( $cols );
		
			// Column headings
			$field_titles = ctdb_meta_data_fields();
			
			// Create the titles
			echo '<div class="singularity-ctdb-archive-titles-wrap cols-' . esc_attr( $count_cols ) . '">';
			echo '<div class="singularity-ctdb-archive-avatar"></div>';
			echo '<div class="singularity-ctdb-archive-title"></div>';
			if( ! empty( $cols ) && is_array( $cols ) ) {
				foreach( $cols as $col ) {
					if( in_array( $col, array( 'replies', 'voices', 'status' ) ) ) {
						echo '<div class="singularity-ctdb-archive-col"><strong>' . $field_titles[$col] . '</strong></div>';
					}
				}
			}
			echo '</div><!-- .ctdb-archive-titles-wrap -->';
			while ( $posts->have_posts() ) : $posts->the_post();
				// Pass these variables into the template part
				set_query_var( 'cols', $cols );
				set_query_var( 'count_cols', $count_cols );
				set_query_var( 'field_titles', $field_titles );
				get_template_part( 'template-parts/content-discussion-topic' );
			endwhile;
			
		}
		
		wp_reset_query();
		
	}
}

/**
 * Print featured pages for homepage
 */
if( ! function_exists( 'singularity_get_featured_pages' ) ) {
	function singularity_get_featured_pages() {
		
		// Count how many pages
		$number_pages = 0;
		$pages = array();
		for( $i=1; $i<=4; $i++ ) {
			$page = get_theme_mod( 'home-featured-page-' . $i );
			if( ! empty( $page ) ) {
				$number_pages++;
				// Add page ID to array to use in query next
				$pages[] = $page;
			}
		}
		if( $number_pages > 0 ) {
			$args = array(
				'post_type'	=> 'page',
				'post__in' 	=> $pages
			);
			$query = new WP_Query( $args );
			/* Start the Loop */
			if ( $query->have_posts() ) {
				// Specify if this is the only download displayed so that we can format it differently
				$class = '';
				if( $number_pages == 1 ) {
					$class = 'is-single-element';
				}
				echo '<div class="row ' . $class . '">';
				$count = 1;
				while ( $query->have_posts() ) : $query->the_post();
					// Pass the $count parameter to the template part
					set_query_var( 'count', $count );
					set_query_var( 'posts_per_row', $number_pages );
					get_template_part( 'template-parts/content-featured' );
					$count++;
				endwhile;
				echo '</div>';
			}
			wp_reset_query();
		}
		
	}
}
