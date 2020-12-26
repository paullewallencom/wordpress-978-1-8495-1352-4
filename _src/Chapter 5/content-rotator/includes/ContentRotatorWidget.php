<?php
/*------------------------------------------------------------------------------
Content Rotator Widget: rotates chunks of content.
------------------------------------------------------------------------------*/
class ContentRotatorWidget extends WP_Widget
{
	public $name = 'Content Rotator';
	public $description = 'Rotates chunks of content on a periodic basis';
	/* List all controllable options here along with a default value.
	The values can be distinct for each instance of the widget. */
	public $control_options = array(
		'title'					=> 'Content Rotator',
		'seconds_shelf_life'	=> 86400,	// 86400 seconds in a day
	);

//	public static $this_plugin_dir = WP_PLUGIN_DIR . dirname(dirname(__FILE__));
	
	//!!! Magic Functions	
	// The constructor. 
	function __construct()	
	{
		$widget_options = array(
			'classname' 	=> __CLASS__,
			'description' 	=> $this->description,
		);
		
		parent::__construct( __CLASS__, $this->name,$widget_options,$this->control_options);
	}
	
	//!!! Public Functions
	/*------------------------------------------------------------------------------
	Displays the widget in the manager
	OUTPUT: prints form elements 
	------------------------------------------------------------------------------*/
	public function form( $instance )
	{
		$placeholders = array();
		
		foreach ( $this->control_options as $key => $val )
		{

			$placeholders[ $key .'.id' ] 	= $this->get_field_id( $key );
			$placeholders[ $key .'.name' ] 	= $this->get_field_name( $key );
			// This helps us avoid "Undefined index" notices.
			if ( isset($instance[ $key ] ) )
			{
				$placeholders[ $key .'.value' ]	= esc_attr( $instance[ $key ] );
			}
			// Use the default (for new instances)
			else 
			{
				$placeholders[ $key .'.value' ]	= $this->control_options[ $key ];
			}
			// $placeholders[ $key .'.label' ]	= __( ContentRotator::beautify($key) );
		}
	
		$tpl = file_get_contents( dirname(dirname(__FILE__)) .'/tpls/widget_controls.tpl');
		
		print ContentRotator::parse($tpl, $placeholders);
	}
	
	/*------------------------------------------------------------------------------
	Perform the updating of widget parameters after the manager clicks "Save". 
	------------------------------------------------------------------------------*/ 
	public function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] 	= strip_tags( $new_instance['title'] );
		$instance['seconds_shelf_life'] = (int) $new_instance['seconds_shelf_life'];
		return $instance;
	}
	
	/*------------------------------------------------------------------------------
	Displays content to the front-end, using the tpls/widget.tpl template.
	OUTPUT: prints a formated template.
	------------------------------------------------------------------------------*/
	public function widget($args, $instance)
	{		
		if ( !isset($instance['manufacture_date']) 
			|| time() >= ($instance['manufacture_date'] 
			+ $instance['seconds_shelf_life'] ) )
		{
			$instance['content'] = ContentRotator::get_random_content();
			$instance['manufacture_date'] = time();
			$all_instances = $this->get_settings();
			$all_instances[ $this->number ] = $instance;	
			$this->save_settings($all_instances);
		}
		
		$placeholders = array_merge($args, $instance);

		$tpl = file_get_contents( dirname(dirname(__FILE__)) .'/tpls/widget.tpl');
		
		print ContentRotator::parse($tpl, $placeholders);
		
	}
	
	
	//!!! Static Functions
	static function register_this_widget()
	{
		register_widget(__CLASS__);
	}
	
}
/* EOF */