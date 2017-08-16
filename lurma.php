<?php
/**
 * Plugin Name: Upgrade for Unattach & Re-Attach Media Attachments
 * Plugin URI: https://github.com/bahiirwa/lurma
 * Description: Unattach and Re-attach images and other attachments from within the media library. The plugin is similar to its predecessors but security and code refactoring has been done. This has plans of being maintained and grown basing on requests of users.
 * Version: 1.0.0
 * Author: Laurence Bahiirwa
 * Author URI: https://github.com/bahiirwa/lurma
 * Requires at least: 3.0
 * Tested up to: 4.8.0
 * Tags: Lurma, Attachments, Unattach, Re-Attach, Image, Media, Library, Detach, Assign
 * Text Domain: lurma
 * License: GPLv2
 *
**/

/*
 * @package   Lurma
 * @link      https://github.com/bahiirwa/lurma
*/

/*
 * Basic Security: Exit plugin if accessed directly.
*/
if ( ! defined( 'ABSPATH' ) ) {
	echo 'Hi there! You are up to no good!';
	exit;
}

define( 'LURMA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/*
 * Plugin Callback Functions
*/
require_once( LURMA_PLUGIN_DIR . '/includes/functions.php' );

/*
 * Run Plugin Functions
*/
add_action( 'admin_menu', 'lurma_admin_menu' );
add_filter( 'manage_upload_columns', 'lurma_manage_upload_columns') ;
add_action( 'manage_media_custom_column', 'lurma_manage_media_custom_column', 0, 2 );

if( is_admin() ) {
	add_action( 'admin_footer', 'lurma_custom_bulk_admin_footer' );
	add_action( 'load-upload.php', 'lurma_custom_bulk_action' );
}
