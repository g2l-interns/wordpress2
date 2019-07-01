<?php
/**
 * Standard Header
 *
 * @package Singularity
 */
?>

<?php
$class = 'row';
// Have we selected to vertically center the header elements?
$vcenter = get_theme_mod( 'v-center-header', 1 );
if( $vcenter ) {
	$class .= ' align-items-center';
}	
?>

<div class="<?php echo $class; ?>">
	<div class="site-branding col col-xsmall-half col-large-one-third">
		<?php echo singularity_logo(); ?>
	</div><!-- .site-branding -->

	<div class="col col-xsmall-half col-large-two-thirds pull-right">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'singularity' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</div>
</div><!-- .row -->