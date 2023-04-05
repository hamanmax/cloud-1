<?php

if ( ! function_exists( 'qi_is_woo_page' ) ) {
	/**
	 * Function that check WooCommerce pages
	 *
	 * @param string $page
	 *
	 * @return bool
	 */
	function qi_is_woo_page( $page ) {
		switch ( $page ) {
			case 'shop':
				return function_exists( 'is_shop' ) && is_shop();
			case 'single':
				return is_singular( 'product' );
			case 'cart':
				return function_exists( 'is_cart' ) && is_cart();
			case 'checkout':
				return function_exists( 'is_checkout' ) && is_checkout();
			case 'account':
				return function_exists( 'is_account_page' ) && is_account_page();
			case 'category':
				return function_exists( 'is_product_category' ) && is_product_category();
			case 'tag':
				return function_exists( 'is_product_tag' ) && is_product_tag();
			case 'any':
				return (
					function_exists( 'is_shop' ) && is_shop() ||
					is_singular( 'product' ) ||
					function_exists( 'is_cart' ) && is_cart() ||
					function_exists( 'is_checkout' ) && is_checkout() ||
					function_exists( 'is_account_page' ) && is_account_page() ||
					function_exists( 'is_product_category' ) && is_product_category() ||
					function_exists( 'is_product_tag' ) && is_product_tag()
				);
			case 'archive':
				return ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) || ( function_exists( 'is_product_tag' ) && is_product_tag() );
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'qi_get_woo_main_page_classes' ) ) {
	/**
	 * Function that return current WooCommerce page class name
	 *
	 * @return string
	 */
	function qi_get_woo_main_page_classes() {
		$classes = array();

		if ( qi_is_woo_page( 'shop' ) ) {
			$classes[] = 'qodef--list';
		}

		if ( qi_is_woo_page( 'single' ) ) {
			$classes[] = 'qodef--single';
			$classes[] = 'qodef-popup--photo-swipe';
		}

		if ( qi_is_woo_page( 'cart' ) ) {
			$classes[] = 'qodef--cart';
		}

		if ( qi_is_woo_page( 'checkout' ) ) {
			$classes[] = 'qodef--checkout';
		}

		if ( qi_is_woo_page( 'account' ) ) {
			$classes[] = 'qodef--account';
		}

		return apply_filters( 'qi_filter_main_page_classes', implode( ' ', $classes ) );
	}
}

if ( ! function_exists( 'qi_woo_get_global_product' ) ) {
	/**
	 * Function that return global WooCommerce object
	 *
	 * @return object
	 */
	function qi_woo_get_global_product() {
		global $product;

		return $product;
	}
}

if ( ! function_exists( 'qi_woo_get_main_shop_page_id' ) ) {
	/**
	 * Function that return main shop page ID
	 *
	 * @return int
	 */
	function qi_woo_get_main_shop_page_id() {
		// Get page id from options table
		$shop_id = get_option( 'woocommerce_shop_page_id' );

		if ( ! empty( $shop_id ) ) {
			return $shop_id;
		}

		return false;
	}
}

if ( ! function_exists( 'qi_woo_set_main_shop_page_id' ) ) {
	/**
	 * Function that set main shop page ID for get_post_meta options
	 *
	 * @param int $post_id
	 *
	 * @return int
	 */
	function qi_woo_set_main_shop_page_id( $post_id ) {

		if ( qi_is_woo_page( 'archive' ) || qi_is_woo_page( 'single' ) ) {
			$shop_id = qi_woo_get_main_shop_page_id();

			if ( ! empty( $shop_id ) ) {
				$post_id = $shop_id;
			}
		}

		return $post_id;
	}

	add_filter( 'qi_filter_page_id', 'qi_woo_set_main_shop_page_id' );
	add_filter( 'qode_essential_addons_filter_framework_page_id', 'qi_woo_set_main_shop_page_id' );
}

if ( ! function_exists( 'qi_woo_set_page_title_text' ) ) {
	/**
	 * Function that returns current page title text for WooCommerce pages
	 *
	 * @param string $title
	 *
	 * @return string
	 */
	function qi_woo_set_page_title_text( $title ) {

		if ( qi_is_woo_page( 'shop' ) || qi_is_woo_page( 'single' ) ) {
			$shop_id = qi_woo_get_main_shop_page_id();

			$title = ! empty( $shop_id ) ? get_the_title( $shop_id ) : esc_html__( 'Shop', 'qi' );
		} elseif ( qi_is_woo_page( 'category' ) || qi_is_woo_page( 'tag' ) ) {
			$taxonomy_slug = qi_is_woo_page( 'tag' ) ? 'product_tag' : 'product_cat';
			$taxonomy      = get_term( get_queried_object_id(), $taxonomy_slug );

			if ( ! empty( $taxonomy ) ) {
				$title = esc_html( $taxonomy->name );
			}
		}

		return $title;
	}

	add_filter( 'qi_filter_page_title_text', 'qi_woo_set_page_title_text' );
}

