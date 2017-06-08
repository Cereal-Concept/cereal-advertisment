<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.cerealconcept.com
 * @since      1.0.0
 *
 * @package    Cereal_advertisment
 * @subpackage Cereal_advertisment/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cereal_advertisment
 * @subpackage Cereal_advertisment/includes
 * @author     Cereal Concept <contact@cerealconcept.com>
 */
class Cereal_advertisment_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cereal_advertisment',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
