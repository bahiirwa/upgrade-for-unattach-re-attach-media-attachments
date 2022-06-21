<?php
/**
 * Plugin Name:       Upgrade for Unattach & Re-Attach Media Attachments
 * Plugin URI:        https://github.com/bahiirwa/Upgrade-for-Unattach-Re-Attach-Media-Attachments/
 * Description:       Safely unattach and Re-attach images and other attachments from within the media library.
 * Version:           1.2.2
 * Author:            Laurence Bahiirwa
 * Author URI:        https://omukiguy.com
 * Requires at least: 4.9
 * Tested up to:      6.0
 * Tags:              Attachments, Unattach, Re-Attach, Media Library, Upgrade
 * Text Domain:       lurma
 * License:           GPL2 or later
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
if ( ! defined( 'LURMA_PLUGIN_DIR' ) ) {
	define( 'LURMA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

add_action( 'plugins_loaded', 'lurma_load_plugin_textdomain' );

/**
 * Load gettext translate for text domain.
 *
 * @since 1.2.0
 *
 * @return void
 */
function lurma_load_plugin_textdomain() {
	load_plugin_textdomain( 'lurma' );
}

/**
 * The plugin needs to run in two pages that is media and tools.
 */
global $pagenow;

if ( 'upload.php' === $pagenow || 'tools.php' === $pagenow ) {
	require_once LURMA_PLUGIN_DIR . '/includes/functions.php';
	require_once LURMA_PLUGIN_DIR . '/includes/bulk-functions.php';
	require_once LURMA_PLUGIN_DIR . '/includes/manage-columns.php';
}
