<?php
/**
 * Singularity functions for the layout
 *
 * @package Singularity
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function singularity_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	if( ! is_user_logged_in() ) {
		$classes[] = 'ctdb-not-logged-in';
	}
	
	$site_layout = get_theme_mod ( 'site-layout', customizer_library_get_default( 'site-layout' ) );
	$classes[] = esc_attr( $site_layout ) . '-layout';
	
	$force_footer = get_theme_mod( 'force-footer-full-width', 0 );
	if( $force_footer && $site_layout == 'boxed' ) {
		$classes[] = 'force-footer-full';
	}
	
	$classes[] = 'singularity-not-scrolling';
	
	// Check for alt logo
	$alt_logo = get_theme_mod( 'alt-logo' );
	if( ! empty( $alt_logo ) ) {
		$classes[] = 'has-alt-logo';
	}
	
	// For single posts
	if( is_single() ) {
		if( 'discussion-topics' == get_post_type() ) {
			$layout = singularity_get_topics_layout();
		} else if( 'download' == get_post_type() ) {
			$layout = singularity_get_single_download_layout();
		} else {
			$layout = singularity_get_post_layout();
		}
		if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
			$sidebar = str_replace( 'sidebar-', '', $layout );
		} else {
			$sidebar = 'none';
		}
		$classes[] = 'single-sidebar-' . esc_attr( $sidebar );
	}
	
	// For archives
	if( is_archive() || is_home() ) {
		if( is_post_type_archive( 'discussion-topics' ) || is_tax( 'board' ) ) {
			$layout = singularity_get_topics_archive_layout();
		} else if( is_post_type_archive( 'downloads' ) || is_tax( 'download_category' ) || is_tax( 'download_tax' ) ) {
			$layout = singularity_get_archive_download_layout();
		} else {
			$layout = singularity_get_archive_layout();
		}
		
		if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
			$sidebar = str_replace( 'sidebar-', '', $layout );
		} else {
			$sidebar = 'none';
		}
		$classes[] = 'archive-sidebar-' . esc_attr( $sidebar );
	}
	
	$header = get_theme_mod ( 'header-layout', 'standard' );
	$classes[] = esc_attr( $header ) . '-header';
	$fixed_header = get_theme_mod ( 'fixed-header', customizer_library_get_default( 'fixed-header' ) );
	if( $fixed_header == 1 ) {
		$classes[] = 'fixed-header';
	}
	$topbar = get_theme_mod ( 'enable-top-bar', customizer_library_get_default( 'enable-top-bar' ) );
	if( $topbar == 1 ) {
		$classes[] = 'has-top-bar';
	}
	
	$sidebar_format = get_theme_mod( 'sidebar-format', 'simple' );
	$classes[] = 'sidebar-format-' . esc_attr( $sidebar_format );
	
	// Featured image
	// Only if we're on a single page or post
	if( has_post_thumbnail() && is_singular() ) {
		$classes[] = 'has-featured-image';
		if( singularity_has_pinned_thumb() ) {
			$classes[] = 'pinned-thumbnail';
			$menu_style = get_theme_mod( 'pinned-menu-style', 'dark' );
			$classes[] = 'pinned-menu-' . esc_attr( $menu_style );
			$classes[]= 'has-pinned-title';
		}
		$pinned_height = get_theme_mod ( 'pinned-thumbnail-height', 'third' );
		$classes[] = 'thumbnail-height-' . esc_attr( $pinned_height );
	}
	
	$center = get_theme_mod( 'center-thumbnail', 1 );
	if( $center ) {
		$classes[] = 'center-thumbnail';
	}
	
	// Footer classes
	$show_full = get_theme_mod ( 'site-footer-full-width', 1 );
	if( ! $show_full ) {
		$classes[] = 'hide-full-width-footer';
	}
	// Footer columns
	$footer_cols = get_theme_mod ( 'site-footer-columns', 4 );
	if( $footer_cols < 1 ) {
		$classes[] = 'hide-footer';
	}
	// Footer reveal
	$footer_reveal = get_theme_mod ( 'footer-reveal', customizer_library_get_default( 'footer-reveal' ) );
	if( $footer_reveal ) {
		$classes[] = 'footer-reveal';
	}
	$show_credits = get_theme_mod ( 'show-credits', customizer_library_get_default( 'show-credits' ) );
	if( ! $show_credits ) {
		$classes[] = 'hide-credits';
	}
	
	
	return $classes;
}
add_filter( 'body_class', 'singularity_body_classes' );

function singularity_logo() {
	// Look for a logo
	$pin_thumb = singularity_has_pinned_thumb();
	$alt_logo = get_theme_mod( 'alt-logo' );
	if( ! empty( $alt_logo ) || has_custom_logo() ) {
		// If we have an alt logo, use it
		printf(
			'<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url"><img src="%2$s" class="custom-logo alt-logo"></a>',
			esc_url( home_url( '/' ) ),
			esc_url( $alt_logo )
		);
		// And now the default custom logo
		the_custom_logo();
	} else {
		// Else, print some boring text
		if ( is_front_page() && is_home() ) { ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php } else { ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
		}
	}

	$hide_tagline = get_theme_mod( 'hide-tagline', 0 );
	$description = get_bloginfo( 'description', 'display' );
	if ( ( $description || is_customize_preview() ) && ! $hide_tagline ) : ?>
		<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
	<?php
	endif;
}

/**
 * Filter the custom logo class
 */
