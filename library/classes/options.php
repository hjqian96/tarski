<?php

class Options {

}


// External access
/* Uncomment when Options class written
function get_tarski_option($name) {
	global $tarski_options;
	return $tarski_options->$name;
}

function tarski_option($name) {
	echo get_tarski_option($name);
}
*/


// Options page handling

function tarski_inject_scripts() {
	if(substr($_SERVER['REQUEST_URI'], -39, 39) == 'wp-admin/themes.php?page=tarski-options') { // Hack detects Tarski Options page
		include(TEMPLATEPATH."/library/display/options/scripts.php");
	}
}
	
function tarski_addmenu() {
	add_submenu_page('themes.php', __('Tarski Options','tarski'), __('Tarski Options','tarski'), 'edit_themes', 'tarski-options', 'tarski_admin');
}

function tarski_admin() {
	require(TEMPLATEPATH."/library/display/options/main.php");
}

add_action('admin_menu', 'tarski_addmenu');
add_action('admin_head', 'tarski_inject_scripts');

?>