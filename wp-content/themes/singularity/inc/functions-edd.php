<?php
/**
 * Singularity functions for EDD
 *
 * @package Singularity
 */

/**
 * Filter the archive title if the post type is downloads
 */
if( ! function_exists( 'singularity_filter_downloads_archive_title' ) ) {
	function singularity_filter_downloads_archive_title( $title ) {
		if( 'download' == get_post_type() ) {
			// Get the download post object
			$post_type = get_post_type_object( 'download' );
			// Then get the label, just in case it's been changed somehow
			$title = $post_type->label;
		}
		return $title;
	}
}
add_filter( 'get_the_archive_title', 'singularity_filter_downloads_archive_title' );

/**
 * Filter the archive title if the post type is downloads
 */
if( ! function_exists( 'singularity_edd_meta' ) ) {
	function singularity_edd_meta() {
		$download_id = get_the_ID();
		// If the download has variable prices
		if( edd_has_variable_prices( $download_id ) ) {
			echo edd_price_range( $download_id );
		} else {
			edd_price( $download_id );
		}
		
	}
}

/**
 * Prints HTML with meta information for download categories.
 */
if( ! function_exists( 'singularity_edd_categories' ) ) {
	function singularity_edd_categories() {
		/* translators: used between list items, there is a space after the comma */
		$download_id = get_the_ID();
		$terms = get_the_terms( $download_id, 'download_category' );
		$term_list = array();
		if ( $terms ) {
			foreach( $terms as $term ) {
				$term_list[] = sprintf( '<a href="%1$s">%2$s</a>',
					esc_url( get_term_link( $term->slug, 'download_category' ) ),
					esc_html( $term->name )
				);
			}
			printf( '<p class="cat-links">' . join( '', $term_list ) . '</p>' ); // WPCS: XSS OK.
		}
	}
}

/**
 * Filter the view demo link in the advanced product details widget
 */
if( ! function_exists( 'singularity_filter_demo_link_class' ) ) {
	function singularity_filter_demo_link_class( $class ) {
		$class[] = 'button';
		$class[] = 'secondary';
		return $class;
	}
}
add_filter('ct_apdw_filter_demo_link_class', 'singularity_filter_demo_link_class' );

/**
 * Filter the category label in the advanced product details widget
 */
if( ! function_exists( 'singularity_filter_category_label' ) ) {
	function singularity_filter_category_label( $category_label ) {
		return '';
	}
}
add_filter('ct_apdw_filter_category_label', 'singularity_filter_category_label' );

/**
 * Filter the tag label in the advanced product details widget
 */
if( ! function_exists( 'singularity_filter_tag_label' ) ) {
	function singularity_filter_tag_label( $tag_label ) {
		return '';
	}
}
add_filter('ct_apdw_filter_tag_label', 'singularity_filter_tag_label' );

/**
 * Filter the category separator in the advanced product details widget
 */
if( ! function_exists( 'singularity_filter_category_separator' ) ) {
	function singularity_filter_category_separator( $category_separator ) {
		return ' / ';
	}
}
add_filter('ct_apdw_filter_category_separator', 'singularity_filter_category_separator' );

/**
 * Filter the tag separator in the advanced product details widget
 */
if( ! function_exists( 'singularity_filter_tag_separator' ) ) {
	function singularity_filter_tag_separator( $tag_separator ) {
		return ' / ';
	}
}
add_filter('ct_apdw_filter_tag_separator', 'singularity_filter_tag_separator' );