<?php
/**
 * Standard Top Bar
 *
 * @package Singularity
 */

?>

<div id="top-bar" class="top-bar-standard">
	<div class="row">
		<div class="col col-xsmall-full col-large-half justify-content-center">
			<?php dynamic_sidebar( 'top-bar-1' ); ?>
		</div><!-- .site-branding -->
		<div class="col col-xsmall-full col-large-half justify-content-center pull-right">
			<?php dynamic_sidebar( 'top-bar-2' ); ?>
		</div><!-- .site-branding -->
	</div><!-- .row -->
</div><!-- #top-bar -->