<a href="<?php echo esc_url( \ColibriWP\Theme\View::getData( 'link_value' ) ); ?>" class="wp-block wp-block-kubio-social-icon position-relative wp-block-kubio-social-icon__link elevate-front-header__k__j0IcrV0A3IO-link elevate-local-mc2WRNf0jb3-link social-icon-link" data-kubio="kubio/social-icon">
	<span class="h-svg-icon wp-block-kubio-social-icon__icon elevate-front-header__k__j0IcrV0A3IO-icon elevate-local-mc2WRNf0jb3-icon" name="font-awesome/youtube-square">
		<?php
		$icon = \ColibriWP\Theme\View::getData( 'icon' );
		if ( isset( $icon['content'] ) ) {
			echo $icon['content'];}
		?>
	</span>
</a>
