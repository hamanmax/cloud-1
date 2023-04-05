<?php

if ( ! class_exists( 'Qi_Handler' ) ) {
	/**
	 * Main theme class with configuration
	 */
	class Qi_Handler {
		private static $instance;

		public function __construct() {

			// Include required files
			require_once get_template_directory() . '/constants.php';
			require_once QI_ROOT_DIR . '/helpers/helper.php';
			//include_once QI_INC_ROOT_DIR . '/import/class-qi-import.php';

			// Include theme's style and inline style
			add_action( 'wp_enqueue_scripts', array( $this, 'include_css_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_style' ) );

			// Include theme's script and localize theme's main js script
			add_action( 'wp_enqueue_scripts', array( $this, 'include_js_scripts' ) );

			// Add pingback header
			add_action( 'wp_head', array( $this, 'add_pingback_header' ), 1 );

			// Include theme's skip link
			add_action( 'qi_action_after_body_tag_open', array( $this, 'add_skip_link' ), 5 );
			add_action( 'wp_print_footer_scripts', array( $this, 'add_skip_link_focus_fix' ) );

			// Include theme's Google fonts
			add_action( 'qi_action_before_main_css', array( $this, 'include_google_fonts' ) );

			// Add theme's supports feature
			add_action( 'after_setup_theme', array( $this, 'set_theme_support' ) );

			// Enqueue supplemental block editor styles
			add_action( 'enqueue_block_editor_assets', array( $this, 'editor_customizer_styles' ) );

			// Add theme's body classes
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );

			// Include modules
			add_action( 'after_setup_theme', array( $this, 'include_modules' ) );
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function include_css_scripts() {
			// CSS dependency variable
			$main_css_dependency = apply_filters( 'qi_filter_main_css_dependency', array() );

			// Hook to include additional scripts before theme's main style
			do_action( 'qi_action_before_main_css' );

			// Enqueue theme's main grid style
			wp_enqueue_style( 'qi-grid', QI_ASSETS_CSS_ROOT . '/grid.min.css' );

			// Enqueue theme's main style
			wp_enqueue_style( 'qi-main', QI_ASSETS_CSS_ROOT . '/main.min.css', $main_css_dependency );

			// Enqueue theme's style
			wp_enqueue_style( 'qi-style', QI_ROOT . '/style.css' );

			// Hook to include additional scripts after theme's main style
			do_action( 'qi_action_after_main_css' );
		}

		function add_inline_style() {
			$style = apply_filters( 'qi_filter_add_inline_style', $style = '' );

			if ( ! empty( $style ) ) {
				wp_add_inline_style( 'qi-main', $style );
			}
		}

		function include_js_scripts() {
			// JS dependency variable
			$main_js_dependency = apply_filters( 'qi_filter_main_js_dependency', array( 'jquery' ) );

			// Hook to include additional scripts before theme's main script
			do_action( 'qi_action_before_main_js', $main_js_dependency );

			// Enqueue theme's main script
			wp_enqueue_script( 'qi-main-js', QI_ASSETS_JS_ROOT . '/main.min.js', $main_js_dependency, false, true );

			// Hook to include additional scripts after theme's main script
			do_action( 'qi_action_after_main_js' );

			// Include comment reply script
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		function add_pingback_header() {
			if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
				<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
				<?php
			}
		}

		function add_skip_link() {
			echo '<a class="skip-link screen-reader-text" href="#qodef-page-content">' . esc_html__( 'Skip to the content', 'qi' ) . '</a>';
		}

		function add_skip_link_focus_fix() {
			// This does not enqueue the script because it is tiny and because it is only for IE11, thus it does not warrant having an entire dedicated blocking script being loaded.
			?>
			<script>
				/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
			</script>
			<?php
		}

		function include_google_fonts() {
			$font_subset_array = array(
				'latin-ext',
			);

			$font_weight_array = array(
				'400',
				'500',
				'600',
				'700',
			);

			$default_font_family = array(
				'DM Sans',
			);

			$font_weight_str = implode( ',', array_unique( apply_filters( 'qi_filter_google_fonts_weight_list', $font_weight_array ) ) );
			$font_subset_str = implode( ',', array_unique( apply_filters( 'qi_filter_google_fonts_subset_list', $font_subset_array ) ) );
			$fonts_array     = apply_filters( 'qi_filter_google_fonts_list', $default_font_family );

			if ( ! empty( $fonts_array ) ) {
				$modified_default_font_family = array();

				foreach ( $fonts_array as $font ) {
					$modified_default_font_family[] = $font . ':' . $font_weight_str;
				}

				$default_font_string = implode( '|', $modified_default_font_family );

				$fonts_full_list_args = array(
					'family'  => urlencode( $default_font_string ),
					'subset'  => urlencode( $font_subset_str ),
					'display' => 'swap',
				);

				$google_fonts_url = add_query_arg( $fonts_full_list_args, 'https://fonts.googleapis.com/css' );
				wp_enqueue_style( 'qi-google-fonts', esc_url_raw( $google_fonts_url ), array(), '1.0.0' );

				// TODO - temporary fix for WordPress 5.9 to include necessary styles into responsive iframe
				if ( is_admin() ) {
					wp_localize_script(
						'wp-block-editor',
						'qiThemeIframe',
						array(
							'googleFonts' => esc_url_raw( $google_fonts_url ),
						)
					);
				}
			}
		}

		function set_theme_support() {

			// Make theme available for translation
			load_theme_textdomain( 'qi', QI_ROOT_DIR . '/languages' );

			// Add support for feed links
			add_theme_support( 'automatic-feed-links' );

			// Add support for title tag
			add_theme_support( 'title-tag' );

			// Add support for post thumbnails
			add_theme_support( 'post-thumbnails' );

			// Add theme support for Custom Logo
			add_theme_support( 'custom-logo' );

			// Add support for full and wide align images.
			add_theme_support( 'align-wide' );

			// Add support for responsive embedded content.
			add_theme_support( 'responsive-embeds' );

			// Customize selective refresh widgets
			add_theme_support( 'customize-selective-refresh-widgets' );

			// Set the default content width
			global $content_width;
			if ( ! isset( $content_width ) ) {
				$content_width = apply_filters( 'qi_filter_set_content_width', 1300 );
			}

			// Add support for post formats
			add_theme_support( 'post-formats', apply_filters( 'qi_filter_post_formats', array( 'gallery', 'video', 'audio', 'link', 'quote' ) ) );

			// Add theme support for editor style
			add_editor_style( QI_ASSETS_CSS_ROOT . '/editor-style.css' );

			// Add theme starter content support
			add_theme_support(
				'starter-content',
				array(
					// Static front page set to Home, posts page set to Blog
					'options'     => array(
						'show_on_front'  => 'posts',
						'page_on_front'  => '{{home}}',
						'page_for_posts' => '{{blog}}',
					),
					// Starter pages to include
					'posts'       => array(
						'home',
						'about',
						'contact',
						'blog',
					),
					// Add logo to header
					'attachments' => array(
						'logo' => array(
							'post_title' => _x( 'Logo', 'Theme starter content', 'qi' ),
							'file'       => 'assets/img/logo-starter-content.png',
						),
					),

					'theme_mods' => array(
						'custom_logo' => '{{logo}}',
					),
					// Add pages to primary navigation menu
					'nav_menus'  => array(
						'main-navigation' => array(
							'name'  => __( 'Primary Navigation', 'qi' ),
							'items' => array(
								'page_home',
								'page_about',
								'page_blog',
								'page_contact',
							),
						),
					),
					// Add test widgets to footer sidebar
					'widgets'    => array(
						'footer_top_area_column_1'    => array(
							'text_about' => array(
								'text',
								array(
									'title'  => _x( 'About This Site', 'Theme starter content', 'qi' ),
									'text'   => _x( 'This may be a good place to introduce yourself and your site or include some credits.', 'Theme starter content', 'qi' ),
									'filter' => true,
									'visual' => true,
								),
							),
						),
						'footer_top_area_column_2'    => array(
							'categories' => array(
								'categories',
								array(
									'title' => _x( 'Categories', 'Theme starter content', 'qi' ),
								),
							),
						),
						'footer_top_area_column_3'    => array(
							'recent-comments' => array(
								'recent-comments',
								array(
									'title' => _x( 'Recent Comments', 'Theme starter content', 'qi' ),
								),
							),
						),
						'footer_top_area_column_4'    => array(
							'recent-posts' => array(
								'recent-posts',
								array(
									'title' => _x( 'Recent Posts', 'Theme starter content', 'qi' ),
								),
							),
						),
						'footer_top_area_column_5'    => array(
							'archives' => array(
								'archives',
								array(
									'title' => _x( 'Archives', 'Theme starter content', 'qi' ),
								),
							),
						),
						'footer_top_area_column_6'    => array(
							'meta' => array(
								'meta',
								array(
									'title' => _x( 'Meta', 'Theme starter content', 'qi' ),
								),
							),
						),
						'footer_bottom_area_column_1' => array(
							// Widget ID
							'footer_bottom_column_1' => array(
								'text',
								array(
									'text' => '',
								),
							),
						),
						'footer_bottom_area_column_2' => array(
							// Widget ID
							'footer_bottom_column_2' => array(
								'text',
								array(
									'text' => '© 2021 <a href="https://qodeinteractive.com/" target="_blank" rel="noopener">Qode Interactive</a>, All Rights Reserved',
								),
							),
						),
						'footer_bottom_area_column_3' => array(
							'footer_bottom_column_3' => array(
								'text',
								array(
									'text' => '',
								),
							),
						),
					),
				)
			);
		}

		function editor_customizer_styles() {

			// Include theme's Google fonts for Gutenberg editor
			$this->include_google_fonts();

			// Add editor customizer style
			wp_enqueue_style( 'qi-editor-customizer-styles', QI_ASSETS_CSS_ROOT . '/editor-customizer-style.css' );

			// Add Gutenberg blocks style
			wp_enqueue_style( 'qi-gutenberg-blocks-style', QI_INC_ROOT . '/gutenberg/assets/admin/css/gutenberg-blocks.min.css' );
		}

		function add_body_classes( $classes ) {
			$current_theme = wp_get_theme();
			$theme_name    = esc_attr( str_replace( ' ', '-', strtolower( $current_theme->get( 'Name' ) ) ) );
			$theme_version = esc_attr( $current_theme->get( 'Version' ) );

			// Check is child theme activated
			if ( $current_theme->parent() ) {

				// Add child theme version
				$classes[] = $theme_name . '-child-' . $theme_version;

				// Get main theme variables
				$current_theme = $current_theme->parent();
				$theme_name    = esc_attr( str_replace( ' ', '-', strtolower( $current_theme->get( 'Name' ) ) ) );
				$theme_version = esc_attr( $current_theme->get( 'Version' ) );
			}

			if ( $current_theme->exists() ) {
				$classes[] = 'theme-' . $theme_name;
				$classes[] = $theme_name . '-' . $theme_version;
			}

			// Set default grid size value
			if ( ! qi_is_installed( 'core' ) ) {
				$classes[] = 'qodef-content-grid-1300';
			}

			return apply_filters( 'qi_filter_add_body_classes', $classes );
		}

		function include_modules() {

			// Hook to include additional files before modules inclusion
			do_action( 'qi_action_before_include_modules' );

			foreach ( glob( QI_INC_ROOT_DIR . '/*/include.php' ) as $module ) {
				include_once $module;
			}

			// Hook to include additional files after modules inclusion
			do_action( 'qi_action_after_include_modules' );
		}
	}

	Qi_Handler::get_instance();
}
