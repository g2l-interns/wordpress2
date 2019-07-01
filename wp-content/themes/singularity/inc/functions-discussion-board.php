<?php
/**
 * Singularity functions for Discussion Board
 *
 * @package Singularity
 */

/**
 * Get the single-discussion-topics.php layout
 */
function singularity_get_topics_layout() {
	$layout = get_theme_mod( 'topic_template', 'no-sidebar' );
	return esc_attr( $layout );
}

/**
 * Get the archive-discussion-topics.php layout
 */
function singularity_get_topics_archive_layout() {
	$layout = get_theme_mod( 'topic_archive_template', 'no-sidebar' );
	return esc_attr( $layout );
}

/**
 * Filter the archive title if the post type is discussion-topics
 */
function singularity_filter_topics_archive_title( $title ) {
	if( 'discussion-topics' == get_post_type() ) {
		// Get the discussion topics post object
		$post_type = get_post_type_object( 'discussion-topics' );
		// Then get the label, just in case it's been changed somehow
		$title = $post_type->label;
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'singularity_filter_topics_archive_title' );

// We remove some filters in order to restructure the meta data in the single topics template
global $CT_DB_Skins;
// Remove date
remove_filter( 'ctdb_info_meta_after_classic_meta', array( $CT_DB_Skins, 'topic_date_classic' ) );

if( ! function_exists( 'singularity_ctdb_author_meta' ) ) {
	function singularity_ctdb_author_meta( $output, $author ) {
	
		$avatar = get_avatar( get_the_author_meta( 'ID' ), 40 );
		$posted_on = ctdb_topic_date_time();
	
		$return = '<div class="entry-meta-wrapper align-items-center">
			<div class="gravatar">' . $avatar . '</div>
			<div class="entry-meta" role="complementary">
				<div class="post-author">' . $author . '</div>
				<div class="entry-meta-item">' . $posted_on . '</div>
			</div>';
		$return .= sprintf( '<span class="edit-link ctdb-edit-link "><a href="%s">%s</a></span>', get_edit_post_link(),  __( 'Edit', 'singularity' ) );
		$return .= '</div><!-- .entry-meta-wrapper -->';
	
		return $return;
	
	}
}
add_filter( 'ctdb_info_bar_table', 'singularity_ctdb_author_meta', 10, 2 );

if( ! function_exists( 'singularity_discussion_topic_meta' ) ) {
	function singularity_discussion_topic_meta() {
		$avatar = get_avatar( get_the_author_meta( 'ID' ), 40 );
		$posted_on = ctdb_topic_date_time();
	
		$return = '<div class="entry-meta-wrapper align-items-center">
			<div class="gravatar">' . $avatar . '</div>
			<div class="entry-meta" role="complementary">
				<div class="post-author">' . $author . '</div>
				<div class="entry-meta-item">' . $posted_on . '</div>
			</div>';
		$return .= sprintf( '<span class="edit-link ctdb-edit-link "><a href="%s">%s</a></span>', get_edit_post_link(),  __( 'Edit', 'singularity' ) );
		$return .= '</div><!-- .entry-meta-wrapper -->';
	
		return $return;
	}
}


/**
 * Filter comment text for Discussion Board
 */
if ( ! function_exists ( 'singularity_ctdb_classic_forum_comment' ) ) {
	function singularity_ctdb_classic_forum_comment( $comment_html, $comment, $args, $depth ) {
		
		$avatar = get_avatar( $comment, 40 );
		$comment_date = sprintf( __( '%1$s at %2$s', 'singularity' ), get_comment_date( '', $comment ), get_comment_time() );
		$author = get_comment_author_link( $comment );
		
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		
		// Build the comment HTML
		$classes = get_comment_class( empty( $args['has_children']) ? 'parent' : '', $comment );
		$comment_html = '<article id="comment-' . get_comment_ID() . '" class="' . esc_attr( join( ' ', $classes ) ) . '" itemprop="comment" itemscope itemtype="http://schema.org/Comment">';	
			$comment_html .= '<header class="comment-header">';
				$comment_html .= '<div class="comment-metadata entry-meta-wrapper align-items-center">';
					$comment_html .= '<div class="gravatar">' . $avatar . '</div>';
					$comment_html .= '<div class="entry-meta" role="complementary">';
						$comment_html .= '<div class="post-author">' . $author . '</div>';
						$comment_html .= '<div class="entry-meta-item">' . $comment_date . '</div>';
					$comment_html .= '</div>';
				$comment_html .= '</div><!-- .entry-meta-wrapper -->';
			$comment_html .= sprintf( '<span class="edit-link ctdb-edit-link"><a href="%s">%s</a></span>', get_edit_comment_link(),  __( 'Edit', 'singularity' ) );
			$comment_html .= '</header>';

			$comment_html .= '<div class="comment-content">';		
				$comment_html .= wpautop( get_comment_text() );		
				if ( '0' == $comment->comment_approved ) {
					$comment_html .= '<p class="comment-awaiting-moderation">' . __( 'Your comment is awaiting moderation.', 'singularity' ) . '</p>';
				}
				$comment_html .= get_comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<span class="reply ctdb-reply">',
					'after'     => '</span>'
				) ) );
			$comment_html .= '</div><!-- .comment-content -->';
		// WordPress should automatically close the open tag
		// $comment_html .= '</article><!-- .comment-body -->';
		
		echo $comment_html;
	}
}
add_filter( 'ctdb_filter_comment_html', 'singularity_ctdb_classic_forum_comment', 10, 4 );

