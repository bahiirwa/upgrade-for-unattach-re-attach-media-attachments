<?php
/**
 * Basic security.
 *
 * @package Lurma.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Adds new buld actions 'unattach' and 're-attach' to the media lib.
 *
 * @see http://wordpress.stackexchange.com/questions/29822/custom-bulk-action
 * @return void
 */
function lurma_custom_bulk_admin_footer() {
	global $post_type;
	if ( is_admin() ) {
		?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					$ = jQuery;
					$( '<option>' ).val( 'unattach' ).text( '<?php esc_attr_e( 'Unattach', 'lurma' ); ?> ').appendTo("select[name='action']");
					$( '<option>' ).val( 'reattach' ).text( '<?php esc_attr_e( 'Re-Attach', 'lurma' ); ?> ').appendTo("select[name='action']");
					$( '<option>' ).val( 'unattach' ).text( '<?php esc_attr_e( 'Unattach', 'lurma' ); ?> ').appendTo("select[name='action2']");
					$( '<option>' ).val( 'reattach' ).text( '<?php esc_attr_e( 'Re-Attach', 'lurma' ); ?> ').appendTo("select[name='action2']");

					$( '#doaction, #doaction2' ).click(function(e){
						$( 'select[name^="action"]' ).each(function(){
							if ( $(this).val() == '<?php esc_attr_e( 'reattach', 'lurma' ); ?>' ) {
								e.preventDefault();
								findPosts.open();
							}
						});
					});
				});
			</script>
		<?php
	}
}

/**
 * Implements a bulk action for unattaching items in bulk.
 *
 * @see http://wordpress.stackexchange.com/questions/91874/how-to-make-custom-bulk-actions-work-on-the-media-upload-page
 * @see http://www.skyverge.com/blog/add-custom-bulk-action/
 * @return void
 */
function lurma_custom_bulk_action() {

	// If ($post_type == 'attachment' ) {  REPLACE WITH:.
	if ( ! isset( $_REQUEST['detached'] ) ) {

		// Get the action.
		$wp_list_table = _get_list_table( 'WP_Media_List_Table' );
		$action        = $wp_list_table->current_action();

		$allowed_actions = array( 'unattach' );

		if ( ! in_array( $action, $allowed_actions, true ) ) {
			return;
		}

		// Security check.
		// Check_admin_referer( 'bulk-posts' ); REPLACE WITH:.
		check_admin_referer( 'bulk-media' );

		// Make sure ids are submitted.  depending on the resource type, this may be 'media' or 'ids'.
		if ( isset( $_REQUEST['media'] ) ) {
			$post_ids = array_map( 'intval', $_REQUEST['media'] );
		}

		if ( empty( $post_ids ) ) {
			return;
		}

		// This is based on wp-admin/edit.php.
		$sendback = remove_query_arg( array( 'unattached', 'untrashed', 'deleted', 'ids' ), wp_get_referer() );

		if ( ! $sendback ) {
			$sendback = admin_url( "upload.php?post_type=$post_type" );
		}

		$pagenum  = $wp_list_table->get_pagenum();
		$sendback = add_query_arg( 'paged', $pagenum, $sendback );

		switch ( $action ) {
			case 'unattach':
				global $wpdb;

				// If we set up user permissions/capabilities, the code might look like:.
				// If ( !current_user_can($post_type_object->cap->export_post, $post_id) ).
				// wp_die( __( 'You are not allowed to unattach this post.' ) );.
				if ( ! is_admin() ) {
					wp_die( esc_attr__( 'You are not allowed to unattach this post.', 'lurma' ) );
				}

				$unattached = 0;
				foreach ( $post_ids as $post_id ) {
					// Alter post to unattach media file.
					if (
						false === $wpdb->update( $wpdb->posts,
							array(
								'post_parent' => 0,
							),
							array(
								'id'        => (int) $post_id,
								'post_type' => 'attachment',
							)
						)
					) {
						wp_die( esc_attr__( 'Error unattaching post.', 'lurma' ) );
					}
					$unattached++;
				}

				$sendback = add_query_arg(
					array(
						'unattached' => $unattached,
						'ids'        => join( ',', $post_ids ),
					),
					$sendback
				);

				break;
			default: return;
		}

		$sendback = remove_query_arg( array( 'action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status', 'post', 'bulk_edit', 'post_view' ), $sendback );

		wp_safe_redirect( $sendback );
		exit();

	}

}
