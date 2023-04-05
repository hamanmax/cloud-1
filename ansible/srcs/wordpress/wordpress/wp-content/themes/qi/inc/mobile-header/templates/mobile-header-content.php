<?php

// Include mobile logo
echo apply_filters( 'qi_filter_mobile_header_logo_template', qi_get_template_part( 'mobile-header', 'templates/parts/mobile-logo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

// Include mobile navigation opener
qi_template_part( 'mobile-header', 'templates/parts/mobile-navigation-opener' );

// Include mobile navigation
qi_template_part( 'mobile-header', 'templates/parts/mobile-navigation' );
