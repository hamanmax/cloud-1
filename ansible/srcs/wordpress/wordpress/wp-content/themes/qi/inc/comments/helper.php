<?php

if ( ! function_exists( 'qi_include_comments_in_templates' ) ) {
	/**
	 * Function which includes comments templates on pages/posts
	 */
	function qi_include_comments_in_templates() {

		// Include comments template
		comments_template();
	}

	add_action( 'qi_action_after_page_content', 'qi_include_comments_in_templates', 100 ); // permission 100 is set to comments template be at the last place
	add_action( 'qi_action_after_blog_post_item', 'qi_include_comments_in_templates', 100 );
}

if ( ! function_exists( 'qi_is_page_comments_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 */
	function qi_is_page_comments_enabled() {
		return apply_filters( 'qi_filter_enable_page_comments', true );
	}
}

if ( ! function_exists( 'qi_load_page_comments' ) ) {
	/**
	 * Function which loads page template module
	 */
	function qi_load_page_comments() {

		if ( qi_is_page_comments_enabled() ) {
			qi_template_part( 'comments', 'templates/comments' );
		}
	}

	add_action( 'qi_action_page_comments_template', 'qi_load_page_comments' );
}

if ( ! function_exists( 'qi_get_comments_list_template' ) ) {
	/**
	 * Function which modify default WordPress comments list template
	 *
	 * @param object $comment
	 * @param array $args
	 * @param int $depth
	 *
	 * @return string that contains comments list html
	 */
	function qi_get_comments_list_template( $comment, $args, $depth ) {
		global $post;

		$classes = array();

		$is_author_comment = $post->post_author === $comment->user_id;
		if ( $is_author_comment ) {
			$classes[] = 'qodef-comment--author';
		}

		$is_specific_comment = 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type;
		if ( $is_specific_comment ) {
			$classes[] = 'qodef-comment--no-avatar';
			$classes[] = 'qodef-comment--' . esc_attr( $comment->comment_type );
		}
		?>
	<li class="qodef-comment-item qodef-e <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="qodef-e-inner">
			<?php if ( ! $is_specific_comment ) { ?>
				<div class="qodef-e-image"><?php echo get_avatar( $comment, 132 ); ?></div>
			<?php } ?>
			<div class="qodef-e-content">
				<div class="qodef-e-info">
					<div class="qodef-e-date commentmetadata">
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>"><?php comment_time( get_option( 'date_format' ) ); ?></a>
					</div>
					<div class="qodef-e-links">
						<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									// translators: %s - Add svg icon for reply link
									'reply_text' => qi_get_svg_icon( 'comment-reply' ),
									'depth'      => $depth,
									'max_depth'  => $args['max_depth'],
								)
							)
						);

						// translators: %s - Add svg icon for edit link
						edit_comment_link( qi_get_svg_icon( 'comment-edit' ) );
						?>
					</div>
				</div>
				<h5 class="qodef-e-title vcard"><?php echo sprintf( '<span class="fn">%s%s</span>', esc_attr( $is_specific_comment ) ? sprintf( '%s: ', esc_attr( ucwords( $comment->comment_type ) ) ) : '', get_comment_author_link() ); ?></h5>
				<?php if ( ! $is_specific_comment ) { ?>
					<div class="qodef-e-text"><?php comment_text( $comment ); ?></div>
				<?php } ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

if ( ! function_exists( 'qi_get_comment_form_args' ) ) {
	/**
	 * Function that define new comment form args in order to override default WordPress comment form
	 *
	 * @return array
	 */
	function qi_get_comment_form_args() {
		$args = array(
			'comment_field' => sprintf(
				'<p class="comment-form-comment">%s %s</p>',
				'<label for="comment">' . esc_html__( 'Comment', 'qi' ) . '</label>',
				'<textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required="required"></textarea>'
			),
			'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s"><span class="qodef-m-text">%4$s</span>' . qi_get_svg_icon( 'button-arrow', 'qodef-theme-button-icon' ) . '</button>',
			'class_submit'  => 'qodef-theme-button qodef--filled qodef--with-icon',
			'class_form'    => 'qodef-comment-form',
		);

		return apply_filters( 'qi_filter_comment_form_args', $args );
	}
}
