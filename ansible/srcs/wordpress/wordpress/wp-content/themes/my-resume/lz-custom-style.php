<?php 

	$my_resume_custom_style = '';

	// Logo Size
	$my_resume_logo_top_padding = get_theme_mod('my_resume_logo_top_padding');
	$my_resume_logo_bottom_padding = get_theme_mod('my_resume_logo_bottom_padding');
	$my_resume_logo_left_padding = get_theme_mod('my_resume_logo_left_padding');
	$my_resume_logo_right_padding = get_theme_mod('my_resume_logo_right_padding');

	if( $my_resume_logo_top_padding != '' || $my_resume_logo_bottom_padding != '' || $my_resume_logo_left_padding != '' || $my_resume_logo_right_padding != ''){
		$my_resume_custom_style .=' .logo {';
			$my_resume_custom_style .=' padding-top: '.esc_attr($my_resume_logo_top_padding).'px; padding-bottom: '.esc_attr($my_resume_logo_bottom_padding).'px; padding-left: '.esc_attr($my_resume_logo_left_padding).'px; padding-right: '.esc_attr($my_resume_logo_right_padding).'px;';
		$my_resume_custom_style .=' }';
	}

	// service section padding
	$my_resume_skills_section_padding = get_theme_mod('my_resume_skills_section_padding');

	if( $my_resume_skills_section_padding != ''){
		$my_resume_custom_style .=' #our_skill {';
			$my_resume_custom_style .=' padding-top: '.esc_attr($my_resume_skills_section_padding).'px; padding-bottom: '.esc_attr($my_resume_skills_section_padding).'px;';
		$my_resume_custom_style .=' }';
	}

	// Site Title Font Size
	$my_resume_site_title_initials_font_size = get_theme_mod('my_resume_site_title_initials_font_size');
	if( $my_resume_site_title_initials_font_size != ''){
		$my_resume_custom_style .=' .logo-initials h1 {';
			$my_resume_custom_style .=' font-size: '.esc_attr($my_resume_site_title_initials_font_size).'px;';
		$my_resume_custom_style .=' }';
	}

	// Copyright padding
	$my_resume_copyright_padding = get_theme_mod('my_resume_copyright_padding');

	if( $my_resume_copyright_padding != ''){
		$my_resume_custom_style .=' .site-info {';
			$my_resume_custom_style .=' padding-top: '.esc_attr($my_resume_copyright_padding).'px; padding-bottom: '.esc_attr($my_resume_copyright_padding).'px;';
		$my_resume_custom_style .=' }';
	}