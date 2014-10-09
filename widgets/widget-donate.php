<?php
/*-----------------------------------------------------------------------------------
Plugin Name: Donate Widget
Plugin URI: http://dukay.crailana.co.nz
Description: Allows users to donate through paypal.
Version: 1.0
Author: Craig Duckett
Author URI: http://dukay.crailana.co.nz
-----------------------------------------------------------------------------------*/

// Add dukay_donates function to widgets_init, this will load the widget.
add_action( 'widgets_init', 'dukay_donate' );    // Register the widget.
function dukay_donate()
{
  register_widget( 'Dukay_Donate' );
}    // Extend WP_Widget with our widget.
class dukay_donate extends WP_Widget {
/*-----------
Widget Setup
-----------*/
  function Dukay_Donate() {
    // Widget setup
    $widget_ops = array( 'classname' => 'dukay_donate', 'description' => __('Display Donate Boxes', 'framework') );	// Widget UI
    $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dukay_donate' );
    // Widget name and description
    $this->WP_Widget( 'dukay_donate', __('Dukay - Donate (Paypal)', 'framework'), $widget_ops, $control_ops );
   }

  /*-----------------------------------------------------------------------------------*/
  /*	Display The Widget To The Front End
  /*-----------------------------------------------------------------------------------*/
  function widget( $args, $instance )
  {
    extract( $args );
    //Widget title, entered in the widget settings
    $title = apply_filters('widget_title', $instance['title'] );
    /* Custom Options */
    // Our options from the widget settings.
    $paypal_id = $instance['paypal-id'];
    $options = $instance['options'];
    $description = $instance['description'];
    // Before widget - as defined in your specific theme.
    $html = $before_widget;
    /* Display The Widget */
    // Output the widget title if the user entered one in the widget options.
      if ( $title )
        $html .= $before_title . $title . $after_title;
      //Test The Widget Is Working
      $html .= '<div class="panel-body">';
      $html .= $description;

      $html .=  '<div class="input-group">
        <span class="input-group-addon">$</span>
        <input type="text" class="form-control">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button>
        </span>
      </div><!-- /input-group -->
      or
      <div class="input-group">
        <select class="form-control">'.
          $alloptions = explode(',',$options);
          foreach ($alloptions as $opt)
          {
             $o = explode(':',$opt);
          $html .='<option value="'.$o['1'].'">'.$o['0'].'</option>';
          }
        $html .= '</select>
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button>
        </span>
      </div><!-- /input-group -->';

  /* After widget - as defined in your specific theme. */
  $html .=  $after_widget;
  echo $html;
  }

  /*-----------------------------------------------------------------------------------*/
  /*	Update The Widget With New Options
  /*-----------------------------------------------------------------------------------*/
  function update( $new_instance, $old_instance )
  {
    $instance['title']  = strip_tags( $new_instance['title'] );
    $instance['paypal-id'] = $new_instance['paypal-id'];
    $instance['options'] = $new_instance['options'];
    $instance['description'] = $new_instance['description'];

    return $instance;
  }

  /*-----------------------------------------------------------------------------------*/
  /*	Widget Settings
  /*-----------------------------------------------------------------------------------*/
  function form( $instance )
  {
    /* Default Widget Settings */
    $title  = empty( $instance['title'] ) ? 'Donate' : esc_attr( $instance['title'] );
    $paypal_id = empty( $instance['paypal-id'] ) ? '' : esc_attr( $instance['paypal-id'] );
    $options = empty( $instance['options'] ) ? '' : esc_attr( $instance['options'] );
    $description = empty( $instance['description'] ) ? '' : esc_attr( $instance['description'] );
    ?>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'refuge' ); ?>
    <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
    </p>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'paypal-id' ) ); ?>"><?php _e( 'Paypal ID:', 'refuge' ); ?>
    <input id="<?php echo esc_attr( $this->get_field_id( 'paypal-id' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'paypal-id' ) ); ?>" type="text" value="<?php echo esc_attr( $paypal_id ); ?>">
    </p>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'options' ) ); ?>"><?php _e( 'Add more options rather than a dollar amount for users to donate (eg Support our crisis line for 24 hours:40,Pay for one nights stay in our safe house:50, etc ):', 'refuge' ); ?></label>
      <textarea id="<?php echo esc_attr( $this->get_field_id( 'options' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'options' ) ); ?>" cols="50" rows="5"><?php echo esc_attr( $options ); ?></textarea>
    </p>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Text before text boxes:', 'refuge' ); ?></label>
      <textarea id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" cols="50" rows="5"><?php echo esc_attr( $description ); ?></textarea>
    </p>
  <?php
  }
}
?>
