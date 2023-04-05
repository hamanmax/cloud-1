<?php

if ( ! function_exists( 'qi_get_search_page_excerpt_length' ) ) {
	/**
	 * Function that return number of characters for excerpt on search page
	 *
	 * @return int
	 */
	function qi_get_search_page_excerpt_length() {
		$length = apply_filters( 'qi_filter_post_excerpt_length', 180 );

		return intval( $length );
	}
}
