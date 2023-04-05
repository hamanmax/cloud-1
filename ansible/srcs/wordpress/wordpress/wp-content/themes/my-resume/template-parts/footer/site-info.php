<?php
/**
 * Displays footer site info
 *
 * @subpackage My Resume
 * @since 1.0
 * @version 1.4
 */

?>
<div class="site-info">
	<p><?php my_resume_credit(); ?> <?php echo esc_html(get_theme_mod('my_resume_footer_copy',__('By Luzuk','my-resume'))); ?></p>
</div>