See widget_controls.tpl for instructions on using that file.

The widget.tpl template is used to format the output of the widget as it is seen
by the outside world, e.g. on your homepage.

There are 4 built-in placeholders which are dictated by the template in use:

	[+before_widget+]	
	[+after_widget+]
	[+before_title+]
	[+after_title+]
	
There are also placeholders corresponding to the ContentRotatorWidget::$control_options
array keys. The values of these are bound to an instance of the widget, so 2 instances
of the same widget may have completely different values. These placeholders include:

	[+seconds_shelf_life+]
	[+title+]

Lastly, the most important placeholder:

	[+content+] -- contains the random text as defined in the plugin's administration page
	
The documentation for the available placeholders occurs in this readme.txt file
so that it does not display publicly. 