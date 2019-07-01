<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Singularity
 */

if ( ! is_active_sidebar( 'sidebar-discussion-board' ) ) {
	return;
}
$sidebar_width = singularity_get_sidebar_width(); ?>

<aside id="secondary" class="widget-area col col-xsmall-full <?php echo esc_attr( $sidebar_width ); ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-discussion-board' ); ?>
</aside><!-- #secondary -->
