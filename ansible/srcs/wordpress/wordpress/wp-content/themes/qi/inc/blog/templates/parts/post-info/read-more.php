<?php if ( ! post_password_required() && qi_post_show_read_more() ) { ?>
	<div class="qodef-e-read-more">
		<?php
		if ( qi_post_has_read_more() ) {
			$button_params = apply_filters(
				'qi_filter_read_more_button_args',
				array(
					'link'          => get_permalink() . '#more-' . get_the_ID(),
					'button_layout' => 'simple',
					'text'          => esc_html__( 'Continue reading', 'qi' ),
				)
			);
		} else {
			$button_params = apply_filters(
				'qi_filter_read_more_button_args',
				array(
					'link'          => get_the_permalink(),
					'button_layout' => 'simple',
					'text'          => esc_html__( 'Read more', 'qi' ),
				)
			);
		}

		qi_render_button_element( $button_params );
		?>
	</div>
<?php } ?>
