<?php
/**
 * Template part for displaying the post author bio
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */

?>
<div class="author-bio-wrapper border-color">
	<div class="row">
		<?php $avatar = get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
		<?php if( $avatar ) { ?>
			<div class="col col-xsmall-eighth">
				<?php echo $avatar; ?>
			</div><!-- .x-xsmall-quarter -->
		<?php } ?>
	
		<div class="col">
			<?php printf( 
				'<h4>%s</h4>',
				get_the_author()
			); ?>
			<?php echo apply_filters( 'the_content', get_the_author_meta( 'description' ) ); ?>
		</div><!-- .x-xsmall-quarter -->
	</div><!-- .row -->
</div><!-- .author-bio-wrapper -->