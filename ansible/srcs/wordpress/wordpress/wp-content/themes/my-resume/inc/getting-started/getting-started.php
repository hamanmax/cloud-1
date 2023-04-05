<?php
//about theme info
add_action( 'admin_menu', 'my_resume_gettingstarted' );
function my_resume_gettingstarted() {    	
	add_theme_page( esc_html__('About Theme', 'my-resume'), esc_html__('About Theme', 'my-resume'), 'edit_theme_options', 'my_resume_guide', 'my_resume_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function my_resume_admin_theme_style() {
   wp_enqueue_style('custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getting-started/getting-started.css');
}
add_action('admin_enqueue_scripts', 'my_resume_admin_theme_style');

//guidline for about theme
function my_resume_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'my-resume' );

?>

<div class="wrapper-info">
	<div class="col-left">
		<div class="intro">
			<h3><?php esc_html_e( 'Welcome to My Resume WordPress Theme', 'my-resume' ); ?> <span>Version: <?php echo esc_html($theme['Version']);?></span></h3>
		</div>
		<div class="started">
			<hr>
			<div class="free-doc">
				<div class="lz-4">
					<h4><?php esc_html_e( 'Start Customizing', 'my-resume' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Go to', 'my-resume' ); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizer', 'my-resume' ); ?> </a> <?php esc_html_e( 'and start customizing your website', 'my-resume' ); ?></span>
					</ul>
				</div>
				<div class="lz-4">
					<h4><?php esc_html_e( 'Support', 'my-resume' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Send your query to our', 'my-resume' ); ?> <a href="<?php echo esc_url( MY_RESUME_SUPPORT ); ?>" target="_blank"> <?php esc_html_e( 'Support', 'my-resume' ); ?></a></span>
					</ul>
				</div>
			</div>
			<p><?php esc_html_e( 'Online CV Resume is the perfect product for you to make a great first impression. It is the way for you to create your personal website of your job, skills, achievements and experiences .It is SEO optimized, multipurpose, multilingual and has responsive design. The Theme has a well designed layout but with customization features you get complete authority over it. You can present your profile digitally with spectacular design.You can create your website or vCard in no time. This theme is made with a bootstrap framework which gives it robust functioning. It is clean coded with mobile friendly layout. With the customization feature you will be able to make any changes you want.The modern design ensures better presentation of your portfolio. It has a responsive design with CTA i.e Call To Action button for fast responses and loading speed.  This theme is exceptional for developer, designer, programmer, freelancer, writer, lawyer, musician, trainer, photographer or any other professions. With powerful RyanCV and all the ready-made layouts and components. This theme has minimal coding to ensure superfast loading.', 'my-resume')?></p>
			<hr>			
			<div class="col-left-inner">
				<h3><?php esc_html_e( 'Get started with Free My Resume Theme', 'my-resume' ); ?></h3>
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/customizer-image.png" alt="" />
			</div>
		</div>
	</div>
	<div class="col-right">
		<div class="col-left-area">
			<h3><?php esc_html_e('Premium Theme Information', 'my-resume'); ?></h3>
			<hr>
		</div>
		<div class="centerbold">
			<a href="<?php echo esc_url( MY_RESUME_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'my-resume'); ?></a>
			<a href="<?php echo esc_url( MY_RESUME_BUY_NOW ); ?>"><?php esc_html_e('Buy Pro', 'my-resume'); ?></a>
			<a href="<?php echo esc_url( MY_RESUME_PRO_DOCS ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'my-resume'); ?></a>
			<hr class="secondhr">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/my-resume.jpg" alt="" />
		</div>
		<h3><?php esc_html_e( 'PREMIUM THEME FEATURES', 'my-resume'); ?></h3>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon01.png" alt="" />
			<h4><?php esc_html_e( 'Banner Slider', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon02.png" alt="" />
			<h4><?php esc_html_e( 'Theme Options', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon03.png" alt="" />
			<h4><?php esc_html_e( 'Custom Innerpage Banner', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon04.png" alt="" />
			<h4><?php esc_html_e( 'Custom Colors and Images', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon05.png" alt="" />
			<h4><?php esc_html_e( 'Fully Responsive', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon06.png" alt="" />
			<h4><?php esc_html_e( 'Hide/Show Sections', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon07.png" alt="" />
			<h4><?php esc_html_e( 'Woocommerce Support', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon08.png" alt="" />
			<h4><?php esc_html_e( 'Limit to display number of Posts', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon09.png" alt="" />
			<h4><?php esc_html_e( 'Multiple Page Templates', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon10.png" alt="" />
			<h4><?php esc_html_e( 'Custom Read More link', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon11.png" alt="" />
			<h4><?php esc_html_e( 'Code written with WordPress standard', 'my-resume'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon12.png" alt="" />
			<h4><?php esc_html_e( '100% Multi language', 'my-resume'); ?></h4>
		</div>
	</div>
</div>
<?php } ?>