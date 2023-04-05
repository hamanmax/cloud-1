<?php

if ( ! function_exists( 'qi_is_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function qi_is_installed( $plugin ) {

		switch ( $plugin ) {
			case 'core':
				return class_exists( 'QodeEssentialAddons' );
			case 'woocommerce':
				return class_exists( 'WooCommerce' );
			case 'gutenberg-page':
				$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : array();

				return method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor();
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'qi_set_qode_theme_as_installed' ) ) {
	/**
	 * Function that set case that Qode theme is installed
	 *
	 * @return bool
	 */
	function qi_set_qode_theme_as_installed() {
		return true;
	}

	add_filter( 'qode_essential_addons_filter_is_qode_theme_installed', 'qi_set_qode_theme_as_installed' );
	add_filter( 'qi_addons_for_elementor_filter_is_qode_theme_installed', 'qi_set_qode_theme_as_installed' );
}

if ( ! function_exists( 'qi_include_theme_is_installed' ) ) {
	/**
	 * Function that set case is installed element for plugin functionality
	 *
	 * @param bool $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function qi_include_theme_is_installed( $installed, $plugin ) {

		if ( 'qi-theme' === $plugin ) {
			return class_exists( 'Qi_Handler' );
		}

		return $installed;
	}

	add_filter( 'qode_essential_addons_filter_framework_is_plugin_installed', 'qi_include_theme_is_installed', 10, 2 );
	add_filter( 'qi_addons_for_elementor_filter_framework_is_plugin_installed', 'qi_include_theme_is_installed', 10, 2 );
}

if ( ! function_exists( 'qi_set_main_theme_style_handle_as_core_inline_dependency' ) ) {
	/**
	 * Function that add main theme style as dependency for plugin style
	 *
	 * @return string
	 */
	function qi_set_main_theme_style_handle_as_core_inline_dependency() {
		return 'qi-main';
	}

	add_filter( 'qode_essential_addons_filter_inline_style_handle', 'qi_set_main_theme_style_handle_as_core_inline_dependency' );
}

if ( ! function_exists( 'qi_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 */
	function qi_template_part( $module, $template, $slug = '', $params = array() ) {
		echo qi_get_template_part( $module, $template, $slug, $params ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'qi_get_template_part' ) ) {
	/**
	 * Function that load module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function qi_get_template_part( $module, $template, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = QI_INC_ROOT_DIR . '/' . $module;

		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params ); // @codingStandardsIgnoreLine
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'qi_get_page_id' ) ) {
	/**
	 * Function that returns current page id
	 * Additional conditional is to check if current page is any wp archive page (archive, category, tag, date etc.) and returns -1
	 *
	 * @return int
	 */
	function qi_get_page_id() {
		$page_id = get_queried_object_id();

		if ( qi_is_wp_template() ) {
			$page_id = - 1;
		}

		return apply_filters( 'qi_filter_page_id', $page_id );
	}
}

if ( ! function_exists( 'qi_is_wp_template' ) ) {
	/**
	 * Function that checks if current page default wp page
	 *
	 * @return bool
	 */
	function qi_is_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'qi_get_button_element' ) ) {
	/**
	 * Function that returns button with provided params
	 *
	 * @param array $params - array of parameters
	 *
	 * @return string - string representing button html
	 */
	function qi_get_button_element( $params ) {
		$link     = isset( $params['link'] ) ? $params['link'] : '#';
		$target   = isset( $params['target'] ) ? $params['target'] : '_self';
		$text     = isset( $params['text'] ) ? $params['text'] : '';
		$classes  = 'qodef--with-icon';
		$classes .= isset( $params['button_layout'] ) ? ' qodef--' . $params['button_layout'] : ' qodef--simple';

		return '<a itemprop="url" class="qodef-theme-button ' . esc_attr( $classes ) . '" href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">' . esc_html( $text ) . qi_get_svg_icon( 'button-arrow', 'qodef-theme-button-icon' ) . '</a>';
	}
}

if ( ! function_exists( 'qi_render_button_element' ) ) {
	/**
	 * Function that render button with provided params
	 *
	 * @param array $params - array of parameters
	 */
	function qi_render_button_element( $params ) {
		echo qi_get_button_element( $params ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'qi_class_attribute' ) ) {
	/**
	 * Function that render class attribute
	 *
	 * @param string|array $class
	 */
	function qi_class_attribute( $class ) {
		echo qi_get_class_attribute( $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'qi_get_class_attribute' ) ) {
	/**
	 * Function that return class attribute
	 *
	 * @param string|array $value
	 *
	 * @return string|mixed
	 */
	function qi_get_class_attribute( $value ) {
		return qi_get_inline_attr( $value, 'class', ' ' );
	}
}

if ( ! function_exists( 'qi_get_inline_attr' ) ) {
	/**
	 * Function that generates html attribute
	 *
	 * @param string|array $value value of html attribute
	 * @param string $attr - name of html attribute to generate
	 * @param string $glue - glue with which to implode $attr. Used only when $attr is array
	 * @param bool $allow_zero_values - allow data to have zero value
	 *
	 * @return string generated html attribute
	 */
	function qi_get_inline_attr( $value, $attr, $glue = '', $allow_zero_values = false ) {
		if ( $allow_zero_values ) {
			if ( '' !== $value ) {

				if ( is_array( $value ) && count( $value ) ) {
					$properties = implode( $glue, $value );
				} else {
					$properties = $value;
				}

				return $attr . '="' . esc_attr( $properties ) . '"';
			}
		} else {
			if ( ! empty( $value ) ) {

				if ( is_array( $value ) && count( $value ) ) {
					$properties = implode( $glue, $value );
				} elseif ( '' !== $value ) {
					$properties = $value;
				} else {
					return '';
				}

				return $attr . '="' . esc_attr( $properties ) . '"';
			}
		}

		return '';
	}
}

if ( ! function_exists( 'qi_render_svg_icon' ) ) {
	/**
	 * Function that print svg html icon
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 */
	function qi_render_svg_icon( $name, $class_name = '' ) {
		echo qi_get_svg_icon( $name, $class_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'qi_get_svg_icon' ) ) {
	/**
	 * Returns svg html
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string|html
	 */
	function qi_get_svg_icon( $name, $class_name = '' ) {
		$html  = '';
		$class = isset( $class_name ) && ! empty( $class_name ) ? 'class="' . esc_attr( $class_name ) . '"' : '';

		switch ( $name ) {
			case 'menu':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="13" x="0px" y="0px" viewBox="0 0 21.3 13.7" xml:space="preserve" aria-hidden="true"><rect x="10.1" y="-9.1" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 11.5 -9.75)" width="1" height="20"/><rect x="10.1" y="-3.1" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 17.5 -3.75)" width="1" height="20"/><rect x="10.1" y="2.9" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 23.5 2.25)" width="1" height="20"/></svg>';
				break;
			case 'search':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18.7px" height="19px" viewBox="0 0 18.7 19" xml:space="preserve"><g><path d="M11.1,15.2c-4.2,0-7.6-3.4-7.6-7.6S6.9,0,11.1,0s7.6,3.4,7.6,7.6S15.3,15.2,11.1,15.2z M11.1,1.4c-3.4,0-6.2,2.8-6.2,6.2s2.8,6.2,6.2,6.2s6.2-2.8,6.2-6.2S14.5,1.4,11.1,1.4z"/></g><g><rect x="-0.7" y="14.8" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -9.9871 6.9931)" width="8.3" height="1.4"/></g></svg>';
				break;
			case 'plus':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 29.4" xml:space="preserve"><polygon points="28.8,12.7 16.8,12.7 16.8,0.7 12.8,0.7 12.8,12.7 0.8,12.7 0.8,16.7 12.8,16.7 12.8,28.7 16.8,28.7 16.8,16.7 28.8,16.7 "/></svg>';
				break;
			case 'close':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 9.1 9.1" xml:space="preserve"><g><path d="M8.5,0L9,0.6L5.1,4.5L9,8.5L8.5,9L4.5,5.1L0.6,9L0,8.5L4,4.5L0,0.6L0.6,0L4.5,4L8.5,0z"/></g></svg>';
				break;
			case 'star':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="15" x="0px" y="0px" viewBox="0 0 16.2 15.2" xml:space="preserve"><g><g><path d="M16.1,5.8l-5,3.5l1.9,5.7l-4.9-3.6l-4.9,3.6l1.9-5.7l-5-3.5h6.1l1.9-5.7L10,5.8H16.1z"/></g></g></svg>';
				break;
			case 'menu-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="6.2px" height="10.8px" viewBox="0 0 6.2 10.8" xml:space="preserve"><g><path d="M0,5.4C0,5.2,0.1,5,0.2,4.9l4.7-4.7c0.3-0.3,0.7-0.3,1,0c0.3,0.3,0.3,0.7,0,1L1.8,5.4l4.1,4.2C6,9.7,6.1,9.9,6.1,10.1c0,0.2-0.1,0.4-0.2,0.5c-0.3,0.3-0.7,0.3-1,0L0.2,5.9C0.1,5.8,0,5.6,0,5.4z"/></g></svg>';
				break;
			case 'menu-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="6.2px" height="10.8px" viewBox="0 0 6.2 10.8" xml:space="preserve" aria-hidden="true"><g><path d="M5.9,5.9l-4.7,4.7c-0.3,0.3-0.7,0.3-1,0c-0.1-0.1-0.2-0.3-0.2-0.5c0-0.2,0.1-0.4,0.2-0.5l4.1-4.2L0.3,1.2c-0.4-0.3-0.4-0.7,0-1c0.3-0.3,0.7-0.3,1,0l4.7,4.7C6.1,5,6.2,5.2,6.2,5.4C6.2,5.6,6.1,5.8,5.9,5.9z"/></g></svg>';
				break;
			case 'menu-arrow-bottom':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 7.3 4.1" xml:space="preserve" aria-hidden="true"><polyline class="st0" points="3.6,4.1 0.1,0.1 7.1,0.1 3.6,4.1 "/></svg>';
				break;
			case 'slider-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="12.4px" viewBox="0 0 21 12.4" xml:space="preserve" style="stroke: none;"><g><path d="M0,6.2C0,6.1,0,6,0.1,5.9c0-0.1,0.1-0.2,0.2-0.3l5.3-5.3c0.4-0.4,0.8-0.4,1.2,0c0.4,0.4,0.4,0.8,0,1.2L3,5.3h17.1c0.3,0,0.5,0.1,0.6,0.2S21,5.9,21,6.2c0,0.3-0.1,0.5-0.2,0.6s-0.4,0.2-0.6,0.2H3l3.7,3.8c0.4,0.4,0.4,0.8,0,1.2c-0.4,0.4-0.8,0.4-1.2,0L0.3,6.8C0.2,6.7,0.1,6.6,0.1,6.5C0,6.4,0,6.3,0,6.2z"/></g></svg>';
				break;
			case 'slider-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="12.4px" viewBox="0 0 21 12.4" xml:space="preserve" style="stroke: none;"><g><path d="M20.9,6.5c0,0.1-0.1,0.2-0.2,0.3L15.5,12c-0.4,0.4-0.8,0.4-1.2,0c-0.4-0.4-0.4-0.8,0-1.2L18,7.1H0.9C0.6,7.1,0.4,7,0.2,6.8S0,6.4,0,6.2c0-0.3,0.1-0.5,0.2-0.6s0.4-0.2,0.6-0.2H18l-3.7-3.8c-0.4-0.4-0.4-0.8,0-1.2c0.4-0.4,0.8-0.4,1.2,0l5.3,5.3c0.1,0.1,0.2,0.2,0.2,0.3C21,6,21,6.1,21,6.2S21,6.4,20.9,6.5z"/></g></svg>';
				break;
			case 'pagination-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="6.2px" height="10.8px" viewBox="0 0 6.2 10.8" xml:space="preserve" style="stroke: none;"><g><path d="M0,5.4C0,5.2,0.1,5,0.2,4.9l4.7-4.7c0.3-0.3,0.7-0.3,1,0c0.3,0.3,0.3,0.7,0,1L1.8,5.4l4.1,4.2C6,9.7,6.1,9.9,6.1,10.1c0,0.2-0.1,0.4-0.2,0.5c-0.3,0.3-0.7,0.3-1,0L0.2,5.9C0.1,5.8,0,5.6,0,5.4z"/></g></svg>';
				break;
			case 'pagination-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="6.2px" height="10.8px" viewBox="0 0 6.2 10.8" xml:space="preserve" style="stroke: none;"><g><path d="M5.9,5.9l-4.7,4.7c-0.3,0.3-0.7,0.3-1,0c-0.1-0.1-0.2-0.3-0.2-0.5c0-0.2,0.1-0.4,0.2-0.5l4.1-4.2L0.3,1.2c-0.4-0.3-0.4-0.7,0-1c0.3-0.3,0.7-0.3,1,0l4.7,4.7C6.1,5,6.2,5.2,6.2,5.4C6.2,5.6,6.1,5.8,5.9,5.9z"/></g></svg>';
				break;
			case 'pagination-burger':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 18 18" xml:space="preserve"><rect x="11" width="7" height="7"/><rect x="11" y="11" width="7" height="7"/><rect width="7" height="7"/><rect y="11" width="7" height="7"/></>';
				break;
			case 'spinner':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path></svg>';
				break;
			case 'link':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18.1px" height="18px" viewBox="0 0 18.1 18" xml:space="preserve"><g><path d="M0.7,5.3C0.2,4.8,0,4.3,0,3.5c0-1,0.3-1.8,1-2.5c0.5-0.6,1.2-0.9,2.1-1s1.6,0.1,2.2,0.6l3.6,3.6c0.5,0.5,0.8,1.2,0.8,1.9c0,0.3,0,0.5-0.1,0.8L4.3,1.7C4,1.4,3.6,1.4,3.1,1.5C2.7,1.6,2.3,1.8,2,2C1.6,2.4,1.4,2.9,1.4,3.5c0,0.3,0.1,0.6,0.2,0.7L7,9.6C6,9.9,5.1,9.6,4.3,8.9L0.7,5.3z M6.3,5.2l6.6,6.6c0.2,0.1,0.2,0.3,0.2,0.5s-0.1,0.4-0.2,0.5c-0.2,0.2-0.3,0.2-0.5,0.2S12,13,11.8,12.8L5.2,6.2C5,6.1,5,5.9,5,5.7S5,5.3,5.2,5.2C5.3,5,5.5,4.9,5.7,4.9S6.1,5,6.3,5.2zM17.4,12.7c0.4,0.4,0.7,1,0.7,1.8c0,1-0.3,1.8-1,2.5c-0.6,0.6-1.3,0.9-2.1,1c-0.9,0.1-1.6-0.1-2.1-0.6l-3.6-3.6c-0.5-0.5-0.8-1.2-0.8-1.9c0-0.3,0-0.5,0.1-0.8l5.3,5.3c0.3,0.2,0.7,0.3,1.2,0.2c0.5-0.1,0.8-0.3,1.1-0.6c0.4-0.4,0.6-0.9,0.6-1.5c0-0.3-0.1-0.6-0.2-0.7L11,8.4c1.1-0.3,2-0.1,2.7,0.7L17.4,12.7z"/></g></svg>';
				break;
			case 'quote':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="8.2px" viewBox="0 0 16 8.2" xml:space="preserve"><g><path d="M0,8.2L3.6,0h4L3.1,8.2H0z M8,8.2L12,0h4l-4.9,8.2H8z"/></g></svg>';
				break;
			case 'date':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 14.6 14.6" xml:space="preserve"><path d="M10.9,1.3V0.2h-0.6v1.2H4.3V0.2H3.7v1.2H0.2v13.1h14.3V1.3H10.9z M10.9,1.9v1.2h-0.6V1.9H10.9z M4.3,1.9v1.2H3.7V1.9H4.3z M13.8,13.8H0.8V4.9h13.1V13.8z"/></svg>';
				break;
			case 'category':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16.1 14.9" xml:space="preserve"><path d="M14.6,0.3c0.3,0,0.6,0.1,0.9,0.3s0.4,0.5,0.4,0.9v10.6c0,0.3-0.1,0.6-0.4,0.9s-0.5,0.4-0.9,0.4H9.3c-0.6,0-0.9,0.2-0.9,0.7v0.5H8H7.8v-0.5c0-0.5-0.3-0.7-0.9-0.7H1.5c-0.3,0-0.6-0.1-0.9-0.4c-0.2-0.2-0.4-0.5-0.4-0.9V1.5c0-0.3,0.1-0.6,0.4-0.9c0.2-0.2,0.5-0.3,0.9-0.3h5.6c0.4,0,0.7,0.1,1,0.4c0.2-0.3,0.6-0.4,1-0.4H14.6z M7.8,13.2V1.7c0-0.2-0.1-0.4-0.3-0.5C7.3,1,7,0.9,6.8,0.9H1.5c-0.4,0-0.6,0.2-0.6,0.6v10.6c0,0.2,0.1,0.3,0.2,0.5s0.3,0.2,0.4,0.2h5.3C7.3,12.8,7.6,12.9,7.8,13.2zM15.2,12.1V1.5c0-0.4-0.2-0.6-0.6-0.6h-1.2v4.9l-1.8-1.2L9.8,5.7V0.9H9.3C9,0.9,8.8,1,8.6,1.2C8.4,1.3,8.3,1.5,8.3,1.7v11.5c0.1-0.3,0.4-0.4,0.9-0.4h5.3c0.2,0,0.3-0.1,0.4-0.2S15.2,12.3,15.2,12.1z M10.4,0.9v3.7l0.9-0.5l0.3-0.2l0.3,0.2l0.9,0.5V0.9H10.4z"/></svg>';
				break;
			case 'author':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 15.9 15.9" xml:space="preserve"><path d="M2.5,2.5C4,1,5.8,0.2,7.9,0.2c2.1,0,3.9,0.8,5.5,2.3c1.5,1.5,2.3,3.3,2.3,5.5c0,2.1-0.8,3.9-2.3,5.5c-1.5,1.5-3.3,2.3-5.5,2.3c-2.1,0-3.9-0.8-5.5-2.3C1,11.9,0.2,10,0.2,7.9C0.2,5.8,1,4,2.5,2.5z M12.9,2.9c-1.4-1.4-3.1-2.1-5-2.1c-2,0-3.6,0.7-5,2.1C1.5,4.3,0.9,6,0.9,7.9c0,1.7,0.6,3.2,1.7,4.5c1-0.4,2.1-0.8,3.3-1.2c0.1,0,0.1-0.2,0.1-0.4c0-0.4,0-0.7-0.1-0.9C5.7,9.7,5.6,9.3,5.5,8.8C5.3,8.5,5.1,8.1,5,7.6c-0.1-0.4-0.1-0.7,0-1V6.5c0.1-0.2,0-0.7-0.1-1.4C4.8,4.5,5,3.8,5.5,3.2c0.5-0.6,1.2-1,2.2-1h0.7c1,0,1.7,0.4,2.2,1c0.5,0.6,0.7,1.3,0.6,1.9c-0.1,0.7-0.2,1.2-0.1,1.4c0,0,0,0,0,0.1c0.1,0.2,0.1,0.6,0,1c-0.1,0.5-0.3,0.9-0.5,1.2c-0.1,0.5-0.2,0.9-0.3,1.2c-0.1,0.3-0.2,0.6-0.2,0.9c0,0.2,0,0.4,0.1,0.4c1.2,0.4,2.4,0.8,3.5,1.2c1.1-1.3,1.7-2.8,1.7-4.5C15,6,14.3,4.3,12.9,2.9z"/></svg>';
				break;
			case 'comment-reply':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18.7px" height="11.6px" viewBox="0 0 18.7 11.6" xml:space="preserve"><g><path d="M0.3,4.6l4.3-4.3c0.3-0.4,0.7-0.4,1,0c0.3,0.3,0.3,0.7,0,1L2.5,4.4H13c2,0,3.4,0.6,4.4,1.9c0.9,1.3,1.4,2.8,1.4,4.6c0,0.2-0.1,0.4-0.2,0.5s-0.3,0.2-0.5,0.2c-0.2,0-0.4-0.1-0.5-0.2s-0.2-0.3-0.2-0.5c0-1.3-0.4-2.5-1.1-3.5c-0.8-1-1.8-1.5-3.2-1.5H2.5l3.1,3.1c0.4,0.3,0.4,0.7,0,1c-0.3,0.3-0.7,0.3-1,0L0.3,5.6C-0.1,5.2-0.1,4.9,0.3,4.6z"/></g></svg>';
				break;
			case 'comment-edit':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 18 18" xml:space="preserve"><g><path d="M2.5,0.4l1.5,1.5l-2,2L0.4,2.5C0.1,2.2,0,1.8,0,1.4c0-0.4,0.1-0.7,0.4-1S1,0,1.4,0C1.8,0,2.2,0.1,2.5,0.4z M8.9,10.9L3.1,5.1l2-2l5.8,5.8l1,3L8.9,10.9z M17.7,3.7C17.9,3.9,18,4.2,18,4.5v12.4c0,0.3-0.1,0.6-0.3,0.8c-0.2,0.2-0.5,0.3-0.8,0.3H4.5c-0.3,0-0.6-0.1-0.8-0.3c-0.2-0.2-0.3-0.5-0.3-0.8v-8L4.5,10v6.9h12.4V4.5H10L8.9,3.4h8C17.2,3.4,17.4,3.5,17.7,3.7z"/></g></svg>';
				break;
			case 'button-arrow':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="6.7px" height="11.4px" viewBox="0 0 6.7 11.4" xml:space="preserve"><path d="M6.4,5L1.7,0.3c-0.4-0.4-1-0.4-1.3,0C0.1,0.5,0,0.7,0,1s0.1,0.5,0.4,0.7l3.8,4l-3.9,4C0.1,9.8,0,10.1,0,10.4  c0,0.3,0.1,0.5,0.3,0.7c0.2,0.2,0.4,0.3,0.7,0.3c0,0,0,0,0,0c0.2,0,0.5-0.1,0.7-0.3l4.7-4.7C6.5,6.2,6.7,6,6.7,5.7  C6.7,5.4,6.6,5.1,6.4,5z"></path></svg>';
				break;
		}

		return apply_filters( 'qi_filter_svg_icon', $html, $name, $class_name );
	}
}

if ( ! function_exists( 'qi_set_qode_essential_addons_svg_icon' ) ) {
	/**
	 * Function that set svg icon layout
	 *
	 * @param string $icon
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string
	 */
	function qi_set_qode_essential_addons_svg_icon( $icon, $name, $class_name ) {

		if ( in_array( $name, array( 'pagination-arrow-left', 'pagination-arrow-right', 'slider-arrow-left', 'slider-arrow-right', 'pagination-burger' ), true ) ) {
			return qi_get_svg_icon( $name, $class_name );
		}

		return $icon;
	}

	add_filter( 'qode_essential_addons_filter_svg_icon', 'qi_set_qode_essential_addons_svg_icon', 10, 3 );
	add_filter( 'qi_addons_for_elementor_filter_svg_icon', 'qi_set_qode_essential_addons_svg_icon', 10, 3 );
}

if ( ! function_exists( 'qi_render_inline_style' ) ) {
	/**
	 * Function that echoes generated style attribute
	 *
	 * @param string|array $value - attribute value
	 */
	function qi_render_inline_style( $value ) {
		echo qi_get_inline_attr( $value, 'style', ';' );
	}
}

if ( ! function_exists( 'qi_get_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 *
	 * @param string $status - success or error
	 * @param string $message - ajax message value
	 * @param string|array $data - returned value
	 * @param string $redirect - url address
	 */
	function qi_get_ajax_status( $status, $message, $data = null, $redirect = '' ) {
		$response = array(
			'status'   => esc_attr( $status ),
			'message'  => esc_html( $message ),
			'data'     => $data,
			'redirect' => $redirect,
		);

		$response = apply_filters( 'qi_filter_ajax_status', $response );

		$output = json_encode( $response );

		exit( $output );
	}
}
