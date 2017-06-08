<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.cerealconcept.com
 * @since             1.0.0
 * @package           Cereal_advertisment
 *
 * @wordpress-plugin
 * Plugin Name:       Cereal Advertisement
 * Plugin URI:        http://www.cerealconcept.com
 * Description:       Display Adds in a responsive way with a shortcode
 * Version:           1.0.0
 * Author:            Cereal Concept
 * Author URI:        http://www.cerealconcept.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cereal_advertisment
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cereal_advertisment-activator.php
 */
function activate_cereal_advertisment() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cereal_advertisment-activator.php';
	Cereal_advertisment_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cereal_advertisment-deactivator.php
 */
function deactivate_cereal_advertisment() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cereal_advertisment-deactivator.php';
	Cereal_advertisment_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cereal_advertisment' );
register_deactivation_hook( __FILE__, 'deactivate_cereal_advertisment' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cereal_advertisment.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cereal_advertisment() {

	$plugin = new Cereal_advertisment();
	$plugin->run();

}
run_cereal_advertisment();
