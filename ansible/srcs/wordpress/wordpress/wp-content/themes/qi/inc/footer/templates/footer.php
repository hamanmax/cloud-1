<footer id="qodef-page-footer" <?php qi_class_attribute( implode( ' ', apply_filters( 'qi_filter_footer_holder_classes', array() ) ) ); ?>>
	<?php
	// Hook to include additional content before page footer content
	do_action( 'qi_action_before_page_footer_content' );

	// Include module content template
	echo apply_filters( 'qi_filter_footer_content_template', qi_get_template_part( 'footer', 'templates/footer-content' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	// Hook to include additional content after page footer content
	do_action( 'qi_action_after_page_footer_content' );
	?>
</footer>