// Move breadcrumb to above the content area
remove_action( 'ctdb_do_breadcrumb', 'ctdb_breadcrumb_navigation' );
add_action( 'singularity_ctdb_do_breadcrumb', 'ctdb_breadcrumb_navigation' );

/**
 * Display board taxonomy description, image and meta
 */
if( ! function_exists( 'singularity_ctdb_board_description' ) ) {
	function singularity_ctdb_board_description() {
		$term = get_term_by( 'slug', get_query_var('term'), get_query_var( 'taxonomy' ) );
		$image_id = get_term_meta( $term->term_id, 'ctdb-board-image-id', true ); ?>
		<div class="board-description-wrapper">
			<?php if( $image_id ) { ?>
			<div class="board-description-image">
				<?php echo wp_get_attachment_image( $image_id ); ?>
			</div>
			<?php } ?>
			<div class="board-description-meta">
				<?php the_archive_description( '<div class="archive-description">', '</div>' );
				$options = get_option( 'ctdb_boards_settings' );
				$fields = array();
				if( isset( $options['boards_fields'] ) ) {
					$fields = $options['boards_fields'];
				}
		
				// Get list of all available fields
				$all_fields = ctdb_boards_fields();
		
				// Iterate through selected fields
				if( ! empty( $fields ) && ! empty( $all_fields ) ) {
					foreach( $fields as $field ) {

						// If the field is available, add the content
						if( isset( $all_fields[$field]['callback'] ) && function_exists( $all_fields[$field]['callback'] ) ) {
							echo '<div class="ctdb-board-meta-inner ctdb-board-meta-' . esc_attr( $field ) . '">';
								$label = $all_fields[$field]['label'];
								echo call_user_func( $all_fields[$field]['callback'], $term, $term->term_id, $label );
							echo '</div>';
						}
				
					}
				}
				?>
			</div>
		</div>
	<?php }
}

/**
 * Filter the board header and meta
 */