function singularity_filter_custom_logo_class( $html ) {
	$html = str_replace( 'class="custom-logo"', 'class="custom-logo logo"', $html );
	return $html;
}
add_filter( 'get_custom_logo', 'singularity_filter_custom_logo_class' );

/**
 * Filter the excerpt length
 */
function singularity_excerpt_length( $length ) {
	$new_length = get_theme_mod( 'excerpt-length', 20 );
	return absint( $new_length );
}
add_filter( 'excerpt_length', 'singularity_excerpt_length', 999 );

/**
 * Returns whether current page should have a pinned featured image
 * @return Boolean
 */
function singularity_has_pinned_thumb() {
	$pin_thumb_posts = get_theme_mod ( 'pin-thumbnail-posts', customizer_library_get_default( 'pin-thumbnail-posts' ) );
	$pin_thumb_pages = get_theme_mod ( 'pin-thumbnail-pages', customizer_library_get_default( 'pin-thumbnail-pages' ) );
	if( ( 'post' == get_post_type() && is_single() && $pin_thumb_posts == 1 ) || ( is_page() && $pin_thumb_pages == 1 ) ) {
		return true;
	}
	return false;
}


/**
 * Get the sidebar width
 * @return Array
 */
function singularity_get_sidebar_width() {
	$sidebar = get_theme_mod( 'sidebar-width', '25' );
	if( $sidebar == '25' ) {
		$sidebar_class = 'col-large-quarter';
	} else {
		$sidebar_class = 'col-large-one-third';
	}
	return $sidebar_class;
}

/**
 * Get the main content area width
 * @return Array
 */
function singularity_get_content_width() {
	$sidebar = get_theme_mod( 'sidebar-width', '25' );
	if( $sidebar == '25' ) {
		$main_class = 'col-large-three-quarters';
	} else {
		$main_class = 'col-large-two-thirds';
	}
	return $main_class;
}

/**
 * Get the posts archive layout
 */
function singularity_get_archive_layout() {
	$layout = get_theme_mod( 'archive-layout', 'no-sidebar' );
	return esc_attr( $layout );
}

/**
 * Get the single.php layout
 */
function singularity_get_post_layout() {
	$layout = get_theme_mod( 'post-layout', 'narrow' );
	return esc_attr( $layout );
}

/**
 * Get the downloads archive layout
 */
function singularity_get_archive_download_layout() {
	$layout = get_theme_mod( 'archive-download-layout', 'no-sidebar' );
	return esc_attr( $layout );
}

/**
 * Get the single-download.php layout
 */
function singularity_get_single_download_layout() {
	$layout = get_theme_mod( 'single-download-layout', 'narrow' );
	return esc_attr( $layout );
}

/**
 * Get the layout class for the main content area on pages with a sidebar
 */
function singularity_get_page_main_class() {
	$main_class = singularity_get_content_width();
	return $main_class;
}

/**
 * Get the layout class for the main content area on posts
 */
function singularity_get_post_main_class() {
	$layout = singularity_get_post_layout();
	$main_class = singularity_get_main_class( $layout );
	return $main_class;
}

/**
 * Get the layout class for the main content area on single downloads
 */
function singularity_get_single_download_main_class() {
	$layout = singularity_get_single_download_layout();
	$main_class = singularity_get_main_class( $layout );
	return $main_class;
}


/**
 * Get the layout class for the main content area on topics
 */
function singularity_get_topic_main_class() {
	$layout = singularity_get_topics_layout();
	$main_class = singularity_get_main_class( $layout );
	return $main_class;
}

