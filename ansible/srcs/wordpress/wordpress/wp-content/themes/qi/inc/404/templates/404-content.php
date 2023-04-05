<div id="qodef-404-page">
	<h1 class="qodef-404-title"><?php echo esc_html__( '404 - The page is not here.', 'qi' ); ?></h1>

	<p class="qodef-404-text">
		<?php
		// translators: %s - added br HTML tag inside text content
		echo sprintf( esc_html__( 'Oops! The page you are looking for does not exist. %sIt might have been moved or deleted.', 'qi' ), '<br />' );
		?>
	</p>

	<div class="qodef-404-search-form widget widget_search">
		<?php
		get_search_form();
		?>
	</div>
</div>
