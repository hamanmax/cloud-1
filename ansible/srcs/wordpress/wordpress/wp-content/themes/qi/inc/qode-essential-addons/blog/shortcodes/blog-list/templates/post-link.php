<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post format part
		$params['title_tag'] = $quote_link_tag;
		qi_template_part( 'blog', 'templates/parts/post-format/link', '', $params );
		?>
	</div>
</article>
