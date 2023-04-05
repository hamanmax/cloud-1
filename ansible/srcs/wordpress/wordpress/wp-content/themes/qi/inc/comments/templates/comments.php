<div id="qodef-page-comments">
	<?php if ( have_comments() ) {
		$comments_number = get_comments_number();
		?>
		<div id="qodef-page-comments-list" class="qodef-m">
			<h3 class="qodef-m-title"><?php echo esc_html( _n( 'Comment', 'Comments', $comments_number, 'qi' ) ); ?></h3>
			<ul class="qodef-m-comments">
				<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'qi_get_comments_list_template' ), apply_filters( 'qi_filter_comments_list_template_callback', array() ) ) ) ); ?>
			</ul>

			<?php if ( get_comment_pages_count() > 1 ) { ?>
				<div class="qodef-m-pagination qodef--wp">
					<?php
					the_comments_pagination(
						array(
							'prev_text'          => qi_get_svg_icon( 'pagination-arrow-left' ),
							'next_text'          => qi_get_svg_icon( 'pagination-arrow-right' ),
							'before_page_number' => '',
						)
					);
					?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<p class="qodef-page-comments-not-found"><?php esc_html_e( 'Comments are closed.', 'qi' ); ?></p>
	<?php } ?>
	<div id="qodef-page-comments-form">
		<?php comment_form( qi_get_comment_form_args() ); ?>
	</div>
</div>
