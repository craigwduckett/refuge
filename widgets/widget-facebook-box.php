<?php
/*-----------------------------------------------------------------------------------
Plugin Name: Facebook Like Box Widget
Plugin URI: http://dukay.crailana.co.nz
Description: Displays the Facebook Like Box by inserting iframe code from Facebook.
Version: 1.0
Author: Craig Duckett
Author URI: http://dukay.crailana.co.nz
-----------------------------------------------------------------------------------*/

// Add dukay_facebook_boxs function to widgets_init, this will load the widget.
add_action( 'widgets_init', 'dukay_facebook_box' );    // Register the widget.
function dukay_facebook_box()
{
  register_widget( 'Dukay_Facebook_Box' );
}    // Extend WP_Widget with our widget.
class dukay_facebook_box extends WP_Widget {
/*-----------
Widget Setup
-----------*/
  function Dukay_Facebook_Box() {
    // Widget setup
    $widget_ops = array( 'classname' => 'dukay_facebook_box', 'description' => __('Display facebook like box', 'framework') );	// Widget UI
    $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dukay_facebook_box' );
    // Widget name and description
    $this->WP_Widget( 'dukay_facebook_box', __('Dukay - Facebook Like Box', 'framework'), $widget_ops, $control_ops );
   }

  /*-----------------------------------------------------------------------------------*/
  /*	Display The Widget To The Front End
  /*-----------------------------------------------------------------------------------*/
  function widget( $args, $instance )
  {
    extract( $args );
    //Widget title, entered in the widget settings
    $title = apply_filters('widget_title', $instance['title'] );
    $fb_iframe = $instance['fb-iframe'];
    /* Custom Options */
    // Our options from the widget settings.
    // Before widget - as defined in your specific theme.
    echo $before_widget;
    /* Display The Widget */
    // Output the widget title if the user entered one in the widget options.
      if ( $title )
        echo $before_title . $title . $after_title;
      //Test The Widget Is Working
      echo '<div class="panel-body">';
        echo $fb_iframe;

  /* After widget - as defined in your specific theme. */
  echo $after_widget;
  }

  /*-----------------------------------------------------------------------------------*/
  /*	Update The Widget With New Options
  /*-----------------------------------------------------------------------------------*/
  function update( $new_instance, $old_instance )
  {
    $instance['title']  = strip_tags( $new_instance['title'] );
    $instance['fb-iframe'] = $new_instance['fb-iframe'];

    return $instance;
  }

  /*-----------------------------------------------------------------------------------*/
  /*	Widget Settings
  /*-----------------------------------------------------------------------------------*/
  function form( $instance )
  {
    /* Default Widget Settings */
    $title  = empty( $instance['title'] ) ? 'Facebook' : esc_attr( $instance['title'] );
    $fb_iframe = empty( $instance['fb-iframe'] ) ? '' : esc_attr( $instance['fb-iframe'] );
    ?>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'refuge' ); ?>
    <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
    </p>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'fb-iframe' ) ); ?>"><?php _e( 'Iframe source code from facebook:', 'refuge' ); ?></label>
      <textarea id="<?php echo esc_attr( $this->get_field_id( 'fb-iframe' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb-iframe' ) ); ?>" cols="50" rows="5"><?php echo esc_attr( $fb_iframe ); ?></textarea>
    </p>
  <?php
  }
}
?>
