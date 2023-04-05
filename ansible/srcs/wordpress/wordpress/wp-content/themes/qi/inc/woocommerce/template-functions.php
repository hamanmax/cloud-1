<?php

/**
 * Global templates hooks
 */

if ( ! function_exists( 'qi_add_main_woo_page_template_holder' ) ) {
	/**
	 * Function that render additional content for main shop page
	 */
	function qi_add_main_woo_page_template_holder() {
		$sidebar_classes = qi_is_woo_page( 'single' ) ? '' : qi_get_page_grid_sidebar_classes();

		echo '<main id="qodef-page-content" class="qodef-grid qodef-layout--columns ' . esc_attr( $sidebar_classes ) . ' ' . esc_attr( qi_get_grid_gutter_classes() ) . '"><div class="qodef-grid-inner">';
	}
}

if ( ! function_exists( 'qi_add_main_woo_page_template_holder_end' ) ) {
	/**
	 * Function that render additional content for main shop page
	 */
	function qi_add_main_woo_page_template_holder_end() {
		echo '</div></main>';
	}
}

if ( ! function_exists( 'qi_add_main_woo_page_holder' ) ) {
	/**
	 * Function that render additional content around WooCommerce pages
	 */
	function qi_add_main_woo_page_holder() {
		$classes = array();

		// add class to pages with sidebar and on single page
		if ( qi_is_woo_page( 'shop' ) || qi_is_woo_page( 'category' ) || qi_is_woo_page( 'tag' ) || qi_is_woo_page( 'single' ) ) {
			$classes[] = 'qodef-grid-item';
		}

		// add class to pages with sidebar
		if ( qi_is_woo_page( 'shop' ) || qi_is_woo_page( 'category' ) || qi_is_woo_page( 'tag' ) ) {
			$classes[] = qi_get_page_content_sidebar_classes();
		}

		$classes[] = qi_get_woo_main_page_classes();

		echo '<div id="qodef-woo-page" class="' . esc_attr( implode( ' ', $classes ) ) . '">';
	}
}

if ( ! function_exists( 'qi_add_main_woo_page_holder_end' ) ) {
	/**
	 * Function that render additional content around WooCommerce pages
	 */
	function qi_add_main_woo_page_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'qi_add_main_woo_page_sidebar_holder' ) ) {
	/**
	 * Function that render sidebar layout for main shop page
	 */
	function qi_add_main_woo_page_sidebar_holder() {

		if ( ! is_singular( 'product' ) ) {
			// Include page content sidebar
			qi_template_part( 'sidebar', 'templates/sidebar' );
		}
	}
}

if ( ! function_exists( 'qi_woo_render_product_categories' ) ) {
	/**
	 * Function that render product categories
	 *
	 * @param string $before
	 * @param string $after
	 */
	function qi_woo_render_product_categories( $before = '', $after = '' ) {
		echo qi_woo_get_product_categories( $before, $after ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'qi_woo_get_product_categories' ) ) {
	/**
	 * Function that render product categories
	 *
	 * @param string $before
	 * @param string $after
	 *
	 * @return string
	 */
	function qi_woo_get_product_categories( $before = '', $after = '' ) {
		$product = qi_woo_get_global_product();

		return ! empty( $product ) ? wc_get_product_category_list( $product->get_id(), '<span class="qodef-category-separator"></span>', $before, $after ) : '';
	}
}

/**
 * Shop page templates hooks
 */

if ( ! function_exists( 'qi_add_results_and_ordering_holder' ) ) {
	/**
	 * Function that render additional content around results and ordering templates on main shop page
	 */
	function qi_add_results_and_ordering_holder() {
		echo '<div class="qodef-woo-results">';
	}
}

if ( ! function_exists( 'qi_add_results_and_ordering_holder_end' ) ) {
	/**
	 * Function that render additional content around results and ordering templates on main shop page
	 */
	function qi_add_results_and_ordering_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'qi_add_product_list_item_holder' ) ) {
	/**
	 * Function that render additional content around product list item on main shop page
	 */
	function qi_add_product_list_item_holder() {
		echo '<div class="qodef-woo-product-inner">';
	}
}

