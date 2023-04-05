<?php if ( has_nav_menu( 'mobile-navigation' ) || has_nav_menu( 'main-navigation' ) ) { ?>
	<button type="button" class="qodef-mobile-header-opener" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open the menu', 'qi' ); ?>"><?php echo apply_filters( 'qi_filter_mobile_header_opener', qi_get_svg_icon( 'menu', 'qodef--initial' ) ); ?></button>
	<?php
}
