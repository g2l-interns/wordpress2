<?php
/**
 * Template part for displaying discussion topic meta
 * Called from archive-discussion-topics.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Singularity
 */

$avatar = get_avatar( get_the_author_meta( 'ID' ), 48 );
$posted = apply_filters( 'singularity_ctdb_posted_by_text', __( 'Posted by:', 'singularity' ) );
$latest = apply_filters( 'singularity_ctdb_latest_reply_text', __( 'Latest reply by:', 'singularity' ) ); 
if( function_exists( 'ctdb_get_most_recent_commenter' ) ) {
	$most_recent_commenter = ctdb_get_most_recent_commenter();
} ?>

<div id="post-<?php the_ID(); ?>" class="singularity-ctdb-archive-titles-wrap cols-<?php echo esc_attr( $count_cols ); ?>">
	<div class="singularity-ctdb-archive-avatar">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
	</div>
	<div class="singularity-ctdb-archive-title">
		<?php the_title( '<p class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' ); ?>
		<div class="singularity-ctdb-archive-meta"><?php echo esc_html( $posted ) . ' ' . ctdb_get_author() . ', ' . ctdb_topic_date_time(); ?></div>
		<?php // Add most recent commenter name if it exists
		if( $most_recent_commenter ) { ?>
			<div class="singularity-ctdb-archive-meta">
				<?php echo esc_html( $latest ) . ' ' . ( $most_recent_commenter ) . ', ' . ctdb_get_most_recent_comment_time(); ?>
			</div>
		<?php } ?>
	</div>
	<?php
	if( ! empty( $cols ) && is_array( $cols ) ) {
		foreach( $cols as $col ) {
			if( $col == 'replies' ) {
				$value = get_comments_number();
			} else if( $col == 'voices' ) {
				$value = ctdb_count_voices();
			} else if( $col == 'status' ) {
				$value = ctdb_status();
			} else {
				$value = false;
			}
			if( $value !== false ) { ?>
			<div class="singularity-ctdb-archive-col"><p><?php echo esc_html( $value ); ?></p></div>
		<?php }
		}
	} ?>
</div><!-- .ctdb-archive-titles-wrap -->