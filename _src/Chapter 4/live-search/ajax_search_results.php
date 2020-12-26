<?php
/**
* This file is an independent controller, used to query the WordPress database
* and provide search results for Ajax requests.
*
* @return string	Either return nothing (i.e. no results) or return some formatted results.
*/
if (!defined('WP_PLUGIN_URL')) {
	// WP functions become available once you include the config file
	require_once( realpath('../../../').'/wp-config.php' );
}

// No point in executing a query if there's no query string
if ( empty($_GET['s']) )
{
	exit;
}

$max_posts = 3; // Number of results to show

$WP_Query_object = new WP_Query();
$WP_Query_object->query(array('s' => $_GET['s'], 'showposts' => $max_posts));

// If there are no results... 
if (! count($WP_Query_object->posts) ){
	print file_get_contents( 'tpls/no_results.tpl');	
	exit;
}

// Otherwise, format the results
$container = array('content'=>''); // define the container's only placeholder
$single_tpl = file_get_contents( 'tpls/single_result.tpl');	
foreach($WP_Query_object->posts as $result)
{
	$result->permalink = get_permalink($result->ID);
	$container['content'] .= parse($single_tpl, $result);
}

// Wrap the results
$results_container_tpl = file_get_contents( 'tpls/results_container.tpl');
print parse($results_container_tpl, $container);


/**
* parse
*
* A simple parsing function for basic templating.
*
* @param $tpl	string 	A formatting string containing [+placeholders+]
* @param $hash	array	An associative array containing keys and values e.g. array('key' => 'value');
* @return	string		Placeholders corresponding to the keys of the hash will be replaced with the values the resulting string will be returned.
*/
function parse($tpl, $hash) {
    foreach ($hash as $key => $value) {
        $tpl = str_replace('[+'.$key.'+]', $value, $tpl);
    }
    return $tpl;
}

/* EOF */