if ( ! function_exists( 'qi_add_product_list_item_holder_end' ) ) {
	/**
	 * Function that render additional content around product list item on main shop page
	 */
	function qi_add_product_list_item_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'qi_add_product_list_item_image_holder' ) ) {
	/**
	 * Function that render additional content around image template on main shop page
	 */
	function qi_add_product_list_item_image_holder() {
		$styles = apply_filters( 'qi_filter_woo_product_list_item_image_style', array() );

		if ( count( $styles ) ) {
			echo '<div class="qodef-woo-product-image"' . qi_get_inline_attr( $styles, 'style', ';' ) . '>';
		} else {
			echo '<div class="qodef-woo-product-image">';
		}

	}
}

if ( ! function_exists( 'qi_add_product_list_item_image_holder_end' ) ) {
	/**
	 * Function that render additional content around image template on main shop page
	 */
	function qi_add_product_list_item_image_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'qi_add_product_list_item_additional_image_holder' ) ) {
	/**
	 * Function that render additional content around image and sale templates on main shop page
	 */
	function qi_add_product_list_item_additional_image_holder() {
		$styles = apply_filters( 'qi_filter_woo_product_list_item_image_inner_style', array() );

		if ( count( $styles ) ) {
			echo '<div class="qodef-woo-product-image-inner"' . qi_get_inline_attr( $styles, 'style', ';' ) . '>';
		} else {
			echo '<div class="qodef-woo-product-image-inner">';
		}
	}
}

if ( ! function_exists( 'qi_add_product_list_item_additional_image_holder_end' ) ) {
	/**
	 * Function that render additional content around image and sale templates on main shop page
	 */
	function qi_add_product_list_item_additional_image_holder_end() {
		// Hook to include additional content inside product list item image
		do_action( 'qi_action_product_list_item_additional_image_content' );

		echo '</div>';
	}
}

if ( ! function_exists( 'qi_add_product_list_item_content_holder' ) ) {
	/**
	 * Function that render additional content around product info on main shop page
	 */
	function qi_add_product_list_item_content_holder() {
		$styles = array();

		if ( qi_is_installed( 'core' ) ) {
			$content_background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_content_background_color' );
		}

		if ( '' !== $content_background_color ) {
			$styles[] = 'background-color: ' . $content_background_color;
		}

		if ( isset( $content_background_color ) ) {
			echo '<div class="qodef-woo-product-content"' . qode_essential_addons_framework_get_inline_style( $styles ) . '>';
		} else {
			echo '<div class="qodef-woo-product-content">';
		}
	}
}

if ( ! function_exists( 'qi_add_product_list_item_content_holder_end' ) ) {
	/**
	 * Function that render additional content around product info on main shop page
	 */
	function qi_add_product_list_item_content_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'qi_add_product_list_item_heading_holder' ) ) {
	/**
	 * Function that render additional content around product title and price on main shop page
	 */
	function qi_add_product_list_item_heading_holder() {
		$show_price = '';
		if ( qi_is_installed( 'core' ) ) {
			$show_price = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_show_price' );
		}

		if ( 'no' !== $show_price ) {
			echo '<div class="qodef-woo-product-heading">';
		} else {
			echo '<div class="qodef-woo-product-heading qodef-hide-price">';
		}
	}
}

if ( ! function_exists( 'qi_add_product_list_item_heading_holder_end' ) ) {
	/**
	 * Function that render additional content around product title and price on main shop page
	 */
	function qi_add_product_list_item_heading_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'qi_add_product_list_item_categories' ) ) {
	/**
	 * Function that render product categories
	 */
	function qi_add_product_list_item_categories() {
		$show_category = '';
		if ( qi_is_installed( 'core' ) ) {
			$show_category = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_show_category' );
		}

		if ( 'no' !== $show_category ) {
			qi_woo_render_product_categories( '<div class="qodef-woo-product-categories qodef-info-style">', '</div>' );
		}
	}
}

