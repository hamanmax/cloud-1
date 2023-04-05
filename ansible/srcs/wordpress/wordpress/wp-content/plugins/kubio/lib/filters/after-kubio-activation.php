<?php

use Kubio\Flags;

function kubio_set_editor_ui_version() {
	Flags::setSetting( 'editorUIVersion', 2 );
}

add_action( 'kubio/after_activation', 'kubio_set_editor_ui_version' );
