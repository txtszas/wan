<?php
/*
Plugin Name: WP Photo Album Plus
Description: Easily manage and display your photo albums and slideshows within your WordPress site.
Version: 4.8.4
Author: J.N. Breetvelt a.k.a OpaJaap
Author URI: http://wppa.opajaap.nl/
Plugin URI: http://wordpress.org/extend/plugins/wp-photo-album-plus/
*/
/* See explanation on activation hook in wppa-setup.php */
register_activation_hook(__FILE__, 'wppa_activate');
/* GLOBALS */
global $wpdb;

/* This is the database revision number
/* It is incremented when the table defs are changed, 
/* when new options are added and when the wppa_setup() routine 
/* must be called right after update for any other reason.
*/
global $wppa_revno; $wppa_revno = '484';	

/* CONSTANTS
/*
/* Check for php version
/* PHP_VERSION_ID is available as of PHP 5.2.7, if our 
/* version is lower than that, then emulate it
*/
global $wppa_loadtime; $wppa_loadtime = - microtime(true);
if ( ! defined( 'PHP_VERSION_ID' ) ) {
	$version = explode( '.', PHP_VERSION );
	define( 'PHP_VERSION_ID', ( $version[0] * 10000 + $version[1] * 100 + $version[2] ) );
}
/* To run WPPA+ on a multisite in single site mode, add to wp-config.php: define('WPPA_MULTISITE_GLOBAL', true); */
if ( ! defined('WPPA_MULTISITE_GLOBAL') ) define ('WPPA_MULTISITE_GLOBAL', false);
if ( is_multisite() && WPPA_MULTISITE_GLOBAL ) $wppa_prefix = $wpdb->base_prefix; else $wppa_prefix = $wpdb->prefix;
define( 'WPPA_ALBUMS',   $wppa_prefix . 'wppa_albums' );
define( 'WPPA_PHOTOS',   $wppa_prefix . 'wppa_photos' );
define( 'WPPA_RATING',   $wppa_prefix . 'wppa_rating' );
define( 'WPPA_COMMENTS', $wppa_prefix . 'wppa_comments' );
define( 'WPPA_IPTC',	 $wppa_prefix . 'wppa_iptc' );
define( 'WPPA_EXIF', 	 $wppa_prefix . 'wppa_exif' );
																// Standard examples
define( 'WPPA_FILE', basename( __FILE__ ) );					// wppa.php
define( 'WPPA_PATH', dirname( __FILE__ ) );						// /.../wp-content/plugins/wp-photo-album-plus
define( 'WPPA_NAME', basename( dirname( __FILE__ ) ) );			// wp-photo-album-plus
define( 'WPPA_URL',  plugins_url() . '/' . WPPA_NAME );			// http://...../wp-photo-album-plus

define( 'WPPA_NONCE' , 'wppa-update-check');

define( 'WPPA_DEBUG', false);	// true: produces success/fale messages during setup

/* LOAD SIDEBAR WIDGETS */
require_once 'wppa-potd-widget.php';
require_once 'wppa-search-widget.php';
require_once 'wppa-topten-widget.php';
require_once 'wppa-slideshow-widget.php';
require_once 'wppa-gp-widget.php';
require_once 'wppa-comment-widget.php';
require_once 'wppa-thumbnail-widget.php';
require_once 'wppa-lasten-widget.php';
require_once 'wppa-album-widget.php';
require_once 'wppa-qr-widget.php';

/* COMMON FUNCTIONS */
require_once 'wppa-common-functions.php';

/* SET UP $wppa[], $wppa_opt[], URL and PATH constants and LANGUAGE */
add_action('init', 'wppa_initialize_runtime', '100');

/* DO THE ADMIN/NON ADMIN SPECIFIC STUFF */
if ( is_admin() ) require_once 'wppa-admin.php';
else require_once 'wppa-non-admin.php';

/* ADD AJAX */
require_once 'wppa-ajax.php';

$wppa_loadtime += microtime(true);

/* This is for the changelog text when an update is available */
global $pagenow;
if ( 'plugins.php' === $pagenow )
{
    // Changelog update message
    $file   = basename( __FILE__ );
    $folder = basename( dirname( __FILE__ ) );
    $hook = "in_plugin_update_message-{$folder}/{$file}";
    add_action( $hook, 'wppa_update_message_cb', 20, 2 ); // hook for function below
}
function wppa_update_message_cb( $plugin_data, $r )
{
    $output = '<span style="margin-left:10px;color:#FF0000;">Please Read the <a href="http://wppa.opajaap.nl/changelog/" target="_blank" >Changelog</a> Details Before Upgrading.</span>';
   
    return print $output;
}


