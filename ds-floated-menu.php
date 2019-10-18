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

define( 'DSFM_BASENAME', plugin_basename( __FILE__ ) );
define( 'DSFM_URL'     , plugins_url( '', DSFM_BASENAME ) . '/' ); // User-Friendly URL
define( 'DSFM_ROOT'    , __DIR__ . '/' ); // FTP Path
define( 'DSFM_ADMIN'   , DSFM_URL . 'admin/' ); // FTP Path
define( 'DSFM_ASSETS'  , DSFM_URL . 'assets/' ); // FTP Path
define( 'DSFM_TITLE'   , 'DS Floated Menu' );
define( 'DSFM_SLUG'    , sanitize_title( DSFM_TITLE ) ); // Plugin slug.
define( 'DSFM_VERSION' , '1.0' );


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
