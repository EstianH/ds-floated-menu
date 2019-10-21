<?php
/*
Plugin Name:  DS Floated Menu
Plugin URI:   https://www.divspot.co.za/plugin-ds-floated-menu/
Description:  Add a customizable floated (movable) menu to your website.
Version:      1.0
Author:       divSpot
Author URI:   https://www.divspot.co.za
License:      GPLv3 or later
License URI:  https://www.gnu.org/licenses/gpl-3.0.html
*/

if( !defined( 'ABSPATH' ) ) exit;


/*
██████  ███████ ███████ ██ ███    ██ ██ ████████ ██  ██████  ███    ██ ███████
██   ██ ██      ██      ██ ████   ██ ██    ██    ██ ██    ██ ████   ██ ██
██   ██ █████   █████   ██ ██ ██  ██ ██    ██    ██ ██    ██ ██ ██  ██ ███████
██   ██ ██      ██      ██ ██  ██ ██ ██    ██    ██ ██    ██ ██  ██ ██      ██
██████  ███████ ██      ██ ██   ████ ██    ██    ██  ██████  ██   ████ ███████
*/
if( !defined( 'DIVSPOT_URL' ) )
	define( 'DIVSPOT_URL', 'https://www.divspot.co.za' );

define( 'DSFM_BASENAME'  , plugin_basename( __FILE__ ) );
define( 'DSFM_URL'       , plugins_url( '', DSFM_BASENAME ) . '/' ); // User-Friendly URL
define( 'DSFM_ROOT'      , __DIR__   . '/' ); // FTP Path
define( 'DSFM_ADMIN'     , DSFM_URL  . 'admin/' ); // FTP Path
define( 'DSFM_ASSETS'    , DSFM_URL  . 'assets/' ); // FTP Path
define( 'DSFM_TEMPLATES' , DSFM_ROOT . 'templates/' ); // FTP Path
define( 'DSFM_TITLE'     , 'DS Floated Menu' );
define( 'DSFM_SLUG'      , sanitize_title( DSFM_TITLE ) ); // Plugin slug.
define( 'DSFM_VERSION'   , '1.0' );


/*
██████  ███████     ███    ███  ██████  ██████  ██  ██████ ██████  ███████ ██████
██   ██ ██          ████  ████ ██    ██ ██   ██ ██ ██      ██   ██ ██      ██   ██
██   ██ ███████     ██ ████ ██ ██    ██ ██████  ██ ██      ██████  █████   ██   ██
██   ██      ██     ██  ██  ██ ██    ██ ██   ██ ██ ██      ██   ██ ██      ██   ██
██████  ███████     ██      ██  ██████  ██████  ██  ██████ ██   ██ ███████ ██████
*/
class DS_FLOATED_MENU {
	/**
	 * Class instance.
	 *
	 * @access private
	 * @static
	 * @var DS_FLOATED_MENU
	 */
	private static $instance;

	/**
	 * Saved settings.
	 *
	 * @access public
	 */
	public $settings;

	/**
	 * Plugin menu locations.
	 *
	 * @access public
	 */
	public $menu_locations;

	/**
	 * Returns the instance of the class.
	 *
	 * @access public
	 * @static
	 * @return DS_FLOATED_MENU $instance
	 */
	public static function get_instance() {
		if ( NULL === self::$instance )
			self::$instance = new DS_FLOATED_MENU();

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @access private
	 */
	private function __construct() {
		$this->settings = get_option( 'dsfm_settings' );

		$this->menu_locations = apply_filters( 'dsfm-menu-locations', array(
			'dsfm-left'    => __( 'DSFM: Float Left'  , DSFM_SLUG ),
			'dsfm-right'   => __( 'DSFM: Float Right' , DSFM_SLUG ),
			'dsfm-movable' => __( 'DSFM: Movable Menu', DSFM_SLUG )
		) );

		// Register DSFM locations.
		add_action( 'init', array( $this, 'register_nav_menus' ) );

		// Enqueue plugin assets.
		add_action( 'wp_enqueue_scripts', function() {
			if ( true !== $this->has_active_menu() )
				return;

			wp_enqueue_script ( 'dsfm-script', DSFM_ASSETS . 'js/script.js',  array( 'jquery-core' ), DSFM_VERSION );
			wp_enqueue_style  ( 'dsfm-style' , DSFM_ASSETS . 'css/style.css', array(),                DSFM_VERSION );
		} );

		// Render menus in/above the footer.
		add_action( 'wp_footer', array( $this, 'render_menu_locations' ) );
	}

	/**
	 * Render menus in/above the footer.
	 *
	 * @access private
	 */
	public function render_menu_locations() {
		if ( true !== $this->has_active_menu() )
			return;

		load_template( DSFM_TEMPLATES . 'floated-menu.php' );
	}

	/**
	 * Add menu locations to the WordPress menus manager page.
	 *
	 * @access public
	 */
	public function register_nav_menus() {
		register_nav_menus( $this->menu_locations );
	}

	/**
	 * Check if a DSFM menu has been assigned.
	 *
	 * @access public
	 */
	public function has_active_menu() {
		foreach( $this->menu_locations as $location => $name )
			if (
				has_nav_menu( $location )
			)
				return true;

		return false;
	}
}

add_action( 'plugins_loaded', array( 'DS_FLOATED_MENU', 'get_instance' ) );


/*
 █████  ██████  ███    ███ ██ ███    ██
██   ██ ██   ██ ████  ████ ██ ████   ██
███████ ██   ██ ██ ████ ██ ██ ██ ██  ██
██   ██ ██   ██ ██  ██  ██ ██ ██  ██ ██
██   ██ ██████  ██      ██ ██ ██   ████
*/
if ( is_admin() ) {
	require_once DSFM_ROOT . 'admin/inc/class-admin.php';
	add_action( 'plugins_loaded', array( 'DS_FLOATED_MENU_ADMIN', 'get_instance' ) );
}
