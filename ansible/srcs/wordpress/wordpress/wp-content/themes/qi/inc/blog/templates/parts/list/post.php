<article <?php post_class( 'qodef-blog-item qodef-e qodef-grid-item' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		qi_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top qodef-info-style">
				<?php
				if ( apply_filters( 'qi_filter_blog_show_date', true ) ) {
					// Include post date info
					qi_template_part( 'blog', 'templates/parts/post-info/date' );
				}
				if ( apply_filters( 'qi_filter_blog_show_category', true ) ) {
					// Include post category info
					qi_template_part( 'blog', 'templates/parts/post-info/category' );
				}
				if ( apply_filters( 'qi_filter_blog_show_author', true ) ) {
					// Include post author info
					qi_template_part( 'blog', 'templates/parts/post-info/author' );
				}
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				qi_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => 'h2' ) );

				if ( apply_filters( 'qi_filter_blog_show_excerpt', true ) ) {
					// Include post excerpt
					qi_template_part( 'blog', 'templates/parts/post-info/excerpt' );
				}

				// Hook to include additional content after blog single content
				do_action( 'qi_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<?php
				// Include post read more
				qi_template_part( 'blog', 'templates/parts/post-info/read-more' );
				?>
			</div>
		</div>
	</div>
</article>
