<?php
/**
 * Custom header implementation
 */

function my_resume_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'my_resume_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 200,
		'height'                 => 600,
		'wp-head-callback'       => 'my_resume_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'my_resume_custom_header_setup' );

if ( ! function_exists( 'my_resume_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see my_resume_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'my_resume_header_style' );
function my_resume_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        #header {
			background-image:url('".esc_url(get_header_image())."');
			background-size: 100%;
		}";
	   	wp_add_inline_style( 'my-resume-basic-style', $custom_css );
	endif;
}
endif; // my_resume_header_style