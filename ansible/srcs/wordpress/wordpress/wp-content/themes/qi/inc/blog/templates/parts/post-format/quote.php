<?php
$quote_meta = get_post_meta( get_the_ID(), 'qodef_post_format_quote_text', true );
$quote_text = ! empty( $quote_meta ) ? $quote_meta : get_the_title();

if ( ! empty( $quote_text ) ) {
	$quote_author          = get_post_meta( get_the_ID(), 'qodef_post_format_quote_author', true );
	$quote_author_position = get_post_meta( get_the_ID(), 'qodef_post_format_quote_author_position', true );
	$title_tag             = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : qi_post_quote_link_title_tag();
	$author_title_tag      = isset( $author_title_tag ) && ! empty( $author_title_tag ) ? $author_title_tag : 'h6';
	$show_info_on_quote    = isset( $show_info_on_quote ) && 'no' === ( $show_info_on_quote ) ? false : true;
	?>
	<div class="qodef-e-quote">
		<div class="qodef-e-post-icon">
			<?php qi_render_svg_icon( 'quote' ); ?>
		</div>
		<?php if ( $show_info_on_quote ) { ?>
		<div class="qodef-e-info qodef-info--top qodef-info-style">
			<?php
			if ( apply_filters( 'qi_filter_blog_show_category', true ) ) {
				// Include post category info
				qi_template_part( 'blog', 'templates/parts/post-info/category' );
			}

			if ( apply_filters( 'qi_filter_blog_show_author', true ) ) {
				// Include post author info
				qi_template_part( 'blog', 'templates/parts/post-info/author' );
			}
			?>
		</div>
		<?php } ?>
		<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-quote-text"><?php echo esc_html( $quote_text ); ?></<?php echo esc_attr( $title_tag ); ?>>
		<?php if ( ! empty( $quote_author ) ) { ?>
			<<?php echo esc_attr( $author_title_tag ); ?> class="qodef-e-quote-author"><?php echo esc_html( $quote_author ); ?></<?php echo esc_attr( $author_title_tag ); ?>>
		<?php } ?>
		<a itemprop="url" class="qodef-e-quote-url" href="<?php the_permalink(); ?>"></a>
	</div>
<?php } ?>
