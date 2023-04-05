<?php

use ColibriWP\Theme\Translations;
use Kubio\Theme\Theme;

wp_localize_script(
	get_template() . '-page-info',
	'elevate_wp_admin',
	array(
		'getStartedData'    => array(
			'plugin_installed_and_active' => Translations::escHtml( 'plugin_installed_and_active' ),
			'activate'                    => Translations::escHtml( 'activate' ),
			'activating'                  => Translations::get( 'activating', 'Kubio Page Builder' ),
			'install_recommended'         => isset( $_GET['install_recommended'] ) ? $_GET['install_recommended'] : '',
			'theme_prefix'                => Theme::prefix( '', false ),
		),
		'builderStatusData' => array(
			'status'       => elevate_wp_theme()->getPluginsManager()->getPluginState( elevate_wp_get_builder_plugin_slug() ),
			'install_url'  => elevate_wp_theme()->getPluginsManager()->getInstallLink( elevate_wp_get_builder_plugin_slug() ),
			'activate_url' => elevate_wp_theme()->getPluginsManager()->getActivationLink( elevate_wp_get_builder_plugin_slug() ),
			'slug'         => elevate_wp_get_builder_plugin_slug(),
			'messages'     => array(
				'installing' => Translations::get( 'installing', 'Kubio Page Builder' ),
				'activating' => Translations::get( 'activating', 'Kubio Page Builder' ),
				'preparing'  => Translations::get( 'preparing_front_page_installation' ),
			),
		),
	)
);

?>
<div class="kubio-admin-notice-spacer">
	<div class="kubio-admin-big-notice--container">
		<div class="content-holder">
			<div class="front-page-preview">
				<div class="kubio-front-page-preview-browser-bar">
					<div class="kubio-front-page-preview-browser-dot"></div>
					<div class="kubio-front-page-preview-browser-dot"></div>
					<div class="kubio-front-page-preview-browser-dot"></div>
				</div>
				<div class="kubio-front-page-preview-image-scroller">
					<img src="<?php echo esc_url( elevate_wp_theme()->getFrontPagePreview() ); ?>"/>
				</div>
			</div>

			<div class="messages-area">
				<div class="title-holder">
					<h1><?php Translations::escHtmlE( 'would_you_like_to_install_front_page', elevate_wp_theme()->getName() ); ?></h1>
				</div>
				<div class="action-buttons">
					<button class="button button-primary button-hero start-with-predefined-design-button">
						<?php Translations::escHtmlE( 'install_homepage', elevate_wp_theme()->getName() ); ?>
					</button>
				</div>
				<div class="content-footer ">
					<div>
						<div class="plugin-notice">
							<span class="spinner"></span>
							<span class="message"></span>
						</div>
					</div>
					<div>
						<p class="description large-text">
							<?php Translations::escHtmlE( 'start_with_a_front_page_plugin_info', 'Kubio Page Builder' ); ?>
						</p>
					</div>
				</div>
			</div>

		</div>
		<div class="kubio-notice-dont-show-container">
			<button class="button-link kubio-dont-show-notice">
				<?php Translations::escHtmlE( 'dont_show_anymore' ); ?>
			</button>
		</div>
	</div>
</div>
