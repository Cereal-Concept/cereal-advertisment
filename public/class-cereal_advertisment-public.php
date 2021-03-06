<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.cerealconcept.com
 * @since      1.0.0
 *
 * @package    Cereal_advertisment
 * @subpackage Cereal_advertisment/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cereal_advertisment
 * @subpackage Cereal_advertisment/public
 * @author     Cereal Concept <contact@cerealconcept.com>
 */
class Cereal_advertisment_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cereal_advertisment_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cereal_advertisment_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'slick', plugin_dir_url( __FILE__ ) . 'css/slick.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'slick-theme', plugin_dir_url( __FILE__ ) . 'css/slick-theme.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cereal_advertisment-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cereal_advertisment_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cereal_advertisment_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'slick', plugin_dir_url( __FILE__ ) . 'js/slick.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cereal_advertisment-public.js', array( 'jquery', 'slick' ), $this->version, false );

	}

	/**
	 * Display the ShortCode
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function display_add_shortcode( $atts, $content = "" ) {

		include_once 'partials/cereal_advertisment-public-display.php';

	}

	/**
	 * Add shortcodes
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {

		add_shortcode( $this->plugin_name, array( $this, 'display_add_shortcode' ) );
	}
	

}