/**
 * Product single page templates hooks
 */

if ( ! function_exists( 'qi_add_product_single_content_holder' ) ) {
	/**
	 * Function that render additional content around image and summary templates on single product page
	 */
	function qi_add_product_single_content_holder() {
		echo '<div class="qodef-woo-single-inner">';
	}
}

if ( ! function_exists( 'qi_add_product_single_content_holder_end' ) ) {
	/**
	 * Function that render additional content around image and summary templates on single product page
	 */
	function qi_add_product_single_content_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'qi_add_product_single_image_holder' ) ) {
	/**
	 * Function that render additional content around featured image on single product page
	 */
	function qi_add_product_single_image_holder() {
		echo '<div class="qodef-woo-single-image">';
	}
}

if ( ! function_exists( 'qi_add_product_single_image_holder_end' ) ) {
	/**
	 * Function that render additional content around featured image on single product page
	 */
	function qi_add_product_single_image_holder_end() {
		echo '</div>';
	}
}

/**
 * Override default WooCommerce templates
 */

if ( ! function_exists( 'qi_woo_disable_page_heading' ) ) {
	/**
	 * Function that disable heading template on main shop page
	 *
	 * @return bool
	 */
	function qi_woo_disable_page_heading() {
		return false;
	}
}

if ( ! function_exists( 'qi_add_product_list_holder' ) ) {
	/**
	 * Function that add additional content around product lists on main shop page
	 *
	 * @param string $html
	 *
	 * @return string which contains html content
	 */
	function qi_add_product_list_holder( $html ) {
		$classes = apply_filters( 'qi_filter_woo_product_list_item_classes', array() );

		return '<div class="qodef-woo-product-list ' . esc_attr( implode( ' ', $classes ) ) . '">' . $html;
	}
}

if ( ! function_exists( 'qi_add_product_list_holder_end' ) ) {
	/**
	 * Function that add additional content around product lists on main shop page
	 *
	 * @param string $html
	 *
	 * @return string which contains html content
	 */
	function qi_add_product_list_holder_end( $html ) {
		return $html . '</div>';
	}
}

