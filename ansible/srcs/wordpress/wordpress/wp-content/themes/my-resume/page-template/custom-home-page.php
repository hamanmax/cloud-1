<?php
/**
 * Template Name: Custom Home
 */
?>
<?php get_header(); ?>
	
<main id="skip-content" role="main">
	<div class="container">
		<?php do_action( 'my_resume_above_banner' ); ?>
		<section id="banner">
		    <?php $my_resume_banner_pages = array();
	        $mod = intval( get_theme_mod( 'my_resume_banner_page'));
	        if ( 'page-none-selected' != $mod ) {
	          	$my_resume_banner_pages[] = $mod;
	        }
	      	if( !empty($my_resume_banner_pages) ) :
		        $args = array(
		          	'post_type' => 'page',
		          	'post__in' => $my_resume_banner_pages,
		          	'orderby' => 'post__in'
		        );
		        $query = new WP_Query( $args );
		        if ( $query->have_posts() ) :
			      	while ( $query->have_posts() ) : $query->the_post(); ?>
	            		<div class="row ">
	            			<div class="col-lg-6 col-md-12">
	            				<div class="banner-img">
					          		<a href="<?php the_permalink(); ?>"><img src="<?php esc_url(the_post_thumbnail_url('full')); ?>" alt="<?php the_title_attribute(); ?> "/></a>
					          		<?php if (get_theme_mod('my_resume_banner_candidate_name') != '') { ?>
					              		<p class="candidate-name mb-0 text-center"><?php echo esc_html(get_theme_mod('my_resume_banner_candidate_name','')); ?></p>
					              	<?php }?>
							    </div>
			              	</div>
			              	<div class="col-lg-6 col-md-12">
			              		<div class="banner-content p-xl-5 p-4 mr-5">
				              		<div class="logo">
										<?php if ( has_custom_logo() ) : ?>
								    		<?php the_custom_logo(); ?>
								        <?php endif; ?>
								      	<?php $blog_info = get_bloginfo( 'name' ); ?>
							            <?php if ( ! empty( $blog_info ) ) : ?>
							              	<?php if ( is_front_page() && is_home() ) : ?>
							                	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							              	<?php else : ?>
							              		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							          		<?php endif; ?>
							            <?php endif; ?>
							            <?php
							            if( get_theme_mod('my_resume_show_tagline',true) == true ) {
							          		$description = get_bloginfo( 'description', 'display' );
							              	if ( $description || is_customize_preview() ) :
								            ?>
								          		<p class="site-description"><?php echo esc_html($description); ?></p>
								      		<?php endif; 
								      	}?>
								    </div>
							    	<?php if (get_theme_mod('my_resume_banner_designation') != '') { ?>
					              		<p class="designation mt-4"><?php echo esc_html(get_theme_mod('my_resume_banner_designation','')); ?></p>
					              	<?php }?>
					              	<p class="my-3"><?php $excerpt = get_the_excerpt(); echo esc_html( my_resume_string_limit_words( $excerpt,15 ) ); ?></p>
					              	<div class="contact-details mt-4 pt-4">
						              	<?php if (get_theme_mod('my_resume_banner_phone') != '') { ?>
						              		<p class="phone"><i class="fas fa-phone"></i><?php echo esc_html('Phone:', 'my-resume'); ?> <a href="tel:<?php echo esc_url(get_theme_mod('my_resume_banner_phone','')); ?>"><?php echo esc_html(get_theme_mod('my_resume_banner_phone','')); ?></a></p>
						              	<?php }?>
						              	<?php if (get_theme_mod('my_resume_banner_email') != '') { ?>
						              		<p class="phone"><i class="fas fa-envelope"></i><?php echo esc_html('Email:', 'my-resume'); ?> <a href="mailto:<?php echo esc_url(get_theme_mod('my_resume_banner_email','')); ?>"><?php echo esc_html(get_theme_mod('my_resume_banner_email','')); ?></a></p>
						              	<?php }?>
						              	<?php if (get_theme_mod('my_resume_banner_address') != '') { ?>
						              		<p class="phone"><i class="fas fa-map-marker-alt"></i><?php echo esc_html('Address:', 'my-resume'); ?> <?php echo esc_html(get_theme_mod('my_resume_banner_address','')); ?></p>
						              	<?php }?>
						              	<?php if (get_theme_mod('my_resume_banner_date_of_birth') != '') { ?>
						              		<p class="phone"><i class="far fa-calendar-alt"></i><?php echo esc_html('Date of Birth:', 'my-resume'); ?> <?php echo esc_html(get_theme_mod('my_resume_banner_date_of_birth','')); ?></p>
						              	<?php }?>
						              	<div class="social-icons">
						              		<span class="mr-2"><?php echo esc_html('Social Icons:', 'my-resume'); ?></span> 
								    		<?php if (get_theme_mod('my_resume_facebook') != '') { ?>
								    			<a href="<?php echo esc_url(get_theme_mod('my_resume_facebook')); ?>"><i class="fab fa-facebook-f"></i><span class="screen-reader-text"><?php esc_html_e('Facebook', 'my-resume'); ?></span></a>
								    		<?php }?>
								    		<?php if (get_theme_mod('my_resume_twitter') != '') { ?>
								    			<a href="<?php echo esc_url(get_theme_mod('my_resume_twitter')); ?>"><i class="fab fa-twitter"></i><span class="screen-reader-text"><?php esc_html_e('Twitter', 'my-resume'); ?></span></a>
								    		<?php }?>
								    		<?php if (get_theme_mod('my_resume_linkedin') != '') { ?>
								    			<a href="<?php echo esc_url(get_theme_mod('my_resume_linkedin')); ?>"><i class="fab fa-linkedin-in"></i><span class="screen-reader-text"><?php esc_html_e('Linkedin', 'my-resume'); ?></span></a>
								    		<?php }?>
								    	</div>
					              	</div>
				              	</div>
			              	</div>
		              	</div>
			      	<?php endwhile; 
			      	wp_reset_postdata();?>
			    <?php else : ?>
			    	<div class="no-postfound"></div>
	      		<?php endif;
		    endif;?>
		  	<div class="clearfix"></div>
		</section>

		<?php do_action('my_resume_below_banner'); ?>

		<?php /*--- Our Skills ---*/ ?>
		<section id="our_skill">
			<div class="container">
	      		<div class="row">
		      		<?php 
		      		$my_resume_catData=  get_theme_mod('my_resume_skills_cat');
		            if($my_resume_catData){
		            	$i=1;
			            $page_query = new WP_Query(array( 'category_name' => esc_html( $my_resume_catData ,'my-resume')));?>
			        	<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?> 
			        		<div class="col-lg-4 col-md-6">
								<div class="skill-box mb-4">
						        	<div class="skill-content p-lg-5 p-3">
										<p class="skillno"><?php echo esc_html($i); ?></p>
					            		<h3><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title(); ?></a></h3>
					            		<p><?php $excerpt = get_the_excerpt(); echo esc_html( my_resume_string_limit_words( $excerpt,12 ) ); ?></p>
				            		</div>
				            		<div class="more-btn px-lg-5 px-3 py-4">
								      	<a href="<?php the_permalink(); ?>"><span><?php esc_html_e('READ MORE','my-resume'); ?></span><i class="fas fa-long-arrow-alt-right"></i><span class="screen-reader-text"><?php esc_html_e('READ MORE','my-resume'); ?></span></a>
								      	<i class="far fa-image"></i>
								    </div>
								</div>
							</div>
					  		<div class="clearfix"></div>    	
		          		<?php $i++; endwhile; 
			          	wp_reset_postdata();
		      		} ?>
		      	</div>
			</div>
		</section>

		<?php do_action('my_resume_below_services_section'); ?>

		<div class="lz-content">
		  	<?php while ( have_posts() ) : the_post(); ?>
		        <?php the_content(); ?>
		    <?php endwhile; // end of the loop. ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>