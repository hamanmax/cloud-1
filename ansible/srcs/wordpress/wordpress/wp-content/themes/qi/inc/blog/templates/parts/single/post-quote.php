<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post format part
		qi_template_part( 'blog', 'templates/parts/post-format/quote' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-text">
				<?php
				// Include post content
				the_content();

				// Hook to include additional content after blog single content
				do_action( 'qi_action_after_blog_single_content' );
				?>
			</div>
			<?php if ( get_the_tags() ) { ?>
				<div class="qodef-e-info qodef-info--bottom">
					<?php
					// Include post tags info
					qi_template_part( 'blog', 'templates/parts/post-info/tags' );
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</article>
