<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Refuge
 * @since Refuge 1.0
 */
get_header(); ?>

  <div class="row">
    <div id="content" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
      <div class="columns">
          <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'post' ); ?>
          <?php endwhile; ?>
          <?php refuge_paging_nav(); ?>
      </div>
    </div>
<?php get_sidebar(); ?>
  </div>
<?php get_footer(); ?>
