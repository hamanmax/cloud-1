<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		if ( 'no' !== $show_media ) {
			// Include post media
			qi_template_part( 'qode-essential-addons/blog', 'templates/parts/post-info/media', '', $params );
		}
		?>
		<div class="qodef-e-content" <?php qi_render_inline_style( $this_shortcode->get_content_styles( $params ) ); ?>>
			<?php if ( 'no' !== $show_date || 'no' !== $show_category || 'no' !== $show_author ) { ?>
				<div class="qodef-e-info qodef-info--top" <?php qi_render_inline_style( $this_shortcode->get_post_info_styles( $params ) ); ?>>
					<?php
					if ( 'no' !== $show_date ) {
						// Include post date info
						qi_template_part( 'blog', 'templates/parts/post-info/date' );
					}

					if ( 'no' !== $show_category ) {
						// Include post category info
						qi_template_part( 'blog', 'templates/parts/post-info/category' );
					}

					if ( 'no' !== $show_author ) {
						// Include post author info
						qi_template_part( 'blog', 'templates/parts/post-info/author' );
					}
					?>
				</div>
			<?php } ?>
			<div class="qodef-e-text">
				<?php
				// Include post title
				qi_template_part( 'qode-essential-addons/blog', 'templates/parts/post-info/title', '', $params );

				// Include post excerpt
				qi_template_part( 'qode-essential-addons/blog', 'templates/parts/post-info/excerpt', '', $params );

				// Hook to include additional content after blog single content
				do_action( 'qi_action_after_blog_single_content' );
				?>
			</div>
			<?php if ( 'no' !== $show_button ) { ?>
				<div class="qodef-e-info qodef-info--bottom">
					<?php
					// Include post read more
					qi_template_part( 'qode-essential-addons/blog', 'templates/parts/post-info/read-more', '', $params );
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</article>
