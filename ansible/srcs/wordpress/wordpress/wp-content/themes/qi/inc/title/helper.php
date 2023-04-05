<?php

if ( ! function_exists( 'qi_is_page_title_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 */
	function qi_is_page_title_enabled() {
		return apply_filters( 'qi_filter_enable_page_title', true );
	}
}

if ( ! function_exists( 'qi_load_page_title' ) ) {
	/**
	 * Function which loads page template module
	 */
	function qi_load_page_title() {

		if ( qi_is_page_title_enabled() ) {
			// Include title template
			echo apply_filters( 'qi_filter_title_template', qi_get_template_part( 'title', 'templates/title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	add_action( 'qi_action_page_title_template', 'qi_load_page_title' );
}

if ( ! function_exists( 'qi_get_page_title_classes' ) ) {
	/**
	 * Function that return classes for page title area
	 *
	 * @return string
	 */
	function qi_get_page_title_classes() {
		$classes = apply_filters( 'qi_filter_page_title_classes', array() );

		return implode( ' ', $classes );
	}
}

if ( ! function_exists( 'qi_get_page_title_text' ) ) {
	/**
	 * Function that returns current page title text
	 */
	function qi_get_page_title_text() {
		$title = get_the_title( qi_get_page_id() );

		if ( ( is_home() && is_front_page() ) || is_singular( 'post' ) ) {
			$title = get_option( 'blogname' );
		} elseif ( is_tag() ) {
			$title = single_term_title( '', false ) . esc_html__( ' Tag', 'qi' );
		} elseif ( is_date() ) {
			$title = get_the_time( 'F Y' );
		} elseif ( is_author() ) {
			$title = esc_html__( 'Author: ', 'qi' ) . get_the_author();
		} elseif ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_archive() ) {
			$title = esc_html__( 'Archive', 'qi' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results for: ', 'qi' ) . get_search_query();
		} elseif ( is_404() ) {
			$title = esc_html__( '404 - Page not found', 'qi' );
		}

		return apply_filters( 'qi_filter_page_title_text', $title );
	}
}

if ( ! function_exists( 'qi_set_page_title_text' ) ) {
	/**
	 * Function that set current page title text for Qode Essential Addons
	 */
	function qi_set_page_title_text() {
		return qi_get_page_title_text();
	}

	add_filter( 'qode_essential_addons_filter_page_title_text', 'qi_set_page_title_text' );
}
