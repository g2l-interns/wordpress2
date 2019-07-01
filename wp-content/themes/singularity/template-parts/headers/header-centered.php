<?php
/**
 * Standard Header
 *
 * @package Singularity
 */

?>

<div class="row align-items-center">
	<div class="site-branding col col-xsmall-half col-large-full justify-content-center-large">
		<?php echo singularity_logo(); ?>
	</div><!-- .site-branding -->

	<div class="col col-xsmall-half col-large-full justify-content-center-large">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'singularity' ); ?></button>
			<?php wp_nav_menu( 
				array( 
					'theme_location' 	=> 'menu-1',
					'menu_id' 			=> 'primary-menu',
					'menu_class'		=> 'flex justify-content-center' )
				); ?>
		</nav><!-- #site-navigation -->
	</div>
</div><!-- .row -->