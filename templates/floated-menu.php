<?php
if( !defined( 'ABSPATH' ) ) exit;

$dsfm = DS_FLOATED_MENU::get_instance();

foreach( $dsfm->menu_locations as $location => $name ) {
	if ( has_nav_menu( $location ) ) {
		$menu_html = '<div id="' . $location . '-container">';

			$menu_html .= '<div class="dsfm-hamburger-icon ds-d-flex ds-flex-wrap ds-flex-align-center">' .
				'<span></span>' .
				'<span></span>' .
				'<span></span>' .
			'</div>';

			$menu_html .= wp_nav_menu( array(
				'theme_location' => $location,            // Menu location.
				'container'      => '',                   // Menu HTML wrapper.
				'menu_id'        => $location,            // Menu element id.
				'before'         => '',                   // HTML before each menu list item element.
				'depth'          => 0,                    // Menu hierarchy depth.
				'fallback_cb'    => false,                // Menu fallback.
				'echo'           => false                 // Echo the menu on true, return on false.
			) );

		$menu_html .= '</div>';

		echo $menu_html;
	}
}
?>
