<?php
if( !defined( 'ABSPATH' ) ) exit;

$dsfm = DS_FLOATED_MENU::get_instance();

foreach( $dsfm->menu_locations as $location => $name ) {
	if ( has_nav_menu( $location ) ) {
		$menu_html = '<div id="' . $location . '-container">';

		$menu_icon_classes = array(
			'dsfm-hamburger-icon',
			'ds-d-flex',
			'ds-flex-wrap',
			'ds-flex-align-center'
		);

		$menu_html .= '<div class="' . implode( ' ', apply_filters( 'dsfm_menu_icon_classes', $menu_icon_classes ) ) . '">' .
			'<span></span>' .
			'<span></span>' .
			'<span></span>' .
		'</div>';

		$menu_classes = array();

		if ( !empty( $dsfm->settings['menu_submenu_links_clickable'] ) )
			$menu_classes[] = 'dsfm-submenu-links-clickable';

		$menu_html .= wp_nav_menu( array(
			'theme_location' => $location,                                                      // Menu location.
			'container'      => '',                                                             // Menu HTML wrapper.
			'menu_id'        => $location,                                                      // Menu element id.
			'menu_class'     => implode( apply_filters( 'dsfm_menu_classes', $menu_classes ) ), // Menu element classes.
			'link_after'     => '<span></span>',                                                // Menu link element text/html.
			'before'         => '',                                                             // HTML before each menu list item element.
			'depth'          => 0,                                                              // Menu hierarchy depth. 0 = infinite.
			'fallback_cb'    => false,                                                          // Menu fallback.
			'echo'           => false                                                           // Echo the menu on true, return on false.
		) );

		$menu_html .= '</div>';

		echo $menu_html;
	}
}
?>
