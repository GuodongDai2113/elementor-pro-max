<?php
/**
 * Plugin Name: Elementor Pro Max
 * Description: 超大桶 Elementor
 * Plugin URI:  https://fanersai.net
 * Version:     1.0.0
 * Author:      JellyDai
 * Author URI:  
 * Text Domain: elementor-pro-max
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function elementor_test_addon() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Elementor_Pro_Max\Plugin::instance();

}
add_action( 'plugins_loaded', 'elementor_test_addon' );