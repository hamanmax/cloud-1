<?php
/*
Template Name: Qi Landing
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
	<?php
	// Hook to include default WordPress hook after body tag open
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}

	// Hook to include additional content after body tag open
	do_action( 'qi_action_after_body_tag_open' );
	?>
	<div id="qodef-page-wrapper" class="<?php echo esc_attr( qi_get_page_wrapper_classes() ); ?>">
		<div id="qodef-page-outer">
			<?php
			// Hook to include additional content before page inner content
			do_action( 'qi_action_before_page_inner' );
			?>
			<div id="qodef-page-inner" class="qodef-content-full-width">
				<?php
				// Include content template
				qi_template_part( 'content', 'templates/content' );
				?>
			</div><!-- close #qodef-page-inner div from header.php -->
		</div><!-- close #qodef-page-outer div from header.php -->
		<?php
		// Hook to include additional content before wrapper close tag
		do_action( 'qi_action_before_wrapper_close_tag' );
		?>
	</div><!-- close #qodef-page-wrapper div from header.php -->
	<?php
	// Hook to include additional content before body tag closed
	do_action( 'qi_action_before_body_tag_close' );
	?>
	<?php wp_footer(); ?>
</body>
</html>
