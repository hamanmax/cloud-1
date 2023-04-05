<?php
$title_tag = is_singular( 'post' ) ? 'h2' : 'h1';
?>
<div class="qodef-m-content qodef-content-grid">
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title entry-title"><?php echo esc_html( qi_get_page_title_text() ); ?></<?php echo esc_attr( $title_tag ); ?>>
</div>
