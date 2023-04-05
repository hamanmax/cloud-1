<?php

namespace Kubio\Theme;

use ColibriWP\Theme\Core\Utils;
use ColibriWP\Theme\Defaults;
use ColibriWP\Theme\Theme as ThemeBase;
use ColibriWP\Theme\View;

class Theme extends ThemeBase {

	private $state = array();

	public function afterSetup() {
		parent::afterSetup();
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueThemeInfoPageScripts' ), 20 );

	}

	public function addThemeInfoPage() {
		return;
	}

	public function enqueueThemeInfoPageScripts() {
		global $plugin_page;
		$slug = get_template() . '-page-info';

		if ( $plugin_page === $slug || $this->shouldDisplayAdminNotice() ) {
			wp_enqueue_style( $slug );
			wp_enqueue_script( $slug );
			wp_enqueue_script( 'wp-util' );
		}

		if ( $this->shouldDisplayAdminNotice() ) {
			ob_start();

			?>
				<script>
					jQuery(function($){
							$(".kubio-admin-big-notice").show();
					});
				</script>
			<?php
			$script = strip_tags( ob_get_clean() );
			wp_add_inline_script( 'jquery', $script );
		}
	}

	public function shouldDisplayAdminNotice() {

		global $pagenow;
		if ( Flags::get( 'kubio_activation_time', false ) ) {
			return false;
		}

		$slug = get_template() .'-page-info';

		if ( get_option( "{$slug}-theme-notice-dismissed", false ) !== false ) {
			return false;
		}

		if ( apply_filters( 'kubio_is_enabled', false ) ) {
			return false;
		}

		if ( $pagenow === 'update.php' ) {
			return false;
		}

		return true;
	}

	public function addThemeNotice() {

		if ( $this->shouldDisplayAdminNotice() ) :
			?>
			<div class="notice notice-success is-dismissible kubio-admin-big-notice notice-large">
				<?php View::make( 'admin/admin-notice' ); ?>
			</div>
			<script>
			
			</script>
			<?php
		endif;
	}

	public function themeWasCustomized() {

		if ( Flags::get( 'theme_customized' ) ) {
			return true;
		}

		$mods         = get_theme_mods();
		$mods_keys    = array_keys( is_array( $mods ) ? $mods : array() );
		$default_keys = array_keys( Defaults::getDefaults() );

		foreach ( $default_keys as $default_key ) {
			foreach ( $mods_keys as $mod_key ) {
				if ( strpos( $mod_key, "{$default_key}." ) === 0 ) {
					Flags::set( 'theme_customized', true );

					return true;
				}
			}
		}

		return false;
	}


	public function getState( $path, $fallback = null ) {
		return Utils::pathGet( $this->state, $path, $fallback );
	}

	public function setState( $path, $value ) {
		Utils::pathSet( $this->state, $path, $value );
	}

	public function deleteState( $path ) {
		Utils::pathDelete( $this->state, $path );
	}

	public function getName() {
		$slug  = $this->getThemeSlug();
		$theme = $this->getTheme( $slug );

		return $theme->get( 'Name' );
	}

	public function getScreenshot() {
		$slug  = $this->getThemeSlug();
		$theme = $this->getTheme( $slug );

		return $theme->get_screenshot();
	}

	public function getFrontPagePreview() {
		return  Theme::rootDirectoryUri() . '/resources/images/front-page-preview.jpg';
	}


}
