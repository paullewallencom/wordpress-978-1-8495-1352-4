<?php
/**
* class Test
* 
* Basic library for run-time tests.
*/
if ( !class_exists('Test') ):
class Test 
{
	/**
	* min_php_version
	*
	* Test that your PHP version is at least that of the $min_php_version.
	* @param $min_php_version	string	representing the minimum required version of PHP, e.g. '5.3.2'
	* @param $plugin_name 	string	Name of the plugin for messaging purposes.
	* @return none		Exit with messaging if PHP version is too old.
	*/
	static function min_php_version($min_php_version, $plugin_name) {
	
		$exit_msg = "The '$plugin_name' plugin requires PHP $min_php_version
			or newer. Contact your system administrator about updating your version of PHP";
			
		if (version_compare( phpversion(),$min_php_version,'<'))
		{
		    exit ($exit_msg);
		}
	}
}
endif;
/*EOF*/