/**
 * Do single posts have a sidebar?
 */
function singularity_post_has_sidebar() {
	$layout = singularity_get_post_layout();
	$has_sidebar = false;

	if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
		// With a sidebar
		$has_sidebar = true;
	}
	
	return $has_sidebar;
}

/**
 * Do single downloads have a sidebar?
 */
function singularity_single_download_has_sidebar() {
	$layout = singularity_get_single_download_layout();
	$has_sidebar = false;

	if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
		// With a sidebar
		$has_sidebar = true;
	}
	
	return $has_sidebar;
}

/**
 * Do single topics have a sidebar?
 */
function singularity_topic_has_sidebar() {
	$layout = singularity_get_topics_layout();
	$has_sidebar = false;

	if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
		// With a sidebar
		$has_sidebar = true;
	}
	
	return $has_sidebar;
}

/**
 * Get the featured image placeholder
 */
function singularity_thumbnail_placeholder() {
	$placeholder_url = get_template_directory_uri() . '/assets/images/placeholder.png';
	echo '<img class="thumbnail-placeholder" src="' . esc_url( $placeholder_url ) . '">';
}

/**
 * Get the layout class for the main content area on standard archive pages
 */
function singularity_get_archive_main_class() {
	$layout = singularity_get_archive_layout();
	$main_class = singularity_get_main_class( $layout );
	return $main_class;
}

/**
 * Get the layout class for the main content area on standard archive pages
 */
function singularity_get_archive_download_main_class() {
	$layout = singularity_get_archive_download_layout();
	$main_class = singularity_get_main_class( $layout );
	return $main_class;
}

/**
 * Get the layout class for the main content area on discussion board archive pages
 */
function singularity_get_topics_archive_main_class() {
	$layout = singularity_get_topics_archive_layout();
	$main_class = singularity_get_main_class( $layout );
	return $main_class;
}

/**
 * Pass in a layout and return a class
 */
function singularity_get_main_class( $layout ) {
	
	if( $layout == 'no-sidebar' ) {
		// No sidebar
		$main_class = 'col col-xsmall-full';
	} else if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
		// With a sidebar
		$main_width = singularity_get_content_width();
		$main_class = 'col col-xsmall-full ' . esc_attr( $main_width );
	} else {
		// No sidebar, narrow layout
		$main_class = 'col col-large-two-thirds center-content';
	}
	
	return $main_class;
}

/**
 * Do archive pages have a sidebar?
 */
function singularity_archive_has_sidebar() {
	$layout = singularity_get_archive_layout();
	$has_sidebar = false;

	if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
		// With a sidebar
		$has_sidebar = true;
	}
	
	return $has_sidebar;
}

/**
 * Do download archive pages have a sidebar?
 */
function singularity_archive_download_has_sidebar() {
	$layout = singularity_get_archive_download_layout();
	$has_sidebar = false;

	if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
		// With a sidebar
		$has_sidebar = true;
	}
	
	return $has_sidebar;
}

/**
 * Do discussion boards archive pages have a sidebar?
 */
function singularity_topics_archive_has_sidebar() {
	$layout = singularity_get_topics_archive_layout();
	$has_sidebar = false;

	if( $layout == 'sidebar-right' || $layout == 'sidebar-left' ) {
		// With a sidebar
		$has_sidebar = true;
	}
	
	return $has_sidebar;
}

function singularity_comment_callback( $comment, $args, $depth ) {
	?>
	<div <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
		<div class="comment-wrapper">
			<div class="comment-meta-wrapper align-items-center">
				<div class="gravatar"><?php echo get_avatar( $comment, 40 ); ?></div>
				<div class="comment-meta" role="complementary">
					<div class="comment-author">
						<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
					</div>
					<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
				</div>
			</div><!-- .comment-meta-wrapper -->
		
			<div class="comment-content post-content" itemprop="text">
				<?php comment_text() ?>
				<?php if ($comment->comment_approved == '0') : ?>
					<p class="comment-meta-item"><?php _e( 'Your comment is awaiting moderation.', 'singularity' ); ?></p>
				<?php endif; ?>
				<?php comment_reply_link(
					array_merge( 
						$args,
						array(
							'add_below' => 'comment',
							'depth' => $depth,
							'max_depth' => $args['max_depth']
						)
					)
				); ?>
				<?php edit_comment_link('<span class="comment-meta-item">' . __( "Edit this comment", "singularity" ) . '</span>','',''); ?>
			</div>
			
		</div><!-- .comment-wrapper -->
		
	
	<?php
}