if( ! function_exists( 'singularity_ctdb_filter_board_header' ) ) {
	function singularity_ctdb_filter_board_header( $content, $term, $board_id, $fields, $all_fields ) {
		$new_content = '';
	
		$new_content .= '<div class="ctdb-board-wrapper">';
		if( $term->name ) {
			$new_content .= '<div class="">';
			
				if( ctdb_is_user_permitted() == true && $term->count > 0 ) {
					// Site title and link
					$new_content .= sprintf( '<h2 class="%s"><a href="%s">%s</a></h2>',
						esc_attr( 'board-title' ),
						esc_url( get_term_link( $board_id ) ),
						esc_textarea( $term->name ) 
					);
				} else {
					// Site title only if no topics exist yet or user is not permitted
					$new_content .= sprintf( '<h2 class="%s">%s</h2>',
						esc_attr( 'board-title' ),
						esc_textarea( $term->name ) 
					);
				}

			$new_content .= '</div><!-- ctdb-board-header -->';
		}
	
		$new_content .= '<div class="board-description-wrapper">';
			$new_content .= '<div class="board-description-image">';
				$image_id = get_term_meta( $term->term_id, 'ctdb-board-image-id', true );
				$new_content .= wp_get_attachment_image( $image_id );
			//	$content .= wpautop( $term->description );
			$new_content .= '</div><!-- board-description-image -->';
		
			$new_content .= '<div class="board-description-meta">';
		
			$new_content .= wpautop( $term->description );
		
				// Iterate through selected fields
				if( ! empty( $fields ) && ! empty( $all_fields ) ) {
				
					foreach( $fields as $field ) {
			
						// If the field is available, add the content
						if( isset( $all_fields[$field]['callback'] ) && function_exists( $all_fields[$field]['callback'] ) ) {
							$new_content .= '<div class="ctdb-board-meta-inner ctdb-board-meta-' . esc_attr( $field ) . '">';
								$label = $all_fields[$field]['label'];
								$new_content .= call_user_func( $all_fields[$field]['callback'], $term, $term->term_id, $label );
							$new_content .= '</div>';
						}
				
					}
				}
			$new_content .= '</div><!-- .board-description-meta -->';
		$new_content .= '</div><!-- .board-description-wrapper -->';
	
		$new_content .= '</div><!-- .ctdb-board-wrapper -->';
	
		return $new_content;
	}
}
add_filter( 'ctdb_filter_board_header', 'singularity_ctdb_filter_board_header', 10, 5 );

/**
 * Filter the titles in the discussion_board shortcode
 */
if( ! function_exists( 'singularity_ctdb_filter_topic_title_fields' ) ) {
	function singularity_ctdb_filter_topic_title_fields( $title_fields, $cols ) {
		
		$count_cols = count( $cols );
		$field_titles = ctdb_meta_data_fields();
		
		if( ! empty( $cols ) && is_array( $cols ) ) {
			foreach( $cols as $col ) {
				if( isset( $field_titles[$col] ) ) {
					$title_fields[$col] = '<div class="singularity-ctdb-archive-col"><strong>' . $field_titles[$col] . '</strong></div>';
				}
				
			}
		}
		
		return $title_fields;
	}
}
add_filter( 'ctdb_topic_title_fields', 'singularity_ctdb_filter_topic_title_fields', 10, 2 );

/**
 * Redo query that lists each topic in classic layout view
 * @param $output		Initial value, should be empty
 * @param $topics 		wp_query object
 * @param $titles		Selected column titles
 * @param $cols			Which columns to include
 */
if( ! function_exists( 'singularity_ctdb_filter_table_layout' ) ) {
	function singularity_ctdb_filter_table_layout( $output, $topics, $titles, $cols ) {
		
		// Fields enabled on the DB Design tab
		$cols = ctdb_selected_meta_fields();
		$count_cols = count( $cols );
		
		// Only some columns are allowed
		// E.g. freshness is added under topic title with name of poster
		$permitted_cols = array(
			'replies', 'voices', 'status'
		);
		
		// Column headings
		$field_titles = ctdb_meta_data_fields();
		
		// Create the titles
		$output = '<div class="singularity-ctdb-archive-titles-wrap cols-' . esc_attr( $count_cols ) . '">';
		$output .= '<div class="singularity-ctdb-archive-avatar"></div>';
		$output .= '<div class="singularity-ctdb-archive-title"></div>';
			
			if( ! empty( $cols ) && is_array( $cols ) ) {
				foreach( $cols as $col ) {
					if( in_array( $col, $permitted_cols ) ) {
						$output .= '<div class="singularity-ctdb-archive-col"><strong>' . $field_titles[$col] . '</strong></div>';
					}
				}
			}
		$output .= '</div><!-- .ctdb-archive-titles-wrap -->';
		// Pass these variables into the template part
		set_query_var( 'cols', $cols );
		set_query_var( 'count_cols', $count_cols );
		set_query_var( 'field_titles', $field_titles );
		while( $topics->have_posts() ) : $topics->the_post();
			ob_start();
			get_template_part( 'template-parts/content-discussion-topic' );
			$output .= ob_get_clean();
		endwhile;
		
		return $output;
	}
}
add_filter( 'ctdb_filter_table_layout', 'singularity_ctdb_filter_table_layout', 10, 4 );

