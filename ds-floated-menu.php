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

		$this->menu_locations = apply_filters( 'dsfm_menu_locations', array(
			'dsfm-left'    => [
				'title'        => __( 'DSFM: Float Left'  , DSFM_SLUG ),
				'interactable' => false
			],
			'dsfm-right'   => [
				'title'        => __( 'DSFM: Float Right' , DSFM_SLUG ),
				'interactable' => false
			],
			'dsfm-movable' => [
				'title'        => __( 'DSFM: Movable Menu', DSFM_SLUG ),
				'interactable' => true
			]
		) );

		// Register DSFM locations.
		add_action( 'init', array( $this, 'register_nav_menus' ) );

		// Enqueue plugin assets.
		add_action( 'wp_enqueue_scripts', function() {
			if ( true !== $this->has_active_menu() )
				return;

		  wp_enqueue_script( 'dsfm-script', DSFM_ASSETS . 'js/script.js',  array( 'jquery-core' ), DSFM_VERSION );

			if ( true === $this->has_active_menu() )
				wp_enqueue_script( 'dsfm-interactjs', DSFM_ASSETS . 'vendors/interactjs/js/interact.min.js',  array( 'dsfm-script' ), DSFM_VERSION );

			wp_enqueue_style( 'dsfm-style', DSFM_ASSETS . 'css/style.css', array(), DSFM_VERSION );

			// Setting based styles.
			if ( $dynamic_styles = $this->get_dynamic_styles() )
				wp_add_inline_style( 'dsfm-style', $dynamic_styles );
		} );

		// Render menus in/above the footer.
		add_action( 'wp_footer', array( $this, 'render_menu_locations' ) );

		// Add our interactjs vendor class to the menu container where necessary.
		add_filter( 'dsfm_menu_icon_classes', array( $this, 'dsfm_menu_icon_classes_add_interact_class' ), 10, 3 );
		add_filter( 'dsfm_menu_classes', array( $this, 'dsfm_menu_classes_add_interact_class' ), 10, 3 );
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
	 * Add our interactjs vendor class to the menu icon element.
	 *
	 * @access private
	 */
	public function dsfm_menu_icon_classes_add_interact_class( $classes, $menu_id, $menu_data ) {
		if (
			   'dsfm-movable' === $menu_id
			&& true === $menu_data['interactable']
		)
			$classes[] = 'menu_interactable';

		return $classes;
	}

	/**
	 * Add our interactjs vendor class to the menu wrapper element.
	 *
	 * @access private
	 */
	public function dsfm_menu_classes_add_interact_class( $classes, $menu_id, $menu_data ) {
		// if (
		// 	   'dsfm-movable' === $menu_id
		// 	&& true === $menu_data['interactable']
		// )
		// 	$classes[] = 'menu_interactable';

		return $classes;
	}

	/**
	 * Add menu locations to the WordPress menus manager page.
	 *
	 * @access public
	 */
	public function register_nav_menus() {
		$menu_locations = [];

		foreach ( $this->menu_locations as $menu_id => $menu_data )
			$menu_locations[$menu_id] = $menu_data['title'];

		register_nav_menus( $menu_locations );
	}

	/**
	 * Check if a DSFM menu has been assigned.
	 *
	 * @access public
	 */
	public function has_active_menu( $menu_locations = [] ) {
		if ( empty( $menu_locations ) )
			$menu_locations = $this->menu_locations;

		foreach( $menu_locations as $menu_id => $menu_data )
			if ( has_nav_menu( $menu_id ) )
				return true;

		return false;
	}

	/**
	 * Return dynamic styles.
	 *
	 * @access public
	 */
	public function get_dynamic_styles() {
		$styles = '';

		if ( empty( $this->settings ) )
			return $styles;

		return $styles;
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
