<?php if( !defined( 'ABSPATH' ) ) exit;

$dsfm = DS_FLOATED_MENU::get_instance();
// echo '<pre>'; print_r( $dsfm ); echo '</pre>';
?>

<div class="ds-wrapper">
	<h1><?php echo DSFM_TITLE; ?></h1>
	<div class="wrap mt-0">
		<div class="ds-container ds-p-0 ds-mb-2">
			<div class="ds-row">
				<div class="ds-col">
					<h2 id="ds-header-notices" class="pt-0 pb-0 ds-d-none"></h2><!-- WP Notices render after the first <h2> tag in class="wrap" -->
					<div id="dsfm-form-saved-notice" class="notice notice-success ds-m-0 ds-mb-2"><p>Settings saved</p></div>
				</div><!-- .ds-col -->
			</div><!-- .ds-row -->
		</div><!-- .ds-container -->
		<div class="ds-container ds-p-0">
			<div class="ds-row">
				<?php
				/*
				███    ███  █████  ██ ███    ██
				████  ████ ██   ██ ██ ████   ██
				██ ████ ██ ███████ ██ ██ ██  ██
				██  ██  ██ ██   ██ ██ ██  ██ ██
				██      ██ ██   ██ ██ ██   ████
				*/
				?>
				<div class="ds-col-12 ds-col-lg-9 ds-mb-2">
					<form id="dsfm-form-main" method="post" action="options.php">
						<div id="dsfm-form-loading-panel"></div>
						<?php settings_fields( 'dsfm_settings' ); ?>
						<div id="content" class="">
							<?php
							/*
							██████  ██       ██████   ██████ ██   ██                ██████  ███████ ███    ██ ███████ ██████   █████  ██
							██   ██ ██      ██    ██ ██      ██  ██                ██       ██      ████   ██ ██      ██   ██ ██   ██ ██
							██████  ██      ██    ██ ██      █████       █████     ██   ███ █████   ██ ██  ██ █████   ██████  ███████ ██
							██   ██ ██      ██    ██ ██      ██  ██                ██    ██ ██      ██  ██ ██ ██      ██   ██ ██   ██ ██
							██████  ███████  ██████   ██████ ██   ██                ██████  ███████ ██   ████ ███████ ██   ██ ██   ██ ███████
							*/
							?>
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-admin-generic"></span>
												<?php _e( 'General', DSFM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Enabled', DSFM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<label class="ds-toggler">
														<input
															name="dsfm_settings[enabled]"
															type="checkbox"
															value="1"
															<?php echo ( !empty( $dsfm->settings['enabled'] ) ? ' checked="checked"' : ''); ?> />
															<span></span>
													</label>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<div class="ds-row dsfm-sticky-bottom">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-body ds-p-1">
											<?php
											submit_button('', 'button-primary button-hero', '', false );
											?>
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
						</div><!-- #content -->
					</form><!-- #dsfm-form-main -->
				</div><!-- .ds-col -->
				<?php
				/*
				███████ ██ ██████  ███████ ██████   █████  ██████
				██      ██ ██   ██ ██      ██   ██ ██   ██ ██   ██
				███████ ██ ██   ██ █████   ██████  ███████ ██████
				     ██ ██ ██   ██ ██      ██   ██ ██   ██ ██   ██
				███████ ██ ██████  ███████ ██████  ██   ██ ██   ██
				*/
				?>
				<div class="ds-col-12 ds-col-lg-3">
					<div class="ds-row ds-mb-2">
						<div class="ds-col">
							<div class="ds-block">
								<div class="ds-block-title">
									<h2>
										<span class="dashicons dashicons-feedback"></span>
										<?php _e( 'Support', DSFM_SLUG ); ?>
									</h2>
								</div>
								<div class="ds-block-body">
									<?php _e( 'If you require assistance please open a support ticket on the divSpot website by filling in the <a href="https://www.divspot.co.za/support" target="_blank">support form</a>.', DSFM_SLUG ); ?>
								</div><!-- .ds-block-body -->
							</div><!-- .ds-block -->
						</div><!-- .ds-col -->
					</div><!-- .ds-row -->
					<div class="ds-row ds-mb-2">
						<div class="ds-col">
							<div class="ds-block">
								<div class="ds-block-title">
									<h2>
										<span class="dashicons dashicons-feedback"></span>
										<?php _e( 'Review', DSFM_SLUG ); ?>
									</h2>
								</div>
								<div class="ds-block-body">
									<?php _e( 'Thank you for using divSpot. If you like our plugins please support us by <a href="https://wordpress.org/plugins/ds-site-message/#reviews" target="_blank">submitting a review</a>.', DSFM_SLUG ); ?>
								</div><!-- .ds-block-body -->
							</div><!-- .ds-block -->
						</div><!-- .ds-col -->
					</div><!-- .ds-row -->
				</div><!-- .ds-col -->
			</div><!-- .ds-row -->
		</div><!-- .ds-container -->
	</div><!-- .wrap -->
</div><!-- .ds-wrapper -->
