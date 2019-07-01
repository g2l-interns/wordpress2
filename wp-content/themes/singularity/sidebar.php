<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Singularity
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
$sidebar_width = singularity_get_sidebar_width(); ?>

<aside id="secondary" class="widget-area col col-xsmall-full <?php echo esc_attr( $sidebar_width ); ?>" role="complementary">
	<?php $sidebar = apply_filters( 'singularity_filter_sidebar_name', 'sidebar-1' ); ?>
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->