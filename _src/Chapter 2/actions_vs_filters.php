<?php
/*
Plugin Name: Action vs. Filter
Plugin URI: http://wordpress.org/#
Description: Helping us understand the difference between actions and filters.
Author: Some Puerto Rican Guy
Version: 0.2
Author URI: http://goo.gl/kMEc
*/

add_filter('the_content', 'my_function');
function my_function($input) {
	return $input;
}

/*EOF*/