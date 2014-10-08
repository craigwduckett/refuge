<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Refuge
 * @since Refuge 1.0
 */
get_header(); ?>

	<div class="row">
		<div id="content" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<div class="columns">
			<?php query_posts ($query_string . '&cat=2'); ?>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php refuge_paging_nav(); ?>
				<?php else : ?>
				<?php endif; ?>
			</div>
		</div>
<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>