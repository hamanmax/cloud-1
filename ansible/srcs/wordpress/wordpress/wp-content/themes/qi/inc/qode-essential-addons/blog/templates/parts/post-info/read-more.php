<?php if ( ! post_password_required() ) { ?>
	<div class="qodef-e-read-more" <?php qi_render_inline_style( $this_shortcode->get_read_more_styles( $params ) ); ?>>
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
