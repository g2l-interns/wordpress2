<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Singularity
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'singularity' ); ?></a>
	<div class="site-header-filler"></div>
	<?php
	/**
	 * Are we using a pinnned image?
	 * @since 1.0.0
	 */
	if( has_post_thumbnail() && singularity_has_pinned_thumb() ) {
		get_template_part( 'template-parts/headers/pinned', 'thumbnail' );
	} ?>
	<header id="masthead" class="site-header" role="banner">
		<?php
		/**
		 * Are we using a top bar?
		 * @since 1.1.0
		 */
		$header = get_theme_mod ( 'header-layout', customizer_library_get_default( 'header-layout' ) );
		$topbar = get_theme_mod ( 'enable-top-bar', customizer_library_get_default( 'enable-top-bar' ) );
		if( $topbar == 1 ) {
			get_template_part( 'template-parts/headers/top-bar', esc_attr( $header ) );
		}
		/**
		 * Which header are we using?
		 * @since 1.0.0
		 */
		get_template_part( 'template-parts/headers/header', esc_attr( $header ) );
		?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
