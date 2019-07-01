<?php
/**
 * Singularity functions for Gridgets plugin
 *
 * @package Singularity
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter the gridgets inner wrapper to use our own wrapper classes
 * @since 1.0.0
 */
function singularity_filter_gridget_inner_classes( $inner_classes=array(), $container_classes=array(), $classes=array() ) {
	return $inner_classes;
}
add_filter( 'gridget_inner_classes', 'singularity_filter_gridget_inner_classes', 10, 3 );