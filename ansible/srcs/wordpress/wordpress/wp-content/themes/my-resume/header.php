<?php
/**
 * The header for our theme
 *
 * @subpackage My Resume
 * @since 1.0
 * @version 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>

<a class="screen-reader-text skip-link" href="#skip-content"><?php esc_html_e( 'Skip to content', 'my-resume' ); ?></a>

<div class="row">
	<div class="col-lg-2 col-md-3 left-header pr-md-0">
		<div id="header">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-9">
					<div class="logo-initials">
	                	<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_theme_mod('my_resume_show_site_title_initials','')); ?></a></h1>
				    </div>
				</div>
				<div class="col-3">
					<?php if(has_nav_menu('primary')){ ?>
					    <div class="toggle-menu responsive-menu">
					        <button onclick="my_resume_open()" role="tab" class="mobile-menu"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','my-resume'); ?></span></button>
					    </div>
					<?php }?>
				</div>
			</div>
			<div class="menu-section">
				<div id="sidelong-menu" class="nav sidenav">
		            <nav id="primary-site-navigation" class="nav-menu" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'my-resume' ); ?>">
		              	<?php if(has_nav_menu('primary')){
		                    wp_nav_menu( array( 
								'theme_location' => 'primary',
								'container_class' => 'main-menu-navigation clearfix' ,
								'menu_class' => 'clearfix',
								'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
								'fallback_cb' => 'wp_page_menu',
		                    ) ); 
		              	} ?>
		              	<a href="javascript:void(0)" class="closebtn responsive-menu" onclick="my_resume_close()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','my-resume'); ?></span></a>
		            </nav>
		        </div>
		    </div>
		</div>
	</div>
	<div class="col-lg-10 col-md-9 pl-md-0">

		<?php if(is_singular()) {?>
			<div id="inner-pages-header">
				<div class="header-overlay"></div>
			    <div class="header-content">
				    <div class="container"> 
				      	<h1><?php single_post_title(); ?></h1>
				      	<div class="theme-breadcrumb mt-3">
							<?php my_resume_breadcrumb();?>
						</div>
				    </div>
				</div>
			</div>
		<?php } ?>