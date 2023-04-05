<div class="qodef-grid-item <?php echo esc_attr( qi_get_page_content_sidebar_classes() ); ?>">
	<?php
	// Hook to include additional content before blog loop
	do_action( 'qi_action_before_blog_loop' );
	?>
	<div class="qodef-blog qodef-m <?php echo esc_attr( qi_get_blog_holder_classes() ); ?>">
		<?php
		if ( ! is_single() ) { ?>
			<div class="qodef-grid-inner">
				<?php

				do_action( 'qi_filter_blog_list_content_before_loop' );

				// Include posts loop
				qi_template_part( 'blog', 'templates/parts/loop' );
				?>
			</div>
			<?php
			// Include pagination
			qi_template_part( 'pagination', 'templates/pagination-wp' );
			?>
		<?php } else {
			// Include posts loop
			qi_template_part( 'blog', 'templates/parts/loop' );
		}
		?>
	</div>
</div>
