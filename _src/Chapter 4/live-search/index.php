<?php
/*------------------------------------------------------------------------------
Plugin Name: Live Search
Plugin URI: http://www.tipsfor.us/
Description: Sample plugin for integrating jQuery with your WordPress plugins
Author: Everett Griffiths
Version: 0.1
Author URI: http://www.tipsfor.us/
------------------------------------------------------------------------------*/
// include() or require() any necessary files here...
include_once('includes/LiveSearch.php');
include_once('tests/Test.php');

// Tie into WordPress Hooks and any functions that should run on load.
add_action('init', 'LiveSearch::initialize');
add_action('wp_head', 'LiveSearch::head');

/* EOF */