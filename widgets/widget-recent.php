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
class dukay_recent_widget extends WP_Widget {
/*-----------
Widget Setup
-----------*/
	function Dukay_Recent_Widget() {
		// Widget setup
		$widget_ops = array( 'classname' => 'dukay_recent_widget', 'description' => __('Display recent posts, comments and tags', 'framework') );	// Widget UI
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dukay_recent_widget' );
		// Widget name and description
		$this->WP_Widget( 'dukay_recent_widget', __('Dukay - Recent Widget', 'framework'), $widget_ops, $control_ops );
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
		$number_posts = $instance['number-posts'];
		$number_comments = $instance['number-comments'];
		$number_tags = $instance['number-tags'];
		// Before widget - as defined in your specific theme.
		echo $before_widget;
		/* Display The Widget */
		// Output the widget title if the user entered one in the widget options.
			if ( $title )
				echo $before_title . $title . $after_title;
			//Test The Widget Is Working
			$recent_query = new WP_Query( array('showposts' => $number_posts) );
		?>
		<div class="panel-body recent-tab">
		<?php
		if ( $recent_query->have_posts() ) :
		?>
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#recent-posts" role="tab" data-toggle="tab">Posts</a></li>
			<li><a href="#recent-comments" role="tab" data-toggle="tab">Comments</a></li>
			<li><a href="#recent-tags" role="tab" data-toggle="tab">Tags</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="recent-posts">
				<ul>
					<?php
					while ( $recent_query->have_posts() ) :
						$recent_query->the_post();
						$tmp_more = $GLOBALS['more'];
						$GLOBALS['more'] = 0;
					?>
					<li style="right: 0px;">
						<?php
						if ( has_post_thumbnail() ) :
							$post_thumbnail = get_the_post_thumbnail($post_id, 'thumbnail');
						elseif ( $total_images > 0 ) :
							$image          = array_shift( $images );
							$post_thumbnail = wp_get_attachment_image( $image, 'post-thumbnail' );
						endif;

						if ( ! empty ( $post_thumbnail ) ) :
						?>
						<a class="tab-attachment" href="<?php the_permalink(); ?>">
							<?php echo $post_thumbnail; ?>
						</a>
						<?php endif; ?>
						<div class="tab-text">
							<h5>
								<?php
								the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
								?>
								<small>
									<time class="entry-date" datetime="<?php echo esc_attr(get_the_date('c'));?>"><?php echo esc_html(get_the_date('F jS, Y'));?></time>
								</small>
							</h5>
						</div>
					</li>
				<?php endwhile; ?>
				</ul>
			</div>
			<?php	endif; // End check for ephemeral posts. ?>
			<div class="tab-pane" id="recent-comments">
				<?php
				$args = array(
					'status' => 'approve',
					'number' => $number_comments
				);
				$comments = get_comments($args);
				?>
				<ul>
					<?php
					foreach($comments as $comment) :
					?>
					<li style="right: 0px;">
						<a class="tab-attachment" href="#">
							<?php echo get_avatar($comment); ?>
						</a>
						<div class="tab-text">
							<h5>
								<a href="<?php echo get_permalink($comment->comment_post_ID); ?>#comments"><?php echo($comment->comment_author); ?></a> - <strong><?php echo get_the_title($comment->comment_post_ID); ?></strong><br />
								<small><?php echo($comment->comment_content); ?></small>
							</h5>
						</div>
					</li>
					<?php
					endforeach;
					?>

				</ul>
			</div>
			<div class="tab-pane" id="recent-tags">
				<?php
				$tags = get_tags(array('number' => $number_tags));
				$html = '';
				foreach ( $tags as $tag ) {
					$tag_link = get_tag_link( $tag->term_id );

					$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
					$html .= '<span class="label label-side-tag">';
					$html .= "{$tag->name}</a>";
				}
				echo $html;
				?>
			</div>
		</div>
	<?php
	/* After widget - as defined in your specific theme. */
	echo $after_widget;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Update The Widget With New Options
	/*-----------------------------------------------------------------------------------*/
	function update( $new_instance, $old_instance )
	{
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number-posts'] = empty( $new_instance['number-posts'] ) ? 4 : absint( $new_instance['number-posts'] );
		$instance['number-comments'] = empty( $new_instance['number-comments'] ) ? 4 : absint( $new_instance['number-comments'] );
		$instance['number-tags'] = empty( $new_instance['number-tags'] ) ? 4 : absint( $new_instance['number-tags'] );

		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings
	/*-----------------------------------------------------------------------------------*/
	function form( $instance )
	{
		/* Default Widget Settings */
		$title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$number_posts = empty( $instance['number-posts'] ) ? 4 : absint( $instance['number-posts'] );
		$number_comments = empty( $instance['number-comments'] ) ? 4 : absint( $instance['number-comments'] );
		$number_tags = empty( $instance['number-tags'] ) ? 4 : absint( $instance['number-tags'] );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'refuge' ); ?>
		<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'number-posts' ) ); ?>"><?php _e( 'Number of posts to show:', 'refuge' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number-posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number-posts' ) ); ?>" type="text" value="<?php echo esc_attr( $number_posts ); ?>" size="3">
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'number-comments' ) ); ?>"><?php _e( 'Number of comments to show:', 'refuge' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number-comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number-comments' ) ); ?>" type="text" value="<?php echo esc_attr( $number_comments ); ?>" size="3">
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'number-tags' ) ); ?>"><?php _e( 'Number of tags to show:', 'refuge' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number-tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number-tags' ) ); ?>" type="text" value="<?php echo esc_attr( $number_tags ); ?>" size="3">
		</p>
	<?php
	}
}
?>
