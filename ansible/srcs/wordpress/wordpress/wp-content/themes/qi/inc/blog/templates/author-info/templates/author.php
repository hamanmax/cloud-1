<?php

if ( '' !== get_the_author_meta( 'description' ) ) {
	$author_id   = get_the_author_meta( 'ID' );
	$author_link = get_author_posts_url( $author_id );
	?>
	<div id="qodef-author-info" class="qodef-m">
		<h3 class="qodef-m-title"><?php esc_html_e( 'Author', 'qi' ); ?></h3>
		<div class="qodef-m-inner">
			<div class="qodef-m-image">
				<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
					<?php echo get_avatar( $author_id, 132 ); ?>
				</a>
			</div>
			<div class="qodef-m-content">
				<h5 class="qodef-m-author vcard author">
					<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
						<span class="fn"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></span>
					</a>
				</h5>
				<p itemprop="description" class="qodef-m-description"><?php echo esc_html( strip_tags( get_the_author_meta( 'description' ) ) ); ?></p>
			</div>
		</div>
	</div>
<?php } ?>
