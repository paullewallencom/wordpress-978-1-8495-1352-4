<?php
/*
Plugin Name: Standardized Custom Content
Plugin URI: http://www.tipsfor.us/
Description: Forces post-types to use a standard list of custom fields with options for checkboxes, dropdowns, and various text fields.
Author: Everett Griffiths
Version: 0.1
Author URI: http://www.tipsfor.us/

Based on work by Steve Taylor:
http://sltaylor.co.uk/blog/control-your-own-wordpress-custom-fields/
*/

include_once('includes/StandardizedCustomContent.php');

add_action( 'admin_menu', 'StandardizedCustomContent::create_meta_box' );
add_action( 'save_post', 'StandardizedCustomContent::save_custom_fields', 1, 2 );
add_action( 'do_meta_boxes', 'StandardizedCustomContent::remove_default_custom_fields', 10, 3 );

/*EOF*/