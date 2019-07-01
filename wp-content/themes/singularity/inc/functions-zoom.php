<?php
/**
 * Singularity functions for Zoom images
 *
 * @package Singularity
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter images on upload to add data-action
 * @since 1.0.0
 */
if( ! function_exists( 'singularity_zoom_image_tag' ) ) {
	function singularity_zoom_image_tag( $html, $id, $alt, $title ) {
		$html = str_replace( '<img ', '<img data-action="zoom" ', $html );
		return $html;
	}
}
add_filter( 'get_image_tag', 'singularity_zoom_image_tag', 0, 4 );