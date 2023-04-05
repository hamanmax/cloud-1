<a itemprop="url" class="qodef-header-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	<?php
	// Include header logo image html
	echo qi_get_header_logo_image(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	// Hook to include additional content after header logo image
	do_action( 'qi_action_after_header_logo_image' );
	?>
</a>
