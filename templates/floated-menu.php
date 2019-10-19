<?php if( !defined( 'ABSPATH' ) ) exit; ?>
<!-- DS Floated Menu -->
<div id="ds-floated-menu-container">
	<?php
	$dsfm = DS_FLOATED_MENU::get_instance();

	foreach( $dsfm->menu_locations as $location => $name ) {
		wp_nav_menu( array(
			'theme_location' => $location,                // Menu location.
			'container_id'   => $location . '-container', // Menu container id.
			'menu_id'        => $location,                // Menu element id.
			'before'         => '',                       // Elements before the menu list item element.
			'depth'          => 1,                        // Menu hierarchy depth.
			'fallback_cb'    => false                     // Menu fallback.
		) );
	}
	?>
</div>
