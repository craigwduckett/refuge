<?php
require_once('wp_bootstrap_navwalker.php');

include('widgets/widget-recent.php');
include('widgets/widget-donate-box.php');
include('widgets/widget-donate.php');

register_nav_menu( 'primary', 'Primary Menu' );

add_theme_support( 'post-thumbnails' );

add_image_size( 'sidebar-thumb', 120, 120, true ); // Hard Crop Mode
add_image_size( 'homepage-header', 750, 323 ); // Soft Crop Mode
add_image_size( 'singlepost-thumb', 590, 9999 ); // Unlimited Height Mode

function refuge_excerpt_length($length) {
    return 100;
}
add_filter('excerpt_length', 'refuge_excerpt_length');

/* Add a link  to the end of our excerpt contained in a div for styling purposes and to break to a new line on the page.*/

function refuge_excerpt_more($more) {
    global $post;
	return '<div class="row"><div class="col-lg-12"><a class="btn btn-readmore btn-lg btn-block" href="'. get_permalink($post->ID) . '">Continue reading...</a></div></div>';
}
add_filter('excerpt_more', 'refuge_excerpt_more');

if ( ! function_exists( 'refuge_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Refuge 1.0
 */
	function refuge_paging_nav() {
		global $wp_query;

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 )
			return;
		?>
		<h1 class="sr-only"><?php _e( 'Posts navigation', 'refuge' ); ?></h1>
		<ul class="pager">
			<?php if ( get_next_posts_link() ) : ?>
			<li class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older', 'refuge' ) ); ?></li>
			<?php else: ?>
			<li class="previous disabled"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older', 'refuge' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'refuge' ) ); ?></li>
			<?php else: ?>
			<li class="next disabled"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'refuge' ) ); ?></li>
			<?php endif; ?>
		</ul>
		<?php
	}
endif;

/**
 * Register our sidebars and widgetized areas.
 *
 */
function dukay_widgets_init() {

	register_sidebar( array(
		'name' => 'Left sidebar',
		'id' => 'left_1',
		'before_widget' => '<div class="panel panel-default">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="panel-heading"><h2 class="panel-title">',
		'after_title' => '</h2></div>',
	) );
}
add_action( 'widgets_init', 'dukay_widgets_init' );
