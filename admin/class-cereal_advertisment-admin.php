<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.cerealconcept.com
 * @since      1.0.0
 *
 * @package    Cereal_advertisment
 * @subpackage Cereal_advertisment/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cereal_advertisment
 * @subpackage Cereal_advertisment/admin
 * @author     Cereal Concept <contact@cerealconcept.com>
 */
class Cereal_advertisment_Admin {

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
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'cereal_advertisment';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cereal_advertisment-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cereal_advertisment-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Cereal Advertisment Settings', 'cereal_advertisment' ),
			__( 'Cereal Advertisment', 'cereal_advertisment' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/cereal_advertisment-admin-display.php';
	}

	/**
	 * Register Settings for Option Page
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {

		// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'cereal_advertisment' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		// Add a Setting Field
		add_settings_field(
			$this->option_name . '_position',
			__( 'Text positions', 'cereal_advertisment' ),
			array( $this, $this->option_name . '_position_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_position' )
		);

		// Add a Setting Field
		add_settings_field(
			$this->option_name . '_day',
			__( 'Post is outdated after', 'cereal_advertisment' ),
			array( $this, $this->option_name . '_day_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_day' )
		);

		// Register the settings
		register_setting( $this->plugin_name, $this->option_name . '_position', array( $this, $this->option_name . '_sanitize_position' ) );
		register_setting( $this->plugin_name, $this->option_name . '_day', 'intval' );
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function cereal_advertisment_general_cb() {
		echo '<p>' . __( 'Please change the settings accordingly.', 'cereal_advertisment' ) . '</p>';
	}

	/**
	 * Render the radio input field for position option
	 *
	 * @since  1.0.0
	 */
	public function cereal_advertisment_position_cb() {
		$position = get_option( $this->option_name . '_position' );
		?>
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" id="<?php echo $this->option_name . '_position' ?>" value="before" <?php checked( $position, 'before' ); ?>>
					<?php _e( 'Before the content', 'outdated-notice' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" value="after" <?php checked( $position, 'after' ); ?>>
					<?php _e( 'After the content', 'outdated-notice' ); ?>
				</label>
			</fieldset>
		<?php
	}

	/**
	 * Render the treshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function cereal_advertisment_day_cb() {
		$day = get_option( $this->option_name . '_day' );
		echo '<input type="text" name="' . $this->option_name . '_day' . '" id="' . $this->option_name . '_day' . '" value="' . $day . '"> ' . __( 'days', 'outdated-notice' );
	}

	/**
	 * Sanitize the text position value before being saved to database
	 *
	 * @param  string $position $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function cereal_advertisment_sanitize_position( $position ) {
		if ( in_array( $position, array( 'before', 'after' ), true ) ) {
	        return $position;
	    }
	}

	/**
	 * Creates a new custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function new_cpt_campagnes() {		
		$cap_type 	= 'page';
		$plural 	= 'Campagnes';
		$single 	= 'Campagne';
		$cpt_name 	= 'campagnes';
		$opts['can_export']								= TRUE;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= FALSE;
		$opts['has_archive']							= FALSE;
		$opts['hierarchical']							= FALSE;
		$opts['map_meta_cap']							= TRUE;
		$opts['menu_icon']								= 'dashicons-megaphone';
		$opts['menu_position']							= 25;
		$opts['public']									= TRUE;
		$opts['publicly_querable']						= TRUE;
		$opts['query_var']								= TRUE;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= FALSE;
		$opts['show_in_admin_bar']						= TRUE;
		$opts['show_in_menu']							= TRUE;
		$opts['show_in_nav_menu']						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['supports']								= array( 'title', 'thumbnail' );
		$opts['taxonomies']								= array();
		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";
		$opts['labels']['add_new']						= esc_html__( "Ajouter une nouvelle {$single}", 'cereal_advertisment' );
		$opts['labels']['add_new_item']					= esc_html__( "Ajouter une nouvelle {$single}", 'cereal_advertisment' );
		$opts['labels']['all_items']					= esc_html__( "Toutes les {$plural}", 'cereal_advertisment' );
		$opts['labels']['edit_item']					= esc_html__( "Modifier la {$single}" , 'cereal_advertisment' );
		$opts['labels']['menu_name']					= esc_html__( $plural, 'cereal_advertisment' );
		$opts['labels']['name']							= esc_html__( $plural, 'cereal_advertisment' );
		$opts['labels']['name_admin_bar']				= esc_html__( $single, 'cereal_advertisment' );
		$opts['labels']['new_item']						= esc_html__( "Nouvelle {$single}", 'cereal_advertisment' );
		$opts['labels']['not_found']					= esc_html__( "Aucune {$single} n'a été trouvée", 'cereal_advertisment' );
		$opts['labels']['not_found_in_trash']			= esc_html__( "Aucune {$single} n'a été trouvée dans la corbeille", 'cereal_advertisment' );
		$opts['labels']['parent_item_colon']			= esc_html__( "{$plural} parent :", 'cereal_advertisment' );
		$opts['labels']['search_items']					= esc_html__( "Rechercher une {$plural}", 'cereal_advertisment' );
		$opts['labels']['singular_name']				= esc_html__( $single, 'cereal_advertisment' );
		$opts['labels']['view_item']					= esc_html__( "Voir la {$single}", 'cereal_advertisment' );
		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= FALSE;
		$opts['rewrite']['pages']						= TRUE;
		$opts['rewrite']['slug']						= esc_html__( strtolower( $plural ), 'cereal_advertisment' );
		$opts['rewrite']['with_front']					= FALSE;
		$opts = apply_filters( 'cereal_advertisment-cpt-options', $opts );

		register_post_type( strtolower( $cpt_name ), $opts );
	} 

	/**
	 * Register required plugins
	 * @return void
	 * @since  1.0
	 */
	function register_required_plugins()
	{
	    $plugins = array(
	        array(
	            'name'               => 'Meta Box',
	            'slug'               => 'meta-box',
	            'required'           => true,
	            'force_activation'   => false,
	            'force_deactivation' => false,
	        ),
	    );

	    $config  = array(
	        'domain'           => 'cereal_advertisment',
	        'default_path'     => '',
	        'parent_menu_slug' => 'themes.php',
	        'parent_url_slug'  => 'themes.php',
	        'menu'             => 'install-required-plugins',
	        'has_notices'      => true,
	        'is_automatic'     => false,
	        'message'          => '',
	        'strings'          => array(
	            'page_title'                      => __( 'Install Required Plugins', 'cereal_advertisment' ),
	            'menu_title'                      => __( 'Install Plugins', 'cereal_advertisment' ),
	            'installing'                      => __( 'Installing Plugin: %s', 'cereal_advertisment' ),
	            'oops'                            => __( 'Something went wrong with the plugin API.', 'cereal_advertisment' ),
	            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
	            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
	            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
	            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
	            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
	            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
	            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
	            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
	            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
	            'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
	            'return'                          => __( 'Return to Required Plugins Installer', 'cereal_advertisment' ),
	            'plugin_activated'                => __( 'Plugin activated successfully.', 'cereal_advertisment' ),
	            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'cereal_advertisment' ),
	            'nag_type'                        => 'updated',
	        )
	    );
	    tgmpa( $plugins, $config );
	}

}
