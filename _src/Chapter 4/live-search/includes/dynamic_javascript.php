<?php
/**
* This is "mostly" static JavaScript text required to make our Ajax search work 
* properly. We do have to supply the get_search_results() function with
* the URL of where the search handler page lives, and that is dynamically
* determined by WordPress depending on the name of your plugin folder
* and the location of your WordPress installation (e.g. inside a sub directory).
* 
* This file is meant to be included in the HTML head; normally JS should be 
* included via WP's wp_enqueue_script() function, but since this JS requires
* a dynamic value, it's easier to include it in the head.
*
* @param string $search_handler_url Full URL to the Ajax search handler page.
*/
?>
<script type="text/javascript">

	jQuery(document).ready(main);
	
	function main()
	{
		// Create a div where we can dynamically send results
		jQuery('#search-2').append('<div id="ajax_search_results_go_here"></div>');
		
		// Listen for changes in our search field (<input id="s" >)
		jQuery('#s').keyup(get_search_results);
	}
	
	
	/*------------------------------------------------------------------------------
	SYNOPSIS:
		Query our external search page
	INPUT: 
		none; reads values from the id='s' text input (the search query)
	OUTPUT:
		triggers the write_results_to_page() function, writes to console for logging.
	------------------------------------------------------------------------------*/
	function get_search_results()
	{
		var search_query = jQuery('#s').val();
	
	 	if(search_query != "" && search_query.length > 2 ) {
			jQuery.get("<?php print $search_handler_url; ?>", { s:search_query }, write_results_to_page);
	 	}
	 	else
	 	{
	 		console.log('Search term empty or too short.');
	 	}
	}
	
	/*------------------------------------------------------------------------------
	SYNOPSIS: 
		Write the incoming data to the page. 
	INPUT: 
		data = the html to write to the page
		status = an HTTP code to designate 200 OK or 404 Not Found
		xhr = object
	OUTPUT: 
		Writes HTML data to the 'ajax_search_results_go_here' id.
	------------------------------------------------------------------------------*/
	function write_results_to_page(data,status, xhr) 
	{
		if (status == "error") {
			var msg = "Sorry but there was an error: ";
	    	console.error(msg + xhr.status + " " + xhr.statusText);
		}
		else
		{
			jQuery('#ajax_search_results_go_here').html(data);
		}
	}
</script>