if ( ! function_exists( 'qi_woo_pagination_args' ) ) {
	/**
	 * Function that override pagination args on main shop page
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	function qi_woo_pagination_args( $args ) {
		$args['prev_text'] = qi_get_svg_icon( 'pagination-arrow-left' );
		$args['next_text'] = qi_get_svg_icon( 'pagination-arrow-right' );
		$args['type']      = 'plain';

		return $args;
	}
}

if ( ! function_exists( 'qi_add_sale_flash_on_product' ) ) {
	/**
	 * Function for adding on sale template for product
	 */
	function qi_add_sale_flash_on_product() {
		echo qi_woo_set_sale_flash(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'qi_woo_set_sale_flash' ) ) {
	/**
	 * Function that override on sale template for product
	 *
	 * @return string which contains html content
	 */
	function qi_woo_set_sale_flash() {
		$product = qi_woo_get_global_product();

		if ( ! empty( $product ) && $product->is_on_sale() && $product->is_in_stock() ) {
			return qi_woo_get_woocommerce_sale( $product );
		}

		return '';
	}
}

if ( ! function_exists( 'qi_woo_get_woocommerce_sale' ) ) {
	/**
	 * Function that return sale mark label
	 *
	 * @param object $product
	 *
	 * @return string
	 */
	function qi_woo_get_woocommerce_sale( $product ) {
		$price      = floatval( $product->get_regular_price() );
		$sale_price = floatval( $product->get_sale_price() );

		if ( $price > 0 ) {
			return '<span class="qodef-woo-product-mark qodef-woo-onsale">' . '-' . ( 100 - round( ( $sale_price * 100 ) / $price ) ) . '%' . '</span>';
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'qi_woo_shop_loop_item_title' ) ) {
	/**
	 * Function that override product list item title template
	 */
	function qi_woo_shop_loop_item_title() {
		$title_tag = apply_filters( 'qi_filter_woo_product_list_item_title_tag', 'h5' );

		echo '<' . esc_attr( $title_tag ) . ' class="qodef-woo-product-title woocommerce-loop-product__title">' . wp_kses_post( get_the_title() ) . '</' . esc_attr( $title_tag ) . '>';
	}
}

if ( ! function_exists( 'qi_woo_template_single_title' ) ) {
	/**
	 * Function that override product single item title template
	 */
	function qi_woo_template_single_title() {
		$title_tag = apply_filters( 'qi_filter_woo_product_single_item_title_tag', 'h1' );

		echo '<' . esc_attr( $title_tag ) . ' class="qodef-woo-product-title product_title entry-title">' . wp_kses_post( get_the_title() ) . '</' . esc_attr( $title_tag ) . '>';
	}
}

if ( ! function_exists( 'qi_woo_single_thumbnail_images_size' ) ) {
	/**
	 * Function that set thumbnail images size on single product page
	 *
	 * @return string
	 */
	function qi_woo_single_thumbnail_images_size() {
		return apply_filters( 'qi_filter_woo_single_thumbnail_size', 'woocommerce_thumbnail' );
	}
}

if ( ! function_exists( 'qi_woo_single_thumbnail_images_wrapper' ) ) {
	/**
	 * Function that add additional wrapper around thumbnail images on single product
	 */
	function qi_woo_single_thumbnail_images_wrapper() {
		echo '<div class="qodef-woo-thumbnails-wrapper"><div></div>'; //empty div is because of the indexing with pswp lightbox since thumbnails are in separated div and main image is included in lightbox indexing
	}
}

if ( ! function_exists( 'qi_woo_single_thumbnail_images_wrapper_end' ) ) {
	/**
	 * Function that add additional wrapper around thumbnail images on single product
	 */
	function qi_woo_single_thumbnail_images_wrapper_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'qi_woo_product_list_show_rating' ) ) {

	function qi_woo_product_list_show_rating() {
		$show_rating = '';
		if ( qi_is_installed( 'core' ) ) {
			$show_rating = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_show_rating' );
		}

		if ( 'no' == $show_rating ) {
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );
		}
	}

	add_action( 'init', 'qi_woo_product_list_show_rating', 11 );
}

if ( ! function_exists( 'qi_woo_product_get_rating_html' ) ) {
	/**
	 * Function that override ratings templates
	 *
	 * @param string $html - contains html content
	 * @param float $rating
	 *
	 * @return string
	 */
	function qi_woo_product_get_rating_html( $html, $rating ) {
		$html = '';

		if ( ! empty( $rating ) ) {
			$html = '<div class="qodef-woo-ratings qodef-m"><div class="qodef-m-inner">';
			$html .= '<div class="qodef-m-star qodef--initial">';
			for ( $i = 0; $i < 5; $i ++ ) {
				$html .= qi_get_svg_icon( 'star', 'qodef-m-star-item' );
			}
			$html .= '</div>';
			$html .= '<div class="qodef-m-star qodef--active" style="width:' . ( ( $rating / 5 ) * 100 ) . '%">';
			for ( $i = 0; $i < 5; $i ++ ) {
				$html .= qi_get_svg_icon( 'star', 'qodef-m-star-item' );
			}
			$html .= '</div>';
			$html .= '</div></div>';
		}

		return $html;
	}
}

if ( ! function_exists( 'qi_woo_loop_add_to_cart_link' ) ) {
	/**
	 * Function that override add to cart templates
	 *
	 * @param string $button_html - contains html content
	 * @param object $product
	 * @param array $args
	 *
	 * @return string
	 */
	function qi_woo_loop_add_to_cart_link( $button_html, $product, $args ) {
		$button_html = sprintf(
			'<a href="%s" data-quantity="%s" class="%s qodef--with-icon" %s>%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() ) . qi_get_svg_icon( 'button-arrow', 'qodef-theme-button-icon' )
		);

		return $button_html;
	}
}
