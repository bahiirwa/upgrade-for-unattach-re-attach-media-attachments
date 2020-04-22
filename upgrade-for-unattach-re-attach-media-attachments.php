<?php
/**
 * Plugin Name: Upgrade for Unattach & Re-Attach Media Attachments
 * Plugin URI: https://github.com/bahiirwa/Upgrade-for-Unattach-Re-Attach-Media-Attachments/
 * Description: Safely unattach and Re-attach images and other attachments from within the media library.
 * Version: 1.1.1
 * Author: Laurence Bahiirwa
 * Author URI: https://omukiga.com
 * Requires at least: 4.9
 * Tested up to: 5.2.2
 * Tags: Lurma, Attachments, Unattach, Re-Attach, Image, Media, Library, Detach, Assign
 * Text Domain: lurma
 * License: GPLv2
 *
 * @package Lurma
 */

/**
 * Basic Security: Exit plugin if accessed directly.
 */
defined( 'ABSPATH' ) || exit;

/**
 * Define constants
 */
define( 'LURMA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The plugin needs to run in two pages that is media and tools.
 */
global $pagenow;

if ( 'upload.php' === $pagenow || 'tools.php' === $pagenow ) {

	require_once LURMA_PLUGIN_DIR . '/includes/functions.php';
	require_once LURMA_PLUGIN_DIR . '/includes/bulk-functions.php';
	require_once LURMA_PLUGIN_DIR . '/includes/manage-columns.php';

	/**
	 * Run Plugin Functions
	 */
	add_action( 'admin_menu', 'lurma_admin_menu' );
	add_filter( 'manage_upload_columns', 'lurma_manage_upload_columns' );
	add_action( 'manage_media_custom_column', 'lurma_manage_media_custom_column', 0, 2 );
	add_action( 'admin_footer', 'lurma_custom_bulk_admin_footer' );
	add_action( 'load-upload.php', 'lurma_custom_bulk_action' );

}
