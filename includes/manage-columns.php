<?php
/**
 * Plugin Functions.
 * Basic security.
 *
 * @package Lurma.
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'manage_upload_columns', 'lurma_manage_upload_columns' );
add_action( 'manage_media_custom_column', 'lurma_manage_media_custom_column', 0, 2 );

/**
 * Implements filter 'manage_upload_columns' to replace column 'parent' without custom column 'extended_parent'.
 *
 * @param array $columns Passed Array of columns from media posts.
 * @return array $columns New Array of columns from media posts.
 */
function lurma_manage_upload_columns( $columns ) {
	// unset( $columns['parent'] );
	$columns = array(
		'cb' 		 => $columns['cb'],
		'title' 	 => esc_attr__( 'File', 'lurma' ),
		'author' 	 => esc_attr__( 'Author', 'lurma' ),
		'extended_parent' 	 => esc_attr__( 'Parent Post', 'lurma' ),
		'date' 		 => __( 'Date' ),
	);

	return $columns;
}

/**
 * Implementes action 'manage_media_custom_column' to add a column into the media page with link Attach, Unattach, Re-Attach.
 *
 * @param array   $column_name Column from media posts.
 * @param integer $id          ID for the attachment post.
 * @return void
 */
function lurma_manage_media_custom_column( $column_name, $id ) {

	$post = get_post( $id );

	// Only act on our custom column extended_parent.
	if ( 'extended_parent' !== $column_name ) {
		return;
	}

	$post_parent = $post->post_parent;

	if ( $post_parent ) {

		if ( get_post( $post_parent ) ) {
			$title = _draft_or_post_title( $post_parent );
		}

		$url_unattach = admin_url( 'tools.php?page=unattach&noheader=true&post_id=' . $post->ID );

		?>
			<div>
				<strong><a href="<?php echo esc_url( get_edit_post_link( $post_parent ) ); ?>"><?php echo esc_attr( $title ); ?></a></strong>, <span><?php echo esc_attr__( 'Media uploaded on', 'lurma' ) . ' ' . esc_html( get_the_time( __( 'd/m/Y' ) ) ); ?></span>
			</div>

			<div>
				<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo esc_attr( $post->ID ); ?>'); return false;" href="#the-list"><?php esc_attr_e( 'Re-Attach', 'lurma' ); ?></a>
			</div>

			<div>
				<a href="<?php echo esc_url( $url_unattach ); ?>" title="<?php echo esc_attr__( 'Unattach this media item.', 'lurma' ); ?>"><?php esc_attr_e( 'Unattach', 'lurma' ); ?></a>
			</div>
		<?php

	} else {
		esc_attr_e( '(Unattached)', 'lurma' );
		?>
			<div>
				<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo esc_attr( $post->ID ); ?>'); return false;" href="#the-list"><?php esc_attr_e( 'Attach', 'lurma' ); ?></a>
			</div>
		<?php
	}

}
