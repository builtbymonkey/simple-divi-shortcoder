<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://divinotes.com/
 * @since             1.0.0
 * @package           Divi_Shortcoder
 *
 * @wordpress-plugin
 * Plugin Name:       Divi Shortcoder
 * Plugin URI:        https://github.com/robhob/divi-shortcoder
 * Description:       The purpose of this plugin is to allow you to embed a Divi section or module within another. Simply build a module or section in the Divi Library and insert it using a shortcode with the following format: [showmodule id="894"] where the ID is the ID of the section/module in the library.
 * Version:           1.0.0
 * Author:            Rob Hobson
 * Author URI:        https://divinotes.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       divi-shortcoder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-dms-activator.php
 */
function activate_wp_dms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-dms-activator.php';
	Wp_Dms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-dms-deactivator.php
 */
function deactivate_wp_dms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-dms-deactivator.php';
	Wp_Dms_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_dms' );
register_deactivation_hook( __FILE__, 'deactivate_wp_dms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-dms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_dms() {

	$plugin = new Wp_Dms();
	$plugin->run();

}
run_wp_dms();

//Shortcode to show the module
function showmodule_shortcode($moduleid) {
extract(shortcode_atts(array('id' =>'*'),$moduleid));
return do_shortcode('[et_pb_section global_module="'.$id.'"][/et_pb_section]');
}
add_shortcode('showmodule', 'showmodule_shortcode');
