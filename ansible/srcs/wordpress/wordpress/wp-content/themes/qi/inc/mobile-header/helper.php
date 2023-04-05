<?php

if ( ! function_exists( 'qi_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function qi_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'qi_filter_mobile_header_template', qi_get_template_part( 'mobile-header', 'templates/mobile-header' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	add_action( 'qi_action_page_header_template', 'qi_load_page_mobile_header' );
}

if ( ! function_exists( 'qi_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function qi_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'qi_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'qi' ) ) );

		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}

	add_action( 'qi_action_after_include_modules', 'qi_register_mobile_navigation_menus' );
}
