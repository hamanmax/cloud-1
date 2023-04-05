<?php

if ( ! function_exists( 'qi_nav_item_classes' ) ) {
	/**
	 * Function that add additional classes for menu items
	 *
	 * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
	 * @param WP_Post $item The current menu item.
	 * @param stdClass $args An object of wp_nav_menu() arguments.
	 * @param int $depth Depth of menu item. Used for padding.
	 *
	 * @return array
	 */
	function qi_nav_item_classes( $classes, $item, $args, $depth ) {

		if ( 0 === $depth && in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$classes[] = 'qodef-menu-item--narrow';
		}

		return $classes;
	}

	add_filter( 'nav_menu_css_class', 'qi_nav_item_classes', 10, 4 );
}

if ( ! function_exists( 'qi_add_nav_item_icon' ) ) {
	/**
	 * Function that add additional element after the menu title
	 *
	 * @param string $title The menu item's title.
	 * @param WP_Post $item The current menu item.
	 * @param stdClass $args An object of wp_nav_menu() arguments.
	 * @param int $depth Depth of menu item. Used for padding.
	 *
	 * @return string
	 */
	function qi_add_nav_item_icon( $title, $item, $args, $depth ) {
		$is_mobile_menu = isset( $args->menu_area ) && 'mobile_navigation' === $args->menu_area;

		if ( in_array( 'menu-item-has-children', $item->classes, true ) && ! $is_mobile_menu && $depth > 0 ) {
			$title .= apply_filters( 'qi_filter_nav_item_icon', qi_get_svg_icon( 'menu-arrow-right', 'qodef-menu-item-arrow' ) );
		}

		return $title;
	}

	add_filter( 'nav_menu_item_title', 'qi_add_nav_item_icon', 15, 4 ); // permission 15 is set in order to be after the item description hook
}

if ( ! function_exists( 'qi_add_mobile_nav_item_icon' ) ) {
	/**
	 * Function that add additional element after the mobile menu item title
	 *
	 * @param stdClass $args An object of wp_nav_menu() arguments.
	 * @param WP_Post $item The current menu item.
	 * @param int $depth Depth of menu item. Used for padding.
	 *
	 * @return string
	 */
	function qi_add_mobile_nav_item_icon( $args, $item, $depth ) {
		$is_mobile_menu = isset( $args->menu_area ) && 'mobile_navigation' === $args->menu_area;

		$args->after = '';
		if ( in_array( 'menu-item-has-children', $item->classes, true ) && $is_mobile_menu ) {
			$args->after = '<button type="button" class="qodef-mobile-menu-item-icon" aria-expanded="false" aria-label="' . esc_attr__( 'Open the menu', 'qi' ) . '"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'qi' ) . '</span>' . apply_filters( 'qi_filter_nav_item_icon', qi_get_svg_icon( 'menu-arrow-right' ) ) . '</button>';
		}

		return $args;
	}

	add_filter( 'nav_menu_item_args', 'qi_add_mobile_nav_item_icon', 10, 3 );
}
