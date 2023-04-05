<?php

if ( ! function_exists( 'qi_add_link_pages_after_content' ) ) {
	/**
	 * Function which add pagination for blog single and page
	 */
	function qi_add_link_pages_after_content() {

		$args_pages = array(
			'before'      => '<div class="qodef-single-links qodef-m"><span class="qodef-m-single-links-title qodef-info-style">' . esc_html__( 'Pages: ', 'qi' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '%',
		);

		wp_link_pages( $args_pages );
	}

	add_action( 'qi_action_after_blog_single_content', 'qi_add_link_pages_after_content' );
	add_action( 'qi_action_after_page_content', 'qi_add_link_pages_after_content' );
}
