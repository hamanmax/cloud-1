<?php

if ( ! function_exists( 'qi_cf7_add_submit_form_tag' ) ) {
	/**
	 * Function that override default submit buttom html tag
	 */
	function qi_cf7_add_submit_form_tag() {
		wpcf7_add_form_tag( 'submit', 'qi_cf7_submit_form_tag_handler' );
	}

//	remove_action( 'wpcf7_init', 'wpcf7_add_form_tag_submit' );
//	add_action( 'wpcf7_init', 'qi_cf7_add_submit_form_tag' );
}

if ( ! function_exists( 'qi_cf7_submit_form_tag_handler' ) ) {
	/**
	 * Function that override default submit buttom html tag
	 *
	 * @param array $tag
	 *
	 * @return string
	 */
	function qi_cf7_submit_form_tag_handler( $tag ) {
		$tag   = new WPCF7_FormTag( $tag );
		$class = wpcf7_form_controls_class( $tag->type );

		$atts             = array();
		$atts['class']    = $tag->get_class_option( $class );
		$atts['class']   .= ' qodef-theme-button qodef--filled qodef--with-icon';
		$atts['id']       = $tag->get_id_option();
		$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

		$value = isset( $tag->values[0] ) ? $tag->values[0] : '';
		if ( empty( $value ) ) {
			$value = esc_html__( 'Send', 'qi' );
		}

		$atts['type'] = 'submit';
		$atts         = wpcf7_format_atts( $atts );

		$html = sprintf( '<button %1$s><span class="qodef-m-text">%2$s</span>' . qi_get_svg_icon( 'button-arrow', 'qodef-theme-button-icon' ) . '</button>', $atts, $value );

		return $html;
	}
}
