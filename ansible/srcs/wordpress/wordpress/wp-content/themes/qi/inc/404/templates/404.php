<?php

// Hook to include additional content before 404 page content
do_action( 'qi_action_before_404_page_content' );

// Include module content template
echo apply_filters( 'qi_filter_404_page_content_template', qi_get_template_part( '404', 'templates/404-content' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

// Hook to include additional content after 404 page content
do_action( 'qi_action_after_404_page_content' );
