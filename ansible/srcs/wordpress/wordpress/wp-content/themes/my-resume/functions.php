<?php
/**
 * My Resume functions and definitions
 *
 * @subpackage My Resume
 * @since 1.0
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/My_Resume_Loader.php' );

$my_resume_loader = new \WPTRT\Autoload\My_Resume_Loader();

$my_resume_loader->my_resume_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$my_resume_loader->my_resume_register();

function my_resume_setup() {
	
	load_theme_textdomain( 'my-resume', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background', $defaults = array(
	    'default-color'          => '',
	    'default-image'          => '',
	    'default-repeat'         => '',
	    'default-position-x'     => '',
	    'default-attachment'     => '',
	    'wp-head-callback'       => '_custom_background_cb',
	    'admin-head-callback'    => '',
	    'admin-preview-callback' => ''
	));

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'my-resume' ),
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', my_resume_fonts_url() ) );

	// Theme Activation Notice
	global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'my_resume_activation_notice' );
	}

}
add_action( 'after_setup_theme', 'my_resume_setup' );

// Notice after Theme Activation
function my_resume_activation_notice() {
	echo '<div class="notice notice-success is-dismissible start-notice">';
		echo '<h3>'. esc_html__( 'Welcome to Luzuk!!', 'my-resume' ) .'</h3>';
		echo '<p>'. esc_html__( 'Thank you for choosing My Resume theme. It will be our pleasure to have you on our Welcome page to serve you better.', 'my-resume' ) .'</p>';
		echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=my_resume_guide' ) ) .'" class="button button-primary">'. esc_html__( 'GET STARTED', 'my-resume' ) .'</a></p>';
	echo '</div>';
}

function my_resume_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'my-resume' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 2', 'my-resume' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'my-resume' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'my-resume' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'my-resume' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'my-resume' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'my-resume' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'my_resume_widgets_init' );

function my_resume_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Oswald:200,300,400,500,600,700';
	$font_family[] = 'Open Sans:300,400,600,700,800,300i,400i,600i,700i,800i';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

//Enqueue scripts and styles.
function my_resume_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'my-resume-fonts', my_resume_fonts_url(), array(), null );
	
	//Bootstarp 
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri()).'/assets/css/bootstrap.css' );
	
	// Theme stylesheet.
	wp_enqueue_style( 'my-resume-basic-style', get_stylesheet_uri() );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'my-resume-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'my-resume-style' ), '1.0' );
		wp_style_add_data( 'my-resume-ie9', 'conditional', 'IE 9' );
	}
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'my-resume-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'my-resume-style' ), '1.0' );
	wp_style_add_data( 'my-resume-ie8', 'conditional', 'lt IE 9' );

	//font-awesome
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css' );

	require get_parent_theme_file_path( '/lz-custom-style.php' );
	wp_add_inline_style( 'my-resume-basic-style',$my_resume_custom_style );
	
	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'my-resume-navigation-jquery', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
	}

	wp_enqueue_script( 'my-resume-navigation-jquery', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()) . '/assets/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'jquery-superfish', esc_url(get_template_directory_uri()) . '/assets/js/jquery.superfish.js', array('jquery') ,'',true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_resume_scripts' );

function my_resume_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'my_resume_front_page_template' );

define('MY_RESUME_LIVE_DEMO',__('https://www.luzukdemo.com/demo/my-resume/','my-resume'));
define('MY_RESUME_PRO_DOCS',__('https://www.luzukdemo.com/docs/my-resume/','my-resume'));
define('MY_RESUME_BUY_NOW',__('https://www.luzuk.com/product/resume-wordpress-theme/','my-resume'));
define('MY_RESUME_SUPPORT',__('https://wordpress.org/support/theme/my-resume/','my-resume'));
define('MY_RESUME_CREDIT',__('https://www.luzuk.com/themes/free-resume-wordpress-theme/','my-resume'));

if ( ! function_exists( 'my_resume_credit' ) ) {
	function my_resume_credit(){
		echo "<a href=".esc_url(MY_RESUME_CREDIT)." target='_blank'>".esc_html__('Resume WordPress Theme','my-resume')."</a>";
	}
}

function my_resume_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function my_resume_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function my_resume_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function my_resume_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function my_resume_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/* Excerpt Limit Begin */
function my_resume_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'my_resume_loop_columns');
if (!function_exists('my_resume_loop_columns')) {
	function my_resume_loop_columns() {
		return 3; // 3 products per row
	}
}

/* Breadcrumb Begin */
function my_resume_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url(home_url());
		echo '">';
			echo "<i class='fas fa-home'></i>";
		echo "</a> ";
		if (is_category() || is_single()) {
			echo "&nbsp;>&nbsp;";
			the_category(', ');
			if (is_single()) {
				echo "&nbsp;>&nbsp;";
				echo "<span> ";
					the_title();
				echo "</span>";
			}
		} elseif (is_page()) {
			echo "&nbsp;>&nbsp;";
			echo "<span>";
				the_title();
			echo "</span> ";
		}
	}
}

require get_parent_theme_file_path( '/inc/custom-header.php' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );

require get_parent_theme_file_path( '/inc/getting-started/getting-started.php' );