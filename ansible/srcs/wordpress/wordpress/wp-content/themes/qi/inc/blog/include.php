<?php

include_once QI_INC_ROOT_DIR . '/blog/helper.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

foreach ( glob( QI_INC_ROOT_DIR . '/blog/templates/*/include.php' ) as $module ) {
	include_once $module; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
}
