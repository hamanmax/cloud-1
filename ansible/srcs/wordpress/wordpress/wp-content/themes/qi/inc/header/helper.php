<?php

if ( ! function_exists( 'qi_load_page_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function qi_load_page_header() {
		// Include header template
		echo apply_filters( 'qi_filter_header_template', qi_get_template_part( 'header', 'templates/header' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	add_action( 'qi_action_page_header_template', 'qi_load_page_header' );
}

if ( ! function_exists( 'qi_register_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function qi_register_navigation_menus() {
		$navigation_menus = apply_filters( 'qi_filter_register_navigation_menus', array( 'main-navigation' => esc_html__( 'Main Navigation', 'qi' ) ) );

		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}

	add_action( 'qi_action_after_include_modules', 'qi_register_navigation_menus' );
}

if ( ! function_exists( 'qi_get_header_logo_image' ) ) {
	/**
	 * Function that return header logo image html
	 *
	 * @return string containing html of logo image
	 */
	function qi_get_header_logo_image() {
		$logo_image      = '<span class="qodef-header-logo-label">' . get_bloginfo( 'name', 'display' ) . '</span>';
		$customizer_logo = get_custom_logo();

		if ( ! empty( $customizer_logo ) ) {
			$customizer_logo_id = get_theme_mod( 'custom_logo' );

			if ( $customizer_logo_id ) {
				$customizer_logo_id_attr = array(
					'class'    => 'qodef-header-logo-image qodef--main',
					'itemprop' => 'logo',
				);

				$image_alt = get_post_meta( $customizer_logo_id, '_wp_attachment_image_alt', true );
				if ( empty( $image_alt ) ) {
					$customizer_logo_id_attr['alt'] = get_bloginfo( 'name', 'display' );
				}

				$logo_image = wp_get_attachment_image( $customizer_logo_id, 'full', false, $customizer_logo_id_attr );
			}
		}

		return apply_filters( 'qi_filter_header_logo_image', $logo_image );
	}
}

if ( ! function_exists( 'qi_set_default_header_height_for_plugin' ) ) {
	/**
	 * Function that set default header area height for Qode Essential Addons
	 *
	 * @return int
	 */
	function qi_set_default_header_height_for_plugin() {
		return 120; // Same height is set inside css file
	}

	add_filter( 'qode_essential_addons_filter_standard_header_default_height', 'qi_set_default_header_height_for_plugin' );
	add_filter( 'qode_essential_addons_filter_minimal_header_default_height', 'qi_set_default_header_height_for_plugin' );
}

if ( ! function_exists( 'qi_disable_content_margin' ) ) {
	/**
	 * Function that disables content margin if 'Qi Landing' template is selected
	 *
	 * @return int
	 */
	function qi_disable_content_margin( $margin ) {
		if ( is_page_template( 'qi-landing.php' ) ) {
			$margin = 0;
		}
		return $margin;
	}

	add_filter( 'qode_essential_addons_filter_content_margin', 'qi_disable_content_margin', 100 );
}
