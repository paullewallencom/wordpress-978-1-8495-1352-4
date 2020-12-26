<?php
/**
* This is run only when this plugin is uninstalled. All cleanup code goes here.
* 
* WARNING: uninstalling a plugin fails when developing locally via MAMP or WAMP.
*/

if ( defined('WP_UNINSTALL_PLUGIN'))
{
	include_once('includes/ContentChunks.php');
	delete_option( ContentChunks::option_key );
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}
/*EOF*/