<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Singularity
 */

?>

	</div><!-- #content -->

	<?php $enable_full_width = get_theme_mod( 'full-width-footer', 1 ); ?>
	<?php $footer_cols = get_theme_mod( 'footer-columns', 4 ); ?>
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		
			<?php if( $enable_full_width ) { ?>
			<div class="site-footer-full-width">
				<div class="site-footer-inner">
					<div class="site-footer-full-width-inner"></div>
					<div class="row">
						<div class="col col-xsmall-full">
							<?php dynamic_sidebar( 'footer-full-width' ); ?>
						</div>
					</div>
				</div><!-- .site-footer-inner -->
			</div><!-- .site-footer-full-width -->
			<?php } ?>
		
			<?php if( $footer_cols >= 1 ) { ?>
			<div class="site-footer-columns">
				<div class="site-footer-inner">
					<div class="site-footer-columns-inner"></div>
					<div class="row">
						<?php // How many footer columns?
						for( $i = 1; $i <= absint( $footer_cols ); $i++ ) { ?>
							<div class="col col-xsmall-full col-small-half col-large-equal">
								<?php dynamic_sidebar( 'footer-' . $i ); ?>
							</div>
						<?php } ?>
					</div>
				</div><!-- .site-footer-inner -->
			</div><!-- .site-footer-columns -->
			<?php } ?>
		
			<div class="site-info col">
				<?php $text = get_theme_mod( 'credits-text', customizer_library_get_default( 'credits-text' ) ); ?>
				<?php $url = get_theme_mod( 'credits-url', customizer_library_get_default( 'credits-url' ) ); ?>
				<?php $credit = apply_filters( 
					'theme_credit_filter',
					sprintf( '<a href="%s">%s</a>',
						esc_url( $url ),
						esc_html( $text )
					) );
				echo $credit; ?>
			</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<div class="loader">
	<div class="spinner">
		<div class="double-bounce1"></div>
		<div class="double-bounce2"></div>
	</div>
</div>

<div class="mobile-menu-wrapper">
	<div class="clear">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="dashicons dashicons-arrow-left-alt"></span> <?php esc_html_e( 'Close', 'singularity' ); ?></button>
	</div>
	<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_id' => 'mobile-menu' ) ); ?>
	<?php dynamic_sidebar( 'mobile-menu-footer' ); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
