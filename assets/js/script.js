jQuery( document ).ready( function() {
	const $dsfm_containers = jQuery( '[id^="dsfm-"][id$="-container"]' );
	const $dsfm_focus_panel = jQuery( '#dsfm-focus-panel' );

	force_menu_height_even( $dsfm_containers );

	// Handle menu state.
	jQuery( document ).mouseup( e => {
		if (
			   !$dsfm_containers.is( e.target ) // if the target of the click isn't the container...
			&& $dsfm_containers.has( e.target ).length === 0 // ... nor a descendant of the container
		) {
			$dsfm_containers.removeClass( 'active' );
			$dsfm_focus_panel.removeClass( 'active' );
		}
	 } );

	jQuery( '.dsfm-hamburger-icon' ).on( 'click', e => {
		jQuery( e.target ).closest( $dsfm_containers ).toggleClass( 'active' );
		$dsfm_focus_panel.toggleClass( 'active' );
	} );

	// Handle sub-menu state.
	$dsfm_containers.find( '.menu-item-has-children > a > span' ).on( 'click', e => {
		e.preventDefault();

		var this_dsfm_menu = jQuery( e.target ).closest( '[id^="dsfm-"][id$="-container"]' );

		force_menu_height_even( this_dsfm_menu, true ); // Clear dynamic height to allow animation.

		jQuery( e.target ).parent( 'a' ).siblings( '.sub-menu' ).slideToggle( 'fast', function() {
			force_menu_height_even( this_dsfm_menu );

			if ( 'true' !== jQuery( e.target ).parent( 'a' ).attr( 'aria-expanded' ) )
				jQuery( e.target ).parent( 'a' ).attr( 'aria-expanded', true );
			else
				jQuery( e.target ).parent( 'a' ).attr( 'aria-expanded', false );
		} );
	} );
} );

/*
██ ███    ██ ████████ ███████ ██████   █████   ██████ ████████   ██ ███████     ███    ███  ██████  ██    ██  █████  ██████  ██      ███████
██ ████   ██    ██    ██      ██   ██ ██   ██ ██         ██      ██ ██          ████  ████ ██    ██ ██    ██ ██   ██ ██   ██ ██      ██
██ ██ ██  ██    ██    █████   ██████  ███████ ██         ██      ██ ███████     ██ ████ ██ ██    ██ ██    ██ ███████ ██████  ██      █████
██ ██  ██ ██    ██    ██      ██   ██ ██   ██ ██         ██ ██   ██      ██     ██  ██  ██ ██    ██  ██  ██  ██   ██ ██   ██ ██      ██
██ ██   ████    ██    ███████ ██   ██ ██   ██  ██████    ██  █████  ███████     ██      ██  ██████    ████   ██   ██ ██████  ███████ ███████
*/
jQuery( document ).ready( function() {
	interact( '.menu_interactable' ).draggable( {          // make the element fire drag events
		inertia: true,                    // start inertial movement if thrown
		modifiers: [
			interact.modifiers.restrictRect( {
				restriction: 'body',
				// endOnly: true
			} )
		],
		autoScroll: true,
		listeners: {
			move: function( event ) {
				var target = event.target;
				// keep the dragged position in the data-x/data-y attributes
				var x = ( parseFloat( target.getAttribute( 'data-x' ) ) || 0) + event.dx;
				var y = ( parseFloat( target.getAttribute( 'data-y' ) ) || 0) + event.dy;

				// translate the element
				target.style.transform = 'translate( ' + x + 'px, ' + y + 'px )';

				// update the posiion attributes
				target.setAttribute( 'data-x', x );
				target.setAttribute( 'data-y', y );
			}
		}
	} );
} );

/*
 * Calculate dynamic menu height in order to prevent odd pixel height containers.
 * Odd pixel values result in blurry HTML elements. This is a known browser glitch.
 */
function force_menu_height_even( dsfm_menu, clear_only ) {
	var clear_only = clear_only || false;

	dsfm_menu.each( function( key, menu_container ) {
		if ( jQuery( menu_container ).hasClass( 'dsfm-height-100' ) )
			return;

		jQuery( menu_container ).prop( 'style', false );

		if (
			   true !== clear_only
			&& 0 !== jQuery( menu_container ).outerHeight() % 2
		)
			jQuery( menu_container ).css( 'height', jQuery( menu_container ).outerHeight() - 1 ); // Deduct a single pixel in order to calculate an even integer height.
	} );
}
