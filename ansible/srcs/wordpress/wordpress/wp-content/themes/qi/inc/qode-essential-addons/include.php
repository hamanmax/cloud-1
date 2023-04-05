<?php

include_once QI_INC_ROOT_DIR . '/qode-essential-addons/class-qodeessentialaddons-installation-notice.php';

foreach ( glob( QI_INC_ROOT_DIR . '/qode-essential-addons/*/include.php' ) as $module ) {
	include_once $module; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
}

foreach ( glob( QI_INC_ROOT_DIR . '/qode-essential-addons/*/shortcodes/*/include.php' ) as $module ) {
	include_once $module; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
}
