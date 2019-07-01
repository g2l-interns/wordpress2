<?php
/**
 * The pinned thumbnail in the header
 *
 * @package Singularity
 */

?>
<div class="featured-image-wrapper" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( '', 'full' ) ); ?>)">
	<div class="featured-image-overlay"></div>
	<?php $pin_title = get_theme_mod( 'pin-title', 0 );
	if( $pin_title ) {
		echo '<div class="pinned-title">';
		// Display the title
		printf(
			'<h1>%s</h1>',
			get_the_title()
		);
		$pin_excerpt = get_theme_mod( 'pin-excerpt', 0 );
		// Display the excerpt if available
		if( $pin_excerpt && get_the_excerpt() ) {
			printf(
				'<p class="pinned-excerpt">%s</p>',
				get_the_excerpt()
			);
		}
		echo '</div><!-- .pinned-title -->';
	}
	?>
</div>