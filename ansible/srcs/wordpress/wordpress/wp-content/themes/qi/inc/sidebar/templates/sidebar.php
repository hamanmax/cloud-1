<?php if ( qi_get_sidebar_layout() !== 'no-sidebar' ) { ?>
	<div class="qodef-grid-item <?php echo esc_attr( qi_get_page_sidebar_classes() ); ?>">
		<?php
		// Hook to include additional content before page sidebar
		do_action( 'qi_action_before_page_sidebar' );

		get_sidebar();

		// Hook to include additional content after page sidebar
		do_action( 'qi_action_after_page_sidebar' );
		?>
	</div>
<?php } ?>
