<?php

/**
 *
 * Sets up theme defaults and registers support for various WordPress features.
 */

use ColibriWP\Theme\Core\Hooks;
use ColibriWP\Theme\Defaults;
use Kubio\Theme\Components\CssOutput;
use Kubio\Theme\Components\Footer;
use Kubio\Theme\Components\FrontHeader\Buttons;
use Kubio\Theme\Components\FrontHeader\Hero as FrontPageHero;
use Kubio\Theme\Components\FrontHeader\Image;
use Kubio\Theme\Components\FrontHeader\Navigation;
use Kubio\Theme\Components\FrontHeader\Subtitle;
use Kubio\Theme\Components\FrontHeader\Title;
use Kubio\Theme\Components\FrontHeader\TopBar;
use Kubio\Theme\Components\FrontHeader\TopBarListIcons;
use Kubio\Theme\Components\FrontHeader\TopBarSocialIcons;
use Kubio\Theme\Components\Header;
use Kubio\Theme\Components\Header\Logo;
use Kubio\Theme\Components\HeaderMenu;
use Kubio\Theme\Components\InnerHeader\Hero as InnerHero;
use Kubio\Theme\Components\InnerHeader\Navigation as InnerNavigation;
use Kubio\Theme\Components\InnerHeader\Title as InnerTitle;
use Kubio\Theme\Components\InnerHeader\TopBar as InnerTopBar;
use Kubio\Theme\Components\MainContent;
use Kubio\Theme\Components\MainContent\ArchiveLoop;
use Kubio\Theme\Components\MainContent\PostLoop;
use Kubio\Theme\Components\PageContent;
use Kubio\Theme\Components\PageNotFound;
use Kubio\Theme\Components\SingleContent;
use Kubio\Theme\Flags;
use Kubio\Theme\Theme;

require_once get_template_directory() . '/vendor/autoload.php';
require_once __DIR__ . '/inc/safari-polyfills.php';

function elevate_wp_register_components( $components ) {
	$namespace = 'ColibriWP\\Theme\\Components';

	$components = array_merge(
		$components,
		array(

			// header components
			'header'               => Header::class,
			'logo'                 => Logo::class,
			'header-menu'          => HeaderMenu::class,

			// inner page fragments
			'inner-nav-bar'        => InnerNavigation::class,
			'inner-hero'           => InnerHero::class,
			'inner-title'          => InnerTitle::class,
			'inner-top-bar'        => InnerTopBar::class,

			// front page fragments
			'front-hero'           => FrontPageHero::class,
			'front-title'          => Title::class,
			'front-subtitle'       => Subtitle::class,
			'buttons'              => Buttons::class,
			'front-nav-bar'        => Navigation::class,
			'top-bar-list-icons'   => TopBarListIcons::class,
			'top-bar-social-icons' => TopBarSocialIcons::class,
			'front-top-bar'        => TopBar::class,
			'front-image'          => Image::class,

			// footer components
			'front-footer'         => Footer::class,

			// general components
			'css'                  => CssOutput::class,

			// page content
			'main'                 => MainContent::class, // blog loop
			'single'               => SingleContent::class, // single page
			'content'              => PageContent::class, // inner page content
			'front-page-content'   => "{$namespace}\\FrontPageContent", // front page content
			'search'               => "{$namespace}\\PageSearch", // search page
			'page-not-found'       => PageNotFound::class, // 404 page

			// inner content fragments

			// main content
			'main-loop'            => ArchiveLoop::class, // no usage found
			'post-loop'            => PostLoop::class, // single page content
			'archive-loop'         => ArchiveLoop::class, // blog page content

		)
	);

	return $components;
}

Hooks::prefixed_add_filter( 'components', 'elevate_wp_register_components', 20 );
Theme::load(
	array(
		'themeBaseRelativePath' => '',
		'themeRelativePath'     => '',
	)
);

/**
 * @return Theme
 */
function elevate_wp_theme() {
	return Theme::getInstance();
}

function elevate_wp_assets() {
	return elevate_wp_theme()->getAssetsManager();
}


elevate_wp_theme()
	->add_theme_support( 'automatic-feed-links' )
	->add_theme_support( 'title-tag' )
	->add_theme_support( 'post-thumbnails' )
	->add_theme_support(
		'custom-logo',
		array(
			'flex-height' => true,
			'flex-width'  => true,
			'width'       => 150,
			'height'      => 70,
		)
	)
	->register_menus(
		array(
			'header-menu' => esc_html__( 'Header Menu', 'elevate-wp' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'elevate-wp' ),
		)
	);

