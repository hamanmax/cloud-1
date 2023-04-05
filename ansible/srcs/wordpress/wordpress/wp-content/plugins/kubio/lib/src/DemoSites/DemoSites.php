<?php

namespace Kubio\DemoSites;

use IlluminateAgnostic\Arr\Support\Arr;
use Kubio\PluginsManager;

class DemoSites {

	public function __construct() {
		add_action( 'admin_init', array( $this, 'init' ) );
	}

	public static function load() {
		new DemoSites();
	}

	public static function exportDemoSiteContent() {
		$option_keys          = array( 'site_icon', 'site_logo', 'page_on_front', 'page_for_posts', 'show_on_front' );
		$dummy_fallback_value = uniqid( 'kubio-dummy-option-' );
		$options              = array();
		foreach ( $option_keys as $option_key ) {
			$option_value = get_option( $option_key, $dummy_fallback_value );

			if ( $option_value !== $dummy_fallback_value ) {
				$options[ $option_key ] = $option_value;
			}
		}

		$stylesheet     = get_stylesheet();
		$template       = get_template();
		$fse_base_query = array(
			'post_status'    => array( 'publish' ),
			'posts_per_page' => - 1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'wp_theme',
					'field'    => 'name',
					'terms'    => array( $stylesheet, $template ),
				),
			),
		);

		$wp_templates         = get_posts( array_merge( $fse_base_query, array( 'post_type' => 'wp_template' ) ) );
		$wp_template_parts    = get_posts( array_merge( $fse_base_query, array( 'post_type' => 'wp_template_part' ) ) );
		$template_slugs       = array();
		$template_parts_slugs = array();

		foreach ( $wp_templates as $wp_template ) {
			$template_slugs[] = $wp_template->post_name;
		}

		foreach ( $wp_template_parts as $wp_template_part ) {
			$template_parts_slugs[] = $wp_template_part->post_name;
		}

		return array(
			'site_url'       => WXRExporter::getSiteURL(),
			'content'        => WXRExporter::export(),
			'customizer'     => get_theme_mods(),
			'options'        => $options,
			'templates'      => $template_slugs,
			'template_parts' => $template_parts_slugs,
		);
	}

	public function init() {
		DemoSitesImporter::load();
		DemoSitesRepository::load();

		add_action( 'wp_ajax_kubio-demo-site-install-plugin', array( $this, 'installPlugin' ) );
		add_action( 'wp_ajax_kubio-demo-site-activate-plugin', array( $this, 'activatePlugin' ) );
	}

	public function installPlugin() {
		DemoSitesHelpers::verifyAjaxCall();

		$slug = sanitize_text_field( Arr::get( $_REQUEST, 'slug', null ) );

		if ( empty( $slug ) ) {
			DemoSitesHelpers::sendAjaxError( __( 'Slug not found', 'kubio' ) );
		}

		$result = PluginsManager::getInstance()->installPlugin( $slug );

		if ( is_wp_error( $result ) ) {
			DemoSitesHelpers::sendAjaxError( $result );
		} else {
			wp_send_json_success();
		}
	}

	public function activatePlugin() {
		DemoSitesHelpers::verifyAjaxCall();

		$slug = sanitize_text_field( Arr::get( $_REQUEST, 'slug', null ) );

		if ( empty( $slug ) ) {
			DemoSitesHelpers::sendAjaxError( __( 'Slug not found', 'kubio' ) );
		}

		$result = PluginsManager::getInstance()->activatePlugin( $slug, true );

		if ( is_wp_error( $result ) ) {
			DemoSitesHelpers::sendAjaxError( $result );
		} else {
			wp_send_json_success();
		}
	}

}
