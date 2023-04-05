<div class="qodef-grid-item <?php echo esc_attr( qi_get_page_content_sidebar_classes() ); ?>">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) :
			the_post();

			// Hook to include additional content before page content
			do_action( 'qi_action_before_page_content' );

			the_content();

			// Hook to include additional content after page content
			do_action( 'qi_action_after_page_content' );

		endwhile; // End of the loop.
	}
	?>
</div>
