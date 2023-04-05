<?php

if ( ! class_exists( 'Qi_WooCommerce' ) ) {
	class Qi_WooCommerce {
		private static $instance;

		public function __construct() {

			if ( qi_is_installed( 'woocommerce' ) ) {
				// Include files
				$this->include_files();

				// Init
				add_action( 'before_woocommerce_init', array( $this, 'init' ) );
			}
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function include_files() {
			// Include helper functions
			include_once QI_INC_ROOT_DIR . '/woocommerce/helper.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			// Include template helper functions
			include_once QI_INC_ROOT_DIR . '/woocommerce/template-functions.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		}

		function init() {
			// Adds theme supports
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );

			// Disable default WooCommerce style
			$wc_version = get_option( 'woocommerce_version' );

			if ( version_compare( $wc_version, '6.9.0', '<' ) ) {
				// Old version
				add_filter( 'woocommerce_enqueue_styles', '__return_false' );
			} else {
				// New version
				add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
			}

			// Enqueue 3rd party plugins script
			add_action( 'qi_action_before_main_js', array( $this, 'enqueue_assets' ) );

			// Unset default WooCommerce templates modules
			$this->unset_templates_modules();

			// Add new WooCommerce templates
			$this->add_templates();

			// Change default WooCommerce templates position
			$this->change_templates_position();

			// Override default WooCommerce templates
			$this->override_templates();

			// Set default WooCommerce product layout
			$this->set_default_layout();
		}

		function enqueue_assets() {
			// Enqueue plugin's 3rd party scripts (select2 is registered inside WooCommerce plugin)
			wp_enqueue_script( 'select2' );
		}

		function unset_templates_modules() {
			// Remove main shop holder
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

			// Remove breadcrumbs
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

			// Remove sidebar
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

			// Remove product ratings on list
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );

			// Remove product link on list
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		}

		function add_templates() {
			/**
			 * Global templates hooks
			 */

			// Add grid template holder around shop
			add_action( 'woocommerce_before_main_content', 'qi_add_main_woo_page_template_holder', 5 ); // permission 5 is set because qi_add_main_woo_page_holder hook is added on 10
			add_action( 'woocommerce_after_main_content', 'qi_add_main_woo_page_template_holder_end', 20 ); // permission 20 is set because qi_add_main_woo_page_holder_end hook is added on 10

			// Add main shop holder
			add_action( 'woocommerce_before_main_content', 'qi_add_main_woo_page_holder', 10 );
			add_action( 'woocommerce_after_main_content', 'qi_add_main_woo_page_holder_end', 10 );
			add_action( 'woocommerce_before_cart', 'qi_add_main_woo_page_holder', 5 ); // permission 5 is set just to holder be at the first place
			add_action( 'woocommerce_after_cart', 'qi_add_main_woo_page_holder_end', 20 ); // permission 20 is set just to holder be at the last place
			add_action( 'woocommerce_before_checkout_form', 'qi_add_main_woo_page_holder', 5 ); // permission 5 is set just to holder be at the first place
			add_action( 'woocommerce_after_checkout_form', 'qi_add_main_woo_page_holder_end', 20 ); // permission 20 is set just to holder be at the last place

			// Add additional tags around results and ordering
			add_action( 'woocommerce_before_shop_loop', 'qi_add_results_and_ordering_holder', 15 ); // permission 5 is set because wc_print_notices hook is added on 10
			add_action( 'woocommerce_before_shop_loop', 'qi_add_results_and_ordering_holder_end', 40 ); // permission 40 is set because woocommerce_catalog_ordering hook is added on 30

			// Add sidebar templates for shop page
			add_action( 'woocommerce_after_main_content', 'qi_add_main_woo_page_sidebar_holder', 15 ); // permission 15 is set because qi_add_main_woo_page_holder_end hook is added on 10

			// Override On sale template
			add_filter( 'woocommerce_sale_flash', 'qi_woo_set_sale_flash' );
			add_action( 'qode_essential_addons_action_woo_product_mark_info', 'qi_add_sale_flash_on_product', 10 ); // permission 10 is set because woocommerce_show_product_loop_sale_flash hook is added on 10

			// Add link around image for product list item
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_open', 29 ); // permission 29 is set because qi_add_product_list_item_holder_end hook is closed on 30
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 29 );

			/**
			 * Product single page templates hooks
			 */

			// Add additional tags around product image and content
			add_action( 'woocommerce_before_single_product_summary', 'qi_add_product_single_content_holder', 2 ); // permission 2 is set because qi_add_product_single_image_holder hook is added on 5
			add_action( 'woocommerce_after_single_product_summary', 'qi_add_product_single_content_holder_end', 5 ); // permission 5 is set because woocommerce_output_product_data_tabs hook is added on 10

			// Add additional tags around product list item image
			add_action( 'woocommerce_before_single_product_summary', 'qi_add_product_single_image_holder', 5 ); // permission 5 is set because woocommerce_show_product_sale_flash hook is added on 10
			add_action( 'woocommerce_before_single_product_summary', 'qi_add_product_single_image_holder_end', 30 ); // permission 30 is set because woocommerce_show_product_images hook is added on 20

			// add additional tags around product single thumbnails
			add_action( 'woocommerce_product_thumbnails', 'qi_woo_single_thumbnail_images_wrapper', 5 );
			add_action( 'woocommerce_product_thumbnails', 'qi_woo_single_thumbnail_images_wrapper_end', 35 );
		}

		function change_templates_position() {

			// Change add to cart position on product list
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 ); // permission 10 is default
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 9 );
		}

		function override_templates() {

			// Disable page heading
			add_filter( 'woocommerce_show_page_title', 'qi_woo_disable_page_heading' );

			// Override product list holder
			add_filter( 'woocommerce_product_loop_start', 'qi_add_product_list_holder' );
			add_filter( 'woocommerce_product_loop_end', 'qi_add_product_list_holder_end' );

			// Override list pagination args
			add_filter( 'woocommerce_pagination_args', 'qi_woo_pagination_args' );

			// Override reviews pagination args
			add_filter( 'woocommerce_comment_pagination_args', 'qi_woo_pagination_args' );

			// Override product title
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 ); // permission 10 is default
			add_action( 'woocommerce_shop_loop_item_title', 'qi_woo_shop_loop_item_title', 10 );

			// Override product title
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 ); // permission 5 is default
			add_action( 'woocommerce_single_product_summary', 'qi_woo_template_single_title', 5 );

			// Override thumbnails size for single product
			add_filter( 'woocommerce_gallery_thumbnail_size', 'qi_woo_single_thumbnail_images_size' );

			// Override rating template
			add_filter( 'woocommerce_product_get_rating_html', 'qi_woo_product_get_rating_html', 10, 2 );

			// Override add to cart template
			add_filter( 'woocommerce_loop_add_to_cart_link', 'qi_woo_loop_add_to_cart_link', 10, 3 );
		}

		function set_default_layout() {

			// Add additional tags around product list item
			add_action( 'woocommerce_before_shop_loop_item', 'qi_add_product_list_item_holder', 5 ); // permission 5 is set because woocommerce_template_loop_product_link_open hook is added on 10
			add_action( 'woocommerce_after_shop_loop_item', 'qi_add_product_list_item_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

			// Add additional tags around product list item image
			add_action( 'woocommerce_before_shop_loop_item_title', 'qi_add_product_list_item_image_holder', 5 ); // permission 5 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
			add_action( 'woocommerce_before_shop_loop_item_title', 'qi_add_product_list_item_image_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_product_thumbnail hook is added on 10

			// Add additional tags around content inside product list item image
			add_action( 'woocommerce_before_shop_loop_item_title', 'qi_add_product_list_item_additional_image_holder', 15 ); // permission 15 is set because woocommerce_template_loop_product_thumbnail hook is added on 10
			add_action( 'woocommerce_before_shop_loop_item_title', 'qi_add_product_list_item_additional_image_holder_end', 25 ); // permission 25 is set because qi_add_product_list_item_image_holder_end hook is added on 30

			// Add additional tags around product list item content
			add_action( 'woocommerce_shop_loop_item_title', 'qi_add_product_list_item_content_holder', 5 ); // permission 5 is set because woocommerce_template_loop_product_title hook is added on 10
			add_action( 'woocommerce_after_shop_loop_item', 'qi_add_product_list_item_content_holder_end', 20 ); // permission 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

			// Add additional tags around product list item title and price
			add_action( 'woocommerce_shop_loop_item_title', 'qi_add_product_list_item_heading_holder', 9 ); // permission 9 is set because woocommerce_template_loop_product_title hook is added on 10
			add_action( 'woocommerce_after_shop_loop_item_title', 'qi_add_product_list_item_heading_holder_end', 12 ); // permission 12 is set because woocommerce_template_loop_price hook is added on 10

			// Add product categories on list
			add_action( 'woocommerce_after_shop_loop_item_title', 'qi_add_product_list_item_categories', 13 ); // permission 8 is set to be before woocommerce_template_loop_product_title hook it's added on 10

			// Change add to cart position on product list
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // permission 10 is default
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 ); // permission 20 is set because qi_add_product_list_item_additional_image_holder hook is added on 15
		}
	}

	Qi_WooCommerce::get_instance();
}
