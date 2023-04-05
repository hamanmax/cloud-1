<?php

if ( ! class_exists( 'Qi_Import' ) ) {
	class Qi_Import {
		/**
		 * @var $instance Qi_Import current class
		 */
		private static $instance;
		private $demo_content_uri = 'https://export.qodethemes.com/qi/';

		/**
		 * @return Qi_Import
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function __construct() {

			add_filter( 'qode_essential_addons_filter_demos_list', array( $this, 'demos' ) );
			add_filter( 'qode_essential_addons_filter_import_title', array( $this, 'demos_title' ) );
		}

		function demos() {
			$plugins_names = array(
				'elementor'               => esc_html__( 'Elementor', 'qi' ),
				'qi-addons-for-elementor' => esc_html__( 'Qi Addons For Elementor', 'qi' ),
				'contact-form-7'          => esc_html__( 'Contact Form 7', 'qi' ),
				'woocommerce'             => esc_html__( 'WooCommerce', 'qi' ),
				'instagram-feed'          => esc_html__( 'Smash Balloon Social Photo Feed', 'qi' ),
				'custom-twitter-feeds'    => esc_html__( 'Custom Twitter Feeds', 'qi' ),
				'custom-facebook-feed'    => esc_html__( 'Smash Balloon Social Post Feed', 'qi' ),
				'wpforms-lite'            => esc_html__( 'WPForms Lite', 'qi' ),
				'wp-user-avatar'          => esc_html__( 'ProfilePress', 'qi' ),
			);
			$demos         = array();
			$names         = array(
				esc_html__( 'Creative Agency', 'qi' ),
				esc_html__( 'Construction', 'qi' ),
				esc_html__( 'Wedding', 'qi' ),
				esc_html__( 'Branding Agency', 'qi' ),
				esc_html__( 'Digital Studio', 'qi' ),
				esc_html__( 'Coworking Space', 'qi' ),
				esc_html__( 'Dentist', 'qi' ),
				esc_html__( 'Party Planner', 'qi' ),
				esc_html__( 'SEO Agency', 'qi' ),
				esc_html__( 'Translation Company', 'qi' ),
				esc_html__( 'Restaurant', 'qi' ),
				esc_html__( 'Bakery', 'qi' ),
				esc_html__( 'Product Presentation', 'qi' ),
				esc_html__( 'Vehicle Rental', 'qi' ),
				esc_html__( 'Nutritionist', 'qi' ),
				esc_html__( 'App Showcase', 'qi' ),
				esc_html__( 'Sports Shop', 'qi' ),
				esc_html__( 'Toy Shop', 'qi' ),
				esc_html__( 'Jewelry Store', 'qi' ),
				esc_html__( 'Manicure', 'qi' ),
				esc_html__( 'Digital Agency', 'qi' ),
				esc_html__( 'Web Agency', 'qi' ),
				esc_html__( 'Interior Design Shop', 'qi' ),
				esc_html__( 'Creative Studio', 'qi' ),
				esc_html__( 'Wedding Invitation', 'qi' ),
				esc_html__( '3D Modeling Portfolio', 'qi' ),
				esc_html__( 'Movie', 'qi' ),
				esc_html__( 'Delivery', 'qi' ),
				esc_html__( 'Dog Walker', 'qi' ),
				esc_html__( 'Web Studio', 'qi' ),
				esc_html__( 'Yoga Studio', 'qi' ),
				esc_html__( 'Videographer', 'qi' ),
				esc_html__( 'Illustration Portfolio', 'qi' ),
				esc_html__( 'Design Agency', 'qi' ),
				esc_html__( 'Seafood Restaurant', 'qi' ),
				esc_html__( 'Cake Shop', 'qi' ),
				esc_html__( 'Agency', 'qi' ),
				esc_html__( 'Furniture', 'qi' ),
				esc_html__( 'Architecture Studio', 'qi' ),
				esc_html__( 'Law Firm', 'qi' ),
				esc_html__( 'Photography Portfolio', 'qi' ),
				esc_html__( '3D Modeling Studio', 'qi' ),
				esc_html__( 'Cocktail Bar', 'qi' ),
				esc_html__( 'Movie Dark', 'qi' ),
				esc_html__( 'Video Showcase', 'qi' ),
				esc_html__( 'School', 'qi' ),
				esc_html__( 'Beauty Store', 'qi' ),
				esc_html__( 'Wellness', 'qi' ),
				esc_html__( 'Agency Creative', 'qi' ),
				esc_html__( 'Ice Cream', 'qi' ),
				esc_html__( 'Product Photography', 'qi' ),
				esc_html__( 'Transport', 'qi' ),
				esc_html__( 'Fashion Store', 'qi' ),
				esc_html__( 'Gym', 'qi' ),
				esc_html__( 'Car Rental', 'qi' ),
				esc_html__( 'Laundry Service', 'qi' ),
				esc_html__( 'Travel Agency', 'qi' ),
				esc_html__( 'Agency Dark', 'qi' ),
				esc_html__( 'SEO Company', 'qi' ),
				esc_html__( 'Café & Restaurant', 'qi' ),
				esc_html__( 'Packaging Design', 'qi' ),
				esc_html__( 'Flower Arrangement', 'qi' ),
				esc_html__( 'Wedding Announcement', 'qi' ),
				esc_html__( 'Sports', 'qi' ),
				esc_html__( 'Bed and Breakfast', 'qi' ),
				esc_html__( 'Health Center', 'qi' ),
				esc_html__( 'Clothing Store', 'qi' ),
				esc_html__( 'Movie Presentation', 'qi' ),
				esc_html__( 'Organic Food', 'qi' ),
				esc_html__( 'Writer', 'qi' ),
				esc_html__( 'Photographer', 'qi' ),
				esc_html__( 'Day Care', 'qi' ),
				esc_html__( 'CV', 'qi' ),
				esc_html__( 'Veterinarian', 'qi' ),
				esc_html__( 'Skincare', 'qi' ),
				esc_html__( 'Hair Salon', 'qi' ),
				esc_html__( 'Garden Design', 'qi' ),
				esc_html__( 'Tailor', 'qi' ),
				esc_html__( 'Tech Agency', 'qi' ),
				esc_html__( 'Fast Food', 'qi' ),
				esc_html__( 'Barber', 'qi' ),
				esc_html__( 'SaaS', 'qi' ),
				esc_html__( 'Wedding Venue', 'qi' ),
				esc_html__( 'Interactive Photography', 'qi' ),
				esc_html__( 'Concept Art Portfolio', 'qi' ),
				esc_html__( 'Boutique', 'qi' ),
				esc_html__( 'Baby Store', 'qi' ),
				esc_html__( 'Branding Portfolio', 'qi' ),
				esc_html__( 'Agency One Page', 'qi' ),
				esc_html__( 'Art Shop', 'qi' ),
				esc_html__( 'Environmental NGO', 'qi' ),
				esc_html__( 'Modeling Agency', 'qi' ),
				esc_html__( 'Makeup', 'qi' ),
				esc_html__( 'Movie Portfolio', 'qi' ),
				esc_html__( 'Personal Portfolio', 'qi' ),
				esc_html__( 'Art Gallery', 'qi' ),
				esc_html__( 'Oil Industry', 'qi' ),
				esc_html__( 'Wedding Photography', 'qi' ),
				esc_html__( 'Interior Design', 'qi' ),
				esc_html__( 'Patisserie', 'qi' ),
			);
			$plugins       = array(
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
				),
				array(
					'contact-form-7',
					'woocommerce',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'custom-twitter-feeds',
				),
				array(
					'contact-form-7',
					'woocommerce',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'woocommerce',
				),
				array(),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'custom-facebook-feed',
					'instagram-feed',
					'woocommerce',
				),
				array(),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
				),
				array(),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'woocommerce',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'woocommerce',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'woocommerce',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'wp-user-avatar',
					'wpforms-lite',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
					'woocommerce',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(),
				array(
					'contact-form-7',
					'woocommerce',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'instagram-feed',
					'woocommerce',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
					'woocommerce',
				),
				array(
					'contact-form-7',
					'wp-user-avatar',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
				),
				array(
					'contact-form-7',
					'instagram-feed',
				),
				array(
					'contact-form-7',
				),
			);
			$thumbs        = array(
				'6',
				'6',
				'6',
				'6',
				'5',
				'5',
				'6',
				'1',
				'5',
				'5',
				'5',
				'5',
				'1',
				'6',
				'4',
				'3',
				'6',
				'5',
				'6',
				'5',
				'6',
				'6',
				'6',
				'5',
				'2',
				'3',
				'3',
				'5',
				'6',
				'6',
				'5',
				'5',
				'5',
				'2',
				'5',
				'5',
				'5',
				'5',
				'5',
				'5',
				'4',
				'6',
				'6',
				'3',
				'5',
				'4',
				'4',
				'5',
				'6',
				'5',
				'3',
				'5',
				'5',
				'6',
				'6',
				'4',
				'5',
				'6',
				'1',
				'4',
				'4',
				'5',
				'3',
				'4',
				'4',
				'5',
				'6',
				'1',
				'5',
				'2',
				'4',
				'5',
				'1',
				'6',
				'6',
				'5',
				'5',
				'6',
				'4',
				'4',
				'4',
				'1',
				'4',
				'3',
				'4',
				'5',
				'5',
				'3',
				'1',
				'3',
				'5',
				'4',
				'4',
				'3',
				'4',
				'3',
				'5',
				'6',
				'4',
				'4',
			);
			$sort          = array(
				1   => 13,
				2   => 11,
				3   => 20,
				4   => 39,
				5   => 30,
				6   => 6,
				7   => 4,
				8   => 23,
				9   => 24,
				10  => 36,
				11  => 40,
				12  => 18,
				13  => 5,
				14  => 1,
				15  => 38,
				16  => 14,
				17  => 26,
				18  => 29,
				19  => 32,
				20  => 21,
				21  => 3,
				22  => 16,
				23  => 10,
				24  => 17,
				25  => 31,
				26  => 25,
				27  => 19,
				28  => 66,
				29  => 9,
				30  => 8,
				31  => 34,
				32  => 22,
				33  => 12,
				34  => 27,
				35  => 37,
				36  => 28,
				37  => 7,
				38  => 35,
				39  => 2,
				40  => 15,
				41  => 59,
				42  => 41,
				43  => 51,
				44  => 57,
				45  => 71,
				46  => 50,
				47  => 70,
				48  => 95,
				49  => 42,
				50  => 45,
				51  => 54,
				52  => 75,
				53  => 44,
				54  => 69,
				55  => 87,
				56  => 65,
				57  => 53,
				58  => 43,
				59  => 64,
				60  => 48,
				61  => 61,
				62  => 62,
				63  => 56,
				64  => 58,
				65  => 68,
				66  => 47,
				67  => 97,
				68  => 60,
				69  => 63,
				70  => 67,
				71  => 33,
				72  => 74,
				73  => 52,
				74  => 81,
				75  => 96,
				76  => 72,
				77  => 55,
				78  => 89,
				79  => 49,
				80  => 46,
				81  => 94,
				82  => 83,
				83  => 99,
				84  => 78,
				85  => 93,
				86  => 86,
				87  => 88,
				88  => 79,
				89  => 77,
				90  => 92,
				91  => 76,
				92  => 84,
				93  => 85,
				94  => 80,
				95  => 91,
				96  => 82,
				97  => 73,
				98  => 100,
				99  => 90,
				100 => 98,
			);

			for ( $i = 0; $i <= 99; $i ++ ) {

				$j = $i + 1;

				$required_plugins = array(
					'elementor'               => array(
						'name' => $plugins_names['elementor'],
					),
					'qi-addons-for-elementor' => array(
						'name' => $plugins_names['qi-addons-for-elementor'],
					),
				);

				foreach ( $plugins[ $i ] as $plugin ) {
					$required_plugins[ $plugin ]['name'] = $plugins_names[ $plugin ];
				}

				$demos[ $sort[ $j ] ] = array(
					'demo_name'                   => $names[ $i ],
					'demo_file_url'               => $this->demo_content_uri . 'qi' . $j . '/import-files/content.xml',
					'demo_widgets_file_url'       => $this->demo_content_uri . 'qi' . $j . '/import-files/widgets.json',
					'demo_settings_page_file_url' => $this->demo_content_uri . 'qi' . $j . '/import-files/settings-pages.json',
					'demo_menu_settings_file_url' => $this->demo_content_uri . 'qi' . $j . '/import-files/menus.json',
					'demo_import_options'         => array(
						array(
							'option_name' => 'qode_essential_addons_options',
							'file_url'    => $this->demo_content_uri . 'qi' . $j . '/import-files/options.json',
						),
						array(
							'option_name' => 'qode_essential_addons_framework_custom_sidebars',
							'file_url'    => $this->demo_content_uri . 'qi' . $j . '/import-files/custom-sidebars.json',
						),
					),
					'demo_image_url'              => $this->demo_content_uri . 'qi' . $j . '/preview-images/qi' . $j . '-01.jpg',
					'demo_preview_url'            => 'https://qi' . $j . '.qodeinteractive.com/',
				);

				if ( isset( $thumbs[ $i ] ) && (int) $thumbs[ $i ] > 1 ) {
					for ( $k = 2; $k <= (int) $thumbs[ $i ]; $k ++ ) {
						$demos[ $sort[ $j ] ]['demo_additional_images_urls'][] = $this->demo_content_uri . 'qi' . $j . '/preview-images/qi' . $j . '-0' . $k . '.jpg';
					}
				}

				if ( count( $required_plugins ) > 0 ) {
					$demos[ $sort[ $j ] ]['required_plugins'] = $required_plugins;
				}
			}

			ksort( $demos );

			return $demos;

		}

		function demos_title( $title ) {

			$title = esc_html__( 'Import Qi demos with ease', 'qi' );

			return $title;
		}
	}

	Qi_Import::get_instance();
}
