<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Refuge
 * @since Refuge 1.0
 */
get_header(); ?>

	<div class="row">
		<div id="content" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<div class="columns">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'page' ); ?>
					<?php endwhile; ?>
					<?php refuge_paging_nav(); ?>
				<?php else : ?>
				<?php endif; ?>
			</div>
		</div>
<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>