if ( ! apply_filters( 'kubio_is_enabled', false ) ) {
	elevate_wp_assets()
		->registerTemplateScript(
			'elevate-theme',
			'/theme/theme.js',
			array( 'jquery', 'jquery-effects-slide', 'jquery-effects-core' )
		)
		->registerStylesheet( 'elevate-theme', '/theme/theme.css' );

	foreach ( Defaults::get( 'fonts', array() ) as $family => $variants ) {
		elevate_wp_assets()->addGoogleFont( $family, $variants );
	}

	add_action( 'wp_enqueue_scripts', 'elevate_wp_print_color_scheme', 0 );
} else {
	elevate_wp_assets()
		->registerStyle( 'elevate-theme', elevate_wp_assets()->getBaseURL() . '/theme/fse-base-style.css' );
	Hooks::prefixed_add_filter( 'skip_google_fonts', '__return_true' );
}

add_theme_support(
	'woocommerce',
	array(
		'product_grid' => array(
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 3,
			'min_columns'     => 2,
			'max_columns'     => 4,
		),
	)
);
add_theme_support( 'kubio-woocommerce' );

Hooks::add_wp_ajax(
	'front_set_predesign',
	function () {
		Flags::set( 'import_design', true );
		wp_send_json_success();
	}
);

function elevate_wp_get_builder_plugin_slug() {

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$plugins = get_plugins();

	if ( isset( $plugins['kubio-pro/plugin.php'] ) ) {
		return 'kubio-pro';
	}

	return 'kubio';
}

function elevate_wp_theme_plugins( $plugins ) {

	$plugin_slug = elevate_wp_get_builder_plugin_slug();

	$plugins[ $plugin_slug ] = array(
		'name'        => $plugin_slug === 'kubio-pro' ? __( 'Kubio PRO', 'elevate-wp' ) : __( 'Kubio', 'elevate-wp' ),
		'description' => \ColibriWP\Theme\Translations::translate( 'page_builder_plugin_description' ),
		'plugin_path' => $plugin_slug . '/plugin.php',
	);

	return $plugins;
}

Hooks::prefixed_add_filter( 'theme_plugins', 'elevate_wp_theme_plugins' );

Hooks::prefixed_add_action(
	'after_plugin_activated',
	function ( $slug ) {

		if ( $slug === elevate_wp_get_builder_plugin_slug() ) {
			$hash = uniqid( 'activate-' );

			Flags::set( 'activation-hash', $hash );

			$url = add_query_arg(
				array(
					'page'                    => 'kubio-get-started',
					'kubio-activation-hash'   => $hash,
					'kubio-designed-imported' => intval( ! ! Flags::get( 'import_design', false ) ),
				),
				admin_url( 'admin.php' )
			);

			wp_send_json_success(
				array(
					'redirect' => $url,
				)
			);
		}
	}
);

add_action(
	'kubio/admin-page/before-get-started',
	function () {
		if ( isset( $_GET['kubio-designed-imported'] ) && intval( $_GET['kubio-designed-imported'] ) ) :?>
			<div class="kubio-admin-page-page-section kubio-get-started-section-1 wrap">
				<div class="kubio-admin-row get-started-imported notice notice-success">
					<div>
						<p class="imported-title">
							<?php
							echo esc_html(
								sprintf(
									__( '%s design has been successfully imported!', 'elevate-wp' ),
									elevate_wp_theme()->getName()
								)
							);
							?>
						</p>
						<p class="imported-subtitle">
							<?php
							echo esc_html(
								sprintf(
									__( '%s design has been successfully imported! You can take a look at your new design or start editing it', 'elevate-wp' ),
									elevate_wp_theme()->getName()
								)
							);
							?>
						</p>
					</div>
					<div class="button imported-view-site-button">
						<a href="<?php echo esc_url( site_url() ); ?>">
							<?php echo esc_html_e( 'View site', 'elevate-wp' ); ?>
						</a>

					</div>
				</div>
			</div>

			<?php
		endif;
	}
);

add_filter( 'kubio/has_block_templates_support', '__return_true' );
