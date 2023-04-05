<a itemprop="url" class="qodef-mobile-header-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	<?php
	// Include mobile header logo image html
	echo qi_get_header_logo_image(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	// Hook to include additional content after mobile header logo image
	do_action( 'qi_action_after_mobile_header_logo_image' );
	?>
</a>
