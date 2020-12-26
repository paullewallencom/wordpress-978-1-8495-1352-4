<?php
if ( ! defined('WP_CONTENT_DIR')) exit('No direct script access allowed');
/*------------------------------------------------------------------------------
Plugin Name: Content Rotator
Plugin URI: http://www.tipsfor.us/
Description: Sample plugin for rotating chunks of custom content.
Author: Everett Griffiths
Version: 0.1
Author URI: http://www.tipsfor.us/
------------------------------------------------------------------------------*/
// include() or require() any necessary files here...
include_once('includes/ContentRotator.php');
include_once('includes/ContentRotatorWidget.php');

//include_once('tests/Test.php');

// Tie into WordPress Hooks and any functions that should run on load.
add_action('widgets_init', 'ContentRotatorWidget::register_this_widget');
add_action('admin_menu', 'ContentRotator::add_menu_item');



/* EOF */