if ( ! function_exists( 'qi_woo_breadcrumbs_title' ) ) {
	/**
	 * Improve main breadcrumbs template with additional cases
	 *
	 * @param string $wrap_child
	 * @param array $settings
	 *
	 * @return string
	 */
	function qi_woo_breadcrumbs_title( $wrap_child, $settings ) {

		if ( qi_is_woo_page( 'category' ) || qi_is_woo_page( 'tag' ) ) {
			$wrap_child    = '';
			$taxonomy_slug = qi_is_woo_page( 'tag' ) ? 'product_tag' : 'product_cat';
			$taxonomy      = get_term( get_queried_object_id(), $taxonomy_slug );

			if ( isset( $taxonomy->parent ) && 0 !== $taxonomy->parent ) {
				$parent     = get_term( $taxonomy->parent );
				$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name ) . $settings['separator'];
			}

			if ( ! empty( $taxonomy ) ) {
				$wrap_child .= sprintf( $settings['current_item'], esc_attr( $taxonomy->name ) );
			}
		} elseif ( qi_is_woo_page( 'shop' ) ) {
			$shop_id    = qi_woo_get_main_shop_page_id();
			$shop_title = ! empty( $shop_id ) ? get_the_title( $shop_id ) : esc_html__( 'Shop', 'qi' );

			$wrap_child .= sprintf( $settings['current_item'], $shop_title );

		} elseif ( qi_is_woo_page( 'single' ) ) {
			$wrap_child = '';
			$post_terms = wp_get_post_terms( get_the_ID(), 'product_cat' );

			if ( ! empty( $post_terms ) ) {
				$post_term = $post_terms[0];

				if ( isset( $post_term->parent ) && 0 !== $post_term->parent ) {
					$parent     = get_term( $post_term->parent );
					$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name ) . $settings['separator'];
				}
				$wrap_child .= sprintf( $settings['link'], get_term_link( $post_term ), $post_term->name ) . $settings['separator'];
			}

			$wrap_child .= sprintf( $settings['current_item'], get_the_title() );
		}

		return $wrap_child;
	}

	add_filter( 'qode_essential_addons_filter_breadcrumbs_content', 'qi_woo_breadcrumbs_title', 10, 2 );
}

if ( ! function_exists( 'qi_set_woo_review_form_fields' ) ) {
	/**
	 * Function that add woo rating to WordPress comment form fields
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	function qi_set_woo_review_form_fields( $args ) {
		$comment_args = qi_get_comment_form_args();

		if ( key_exists( 'comment_field', $comment_args ) ) {

			if ( wc_review_ratings_enabled() ) {
				$ratings_html = '<p class="stars qodef-comment-form-ratings">';
				for ( $i = 1; $i <= 5; $i ++ ) {
					$ratings_html .= '<a class="star-' . intval( $i ) . '" href="#">' . intval( $i ) . qi_get_svg_icon( 'star' ) . '</a>';
				}
				$ratings_html .= '</p>';

				// add rating stuff before textarea element
				// copied from wp-content/plugins/woocommerce/templates/single-product-reviews.php
				$comment_args['comment_field'] = '<div class="comment-form-rating">
					<label for="rating">' . esc_html__( 'Your Rating ', 'qi' ) . ( wc_review_ratings_required() ? '<span class="required">*</span>' : '' ) . '</label>
					' . $ratings_html . '
					<select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'qi' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'qi' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'qi' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'qi' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'qi' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'qi' ) . '</option>
					</select>
				</div>' . $comment_args['comment_field'];
			}
		}

		// Removed url field from form
		if ( isset( $comment_args['fields']['url'] ) ) {
			unset( $comment_args['fields']['url'] );
		}

		// Override WooCommerce review arguments with ours
		$args = array_merge( $args, $comment_args );

		return $args;
	}

	add_filter( 'woocommerce_product_review_comment_form_args', 'qi_set_woo_review_form_fields' );
}

if ( ! function_exists( 'qi_get_center_content_class' ) ) {
	/**
	 * Function that return current WooCommerce page class name
	 *
	 * @return array
	 */
	function qi_get_center_content_class( $classes ) {
		if ( qi_is_installed( 'core' ) ) {
			$center_content           = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_center_content' );
			$content_background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_content_background_color' );
		}

		if ( isset( $center_content ) && 'yes' === $center_content ) {
			$classes[] = 'qodef-alignment--centered';
		}

		if ( isset( $content_background_color ) && '' !== $content_background_color ) {
			$classes[] = ! empty( $content_background_color ) ? 'qodef-content-has-background-color' : '';
		}

		return $classes;
	}

	add_filter( 'qi_filter_woo_product_list_item_classes', 'qi_get_center_content_class' );
}
