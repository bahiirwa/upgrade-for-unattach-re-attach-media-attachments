<?php
/**
 * Plugin Functions.
 * Basic security.
 *
 * @package Lurma.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Deletes 'post_parent' from an attachment to unattach attachment.
 *
 * @return void
 */
function lurma_unattach_attachment() {
	global $wpdb;

	if ( ! empty( $_REQUEST['post_id'] ) ) {
		$wpdb->update(
			$wpdb->posts,
			array(
				'post_parent' => 0,
			),
			array(
				'id'        => (int) $_REQUEST['post_id'],
				'post_type' => 'attachment',
			)
		);
	}

	wp_safe_redirect( admin_url( 'upload.php' ) );
	exit;
}

/**
 * Implements action 'admin_menu' to provide a callback for lurma_unattach_attachment().
 *
 * @return void
 */
function lurma_admin_menu() {
	if ( current_user_can( 'upload_files' ) ) {
		// This is hacky but couldn't find the right hook.
		add_submenu_page( 'tools.php', 'Unattach Media', 'Unattach', 'upload_files', 'unattach', 'lurma_unattach_attachment' );
		remove_submenu_page( 'tools.php', 'unattach' );
	}
}
