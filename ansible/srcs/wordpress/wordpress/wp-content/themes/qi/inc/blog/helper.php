<?php

if ( ! function_exists( 'qi_get_blog_holder_classes' ) ) {
	/**
	 * Function that return classes for the main blog holder
	 *
	 * @return string
	 */
	function qi_get_blog_holder_classes() {
		$classes = array();

		if ( is_single() ) {
			$classes[] = 'qodef--single';
		} else {
			$classes[] = 'qodef--list';
		}

		return implode( ' ', apply_filters( 'qi_filter_blog_holder_classes', $classes ) );
	}
}

if ( ! function_exists( 'qi_get_blog_list_excerpt_length' ) ) {
	/**
	 * Function that return number of characters for excerpt on blog list page
	 *
	 * @return int
	 */
	function qi_get_blog_list_excerpt_length() {
		$length = apply_filters( 'qi_filter_post_excerpt_length', 180 );

		return intval( $length );
	}
}

if ( ! function_exists( 'qi_post_has_read_more' ) ) {
	/**
	 * Function that checks if current post has read more tag set
	 *
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function qi_post_has_read_more() {
		global $post;

		return ! empty( $post ) ? strpos( $post->post_content, '<!--more-->' ) : false;
	}
}

if ( ! function_exists( 'qi_post_show_read_more' ) ) {
	/**
	 * Function that checks whether to show read more button
	 *
	 * @return int
	 */
	function qi_post_show_read_more() {
		$show = apply_filters( 'qi_filter_show_read_more', true );

		return $show;
	}
}

if ( ! function_exists( 'qi_post_quote_link_title_tag' ) ) {
	/**
	 * Function that sets H tag for quote/link title
	 *
	 * @return int
	 */
	function qi_post_quote_link_title_tag() {
		$title_tag = apply_filters( 'qi_filter_post_quote_link_tag', 'h2' );

		return $title_tag;
	}
}

if ( ! function_exists( 'qi_post_get_image' ) ) {
	/**
	 * Function that checks returns image for single or list
	 *
	 * @return string
	 */
	function qi_post_get_image( $post_id ) {

		$image = apply_filters( 'qi_filter_get_post_image', get_the_post_thumbnail( $post_id, 'full' ), $post_id );

		return $image;
	}
}
