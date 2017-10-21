<?php
/**
 * Plugin Name: Upgrade for Unattach & Re-Attach Media Attachments
 * Plugin URI: https://github.com/bahiirwa/Upgrade-for-Unattach-Re-Attach-Media-Attachments/
 * Description: Safely unattach and Re-attach images and other attachments from within the media library.
 * Version: 1.1.0
 * Author: Laurence Bahiirwa
 * Author URI: https://omukiga.com
 * Requires at least: 3.0
 * Tested up to: 4.8.2
 * Tags: Lurma, Attachments, Unattach, Re-Attach, Image, Media, Library, Detach, Assign
 * Text Domain: lurma
 * License: GPLv2
 *
**/

    /*
     * Basic Security: Exit plugin if accessed directly.
    */
    if ( ! defined( 'ABSPATH' ) ) {
    	echo 'Hi there! You are up to no good!';
    	exit;
    }

    define( 'LURMA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

    /*
     * The plugin needs to run in two pages that is media and tools.
    */
    global $pagenow;

    if( $pagenow == 'upload.php' || $pagenow == 'tools.php' ) {
        require_once( LURMA_PLUGIN_DIR . '/includes/functions.php' );
    }
