<?php

if ( ! function_exists( 'qi_override_blog_list_sc_template_path' ) ) {
	/**
	 * Function that override blog list shortcode template path
	 *
	 * @param string $template - contains html content
	 * @param string $layout
	 * @param string $post_formats
	 * @param array $params
	 *
	 * @return string - contains html content
	 */
	function qi_override_blog_list_sc_template_path( $template, $layout, $post_formats, $params ) {

		if ( 'standard' === $layout ) {
			return qi_get_template_part( 'qode-essential-addons', 'blog/shortcodes/blog-list/templates/post', $post_formats, $params );
		}

		return $template;
	}

	add_filter( 'qode_essential_addons_filter_blog_list_sc_layout_path', 'qi_override_blog_list_sc_template_path', 10, 4 );
}
