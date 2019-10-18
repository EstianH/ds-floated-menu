<?php
if( !defined( 'ABSPATH' ) ) exit;


/*
██████  ███████ ███████ ███    ███      █████  ██████  ███    ███ ██ ███    ██
██   ██ ██      ██      ████  ████     ██   ██ ██   ██ ████  ████ ██ ████   ██
██   ██ ███████ █████   ██ ████ ██     ███████ ██   ██ ██ ████ ██ ██ ██ ██  ██
██   ██      ██ ██      ██  ██  ██     ██   ██ ██   ██ ██  ██  ██ ██ ██  ██ ██
██████  ███████ ██      ██      ██     ██   ██ ██████  ██      ██ ██ ██   ████
*/
class DS_FLOATED_MENU_ADMIN {
	/**
	 * Class instance.
	 *
	 * @access private
	 * @static
	 * @var DS_FLOATED_MENU_ADMIN
	 */
	private static $instance;

	/**
	 * Returns the instance of the class.
	 *
	 * @access public
	 * @static
	 * @return DS_FLOATED_MENU_ADMIN $instance
	 */
	public static function get_instance() {
		if ( NULL === self::$instance )
			self::$instance = new DS_FLOATED_MENU_ADMIN();

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @access private
	 */
	private function __construct() {
		// Version check settings.
		$this->update_settings_maybe();

		// Register the admin settings page.
		add_action( 'admin_menu', array( $this, 'render_admin_menu' ) );

		// Enqueue admin assets.
		add_action( 'admin_enqueue_scripts', function( $hook ) {
			if( 'appearance_page_' . DSFM_SLUG !== $hook ) // Enqueue only on the appropriate page.
				return;

			// WP assets.
			wp_enqueue_script( 'jquery-form' ); // WP jQuery for forms handling.

			// Plugin assets.
			wp_enqueue_script ( 'dsfm-script', DSFM_ADMIN . 'assets/js/script.js',  array( 'jquery-core' ), DSFM_VERSION );
			wp_enqueue_style  ( 'dsfm-style',  DSFM_ADMIN . 'assets/css/style.css', array(), DSFM_VERSION );

			// Vendor assets.
			wp_enqueue_script ( 'dsc-script', DSFM_ADMIN . 'assets/vendors/ds-core/js/script.js',  array( 'jquery-core' ), DSFM_VERSION );
			wp_enqueue_style  (  'dsc-style', DSFM_ADMIN . 'assets/vendors/ds-core/css/style.css', array(), DSFM_VERSION );
		} );

		// Filters
		add_filter( 'plugin_action_links_' . DSFM_BASENAME, array( $this, 'register_plugin_action_links' ), 10, 1 ); // Add plugin list settings link.

		// Register plugin settings.
		register_setting( 'dsfm_settings', 'dsfm_settings' );

		// Register DSFM locations.
		add_action( 'init', array( $this, 'register_menu_locations' ) );
	}

	/**
	 * Add plugin admin menu items.
	 *
	 * @access public
	 * @uses $GLOBALS
	 */
	public function render_admin_menu() {
		// Return early if the slug already exists.
		if ( !empty( $GLOBALS['admin_page_hooks'][DSFM_SLUG] ) )
			return;

		add_theme_page(
			DSFM_TITLE,                                 // $page_title
			DSFM_TITLE,                                 // $menu_title
			'edit_plugins',                             // $capability
			DSFM_SLUG,                                  // $menu_slug
			function() {                                // $function
				load_template( DSFM_ROOT . 'admin/templates/settings.php' );
			},
			DSFM_ASSETS . 'images/icon-xs.png',         // $icon_url
			79                                          // $position
		);
	}

	/**
	 * Handle plugin activation.
	 *
	 * @access public
	 */
	public function activate() {
		$dsfm = DS_SITE_MESSAGE::get_instance();
		require_once DSFM_ROOT . 'admin/default-settings.php'; // Fetch $default_settings.

		update_option( 'dsfm_version', DSFM_VERSION );

		$db_settings = get_option( 'dsfm_settings' );

		if ( empty( $db_settings ) ) {
			update_option( 'dsfm_settings', $default_settings );
			$db_settings = $default_settings;
		}

		// Refresh cached settings.
		$dsfm->settings = $db_settings;
	}

	/**
	 * Handle plugin deactivation.
	 *
	 * @access public
	 */
	public function deactivate() {

	}

	/**
	 * Update database settings if versions differ.
	 *
	 * @access public
	 */
	public function update_settings_maybe() {
		if ( version_compare( get_option( 'dsfm_version' ), DSFM_VERSION, '<' ) )
			$this->activate();
	}

	/**
	 * Add plugin action links to the plugin page.
	 *
	 * @access public
	 * @param array  $links Plugin links.
	 * @return array $links Updated plugin links.
	 */
	public function register_plugin_action_links( $links ) {
		$settings_link = '<a href="' . esc_url( admin_url( '/themes.php' ) ) . '?page=' . DSFM_SLUG . '">' . __( 'Settings', DSFM_SLUG ) . '</a>';
		array_push( $links, $settings_link );

		return $links;
	}

	/**
	 * Add menu locations to the WordPress menus manager page.
	 *
	 * @access public
	 */
	public function register_menu_locations() {
		register_nav_menus(
			array(
				'dsfm-float-left'    => __( 'DSFM: Float Left' ),
				'dsfm-float-right'   => __( 'DSFM: Float Right' ),
				'dsfm-float-movable' => __( 'DSFM: Movable Menu' )
			)
		);
	}
}


/*
 █████   ██████ ████████ ██ ██    ██  █████  ████████ ███████     ██ ██████  ███████  █████   ██████ ████████ ██ ██    ██  █████  ████████ ███████
██   ██ ██         ██    ██ ██    ██ ██   ██    ██    ██         ██  ██   ██ ██      ██   ██ ██         ██    ██ ██    ██ ██   ██    ██    ██
███████ ██         ██    ██ ██    ██ ███████    ██    █████     ██   ██   ██ █████   ███████ ██         ██    ██ ██    ██ ███████    ██    █████
██   ██ ██         ██    ██  ██  ██  ██   ██    ██    ██       ██    ██   ██ ██      ██   ██ ██         ██    ██  ██  ██  ██   ██    ██    ██
██   ██  ██████    ██    ██   ████   ██   ██    ██    ███████ ██     ██████  ███████ ██   ██  ██████    ██    ██   ████   ██   ██    ██    ███████
*/
/**
 * Register plugin activation hook.
 */
register_activation_hook( __FILE__, array( 'DS_FLOATED_MENU_ADMIN', 'activate' ) );

/**
 * Register plugin deactivation hook.
 */
register_deactivation_hook( __FILE__, array( 'DS_FLOATED_MENU_ADMIN', 'deactivate' ) );
