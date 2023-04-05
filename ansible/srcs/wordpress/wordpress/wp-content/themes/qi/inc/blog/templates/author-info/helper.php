<?php

if ( ! function_exists( 'qi_include_blog_single_author_info_template' ) ) {
	/**
	 * Function which includes additional module on single posts page
	 */
	function qi_include_blog_single_author_info_template() {
		if ( is_single() ) {
			qi_template_part( 'blog', 'templates/author-info/templates/author' );
		}
	}

	add_action( 'qi_action_after_blog_post_item', 'qi_include_blog_single_author_info_template', 15 );  // permission 15 is set to define template position
}
