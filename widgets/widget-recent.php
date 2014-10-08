<?php
/*-----------------------------------------------------------------------------------
Plugin Name: Recent Widget
Plugin URI: http://dukay.crailana.co.nz
Description: Displays recent blog posts, comments and tags.
Version: 1.0
Author: Craig Duckett
Author URI: http://dukay.crailana.co.nz
-----------------------------------------------------------------------------------*/
	
// Add dukay_recent_widgets function to widgets_init, this will load the widget.
add_action( 'widgets_init', 'dukay_recent_widgets' );    // Register the widget.
function dukay_recent_widgets() 
{ 
	register_widget( 'Dukay_Recent_Widget' );
}    // Extend WP_Widget with our widget.
class dukay_recent_widget extends WP_Widget {    /*-----------------------------------------------------------------------------------
Widget Setup
-----------------------------------------------------------------------------------*/
	function Dukay_Recent_Widget() { 
		// Widget setup 
		$widget_ops = array( 'classname' => 'dukay_recent_widget', 'description' => __('Tutorial to show how to display recent posts from a standard post type', 'framework') );	// Widget UI
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dukay_recent_widget' );
		// Widget name and description 
		$this->WP_Widget( 'dukay_recent_widget', __('Dukay - Recent Widget', 'framework'), $widget_ops, $control_ops ); 
 	}
}  