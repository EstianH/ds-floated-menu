<?php if( !defined( 'ABSPATH' ) ) exit;

$dsfm = DS_FLOATED_MENU::get_instance();
// echo '<pre>'; print_r( $dsfm ); echo '</pre>';
$tabs = array( 'Settings: Floated Menus', 'Settings: Movable Menus' );
$active_tab = ( !empty( $_GET['tab'] ) ? $_GET['tab'] : $tabs[0] );
?>

<div class="ds-wrapper">
	<h1><?php echo DSFM_TITLE; ?></h1>
	<div class="wrap mt-0">
		<div class="ds-container ds-p-0 ds-mb-2">
			<div class="ds-row">
				<div class="ds-col">
					<h2 id="ds-header-notices" class="pt-0 pb-0 ds-d-none"></h2><!-- WP Notices render after the first <h2> tag in class="wrap" -->
					<div id="dsfm-form-saved-notice" class="notice notice-success ds-m-0 ds-mb-2"><p>Settings saved</p></div>
					<div class="ds-tab-nav-wrapper ds-tab-nav-wrapper-animate">
						<?php
						foreach( $tabs as $tab )
							echo '<a href="#' . sanitize_title( $tab ) . '" class="ds-tab-nav' . ( $active_tab === $tab ? ' active' : '' ) . '">' . ucfirst( $tab ) . '</a>';
						?>
					</div><!-- .ds-tab-nav-wrapper -->
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
						<?php settings_fields( 'dsfm_settings' );
						/*
						████████  █████  ██████      ███████ ███████ ████████ ████████ ██ ███    ██  ██████  ███████     ███████ ██       ██████   █████  ████████ ███████ ██████
						   ██    ██   ██ ██   ██     ██      ██         ██       ██    ██ ████   ██ ██       ██          ██      ██      ██    ██ ██   ██    ██    ██      ██   ██
						   ██    ███████ ██████      ███████ █████      ██       ██    ██ ██ ██  ██ ██   ███ ███████     █████   ██      ██    ██ ███████    ██    █████   ██   ██
						   ██    ██   ██ ██   ██          ██ ██         ██       ██    ██ ██  ██ ██ ██    ██      ██     ██      ██      ██    ██ ██   ██    ██    ██      ██   ██
						   ██    ██   ██ ██████      ███████ ███████    ██       ██    ██ ██   ████  ██████  ███████     ██      ███████  ██████  ██   ██    ██    ███████ ██████
						*/
						?>
						<div id="settings-floated-menus" class="ds-tab-content active">
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
												<span class="dashicons dashicons-admin-customizer"></span>
												<?php _e( 'General', DSFM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Menu Height', DSFM_SLUG ); ?>:
													<br /><small>(ex: 100%/auto)</small>
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<input
														class="ds-input-box"
														name="dsfm_settings[floated][menu_height]"
														type="text"
														value="<?php echo ( !empty( $dsfm->settings['floated']['menu_height'] ) ? $dsfm->settings['floated']['menu_height'] : '' ); ?>"
														placeholder="Default: auto" />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<?php
							/*
							██████  ██       ██████   ██████ ██   ██               ██████   █████   ██████ ██   ██  ██████  ██████   ██████  ██    ██ ███    ██ ██████
							██   ██ ██      ██    ██ ██      ██  ██                ██   ██ ██   ██ ██      ██  ██  ██       ██   ██ ██    ██ ██    ██ ████   ██ ██   ██
							██████  ██      ██    ██ ██      █████       █████     ██████  ███████ ██      █████   ██   ███ ██████  ██    ██ ██    ██ ██ ██  ██ ██   ██
							██   ██ ██      ██    ██ ██      ██  ██                ██   ██ ██   ██ ██      ██  ██  ██    ██ ██   ██ ██    ██ ██    ██ ██  ██ ██ ██   ██
							██████  ███████  ██████   ██████ ██   ██               ██████  ██   ██  ██████ ██   ██  ██████  ██   ██  ██████   ██████  ██   ████ ██████
							*/
							?>
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-images-alt"></span>
												<?php _e( 'Background', DSFM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Color', DSFM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<input
														class="wp-color-picker"
														data-alpha="true"
														name="dsfm_settings[floated][background][color]"
														type="text"
														value="<?php echo ( !empty( $dsfm->settings['floated']['background']['color'] ) ? $dsfm->settings['floated']['background']['color'] : '#fff' ); ?>"
														placeholder="#fff" />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<?php $floated_menu_image_url = ( !empty( $dsfm->settings['floated']['background']['image'] ) ? $dsfm->settings['floated']['background']['image'] : '' ); ?>
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Image', DSFM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<div class="ds-image-container">
														<div class="ds-row ds-image-load<?php echo ( empty( $floated_menu_image_url ) ? ' ds-d-none' : '' ); ?>">
															<div class="ds-col-6 ds-col-lg-3">
																<input
																	name="dsfm_settings[floated][background][image]"
																	type="hidden"
																	value="<?php echo $floated_menu_image_url; ?>" />
																<img
																	width="100%"
																	height="auto"
																	src="<?php echo $floated_menu_image_url; ?>" />
															</div>
														</div>
														<div class="ds-row">
															<div class="ds-col-12">
																<button class="button button-secondary ds-image-add<?php echo ( !empty( $floated_menu_image_url ) ? ' ds-d-none' : '' ); ?>" type="button">
																	<?php _e( 'Add image', DSFM_SLUG ); ?>
																</button>
																<button class="button button-secondary ds-image-remove<?php echo ( empty( $floated_menu_image_url ) ? ' ds-d-none' : '' ); ?>" type="button">
																	<?php _e( 'Remove image', DSFM_SLUG ); ?>
																</button>
															</div>
														</div>
													</div>
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
						</div><!-- #settings-floated-menus -->
						<?php
						/*
						████████  █████  ██████      ███████ ███████ ████████ ████████ ██ ███    ██  ██████  ███████     ███    ███  ██████  ██    ██  █████  ██████  ██      ███████
						   ██    ██   ██ ██   ██     ██      ██         ██       ██    ██ ████   ██ ██       ██          ████  ████ ██    ██ ██    ██ ██   ██ ██   ██ ██      ██
						   ██    ███████ ██████      ███████ █████      ██       ██    ██ ██ ██  ██ ██   ███ ███████     ██ ████ ██ ██    ██ ██    ██ ███████ ██████  ██      █████
						   ██    ██   ██ ██   ██          ██ ██         ██       ██    ██ ██  ██ ██ ██    ██      ██     ██  ██  ██ ██    ██  ██  ██  ██   ██ ██   ██ ██      ██
						   ██    ██   ██ ██████      ███████ ███████    ██       ██    ██ ██   ████  ██████  ███████     ██      ██  ██████    ████   ██   ██ ██████  ███████ ███████
						*/
						?>
						<div id="settings-movable-menus" class="ds-tab-content">
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-admin-generic"></span>
												<?php _e( 'Design', DSFM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'LOREM IPSUM', DSFM_SLUG ); ?>:
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
						</div><!-- #settings-movable-menus -->
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
									<?php _e( 'Thank you for using divSpot. If you like our plugins please support us by <a href="https://wordpress.org/plugins/ds-floated-menu/#reviews" target="_blank">submitting a review</a>.', DSFM_SLUG ); ?>
								</div><!-- .ds-block-body -->
							</div><!-- .ds-block -->
						</div><!-- .ds-col -->
					</div><!-- .ds-row -->
				</div><!-- .ds-col -->
			</div><!-- .ds-row -->
		</div><!-- .ds-container -->
	</div><!-- .wrap -->
</div><!-- .ds-wrapper -->
