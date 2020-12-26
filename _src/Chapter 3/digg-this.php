<?php
/*------------------------------------------------------------------------------
Plugin Name: Digg This
Plugin URI: http://www.tipsfor.us/
Description: This plugin will add a "Digg This" button link to each post on your WordPress site. 
Author: Everett Griffiths
Version: 0.1
Author URI: http://www.tipsfor.us/
------------------------------------------------------------------------------*/ 
// include() or require() any necessary files here...

// Settings and/or Configuration Details go here...
/* This template needs to have 5 "%s" placeholders for use in the sprintf function.  
They correspond sequentially to:
	url
	title
	media type 
	topic
	description
*/
define ('DIGGTHIS_BUTTON_TEMPLATE', 
	'<a class="DiggThisButton DiggMedium" 
		href="http://digg.com/submit?url=%s&amp;title=%s"
		rev="%s, %s">
		<span style="display:none">
			%s
		</span>
		</a>');

// Must be one of the allowed Digg topics: http://about.digg.com/button
define ('DIGGTHIS_DEFAULT_TOPIC','tech_news');
		
define ('DIGGTHIS_JS', 
	"<script type='text/javascript'>
		(function() {
		var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
		s.type = 'text/javascript';
		s.async = true;
		s.src = 'http://widgets.digg.com/buttons.js';
		s1.parentNode.insertBefore(s, s1);
		})();
	</script>");
	
define('DIGGTHIS_MIN_WORDPRESS_VERSION', '3.0');


// Tie into WordPress Hooks and any functions that should run on load.
add_filter('the_content', 'diggthis_get_button');
add_action('wp_head','diggthis_add_js_to_doc_head');

diggthis_check_wordpress_version();


// "Private" internal functions named with a leading underscore
/*------------------------------------------------------------------------------
SYNOPSIS: Gets a short description/excerpt of the post from the content.
INPUT: none.
OUTPUT: string, stripped of html tags and shortcodes.
------------------------------------------------------------------------------*/
function _diggthis_get_post_description() {
	$excerpt 		= get_the_content();
	$excerpt 		= strip_shortcodes($excerpt);
	$excerpt 		= strip_tags($excerpt);
	$excerpt 		= substr($excerpt,0, 350);
	$words_array 	= explode(' ', $excerpt);
	$word_cnt 	= count($words_array);
	return implode(' ', array_slice($words_array, 0, $word_cnt - 1));
}


/*------------------------------------------------------------------------------
FUTURE: calculate whether the post qualifies as news, image, or video. Currently,
	this statically returns "news".
------------------------------------------------------------------------------*/
function _diggthis_get_post_media_type() {
	return 'news';
}

/*------------------------------------------------------------------------------
SYNOPSIS: Checks current post categories to see if any WP Category is a viable 
	Digg topic; if yes, return the first match.  Otherwise, the 
	DIGGTHIS_DEFAULT_TOPIC will be returned.
INPUT: none.
OUTPUT: string (a viable Digg topic).
------------------------------------------------------------------------------*/
function _diggthis_get_post_topic() {

	$digg_topics_array = array(
		'arts_culture','autos','baseball','basketball','business_finance',
		'celebrity','comedy','comics_animation','design','educational',
		'environment','extreme_sports','food_drink','football','gadgets',
		'gaming_news','general_sciences','golf','hardware','health',
		'hockey','linux_unix','microsoft','mods','motorsport',
		'movies','music','nintendo','odd_stuff','olympics','other_sports',
		'pc_games','people','pets_animals','playable_web_games','playstation',
		'political_opinion','politics','programming','security','soccer',
		'software','space','tech_news','television','tennis','travel_places',
		'world_news','xbox',);
	
	$category_array = get_categories();
	
	foreach ( $category_array as $cat ) {
		// WP replaces spaces w '-', whereas Digg uses '_'
		$category_name = preg_replace('/\-/','_',$cat->category_nicename);
		if ( in_array ( $category_name, $digg_topics_array ) ) {
			return $category_name;
		}
	}
	
	// if no match, then fall back to the default
	return DIGGTHIS_DEFAULT_TOPIC;
}

/*------------------------------------------------------------------------------
SYNOPSIS: get the title of the current post.
INPUT: none;
OUTPUT: title of the current post
------------------------------------------------------------------------------*/
function _diggthis_get_post_title() {
	$id = get_the_ID();
	return get_the_title($id);
}

/*------------------------------------------------------------------------------
SYNOPSIS: gets the link of the current post.
INPUT: none;
OUTPUT: urlencoded permalink
------------------------------------------------------------------------------*/
function _diggthis_get_post_url() {
#	return "http://www.tipsfor.us/";
	$id = get_the_ID();
	return get_permalink($id);
}


// The "Public" functions
/*------------------------------------------------------------------------------
SYNOPSIS: Adds custom Javascript to HTML document <head>.
INPUT: None.
OUTPUT: None; prints directly
------------------------------------------------------------------------------*/
function diggthis_add_js_to_doc_head() {
	print DIGGTHIS_JS;
}

/*------------------------------------------------------------------------------
SYNOPSIS: Appends a special Digg.com anchor tag to the end of the post content.
INPUT: $content (str) the content that appears in a given post or page.
OUTPUT: Modified $content.
------------------------------------------------------------------------------*/
function diggthis_get_button($content) {

	$url 			= urlencode( _diggthis_get_post_url() );
	$title			= urlencode( _diggthis_get_post_title() );
	$description	= _diggthis_get_post_description();
	$media_type		= _diggthis_get_post_media_type();
	$topic			= _diggthis_get_post_topic();	
	
	return $content . sprintf(
		DIGGTHIS_BUTTON_TEMPLATE, 
		$url, 
		$title, 
		$media_type, 
		$topic, 
		$description);
}

/*------------------------------------------------------------------------------
SYNOPSIS: checks that the current version of WordPress is current enough.
INPUT: None.
OUTPUT: None; exit on fail.
------------------------------------------------------------------------------*/
function diggthis_check_wordpress_version() {
	global $wp_version;
	
	$exit_msg='"Digg This" requires WordPress '
		.DIGGTHIS_MIN_WORDPRESS_VERSION
		.' or newer. 
		<a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
		
	if (version_compare($wp_version,DIGGTHIS_MIN_WORDPRESS_VERSION,'<'))
	{
	    exit ($exit_msg);
	}
}

/* EOF */
