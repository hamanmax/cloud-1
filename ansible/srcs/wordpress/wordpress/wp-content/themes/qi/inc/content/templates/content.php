<?php
// Hook to include additional content before page content holder
do_action( 'qi_action_before_page_content_holder' );
?>
<main id="qodef-page-content" class="qodef-grid qodef-layout--columns <?php echo esc_attr( qi_get_page_grid_sidebar_classes() ); ?> <?php echo esc_attr( qi_get_grid_gutter_classes() ); ?>">
	<div class="qodef-grid-inner">
		<?php
		// Include page content loop
		qi_template_part( 'content', 'templates/parts/loop' );

		// Include page content sidebar
		qi_template_part( 'sidebar', 'templates/sidebar' );
		?>
	</div>
</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'qi_action_after_page_content_holder' );
?>