/**
 * Create footer content for discussion_board shortcode
 * @param $footer		Initial value, should be empty
 * @param $board_id 	The ID of the board being queried
 * @param $term			Taxonomy term
 */
if( ! function_exists( 'singularity_ctdb_filter_board_footer' ) ) {
	function singularity_ctdb_filter_board_footer( $footer, $board_id, $term ) {
		
		$footer = '<div class="ctdb-board-topics-link">';
		
			if( $term->count > 0 ) {
				// Only add the link if there are topics in the term
				$footer .= sprintf( '<span class="ctdb-board-topics-link-inner"><a class="button secondary" href="%s">%s</a></span>',
					esc_url( get_term_link( $board_id ) ), 
					__( 'See all topics', 'singularity' )
				);
			}				
		
			// Get the page with the new topic form
			$options = get_option( 'ctdb_options_settings' );
			if( isset( $options['new_topic_page'] ) && $options['new_topic_page'] != '' ) {
				$new_topic_page = intval( $options['new_topic_page'] );
				$footer .= sprintf( '<span class="button ctdb-board-topics-link-inner"><a class="button secondary" href="%s">%s</a></span>',
					esc_url( add_query_arg(
						array(
							'board_id' => $board_id
						), get_permalink( $new_topic_page ) )
					), 
					__( 'Add new topic', 'singularity' )
				);
			
			} else if( current_user_can( 'update_plugins' ) ) {
				// Display a message to admins that there's no topic page set
				// Show admin a message to let them know
				$footer .= '<p class="ctdb-admin-message">' . __( 'Site Admin: please set the "New topic form page" field in Settings > Discussion Board > General for the new_topic_button shortcode to work. This message will not be displayed to non-admins.', 'singularity' ) . '</p>';
			}
			
			// Add a follow board option if enabled
			$follower_options = get_option( 'ctdb_followers_settings' );
			if( ! empty( $follower_options['enable_board_following'] ) && is_user_logged_in() ) {
				// Is the user following this board?
				$is_following = ctdb_is_following_board( $board_id );
				$footer .= '<span class="ctdb-board-topics-link-inner">';
				if( $is_following ) {
					$footer .= sprintf( '<a id="ctdb-follow-board-%s" class="button secondary ctdb-follow-board" data-board="%s" data-action="unfollow" href="#">%s</a>',
						absint( $board_id ),
						absint( $board_id ),
						ctdb_get_unfollow_this_board_message()
					);
				} else {
					$footer .= sprintf( '<a id="ctdb-follow-board-%s" class="button secondary ctdb-follow-board" data-board="%s" data-action="follow" href="#">%s</a>',
						absint( $board_id ),
						absint( $board_id ),
						ctdb_get_follow_this_board_message()
					);
				}
				$footer .= wp_nonce_field( 'board_follow_nonce_' . absint( $board_id ), 'board_follow_nonce_' . absint( $board_id ), true, false );
				$footer .= '</span><!-- .ctdb-board-topics-link-inner -->';
				
			}
		
		$footer .= '</div><!-- .ctdb-board-topics-link -->';
		
		return $footer;
		
	}
}
add_filter( 'ctdb_filter_board_footer', 'singularity_ctdb_filter_board_footer', 10, 3 );

/**
 * Filter the sidebar on pages if the page is a Discussion Board page
 */
if( ! function_exists( 'singularity_filter_discussion_board_sidebar' ) ) {
	function singularity_filter_discussion_board_sidebar( $sidebar ) {
		$post_id = get_the_ID();
		// Check if page is one of our Discussion Board pages
		$options = get_option( 'ctdb_options_settings' );
		$check_pages = array(
			'new_topic_page', // New Topic Page
			'discussion_topics_page', // Topics Page
			'frontend_login_page', // Login Page
			'board_page',
		);
		$db_pages = array(); // Add to our list of pages to filter sidebar on
		foreach( $check_pages as $check_page ) {
			if( isset( $options[$check_page] ) ) {
				$db_pages[] = $options[$check_page];
			}
		}
		if( is_array( $db_pages ) && in_array( $post_id, $db_pages ) ) {
			// If the current page is one of our Discussion Board pages, switch to different sidebar
			$sidebar = 'discussion-board';
		}
		
		return $sidebar;
	}
}
add_filter( 'singularity_filter_page_sidebar_right', 'singularity_filter_discussion_board_sidebar' );
