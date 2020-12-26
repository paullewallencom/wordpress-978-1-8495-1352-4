<?php
/*
Plugin Name: Content Chunks
Plugin URI: http://tipsfor.us
Description: Display Random Chunks of Content from a custom post type "chunk"
Author: Everett Griffiths
Version: 0.1
Author URI: http://tipsfor.us
*/
include_once('includes/ContentChunks.php');

add_action( 'init', 'ContentChunks::register_chunk_post_type');
add_action( 'init', 'ContentChunks::register_shortcodes');
add_action('admin_menu', 'ContentChunks::create_admin_menu');
#add_filter('plugin_action_links', 'ContentChunks::add_plugin_settings_link', 10, 2 );
add_filter('plugin_action_links_content-chunks/index.php', 'ContentChunks::add_plugin_settings_link', 10, 2 );

/*EOF*/