/*
 █████       ██  █████  ██   ██     ███████  ██████  ██████  ███    ███
██   ██      ██ ██   ██  ██ ██      ██      ██    ██ ██   ██ ████  ████
███████      ██ ███████   ███       █████   ██    ██ ██████  ██ ████ ██
██   ██ ██   ██ ██   ██  ██ ██      ██      ██    ██ ██   ██ ██  ██  ██
██   ██  █████  ██   ██ ██   ██     ██       ██████  ██   ██ ██      ██
*/
jQuery( document ).ready( function() {
	// Convert form submission to Ajax submission.
	jQuery( '#dsfm-form-main' ).submit( function( e ) {
		e.preventDefault();

		jQuery( this ).ajaxSubmit( {
			beforeSend: function() {
				jQuery( '#dsfm-form-loading-panel' ).addClass( 'active' );
			},
			success: function() {
				jQuery( '#dsfm-form-saved-notice' ).addClass( 'active' );
			},
			complete: function() {
				jQuery( '#dsfm-form-loading-panel' ).removeClass( 'active' );

				setTimeout(
					function() {
						jQuery( '#dsfm-form-saved-notice' ).removeClass( 'active' );
					},
					5000
				);
			},
			timeout: 5000
		} );

		return false;
	} );
} );
