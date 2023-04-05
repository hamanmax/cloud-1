<?php

if ( ! class_exists( 'QodeEssentialAddons_Installation_Notice' ) ) {
	class QodeEssentialAddons_Installation_Notice {
		private static $instance;

		function __construct() {

			// Include scripts for Qode Essential Addons plugin notice
			add_action( 'admin_enqueue_scripts', array( $this, 'register_essential_addons_plugin_notice_script' ) );

			// Add admin notice for Qode Essential Addons plugin installation
			add_action( 'admin_notices', array( $this, 'qode_essential_addons_plugin_notice' ) );

			// Function that handles Qode Essential Addons plugin dismiss notice
			add_action( 'wp_ajax_qi_dismiss_essential_addons_plugin_notice', array( $this, 'qi_dismiss_essential_addons_plugin_notice' ) );

			// Function that handles Qode Essential Addons plugin installation/activation
			add_action( 'wp_ajax_qi_essential_addons_plugin_installation', array( $this, 'qi_essential_addons_plugin_installation' ) );
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function is_plugin_installed( $plugin ) {
			$plugins = get_plugins();

			if ( isset( $plugins[ $plugin ] ) ) {
				return true;
			}

			return false;
		}

		function qode_essential_addons_plugin_notice() {
			if ( defined( 'QODE_ESSENTIAL_ADDONS_VERSION' ) || get_option( 'qi_essential_plugin_notice' ) || ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			if ( ! $this->is_plugin_installed( 'qode-essential-addons/class-qodeessentialaddons.php' ) ) {
				$button_label = esc_html__( 'Install Qode Essential Addons', 'qi' );
				$data_action  = 'install';
			} elseif ( ! defined( 'QODE_ESSENTIAL_ADDONS_VERSION' ) ) {
				$button_label = esc_html__( 'Activate Qode Essential Addons', 'qi' );
				$data_action  = 'activate';
			} else {
				return;
			}
			?>
			<div id="" class="qi-essential-addons-plugin-notice-wrapper notice is-dismissible notice-info">
				<div class="qi-essential-addons-plugin-notice-wrapper-inner">
					<div class="qi-essential-addons-plugin-notice-left-section">
						<h2 class="qi-essential-addons-plugin-notice-title"><?php echo esc_html__( 'Thanks for choosing QI Theme!', 'qi' ); ?></h2>
						<p class="qi-essential-addons-plugin-notice-description"><?php /* translators: %s: <strong> <a> */ printf( esc_html__( 'Install %1$sQode Essential Addons%2$s to launch an optimized design in minutes.', 'qi' ), '<a href="https://wordpress.org/plugins/qode-essential-addons/" target="_blank">', '</a>', '<strong>', '</strong>' ); ?></p>
						<p class="qi-essential-addons-plugin-notice-submit">
							<button class="qi-install-essential-addons-btn button-primary" data-redirect-url="<?php echo esc_url( admin_url( '?page=qode_essential_addons_general_menu' ) ); ?>" data-activating-label="<?php echo esc_attr__( 'Activating...', 'qi' ); ?>" data-installing-label="<?php echo esc_attr__( 'Installing...', 'qi' ); ?>" data-action="<?php echo esc_attr( $data_action ); ?>"><?php echo esc_html( $button_label ); ?></button>
						</p>
					</div>
					<div class="qi-essential-addons-plugin-notice-right-section">
						<div class="qi-essential-addons-plugin-notice-image-holder">
						</div>
					</div>
				</div>
<!--				<a class="qi-essential-addons-plugin-notice-dismiss">-->
<!--					<svg x="0px" y="0px" width="11px" height="11px" viewBox="0 0 11 11" enable-background="new 0 0 11 11" xml:space="preserve">-->
<!--						<g>-->
<!--							<path d="M0.288,9.678L4.419,5.5L0.288,1.32c-0.376-0.344-0.384-0.696-0.022-1.057c0.359-0.359,0.71-0.352,1.055,0.024L5.5,4.419-->
<!--								l4.179-4.132c0.346-0.376,0.696-0.383,1.058-0.024c0.359,0.36,0.352,0.713-0.024,1.057L6.58,5.5l4.132,4.179-->
<!--								c0.376,0.346,0.384,0.697,0.024,1.057c-0.361,0.36-0.712,0.353-1.058-0.023L5.5,6.58L1.32,10.711-->
<!--								c-0.345,0.376-0.696,0.384-1.055,0.023C-0.097,10.375-0.088,10.024,0.288,9.678z"/>-->
<!--						</g>-->
<!--					</svg>-->
<!--				</a>-->
				<?php wp_nonce_field( 'qi-essential-addons-plugin-notice-nonce', 'qi-essential-addons-plugin-notice-nonce' ); ?>
			</div>
			<?php

			wp_enqueue_script( 'qi-essential-addons-notice' );
			wp_enqueue_style( 'qi-essential-addons-notice' );
		}

		public function register_essential_addons_plugin_notice_script() {
			wp_register_script( 'qi-essential-addons-notice', QI_INC_ROOT . '/qode-essential-addons/assets/admin/js/qode-essential-addons-installation-notice.min.js', array( 'jquery' ), false, false );
			wp_register_style( 'qi-essential-addons-notice', QI_INC_ROOT . '/qode-essential-addons/assets/admin/css/qode-essential-addons-installation-notice.min.css' );
		}

		public function qi_dismiss_essential_addons_plugin_notice() {
			check_ajax_referer( 'qi-essential-addons-plugin-notice-nonce', 'nonce' );

			update_option( 'qi_essential_plugin_notice', true, false );
		}

		public function qi_essential_addons_plugin_installation() {
			check_ajax_referer( 'qi-essential-addons-plugin-notice-nonce', 'nonce' );

			if ( isset( $_POST ) ) {

				if ( ! function_exists( 'get_plugins' ) ) {
					require_once ABSPATH . 'wp-admin/includes/plugin.php';
				}

				$plugin_action = $_POST['pluginAction'];
				$redirect_url  = $_POST['redirectUrl'];
				$plugin_slug   = 'qode-essential-addons/class-qodeessentialaddons.php';
				$download_url  = 'https://downloads.wordpress.org/plugin/qode-essential-addons.zip';

				if ( 'install' === $plugin_action ) {

					ob_start();
					include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
					wp_cache_flush();

					$skin     = new WP_Ajax_Upgrader_Skin();
					$upgrader = new Plugin_Upgrader( $skin );

					$install_result = $upgrader->install( $download_url );

					if ( ! is_wp_error( $install_result ) && $install_result ) {
						$activate = activate_plugin( $plugin_slug, '', false, true );

						if ( null === $activate ) {
							qi_get_ajax_status( 'success', esc_html__( 'Installed and activated', 'qi' ), array(), $redirect_url );
						}
					}
				} else {
					$activate = activate_plugin( $plugin_slug, '', false, true );

					if ( null === $activate ) {
						qi_get_ajax_status( 'success', esc_html__( 'Activated', 'qi' ), array(), $redirect_url );
					}
				}

				wp_die();
			}
		}
	}

	QodeEssentialAddons_Installation_Notice::get_instance();
}
